<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\PeriodeModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;

class PeriodeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Periode',
            'list' => ['Home', 'Periode']
        ];

        $page = (object) [
            'title' => 'Daftar periode yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-periode';

        return view('admin.periode.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $periode = PeriodeModel::select('id_periode', 'tahun');

        return DataTables::of($periode)
            ->addIndexColumn()
            ->addColumn('aksi', function ($periode) {
                $btn = '<button onclick="modalAction(\'' . url('manage/periode/' . $periode->id_periode . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/periode/' . $periode->id_periode . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/periode/' . $periode->id_periode . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax(string $id)
    {
        $periode = PeriodeModel::find($id);
        if ($periode) {
            return view('admin.periode.show', ['periode' => $periode]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function create_ajax()
    {
        return view('admin.periode.create');
    }

    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'tahun'    => 'required|integer|unique:m_periode,tahun',
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
            PeriodeModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data periode berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $periode = PeriodeModel::find($id);
        return view('admin.periode.edit', ['periode' => $periode]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'tahun' => 'required|integer|unique:m_periode,tahun,' . $id . ',id_periode'
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
            $check = PeriodeModel::find($id);
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
        $periode = PeriodeModel::find($id);
        return view('admin.periode.confirm', ['periode' => $periode]);
    }
    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $periode = PeriodeModel::find($id);
            if ($periode) {
                $periode->delete();
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
        $periode = PeriodeModel::select('id_periode', 'tahun')
            ->orderBy('id_periode')
            ->get();

        $pdf = Pdf::loadView('admin.periode.export_pdf', ['periode' => $periode]);
        $pdf->setPaper('a4', 'portrait'); 
        $pdf->setOption("isRemoteEnabled", true); 

        return $pdf->stream('Data periode ' . date('Y-m-d H:i:s') . '.pdf');
    }

    public function export_excel()
    {
        $periode = PeriodeModel::select('id_periode','tahun')
            ->orderBy('id_periode')
            ->get();

     
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Tahun Periode');

        $sheet->getStyle('A1:B1')->getFont()->setBold(true);

        $no = 1;
        $row = 2;
        foreach ($periode as $item) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $item->tahun);
            $row++;
            $no++;
        }

        foreach (range('A', 'B') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle('Data Periode');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Periode ' . date('Y-m-d H:i:s') . '.xlsx';

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
        return view('admin.periode.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_periode' => ['required', 'mimes:xlsx', 'max:1024']
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
                $file = $request->file('file_periode');
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
                                    'id_periode' => $value['A'],
                                    'tahun' => $value['B'],
                                    'created_at' => now(),
                                ];
                            }
                        }
                    }

                    if (count($insert) > 0) {
                        PeriodeModel::insertOrIgnore($insert);

                        return response()->json([
                            'status' => true,
                            'message' => 'Data periode berhasil diimpor'
                        ]);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => 'Tidak ada data periode yang valid untuk diimpor'
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
