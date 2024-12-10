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
            <tr>
                <th>Dosen</th>
                <td>{{ $item->user->nama ?? 'N/A' }}</td>
            </tr>
        </table>
        
        <!-- Form Surat Tugas -->
        <form action="{{ route('notifikasi.index') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="dosen" class="form-label">Dosen</label>
                <input type="text" class="form-control" id="dosen" name="dosen" value="{{ $item->user->nama ?? '' }}" required>
            </div>
            <div class="mb-3">
                <label for="suratTugas" class="form-label">Surat Tugas</label>
                <input type="file" class="form-control" id="suratTugas" name="surat_tugas" accept=".pdf" required>
            </div>
            <input type="hidden" name="id_item" value="{{ $item->id }}">
            <div>
                <a href="{{ route('notifikasi.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                <button type="submit" class="btn btn-success" style="margin-top: 17px">Simpan</button>
            </div>
        </form>

        <!-- Tombol Kembali -->


    </div>
</div>
@endsection
