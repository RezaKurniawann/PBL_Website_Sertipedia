<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\SertifikasiModel;
use App\Models\PelatihanModel;
use App\Models\DetailSertifikasiModel;
use App\Models\DetailPelatihanModel;

class StatistikController extends Controller
{
    public function index()
    {
        try {
            // Dapatkan jumlah user dan sertifikasi
            $userCount = UserModel::count();
            $sertifikasiCount = SertifikasiModel::count();
            $pelatihanCount = PelatihanModel::count();

            // Menghitung status sertifikasi dan pelatihan
            $statusList = ['requested', 'rejected', 'accepted', 'on going', 'completed'];
            $sertifikasiStatusCount = [];
            $pelatihanStatusCount = [];

            foreach ($statusList as $status) {
                $sertifikasiStatusCount[$status] = DetailSertifikasiModel::where('status', $status)->count();
                $pelatihanStatusCount[$status] = DetailPelatihanModel::where('status', $status)->count();
            }

            // Respon data dalam format JSON
            return response()->json([
                'success' => true,
                'data' => [
                    'userCount' => $userCount,
                    'sertifikasiCount' => $sertifikasiCount,
                    'pelatihanCount' => $pelatihanCount,
                    'sertifikasiStatusCount' => $sertifikasiStatusCount,
                    'pelatihanStatusCount' => $pelatihanStatusCount,
                ]
            ], 200);
        } catch (\Exception $e) {
            // Tangani error
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
