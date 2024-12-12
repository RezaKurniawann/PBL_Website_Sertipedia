<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\SertifikasiModel;
use App\Models\PelatihanModel;
use App\Models\DetailSertifikasiModel;
use App\Models\DetailPelatihanModel;

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
        
        // Dapatkan jumlah user, sertifikasi, pelatihan
        $userCount = UserModel::count();
        $sertifikasiCount = SertifikasiModel::count();
        $pelatihanCount = PelatihanModel::count();
        // Menghitung status sertifikasi
        $statusList = ['requested', 'rejected', 'accepted', 'on going', 'completed'];
        $sertifikasiStatusCount = [];
        $pelatihanStatusCount = [];

        foreach ($statusList as $status) {
            $sertifikasiStatusCount[$status] = DetailSertifikasiModel::where('status', $status)->count();
            $pelatihanStatusCount[$status] = DetailPelatihanModel::where('status', $status)->count();
        }

        return view('user.pimpinan.statistik', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'userCount' => $userCount,
            'sertifikasiCount' => $sertifikasiCount,
            'pelatihanCount' => $pelatihanCount,
            'sertifikasiStatusCount' => $sertifikasiStatusCount,
            'pelatihanStatusCount' => $pelatihanStatusCount,
        ]);
    }
}
