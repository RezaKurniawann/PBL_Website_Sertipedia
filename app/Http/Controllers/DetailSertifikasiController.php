<?php

namespace App\Http\Controllers;

use App\Models\SertifikasiModel;
use App\Models\PeriodeModel;
use App\Models\UserModel;
use App\Models\VendorModel;
use App\Models\DetailSertifikasiModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class DetailSertifikasiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Detail Sertifikasi',
            'list' => ['Home', 'Detail Sertifikasi']
        ];

        $page = (object) [
            'title' => 'Daftar detail Sertifikasi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-detailevent';

        $user = UserModel::all();
        $sertifikasi = SertifikasiModel::all();

        return view('admin.detailEvent.Sertifikasi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'Sertifikasi' => $sertifikasi, 'activeMenu' => $activeMenu]);
    }

    public function formDataSertifikasi()
    {
        $user = UserModel::findOrFail(Auth::id());
        $sertifikasi = SertifikasiModel::all();
        $vendor = VendorModel::where('kategori', 'Sertifikasi')->get();
        $periode = PeriodeModel::all();

        $breadcrumb = (object) [
            'title' => 'Form Sertifikasi',
            'list' => ['Home', 'Form Sertifikasi']
        ];

        $activeMenu = 'inputdata';

        return view('user.inputdata.sertifikasi', [
            'user' => $user,
            'sertifikasi' => $sertifikasi,
            'vendor' => $vendor,
            'periode' => $periode,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function uploadDataSertifikasi(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'id_vendor' => 'required|exists:m_vendor,id_vendor',
            'no_sertifikasi' => 'required|string',
            'jenis_sertifikasi' => 'required|in:Profesi,Keahlian',
            'id_periode' => 'required|exists:m_periode,id_periode',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $sertifikasi = SertifikasiModel::where([
            ['nama', '=', $validated['nama']],
            ['id_vendor', '=', $validated['id_vendor']],
            ['jenis_sertifikasi', '=', $validated['jenis_sertifikasi']],
            ['id_periode', '=', $validated['id_periode']],
        ])->first();

        if ($sertifikasi) {
            $detailSertifikasi = DetailSertifikasiModel::where([
                ['id_user', '=', $id], 
                ['id_sertifikasi', '=', $sertifikasi->id_sertifikasi], 
            ])->first();
        
            if ($detailSertifikasi) {
                if ($request->hasFile('image')) {
                    if ($detailSertifikasi->image && Storage::disk('public')->exists('photos/' . $detailSertifikasi->image)) {
                        Storage::disk('public')->delete('photos/' . $detailSertifikasi->image);
                    }
                    $fileName = $request->file('image')->hashName();
                    $request->file('image')->storeAs('public/photos', $fileName);
                    $detailSertifikasi->image = $fileName;
                    $detailSertifikasi->status = "Completed";
                    $detailSertifikasi->no_sertifikasi = $validated['no_sertifikasi'];
                }
    
                $detailSertifikasi->save();
        
                return redirect()->back()->with('success', 'Data Berhasil Diupload!');
            } else {
                return redirect()->back()->with('error', 'Detail Sertifikasi Tidak Ditemukan!.');
            }
        } else {
            return redirect()->back()->with('error', 'Sertifikasi Tidak Ditemukan.');
        }
    }
}
