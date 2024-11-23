<?php

namespace App\Http\Controllers;

use App\Models\PangkatModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PangkatController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pangkat',
            'list' => ['Home', 'Pangkat']
        ];

        $page = (object) [
            'title' => 'Daftar Pangkat yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-user';

        return view('admin.pangkat.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $pangkat = PangkatModel::select('id_pangkat', 'nama');

        return DataTables::of($pangkat)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pangkat) {
                $btn = '<button onclick="modalAction(\''.url('manage/pangkat/' . $pangkat->id_pangkat .'/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/pangkat/' . $pangkat->id_pangkat . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/pangkat/' . $pangkat->id_pangkat . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax(string $id)
    {
        $pangkat = PangkatModel::find($id);
        if ($pangkat) {
            return view('admin.pangkat.show_ajax', ['pangkat' => $pangkat]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }
}