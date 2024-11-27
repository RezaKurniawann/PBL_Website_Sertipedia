<?php

namespace App\Http\Controllers;
use App\Models\MataKuliahModel;
use App\Models\BidangMinatModel;
use App\Models\PeriodeModel;
use App\Models\VendorModel;

use Illuminate\Http\Request;

class VerifikasiSertifikasiController extends Controller
{
    public function index()
     {
         $breadcrumb = (object) [
             'title' => 'Daftar Pengajuan Sertifikasi',
             'list' => ['Home', 'Sertifikasi']
         ];
 
         $page = (object) [
             'title' => 'Daftar Pengajuan Sertifikasi'
         ];
 
         $activeMenu = 'verifikasi';
         $activeSubMenu = 'sertifikasi';
         
         $matakuliah = MataKuliahModel::all();
         $bidangminat = BidangMinatModel::all();
         $periode = PeriodeModel::all();
         $vendor = VendorModel::all();
         
         return view('user.pimpinan.verifikasi.sertifikasi', ['breadcrumb' => $breadcrumb, 'page' => $page, 'matakuliah' => $matakuliah, 'bidangminat' => $bidangminat, 'periode' => $periode, 'vendor' => $vendor, 'activeMenu' => $activeMenu]);
     }
}
