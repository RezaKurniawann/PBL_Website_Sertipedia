<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;
use App\Models\SertifikasiModel;
use App\Models\PelatihanModel;
use App\Models\VendorModel;
use Yajra\DataTables\Facades\DataTables;


class StatistikController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Statistik',
            'list' => ['Home', 'Statistik']
        ];

        $page = (object) [
            'title' => 'Laporan Visualisasi'
        ];

        $activeMenu = 'statistik';


        // Dapatkan jumlah user, sertifikasi, pelatihan
        $userCount = UserModel::count();
        $sertifikasiCount = SertifikasiModel::count();
        $pelatihanCount = PelatihanModel::count();

        // Ambil filter tanggal dari request
        $tahunFilterSertifikasi = $request->input('periodeSertifikasi', now()->format('Y-m-d'));
        $tahunFilterPelatihan = $request->input('periodePelatihan', now()->format('Y-m-d'));

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


        if ($tahunFilterSertifikasi) {
            $queryStatusSertifikasi->whereRaw('YEAR(td.created_at) = ?', [$tahunFilterSertifikasi]);
        }

        if ($tahunFilterPelatihan) {
            $queryStatusPelatihan->whereRaw('YEAR(td.created_at) = ?', [$tahunFilterPelatihan]);
        }


        // Ambil data dari query
        $dataStatusSertifikasi = $queryStatusSertifikasi->get();
        $dataStatusPelatihan = $queryStatusPelatihan->get();

        // Status yang diharapkan
        $statusesSertifikasi = ['Requested', 'Accepted', 'Rejected', 'On Going', 'Completed'];
        $statusesPelatihan = ['Requested', 'Accepted', 'Rejected', 'On Going', 'Completed'];

        // Proses data sertifikasi
        $statusCountSertifikasi = array_fill_keys($statusesSertifikasi, 0);
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
        $statusCountPelatihan = array_fill_keys($statusesPelatihan, 0);
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

        // Ambil daftar tanggal unik dari kolom created_at untuk dropdown
        $daftarPeriodeSertifikasi = DB::table('sertipedia.t_detail_sertifikasi')
            ->select(DB::raw('DATE(created_at) AS tanggal'))
            ->distinct()
            ->pluck('tanggal', 'tanggal');

        $daftarPeriodePelatihan = DB::table('sertipedia.t_detail_pelatihan')
            ->select(DB::raw('DATE(created_at) AS tanggal'))
            ->distinct()
            ->pluck('tanggal', 'tanggal');

        return view('user.pimpinan.statistik.index', compact(
            'breadcrumb',
            'page',
            'activeMenu',
            'userCount',
            'sertifikasiCount',
            'pelatihanCount',
            'chartDataSertifikasi',
            'chartDataPelatihan',
            'daftarPeriodeSertifikasi',
            'daftarPeriodePelatihan',
            'tahunFilterSertifikasi',
            'tahunFilterPelatihan'
        ));
    }

    public function listSertifikasi(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Statistik',
            'list' => ['Home', 'Statistik']
        ];

        $page = (object) [
            'title' => 'Detail Sertifikasi'
        ];

        $activeMenu = 'statistik';

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
        return view('user.pimpinan.statistik.detail_sertifikasi', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }


    public function listPelatihan(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Statistik',
            'list' => ['Home', 'Statistik']
        ];

        $page = (object) [
            'title' => 'Detail Pelatihan'
        ];

        $activeMenu = 'statistik';

        $pelatihan = pelatihanModel::with(['vendor', 'periode']);

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
        return view('user.pimpinan.statistik.detail_Pelatihan', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function indexAdmin(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Statistik',
            'list' => ['Home', 'Statistik']
        ];

        $page = (object) [
            'title' => 'Laporan Visualisasi'
        ];

        $activeMenu = 'statistik';


        // Dapatkan jumlah user, sertifikasi, pelatihan
        $userCount = UserModel::count();
        $sertifikasiCount = SertifikasiModel::count();
        $pelatihanCount = PelatihanModel::count();
        $vendorCount = VendorModel::count();

        // Ambil filter tanggal dari request
        $tahunFilterSertifikasi = $request->input('periodeSertifikasi', now()->format('Y-m-d'));
        $tahunFilterPelatihan = $request->input('periodePelatihan', now()->format('Y-m-d'));

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


        if ($tahunFilterSertifikasi) {
            $queryStatusSertifikasi->whereRaw('YEAR(td.created_at) = ?', [$tahunFilterSertifikasi]);
        }

        if ($tahunFilterPelatihan) {
            $queryStatusPelatihan->whereRaw('YEAR(td.created_at) = ?', [$tahunFilterPelatihan]);
        }


        // Ambil data dari query
        $dataStatusSertifikasi = $queryStatusSertifikasi->get();
        $dataStatusPelatihan = $queryStatusPelatihan->get();

        // Status yang diharapkan
        $statusesSertifikasi = ['Requested', 'Accepted', 'Rejected', 'On Going', 'Completed'];
        $statusesPelatihan = ['Requested', 'Accepted', 'Rejected', 'On Going', 'Completed'];

        // Proses data sertifikasi
        $statusCountSertifikasi = array_fill_keys($statusesSertifikasi, 0);
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
        $statusCountPelatihan = array_fill_keys($statusesPelatihan, 0);
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

        // Ambil daftar tanggal unik dari kolom created_at untuk dropdown
        $daftarPeriodeSertifikasi = DB::table('sertipedia.t_detail_sertifikasi')
            ->select(DB::raw('DATE(created_at) AS tanggal'))
            ->distinct()
            ->pluck('tanggal', 'tanggal');

        $daftarPeriodePelatihan = DB::table('sertipedia.t_detail_pelatihan')
            ->select(DB::raw('DATE(created_at) AS tanggal'))
            ->distinct()
            ->pluck('tanggal', 'tanggal');

        return view('admin.statistik.statistik', compact(
            'breadcrumb',
            'page',
            'activeMenu',
            'userCount',
            'sertifikasiCount',
            'pelatihanCount',
            'vendorCount',
            'chartDataSertifikasi',
            'chartDataPelatihan',
            'daftarPeriodeSertifikasi',
            'daftarPeriodePelatihan',
            'tahunFilterSertifikasi',
            'tahunFilterPelatihan'
        ));
    }
}
