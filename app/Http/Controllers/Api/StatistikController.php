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
        $tahunFilter = $request->input('periode', 2018);

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
