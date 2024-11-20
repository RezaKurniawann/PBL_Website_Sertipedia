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
                'nama' => 'Nama Dosen, S.ST., MT.',
                'profesi' => 'lorem ipsum',
                'keahlian' => 'lorem ipsum',
                'foto' => 'images/profile-placeholder.png' // Path gambar default
            ],
            [
                'nama' => 'Nama Dosen, S.ST., MT.',
                'profesi' => 'lorem ipsum',
                'keahlian' => 'lorem ipsum',
                'foto' => 'images/profile-placeholder.png'
            ],
            // Tambahkan data dosen lainnya
        ];

        return view('user.index', compact('dosen'));
    }
}