<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];
        $activeMenu = 'home';

        return view('user.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
