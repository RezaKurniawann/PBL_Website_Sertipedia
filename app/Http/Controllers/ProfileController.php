<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\DetailPelatihanModel;
use App\Models\DetailSertifikasiModel;
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
        // $user = UserModel::with([
        //     'prodi', 
        //     'pangkat', 
        //     'golongan', 
        //     'jabatan', 
        //     'sertifikasi' => function ($query) {
        //         $query->where('status', 'Completed')->with(['vendor', 'periode']);
        //     },
        //     'pelatihan' => function ($query) {
        //         $query->where('status', 'Completed')->with(['vendor', 'periode']);
        //     },
        // ])->findOrFail(Auth::id());

        $user = UserModel::with(['prodi', 'mataKuliah', 'bidangMinat', 'jabatan', 'pangkat', 'golongan'])->findOrFail(Auth::id());
        $pelatihan = DetailPelatihanModel::where('id_user', Auth::id())
            ->where('status', 'Completed')
            ->with('pelatihan')
            ->get();
        $sertifikasi = DetailSertifikasiModel::where('id_user', Auth::id())
        ->where('status', 'Completed')
        ->with('sertifikasi')
        ->get();
        // Breadcrumb dan active menu
        $breadcrumb = (object) [
            'title' => 'Profile',
            'list' => ['Home', 'Profile'],
        ];
        $activeMenu = 'profile';

        // Return view
        return view('profile.index', [
            'user' => $user,
            'pelatihan' => $pelatihan,
            'sertifikasi' => $sertifikasi,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
        ]);
    }

    // Method untuk memperbarui profile
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $this->validate($request, [
            'nama' => 'sometimes|required|string|max:100',
            'username' => 'sometimes|required|string|min:3|unique:m_user,username,' . $id . ',id_user',
            'email' => 'required|email|unique:m_user,email,' . $id . ',id_user',
            'no_telp' => 'nullable|string|max:15',
            'old_password' => 'nullable|string',
            'password' => 'nullable|string|min:5|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Ambil data user berdasarkan ID
        $user = UserModel::findOrFail($id);

        // Update hanya jika field ada di request
        // if ($request->has('username')) {
        //     $user->username = $request->username;
        // }

        // Perbarui field secara eksplisit
        if ($request->has('nama')) {
            $user->nama = $request->nama;
        }

        if ($request->has('username')) {
            $user->username = $request->username;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('no_telp')) {
            $user->no_telp = $request->no_telp;
        }

        // Jika password lama diisi dan benar, ganti password
        if ($request->filled('old_password') && Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
        } elseif ($request->filled('old_password')) {
            return response()->json(['success' => false, 'message' => 'Password lama tidak sesuai']);
        }

        // Handle upload image jika ada file baru
        if ($request->hasFile('image')) {
            // Hapus image lama jika ada
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // Simpan image baru
            $fileName = $request->file('image')->hashName();
            $request->file('image')->storeAs('public/photos', $fileName);
            $user->image = $fileName;
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