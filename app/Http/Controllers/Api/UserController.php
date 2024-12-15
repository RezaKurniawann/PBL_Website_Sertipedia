<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return UserModel::all();
    }

    public function show(UserModel $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'no_telp' => 'required|string',
            'nip' => 'required|string',
            'image' => 'nullable|string',
            'old_password' => 'nullable|string', 
            'new_password' => 'nullable|string|min:6', 
        ]);

        try {
            $user = UserModel::findOrFail($id);

            if ($request->has('old_password') && $request->has('new_password')) {
                // Check if the old password matches the stored password
                if (!Hash::check($request->input('old_password'), $user->password)) {
                    return response()->json(['error' => 'Old password is incorrect'], 400);
                }

                $user->password = Hash::make($request->input('new_password'));
            }

            $user->nama = $request->input('nama');
            $user->email = $request->input('email');
            $user->no_telp = $request->input('no_telp');
            $user->nip = $request->input('nip');

            if ($request->has('image') && !empty($request->input('image'))) {
                $imageData = base64_decode($request->input('image'));

  
                $imageType = $this->getImageType($imageData);
                if (!$imageType) {
                    return response()->json(['error' => 'Invalid image type'], 400);
                }

                $imageName = md5(uniqid(rand(), true)) . '.' . $imageType;

                Storage::disk('public')->put("photos/{$imageName}", $imageData);

                $user->image = $imageName;
            }

            $user->save();

            return response()->json(['message' => 'User updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update user', 'details' => $e->getMessage()], 500);
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
            switch ($imageInfo) {
                case 'image/jpeg':
                    return 'jpg';
                case 'image/png':
                    return 'png';
                case 'image/gif':
                    return 'gif';
            }
        }
        return null; 
    }
}
