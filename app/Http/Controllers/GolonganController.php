<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GolonganController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Golongan',
            'list' => ['Home', 'Golongan']
        ];

        $page = (object) [
            'title' => 'Daftar Golongan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-user';

        return view('admin.golongan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
