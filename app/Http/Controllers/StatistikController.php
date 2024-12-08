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

        $activeMenu = 'statistik';

        // Dapatkan jumlah user dan sertifikasi
        $userCount = UserModel::count();
        $sertifikasiCount = SertifikasiModel::count();
        $pelatihanCount = PelatihanModel::count();
        $sertifikasiOnGoingCount = DetailSertifikasiModel::where('status', 'on going')->count();
        $sertifikasiFinishedCount = DetailSertifikasiModel::where('status', 'finished')->count();
        $pelatihanOnGoingCount = DetailPelatihanModel::where('status', 'on going')->count();
        $pelatihanFinishedCount = DetailPelatihanModel::where('status', 'Finished')->count();

        return view('user.pimpinan.statistik', [
            'breadcrumb' => $breadcrumb, 
            'activeMenu' => $activeMenu,
            'userCount' => $userCount, 
            'sertifikasiCount' => $sertifikasiCount,
            'pelatihanCount' => $pelatihanCount,
            'sertifikasiOnGoingCount' => $sertifikasiOnGoingCount,
            'sertifikasiFinishedCount' => $sertifikasiFinishedCount,
            'pelatihanOnGoingCount' => $pelatihanOnGoingCount,
            'pelatihanFinishedCount' => $pelatihanFinishedCount
        ]);
    }
}
