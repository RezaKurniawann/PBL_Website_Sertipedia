@extends ('layouts.template')

@section('content')

<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
    data-keyboard="false" data-width="75%" aria-hidden="true"></div>

<div class="card card-outline card-primary">
    <div class="card-header d-flex align-items-center" style="padding: 10px 20px;">
        <h5 class="card-title mb-0" style="font-weight: bold;">Daftar Pengajuan Sertifikasi</h5>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_sertifikasi">
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
