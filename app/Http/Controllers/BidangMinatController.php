<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BidangMinatController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Bidang Minat',
            'list' => ['Home', 'Bidang Minat']
        ];

        $page = (object) [
            'title' => 'Daftar bidang minat yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-bidangminat';

        return view('admin.jurusan.bidangminat.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
