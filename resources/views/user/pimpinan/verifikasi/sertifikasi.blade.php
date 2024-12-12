@extends ('layouts.template')

@section('content')

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="card-title mb-0">Daftar Pengajuan Sertifikasi</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Nama Sertifikasi</th>
                    <th scope="col">Jenis Sertifikasi</th>
                    <th scope="col">Biaya</th>
                    <th scope="col">Vendor</th>
                    <th scope="col">Periode</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sertifikasi as $item)
                    <tr>
                        <td>{{ $item->sertifikasi->nama ?? 'N/A' }}</td>
                        <td>{{ $item->sertifikasi->jenis_sertifikasi ?? 'N/A' }}</td>
                        <td>{{ $item->sertifikasi->biaya ?? 'N/A' }}</td>
                        <td>{{ $item->sertifikasi->vendor->nama ?? 'N/A' }}</td>                     
                        <td>{{ $item->sertifikasi->periode->tahun ?? 'N/A' }}</td>
                        <td>{{ $item->status ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('verifikasi.detail-sertifikasi', $item->id_sertifikasi) }}" class="btn btn-primary btn-sm">
                                Detail
                            </a>                        
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
