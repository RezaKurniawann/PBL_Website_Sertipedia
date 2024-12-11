<?php

namespace App\Http\Controllers;

use App\Models\SertifikasiModel;
use App\Models\PeriodeModel;
use App\Models\UserModel;
use App\Models\VendorModel;
use App\Models\DetailSertifikasiModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class RekomSertifikasiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Detail Sertifikasi',
            'list' => ['Home', 'Detail Sertifikasi']
        ];

        $page = (object) [
            'title' => 'Daftar detail sertifikasi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'rekomendasi';

        $user = UserModel::all();
        $sertifikasi = SertifikasiModel::all();

        return view('admin.rekomendasi.sertifikasi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'sertifikasi' => $sertifikasi, 'activeMenu' => $activeMenu]);
    }

    public function formDataSertifikasi()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Sertifikasi',
            'list' => ['Home', 'Sertifikasi']
        ];

        $page = (object) [
            'title' => 'Daftar Sertifikasi'
        ];

        $activeMenu = 'rekomendasi';

        return view('admin.rekomendasi.sertifikasi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function listSertifikasi(Request $request)
    {
        if ($request->ajax()) { // Pastikan hanya melayani request AJAX
            $user = UserModel::findOrFail(Auth::id());

            // Ambil data detail pelatihan beserta relasi
            $detailSertifikasi = SertifikasiModel::with(['user', 'vendor', 'periode'])
                ->get();

            return DataTables::of($detailSertifikasi)
                ->addIndexColumn()
                ->addColumn('aksi', function ($detailSertifikasi) {
                    return '<button onclick="modalAction(\'' . url('manage/rekomendasi/sertifikasi/' . $detailSertifikasi->id_sertifikasi . '/show_sertifikasi') . '\')" class="btn btn-sm btn-info"><i class="fa fa-upload"></i> Input Data</button>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function showSertifikasi(string $id)
    {
        $detailSertifikasi = SertifikasiModel::find($id);
        $users = UserModel::all(); // Ambil semua data user

        if ($detailSertifikasi) {
            return view('admin.rekomendasi.sertifikasi.showSertifikasi', [
                'detailSertifikasi' => $detailSertifikasi,
                'users' => $users, // Kirim data user ke view
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function storeDetailSertifikasi(Request $request, string $id)
    {
        $validated = $request->validate([
            'user' => 'required|array', // Pastikan input berupa array
            'user.*' => 'exists:m_user,id_user', // Validasi bahwa ID user valid
        ]);

        $data = [];
        foreach ($validated['user'] as $userId) {
            $data[] = [
                'id_user' => $userId,
                'id_sertifikasi' => $id,
                'status' => 'Requested',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        try {
            DetailSertifikasiModel::insert($data);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    }
