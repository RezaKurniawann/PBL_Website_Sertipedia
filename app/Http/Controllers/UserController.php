<?php
namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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

        return DataTables::of($users)
            ->addIndexColumn()
            ->make(true);
    }

    public function create()
    {
        return view('admin.user.create_ajax');
    }

    public function edit($id)
    {
        $user = UserModel::findOrFail($id);
        return view('admin.user.edit_ajax', compact('user'));
    }
}