<?php

namespace App\Http\Controllers;

use App\Models\PelatihanModel;
use App\Models\PeriodeModel;
use App\Models\UserModel;
use App\Models\VendorModel;
use App\Models\DetailPelatihanModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class DetailPelatihanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Detail Pelatihan',
            'list' => ['Home', 'Detail Pelatihan']
        ];

        $page = (object) [
            'title' => 'Daftar detail pelatihan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-detailevent';

        $user = UserModel::all();
        $pelatihan = PelatihanModel::all();

        return view('admin.detailEvent.pelatihan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'pelatihan' => $pelatihan, 'activeMenu' => $activeMenu]);
    }

    public function formDataPelatihan()
    {
        $user = UserModel::findOrFail(Auth::id());
        $pelatihan = PelatihanModel::all();
        $vendor = VendorModel::where('kategori', 'Pelatihan')->get();
        $periode = PeriodeModel::all();

        $breadcrumb = (object) [
            'title' => 'Form Pelatihan',
            'list' => ['Home', 'Form Pelatihan']
        ];

        $activeMenu = 'inputdata';

        return view('user.inputdata.pelatihan', [
            'user' => $user,
            'pelatihan' => $pelatihan,
            'vendor' => $vendor,
            'periode' => $periode,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function uploadDataPelatihan(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'id_vendor' => 'required|exists:m_vendor,id_vendor',
            'level_pelatihan' => 'required|in:Nasional,Internasional',
            'id_periode' => 'required|exists:m_periode,id_periode',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $pelatihan = PelatihanModel::where([
            ['nama', '=', $validated['nama']],
            ['id_vendor', '=', $validated['id_vendor']],
            ['level_pelatihan', '=', $validated['level_pelatihan']],
            ['id_periode', '=', $validated['id_periode']],
        ])->first();

        if ($pelatihan) {
            $detailPelatihan = DetailPelatihanModel::where([
                ['id_user', '=', $id], 
                ['id_pelatihan', '=', $pelatihan->id_pelatihan], 
            ])->first();
        
            if ($detailPelatihan) {
                if ($request->hasFile('image')) {
                    if ($detailPelatihan->image && Storage::disk('public')->exists('photos/' . $detailPelatihan->image)) {
                        Storage::disk('public')->delete('photos/' . $detailPelatihan->image);
                    }
                    $fileName = $request->file('image')->hashName();
                    $request->file('image')->storeAs('public/photos', $fileName);
                    $detailPelatihan->image = $fileName;
                    $detailPelatihan->status = "Completed";
                }
    
                $detailPelatihan->save();
        
                return redirect()->back()->with('status', 'Profil berhasil diperbarui');
            } else {
                return response()->json(['message' => 'Detail Pelatihan tidak ditemukan'], 404);
            }
        } else {
            return response()->json(['message' => 'Pelatihan tidak ditemukan'], 404);
        }
    }
}
