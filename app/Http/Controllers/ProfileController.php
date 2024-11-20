<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Data pengguna (bisa diambil dari database atau model User)
        $user = [
            'nama' => 'Dr.Eng. Rosa Andire Asmara, ST, MT',
            'jabatan' => 'Ketua Jurusan',
            'nidn' => '0010108003',
            'email' => 'rosa_andrie@polinema.ac.id',
            'nomor_telepon' => '08********',
            'password' => '******',
        ];

        // Variabel activeMenu untuk menandai menu yang aktif
        $activeMenu = 'profile';
        $breadcrumb = (object) [
            'title' => 'Profil',
            'list' => ['Home', 'Profile']
        ];

        return view('profile.profile', compact('user', 'activeMenu', 'breadcrumb'));
    }
}
