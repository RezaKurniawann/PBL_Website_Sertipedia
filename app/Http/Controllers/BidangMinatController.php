<?php

namespace App\Http\Controllers;

use App\Models\BidangMinatModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BidangMinatController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar bidangminat',
            'list' => ['Home', 'bidangminat']
        ];

        $page = (object) [
            'title' => 'Daftar bidangminat yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage/jurusan-user';

        return view('admin.jurusan.bidangminat.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $bidangminat = BidangMinatModel::select('id_bidangminat', 'nama');

        return DataTables::of($bidangminat)
            ->addIndexColumn()
            ->addColumn('aksi', function ($bidangminat) {
                $btn = '<button onclick="modalAction(\'' . url('manage/jurusan/bidangminat/' . $bidangminat->id_bidangminat . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/jurusan/bidangminat/' . $bidangminat->id_bidangminat . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/jurusan/bidangminat/' . $bidangminat->id_bidangminat . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax(string $id)
    {
        $bidangminat = BidangMinatModel::find($id);
        if ($bidangminat) {
            return view('admin.jurusan.bidangminat.show', ['bidangminat' => $bidangminat]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function create_ajax()
    {
        return view('admin.jurusan.bidangminat.create');
    }

    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama'    => 'required|string|max:100',
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'    => false, // response status, false: error/gagal, true: berhasil
                    'message'   => 'Validasi Gagal',
                    'msgField'  => $validator->errors(), // pesan error validasi
                ]);
            }
            BidangMinatModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data bidangminat berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $bidangminat = BidangMinatModel::find($id);
        return view('admin.jurusan.bidangminat.edit', ['bidangminat' => $bidangminat]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => 'required|max:100'
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }
            $check = BidangMinatModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
    public function confirm_ajax(string $id)
    {
        $bidangminat = BidangMinatModel::find($id);
        return view('admin.jurusan.bidangminat.confirm', ['bidangminat' => $bidangminat]);
    }
    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $bidangminat = BidangMinatModel::find($id);
            if ($bidangminat) {
                $bidangminat->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
}
