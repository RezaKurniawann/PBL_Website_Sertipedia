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
                <img src="{{ $user->avatar ? asset('storage/photos/' . $user->avatar) : asset('images/profile-default.jpg') }}" 
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
                <tr class="table-border">
                    <th>Password</th>
                    <td>{{ $user->password}}</td> <!-- Disarankan untuk tidak menampilkan password secara langsung -->
                </tr>
            </table>
            <div class="btn-container">
                <button type="button" class="btn btn-primary" id="edit-profile-btn">Edit</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('edit-profile-btn').addEventListener('click', function() {
        window.location.href = "{{ url('profile/' . $user->id_user . '/edit') }}";
    });
</script>
@endsection



{{-- cara akses untuk kolom $user->namakolom --}}
