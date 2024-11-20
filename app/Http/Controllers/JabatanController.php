<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Jabatan',
            'list' => ['Home', 'Jabatan']
        ];

        $page = (object) [
            'title' => 'Daftar Jabatan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-jabatan';

        return view('admin.jabatan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
