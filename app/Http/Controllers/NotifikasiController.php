<?php

namespace App\Http\Controllers;

use App\Models\DetailPelatihanModel;
use App\Models\DetailSertifikasiModel;
use App\Models\UserModel; 
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class NotifikasiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Notifikasi',
            'list' => ['Home', 'Notifikasi']
        ];

        $page = (object)[
            'title' => 'Notifikasi'
        ];

        $activeMenu = 'notifikasi';

        // Ambil data pelatihan
        $detailPelatihan = DetailPelatihanModel::with(['pelatihan', 'user'])
            ->get()
            ->unique('id_pelatihan') // Hindari duplikasi berdasarkan id_pelatihan
            ->map(function ($item) {
                $item->type = 'Pelatihan'; // Tandai sebagai pelatihan
                return $item;
            });

        // Ambil data sertifikasi
        $detailSertifikasi = DetailSertifikasiModel::with(['sertifikasi', 'user'])
            ->get()
            ->unique('id_sertifikasi') // Hindari duplikasi berdasarkan id_sertifikasi
            ->map(function ($item) {
                $item->type = 'Sertifikasi'; // Tandai sebagai sertifikasi
                return $item;
            });

        // Gabungkan data pelatihan dan sertifikasi
        $dataGabungan = $detailPelatihan->concat($detailSertifikasi);

        return view('admin.notifikasi.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'dataGabungan' => $dataGabungan, // Kirim data gabungan ke view
            'activeMenu' => $activeMenu
        ]);
    }

    public function detail($id)
    {
        $breadcrumb = (object)[
            'title' => 'Detail Notifikasi',
            'list' => ['Home', 'Notifikasi', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail Notifikasi'
        ];

        $activeMenu = 'notifikasi';

        // Cari data berdasarkan ID dari pelatihan atau sertifikasi
        $item = DetailPelatihanModel::with(['pelatihan', 'user'])
            ->where('id_pelatihan', $id)
            ->first()
            ?? DetailSertifikasiModel::with(['sertifikasi', 'user'])
                ->where('id_sertifikasi', $id)
                ->first();

        if (!$item) {
            return redirect()->route('notifikasi.index')->with('error', 'Data tidak ditemukan.');
        }

        // Tambahkan tipe untuk memastikan konsistensi
        $item->type = $item instanceof DetailPelatihanModel ? 'Pelatihan' : 'Sertifikasi';

        return view('admin.notifikasi.detail', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'item' => $item
        ]);
    }

    public function exportPdf(Request $request)
    {
        $type = $request->query('type');
        $id = $request->query('id');

        $data = null;

        if ($type == 'Pelatihan') {
            $data = DetailPelatihanModel::with(['pelatihan', 'user'])->where('id_pelatihan', $id)->first();
        } elseif ($type == 'Sertifikasi') {
            $data = DetailSertifikasiModel::with(['sertifikasi', 'user'])->where('id_sertifikasi', $id)->first();
        }

        if (!$data) {
            return redirect()->route('notifikasi.index')->with('error', 'Data tidak ditemukan.');
        }

        $pdf = Pdf::loadView('admin.notifikasi.export', ['data' => $data]);
        return $pdf->download('export.pdf');
    }
}
