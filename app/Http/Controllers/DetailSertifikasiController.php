<?php

namespace App\Http\Controllers;

use App\Models\SertifikasiModel;
use App\Models\UserModel;

use Illuminate\Http\Request;

class DetailSertifikasiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Detail Sertifikasi',
            'list' => ['Home', 'Detail Sertifikasi']
        ];

        $page = (object) [
            'title' => 'Daftar detail Sertifikasi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-detailevent';

        $user = UserModel::all();
        $sertifikasi = SertifikasiModel::all();

        return view('admin.detailEvent.Sertifikasi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'Sertifikasi' => $sertifikasi, 'activeMenu' => $activeMenu]);
    }
}
