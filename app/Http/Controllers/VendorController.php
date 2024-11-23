<?php

namespace App\Http\Controllers;

use App\Models\PelatihanModel;
use App\Models\SertifikasiModel;
use App\Models\VendorModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
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

        return view('admin.vendor.index', compact('breadcrumb', 'page', 'activeMenu'));
    }
 }

 