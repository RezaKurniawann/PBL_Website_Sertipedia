<?php
namespace App\Http\Controllers;
use App\Models\DetailPelatihanModel;
use App\Models\DetailSertifikasiModel;
use Illuminate\Http\Request;


class NotifikasiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Notifikasi',
            'list' => ['Home', 'Notifikasi']
        ];

        $page = (object) [
            'title' => 'Notifikasi'
        ];

        $activeMenu = 'notifikasi';

        // Ambil data pelatihan
        $detailPelatihan = DetailPelatihanModel::with('pelatihan')
            ->distinct('id_pelatihan')
            ->get()
            ->unique('id_pelatihan')
            ->map(function ($item) {
                $item->type = 'Pelatihan'; // Tandai sebagai pelatihan
                return $item;
            });

        // Ambil data sertifikasi
        $detailSertifikasi = DetailSertifikasiModel::with('sertifikasi')
            ->distinct('id_sertifikasi')
            ->get()
            ->unique('id_sertifikasi')
            ->map(function ($item) {
                $item->type = 'Sertifikasi'; // Tandai sebagai sertifikasi
                return $item;
            });

        // Gabungkan data pelatihan dan sertifikasi
        $dataGabungan = $detailPelatihan->merge($detailSertifikasi);

        return view('admin.notifikasi.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'dataGabungan' => $dataGabungan, // Kirim data gabungan ke view
            'activeMenu' => $activeMenu
        ]);
    }
    public function detail($id)
    {
        $breadcrumb = (object) [
            'title' => 'Detail Notifikasi',
            'list' => ['Home', 'Notifikasi', 'Detail']
        ];
    
        $page = (object) [
            'title' => 'Detail Notifikasi'
        ];
    
        $activeMenu = 'notifikasi';
    
        // Cari data berdasarkan ID
        $item = DetailPelatihanModel::with('pelatihan', 'user')->where('id', $id)->first()
            ?? DetailSertifikasiModel::with('sertifikasi', 'user')->where('id', $id)->first();
    
        if (!$item) {
            return redirect()->route('notifikasi.index')->with('error', 'Data tidak ditemukan.');
        }
    
        return view('admin.notifikasi.detail', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'item' => $item
        ]);
    }    
}
