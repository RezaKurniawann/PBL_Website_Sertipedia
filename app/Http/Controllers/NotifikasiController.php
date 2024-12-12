<?php

namespace App\Http\Controllers;

use App\Models\DetailPelatihanModel;
use App\Models\DetailSertifikasiModel;
use App\Models\UserModel; 
use Illuminate\Http\Request;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
    public function showUser()
{
    $breadcrumb = (object)[
        'title' => 'Notifikasi',
        'list' => ['Home', 'Notifikasi']
    ];

    $page = (object)[
        'title' => 'Notifikasi'
    ];

    $activeMenu = 'notifikasi';

    $id_user = Auth::user()->id_user;

    // Ambil data pelatihan untuk user
    $detailPelatihan = DetailPelatihanModel::with(['pelatihan', 'user'])
        ->where('id_user', $id_user)
        ->get()
        ->unique('id_pelatihan')
        ->map(function ($item) {
            $item->type = 'Pelatihan';
            return $item;
        });

    // Ambil data sertifikasi untuk user
    $detailSertifikasi = DetailSertifikasiModel::with(['sertifikasi', 'user'])
        ->where('id_user', $id_user)
        ->get()
        ->unique('id_sertifikasi')
        ->map(function ($item) {
            $item->type = 'Sertifikasi';
            return $item;
        });

    $dataGabungan = $detailPelatihan->concat($detailSertifikasi);

    return view('user.pimpinan.notifikasi.index', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'dataGabungan' => $dataGabungan,
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
        ->where('status', 'Accepted')
        ->first()
        ?? DetailSertifikasiModel::with(['sertifikasi', 'user'])
            ->where('id_sertifikasi', $id)
            ->where('status', 'Accepted')
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
    public function exportPimPDF(Request $request)
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

        $pdf = Pdf::loadView('user.pimpinan.notifikasi.export', ['data' => $data]);
        return $pdf->download('export.pdf');
    }
    public function exportUserPDF(Request $request)
    {
        $type = $request->query('type');
        $id = $request->query('id');

        $data = null;

        if ($type == 'Pelatihan') {
            $data = DetailPelatihanModel::with(['pelatihan', 'user'])->where(['id_pelatihan', $id],['status','=','Accepted'])->first();
        } elseif ($type == 'Sertifikasi') {
            $data = DetailSertifikasiModel::with(['sertifikasi', 'user'])->where(['id_sertifikasi', $id],['status','=','Accepted'])->first();
        }

        if (!$data) {
            return redirect()->route('notifikasi.index')->with('error', 'Data tidak ditemukan.');
        }

        $pdf = Pdf::loadView('user.notifikasi.export', ['data' => $data]);
        return $pdf->download('export.pdf');
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'surat_tugas' => 'required|file|mimes:pdf|max:2048', // Maksimal 2MB, hanya file PDF
            'id_item' => 'required',
            'type' => 'required|in:Pelatihan,Sertifikasi' // Pastikan tipe valid
        ]);

        // Tentukan model yang sesuai berdasarkan tipe
        $model = $request->type === 'Pelatihan' ? DetailPelatihanModel::class : DetailSertifikasiModel::class;

        // Cari semua entri yang terkait dengan pelatihan/sertifikasi
        $items = $model::where($request->type === 'Pelatihan' ? 'id_pelatihan' : 'id_sertifikasi', $request->id_item)->get();

        if ($items->isEmpty()) {
            return redirect()->route('notifikasi.index')->with('error', 'Data tidak ditemukan.');
        }

        // Upload file surat tugas
        if ($request->hasFile('surat_tugas')) {
            $file = $request->file('surat_tugas');
            $filePath = $file->store('surat_tugas', 'public'); 

            // Perbarui semua entri terkait dengan status dan path surat tugas
            foreach ($items as $item) {
                $item->update([
                    'surat_tugas' => $filePath,
                    'status' => 'On going'
                ]);
            }

            return redirect()->route('notifikasi.index')->with('success', 'Surat tugas berhasil diunggah dan status diperbarui untuk semua pengguna terkait.');
        }

        return redirect()->route('notifikasi.index')->with('error', 'Gagal mengunggah surat tugas.');
    }

}
