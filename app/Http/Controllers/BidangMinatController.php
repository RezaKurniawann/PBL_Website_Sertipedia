<?php

namespace App\Http\Controllers;

use App\Models\BidangMinatModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BidangMinatController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar bidangminat',
            'list' => ['Home', 'bidangminat']
        ];

        $page = (object) [
            'title' => 'Daftar bidangminat yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-jurusan';

        return view('admin.jurusan.bidangminat.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $bidangminat = BidangMinatModel::select('id_bidangminat', 'nama');

        return DataTables::of($bidangminat)
            ->addIndexColumn()
            ->addColumn('aksi', function ($bidangminat) {
                $btn = '<button onclick="modalAction(\'' . url('manage/jurusan/bidangminat/' . $bidangminat->id_bidangminat . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/jurusan/bidangminat/' . $bidangminat->id_bidangminat . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/jurusan/bidangminat/' . $bidangminat->id_bidangminat . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax(string $id)
    {
        $bidangminat = BidangMinatModel::find($id);
        if ($bidangminat) {
            return view('admin.jurusan.bidangminat.show', ['bidangminat' => $bidangminat]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function create_ajax()
    {
        return view('admin.jurusan.bidangminat.create');
    }

    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama'    => 'required|string|max:100',
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'    => false, // response status, false: error/gagal, true: berhasil
                    'message'   => 'Validasi Gagal',
                    'msgField'  => $validator->errors(), // pesan error validasi
                ]);
            }
            BidangMinatModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data bidangminat berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $bidangminat = BidangMinatModel::find($id);
        return view('admin.jurusan.bidangminat.edit', ['bidangminat' => $bidangminat]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => 'required|max:100'
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }
            $check = BidangMinatModel::find($id);
            if ($check) {
                $check->update($request->all());
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
    public function confirm_ajax(string $id)
    {
        $bidangminat = BidangMinatModel::find($id);
        return view('admin.jurusan.bidangminat.confirm', ['bidangminat' => $bidangminat]);
    }
    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $bidangminat = BidangMinatModel::find($id);
            if ($bidangminat) {
                $bidangminat->delete();
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

    public function import()
    {
        return view('admin.jurusan.bidangminat.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_bidangminat' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_bidangminat');
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
                            'id_bidangminat' => $value['A'],
                            'nama' => $value['B'],
                            'created_at' => now(),
                        ];
                    }
                }
            }

            if (count($insert) > 0) {
                bidangminatModel::insertOrIgnore($insert);
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
        // ambil data bidangminat yang akan di export
        $bidangminat = bidangminatModel::select('id_bidangminat', 'nama')
        ->orderBy('id_bidangminat')
        ->get();

        // Load library Excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header untuk kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Bidang Minat');
        // $sheet->setCellValue('D1', 'deskripsi');

        // Set header menjadi bold
        $sheet->getStyle('A1:B1')->getFont()->setBold(true);
        $no = 1; // Nomor data dimulai dari 1
        $baris = 2; // Baris data dimulai dari baris ke-2
        foreach ($bidangminat as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->nama);
            // $sheet->setCellValue('D' . $baris, $value->deskripsi);
            $baris++; // Pindah ke baris berikutnya
            $no++;    // Tambahkan nomor urut
        }
        foreach (range('A', 'B') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // Set auto size untuk kolom
        }
        $sheet->setTitle('Data bidangminat'); // Set judul sheet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data bidangminat ' . date('Y-m-d H:i:s') . '.xlsx';

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
        // Ambil data bidangminat
        $bidangminat = bidangminatModel::select('id_bidangminat', 'nama')
            ->orderBy('id_bidangminat')
            ->get();
        // Load view untuk PDF, gunakan Barryvdh\DomPDF\Facade\Pdf
        $pdf = Pdf::loadView('admin.jurusan.bidangminat.export_pdf', ['bidangminat' => $bidangminat]);
        // Set ukuran kertas dan orientasi (A4, portrait)
        $pdf->setPaper('a4', 'portrait');
        // Jika ada gambar dari URL, set isRemoteEnabled ke true
        $pdf->setOption("isRemoteEnabled", true);
        // Render dan stream PDF
        $pdf->render();
        return $pdf->stream('Data bidangminat ' . date('Y-m-d H:i:s') . '.pdf');
    }
}
