<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\SertifikasiModel;
use App\Models\PelatihanModel;
use App\Models\DetailSertifikasiModel;
use App\Models\DetailPelatihanModel;
use App\Models\PeriodeModel; // Add the Periode model

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        try {
            $year = $request->input('year'); // Get the year parameter from the request

            // Query the periode table to get the filtered data by year
            $periode = PeriodeModel::where('tahun', $year)->first();
            if (!$periode) {
                return response()->json([
                    'success' => false,
                    'message' => 'Periode not found for the given year.'
                ], 400);
            }

            // Apply the filter by periode year on sertifikasi and pelatihan data
            $sertifikasiStatusCount = [];
            $pelatihanStatusCount = [];
            $statusList = ['requested', 'rejected', 'accepted', 'on going', 'completed'];

            foreach ($statusList as $status) {
                $sertifikasiStatusCount[$status] = DetailSertifikasiModel::where('status', $status)
                    ->where('periode_id', $periode->id)
                    ->count();
                $pelatihanStatusCount[$status] = DetailPelatihanModel::where('status', $status)
                    ->where('periode_id', $periode->id)
                    ->count();
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'sertifikasiStatusCount' => $sertifikasiStatusCount,
                    'pelatihanStatusCount' => $pelatihanStatusCount,
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
