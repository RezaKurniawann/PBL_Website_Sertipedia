<?php

namespace App\Http\Controllers;
use App\Models\MataKuliahModel;
use App\Models\BidangMinatModel;
use App\Models\PeriodeModel;
use App\Models\VendorModel;
use App\Models\PelatihanModel; // Tambahkan Model untuk m_pelatihan
use App\Models\DetailPelatihanModel;

use Illuminate\Http\Request;

class VerifikasiPelatihanController extends Controller
{
    public function index()
     {
         $breadcrumb = (object) [
             'title' => 'Daftar Pengajuan Pelatihan',
             'list' => ['Home', 'Pelatihan']
         ];
 
         $page = (object) [
             'title' => 'Daftar Pengajuan Pelatihan'
         ];
 
         $activeMenu = 'verifikasi';
         $activeSubMenu = 'pelatihan';
         
         $matakuliah = MataKuliahModel::all();
         $bidangminat = BidangMinatModel::all();
         $periode = PeriodeModel::all();
         $vendor = VendorModel::all();
         
         return view('user.pimpinan.verifikasi.pelatihan', ['breadcrumb' => $breadcrumb, 'page' => $page, 'matakuliah' => $matakuliah, 'bidangminat' => $bidangminat, 'periode' => $periode, 'vendor' => $vendor, 'activeMenu' => $activeMenu]);
     }
}
