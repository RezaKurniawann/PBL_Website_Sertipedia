<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\DetailPelatihanModel;
use App\Models\DetailSertifikasiModel;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Home Page',
            'list' => ['Home', 'HomePage']
        ];
    
        $page = (object) [
            'title' => 'Dosen Jurusan Teknologi Informasi'
        ];
    
        // Mengambil nilai 'perPage' dan 'search' dari query parameter
        $perPage = $request->input('perPage', 9);
        $searchTerm = $request->input('search', '');
    
        // Membuat query dasar untuk mengambil data dosen dengan relasi 'prodi' dan 'bidangMinat'
        $query = UserModel::with(['prodi', 'bidangMinat'])
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('nama', 'like', "%$searchTerm%")
                             ->orWhereHas('prodi', function ($query) use ($searchTerm) {
                                 $query->where('nama', 'like', "%$searchTerm%");
                             })
                             ->orWhereHas('bidangMinat', function ($query) use ($searchTerm) {
                                 $query->where('nama', 'like', "%$searchTerm%");
                             });
            });
    
        // Pagination berdasarkan 'perPage' dan query pencarian
        $users = $query->paginate($perPage);
    
        $activeMenu = 'home';
    
        if ($request->ajax()) {
            return view('user.partials.users', compact('users'));
        }
    
        return view('user.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'users' => $users,
            'activeMenu' => $activeMenu,
            'searchTerm' => $searchTerm
        ]);
    }
 
    public function show($id_user)
    {
        $breadcrumb = (object)[
            'title' => 'Home Page',
            'list' => ['Home', 'HomePage', 'Detail']
        ];

        $activeMenu = 'home';
        $user = UserModel::with(['prodi', 'mataKuliah', 'bidangMinat', 'jabatan', 'pangkat', 'Golongan'])->find($id_user);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found');
        }

        $pelatihan = DetailPelatihanModel::where('id_user', $id_user)
            ->where('status', 'Completed')
            ->with('pelatihan')
            ->get();

        $sertifikasi = DetailSertifikasiModel::where('id_user', $id_user)
        ->where('status', 'Completed')
        ->with('sertifikasi')
        ->get();

        return view('user.show', compact('user', 'pelatihan', 'sertifikasi', 'activeMenu', 'breadcrumb'));
    }

}