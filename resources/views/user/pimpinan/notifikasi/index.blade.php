@extends('layouts.template')

@section('content')

<div class="card mt-4">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th scope="col">Nama Pelatihan/Sertifikasi</th>
                    <th scope="col">Tipe</th>
                    <th scope="col" class="text-center">Surat Tugas</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataGabungan as $item)
                    @if ($item->status == "Ongoing" && $item->user->id_user == Auth::user()->id_user)
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
                                @if ($item->surat_tugas)
                                    <a href="{{ Storage::url($item->surat_tugas) }}" class="btn btn-primary btn-sm" target="_blank">Lihat Surat Tugas</a>
                                @else
                                    <span class="text-muted">Belum diunggah</span>
                                @endif
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Tidak ada data yang diterima.</td>
                    </tr>
                @endforelse
            </tbody>            
        </table>
    </div>
</div>

@endsection