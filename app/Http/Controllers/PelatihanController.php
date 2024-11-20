<?php

namespace App\Http\Controllers;
use App\Models\MataKuliahModel;
use App\Models\BidangMinatModel;
use App\Models\PeriodeModel;
use App\Models\VendorModel;

use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    public function index()
     {
         $breadcrumb = (object) [
             'title' => 'Daftar Pengajuan Sertifikasi dan Pelatihan',
             'list' => ['Home', 'Pelatihan']
         ];
 
         $page = (object) [
             'title' => 'Daftar pelatihan yang terdaftar dalam sistem'
         ];
 
         $activeMenu = 'manage-event'; 

         $matakuliah = MataKuliahModel::all();
         $bidangminat = BidangMinatModel::all();
         $periode = PeriodeModel::all();
         $vendor = VendorModel::all();
         
         return view('admin.event.pelatihan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'matakuliah' => $matakuliah, 'bidangminat' => $bidangminat, 'periode' => $periode, 'vendor' => $vendor, 'activeMenu' => $activeMenu]);
     }
}
