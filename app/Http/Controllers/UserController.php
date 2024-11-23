<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\ProdiModel;
use App\Models\PangkatModel;
use App\Models\GolonganModel;
use App\Models\JabatanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
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
        $users = UserModel::select('id_user', 'id_level', 'id_prodi', 'id_pangkat', 'id_golongan', 'id_jabatan', 'nama', 'email', 'no_telp', 'username', 'password', 'image')
            ->with(['level', 'prodi', 'pangkat', 'golongan', 'jabatan']); // Pastikan relasi sudah dimuat
    
        if ($request->id_level) {
            $users->where('id_level', $request->id_level);
        }
    
        return DataTables::of($users)
            ->addIndexColumn() // Menambahkan kolom index
            ->addColumn('level', function ($user) {
                return $user->level ? $user->level->nama : '-';
            })
            ->addColumn('prodi', function ($user) {
                return $user->prodi ? $user->prodi->nama : '-';
            })
            ->addColumn('pangkat', function ($user) {
                return $user->pangkat ? $user->pangkat->nama : '-';
            })
            ->addColumn('golongan', function ($user) {
                return $user->golongan ? $user->golongan->nama : '-';
            })
            ->addColumn('jabatan', function ($user) {
                return $user->jabatan ? $user->jabatan->nama : '-';
            })
            ->addColumn('aksi', function ($user) {
                $btn = '<button onclick="modalAction(\'' . url('/user/' . $user->id_user . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->id_user . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->id_user . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }
    

    public function create_ajax()
    {
        $level = LevelModel::select('id_level', 'nama')->get();
        $prodi = ProdiModel::select('id_prodi', 'nama')->get();  // Ambil data Prodi
        $pangkat = PangkatModel::select('id_pangkat', 'nama')->get();  // Ambil data Pangkat
        $golongan = GolonganModel::select('id_golongan', 'nama')->get();  // Ambil data Golongan
        $jabatan = JabatanModel::select('id_jabatan', 'nama')->get();  // Ambil data Jabatan

        return view('admin.user.create_ajax', [
            'level' => $level, 
            'prodi' => $prodi, 
            'pangkat' => $pangkat, 
            'golongan' => $golongan, 
            'jabatan' => $jabatan
        ]);
    }

    public function edit_ajax(string $id)
    {
        // Memuat data user beserta relasi dengan level, prodi, pangkat, golongan, dan jabatan
        $user = UserModel::with(['level', 'prodi', 'pangkat', 'golongan', 'jabatan'])->find($id);

        // Menyiapkan data yang dibutuhkan untuk form
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
            'jabatan' => $jabatan
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_user' => 'required|integer',
                'id_level' => 'required|integer',
                'id_prodi' => 'required|integer',
                'id_pangkat' => 'required|integer',
                'id_golongan' => 'required|integer',
                'id_jabatan' => 'required|integer',
                'nama' => 'required|max:100',
                'username' => 'required|max:20|unique:m_user,username,' . $id . ',user_id',
                'password' => 'nullable|255',
                'image' => 'nullable|255',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $check = UserModel::find($id);
            if ($check) {
                if (!$request->filled('password')) {
                    $request->request->remove('password');
                }
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
    }

    public function confirm_ajax(string $id)
    {
        $user = UserModel::find($id);
        return view('admin.user.confirm_ajax', ['user' => $user]);
    }

    public function delete_ajax(Request $request, $id)
    {
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
}
