<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\DetailPelatihanModel;
use App\Models\DetailSertifikasiModel;

class AdminHomeController extends Controller
{
    // Fungsi untuk halaman utama admin
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

    public function show($id_user)
    {
        $breadcrumb = (object)[
            'title' => 'Home Page',
            'list' => ['Home', 'HomePage', 'Detail']
        ];

        $activeMenu = 'home';
        $user = UserModel::with(['prodi', 'mataKuliah', 'bidangMinat'])->find($id_user);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found');
        }

        $pelatihan = DetailPelatihanModel::where('id_user', $id_user)
            ->with('pelatihan')
            ->get();

        $sertifikasi = DetailSertifikasiModel::where('id_user', $id_user)
        ->with('sertifikasi')
        ->get();

        return view('admin.show', compact('user', 'pelatihan', 'sertifikasi', 'activeMenu', 'breadcrumb'));
    }

}