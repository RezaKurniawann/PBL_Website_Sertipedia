<?php

namespace App\Http\Controllers;
use App\Models\UserModel;
use App\Models\DetailPelatihanModel;
use App\Models\DetailSertifikasiModel;

use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
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

    public function show($id)
    {
        $user = UserModel::with(['prodi', 'bidangMinat', 'mataKuliah'])->findOrFail($id);

        $pelatihan = DetailPelatihanModel::where('id_user', $id)
            ->with('pelatihan') 
            ->get();

        $sertifikasi = DetailSertifikasiModel::where('id_user', $id)
            ->with('sertifikasi')  
            ->get();

    return view('admin.show', compact('user', 'pelatihan', 'sertifikasi'));
    }

}
