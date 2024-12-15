<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;
use App\Models\SertifikasiModel;
use App\Models\PelatihanModel;
use Yajra\DataTables\Facades\DataTables;

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        // Dapatkan jumlah user, sertifikasi, pelatihan
        $userCount = UserModel::count();
        $sertifikasiCount = SertifikasiModel::count();
        $pelatihanCount = PelatihanModel::count();

        // Ambil filter tahun dari request atau gunakan tahun saat ini
        $tahunFilter = $request->get('tahun', now()->year);

        // Query data sertifikasi
        $queryStatusSertifikasi = DB::table('sertipedia.t_detail_sertifikasi AS td')
            ->select(
                DB::raw('YEAR(td.created_at) AS periode_tahun'),
                'td.status',
                DB::raw('COUNT(td.status) AS jumlah_status')
            )
            ->groupBy(DB::raw('YEAR(td.created_at)'), 'td.status')
            ->orderByRaw("FIELD(td.status, 'Requested', 'Accepted', 'Rejected', 'On Going', 'Completed')");

        // Query data pelatihan
        $queryStatusPelatihan = DB::table('sertipedia.t_detail_pelatihan AS td')
            ->select(
                DB::raw('YEAR(td.created_at) AS periode_tahun'),
                'td.status',
                DB::raw('COUNT(td.status) AS jumlah_status')
            )
            ->groupBy(DB::raw('YEAR(td.created_at)'), 'td.status')
            ->orderByRaw("FIELD(td.status, 'Requested', 'Accepted', 'Rejected', 'On Going', 'Completed')");

        // Jika tahunFilter tidak kosong, tambahkan filter where
        if ($tahunFilter) {
            $queryStatusSertifikasi->where(DB::raw('YEAR(td.created_at)'), $tahunFilter);
            $queryStatusPelatihan->where(DB::raw('YEAR(td.created_at)'), $tahunFilter);
        }

        // Ambil data dari query
        $dataStatusSertifikasi = $queryStatusSertifikasi->get();
        $dataStatusPelatihan = $queryStatusPelatihan->get();

        // Status yang diharapkan
        $statuses = ['Requested', 'Accepted', 'Rejected', 'On Going', 'Completed'];

        // Proses data sertifikasi
        $statusCountSertifikasi = array_fill_keys($statuses, 0);
        foreach ($dataStatusSertifikasi as $row) {
            $statusCountSertifikasi[$row->status] = $row->jumlah_status;
        }

        $chartDataSertifikasi = [
            'labels' => array_keys($statusCountSertifikasi),
            'datasets' => [
                [
                    'label' => 'Jumlah Status Sertifikasi',
                    'data' => array_values($statusCountSertifikasi),
                    'backgroundColor' => [
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                    ],
                ],
            ],
        ];

        // Proses data pelatihan
        $statusCountPelatihan = array_fill_keys($statuses, 0);
        foreach ($dataStatusPelatihan as $row) {
            $statusCountPelatihan[$row->status] = $row->jumlah_status;
        }

        $chartDataPelatihan = [
            'labels' => array_keys($statusCountPelatihan),
            'datasets' => [
                [
                    'label' => 'Jumlah Status Pelatihan',
                    'data' => array_values($statusCountPelatihan),
                    'backgroundColor' => [
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                    ],
                ],
            ],
        ];

        // Ambil daftar tanggal unik
        $daftarPeriodeSertifikasi = DB::table('sertipedia.t_detail_sertifikasi')
            ->select(DB::raw('DATE(created_at) AS tanggal'))
            ->distinct()
            ->pluck('tanggal');

        $daftarPeriodePelatihan = DB::table('sertipedia.t_detail_pelatihan')
            ->select(DB::raw('DATE(created_at) AS tanggal'))
            ->distinct()
            ->pluck('tanggal');

        // Mengembalikan data dalam format JSON
        return response()->json([
            'userCount' => $userCount,
            'sertifikasiCount' => $sertifikasiCount,
            'pelatihanCount' => $pelatihanCount,
            'chartDataSertifikasi' => $chartDataSertifikasi,
            'chartDataPelatihan' => $chartDataPelatihan,
            'daftarPeriodeSertifikasi' => $daftarPeriodeSertifikasi,
            'daftarPeriodePelatihan' => $daftarPeriodePelatihan,
            'tahunFilter' => $tahunFilter,
        ]);
    }

    public function listSertifikasi(Request $request)
    {
        $sertifikasi = SertifikasiModel::with(['vendor', 'periode']);

        if ($request->ajax()) {
            return DataTables::of($sertifikasi)
                ->addColumn('vendor', function ($row) {
                    return $row->vendor->nama;
                })
                ->addColumn('periode', function ($row) {
                    return $row->periode->tahun;
                })
                ->make(true);
        }

        return response()->json([
            'sertifikasi' => $sertifikasi->get(),  
        ]);
    }

    public function listPelatihan(Request $request)
    {
        $pelatihan = PelatihanModel::with(['vendor', 'periode']);

        if ($request->ajax()) {
            return DataTables::of($pelatihan)
                ->addColumn('vendor', function ($row) {
                    return $row->vendor->nama;
                })
                ->addColumn('periode', function ($row) {
                    return $row->periode->tahun;
                })
                ->make(true);
        }

        return response()->json([
            'pelatihan' => $pelatihan->get(), 
        ]);
    }
}
