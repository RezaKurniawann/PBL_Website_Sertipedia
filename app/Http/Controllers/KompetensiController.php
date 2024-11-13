<?php

namespace App\Http\Controllers;
use App\Models\ProdiModel;

use Illuminate\Http\Request;

class KompetensiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kompetensi Prodi',
            'list' => ['Home', 'Kompetensi']
        ];

        $page = (object) [
            'title' => 'Daftar kompetensi prodi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-kompetensi';

        return view('admin.jurusan.kompetensi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
