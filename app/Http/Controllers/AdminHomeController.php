<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\PelatihanModel;

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

    // Fungsi untuk menampilkan detail user
    public function show($id)
    {
        $user = UserModel::with(['prodi', 'bidangMinat', 'mataKuliah'])->find($id);

        return view('admin.show', compact('user'));
    }
}
