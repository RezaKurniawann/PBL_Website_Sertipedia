@extends('layouts.template')

@section('content')
<div class="card mt-4">
    <div class="card-header bg-primary text-white">
        <h5 class="card-title">Detail Notifikasi</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td>{{ $item->pelatihan->nama ?? $item->sertifikasi->nama ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Tipe</th>
                <td>{{ $item->type }}</td>
            </tr>
        </table>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Dosen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($item->pelatihan->user ?? $item->sertifikasi->user ?? [] as $user)
                    <tr>
                        <td>{{ $user->nama ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('notifikasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="suratTugas" class="form-label">Surat Tugas</label>
                <input type="file" class="form-control" id="suratTugas" name="surat_tugas" accept=".pdf" required>
            </div>
            <input type="hidden" name="id_item" value="{{ $item->type == 'Pelatihan' ? $item->id_pelatihan : $item->id_sertifikasi }}">
            <input type="hidden" name="type" value="{{ $item->type }}">
            <div>
                <a href="{{ route('notifikasi.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                <button type="submit" class="btn btn-success" style="margin-top: 17px">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
