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
        return view('admin.user.create_ajax', ['level' => $level, 'prodi' => $prodi, 'pangkat' => $pangkat, 'golongan' => $golongan, 'jabatan' => $jabatan]);
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
                'username'   => 'required|numeric|min:3|max:50',
                'password'   => 'required|string|min:5|max:50'
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


//     public function edit_ajax(string $id)
//     {
//         $level = LevelModel::find($id);
//         return view('admin.level.edit', ['level' => $level]);
//     }

//     public function update_ajax(Request $request, $id)
//     {
//         if ($request->ajax() || $request->wantsJson()) {
//             $rules = [
//                 'kode' => 'required|max:20|unique:m_level,kode,' . $id . ',id_level',
//                 'nama' => 'required|max:100'
//             ];
//             // use Illuminate\Support\Facades\Validator;
//             $validator = Validator::make($request->all(), $rules);
//             if ($validator->fails()) {
//                 return response()->json([
//                     'status' => false, // respon json, true: berhasil, false: gagal
//                     'message' => 'Validasi gagal.',
//                     'msgField' => $validator->errors() // menunjukkan field mana yang error
//                 ]);
//             }
//             $check = LevelModel::find($id);
//             if ($check) {
//                 $check->update($request->all());
//                 return response()->json([
//                     'status' => true,
//                     'message' => 'Data berhasil diupdate'
//                 ]);
//             } else {
//                 return response()->json([
//                     'status' => false,
//                     'message' => 'Data tidak ditemukan'
//                 ]);
//             }
//         }
//         return redirect('/');
//     }
}