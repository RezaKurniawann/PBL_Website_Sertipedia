<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PelatihanModel;
use App\Models\BidangMinatModel;
use App\Models\PeriodeModel;
use App\Models\DetailPelatihanModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Log;

class PelatihanController extends Controller
{
    public function index ()
    {
        return PelatihanModel::all();
    }

    public function show(PelatihanModel $pelatihan)
    {
        try {
            // Join the tables to fetch the necessary details
            $detailPelatihan = DetailPelatihanModel::select('t_detail_pelatihan.*', 
                                                            'm_user.nama as nama',
                                                            'm_bidangminat.nama as nama_bidang_minat',
                                                            'm_vendor.nama as nama_vendor',
                                                            'm_pelatihan.tanggal_awal as tanggal')
                ->join('m_pelatihan', 't_detail_pelatihan.id_pelatihan', '=', 'm_pelatihan.id_pelatihan')
                ->join('m_pelatihan', 't_pelatihan_bidangminat.id_pelatihan', '=', 'm_pelatihan.id_pelatihan')
                ->join('m_user', 't_detail_pelatihan.id_user', '=', 'm_user.id_user')
                ->join('m_bidangminat', 't_pelatihan_bidangminat.id_bidangminat', '=', 'm_bidangminat.id_bidangminat')
                ->join('m_vendor', 'm_pelatihan.id_vendor', '=', 'm_vendor.id_vendor')
                ->where('t_detail_pelatihan.status', 'Requested')
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
}
