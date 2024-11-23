<?php

namespace App\Http\Controllers;

use App\Models\VendorModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;

class VendorController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Vendor',
            'list' => ['Home', 'Vendor']
        ];

        $page = (object) [
            'title' => 'Daftar Vendor yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-vendor';
        $vendor = VendorModel::all();

        return view('admin.vendor.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $vendor = VendorModel::select('id_vendor', 'nama', 'alamat', 'kota', 'telepon', 'alamatWeb', 'kategori');

        return DataTables::of($vendor)
            ->addIndexColumn()
            ->addColumn('aksi', function ($vendor) {
                $btn = '<button onclick="modalAction(\''.url('manage/vendor/' . $vendor->id_vendor .'/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/vendor/' . $vendor->id_vendor . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/vendor/' . $vendor->id_vendor . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax(string $id)
    {
        $vendor = VendorModel::find($id);
        if ($vendor) {
            return view('admin.vendor.show_ajax', ['vendor' => $vendor]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }
}