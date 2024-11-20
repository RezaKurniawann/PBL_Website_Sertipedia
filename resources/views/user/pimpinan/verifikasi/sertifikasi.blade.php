@extends ('layouts.template' )

@section('content')

<div class="card">
   
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Nama Dosen</th>
            <th scope="col">NIDN</th>
            <th scope="col">Jenis Sertifikasi</th>
            <th scope="col">Tanggal Pengajuan</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Nama Dosen</td>
            <td>12345</td>
            <td>Cisco</td>
            <td>01-11-2024</td>
            <td>Menunggu Persetujuan</td>
            <td><button class="btn btn-primary btn-sm">Detail</button></td>
          </tr>
          <tr>
            <td>Nama Dosen</td>
            <td>12345</td>
            <td>Cisco</td>
            <td>01-11-2024</td>
            <td>Menunggu Persetujuan</td>
            <td><button class="btn btn-primary btn-sm">Detail</button></td>
          </tr>
          <tr>
            <td>Nama Dosen</td>
            <td>12345</td>
            <td>Cisco</td>
            <td>01-11-2024</td>
            <td>Menunggu Persetujuan</td>
            <td><button class="btn btn-primary btn-sm">Detail</button></td>
          </tr>
        </tbody>
      </table>

@endsection
