<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PelatihanModel;
use App\Models\DetailPelatihanModel;
use Illuminate\Support\Facades\Log;

class PelatihanController extends Controller
{
    public function getUserDetailsByPelatihan($id_pelatihan)
    {
        try {
            // Ambil data user terkait dengan pelatihan
            $detailPelatihan = DetailPelatihanModel::select(
                't_detail_pelatihan.id_user',
                'm_user.nama',            // Ambil nama user
                'm_pangkat.nama as pangkat',  // Ambil nama pangkat
                'm_golongan.nama as golongan',  // Ambil nama golongan
                'm_jabatan.nama as jabatan',   // Ambil nama jabatan
                'm_level.nama as level'      // Ambil nama level
            )
                ->join('m_pelatihan', 't_detail_pelatihan.id_pelatihan', '=', 'm_pelatihan.id_pelatihan')
                ->join('m_user', 't_detail_pelatihan.id_user', '=', 'm_user.id_user')
                ->join('m_pangkat', 'm_user.id_pangkat', '=', 'm_pangkat.id_pangkat')  // Join dengan tabel m_pangkat
                ->join('m_golongan', 'm_user.id_golongan', '=', 'm_golongan.id_golongan')  // Join dengan tabel m_golongan
                ->join('m_jabatan', 'm_user.id_jabatan', '=', 'm_jabatan.id_jabatan')  // Join dengan tabel m_jabatan
                ->join('m_level', 'm_user.id_level', '=', 'm_level.id_level')  // Join dengan tabel m_level
                ->where('t_detail_pelatihan.id_pelatihan', $id_pelatihan)  // Filter berdasarkan id_pelatihan
                ->get();

            // Cek apakah data pelatihan kosong
            if ($detailPelatihan->isEmpty()) {
                Log::warning("No training data found for id_pelatihan: {$id_pelatihan}");
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

    public function index()
    {
        return PelatihanModel::all();
    }

    public function verifikasiPelatihan()
    {
        try {
            $detailPelatihan = DetailPelatihanModel::select(
                't_detail_pelatihan.id_detail_pelatihan',
                't_detail_pelatihan.id_pelatihan',
                'm_pelatihan.biaya',
                'm_pelatihan.nama as nama_pelatihan',
                'm_vendor.nama as nama_vendor',
                'm_pelatihan.level_pelatihan',
                'm_periode.tahun'
            )
                ->join('m_pelatihan', 't_detail_pelatihan.id_pelatihan', '=', 'm_pelatihan.id_pelatihan')
                ->join('m_vendor', 'm_pelatihan.id_vendor', '=', 'm_vendor.id_vendor')
                ->join('m_periode', 'm_pelatihan.id_periode', '=', 'm_periode.id_periode')
                ->where('t_detail_pelatihan.status', 'Requested')
                ->get();

            if ($detailPelatihan->isEmpty()) {
                Log::warning("No training data found.");
                return response()->json(['error' => 'No pelatihan data found'], 404);
            }

            $uniquePelatihan = $detailPelatihan->groupBy('id_pelatihan')->map(function ($group) {
                return $group->first();
            });

            return response()->json([
                'pelatihan' => $uniquePelatihan,
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching pelatihan data: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch pelatihan data', 'message' => $e->getMessage()], 500);
        }
    }

    public function showUserPelatihan()
    {
        try {
            $detailPelatihan = DetailPelatihanModel::select(
                't_detail_pelatihan.id_detail_pelatihan',
                't_detail_pelatihan.id_user',
                'm_pelatihan.nama as nama_pelatihan',
                'm_vendor.nama as nama_vendor',
                'm_pelatihan.level_pelatihan',
                'm_periode.tahun',
            )
                ->join('m_pelatihan', 't_detail_pelatihan.id_pelatihan', '=', 'm_pelatihan.id_pelatihan')
                ->join('m_user', 't_detail_pelatihan.id_user', '=', 'm_user.id_user')
                ->join('m_vendor', 'm_pelatihan.id_vendor', '=', 'm_vendor.id_vendor')
                ->join('m_periode', 'm_pelatihan.id_periode', '=', 'm_periode.id_periode')
                ->where('t_detail_pelatihan.status', 'On Going')
                ->get();


            if ($detailPelatihan->isEmpty()) {
                Log::warning("No training data found.");
                return response()->json(['error' => 'No pelatihan data found'], 404);
            }

            // Return the pelatihan data as a JSON response
            return response()->json([
                'pelatihan' => $detailPelatihan,
            ]);
        } catch (\Exception $e) {
            // Log the exception message and return a 500 server error
            Log::error('Error fetching pelatihan data: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch pelatihan data', 'message' => $e->getMessage()], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id_pelatihan' => 'required|integer',
            'status' => 'required|string|in:Accepted,Rejected',
        ]);

        try {
            $updatedRows = DetailPelatihanModel::where('id_pelatihan', $request->id_pelatihan)
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
