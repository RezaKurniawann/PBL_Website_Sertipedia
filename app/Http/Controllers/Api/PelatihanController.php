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

    public function show()
    {
        try {
            // Join the tables to fetch the necessary details
            $detailPelatihan = DetailPelatihanModel::select('t_detail_pelatihan.*', 
                                                'p1.nama as nama_pelatihan', 
                                                'm_vendor.nama as nama_vendor', 
                                                'p1.tanggal_awal as tanggal')                                          
                ->join('m_pelatihan as p1', 't_detail_pelatihan.id_pelatihan', '=', 'p1.id_pelatihan')                
                ->join('m_user', 't_detail_pelatihan.id_user', '=', 'm_user.id_user')
                ->join('m_vendor', 'p1.id_vendor', '=', 'm_vendor.id_vendor')
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
