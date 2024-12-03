<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\DetailPelatihanModel;
use App\Models\DetailSertifikasiModel;

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

        $users = UserModel::with(['prodi', 'bidangMinat'])->get();

        $activeMenu = 'manage-user';

        return view('user.index', [
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
        $user = UserModel::with(['prodi', 'mataKuliah', 'bidangMinat', 'jabatan', 'pangkat', 'Golongan'])->find($id_user);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found');
        }

        $pelatihan = DetailPelatihanModel::where('id_user', $id_user)
            ->with('pelatihan')
            ->get();

        $sertifikasi = DetailSertifikasiModel::where('id_user', $id_user)
        ->with('sertifikasi')
        ->get();

        return view('user.show', compact('user', 'pelatihan', 'sertifikasi', 'activeMenu', 'breadcrumb'));
    }

}