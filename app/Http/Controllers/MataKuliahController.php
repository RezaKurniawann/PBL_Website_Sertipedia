<?php

namespace App\Http\Controllers;

use App\Models\MataKuliahModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MataKuliahController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Mata Kuliah',
            'list' => ['Home', 'Mata Kuliah']
        ];

        $page = (object) [
            'title' => 'Daftar Mata Kuliah yang terdaftar dalam sistem'
        ];

        $activeMenu = 'data jurusan.matakuliah';

        $nama = MataKuliahModel::all();

        return view('admin.jurusan.matakuliah.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'nama' => $nama
        ]);
    }

    public function list(Request $request)
    {
        try {
            // Ambil data hanya kolom id_matakuliah dan nama dari tabel m_matakuliah
            $matakuliahQuery = MataKuliahModel::select('id_matakuliah', 'nama');

            // Jika ada filter berdasarkan nama, tambahkan ke query
            $filterNama = $request->input('filter_nama');
            if (!empty($filterNama)) {
                $matakuliahQuery->where('nama', 'like', "%$filterNama%");
            }

            // Mengembalikan data dalam format DataTables
            return DataTables::of($matakuliahQuery)
                ->addIndexColumn() // Menambahkan nomor urut
                ->addColumn('aksi', function ($matakuliah) {
                    // Tombol aksi untuk detail, edit, dan hapus
                    $btn = '<button onclick="modalAction(\'' . url('/matakuliah/' . $matakuliah->id_matakuliah . '/detail_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                    $btn .= '<button onclick="modalAction(\'' . url('/matakuliah/' . $matakuliah->id_matakuliah . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                    $btn .= '<button onclick="modalAction(\'' . url('/matakuliah/' . $matakuliah->id_matakuliah . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['aksi']) // Menambahkan aksi yang bisa diklik
                ->make(true); // Mengembalikan response dalam format DataTables
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500); // Respons error jika ada masalah
        }
    }


    // Menampilkan form tambah mata kuliah dengan AJAX
    public function create_ajax()
    {
        return view('admin.jurusan.matakuliah.create_ajax');
    }

    // Menyimpan data mata kuliah dengan AJAX
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => ['required', 'string', 'max:100'], // Validasi nama mata kuliah
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            // Simpan data ke database
            MataKuliahModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan',
            ]);
        }

        return redirect('/');
    }

    // Menampilkan form edit mata kuliah dengan AJAX
    public function edit_ajax($id)
    {
        $matakuliah = MataKuliahModel::find($id);

        return view('admin.jurusan.matakuliah.edit_ajax', ['matakuliah' => $matakuliah]);
    }

    // Mengupdate data mata kuliah dengan AJAX
    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => ['required', 'string', 'max:100'], // Validasi nama mata kuliah
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            $matakuliah = MataKuliahModel::find($id);

            if ($matakuliah) {
                $matakuliah->update($request->all());

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate',
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }

        return redirect('/');
    }

    // Menghapus data mata kuliah dengan AJAX
    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $matakuliah = MataKuliahModel::find($id);

            if ($matakuliah) {
                $matakuliah->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus',
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }

        return redirect('/');
    }
}
