@extends ('layouts.template')

@section('content')

<div class="card">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nama Dosen</th>
                <th scope="col">Jenis Sertifikasi</th>
                <th scope="col">Tanggal Pengajuan</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sertifikasi as $item)
                <tr>
                    <td>{{ $item->user->nama ?? 'N/A' }}</td>
                    <td>{{ $item->sertifikasi->nama ?? 'N/A' }}</td>
                    <td>{{ $item->sertifikasi->created_at ?? 'N/A' }}</td>
                    <td>{{ $item->status ?? 'N/A' }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm">Detail</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection