@extends('layouts.template')

@section('content')

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>    
     <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th scope="col">Nama Pelatihan/Sertifikasi</th>
                    <th scope="col">Tipe</th>
                    <th scope="col" class="text-center">Draft Surat Tugas</th>
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
                                <a href="{{ route('export.pdf', ['type' => $item->type, 'id' => $item->type == 'Pelatihan' ? $item->pelatihan->id_pelatihan : $item->sertifikasi->id_sertifikasi]) }}" class="btn btn-success btn-sm">Download</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('notifikasi.detail', $item->type == 'Pelatihan' ? $item->id_pelatihan : $item->id_sertifikasi) }}" class="btn btn-primary btn-sm">Detail</a>
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
</div>

@endsection
