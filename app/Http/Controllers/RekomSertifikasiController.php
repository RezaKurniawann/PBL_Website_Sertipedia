<?php

namespace App\Http\Controllers;

use App\Models\MataKuliahModel;
use App\Models\BidangMinatModel;
use App\Models\SertifikasiModel;
use App\Models\PeriodeModel;
use App\Models\VendorModel;
use App\Models\UserModel;

use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;

class RekomSertifikasiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Rekomendasi Sertifikasi',
            'list' => ['Home', 'Rekomendasi']
        ];

        $page = (object) [
            'title' => 'Rekomendasi Sertifikasi untuk Dosen'
        ];

        $activeMenu = 'rekomendasi';

        $matakuliah = MataKuliahModel::all();
        $bidangminat = BidangMinatModel::all();
        $periode = PeriodeModel::all();
        $vendor = VendorModel::all();
        $sertifikasi = SertifikasiModel::all();
        $user = UserModel::all();

        return view('admin.rekomendasi.sertifikasi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'matakuliah' => $matakuliah, 'bidangminat' => $bidangminat, 'periode' => $periode, 'vendor' => $vendor, 'sertifikasi' => $sertifikasi, 'activeMenu' => $activeMenu, 'user' => $user]);
    }
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_sertifikasi' => 'required|integer',
                'id_vendor' => 'required|integer',
                'level_sertifikasi' => 'required|string',
                'id_periode' => 'required|integer',
                'user' => 'required|array',
                'user.*' => 'integer',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'    => false,    //response status, false: eror/gagal, true:berhasil
                    'message'   => 'Validasi Gagal',
                    'msgField'  => $validator->errors(),    //pesan eror validasi
                ]);
            }

            SertifikasiModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data berhasil disimpan'
            ]);
        }
        redirect('/');
    }
    
}