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
                    <th scope="col" class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataGabungan as $item)
                    @if ($item->id_user == Auth::user()->id_user && $item->status != 'Accepted' && $item->status != 'Rejected')
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
                                @if ($item->surat_tugas && $item->status == 'Completed')
                                    <a href="{{ Storage::url('surat_tugas/'.$item->surat_tugas) }}" class="btn btn-primary btn-sm" target="_blank">Lihat Surat Tugas</a>
                                @else
                                   {{ $item->status ?? 'N/A' }}
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
</div>

@endsection
