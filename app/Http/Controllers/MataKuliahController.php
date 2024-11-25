<?php

namespace App\Http\Controllers;

use App\Models\matakuliahModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class matakuliahController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar matakuliah',
            'list' => ['Home', 'matakuliah']
        ];

        $page = (object) [
            'title' => 'Daftar matakuliah yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage/jurusan-user';

        return view('admin.jurusan.matakuliah.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $matakuliah = matakuliahModel::select('id_matakuliah', 'nama');

        return DataTables::of($matakuliah)
            ->addIndexColumn()
            ->addColumn('aksi', function ($matakuliah) {
                $btn = '<button onclick="modalAction(\'' . url('manage/jurusan/matakuliah/' . $matakuliah->id_matakuliah . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/jurusan/matakuliah/' . $matakuliah->id_matakuliah . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/jurusan/matakuliah/' . $matakuliah->id_matakuliah . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax(string $id)
    {
        $matakuliah = matakuliahModel::find($id);
        if ($matakuliah) {
            return view('admin.jurusan.matakuliah.show', ['matakuliah' => $matakuliah]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function create_ajax()
    {
        return view('admin.jurusan.matakuliah.create');
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
            matakuliahModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data matakuliah berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $matakuliah = matakuliahModel::find($id);
        return view('admin.jurusan.matakuliah.edit', ['matakuliah' => $matakuliah]);
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
            $check = matakuliahModel::find($id);
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
        $matakuliah = matakuliahModel::find($id);
        return view('admin.jurusan.matakuliah.confirm', ['matakuliah' => $matakuliah]);
    }
    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $matakuliah = matakuliahModel::find($id);
            if ($matakuliah) {
                $matakuliah->delete();
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
