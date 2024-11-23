<?php

namespace App\Http\Controllers;

use App\Models\MataKuliahModel;
use App\Models\BidangMinatModel;
use App\Models\PeriodeModel;
use App\Models\SertifikasiModel;
use App\Models\VendorModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SertifikasiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Sertifikasi',
            'list' => ['Home', 'Sertifikasi']
        ];

        $page = (object) [
            'title' => 'Daftar sertifikasi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-event';

        $matakuliah = MataKuliahModel::all();
        $bidangminat = BidangMinatModel::all();
        $periode = PeriodeModel::all();
        $vendor = VendorModel::all();

        return view('admin.event.sertifikasi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'matakuliah' => $matakuliah, 'bidangminat' => $bidangminat, 'periode' => $periode, 'vendor' => $vendor, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $sertifikasis = SertifikasiModel::select('id_sertifikasi', 'id_vendor', 'id_periode', 'nama', 'biaya', 'jenis_sertifikasi', 'tanggal_awal', 'tanggal_akhir')->with('vendor', 'periode');

        return DataTables::of($sertifikasis)
            ->addIndexColumn()
            ->addColumn('aksi', function ($sertifikasi) {
                $btn = '<button onclick="modalAction(\'' . url('manage/event/sertifikasi/' . $sertifikasi->id_sertifikasi . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/event/sertifikasi/' . $sertifikasi->id_sertifikasi . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/event/sertifikasi/' . $sertifikasi->id_sertifikasi . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax(string $id)
    {
        $sertifikasi = SertifikasiModel::find($id);
        if ($sertifikasi) {
            return view('admin.event.sertifikasi.show', ['sertifikasi' => $sertifikasi]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function confirm_ajax(string $id)
    {
        $sertifikasi = SertifikasiModel::find($id);
        return view('admin.event.sertifikasi.confirm', ['sertifikasi' => $sertifikasi]);
    }
    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $sertifikasi = SertifikasiModel::find($id);
            if ($sertifikasi) {
                $sertifikasi->delete();
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

    public function edit_ajax(string $id)
    {
        $sertifikasi = SertifikasiModel::find($id);
        $vendor = VendorModel::select('id_vendor', 'nama', 'kategori')->get();
        $periode = PeriodeModel::select('id_periode', 'tahun')->get();

        return view('admin.event.sertifikasi.edit', ['sertifikasi' => $sertifikasi, 'vendor' => $vendor, 'periode' => $periode]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => 'required|string|min:3|max:100',
                'id_vendor' => 'required|integer',
                'biaya' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
                'jenis_sertifikasi' => 'required|string',
                'tanggal_awal' => 'required|date|before_or_equal:tanggal_akhir',
                'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
                'id_periode' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $check = SertifikasiModel::find($id);
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

    public function create_ajax()
{
    $vendor = VendorModel::select('id_vendor', 'nama', 'kategori')->get();
    $periode = PeriodeModel::select('id_periode', 'tahun')->get();

    return view('admin.event.sertifikasi.create', ['vendor' => $vendor, 'periode' => $periode]);
}

public function store_ajax(Request $request){
    if($request->ajax() || $request->wantsJson()){
        $rules = [
            'nama' => 'required|string|min:3|max:100',
            'id_vendor' => 'required|integer',
            'biaya' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'jenis_sertifikasi' => 'required|string',
            'tanggal_awal' => 'required|date|before_or_equal:tanggal_akhir',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
            'id_periode' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                'status'    =>false,    //response status, false: eror/gagal, true:berhasil
                'message'   => 'Validasi Gagal',
                'msgField'  => $validator->errors(),    //pesan eror validasi
            ]);
        }

        SertifikasiModel::create($request->all());
        return response()->json([
            'status'    => true,
            'message'   => 'Data barang berhasil disimpan'
        ]);
    }
    redirect('/');
}
}
