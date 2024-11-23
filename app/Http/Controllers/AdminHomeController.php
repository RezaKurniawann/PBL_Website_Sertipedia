<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BidangMinaModelt;
use App\Models\BidangMinatModel;
use App\Models\ProdiModel;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Home Page',
            'list' => ['Home', 'HomePage']
        ];

        $page = (object) [
            'title' => 'Daftar Dosen Jurusan Teknologi Informasi'
        ];

        $users = User::all(); // Fetch all users
        $bidangMinats = BidangMinatModel::all(); // Fetch all bidang minat
        $prodis = ProdiModel::all(); // Fetch all prodi

        $activeMenu = 'HomePage';

        return view('admin.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'users' => $users,
            'bidangMinat' => $bidangMinats,
            'prodi' => $prodis,
            'activeMenu' => $activeMenu
        ]);
    }
}