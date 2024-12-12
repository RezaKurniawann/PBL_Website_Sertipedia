<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;
use App\Models\SertifikasiModel;
use App\Models\PelatihanModel;
use App\Models\PeriodeModel;

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        // Dapatkan jumlah user, sertifikasi, pelatihan
        $userCount = UserModel::count();
        $sertifikasiCount = SertifikasiModel::count();
        $pelatihanCount = PelatihanModel::count();

        // Ambil filter tahun dari request, default ke tahun saat ini
        $tahunFilter = $request->input('periode');

        // Query data sertifikasi
        $queryStatusSertifikasi = DB::table('sertipedia.t_detail_sertifikasi AS td')
            ->join('sertipedia.m_sertifikasi AS s', 'td.id_sertifikasi', '=', 's.id_sertifikasi')
            ->join('sertipedia.m_periode AS p', 's.id_periode', '=', 'p.id_periode')
            ->select(DB::raw('p.tahun AS periode_tahun'), 'td.status', DB::raw('COUNT(td.status) AS jumlah_status'))
            ->groupBy('p.tahun', 'td.status')
            ->orderByRaw("FIELD(td.status, 'Requested', 'Accepted', 'Rejected', 'On Going', 'Completed')");

        // Query data pelatihan
        $queryStatusPelatihan = DB::table('sertipedia.t_detail_pelatihan AS td')
            ->join('sertipedia.m_pelatihan AS pl', 'td.id_pelatihan', '=', 'pl.id_pelatihan')
            ->join('sertipedia.m_periode AS pr', 'pl.id_periode', '=', 'pr.id_periode')
            ->select(DB::raw('pr.tahun AS periode_tahun'), 'td.status', DB::raw('COUNT(td.status) AS jumlah_status'))
            ->groupBy('pr.tahun', 'td.status')
            ->orderByRaw("FIELD(td.status, 'Requested', 'Accepted', 'Rejected', 'On Going', 'Completed')");

        // Jika tahunFilter tidak kosong, tambahkan filter where
        if ($tahunFilter) {
            $queryStatusSertifikasi->where('p.tahun', $tahunFilter);
            $queryStatusPelatihan->where('pr.tahun', $tahunFilter);
        }

        // Ambil data dari query
        $dataStatusSertifikasi = $queryStatusSertifikasi->get();
        $dataStatusPelatihan = $queryStatusPelatihan->get();

        // Status yang diharapkan
        $statuses = ['Requested', 'Accepted', 'Rejected', 'On Going', 'Completed'];

        // Proses data sertifikasi
        $statusCountSertifikasi = [];
        foreach ($dataStatusSertifikasi as $row) {
            $tahun = $row->periode_tahun;
            if (!isset($statusCountSertifikasi[$tahun])) {
                $statusCountSertifikasi[$tahun] = array_fill_keys($statuses, 0);
            }
            $statusCountSertifikasi[$tahun][$row->status] = $row->jumlah_status;
        }

        $chartDataSertifikasi = [];
        foreach ($statusCountSertifikasi as $tahun => $counts) {
            $chartDataSertifikasi[] = [
                'tahun' => $tahun,
                'labels' => array_keys($counts),
                'datasets' => [
                    [
                        'label' => "Jumlah Status Sertifikasi ($tahun)",
                        'data' => array_values($counts),
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
        }

        // Proses data pelatihan
        $statusCountPelatihan = [];
        foreach ($dataStatusPelatihan as $row) {
            $tahun = $row->periode_tahun;
            if (!isset($statusCountPelatihan[$tahun])) {
                $statusCountPelatihan[$tahun] = array_fill_keys($statuses, 0);
            }
            $statusCountPelatihan[$tahun][$row->status] = $row->jumlah_status;
        }

        $chartDataPelatihan = [];
        foreach ($statusCountPelatihan as $tahun => $counts) {
            $chartDataPelatihan[] = [
                'tahun' => $tahun,
                'labels' => array_keys($counts),
                'datasets' => [
                    [
                        'label' => "Jumlah Status Pelatihan ($tahun)",
                        'data' => array_values($counts),
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
        }

        // Ambil daftar tahun periode untuk dropdown
        $daftarPeriode = PeriodeModel::pluck('tahun', 'tahun');

        // Mengembalikan data dalam format JSON
        return response()->json([
            'userCount' => $userCount,
            'sertifikasiCount' => $sertifikasiCount,
            'pelatihanCount' => $pelatihanCount,
            'chartDataSertifikasi' => $chartDataSertifikasi,
            'chartDataPelatihan' => $chartDataPelatihan,
            'daftarPeriode' => $daftarPeriode,
            'tahunFilter' => $tahunFilter,
        ]);
    }
}