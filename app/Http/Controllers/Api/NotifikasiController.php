<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DetailPelatihanModel;
use App\Models\DetailSertifikasiModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotifikasiController extends Controller
{
    public function downloadFile(Request $request, $fileName)
    {
        if (Storage::exists("public/surat_tugas/{$fileName}")) {
            return response()->download(storage_path("app/public/surat_tugas/{$fileName}"));
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }

    public function NotifikasiStatusPelatihan($id_user)
    {
        try {
            $detailPelatihan = DetailPelatihanModel::select(
                't_detail_pelatihan.id_detail_pelatihan',
                'm_pelatihan.nama as nama_pelatihan',
                'm_vendor.nama as nama_vendor',
                'm_pelatihan.level_pelatihan',
                'm_periode.tahun',
                't_detail_pelatihan.status',
                't_detail_pelatihan.surat_tugas',
            )
                ->join('m_pelatihan', 't_detail_pelatihan.id_pelatihan', '=', 'm_pelatihan.id_pelatihan')
                ->join('m_vendor', 'm_pelatihan.id_vendor', '=', 'm_vendor.id_vendor')
                ->join('m_periode', 'm_pelatihan.id_periode', '=', 'm_periode.id_periode')
                ->where('t_detail_pelatihan.id_user', $id_user)
                ->get();

            // Cek apakah data pelatihan kosong
            if ($detailPelatihan->isEmpty()) {
                Log::warning("No training data found for id_pelatihan: {$id_user}");
                return response()->json(['error' => 'No pelatihan data found'], 404);
            }

            // Return data pelatihan sebagai response JSON
            return response()->json(['data' => $detailPelatihan], 200);
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan saat mengambil data
            Log::error('Error fetching pelatihan data: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch pelatihan data', 'message' => $e->getMessage()], 500);
        }
    }

    public function NotifikasiStatusSertifikasi($id_user)
    {
        try {
            $detailSertifikasi = DetailSertifikasiModel::select(
                't_detail_sertifikasi.id_detail_sertifikasi',
                'm_sertifikasi.nama as nama_sertifikasi',
                'm_vendor.nama as nama_vendor',
                'm_sertifikasi.jenis_sertifikasi',
                'm_periode.tahun',
                't_detail_sertifikasi.status',
                't_detail_sertifikasi.surat_tugas',
            )
                ->join('m_sertifikasi', 't_detail_sertifikasi.id_sertifikasi', '=', 'm_sertifikasi.id_sertifikasi')
                ->join('m_vendor', 'm_sertifikasi.id_vendor', '=', 'm_vendor.id_vendor')
                ->join('m_periode', 'm_sertifikasi.id_periode', '=', 'm_periode.id_periode')
                ->where('t_detail_sertifikasi.id_user', $id_user)
                ->get();

            // Cek apakah data pelatihan kosong
            if ($detailSertifikasi->isEmpty()) {
                Log::warning("No training data found for id_pelatihan: {$id_user}");
                return response()->json(['error' => 'No pelatihan data found'], 404);
            }

            // Return data pelatihan sebagai response JSON
            return response()->json(['data' => $detailSertifikasi], 200);
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan saat mengambil data
            Log::error('Error fetching pelatihan data: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch pelatihan data', 'message' => $e->getMessage()], 500);
        }
    }
}
