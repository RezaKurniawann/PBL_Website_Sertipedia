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

            $null = DetailSertifikasiModel::pluck('id_sertifikasi')->all();
            $detailSertifikasi = SertifikasiModel::whereNotIn('id_sertifikasi',$null)
            ->with(['user', 'vendor', 'periode'])
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
        $detailSertifikasi = SertifikasiModel::with(['bidangminat', 'matakuliah'])->find($id);

        if (!$detailSertifikasi) {
            return redirect()->route('notifikasi.index')->with('error', 'Data sertifikasi tidak ditemukan.');
        }

        $users = UserModel::whereHas('bidangminat', function ($query) use ($detailSertifikasi) {
                $query->whereIn('t_user_bidangminat.id_bidangminat', $detailSertifikasi->bidangminat->pluck('id_bidangminat'));
            })
            ->whereHas('matakuliah', function ($query) use ($detailSertifikasi) {
                $query->whereIn('t_user_matakuliah.id_matakuliah', $detailSertifikasi->matakuliah->pluck('id_matakuliah'));
            })
            ->get();

        return view('admin.rekomendasi.sertifikasi.showSertifikasi', [
            'detailSertifikasi' => $detailSertifikasi,
            'users' => $users
        ]);
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
    
            // Jika request melalui AJAX, kembalikan respons JSON
            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil disimpan.',
                ]);
            }
    
            // Jika bukan AJAX, redirect
            return redirect()->route('manage/rekomendasi/sertifikasi/')
                ->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // Jika request melalui AJAX, kembalikan respons JSON dengan error
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
                ], 500);
            }
    
            // Jika bukan AJAX, redirect dengan error
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }


    }
