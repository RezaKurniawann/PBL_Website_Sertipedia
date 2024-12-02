<?php

namespace App\Http\Controllers;

use App\Models\MataKuliahModel;
use App\Models\BidangMinatModel;
use App\Models\PelatihanModel;
use App\Models\PeriodeModel;
use App\Models\VendorModel;
use App\Models\UserModel;

use Illuminate\Support\Facades\Validator;
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
        $user = UserModel::all();

        return view('admin.rekomendasi.pelatihan.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'matakuliah' => $matakuliah,
            'bidangminat' => $bidangminat,
            'periode' => $periode,
            'vendor' => $vendor,
            'pelatihan' => $pelatihan,
            'activeMenu' => $activeMenu,
            'user' => $user,
        ]);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_pelatihan' => 'required|integer',
                'id_vendor' => 'required|integer',
                'level_pelatihan' => 'required|string',
                'id_periode' => 'required|integer',
                'user' => 'required|array',
                'user.*' => 'integer',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            PelatihanModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan',
            ]);
        }

        return redirect('/');
    }
}
