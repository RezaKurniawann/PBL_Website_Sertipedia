<?php

namespace App\Http\Controllers;

use App\Models\PelatihanModel;
use App\Models\PeriodeModel;
use App\Models\UserModel;
use App\Models\VendorModel;
use App\Models\DetailPelatihanModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class RekomPelatihanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Detail Pelatihan',
            'list' => ['Home', 'Detail Pelatihan']
        ];

        $page = (object) [
            'title' => 'Daftar detail pelatihan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'rekomendasi';

        $user = UserModel::all();
        $pelatihan = PelatihanModel::all();

        return view('admin.rekomendasi.pelatihan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'pelatihan' => $pelatihan, 'activeMenu' => $activeMenu]);
    }

    public function formDataPelatihan()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pelatihan',
            'list' => ['Home', 'Pelatihan']
        ];

        $page = (object) [
            'title' => 'Daftar Pelatihan'
        ];

        $activeMenu = 'rekomendasi';

        return view('admin.rekomendasi.pelatihan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function listPelatihan(Request $request)
    {
        if ($request->ajax()) { // Pastikan hanya melayani request AJAX
            $user = UserModel::findOrFail(Auth::id());

            // Ambil data detail pelatihan beserta relasi
            $detailPelatihan = PelatihanModel::with(['user', 'vendor', 'periode'])
                ->get();

            return DataTables::of($detailPelatihan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($detailPelatihan) {
                    return '<button onclick="modalAction(\'' . url('manage/rekomendasi/pelatihan/' . $detailPelatihan->id_pelatihan . '/show_pelatihan') . '\')" class="btn btn-sm btn-info"><i class="fa fa-upload"></i> Input Data</button>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function showPelatihan(string $id)
    {
        $detailPelatihan = PelatihanModel::find($id);
        $users = UserModel::all(); // Ambil semua data user

        if ($detailPelatihan) {
            return view('admin.rekomendasi.pelatihan.showPelatihan', [
                'detailPelatihan' => $detailPelatihan,
                'users' => $users, // Kirim data user ke view
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function storeDetailPelatihan(Request $request, string $id)
    {
        $validated = $request->validate([
            'user' => 'required|array', // Pastikan input berupa array
            'user.*' => 'exists:m_user,id_user', // Validasi bahwa ID user valid
        ]);

        $data = [];
        foreach ($validated['user'] as $userId) {
            $data[] = [
                'id_user' => $userId,
                'id_pelatihan' => $id,
                'status' => 'Requested',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        try {
            DetailPelatihanModel::insert($data);
    
            return redirect()->route('manage/rekomendasi/pelatihan/') // Sesuaikan dengan nama rute Anda
                ->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }


    }
