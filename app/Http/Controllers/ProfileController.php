<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\JabatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Method untuk menampilkan halaman profile
    public function index()
    {
        // Ambil data user berdasarkan ID yang sedang login
        $user = UserModel::with(['prodi', 'pangkat', 'golongan', 'jabatan', 'sertifikasi', 'pelatihan'])->findOrFail(Auth::id());


        // Breadcrumb dan active menu
        $breadcrumb = (object) [
            'title' => 'Profile',
            'list' => ['Home', 'Profile'],
        ];
        $activeMenu = 'profile';

        // Return view
        return view('profile.index', [
            'user' => $user,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
        ]);
    }

    // Method untuk memperbarui profile
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $this->validate($request, [
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',id_user',
            'nama' => 'required|string|max:100',
            'old_password' => 'nullable|string',
            'password' => 'nullable|min:5|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Ambil data user berdasarkan ID
        $user = UserModel::findOrFail($id);
        $user->username = $request->username;
        $user->nama = $request->nama;

        // Jika password lama diisi dan benar, ganti password
        if ($request->filled('old_password') && Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
        } elseif ($request->filled('old_password')) {
            return response()->json(['success' => false, 'message' => 'Password lama tidak sesuai']);
        }

        // Handle upload avatar jika ada file baru
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar && Storage::disk('public')->exists('photos/' . $user->avatar)) {
                Storage::disk('public')->delete('photos/' . $user->avatar);
            }

            // Simpan avatar baru
            $fileName = $request->file('avatar')->hashName();
            $request->file('avatar')->storeAs('public/photos', $fileName);
            $user->avatar = $fileName;
        }

        // Simpan perubahan data user
        $user->save();

        // Kembali ke halaman profile dengan status sukses
        return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui']);
    }

    // Method untuk menampilkan halaman form edit profile
    public function edit($id)
    {
        // Ambil data user berdasarkan ID
        $user = UserModel::with('jabatan')->findOrFail($id); // Tambahkan relasi 'jabatan'

        // Breadcrumb dan active menu
        $breadcrumb = (object) [
            'title' => 'Edit Profile',
            'list' => ['Home', 'Profile', 'Edit'],
        ];
        $activeMenu = 'profile';

        // Return view
        return view('profile.edit', [
            'user' => $user,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
        ]);
    }
}