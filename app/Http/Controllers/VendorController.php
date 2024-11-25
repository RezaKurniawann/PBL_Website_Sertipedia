<?php

namespace App\Http\Controllers;

use App\Models\VendorModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;

class VendorController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Vendor',
            'list' => ['Home', 'Vendor']
        ];

        $page = (object) [
            'title' => 'Daftar Vendor yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-vendor';
        $vendor = VendorModel::all();

        return view('admin.vendor.index', ['breadcrumb' => $breadcrumb,'vendor' => $vendor, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $vendor = VendorModel::select('id_vendor', 'nama', 'alamat', 'kota', 'telepon', 'alamatWeb', 'kategori');

        if ($request->has('kategori') && $request->kategori != '') {
            $vendor->where('kategori', $request->kategori);
        }

        return DataTables::of($vendor)
            ->addIndexColumn()
            ->addColumn('aksi', function ($vendor) {
                $btn = '<button onclick="modalAction(\''.url('manage/vendor/' . $vendor->id_vendor .'/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/vendor/' . $vendor->id_vendor . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/vendor/' . $vendor->id_vendor . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax(string $id)
    {
        $vendor = VendorModel::find($id);
        if ($vendor) {
            return view('admin.vendor.show_ajax', ['vendor' => $vendor]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function create_ajax()
    {
        return view('admin.vendor.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama'      => 'required|string|min:3|max:50', 
                'alamat'    => 'required|string|min:3|max:50', 
                'kota'      => 'required|string|min:3|max:50', 
                'telepon'   => 'required|string|min:9|max:20', 
                'alamatWeb' => 'required|string|min:3|max:100', 
                'kategori'  => 'required|string|min:3|max:50',
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
            VendorModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data vendor berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $vendor = VendorModel::find($id);
        return view('admin.vendor.edit_ajax', ['vendor' => $vendor]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama'      => 'required|string|min:3|max:50', 
                'alamat'    => 'required|string|min:3|max:50', 
                'kota'      => 'required|string|min:3|max:50', 
                'telepon'   => 'required|string|min:9|max:20', 
                'alamatWeb' => 'required|string|min:3|max:100', 
                'kategori'  => 'required|string|min:3|max:50',
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
            $check = VendorModel::find($id);
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
        $vendor = VendorModel::find($id);
        return view('admin.vendor.confirm_ajax', ['vendor' => $vendor]);
    }
    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $vendor = VendorModel::find($id);
            if ($vendor) {
                $vendor->delete();
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
        $vendor = VendorModel::select('id_vendor', 'nama', 'alamat', 'kota', 'telepon', 'alamatWeb', 'kategori')
            ->orderBy('id_vendor')->orderBy('nama')
            ->get();

        $pdf = Pdf::loadView('admin.vendor.export_pdf', ['vendor' => $vendor]);
        $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url $pdf->render();
        return $pdf->stream('Data vendor ' . date('Y-m-d H:i:s') . '.pdf');
    }

    public function export_excel()
    {
        $vendor = VendorModel::select('id_vendor', 'nama', 'alamat', 'kota', 'telepon', 'alamatWeb', 'kategori')
            ->orderBy('id_vendor')
            ->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Vendor');
        $sheet->setCellValue('C1', 'ALamat vendor');
        $sheet->setCellValue('D1', 'Kota');
        $sheet->setCellValue('E1', 'Nomor Telepon');
        $sheet->setCellValue('F1', 'Alamat website');
        $sheet->setCellValue('G1', 'Kategori');

        $sheet->getStyle('A1:G1')->getFont()->setBold(true);

        $no = 1;
        // nomor data dimulai dari 1
        $baris = 2;
        // baris data dimulai dari baris ke 2
        foreach ($vendor as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->nama);
            $sheet->setCellValue('C' . $baris, $value->alamat);
            $sheet->setCellValue('D' . $baris, $value->kota);
            $sheet->setCellValue('E' . $baris, $value->telepon);
            $sheet->setCellValue('F' . $baris, $value->alamatWeb);
            $sheet->setCellValue('G' . $baris, $value->kategori);
            $baris++;
            $no++;
        }
        foreach (range('A', 'G') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        $sheet->setTitle('Data vendor');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data vendor ' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: cache, must-revalidate');
        header('Expires: Mon, 23 Nov 2024 05:00:00 GMT');
        header('Last-Modified:' . gmdate('D, dMY H:i:s') . 'GMT');
        header('Pragma: public');
        $writer->save('php://output');
        exit;
    }

    public function import()
    {
        return view('admin.vendor.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Validasi file harus berformat xlsx dan maksimal ukuran 1MB
            $rules = [
                'file_vendor' => ['required', 'mimes:xlsx', 'max:1024']
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
                $file = $request->file('file_vendor');
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
                            if ($value['A'] && $value['B'] && $value['C'] && $value['D'] && $value['E'] && $value['F'] && $value['G']) {
                                $insert[] = [
                                    'id_vendor' => $value['A'],
                                    'nama' => $value['B'],
                                    'alamat' => $value['C'],
                                    'kota' => $value['D'],
                                    'telepon' => $value['E'],
                                    'alamatWeb' => $value['F'],
                                    'kategori' => $value['G'],
                                    'updated_at' => now(),
                                    'created_at' => now(),
                                ];
                            }
                        }
                    }

                    if (count($insert) > 0) {
                        // Insert data ke database, jika data sudah ada, maka diabaikan
                        VendorModel::insertOrIgnore($insert);

                        return response()->json([
                            'status' => true,
                            'message' => 'Data vendor berhasil diimpor'
                        ]);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => 'Tidak ada data vendor yang valid untuk diimpor'
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