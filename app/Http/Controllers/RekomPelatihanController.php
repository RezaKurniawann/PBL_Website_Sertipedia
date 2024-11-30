<?php

namespace App\Http\Controllers;

use App\Models\MataKuliahModel;
use App\Models\BidangMinatModel;
use App\Models\PelatihanModel;
use App\Models\PeriodeModel;
use App\Models\VendorModel;

use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;

class RekomPelatihanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Rekomendasi Pelatihan',
            'list' => ['Home', 'Rekomendasi']
        ];

        $page = (object) [
            'title' => 'Rekomendasi Pelatihan untuk Dosen'
        ];

        $activeMenu = 'rekomendasi';

        $matakuliah = MataKuliahModel::all();
        $bidangminat = BidangMinatModel::all();
        $periode = PeriodeModel::all();
        $vendor = VendorModel::all();
        $pelatihan = PelatihanModel::all();

        return view('admin.rekomendasi.pelatihan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'matakuliah' => $matakuliah, 'bidangminat' => $bidangminat, 'periode' => $periode, 'vendor' => $vendor, 'pelatihan' => $pelatihan, 'activeMenu' => $activeMenu]);
    }
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_pelatihan' => 'required|integer',
                'id_vendor' => 'required|integer',
                'level_pelatihan' => 'required|string',
                'id_periode' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'    => false,    //response status, false: eror/gagal, true:berhasil
                    'message'   => 'Validasi Gagal',
                    'msgField'  => $validator->errors(),    //pesan eror validasi
                ]);
            }

            pelatihanModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data berhasil disimpan'
            ]);
        }
        redirect('/');
    }
}