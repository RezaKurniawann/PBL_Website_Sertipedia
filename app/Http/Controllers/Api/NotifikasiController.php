<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailPelatihanModel;

class NotifikasiController extends Controller
{
    public function fetchData()
    {
        $data = DetailPelatihanModel::with('pelatihan') // Load related PelatihanModel
            ->get()
            ->map(function ($detail) {
                return [
                    'id_detail_pelatihan' => $detail->id_detail_pelatihan,
                    'nama' => $detail->pelatihan->nama, // Get related pelatihan name
                    'status' => $detail->status,
                    'image' => $detail->image,
                    'surat_tugas' => $detail->surat_tugas,
                    'created_at' => $detail->created_at,
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Data fetched successfully',
            'data' => $data,
        ]);
    }
}
