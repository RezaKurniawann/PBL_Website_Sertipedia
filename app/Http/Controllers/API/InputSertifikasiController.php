<?php

// namespace App\Http\Controllers\API;

// use App\Models\API\DetailSertifikasiModel;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;
// use App\Http\Controllers\Controller;

// class InputSertifikasiController extends Controller
// {
//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'nama' => 'required|string',
//             'no_sertifikasi' => 'required|string',
//             'vendor' => 'required|string',
//             'jenis_sertifikasi' => 'required|string',
//             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validasi image
//         ]);

//         $sertifikasi = DetailSertifikasiModel::where('nama', $request->nama)
//             ->where('no_sertifikasi', $request->no_sertifikasi)
//             ->where('vendor', $request->vendor)
//             ->where('jenis_sertifikasi', $request->jenis_sertifikasi)
//             ->first();

//         if (!$sertifikasi) {
//             return response()->json([
//                 'message' => 'Data sertifikasi tidak ditemukan. Pastikan data yang Anda masukkan sudah ada.',
//             ], 400);
//         }

//         if ($request->hasFile('image')) {
//             $imagePath = $request->file('image')->store('sertifikasi_images', 'public');
//             $sertifikasi->image = $imagePath;
//             $sertifikasi->save();

//             return response()->json([
//                 'message' => 'Gambar berhasil disimpan.',
//                 'image_path' => $imagePath,
//             ], 200);
//         }

//         return response()->json([
//             'message' => 'Tidak ada gambar yang diunggah.',
//         ], 400);
//     }
// }
