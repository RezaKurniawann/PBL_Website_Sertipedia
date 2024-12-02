    @extends('layouts.template')

    @section('content')
    <style>
        a {
            color:white;
        }
    </style>
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title">Detail Sertifikasi</h5>
        </div>
        <div class="card-body">
            <!-- Tampilkan detail sertifikasi -->
            <table class="table table-bordered">
                <tr>
                    <th>Nama Sertifikasi</th>
                    <td>{{ $detailSertifikasi->first()->sertifikasi->nama ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <td>{{ $detailSertifikasi->first()->created_at ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $detailSertifikasi->first()->status ?? 'N/A' }}</td>
                </tr>
            </table>

            <!-- Tampilkan data user yang terkait dengan id_sertifikasi -->
            <label></label>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Dosen</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detailSertifikasi as $detail)
                        <tr>
                            <td>{{ $detail->user->nama ?? 'N/A' }}</td>
                            <td>{{ $detail->user->email ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row" style="height: 1cm">
                <a href="{{ url('pimpinan/verifikasi/sertifikasi') }}" class="btn btn-secondary mt-3">Kembali</a>
                
                <form action="{{ route('sertifikasi.rejected', $detailSertifikasi->first()->id_sertifikasi) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="height: 38px;margin-top: 16px;margin-left: 5px;"><a href="{{ route('verifikasi.sertifikasi') }} ">Tolak</a></button>
                </form>

                <!-- Form untuk Accepted -->
                <form action="{{ route('sertifikasi.accepted', $detailSertifikasi->first()->id_sertifikasi) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="height: 38px;margin-top: 16px;margin-left: 5px;"><a href="{{ route('verifikasi.sertifikasi') }} ">Setujui</a></button>
                </form>
            </div>    
        </div>
    </div>

    @endsection
