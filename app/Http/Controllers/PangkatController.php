<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PangkatController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pangkat',
            'list' => ['Home', 'Pangkat']
        ];

        $page = (object) [
            'title' => 'Daftar Pangkat yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-user';

        return view('admin.pangkat.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
