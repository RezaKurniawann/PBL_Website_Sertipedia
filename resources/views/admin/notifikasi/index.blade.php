@extends('layouts.template')

@section('content')

<div class="card mt-4">
    <div class="card-header bg-primary text-white d-flex justify-content-start align-items-center">
        <a href="#" class="btn btn-success btn-sm">Download Draft Surat Tugas</a>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th scope="col">Nama Pelatihan/Sertifikasi</th>
                    <th scope="col">Tipe</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataGabungan as $item)
                    @if ($item->status == "Accepted")
                        <tr>
                            <td>
                                @if ($item->type == 'Pelatihan')
                                    {{ $item->pelatihan->nama ?? 'N/A' }}
                                @elseif ($item->type == 'Sertifikasi')
                                    {{ $item->sertifikasi->nama ?? 'N/A' }}
                                @endif
                            </td>
                            <td>{{ ucfirst($item->type) }}</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-primary btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Tidak ada data yang diterima.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
