<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\MataKuliahModel;
use App\Models\BidangMinatModel;
use App\Models\DetailPelatihanModel;
use App\Models\DetailSertifikasiModel;
use App\Models\LevelModel;
use App\Models\ProdiModel;
use App\Models\PangkatModel;
use App\Models\GolonganModel;
use App\Models\JabatanModel;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function getImageProfile($id)
    {
        try {
            $user = UserModel::findOrFail($id);
            $imagePath = public_path("/storage/photos/{$user->image}");
            $defaultImagePath = public_path("/storage/element/default-profile.jpg");

            // Cek apakah image ada atau tidak di database dan tidak kosong
            if (empty($user->image) || !file_exists($imagePath)) {
                Log::warning("Image not found for user {$id}. Returning default image.");
                return response()->file($defaultImagePath);
            }

            // Jika image ada, tampilkan gambar user
            return response()->file($imagePath);
        } catch (\Exception $e) {
            Log::error('Error fetching image: ' . $e->getMessage());
            return response()->json(['error' => 'Image not found or server error', 'message' => $e->getMessage()], 500);
        }
    }



    public function getDataProfile($id)
    {
        try {
            // Ambil data pengguna
            $user = UserModel::findOrFail($id);

            // Ambil data model terkait
            $level = LevelModel::find($user->id_level);
            $prodi = ProdiModel::find($user->id_prodi);
            $pangkat = PangkatModel::find($user->id_pangkat);
            $golongan = GolonganModel::find($user->id_golongan);
            $jabatan = JabatanModel::find($user->id_jabatan);

            return response()->json([
                'user' => $user,
                'nama_level' => $level->nama,
                'nama_prodi' => $prodi->nama,
                'nama_pangkat' => $pangkat->nama,
                'nama_golongan' => $golongan->nama,
                'nama_jabatan' => $jabatan->nama,
                'password' => $user->password,
            ]);
        } catch (\Exception $e) {
            // Log error dan kembalikan response jika terjadi exception
            Log::error('Error fetching data profile: ' . $e->getMessage());
            return response()->json(['error' => 'Data profil tidak ditemukan atau terjadi kesalahan server', 'message' => $e->getMessage()], 500);
        }
    }

    public function getOwnPelatihan($id)
{
    try {
        // Join the tables to fetch the necessary details
        $detailPelatihan = DetailPelatihanModel::select('t_detail_pelatihan.*', 
                                                        'm_pelatihan.nama as nama_pelatihan',
                                                        'm_vendor.nama as nama_vendor',
                                                        'm_periode.tahun',
                                                        'm_pelatihan.level_pelatihan')
            ->join('m_pelatihan', 't_detail_pelatihan.id_pelatihan', '=', 'm_pelatihan.id_pelatihan')
            ->join('m_vendor', 'm_pelatihan.id_vendor', '=', 'm_vendor.id_vendor')
            ->join('m_periode', 'm_pelatihan.id_periode', '=', 'm_periode.id_periode')
            ->where('t_detail_pelatihan.id_user', $id)
            ->where('t_detail_pelatihan.status', 'Completed')
            ->get();

        if ($detailPelatihan->isEmpty()) {
            Log::warning("No training data found for user {$id}.");
            return response()->json(['error' => 'No pelatihan data found for the user'], 404);
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

public function getOwnSertifikasi($id)
{
    try {
        // Join the tables to fetch the necessary details
        $detailSertifikasi = DetailSertifikasiModel::select('t_detail_sertifikasi.*', 
                                                        'm_sertifikasi.nama as nama_sertifikasi',
                                                        'm_vendor.nama as nama_vendor',
                                                        'm_periode.tahun',
                                                        'm_sertifikasi.jenis_sertifikasi')
            ->join('m_sertifikasi', 't_detail_sertifikasi.id_sertifikasi', '=', 'm_sertifikasi.id_sertifikasi')
            ->join('m_vendor', 'm_sertifikasi.id_vendor', '=', 'm_vendor.id_vendor')
            ->join('m_periode', 'm_sertifikasi.id_periode', '=', 'm_periode.id_periode')
            ->where('t_detail_sertifikasi.id_user', $id)
            ->where('t_detail_sertifikasi.status', 'Completed')
            ->get();

        if ($detailSertifikasi->isEmpty()) {
            Log::warning("No training data found for user {$id}.");
            return response()->json(['error' => 'No sertifikasi data found for the user'], 404);
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


    public function getUserBidangMinat($id)
    {
        try {
            // Ambil data bidang minat yang terkait dengan user berdasarkan id_user
            $bidangminat = BidangMinatModel::whereIn('id_bidangminat', function ($query) use ($id) {
                $query->select('id_bidangminat')
                    ->from('t_user_bidangminat')
                    ->where('id_user', $id);
            })->pluck('nama'); // Menggunakan pluck untuk mendapatkan hanya nama bidang minat

            return response()->json([
                'bidangminat' => $bidangminat,
            ]);
        } catch (\Exception $e) {
            // Log error dan kembalikan response jika terjadi exception
            Log::error('Error fetching data profile: ' . $e->getMessage());
            return response()->json(['error' => 'Data profil tidak ditemukan atau terjadi kesalahan server', 'message' => $e->getMessage()], 500);
        }
    }

    public function getUserMataKuliah($id)
    {
        try {
            // Ambil data bidang minat yang terkait dengan user berdasarkan id_user
            $matakuliah = MataKuliahModel::whereIn('id_matakuliah', function ($query) use ($id) {
                $query->select('id_matakuliah')
                    ->from('t_user_matakuliah')
                    ->where('id_user', $id);
            })->pluck('nama'); // Menggunakan pluck untuk mendapatkan hanya nama bidang minat

            return response()->json([
                'matakuliah' => $matakuliah,
            ]);
        } catch (\Exception $e) {
            // Log error dan kembalikan response jika terjadi exception
            Log::error('Error fetching data profile: ' . $e->getMessage());
            return response()->json(['error' => 'Data profil tidak ditemukan atau terjadi kesalahan server', 'message' => $e->getMessage()], 500);
        }
    }
}
