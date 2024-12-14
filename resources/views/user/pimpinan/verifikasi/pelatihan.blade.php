@extends ('layouts.template')

@section('content')

<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
    data-keyboard="false" data-width="75%" aria-hidden="true"></div>

<div class="card card-outline card-primary">
    <div class="card-header d-flex align-items-center" style="padding: 10px 20px;">
        <h5 class="card-title mb-0" style="font-weight: bold;">Daftar Pengajuan Pelatihan</h5>
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
                <th scope="col">Nama Pelatihan</th>
                <th scope="col">Level Pelatihan</th>
                <th scope="col">Biaya</th>
                <th scope="col">Vendor</th>
                <th scope="col">Periode</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelatihan as $item)
                <tr>
                    <td>{{ $item->pelatihan->nama ?? 'N/A' }}</td>
                        <td>{{ $item->pelatihan->level_pelatihan ?? 'N/A' }}</td>
                        <td>{{ $item->pelatihan->biaya ?? 'N/A' }}</td>
                        <td>{{ $item->pelatihan->vendor->nama ?? 'N/A' }}</td>                     
                        <td>{{ $item->pelatihan->periode->tahun ?? 'N/A' }}</td>
                        <td>{{ $item->status ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('verifikasi.detail-pelatihan', $item->id_pelatihan) }}" class="btn btn-primary btn-sm">
                                Detail
                            </a>                        
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection