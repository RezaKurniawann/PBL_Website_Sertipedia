<?php

namespace App\Http\Controllers;

use App\Models\MataKuliahModel;
use App\Models\BidangMinatModel;
use App\Models\UserModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Home Page',
            'list' => ['Home', 'HomePage']
        ];

        $page = (object) [
            'title' => 'Dosen Jurusan Teknologi Informasi'
        ];

        $users = UserModel::with(['prodi', 'bidangMinat', 'mataKuliah'])->get();

        $activeMenu = 'manage-admin';

        return view('admin.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'users' => $users,
            'activeMenu' => $activeMenu
        ]);
    }    
    public function list(Request $request)
    {
        $user = UserModel::with([
            'level',
            'prodi',
            'pangkat',
            'golongan',
            'jabatan',
            'mataKuliah',
            'bidangMinat',
            'sertifikasi' => function ($query) {
                $query->select(
                    'id_detail_sertifikasi',
                    'id_user',
                    'id_sertifikasi',
                    'status',
                    'no_sertifikasi',
                    'image',
                    'surat_tugas',
                    'created_at',
                    'updated_at'
                );
            }
        ]);

        if ($request->id_level) {
            $user->where('id_level', $request->id_level);
        }

        $users = $user->get();

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }
}