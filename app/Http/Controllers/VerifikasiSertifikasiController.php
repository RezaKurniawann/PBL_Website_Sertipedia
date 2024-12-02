<?php
namespace App\Http\Controllers;

use App\Models\MataKuliahModel;
use App\Models\BidangMinatModel;
use App\Models\PeriodeModel;
use App\Models\VendorModel;
use App\Models\SertifikasiModel;
use App\Models\DetailSertifikasiModel;

use Illuminate\Http\Request;

class VerifikasiSertifikasiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pengajuan Sertifikasi',
            'list' => ['Home', 'Sertifikasi']
        ];

        $page = (object) [
            'title' => 'Daftar Pengajuan Sertifikasi'
        ];

        $activeMenu = 'verifikasi';
        $activeSubMenu = 'sertifikasi';
        
        // Data untuk dropdown
        $matakuliah = MataKuliahModel::all();
        $bidangminat = BidangMinatModel::all();
        $periode = PeriodeModel::all();
        $vendor = VendorModel::all();
        
        // Query untuk data detail sertifikasi dengan relasi sertifikasi
        $detailSertifikasi = DetailSertifikasiModel::with('sertifikasi')->distinct('id_sertifikasi')->get();
        $detailSertifikasi = $detailSertifikasi->unique('id_sertifikasi');

        return view('user.pimpinan.verifikasi.sertifikasi', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'matakuliah' => $matakuliah,
            'bidangminat' => $bidangminat,
            'periode' => $periode,
            'vendor' => $vendor,
            'sertifikasi' => $detailSertifikasi, // Data detail sertifikasi dikirim ke view
            'activeMenu' => $activeMenu
        ]);
    }
 

    public function detail($id)
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pengajuan Sertifikasi',
            'list' => ['Home', 'Sertifikasi']
        ];

        $page = (object) [
            'title' => 'Daftar Pengajuan Sertifikasi'
        ];
        $activeMenu = 'verifikasi';
        $activeSubMenu = 'sertifikasi';

        // Mengambil semua detail sertifikasi berdasarkan id_sertifikasi
        $detailSertifikasi = DetailSertifikasiModel::with('user', 'sertifikasi') // Mengambil data user dan sertifikasi
            ->where('id_sertifikasi', $id) // Menyaring berdasarkan id_sertifikasi
            ->get(); // Mengambil semua data terkait

        // Kirim data ke view
        return view('user.pimpinan.verifikasi.detail-sertifikasi', compact('detailSertifikasi'), [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }
    public function accepted($id){
        $breadcrumb = (object) [
            'title' => 'Daftar Pengajuan Sertifikasi',
            'list' => ['Home', 'Sertifikasi']
        ];

        $page = (object) [
            'title' => 'Daftar Pengajuan Sertifikasi'
        ];
        $activeMenu = 'verifikasi';
        $activeSubMenu = 'sertifikasi';
        try {
            $affectedRows = DetailSertifikasiModel::where('id_sertifikasi', $id)
                ->update(['status' => 'Accepted']);
    
            if ($affectedRows > 0) {
                return redirect()->route('verifikasi.sertifikasi')->with('success', 'Status berhasil diperbarui ke Accepted.');
            } else {
                return redirect()->route('verifikasi.sertifikasi')->with('error', 'Tidak ada data yang diperbarui.');
            }
        } catch (\Exception $e) {
            return redirect()->route('verifikasi.sertifikasi')->with('error', 'Gagal memperbarui data. ' . $e->getMessage());
        }
    }
    public function rejected($id){
        $breadcrumb = (object) [
            'title' => 'Daftar Pengajuan Sertifikasi',
            'list' => ['Home', 'Sertifikasi']
        ];

        $page = (object) [
            'title' => 'Daftar Pengajuan Sertifikasi'
        ];
        $activeMenu = 'verifikasi';
        $activeSubMenu = 'sertifikasi';
        try {
            // Update semua data dengan id_sertifikasi yang sama
            $affectedRows = DetailSertifikasiModel::where('id_sertifikasi', $id)
                ->update(['status' => 'Rejected']);
    
            if ($affectedRows > 0) {
                return redirect()->route('verifikasi.sertifikasi')->with('success', 'Status berhasil diperbarui ke Rejected.');
            } else {
                return redirect()->route('verifikasi.sertifikasi')->with('error', 'Tidak ada data yang diperbarui.');
            }
        } catch (\Exception $e) {
            return redirect()->route('verifikasi.sertifikasi')->with('error', 'Gagal memperbarui data. ' . $e->getMessage());
        }
    }
}

