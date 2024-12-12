<?php
namespace App\Http\Controllers;

use App\Models\MataKuliahModel;
use App\Models\BidangMinatModel;
use App\Models\PeriodeModel;
use App\Models\VendorModel;
use App\Models\PelatihanModel; // Tambahkan Model untuk m_pelatihan
use App\Models\DetailPelatihanModel;

use Illuminate\Http\Request;

class VerifikasiPelatihanController extends Controller
{
    public function index()
     {
         $breadcrumb = (object) [
             'title' => 'Daftar Pengajuan Pelatihan',
             'list' => ['Home', 'Pelatihan']
         ];
 
         $page = (object) [
             'title' => 'Daftar Pengajuan Pelatihan'
         ];
 
         $activeMenu = 'verifikasi';
         $activeSubMenu = 'pelatihan';
         
        // Data untuk dropdown
         $matakuliah = MataKuliahModel::all();
         $bidangminat = BidangMinatModel::all();
         $periode = PeriodeModel::all();
         $vendor = VendorModel::all();
         
        // Query untuk data pelatihan
        $detailPelatihan = DetailPelatihanModel::with('pelatihan')
        ->distinct('id_pelatihan')
        ->where('status','=','Requested')
        ->get();
        $detailPelatihan = $detailPelatihan->unique('id_pelatihan');

        return view('user.pimpinan.verifikasi.pelatihan', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'matakuliah' => $matakuliah,
            'bidangminat' => $bidangminat,
            'periode' => $periode,
            'vendor' => $vendor,
            'pelatihan' => $detailPelatihan, 
            'activeMenu' => $activeMenu
        ]);
     }
     public function detail($id)
     {
         $breadcrumb = (object) [
             'title' => 'Daftar Pengajuan Pelatihan',
             'list' => ['Home', 'Pelatihan']
         ];
 
         $page = (object) [
             'title' => 'Daftar Pengajuan Pelatihan'
         ];
         $activeMenu = 'verifikasi';
         $activeSubMenu = 'pelatihan';
 
         $detailPelatihan = DetailPelatihanModel::with('user', 'pelatihan') // Mengambil data user dan pelatihan
             ->where('id_pelatihan', $id) // Menyaring berdasarkan id_pelatihan
             ->get(); // Mengambil semua data terkait
 
         // Kirim data ke view
         return view('user.pimpinan.verifikasi.detail-pelatihan', compact('detailPelatihan'), [
             'breadcrumb' => $breadcrumb,
             'page' => $page,
             'activeMenu' => $activeMenu
         ]);
     }
     public function accepted($id){
         $breadcrumb = (object) [
             'title' => 'Daftar Pengajuan Pelatihan',
             'list' => ['Home', 'Pelatihan']
         ];
 
         $page = (object) [
             'title' => 'Daftar Pengajuan Pelatihan'
         ];
         $activeMenu = 'verifikasi';
         $activeSubMenu = 'pelatihan';
         try {
            $affectedRows = DetailPelatihanModel::where('id_pelatihan', $id)
                ->update(['status' => 'Accepted']);
    
            if ($affectedRows > 0) {
                return redirect()->route('verifikasi.pelatihan')->with('success', 'Status berhasil diperbarui ke Accepted.');
            } else {
                return redirect()->route('verifikasi.pelatihan')->with('error', 'Tidak ada data yang diperbarui.');
            }
        } catch (\Exception $e) {
            return redirect()->route('verifikasi.pelatihan')->with('error', 'Gagal memperbarui data. ' . $e->getMessage());
        }
     }
     public function rejected($id){
         $breadcrumb = (object) [
             'title' => 'Daftar Pengajuan Pelatihan',
             'list' => ['Home', 'Pelatihan']
         ];
 
         $page = (object) [
             'title' => 'Daftar Pengajuan Pelatihan'
         ];
         $activeMenu = 'verifikasi';
         $activeSubMenu = 'pelatihan';
         try {
            // Update semua data dengan id_pelatihan yang sama
            $affectedRows = DetailPelatihanModel::where('id_pelatihan', $id)
                ->update(['status' => 'Rejected']);
    
            if ($affectedRows > 0) {
                return redirect()->route('verifikasi.pelatihan')->with('success', 'Status berhasil diperbarui ke Rejected.');
            } else {
                return redirect()->route('verifikasi.pelatihan')->with('error', 'Tidak ada data yang diperbarui.');
            }
        } catch (\Exception $e) {
            return redirect()->route('verifikasi.pelatihan')->with('error', 'Gagal memperbarui data. ' . $e->getMessage());
        }
     }
}
