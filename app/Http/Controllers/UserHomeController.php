<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    public function index()
    {
        // Contoh data dosen
        $dosen = [
            [
                'nama' => 'Nama Dosen, S.ST., M.T.',
                'profesi' => 'Dosen Teknologi Informasi',
                'keahlian' => 'Artificial Intelligence',
                'foto' => 'images/profile-placeholder.png'
            ],
            [
                'nama' => 'Nama Dosen, S.ST., M.T.',
                'profesi' => 'Guru Besar',
                'keahlian' => 'Data Science',
                'foto' => 'images/profile-placeholder.png'
            ],
            [
                'nama' => 'Nama Dosen, S.ST., M.T.',
                'profesi' => 'Dosen Teknik Informatika',
                'keahlian' => 'Network Security',
                'foto' => 'images/profile-placeholder.png'
            ],
            [
                'nama' => 'Nama Dosen, S.ST., M.T.',
                'profesi' => 'Dosen Sistem Informasi',
                'keahlian' => 'Enterprise Systems',
                'foto' => 'images/profile-placeholder.png'
            ],
            [
                'nama' => 'Nama Dosen, S.ST., M.T.',
                'profesi' => 'Dosen Teknik Informatika',
                'keahlian' => 'Web Development',
                'foto' => 'images/profile-placeholder.png'
            ],
            [
                'nama' => 'Nama Dosen, S.ST., M.T.',
                'profesi' => 'Dosen Multimedia',
                'keahlian' => 'Graphic Design',
                'foto' => 'images/profile-placeholder.png'
            ],
            [
                'nama' => 'Nama Dosen, S.ST., M.T.',
                'profesi' => 'Dosen Teknologi Informasi',
                'keahlian' => 'Mobile Development',
                'foto' => 'images/profile-placeholder.png'
            ],
            [
                'nama' => 'Nama Dosen, S.ST., M.T.',
                'profesi' => 'Dosen Sistem Informasi',
                'keahlian' => 'Database Management',
                'foto' => 'images/profile-placeholder.png'
            ],
            [
                'nama' => 'Nama Dosen, S.ST., M.T.',
                'profesi' => 'Dosen Teknik Informatika',
                'keahlian' => 'Cloud Computing',
                'foto' => 'images/profile-placeholder.png'
            ],
            [
                'nama' => 'Nama Dosen, S.ST., M.T.',
                'profesi' => 'Dosen Sistem Informasi Bisnis',
                'keahlian' => 'Big Data Analytics',
                'foto' => 'images/profile-placeholder.png'
            ],
        ];

         // Variabel activeMenu untuk menandai menu yang aktif
         $activeMenu = 'home';
         $breadcrumb = (object) [
            'title' => 'Home',
            'list' => ['Home', 'home']
        ];

        return view('user.index', compact('dosen', 'activeMenu', 'breadcrumb'));
    }
}