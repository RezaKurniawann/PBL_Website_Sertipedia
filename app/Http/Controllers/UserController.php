<?php
namespace App\Http\Controllers;

use App\Models\LevelModel;
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
        $users = UserModel::select('id_level', 'id_prodi', 'nama', 'email', 'no_telp', 'username', 'image')
            ->with(['level', 'prodi']);

        if ($request->id_level) {
            $users->where('id_level', $request->id_level);
        }
        return DataTables::of($users)
            ->addIndexColumn()// menambahkan kolom index / no urut (default nama kolom:DT_RowIndex) 
            ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
                $btn = '<button onclick="modalAction(\'' . url('/user/' . $user->user_id .
                    '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id .
                    '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id .
                    '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
            ->make(true);
    }

    public function create_ajax()
    {
        $level  = LevelModel::select('id_level', 'nama')->get();

        return view('admin.user.create_ajax')
        ->with('level', $level);
    }

    public function edit_ajax(string $id)
    {
        $user = UserModel::with(['user.level'])->find($id);
        $level = LevelModel::select('id_level', 'nama')->get();

        // dd($transaksi->user);
        return view('admin.user.edit_ajax', ['user' => $user, 'level' => $level]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_user' => 'required|integer',
                'id_level' => 'required|integer',
                'id_prodi' => 'required|integer',
                'nama' => 'required|max:100',
                'username' => 'required|max:20|unique:m_user,username,' . $id . ',user_id',
                'password' => 'nullable|255',
                'image' => 'nullable|255',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }
            $check = UserModel::find($id);
            if ($check) {
                if (!$request->filled('password')) { // jika password tidak diisi, maka hapus dari request
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
}