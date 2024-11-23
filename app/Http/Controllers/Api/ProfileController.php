<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\MataKuliahModel;
use App\Models\BidangMinatModel;
use App\Models\LevelModel;
use App\Models\ProdiModel;
use App\Models\PangkatModel;
use App\Models\GolonganModel;
use App\Models\JabatanModel;

use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function getImageProfile($id)
    {
        try {
            $user = UserModel::findOrFail($id);
            $imagePath = public_path("/storage/photos/{$user->image}");
            $defaultImagePath = public_path("/storage/element/default-profile.jpg");

            // Check if the user's image exists
            if (!file_exists($imagePath)) {
                Log::warning("Image not found: {$imagePath}. Returning default image.");
                // If the image doesn't exist, return the default image
                return response()->file($defaultImagePath);
            }

            // If the image exists, return it
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
            ]);
        } catch (\Exception $e) {
            // Log error dan kembalikan response jika terjadi exception
            Log::error('Error fetching data profile: ' . $e->getMessage());
            return response()->json(['error' => 'Data profil tidak ditemukan atau terjadi kesalahan server', 'message' => $e->getMessage()], 500);
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
