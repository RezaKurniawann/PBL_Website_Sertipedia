<?php
namespace App\Http\Controllers;

use App\Models\MataKuliahModel;
use App\Models\BidangMinatModel;
use App\Models\PeriodeModel;
use App\Models\VendorModel;
use App\Models\SertifikasiModel; // Tambahkan Model untuk m_Sertifikasi
use App\Models\DetailSertifikasiModel; // Tambahkan Model untuk detail_Sertifikasi

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

        // Query untuk data pelatihan
        $sertifikasi = DetailSertifikasiModel::with(['sertifikasi', 'user'])
            ->get();

        return view('user.pimpinan.verifikasi.sertifikasi', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'matakuliah' => $matakuliah,
            'bidangminat' => $bidangminat,
            'periode' => $periode,
            'vendor' => $vendor,
            'sertifikasi' => $sertifikasi, // Data pelatihan dikirim ke view
            'activeMenu' => $activeMenu
        ]);
    }
}
