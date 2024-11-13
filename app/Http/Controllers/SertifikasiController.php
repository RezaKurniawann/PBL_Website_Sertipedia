<?php

namespace App\Http\Controllers;
use App\Models\MataKuliahModel;
use App\Models\BidangMinatModel;
use App\Models\PeriodeModel;
use App\Models\VendorModel;

use Illuminate\Http\Request;

class SertifikasiController extends Controller
{
    public function index()
     {
         $breadcrumb = (object) [
             'title' => 'Daftar Sertifikasi',
             'list' => ['Home', 'Sertifikasi']
         ];
 
         $page = (object) [
             'title' => 'Daftar sertifikasi yang terdaftar dalam sistem'
         ];
 
         $activeMenu = 'manage-event';
         $activeSubMenu = 'sertifikasi';
         
         $matakuliah = MataKuliahModel::all();
         $bidangminat = BidangMinatModel::all();
         $periode = PeriodeModel::all();
         $vendor = VendorModel::all();
         
         return view('admin.event.sertifikasi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'matakuliah' => $matakuliah, 'bidangminat' => $bidangminat, 'periode' => $periode, 'vendor' => $vendor, 'activeMenu' => $activeMenu]);
     }
}
