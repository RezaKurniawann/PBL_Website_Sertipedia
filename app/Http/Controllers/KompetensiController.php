<?php

namespace App\Http\Controllers;

use App\Models\KompetensiModel;
use App\Models\ProdiModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KompetensiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kompetensi Prodi',
            'list' => ['Home', 'Kompetensi']
        ];

        $page = (object) [
            'title' => 'Daftar kompetensi prodi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-jurusan';

        // Ambil data prodi prodi untuk filter
        $prodi = ProdiModel::all();

        // Ambil data kompetensi beserta relasi dengan prodi
        $kompetensi = KompetensiModel::with('prodi')->get();

        return view('admin.jurusan.kompetensi.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'prodi' => $prodi, // Kirim data ke view untuk dropdown filter
            'kompetensi' => $kompetensi // Kirim data ke view untuk ditampilkan di tabel
        ]);
    }

    public function index_pimpinan()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kompetensi Prodi',
            'list' => ['Home', 'Kompetensi']
        ];

        $page = (object) [
            'title' => 'Daftar kompetensi prodi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'kompetensi';

        // Ambil data prodi prodi untuk filter
        $prodi = ProdiModel::all();

        // Ambil data kompetensi beserta relasi dengan prodi
        $kompetensi = KompetensiModel::with('prodi')->get();

        return view('user.pimpinan.kompetensi.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'prodi' => $prodi, // Kirim data ke view untuk dropdown filter
            'kompetensi' => $kompetensi // Kirim data ke view untuk ditampilkan di tabel
        ]);
    }

    public function list(Request $request)
    {
        // Ambil data kompetensi dengan relasi ke tabel t_prodi
            $kompetensi = KompetensiModel::with('prodi:id_prodi,nama') // Pastikan hanya id_prodi dan nama diambil dari relasi
            ->select('id_kompetensi', 'id_prodi', 'nama', 'deskripsi');

        // Filter
        if ($request->id_prodi) {
            $kompetensi->where('id_prodi', $request->id_prodi);
        }

        // if ($request->has('filter_prodi') && $request->filter_prodi) {
        //     $kompetensi->where('id_prodi', $request->filter_prodi);
        // }

        // $id_prodi = $request->input('filter_prodi');
        // if (!empty($id_prodi)) {
        //     $kompetensi->where('id_prodi', $id_prodi);
        // }

        return DataTables::of($kompetensi)
            ->addIndexColumn()
            ->addColumn('prodi', function ($kompetensi) {
                // Tampilkan nama prodi berdasarkan relasi
                return $kompetensi->prodi->nama ?? '-';
            })
            ->addColumn('aksi', function ($kompetensi) {
                $btn = '<button onclick="modalAction(\'' . url('manage/jurusan/kompetensi/' . $kompetensi->id_kompetensi . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/jurusan/kompetensi/' . $kompetensi->id_kompetensi . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/jurusan/kompetensi/' . $kompetensi->id_kompetensi . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function list_pimpinan(Request $request)
    {
        // Ambil data kompetensi dengan relasi ke tabel t_prodi
            $kompetensi = KompetensiModel::with('prodi:id_prodi,nama') // Pastikan hanya id_prodi dan nama diambil dari relasi
            ->select('id_kompetensi', 'id_prodi', 'nama', 'deskripsi');

        // Filter
        if ($request->id_prodi) {
            $kompetensi->where('id_prodi', $request->id_prodi);
        }

        return DataTables::of($kompetensi)
            ->addIndexColumn()
            ->addColumn('prodi', function ($kompetensi) {
                // Tampilkan nama prodi berdasarkan relasi
                return $kompetensi->prodi->nama ?? '-';
            })
            // ->addColumn('aksi', function ($kompetensi) {
            //     $btn = '<button onclick="modalAction(\'' . url('manage/jurusan/kompetensi/' . $kompetensi->id_kompetensi . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
            //     $btn .= '<button onclick="modalAction(\'' . url('manage/jurusan/kompetensi/' . $kompetensi->id_kompetensi . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            //     $btn .= '<button onclick="modalAction(\'' . url('manage/jurusan/kompetensi/' . $kompetensi->id_kompetensi . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

            //     return $btn;
            // })
            // ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax(string $id)
    {
        $kompetensi = kompetensiModel::find($id);
        if ($kompetensi) {
            return view('admin.jurusan.kompetensi.show_ajax', ['kompetensi' => $kompetensi]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    // Menampilkan form tambah kompetensi
    public function create_ajax()
    {
        $prodi = ProdiModel::select('id_prodi', 'nama')->get();
        return view('admin.jurusan.kompetensi.create_ajax')->with('prodi', $prodi);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_prodi' => ['required', 'integer', 'exists:t_prodi,id_prodi'],
                'nama' => ['required', 'string', 'max:100'],
                'deskripsi' => ['required', 'string', 'max:100'],
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            KompetensiModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        }
        return redirect('/');
    }

    public function edit_ajax($id)
    {
        $kompetensi = KompetensiModel::find($id);
        // dd($id);
        $prodi = ProdiModel::select('id_prodi', 'nama')->get();
        return view('admin.jurusan.kompetensi.edit_ajax', ['kompetensi' => $kompetensi, 'prodi' => $prodi]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Validasi input data
            $rules = [
                'id_prodi' => ['required', 'integer', 'exists:t_prodi,id_prodi'],
                'nama' => ['required', 'string', 'max:100'],
                'deskripsi' => ['required', 'string', 'max:255']
            ];

            $validator = Validator::make($request->all(), $rules);

            // Jika validasi gagal
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            // Cek apakah data kompetensi dengan ID tertentu ada
            $check = KompetensiModel::find($id);
            if ($check) {
                // Update data kompetensi
                $check->update([
                    'id_prodi' => $request->input('id_prodi'),
                    'nama' => $request->input('nama'),
                    'deskripsi' => $request->input('deskripsi')
                ]);

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
        // Jika bukan permintaan AJAX, kembalikan ke halaman utama
        return redirect('/');
    }


    public function confirm_ajax($id)
    {
        $kompetensi = KompetensiModel::find($id);
        return view('admin.jurusan.kompetensi.confirm_ajax', ['kompetensi' => $kompetensi]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $kompetensi = KompetensiModel::find($id);

            if ($kompetensi) {
                $kompetensi->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return redirect('/');
    }
}
