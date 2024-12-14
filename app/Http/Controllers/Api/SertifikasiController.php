<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailSertifikasiModel;
use Illuminate\Http\Request;
use App\Models\SertifikasiModel;
use Illuminate\Support\Facades\Log;

class SertifikasiController extends Controller
{
    public function getUserDetailsBySertifikasi($id_sertifikasi)
    {
        try {
            // Ambil data user terkait dengan sertifikasi
            $detailSertifikasi = DetailSertifikasiModel::select(
                    't_detail_sertifikasi.id_user',
                    'm_user.nama',            // Ambil nama user
                    'm_pangkat.nama as pangkat',  // Ambil nama pangkat
                    'm_golongan.nama as golongan',  // Ambil nama golongan
                    'm_jabatan.nama as jabatan',   // Ambil nama jabatan
                    'm_level.nama as level'      // Ambil nama level
                )
                ->join('m_sertifikasi', 't_detail_sertifikasi.id_sertifikasi', '=', 'm_sertifikasi.id_sertifikasi')
                ->join('m_user', 't_detail_sertifikasi.id_user', '=', 'm_user.id_user')
                ->join('m_pangkat', 'm_user.id_pangkat', '=', 'm_pangkat.id_pangkat')  // Join dengan tabel m_pangkat
                ->join('m_golongan', 'm_user.id_golongan', '=', 'm_golongan.id_golongan')  // Join dengan tabel m_golongan
                ->join('m_jabatan', 'm_user.id_jabatan', '=', 'm_jabatan.id_jabatan')  // Join dengan tabel m_jabatan
                ->join('m_level', 'm_user.id_level', '=', 'm_level.id_level')  // Join dengan tabel m_level
                ->where('t_detail_sertifikasi.id_sertifikasi', $id_sertifikasi)  // Filter berdasarkan id_sertifikasi
                ->get();

            // Cek apakah data sertifikasi kosong
            if ($detailSertifikasi->isEmpty()) {
                Log::warning("No training data found for id_sertifikasi: {$id_sertifikasi}");
                return response()->json(['error' => 'No sertifikasi data found'], 404);
            }

            // Return data sertifikasi sebagai response JSON
            return response()->json(['data' => $detailSertifikasi], 200);
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan saat mengambil data
            Log::error('Error fetching sertifikasi data: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch sertifikasi data', 'message' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        return SertifikasiModel::all();
    }

    public function verifikasiSertifikasi()
    {
        try {
            $detailSertifikasi = DetailSertifikasiModel::select(
                't_detail_sertifikasi.id_detail_sertifikasi',
                'm_sertifikasi.biaya',
                'm_sertifikasi.id_sertifikasi',
                'm_sertifikasi.nama as nama_sertifikasi',
                'm_vendor.nama as nama_vendor',
                'm_sertifikasi.jenis_sertifikasi',
                'm_periode.tahun'
            )
                ->join('m_sertifikasi', 't_detail_sertifikasi.id_sertifikasi', '=', 'm_sertifikasi.id_sertifikasi')
                ->join('m_vendor', 'm_sertifikasi.id_vendor', '=', 'm_vendor.id_vendor')
                ->join('m_periode', 'm_sertifikasi.id_periode', '=', 'm_periode.id_periode')
                ->where('t_detail_sertifikasi.status', 'Requested')
                ->get();

            if ($detailSertifikasi->isEmpty()) {
                Log::warning("No certification data found.");
                return response()->json(['error' => 'No sertifikasi data found'], 404);
            }

            // Remove duplicate certifications by grouping by id_sertifikasi
            $uniqueSertifikasi = $detailSertifikasi->groupBy('id_sertifikasi')->map(function ($group) {
                return $group->first();
            });

            return response()->json([
                'sertifikasi' => $uniqueSertifikasi,
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching sertifikasi data: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch sertifikasi data', 'message' => $e->getMessage()], 500);
        }
    }


    public function showUserSertifikasi()
    {
        try {
            $detailSertifikasi = DetailSertifikasiModel::select(
                't_detail_sertifikasi.id_detail_sertifikasi',
                't_detail_sertifikasi.id_user',
                'm_sertifikasi.nama as nama_sertifikasi',
                'm_vendor.nama as nama_vendor',
                'm_sertifikasi.jenis_sertifikasi',
                'm_periode.tahun',
            )
                ->join('m_sertifikasi', 't_detail_sertifikasi.id_sertifikasi', '=', 'm_sertifikasi.id_sertifikasi')
                ->join('m_user', 't_detail_sertifikasi.id_user', '=', 'm_user.id_user')
                ->join('m_vendor', 'm_sertifikasi.id_vendor', '=', 'm_vendor.id_vendor')
                ->join('m_periode', 'm_sertifikasi.id_periode', '=', 'm_periode.id_periode')
                ->where('t_detail_sertifikasi.status', 'On Going')
                ->get();


            if ($detailSertifikasi->isEmpty()) {
                Log::warning("No training data found.");
                return response()->json(['error' => 'No sertifikasi data found'], 404);
            }

            // Return the sertifikasi data as a JSON response
            return response()->json([
                'sertifikasi' => $detailSertifikasi,
            ]);
        } catch (\Exception $e) {
            // Log the exception message and return a 500 server error
            Log::error('Error fetching sertifikasi data: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch sertifikasi data', 'message' => $e->getMessage()], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id_sertifikasi' => 'required|integer',
            'status' => 'required|string|in:Accepted,Rejected',
        ]);

        try {
            $updatedRows = DetailSertifikasiModel::where('id_sertifikasi', $request->id_sertifikasi)
                ->update(['status' => $request->status]);

            if ($updatedRows > 0) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Status updated successfully'
                ], 200);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'No records updated'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error updating status: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update status',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
