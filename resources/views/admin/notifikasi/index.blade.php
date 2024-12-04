@extends ('layouts.template')

@section('content')

<div class="card">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nama Pelatihan/Sertifikasi</th>
                <th scope="col">Tipe</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataGabungan as $item)
                @if ($item->status == "Accepted")
                <tr>
                    <td>
                        @if ($item->type == 'Pelatihan')
                            {{ $item->pelatihan->nama ?? 'N/A' }}
                        @elseif ($item->type == 'Sertifikasi')
                            {{ $item->sertifikasi->nama ?? 'N/A' }}
                        @endif
                    </td>
                    <td>{{ $item->type }}</td>
                    <td>
                        @if ($item->type == 'Pelatihan')
                            <a href="{{ route('verifikasi.detail-pelatihan', $item->id_pelatihan) }}" class="btn btn-primary btn-sm">
                                Detail
                            </a>
                        @elseif ($item->type == 'Sertifikasi')
                            <a href="{{ route('verifikasi.detail-sertifikasi', $item->id_sertifikasi) }}" class="btn btn-primary btn-sm">
                                Detail
                            </a>
                        @endif
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

@endsection
