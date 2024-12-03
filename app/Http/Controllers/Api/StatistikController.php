<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\SertifikasiModel;
use App\Models\PelatihanModel;
use App\Models\DetailSertifikasiModel;
use App\Models\DetailPelatihanModel;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index()
    {
        // Dapatkan jumlah user dan sertifikasi
        $userCount = UserModel::count();
        $sertifikasiCount = SertifikasiModel::count();
        $pelatihanCount = PelatihanModel::count();
        $sertifikasiOnGoingCount = DetailSertifikasiModel::where('status', 'on going')->count();
        $sertifikasiFinishedCount = DetailSertifikasiModel::where('status', 'finished')->count();
        $pelatihanOnGoingCount = DetailPelatihanModel::where('status', 'on going')->count();
        $pelatihanFinishedCount = DetailPelatihanModel::where('status', 'Finished')->count();

        // Kembalikan data statistik dalam format JSON
        return response()->json([
            'user_count' => $userCount,
            'sertifikasi_count' => $sertifikasiCount,
            'pelatihan_count' => $pelatihanCount,
            'sertifikasi_ongoing_count' => $sertifikasiOnGoingCount,
            'sertifikasi_finished_count' => $sertifikasiFinishedCount,
            'pelatihan_ongoing_count' => $pelatihanOnGoingCount,
            'pelatihan_finished_count' => $pelatihanFinishedCount
        ]);
    }
}
