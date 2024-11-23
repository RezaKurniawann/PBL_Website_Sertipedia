<?php

namespace App\Http\Controllers;

use App\Models\BidangMinatModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BidangMinatController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Bidang Minat',
            'list' => ['Home', 'Bidang Minat']
        ];

        $page = (object) [
            'title' => 'Daftar bidang minat yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage.bidangminat';

        return view('admin.jurusan.bidangminat.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $bidangminat = BidangMinatModel::select('nama')->with('nama');

        return DataTables::of($bidangminat)
            ->addIndexColumn()
            ->addColumn('aksi', function ($bidangminat) {
                $btn = '<button onclick="modalAction(\'' . url('/bidangminat/' . $bidangminat->id_bidangminat . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/bidangminat/' . $bidangminat->id_bidangminat . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/bidangminat/' . $bidangminat->id_bidangminat . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
