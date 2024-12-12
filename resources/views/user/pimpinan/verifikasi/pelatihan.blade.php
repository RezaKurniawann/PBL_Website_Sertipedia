@extends ('layouts.template')

@section('content')

<div class="card">
    <table class="table table-hover">
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