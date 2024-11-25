<?php

namespace App\Http\Controllers;
use App\Models\GolonganModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Golongan',
            'list' => ['Home', 'Golongan']
        ];

        $page = (object) [
            'title' => 'Daftar Golongan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-user';

        return view('admin.golongan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $golongan = GolonganModel::select('id_golongan', 'nama');

        return DataTables::of($golongan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($golongan) {
                $btn = '<button onclick="modalAction(\'' . url('manage/golongan/' . $golongan->id_golongan . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/golongan/' . $golongan->id_golongan . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/golongan/' . $golongan->id_golongan . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax(string $id)
    {
        $golongan = GolonganModel::find($id);
        if ($golongan) {
            return view('admin.golongan.show', ['golongan' => $golongan]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function create_ajax()
    {
        return view('admin.golongan.create');
    }

    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama'    => 'required|string|max:100|unique:m_golongan,nama',
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
            GolonganModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data golongan berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $golongan = GolonganModel::find($id);
        return view('admin.golongan.edit', ['golongan' => $golongan]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => 'required|max:100|unique:m_golongan,nama,' . $id . ',id_golongan'
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
            $check = GolonganModel::find($id);
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
        $golongan = GolonganModel::find($id);
        return view('admin.golongan.confirm', ['golongan' => $golongan]);
    }
    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $golongan = GolonganModel::find($id);
            if ($golongan) {
                $golongan->delete();
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

    public function export_pdf()
    {
        $golongan = GolonganModel::select('id_golongan', 'nama')
            ->orderBy('id_golongan')
            ->get();

        $pdf = Pdf::loadView('admin.golongan.export_pdf', ['golongan' => $golongan]);
        $pdf->setPaper('a4', 'portrait'); 
        $pdf->setOption("isRemoteEnabled", true); 

        return $pdf->stream('Data Golongan ' . date('Y-m-d H:i:s') . '.pdf');
    }

    public function export_excel()
    {
        $golongan = GolonganModel::select('id_golongan','nama')
            ->orderBy('id_golongan')
            ->get();

     
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');

        $sheet->getStyle('A1:B1')->getFont()->setBold(true);

        $no = 1;
        $row = 2;
        foreach ($golongan as $item) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $item->nama);
            $row++;
            $no++;
        }

        foreach (range('A', 'B') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle('Data Golongan');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Golongan ' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified:' . gmdate('D, dMY H:i:s') . 'GMT');
        header('Pragma: public');
        $writer->save('php://output');
        exit;
    }

    public function import()
    {
        return view('admin.golongan.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_golongan' => ['required', 'mimes:xlsx', 'max:1024']
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            try {
                // Ambil file dari request
                $file = $request->file('file_golongan');
                $reader = IOFactory::createReader('Xlsx'); // Load reader file Excel
                $reader->setReadDataOnly(true); // Hanya membaca data
                $spreadsheet = $reader->load($file->getRealPath()); // Load file excel
                $sheet = $spreadsheet->getActiveSheet(); // Ambil sheet yang aktif
                $data = $sheet->toArray(null, false, true, true); // Ambil data Excel

                // Siapkan array untuk menampung data yang akan diinsert
                $insert = [];

                if (count($data) > 1) { // Jika data lebih dari 1 baris
                    foreach ($data as $baris => $value) {
                        if ($baris > 1) { // Baris ke-1 adalah header, maka lewati
                            // Pastikan semua kolom tidak kosong sebelum insert
                            if ($value['A'] && $value['B']) {
                                $insert[] = [
                                    'id_golongan' => $value['A'],
                                    'nama' => $value['B'],
                                    'created_at' => now(),
                                ];
                            }
                        }
                    }

                    if (count($insert) > 0) {
                        GolonganModel::insertOrIgnore($insert);

                        return response()->json([
                            'status' => true,
                            'message' => 'Data golongan berhasil diimpor'
                        ]);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => 'Tidak ada data golongan yang valid untuk diimpor'
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'File kosong atau tidak ada data yang diimpor'
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage()
                ]);
            }
        }
        return redirect('/');
    }
}
