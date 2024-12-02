@extends('layouts.template')

@section('content')
<style>
    a {
        color:white;
    }
</style>
<div class="card mt-4">
    <div class="card-header bg-primary text-white">
        <h5 class="card-title">Detail Pelatihan</h5>
    </div>
    <div class="card-body">
        <!-- Tampilkan detail pelatihan -->
        <table class="table table-bordered">
            <tr>
                <th>Nama Pelatihan</th>
                <td>{{ $detailPelatihan->first()->pelatihan->nama ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Tanggal Pengajuan</th>
                <td>{{ $detailPelatihan->first()->created_at ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $detailPelatihan->first()->status ?? 'N/A' }}</td>
            </tr>
        </table>

        <!-- Tampilkan data user yang terkait dengan id_pelatihan -->
        <label></label>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Dosen</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detailPelatihan as $detail)
                    <tr>
                        <td>{{ $detail->user->nama ?? 'N/A' }}</td>
                        <td>{{ $detail->user->email ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row" style="height: 1cm">
            <a href="{{ url('pimpinan/verifikasi/pelatihan') }}" class="btn btn-secondary mt-3">Kembali</a>
            
            <form action="{{ route('pelatihan.rejected', $detailPelatihan->first()->id_pelatihan) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger" style="height: 38px;margin-top: 16px;margin-left: 5px;"><a href="{{ route('verifikasi.pelatihan') }} ">Tolak</a></button>
            </form>

            <!-- Form untuk Accepted -->
            <form action="{{ route('pelatihan.accepted', $detailPelatihan->first()->id_pelatihan) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-primary" style="height: 38px;margin-top: 16px;margin-left: 5px;"><a href="{{ route('verifikasi.pelatihan') }} ">Setujui</a></button>
            </form>
        </div>    
    </div>
</div>

@endsection
