<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailSertifikasiModel;
use Illuminate\Support\Facades\Storage;

class DetailSertifikasiController extends Controller
{
    public function index ()
    {
        return DetailSertifikasiModel::all();
    }

    public function show(DetailSertifikasiModel $detailSertifikasi)
    {
        return response()->json($detailSertifikasi);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'no_sertifikasi' => 'required|string',
            'image' => 'required|string',
        ]);

        try {
            $detailSertifikasi = DetailSertifikasiModel::findOrFail($id);

            $detailSertifikasi->no_sertifikasi = $request->input('no_sertifikasi');

            // Decode the base64 image
            $imageData = base64_decode($request->input('image'));

            // Get image type from the base64 string
            $imageType = $this->getImageType($imageData);
            if (!$imageType) {
                return response()->json(['error' => 'Invalid image type'], 400);
            }

            // Create a unique hashed filename with the correct extension
            $imageName = md5(uniqid(rand(), true)) . '.' . $imageType;  // Using md5 hash for the filename

            // Create a new image instance and store it in public/storage/photos directory
            Storage::disk('public')->put("photos/{$imageName}", $imageData);

            // Update the image path in the database (you can save the full path or just the filename)
            $detailSertifikasi->image = $imageName;

            $detailSertifikasi->status = 'Completed';
            $detailSertifikasi->save();

            return response()->json(['message' => 'Image updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update image', 'details' => $e->getMessage()], 500);
        }
    }

    // Helper function to determine image type from base64 string
    private function getImageType($imageData)
    {
        // Create a finfo resource for mime type detection
        $finfo = finfo_open(FILEINFO_MIME_TYPE); // Corrected to FILEINFO_MIME_TYPE
        $imageInfo = finfo_buffer($finfo, $imageData);
        finfo_close($finfo);
        
        // Supported image mime types
        $imageTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (in_array($imageInfo, $imageTypes)) {
            // Return extension based on mime type
            switch ($imageInfo) {
                case 'image/jpeg':
                    return 'jpg';
                case 'image/png':
                    return 'png';
                case 'image/gif':
                    return 'gif';
            }
        }
        return null; // Invalid image type
    }
}
