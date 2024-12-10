<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\ProdiModel;
use App\Models\PangkatModel;
use App\Models\GolonganModel;
use App\Models\JabatanModel;
use App\Models\MataKuliahModel;
use App\Models\BidangMinatModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
        $users = UserModel::select('id_user', 'id_level', 'id_prodi', 'id_golongan', 'id_jabatan', 'id_pangkat', 'nama', 'email', 'no_telp', 'nip')
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
        $users = UserModel::with(['matakuliah', 'bidangminat'])->find($id);
        if ($users) {
            return view('admin.user.show_ajax', [
                'user' => $users,
                'matakuliah' => $users->matakuliah,
                'bidangminat' => $users->bidangminat
            ]);
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
        $matakuliah = MataKuliahModel::select('id_matakuliah', 'nama')->get();
        $bidangminat = BidangMinatModel::select('id_bidangminat', 'nama')->get();
        return view('admin.user.create_ajax')
            ->with('level', $level)
            ->with('prodi', $prodi)
            ->with('pangkat', $pangkat)
            ->with('golongan', $golongan)
            ->with('jabatan', $jabatan)
            ->with('matakuliah', $matakuliah)
            ->with('bidangminat', $bidangminat)
        ;
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama'       => 'required|string|min:3|max:100',
                'id_level'   => 'required|integer',
                'id_prodi'   => 'required|integer',
                'id_pangkat' => 'required|integer',
                'id_golongan' => 'required|integer',
                'id_jabatan' => 'required|integer',
                'email'      => 'required|email|max:50',
                'no_telp'    => 'required|string|max:15',
                'nip' => 'required|string|min:3|max:50|regex:/^[0-9]+$/',
                'password'   => 'required|string|min:5|max:20',
                'mata_kuliah' => 'required|array|min:1',
                'mata_kuliah.*' => 'required|integer|exists:m_matakuliah,id_matakuliah',
                'bidang_minat' => 'required|array|min:1',
                'bidang_minat.*' => 'required|integer|exists:m_bidangminat,id_bidangminat',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'    => false, // response status, false: error/gagal, true: berhasil
                    'message'   => 'Validasi Gagal',
                    'msgField'  => $validator->errors(), // pesan error validasi
                ]);
            }
            try {
                // Gunakan transaction untuk menjamin konsistensi data
                DB::beginTransaction();

                // Simpan data user dan dapatkan ID-nya
                $user = UserModel::create($request->all());
                $idUser = $user->id_user;
                foreach ($request->mata_kuliah as $idMatakuliah) {
                    DB::table('t_user_matakuliah')->insert([
                        'id_user' => $idUser,
                        'id_matakuliah' => $idMatakuliah,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                foreach ($request->bidang_minat as $idBidangMinat) {
                    DB::table('t_user_bidangminat')->insert([
                        'id_user' => $idUser,
                        'id_bidangminat' => $idBidangMinat,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Data user berhasil disimpan',
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ]);
            }
        }
        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $user = UserModel::with(['matakuliah', 'bidangminat'])->find($id);
        $level = LevelModel::select('id_level', 'nama')->get();
        $prodi = ProdiModel::select('id_prodi', 'nama')->get();
        $pangkat = PangkatModel::select('id_pangkat', 'nama')->get();
        $golongan = GolonganModel::select('id_golongan', 'nama')->get();
        $jabatan = JabatanModel::select('id_jabatan', 'nama')->get();
        $matakuliah = MataKuliahModel::select('id_matakuliah', 'nama')->get();
        $bidangminat = BidangMinatModel::select('id_bidangminat', 'nama')->get();


        return view('admin.user.edit_ajax', [
            'user' => $user,
            'level' => $level,
            'prodi' => $prodi,
            'pangkat' => $pangkat,
            'golongan' => $golongan,
            'jabatan' => $jabatan,
            'matakuliah' => $matakuliah,
            'bidangminat' => $bidangminat,

        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama'           => 'required|string|min:3|max:100',
                'id_level'       => 'required|integer',
                'id_prodi'       => 'required|integer',
                'id_pangkat'     => 'required|integer',
                'id_golongan'    => 'required|integer',
                'id_jabatan'     => 'required|integer',
                'email'          => 'required|email|max:50',
                'no_telp'        => 'required|string|max:15',
                'nip'            => 'required|string|min:3|max:50|regex:/^[0-9]+$/',
                'mata_kuliah'    => 'required|array|min:1',
                'mata_kuliah.*'  => 'required|integer|exists:m_matakuliah,id_matakuliah',
                'bidang_minat'   => 'required|array|min:1',
                'bidang_minat.*' => 'required|integer|exists:m_bidangminat,id_bidangminat',
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
            $user = UserModel::find($id);
            if ($user) {
                // Hapus data lama di tabel `t_user_matakuliah` dan `t_user_bidangminat`
                DB::table('t_user_matakuliah')->where('id_user', $id)->delete();
                DB::table('t_user_bidangminat')->where('id_user', $id)->delete();

                // Update data utama di tabel `user`
                $user->update([
                    'nama' => $request->input('nama'),
                    'id_level' => $request->input('id_level'),
                    'id_prodi' => $request->input('id_prodi'),
                    'id_pangkat' => $request->input('id_pangkat'),
                    'id_golongan' => $request->input('id_golongan'),
                    'id_jabatan' => $request->input('id_jabatan'),
                    'email' => $request->input('email'),
                    'no_telp' => $request->input('no_telp'),
                    'nip' => $request->input('nip'),
                ]);

                // Insert ulang data baru ke tabel `t_user_matakuliah`
                $timestamps = ['created_at' => now(), 'updated_at' => now()]; // Tambahkan timestamp
                foreach ($request->input('mata_kuliah') as $id_matakuliah) {
                    DB::table('t_user_matakuliah')->insert(array_merge([
                        'id_user' => $id,
                        'id_matakuliah' => $id_matakuliah,
                    ], $timestamps));
                }

                // Insert ulang data baru ke tabel `t_user_bidangminat`
                foreach ($request->input('bidang_minat') as $id_bidangminat) {
                    DB::table('t_user_bidangminat')->insert(array_merge([
                        'id_user' => $id,
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
    public function confirm_ajax(string $id)
    {
        $user = userModel::with(['matakuliah', 'bidangminat'])->find($id);
        return view('admin.user.confirm_ajax', [
            'user' => $user,
            'matakuliah' => $user->matakuliah,
            'bidangminat' => $user->bidangminat
        ]);
    }
    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $user = UserModel::find($id);
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
        // Mengambil data user dengan relasi yang relevan
        $user = UserModel::with(['level', 'prodi', 'pangkat', 'golongan', 'jabatan'])
            ->orderBy('id_level')
            ->orderBy('nama')
            ->orderBy('id_prodi')
            ->orderBy('id_pangkat')
            ->orderBy('id_golongan')
            ->orderBy('id_jabatan')
            ->get();

        // Generate PDF
        $pdf = Pdf::loadView('admin.user.export_pdf', ['user' => $user]);
        $pdf->setPaper('a4', 'landscape');
        // $pdf->setOption("isRemoteEnabled", true);

        // Stream hasil PDF
        return $pdf->stream('Laporan_Data_User_' . date('Y-m-d_H-i-s') . '.pdf');
    }


    public function export_excel()
    {
        $user = UserModel::with('level', 'prodi', 'pangkat', 'golongan', 'jabatan')
            ->orderBy('id_level')
            ->orderBy('nama')
            ->orderBy('id_prodi')
            ->orderBy('id_pangkat')
            ->orderBy('id_golongan')
            ->orderBy('id_jabatan')
            ->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'nip');
        $sheet->setCellValue('D1', 'Level');
        $sheet->setCellValue('E1', 'Prodi');
        $sheet->setCellValue('F1', 'Pangkat');
        $sheet->setCellValue('G1', 'Golongan');
        $sheet->setCellValue('H1', 'Jabatan');
        $sheet->setCellValue('I1', 'Email');
        $sheet->setCellValue('J1', 'Nomor Telepon');


        $sheet->getStyle('A1:J1')->getFont()->setBold(true);

        $no = 1;
        // nomor data dimulai dari 1
        $baris = 2;
        // baris data dimulai dari baris ke 2
        foreach ($user as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->nama);
            $sheet->setCellValue('C' . $baris, $value->level->nama);
            $sheet->setCellValue('D' . $baris, $value->nip);
            $sheet->setCellValue('E' . $baris, $value->prodi->nama);
            $sheet->setCellValue('F' . $baris, $value->pangkat->nama);
            $sheet->setCellValue('G' . $baris, $value->golongan->nama);
            $sheet->setCellValue('H' . $baris, $value->jabatan->nama);
            $sheet->setCellValue('I' . $baris, $value->email);
            $sheet->setCellValue('J' . $baris, $value->no_telp);
            $baris++;
            $no++;
        }
        foreach (range('A', 'J') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        $sheet->setTitle('Data User');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data User ' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: cache, must-revalidate');
        header('Expires: Mon, 23 Nov 2024 05:00:00 GMT');
        header('Last-Modified:' . gmdate('D, dMY H:i:s') . 'GMT');
        header('Pragma: public');
        $writer->save('php://output');
        exit;
    }

    // public function import()
    // {
    //     return view('admin.user.import');
    // }

    // public function import_ajax(Request $request)
    // {
    //     if ($request->ajax() || $request->wantsJson()) {
    //         // Validasi file harus berformat xlsx dan maksimal ukuran 1MB
    //         $rules = [
    //             'file_user' => ['required', 'mimes:xlsx', 'max:1024']
    //         ];
    //         $validator = Validator::make($request->all(), $rules);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Validasi Gagal',
    //                 'msgField' => $validator->errors()
    //             ]);
    //         }

    //         try {
    //             // Ambil file dari request
    //             $file = $request->file('file_user');
    //             $reader = IOFactory::createReader('Xlsx'); // Load reader file Excel
    //             $reader->setReadDataOnly(true); // Hanya membaca data
    //             $spreadsheet = $reader->load($file->getRealPath()); // Load file excel
    //             $sheet = $spreadsheet->getActiveSheet(); // Ambil sheet yang aktif
    //             $data = $sheet->toArray(null, false, true, true); // Ambil data Excel

    //             // Siapkan array untuk menampung data yang akan diinsert
    //             $insert = [];

    //             if (count($data) > 1) { // Jika data lebih dari 1 baris
    //                 foreach ($data as $baris => $value) {
    //                     if ($baris > 1) { // Baris ke-1 adalah header, maka lewati
    //                         // Pastikan semua kolom tidak kosong sebelum insert
    //                         if ($value['A'] && $value['B'] && $value['C'] && $value['D'] && $value['E'] && $value['F'] && $value['G']) {
    //                             $insert[] = [
    //                                 'id_user' => $value['A'],
    //                                 'nama' => $value['B'],
    //                                 'alamat' => $value['C'],
    //                                 'kota' => $value['D'],
    //                                 'telepon' => $value['E'],
    //                                 'alamatWeb' => $value['F'],
    //                                 'kategori' => $value['G'],
    //                                 'updated_at' => now(),
    //                                 'created_at' => now(),
    //                             ];
    //                         }
    //                     }
    //                 }

    //                 if (count($insert) > 0) {
    //                     // Insert data ke database, jika data sudah ada, maka diabaikan
    //                     userModel::insertOrIgnore($insert);

    //                     return response()->json([
    //                         'status' => true,
    //                         'message' => 'Data user berhasil diimpor'
    //                     ]);
    //                 } else {
    //                     return response()->json([
    //                         'status' => false,
    //                         'message' => 'Tidak ada data user yang valid untuk diimpor'
    //                     ]);
    //                 }
    //             } else {
    //                 return response()->json([
    //                     'status' => false,
    //                     'message' => 'File kosong atau tidak ada data yang diimpor'
    //                 ]);
    //             }
    //         } catch (\Exception $e) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage()
    //             ]);
    //         }
    //     }
    //     return redirect('/');
    // }
}
