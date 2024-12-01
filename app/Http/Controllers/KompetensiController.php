<?php

namespace App\Http\Controllers;

use App\Models\KompetensiModel;
use App\Models\ProdiModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;

class KompetensiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kompetensi Prodi',
            'list' => ['Home', 'Kompetensi']
        ];

        $page = (object) [
            'title' => 'Daftar kompetensi prodi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-jurusan';

        // Ambil data prodi prodi untuk filter
        $prodi = ProdiModel::all();

        // Ambil data kompetensi beserta relasi dengan prodi
        $kompetensi = KompetensiModel::with('prodi')->get();

        return view('admin.jurusan.kompetensi.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'prodi' => $prodi, // Kirim data ke view untuk dropdown filter
            'kompetensi' => $kompetensi // Kirim data ke view untuk ditampilkan di tabel
        ]);
    }

    public function index_pimpinan()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kompetensi Prodi',
            'list' => ['Home', 'Kompetensi']
        ];

        $page = (object) [
            'title' => 'Daftar kompetensi prodi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'kompetensi';

        // Ambil data prodi prodi untuk filter
        $prodi = ProdiModel::all();

        // Ambil data kompetensi beserta relasi dengan prodi
        $kompetensi = KompetensiModel::with('prodi')->get();

        return view('user.pimpinan.kompetensi.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'prodi' => $prodi, // Kirim data ke view untuk dropdown filter
            'kompetensi' => $kompetensi // Kirim data ke view untuk ditampilkan di tabel
        ]);
    }

    public function list(Request $request)
    {
        // Ambil data kompetensi dengan relasi ke tabel t_prodi
            $kompetensi = KompetensiModel::with('prodi:id_prodi,nama') // Pastikan hanya id_prodi dan nama diambil dari relasi
            ->select('id_kompetensi', 'id_prodi', 'nama', 'deskripsi');

        // Filter
        if ($request->id_prodi) {
            $kompetensi->where('id_prodi', $request->id_prodi);
        }

        // if ($request->has('filter_prodi') && $request->filter_prodi) {
        //     $kompetensi->where('id_prodi', $request->filter_prodi);
        // }

        // $id_prodi = $request->input('filter_prodi');
        // if (!empty($id_prodi)) {
        //     $kompetensi->where('id_prodi', $id_prodi);
        // }

        return DataTables::of($kompetensi)
            ->addIndexColumn()
            ->addColumn('prodi', function ($kompetensi) {
                // Tampilkan nama prodi berdasarkan relasi
                return $kompetensi->prodi->nama ?? '-';
            })
            ->addColumn('aksi', function ($kompetensi) {
                $btn = '<button onclick="modalAction(\'' . url('manage/jurusan/kompetensi/' . $kompetensi->id_kompetensi . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/jurusan/kompetensi/' . $kompetensi->id_kompetensi . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/jurusan/kompetensi/' . $kompetensi->id_kompetensi . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function list_pimpinan(Request $request)
    {
        // Ambil data kompetensi dengan relasi ke tabel t_prodi
            $kompetensi = KompetensiModel::with('prodi:id_prodi,nama') // Pastikan hanya id_prodi dan nama diambil dari relasi
            ->select('id_kompetensi', 'id_prodi', 'nama', 'deskripsi');

        // Filter
        if ($request->id_prodi) {
            $kompetensi->where('id_prodi', $request->id_prodi);
        }

        return DataTables::of($kompetensi)
            ->addIndexColumn()
            ->addColumn('prodi', function ($kompetensi) {
                // Tampilkan nama prodi berdasarkan relasi
                return $kompetensi->prodi->nama ?? '-';
            })
            // ->addColumn('aksi', function ($kompetensi) {
            //     $btn = '<button onclick="modalAction(\'' . url('manage/jurusan/kompetensi/' . $kompetensi->id_kompetensi . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
            //     $btn .= '<button onclick="modalAction(\'' . url('manage/jurusan/kompetensi/' . $kompetensi->id_kompetensi . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            //     $btn .= '<button onclick="modalAction(\'' . url('manage/jurusan/kompetensi/' . $kompetensi->id_kompetensi . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

            //     return $btn;
            // })
            // ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax(string $id)
    {
        $kompetensi = KompetensiModel::find($id);
        if ($kompetensi) {
            return view('admin.jurusan.kompetensi.show_ajax', ['kompetensi' => $kompetensi]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    // Menampilkan form tambah kompetensi
    public function create_ajax()
    {
        $prodi = ProdiModel::select('id_prodi', 'nama')->get();
        return view('admin.jurusan.kompetensi.create_ajax')->with('prodi', $prodi);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_prodi' => ['required', 'integer', 'exists:t_prodi,id_prodi'],
                'nama' => ['required', 'string', 'max:100'],
                'deskripsi' => ['required', 'string', 'max:100'],
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            KompetensiModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        }
        return redirect('/');
    }

    public function edit_ajax($id)
    {
        $kompetensi = KompetensiModel::find($id);
        // dd($id);
        $prodi = ProdiModel::select('id_prodi', 'nama')->get();
        return view('admin.jurusan.kompetensi.edit_ajax', ['kompetensi' => $kompetensi, 'prodi' => $prodi]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Validasi input data
            $rules = [
                'id_prodi' => ['required', 'integer', 'exists:t_prodi,id_prodi'],
                'nama' => ['required', 'string', 'max:100'],
                'deskripsi' => ['required', 'string', 'max:255']
            ];

            $validator = Validator::make($request->all(), $rules);

            // Jika validasi gagal
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            // Cek apakah data kompetensi dengan ID tertentu ada
            $check = KompetensiModel::find($id);
            if ($check) {
                // Update data kompetensi
                $check->update([
                    'id_prodi' => $request->input('id_prodi'),
                    'nama' => $request->input('nama'),
                    'deskripsi' => $request->input('deskripsi')
                ]);

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
        // Jika bukan permintaan AJAX, kembalikan ke halaman utama
        return redirect('/');
    }


    public function confirm_ajax($id)
    {
        $kompetensi = KompetensiModel::find($id);
        return view('admin.jurusan.kompetensi.confirm_ajax', ['kompetensi' => $kompetensi]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $kompetensi = KompetensiModel::find($id);

            if ($kompetensi) {
                $kompetensi->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return redirect('/');
    }

    public function import()
    {
        return view('admin.jurusan.kompetensi.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_kompetensi' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_kompetensi');
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, false, true, true);

            $insert = [];
            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) {
                        $insert[] = [
                            'id_prodi' => $value['A'],
                            'nama' => $value['B'],
                            'deskripsi' => $value['C'],
                            'created_at' => now(),
                        ];
                    }
                }
            }

            if (count($insert) > 0) {
                KompetensiModel::insertOrIgnore($insert);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diimport'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Tidak ada data yang diimport'
            ]);
        }
        return redirect('/');
    }

    public function export_excel(){
        // ambil data kompetensi yang akan di export
        $kompetensi = KompetensiModel::with(['prodi:id_prodi,nama']) // Relasi hanya memuat id_prodi dan nama
        ->select('id_prodi', 'nama', 'deskripsi')
        ->orderBy('id_prodi')
        ->get();

        // Load library Excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header untuk kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'prodi');
        $sheet->setCellValue('C1', 'nama');
        $sheet->setCellValue('D1', 'deskripsi');
        // $sheet->setCellValue('E1', 'Harga Jual');
        // $sheet->setCellValue('F1', 'Kategori');

        // Set header menjadi bold
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);
        $no = 1; // Nomor data dimulai dari 1
        $baris = 2; // Baris data dimulai dari baris ke-2
        foreach ($kompetensi as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->prodi->nama ?? '-'); // Hanya nama prodi
            $sheet->setCellValue('C' . $baris, $value->nama);
            $sheet->setCellValue('D' . $baris, $value->deskripsi);
            // $sheet->setCellValue('E' . $baris, $value->harga_jual);
            // $sheet->setCellValue('F' . $baris, $value->kategori->kategori_nama); // Ambil nama kategori
            $baris++; // Pindah ke baris berikutnya
            $no++;    // Tambahkan nomor urut
        }
        foreach (range('A', 'D') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // Set auto size untuk kolom
        }
        $sheet->setTitle('Data kompetensi'); // Set judul sheet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data kompetensi ' . date('Y-m-d H:i:s') . '.xlsx';

        // Set header untuk file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        
        // Simpan dan kirim output
        $writer->save('php://output');
        exit;
    } //end function export_excel

    public function export_pdf(){
        // Ambil data kompetensi
        $kompetensi = KompetensiModel::with(['prodi:id_prodi,nama']) // Relasi hanya memuat id_prodi dan nama
        ->select('id_kompetensi', 'id_prodi', 'nama', 'deskripsi')
        ->orderBy('nama')
        ->get()
        ->map(function ($item) {
            // Ganti properti 'prodi' menjadi hanya nama prodi
            $item->prodi = $item->prodi->nama ?? '-';
            return $item;
        });
        // Load view untuk PDF, gunakan Barryvdh\DomPDF\Facade\Pdf
        $pdf = Pdf::loadView('admin.jurusan.kompetensi.export_pdf', ['kompetensi' => $kompetensi]);
        // Set ukuran kertas dan orientasi (A4, portrait)
        $pdf->setPaper('a4', 'portrait');
        // Jika ada gambar dari URL, set isRemoteEnabled ke true
        $pdf->setOption("isRemoteEnabled", true);
        // Render dan stream PDF
        $pdf->render();
        return $pdf->stream('Data kompetensi ' . date('Y-m-d H:i:s') . '.pdf');
    }
}
