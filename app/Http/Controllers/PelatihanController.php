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

class PelatihanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pelatihan',
            'list' => ['Home', 'Pelatihan']
        ];

        $page = (object) [
            'title' => 'Daftar pelatihan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-event';

        $matakuliah = MataKuliahModel::all();
        $bidangminat = BidangMinatModel::all();
        $periode = PeriodeModel::all();
        $vendor = VendorModel::all();

        return view('admin.event.pelatihan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'matakuliah' => $matakuliah, 'bidangminat' => $bidangminat, 'periode' => $periode, 'vendor' => $vendor, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $pelatihans = PelatihanModel::select('id_pelatihan', 'id_vendor', 'id_periode', 'nama', 'kuota', 'lokasi', 'biaya', 'level_pelatihan', 'tanggal_awal', 'tanggal_akhir')->with('vendor', 'periode');

        return DataTables::of($pelatihans)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pelatihan) {
                $btn = '<button onclick="modalAction(\'' . url('manage/event/pelatihan/' . $pelatihan->id_pelatihan . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/event/pelatihan/' . $pelatihan->id_pelatihan . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('manage/event/pelatihan/' . $pelatihan->id_pelatihan . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax(string $id)
    {
        $pelatihan = PelatihanModel::find($id);
        if ($pelatihan) {
            return view('admin.event.pelatihan.show', ['pelatihan' => $pelatihan]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function confirm_ajax(string $id)
    {
        $pelatihan = PelatihanModel::find($id);
        return view('admin.event.pelatihan.confirm', ['pelatihan' => $pelatihan]);
    }
    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $pelatihan = PelatihanModel::find($id);
            if ($pelatihan) {
                $pelatihan->delete();
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
        $pelatihan = PelatihanModel::find($id);
        $vendor = VendorModel::select('id_vendor', 'nama', 'kategori')->get();
        $periode = PeriodeModel::select('id_periode', 'tahun')->get();

        return view('admin.event.pelatihan.edit', ['pelatihan' => $pelatihan, 'vendor' => $vendor, 'periode' => $periode]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => 'required|string|min:3|max:100',
                'id_vendor' => 'required|integer',
                'kuota' => 'required|integer',
                'lokasi' => 'required|string',
                'biaya' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
                'level_pelatihan' => 'required|string',
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

            $check = PelatihanModel::find($id);
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

        return view('admin.event.pelatihan.create', ['vendor' => $vendor, 'periode' => $periode]);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => 'required|string|min:3|max:100',
                'id_vendor' => 'required|integer',
                'kuota' => 'required|integer',
                'lokasi' => 'required|string',
                'biaya' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
                'level_pelatihan' => 'required|string',
                'tanggal_awal' => 'required|date|before_or_equal:tanggal_akhir',
                'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
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
                'message'   => 'Data barang berhasil disimpan'
            ]);
        }
        redirect('/');
    }
}
