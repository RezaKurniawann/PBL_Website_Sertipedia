@extends('layouts.template')

@section('content')

<style>
    .breadcrumb-container {
        margin-bottom: 20px;
    }

    .breadcrumb {
        background-color: #f8f9fa;
        padding: 10px 15px;
        border-radius: 5px;
    }

    .profile-content {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: calc(100vh - 150px);
        padding: 5px;
    }

    .profile-card {
        width: 100%;
        max-width: 1300px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        background-color: #ffffff;
    }

    .profile-picture {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 3px solid #0d6efd;
        margin-bottom: 20px;
    }

    .profile-card h5 {
        margin-bottom: 10px;
        font-weight: bold;
        text-align: center;
    }

    .table {
        margin-top: 20px;
    }

    .table th,
    .table td {
        text-align: left;
        border-top: none;
    }

    .table-border {
        border-top: 1px solid #dee2e6;
    }

    .btn-primary {
        background-color: #0d6efd;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-container {
        margin-top: 20px;
        text-align: left;
    }
</style>

<div class="profile-content">
    <div class="card profile-card card-outline card-primary">
        <div class="card-body">
            <div class="text-center">
                <img src="{{ $user->image ? asset('storage/photos/' . $user->image) : asset('storage/element/default-profile.jpg') }}" 
                     alt="Profile Picture" 
                     class="profile-picture">
            </div>
            {{-- <h5 class="text-center">{{ $user->nama }}</h5>
            <p class="text-center">{{ $user->jabatan->nama }}</p> --}}
            <table class="table">
                <tr class="table-border">
                    <th>Nama Lengkap</th>
                    <td>{{ $user->nama }}</td>
                </tr>
                <tr class="table-border">
                    <th>Jabatan</th>
                    <td>{{ $user->jabatan->nama }}</td>
                </tr>
                <tr class="table-border">
                    <th>Pangkat</th>
                    <td>{{ $user->pangkat->nama }}</td>
                </tr>
                <tr class="table-border">
                    <th>Golongan</th>
                    <td>{{ $user->golongan->nama }}</td>
                </tr>
                <tr class="table-border">
                    <th>NIP/NIDN</th>
                    <td>{{ $user->username }}</td>
                </tr>
                <tr class="table-border">
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr class="table-border">
                    <th>Nomor Telepon</th>
                    <td>{{ $user->no_telp }}</td>
                </tr>
                <tr class="table-border">
                    <th>Program Studi</th>
                    <td>{{ $user->prodi->nama }}</td>
                </tr>
                {{-- <tr class="table-border">
                    <th>Password</th>
                    <td>{{ $user->password}}</td> <!-- Disarankan untuk tidak menampilkan password secara langsung -->
                </tr> --}}
            </table>
            <div class="btn-container">
                <button type="button" class="btn btn-primary" id="edit-profile-btn">Edit Profile</button>
            </div>
        </div>
    </div>
</div>

<!-- Sertifikasi Card -->
<div class="card card-outline card-primary">
    <div class="card-header">
        <h5 class="card-title">Sertifikasi</h5>
    </div>
    <div class="card-body">
        @if($user->sertifikasi && $user->sertifikasi->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sertifikasi</th>
                        <th>Jenis Sertifikasi</th>
                        <th>Vendor</th>
                        <th>Periode</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->sertifikasi as $index => $sertifikasi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $sertifikasi->nama }}</td>
                            <td>{{ $sertifikasi->jenis_sertifikasi }}</td>
                            <td>{{ $sertifikasi->vendor->nama }}</td>
                            <td>{{ $sertifikasi->periode->tahun }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Belum ada data sertifikasi dengan status Completed.</p>
        @endif
    </div>
</div>

<!-- Pelatihan Card -->
<div class="card card-outline card-primary">
    <div class="card-header">
        <h5 class="card-title">Pelatihan</h5>
    </div>
    <div class="card-body">
        @if($user->pelatihan && $user->pelatihan->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelatihan</th>
                        <th>Level Pelatihan</th>
                        <th>Vendor</th>
                        <th>Periode</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->pelatihan as $index => $pelatihan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pelatihan->nama }}</td>
                            <td>{{ $pelatihan->level_pelatihan }}</td>
                            <td>{{ $pelatihan->vendor->nama }}</td>
                            <td>{{ $pelatihan->periode->tahun }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Belum ada data pelatihan dengan status Completed.</p>
        @endif
    </div>
</div>


<script>
    document.getElementById('edit-profile-btn').addEventListener('click', function() {
        window.location.href = "{{ url('profile/' . $user->id_user . '/edit') }}";
    });
</script>
@endsection