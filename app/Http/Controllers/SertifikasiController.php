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
use Illuminate\Support\Facades\DB;

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

        $sertifikasi = SertifikasiModel::with(['matakuliah', 'bidangminat'])->find($id);

        if ($sertifikasi) {
            return view('admin.event.sertifikasi.show', [
                'sertifikasi' => $sertifikasi,
                'matakuliah' => $sertifikasi->matakuliah,
                'bidangminat' => $sertifikasi->bidangminat,
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
        $sertifikasi = SertifikasiModel::with(['matakuliah', 'bidangminat'])->find($id);

        if ($sertifikasi) {
            return view('admin.event.sertifikasi.confirm', [
                'sertifikasi' => $sertifikasi,
                'matakuliah' => $sertifikasi->matakuliah,
                'bidangminat' => $sertifikasi->bidangminat,
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
        $sertifikasi = SertifikasiModel::with(['matakuliah', 'bidangminat'])->find($id);
        $vendor = VendorModel::select('id_vendor', 'nama', 'kategori')->get();
        $periode = PeriodeModel::select('id_periode', 'tahun')->get();
        $matakuliah = MatakuliahModel::select('id_matakuliah', 'nama')->get();
        $bidangminat = BidangMinatModel::select('id_bidangminat', 'nama')->get();
        return view('admin.event.sertifikasi.edit', ['sertifikasi' => $sertifikasi, 'vendor' => $vendor, 'periode' => $periode, 'matakuliah' => $matakuliah, 'bidangminat' => $bidangminat]);
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

            $sertifikasi = SertifikasiModel::find($id);
            if ($sertifikasi) {
                // Hapus data lama di tabel `t_sertifikasi_matakuliah` dan `t_sertifikasi_bidangminat`
                DB::table('t_sertifikasi_matakuliah')->where('id_sertifikasi', $id)->delete();
                DB::table('t_sertifikasi_bidangminat')->where('id_sertifikasi', $id)->delete();

                // Update data utama di tabel `sertifikasi`
                $sertifikasi->update([
                    'nama' => $request->input('nama'),
                    'id_vendor' => $request->input('id_vendor'),
                    'biaya' => $request->input('biaya'),
                    'jenis_sertifikasi' => $request->input('jenis_sertifikasi'),
                    'tanggal_awal' => $request->input('tanggal_awal'),
                    'tanggal_akhir' => $request->input('tanggal_akhir'),
                    'id_periode' => $request->input('id_periode'),
                ]);

                // Insert ulang data baru ke tabel `t_sertifikasi_matakuliah`
                $timestamps = ['created_at' => now(), 'updated_at' => now()]; // Tambahkan timestamp
                foreach ($request->input('mata_kuliah') as $id_matakuliah) {
                    DB::table('t_sertifikasi_matakuliah')->insert(array_merge([
                        'id_sertifikasi' => $id,
                        'id_matakuliah' => $id_matakuliah,
                    ], $timestamps));
                }

                // Insert ulang data baru ke tabel `t_sertifikasi_bidangminat`
                foreach ($request->input('bidang_minat') as $id_bidangminat) {
                    DB::table('t_sertifikasi_bidangminat')->insert(array_merge([
                        'id_sertifikasi' => $id,
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

        return view('admin.event.sertifikasi.create', ['vendor' => $vendor, 'periode' => $periode, 'matakuliah' => $matakuliah, 'bidangminat' => $bidangminat]);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => 'required|string|min:3|max:100',
                'id_vendor' => 'required|integer',
                'biaya' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
                'jenis_sertifikasi' => 'required|string',
                'tanggal_awal' => 'required|date|before_or_equal:tanggal_akhir',
                'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
                'id_periode' => 'required|integer',
                'mata_kuliah' => 'required|array|min:1',
                'mata_kuliah.*' => 'required|integer|exists:m_matakuliah,id_matakuliah',
                'bidang_minat' => 'required|array|min:1',
                'bidang_minat.*' => 'required|integer|exists:m_bidangminat,id_bidangminat',
            ];

            $validator = Validator::make($request->all(), $rules);

            try {
                // Gunakan transaction untuk menjamin konsistensi data
                DB::beginTransaction();

                // Simpan data sertifikasi dan dapatkan ID-nya
                $sertifikasi = SertifikasiModel::create($request->all());
                $idsertifikasi = $sertifikasi->id_sertifikasi;
                foreach ($request->mata_kuliah as $idMatakuliah) {
                    DB::table('t_sertifikasi_matakuliah')->insert([
                        'id_sertifikasi' => $idsertifikasi,
                        'id_matakuliah' => $idMatakuliah,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                foreach ($request->bidang_minat as $idBidangMinat) {
                    DB::table('t_sertifikasi_bidangminat')->insert([
                        'id_sertifikasi' => $idsertifikasi,
                        'id_bidangminat' => $idBidangMinat,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Data sertifikasi berhasil disimpan',
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ]);
            }
        }
        redirect('/');
    }
}
