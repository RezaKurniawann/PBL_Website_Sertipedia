<?php

namespace App\Http\Controllers;

use App\Models\MataKuliahModel;
use App\Models\BidangMinatModel;
use App\Models\PeriodeModel;
use App\Models\SertifikasiModel;
use App\Models\VendorModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SertifikasiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Sertifikasi',
            'list' => ['Home', 'Sertifikasi']
        ];

        $page = (object) [
            'title' => 'Daftar sertifikasi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-event';

        $matakuliah = MataKuliahModel::all();
        $bidangminat = BidangMinatModel::all();
        $periode = PeriodeModel::all();
        $vendor = VendorModel::all();

        return view('admin.event.sertifikasi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'matakuliah' => $matakuliah, 'bidangminat' => $bidangminat, 'periode' => $periode, 'vendor' => $vendor, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $sertifikasis = SertifikasiModel::select('id_sertifikasi', 'id_vendor', 'id_periode', 'nama', 'biaya', 'jenis_sertifikasi', 'tanggal_awal', 'tanggal_akhir')->with('vendor', 'periode');

        return DataTables::of($sertifikasis)
            ->addIndexColumn()
            ->addColumn('aksi', function ($sertifikasi) {
                $btn = '<button onclick="modalAction(\'' . url('manage/event/sertifikasi/' . $sertifikasi->id_sertifikasi . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/event/sertifikasi/' . $sertifikasi->id_sertifikasi . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/event/sertifikasi/' . $sertifikasi->id_sertifikasi . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax(string $id)
    {

        $sertifikasi = SertifikasiModel::with(['matakuliah', 'bidangminat'])->find($id);

        if ($sertifikasi) {
            return view('admin.event.sertifikasi.show', [
                'sertifikasi' => $sertifikasi,
                'matakuliah' => $sertifikasi->matakuliah,
                'bidangminat' => $sertifikasi->bidangminat,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function confirm_ajax(string $id)
    {
        $sertifikasi = SertifikasiModel::with(['matakuliah', 'bidangminat'])->find($id);

        if ($sertifikasi) {
            return view('admin.event.sertifikasi.confirm', [
                'sertifikasi' => $sertifikasi,
                'matakuliah' => $sertifikasi->matakuliah,
                'bidangminat' => $sertifikasi->bidangminat,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $sertifikasi = SertifikasiModel::find($id);
            if ($sertifikasi) {
                $sertifikasi->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $sertifikasi = SertifikasiModel::with(['matakuliah', 'bidangminat'])->find($id);
        $vendor = VendorModel::select('id_vendor', 'nama', 'kategori')->get();
        $periode = PeriodeModel::select('id_periode', 'tahun')->get();
        $matakuliah = MatakuliahModel::select('id_matakuliah', 'nama')->get();
        $bidangminat = BidangMinatModel::select('id_bidangminat', 'nama')->get();
        return view('admin.event.sertifikasi.edit', ['sertifikasi' => $sertifikasi, 'vendor' => $vendor, 'periode' => $periode, 'matakuliah' => $matakuliah, 'bidangminat' => $bidangminat]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => 'required|string|min:3|max:100',
                'id_vendor' => 'required|integer',
                'biaya' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
                'jenis_sertifikasi' => 'required|string',
                'tanggal_awal' => 'required|date|before_or_equal:tanggal_akhir',
                'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
                'id_periode' => 'required|integer',
                'mata_kuliah' => 'required|array|min:1',
                'mata_kuliah.*' => 'required|integer|exists:m_matakuliah,id_matakuliah',
                'bidang_minat' => 'required|array|min:1',
                'bidang_minat.*' => 'required|integer|exists:m_bidangminat,id_bidangminat',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $sertifikasi = SertifikasiModel::find($id);
            if ($sertifikasi) {
                // Hapus data lama di tabel `t_sertifikasi_matakuliah` dan `t_sertifikasi_bidangminat`
                DB::table('t_sertifikasi_matakuliah')->where('id_sertifikasi', $id)->delete();
                DB::table('t_sertifikasi_bidangminat')->where('id_sertifikasi', $id)->delete();

                // Update data utama di tabel `sertifikasi`
                $sertifikasi->update([
                    'nama' => $request->input('nama'),
                    'id_vendor' => $request->input('id_vendor'),
                    'biaya' => $request->input('biaya'),
                    'jenis_sertifikasi' => $request->input('jenis_sertifikasi'),
                    'tanggal_awal' => $request->input('tanggal_awal'),
                    'tanggal_akhir' => $request->input('tanggal_akhir'),
                    'id_periode' => $request->input('id_periode'),
                ]);

                // Insert ulang data baru ke tabel `t_sertifikasi_matakuliah`
                $timestamps = ['created_at' => now(), 'updated_at' => now()]; // Tambahkan timestamp
                foreach ($request->input('mata_kuliah') as $id_matakuliah) {
                    DB::table('t_sertifikasi_matakuliah')->insert(array_merge([
                        'id_sertifikasi' => $id,
                        'id_matakuliah' => $id_matakuliah,
                    ], $timestamps));
                }

                // Insert ulang data baru ke tabel `t_sertifikasi_bidangminat`
                foreach ($request->input('bidang_minat') as $id_bidangminat) {
                    DB::table('t_sertifikasi_bidangminat')->insert(array_merge([
                        'id_sertifikasi' => $id,
                        'id_bidangminat' => $id_bidangminat,
                    ], $timestamps));
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function create_ajax()
    {
        $vendor = VendorModel::select('id_vendor', 'nama', 'kategori')->get();
        $periode = PeriodeModel::select('id_periode', 'tahun')->get();
        $matakuliah = MataKuliahModel::select('id_matakuliah', 'nama')->get();
        $bidangminat = BidangMinatModel::select('id_bidangminat', 'nama')->get();

        return view('admin.event.sertifikasi.create', ['vendor' => $vendor, 'periode' => $periode, 'matakuliah' => $matakuliah, 'bidangminat' => $bidangminat]);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => 'required|string|min:3|max:100',
                'id_vendor' => 'required|integer',
                'biaya' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
                'jenis_sertifikasi' => 'required|string',
                'tanggal_awal' => 'required|date|before_or_equal:tanggal_akhir',
                'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
                'id_periode' => 'required|integer',
                'mata_kuliah' => 'required|array|min:1',
                'mata_kuliah.*' => 'required|integer|exists:m_matakuliah,id_matakuliah',
                'bidang_minat' => 'required|array|min:1',
                'bidang_minat.*' => 'required|integer|exists:m_bidangminat,id_bidangminat',
            ];

            $validator = Validator::make($request->all(), $rules);

            try {
                // Gunakan transaction untuk menjamin konsistensi data
                DB::beginTransaction();

                // Simpan data sertifikasi dan dapatkan ID-nya
                $sertifikasi = SertifikasiModel::create($request->all());
                $idsertifikasi = $sertifikasi->id_sertifikasi;
                foreach ($request->mata_kuliah as $idMatakuliah) {
                    DB::table('t_sertifikasi_matakuliah')->insert([
                        'id_sertifikasi' => $idsertifikasi,
                        'id_matakuliah' => $idMatakuliah,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                foreach ($request->bidang_minat as $idBidangMinat) {
                    DB::table('t_sertifikasi_bidangminat')->insert([
                        'id_sertifikasi' => $idsertifikasi,
                        'id_bidangminat' => $idBidangMinat,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Data sertifikasi berhasil disimpan',
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ]);
            }
        }
        redirect('/');
    }

    public function export_pdf()
    {
        // Mengambil data user dengan relasi yang relevan
        $sertifikasi = SertifikasiModel::with(['vendor', 'periode'])
            ->orderBy('id_periode')
            ->orderBy('id_vendor')
            ->orderBy('nama')
            ->get();

        // Generate PDF
        $pdf = Pdf::loadView('admin.event.sertifikasi.export_pdf', ['sertifikasi' => $sertifikasi]);
        $pdf->setPaper('a4', 'landscape');
        $pdf->setOption("isRemoteEnabled", true);

        // Stream hasil PDF
        return $pdf->stream('Laporan_Data_Pelatihan_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function export_excel()
    {
        $sertifikasi = SertifikasiModel::with(['vendor', 'periode'])
            ->orderBy('id_periode')
            ->orderBy('id_vendor')
            ->orderBy('nama')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Vendor');
        $sheet->setCellValue('D1', 'Biaya');
        $sheet->setCellValue('E1', 'Level Pelatihan');
        $sheet->setCellValue('F1', 'Tanggal Awal');
        $sheet->setCellValue('G1', 'Tanggal Akhir');
        $sheet->setCellValue('H1', 'Periode');


        $sheet->getStyle('A1:H1')->getFont()->setBold(true);

        $no = 1;
        // nomor data dimulai dari 1
        $baris = 2;
        // baris data dimulai dari baris ke 2
        foreach ($sertifikasi as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->nama);
            $sheet->setCellValue('C' . $baris, $value->vendor->nama);
            $sheet->setCellValue('D' . $baris, $value->biaya);
            $sheet->setCellValue('E' . $baris, $value->jenis_sertifikasi);

            // Format tanggal untuk menghilangkan waktu (jika diperlukan)
            $tanggal_awal = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(strtotime($value->tanggal_awal));
            $tanggal_akhir = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(strtotime($value->tanggal_akhir));

            $sheet->setCellValue('F' . $baris, $tanggal_awal);
            $sheet->setCellValue('G' . $baris, $tanggal_akhir);

            // Mengatur format tanggal tanpa waktu
            $sheet->getStyle('F' . $baris)->getNumberFormat()->setFormatCode('DD/MM/YYYY');
            $sheet->getStyle('G' . $baris)->getNumberFormat()->setFormatCode('DD/MM/YYYY');

            $sheet->setCellValue('H' . $baris, $value->periode->tahun);

            $baris++;
            $no++;
        }


        foreach (range('A', 'H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        $sheet->setTitle('Data Sertifikasi');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Sertifikasi ' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: cache, must-revalidate');
        header('Expires: Mon, 23 Nov 2024 05:00:00 GMT');
        header('Last-Modified:' . gmdate('D, dMY H:i:s') . 'GMT');
        header('Pragma: public');
        $writer->save('php://output');
        exit;
    }
}
