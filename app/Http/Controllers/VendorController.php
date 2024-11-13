<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
     {
         $breadcrumb = (object) [
             'title' => 'Daftar Vendor',
             'list' => ['Home', 'Vendor']
         ];
 
         $page = (object) [
             'title' => 'Daftar vendor yang terdaftar dalam sistem'
         ];
 
         $activeMenu = 'manage-vendor';
 
         return view('admin.vendor.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
     }
}
