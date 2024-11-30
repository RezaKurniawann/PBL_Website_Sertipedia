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
use Illuminate\Support\Facades\DB;


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

        $pelatihan = PelatihanModel::with(['matakuliah', 'bidangminat'])->find($id);

        if ($pelatihan) {
            return view('admin.event.pelatihan.show', [
                'pelatihan' => $pelatihan,
                'matakuliah' => $pelatihan->matakuliah,
                'bidangminat' => $pelatihan->bidangminat,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function confirm_ajax(string $id)
    {
        $pelatihan = PelatihanModel::with(['matakuliah', 'bidangminat'])->find($id);

        if ($pelatihan) {
            return view('admin.event.pelatihan.confirm', [
                'pelatihan' => $pelatihan,
                'matakuliah' => $pelatihan->matakuliah,
                'bidangminat' => $pelatihan->bidangminat,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
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
        $pelatihan = PelatihanModel::with(['matakuliah', 'bidangminat'])->find($id);
        $vendor = VendorModel::select('id_vendor', 'nama', 'kategori')->get();
        $periode = PeriodeModel::select('id_periode', 'tahun')->get();
        $matakuliah = MataKuliahModel::select('id_matakuliah', 'nama')->get();
        $bidangminat = BidangMinatModel::select('id_bidangminat', 'nama')->get();

        return view('admin.event.pelatihan.edit', ['pelatihan' => $pelatihan, 'vendor' => $vendor, 'periode' => $periode, 'matakuliah' => $matakuliah, 'bidangminat' => $bidangminat]);
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
                'id_periode' => 'required|integer',
                'mata_kuliah' => 'required|array|min:1',
                'mata_kuliah.*' => 'required|integer|exists:m_matakuliah,id_matakuliah',
                'bidang_minat' => 'required|array|min:1',
                'bidang_minat.*' => 'required|integer|exists:m_bidangminat,id_bidangminat',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $pelatihan = PelatihanModel::find($id);
            if ($pelatihan) {
                // Hapus data lama di tabel `t_pelatihan_matakuliah` dan `t_pelatihan_bidangminat`
                DB::table('t_pelatihan_matakuliah')->where('id_pelatihan', $id)->delete();
                DB::table('t_pelatihan_bidangminat')->where('id_pelatihan', $id)->delete();

                // Update data utama di tabel `pelatihan`
                $pelatihan->update([
                    'nama' => $request->input('nama'),
                    'id_vendor' => $request->input('id_vendor'),
                    'kuota' => $request->input('kuota'),
                    'lokasi' => $request->input('lokasi'),
                    'biaya' => $request->input('biaya'),
                    'level_pelatihan' => $request->input('level_pelatihan'),
                    'tanggal_awal' => $request->input('tanggal_awal'),
                    'tanggal_akhir' => $request->input('tanggal_akhir'),
                    'id_periode' => $request->input('id_periode'),
                ]);

                // Insert ulang data baru ke tabel `t_pelatihan_matakuliah`
                $timestamps = ['created_at' => now(), 'updated_at' => now()]; // Tambahkan timestamp
                foreach ($request->input('mata_kuliah') as $id_matakuliah) {
                    DB::table('t_pelatihan_matakuliah')->insert(array_merge([
                        'id_pelatihan' => $id,
                        'id_matakuliah' => $id_matakuliah,
                    ], $timestamps));
                }

                // Insert ulang data baru ke tabel `t_pelatihan_bidangminat`
                foreach ($request->input('bidang_minat') as $id_bidangminat) {
                    DB::table('t_pelatihan_bidangminat')->insert(array_merge([
                        'id_pelatihan' => $id,
                        'id_bidangminat' => $id_bidangminat,
                    ], $timestamps));
                }

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
        $matakuliah = MataKuliahModel::select('id_matakuliah', 'nama')->get();
        $bidangminat = BidangMinatModel::select('id_bidangminat', 'nama')->get();

        return view('admin.event.pelatihan.create', ['vendor' => $vendor, 'periode' => $periode, 'matakuliah' => $matakuliah, 'bidangminat' => $bidangminat]);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => 'required|string|min:3|max:100',
                'id_vendor' => 'required|integer',
                'kuota' => 'required|integer|min:1',
                'lokasi' => 'required|string|max:255',
                'biaya' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
                'level_pelatihan' => 'required|string|in:Nasional,Internasional',
                'tanggal_awal' => 'required|date|before_or_equal:tanggal_akhir',
                'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
                'id_periode' => 'required|integer|exists:periode,id_periode',
                'mata_kuliah' => 'required|array|min:1',
                'mata_kuliah.*' => 'required|integer|exists:m_matakuliah,id_matakuliah',
                'bidang_minat' => 'required|array|min:1',
                'bidang_minat.*' => 'required|integer|exists:m_bidangminat,id_bidangminat',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'    => false, // response status, false: error/gagal, true: berhasil
                    'message'   => 'Validasi Gagal',
                    'msgField'  => $validator->errors(), // pesan error validasi
                ]);
            }
            try {
                // Gunakan transaction untuk menjamin konsistensi data
                DB::beginTransaction();

                // Simpan data pelatihan dan dapatkan ID-nya
                $pelatihan = PelatihanModel::create($request->all());
                $idPelatihan = $pelatihan->id_pelatihan;
                foreach ($request->mata_kuliah as $idMatakuliah) {
                    DB::table('t_pelatihan_matakuliah')->insert([
                        'id_pelatihan' => $idPelatihan,
                        'id_matakuliah' => $idMatakuliah,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                foreach ($request->bidang_minat as $idBidangMinat) {
                    DB::table('t_pelatihan_bidangminat')->insert([
                        'id_pelatihan' => $idPelatihan,
                        'id_bidangminat' => $idBidangMinat,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Data pelatihan berhasil disimpan',
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ]);
            }
        }
        return redirect('/');
    }
}
