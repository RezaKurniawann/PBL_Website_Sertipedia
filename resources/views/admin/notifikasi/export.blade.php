<?php
$now = new DateTime();
$currentDate = $now->format('d F Y');

// Format tanggal awal dan akhir
$tanggalAwal = $data->pelatihan->tanggal_awal ?? $data->sertifikasi->tanggal_awal ?? null;
$tanggalAkhir = $data->pelatihan->tanggal_akhir ?? $data->sertifikasi->tanggal_akhir ?? null;

$tanggalAwalFormatted = $tanggalAwal ? (new DateTime($tanggalAwal))->format('d F') : 'N/A';
$tanggalAkhirFormatted = $tanggalAkhir ? (new DateTime($tanggalAkhir))->format('d F Y') : 'N/A';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 6px 20px 5px 20px;
            line-height: 1.5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            padding: 5px;
        }
        th {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .font-bold {
            font-weight: bold;
        }
        .header {
            border-bottom: 2px solid black;
        }
        .header img {
            height: 80px;
        }
        .header-title {
            text-align: center;
            font-size: 12pt;
        }
        .table-bordered, .table-bordered th, .table-bordered td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <table class="header">
        <tr>
            <td width="10%" class="text-center">
                <img src="{{ public_path('logo_polinema.png') }}" alt="Logo Polinema">
            </td>
            <td width="90%">
                <div class="header-title">
                    <span>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</span><br>
                    <span class="font-bold">POLITEKNIK NEGERI MALANG</span><br>
                    <span>Jl. Soekarno-Hatta No. 9 Malang 65141</span><br>
                    <span>Telepon: (0341) 404424, Fax: (0341) 404420</span><br>
                    <span>Laman: www.polinema.ac.id</span>
                </div>
            </td>
        </tr>
    </table>

    <!-- Title -->
    <h2 class="text-center">SURAT TUGAS</h2>
    <p class="text-center">Nomor: </p>

    <p class="text-align: left">Ketua Jurusan Teknologi Informasi memberikan tugas kepada:</p>
    <!-- Content -->
    <table class="table-bordered">
        <tr>
            <th width="30%" class="text-center">NAMA</th>
            <th class="text-center">PANGKAT/GOL</th>
            <th class="text-center">JABATAN</th>
        </tr>
        <tr>
            <td>{{ $data->user->nama ?? 'N/A' }}</td>
            <td>{{ $data->user->pangkat->nama ?? 'N/A' }}/{{ $data->user->golongan->nama ?? 'N/A' }}</td>
            <td>{{ $data->user->jabatan->nama ?? 'N/A' }}</td>
        </tr>
    </table>
    <p class="text-align: left">
        Untuk menjadi peserta dalam {{ $data->pelatihan->nama ?? $data->sertifikasi->nama ?? 'N/A' }} yang akan dilaksanakan di {{ $data->pelatihan->vendor->nama ?? $data->sertifikasi->vendor->nama ?? 'N/A' }}, {{ $data->pelatihan->vendor->alamat ?? $data->sertifikasi->vendor->alamat ?? 'N/A' }} pada tanggal 
        {{ $tanggalAwalFormatted }} sd {{ $tanggalAkhirFormatted }}. 
    </p>
    <p class="text-align: left">
        Biaya perjalanan dinas pada kegiatan ini dibebankan pada anggaran Jurusan Teknologi Informasi<br>
        Politeknik Negeri Malang. Selesai melaksanakan tugas harap melaporkan <br>
        hasilnya kepada Ketua Jurusan Teknologi Informasi.
        Demikian untuk dilaksanakan sebaik-baiknya.
    </p>
    <br>
    <div style="margin-left: 10cm">
        <p class="text-left">
            <?php echo $currentDate ?><br>
            Ketua Jurusan Teknologi Informasi,
            <br><br><br>
            Dr. Eng. Rosa Andrie Asmara, S.T., M.T. <br>
            NIP. 198010102005011001
        </p>
    </div>
</body>
</html>
