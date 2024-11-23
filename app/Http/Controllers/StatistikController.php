<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Statistik',
            'list' => ['Home', 'Statistik']
        ];

        $page = (object) [
            'title' => 'Laporan Visualisasi'
        ];

        $activeMenu = 'statistik';

        return view('user.pimpinan.statistik', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
