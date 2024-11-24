<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\ProdiModel;
use App\Models\PangkatModel;
use App\Models\GolonganModel;
use App\Models\JabatanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-user';
        $level = LevelModel::all();

        return view('admin.user.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'level' => $level, 
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $users = UserModel::select('id_user', 'id_level', 'id_prodi', 'id_golongan', 'id_jabatan', 'id_pangkat', 'nama', 'email', 'no_telp', 'username')
            ->with('level', 'prodi', 'pangkat', 'golongan', 'jabatan');
        // Filter data user berdasarkan level_id
        if ($request->id_level) {
            $users->where('id_level', $request->id_level);
        }
        return DataTables::of($users)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom:DT_RowIndex) 
            ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
                $btn = '<button onclick="modalAction(\'' . url('manage/user/' . $user->id_user .
                    '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/user/' . $user->id_user .
                    '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/user/' . $user->id_user .
                    '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
            ->make(true);
    } 

    public function show_ajax(string $id)
    {
        $users = UserModel::find($id);
        if ($users) {
            return view('admin.user.show_ajax', ['user' => $users]);

        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function create_ajax()
    {
        $level = LevelModel::select('id_level', 'nama')->get();
        $prodi = ProdiModel::select('id_prodi', 'nama')->get();
        $pangkat = PangkatModel::select('id_pangkat', 'nama')->get();
        $golongan = GolonganModel::select('id_golongan', 'nama')->get();
        $jabatan = JabatanModel::select('id_jabatan', 'nama')->get();

        return view('admin.user.create_ajax')
            ->with('level', $level)
            ->with('prodi', $prodi)
            ->with('pangkat', $pangkat)
            ->with('golongan', $golongan)
            ->with('jabatan', $jabatan);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama'       => 'required|string|min:3|max:100',
                'id_level'   => 'required|integer',
                'id_prodi'   => 'required|integer',
                'id_pangkat' => 'required|integer',
                'id_golongan'=> 'required|integer',
                'id_jabatan' => 'required|integer',
                'email'      => 'required|email|max:50',
                'no_telp'    => 'required|string|max:15',
                'username' => 'required|string|min:3|max:50|regex:/^[0-9]+$/',
                'password'   => 'required|string|min:5|max:20'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'    => false, // response status, false: error/gagal, true: berhasil
                    'message'   => 'Validasi Gagal',
                    'msgField'  => $validator->errors(), // pesan error validasi
                ]);
            }
            UserModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data level berhasil disimpan'
            ]);
        }

        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::select('id_level', 'nama')->get();
        $prodi = ProdiModel::select('id_prodi', 'nama')->get();
        $pangkat = PangkatModel::select('id_pangkat', 'nama')->get();
        $golongan = GolonganModel::select('id_golongan', 'nama')->get();
        $jabatan = JabatanModel::select('id_jabatan', 'nama')->get();

        return view('admin.user.edit_ajax', [
            'user' => $user,
            'level' => $level,
            'prodi' => $prodi,
            'pangkat' => $pangkat,
            'golongan' => $golongan,
            'jabatan' => $jabatan,
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama'       => 'required|string|min:3|max:100',
                'id_level'   => 'required|integer',
                'id_prodi'   => 'required|integer',
                'id_pangkat' => 'required|integer',
                'id_golongan'=> 'required|integer',
                'id_jabatan' => 'required|integer',
                'email'      => 'required|email|max:50',
                'no_telp'    => 'required|string|max:15',
                'username'   => 'required|string|min:3|max:50|regex:/^[0-9]+$/',
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
            $check = userModel::find($id);
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
        $user = userModel::find($id);
        return view('admin.user.confirm_ajax', ['user' => $user]);
    }
    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $user = userModel::find($id);
            if ($user) {
                $user->delete();
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
        $user = UserModel::with(['level', 'prodi', 'pangkat', 'golongan', 'jabatan'])
            ->orderBy('id_user')
            ->get();

        $pdf = Pdf::loadView('admin.user.export_pdf', ['user' => $user]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption("isRemoteEnabled", true);
        return $pdf->stream('Data user ' . date('Y-m-d H:i:s') . '.pdf');
    }


    public function export_excel()
    {
        $user = UserModel::with('level', 'prodi', 'pangkat', 'golongan', 'jabatan','id_pangkat', 'nama', 'email', 'no_telp', 'username')
            ->orderBy('id_level')
            ->orderBy('id_prodi')
            ->orderBy('id_pangkat')
            ->orderBy('id_golongan')
            ->orderBy('id_jabatan')
            ->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Level');
        $sheet->setCellValue('D1', 'Prodi');
        $sheet->setCellValue('E1', 'Pangkat');
        $sheet->setCellValue('F1', 'Golongan');
        $sheet->setCellValue('G1', 'Jabatan');
        $sheet->setCellValue('H1', 'Email');
        $sheet->setCellValue('I1', 'Nomor Telepon');
        $sheet->setCellValue('J1', 'Username');


        $sheet->getStyle('A1:J1')->getFont()->setBold(true);

        $no = 1;
        // nomor data dimulai dari 1
        $baris = 2;
        // baris data dimulai dari baris ke 2
        foreach ($user as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->nama);
            $sheet->setCellValue('C' . $baris, $value->level);
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
        $sheet->setTitle('Data user');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data user ' . date('Y-m-d H:i:s') . '.xlsx';

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
        return view('admin.user.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Validasi file harus berformat xlsx dan maksimal ukuran 1MB
            $rules = [
                'file_user' => ['required', 'mimes:xlsx', 'max:1024']
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
                $file = $request->file('file_user');
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
                                    'id_user' => $value['A'],
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
                        userModel::insertOrIgnore($insert);

                        return response()->json([
                            'status' => true,
                            'message' => 'Data user berhasil diimpor'
                        ]);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => 'Tidak ada data user yang valid untuk diimpor'
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