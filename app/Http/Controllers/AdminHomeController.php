<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];
        $activeMenu = 'home';
        
        return view('admin.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}

