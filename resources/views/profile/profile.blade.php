@extends('layouts.template')

@section('content')

{{-- @dd($breadcrumb) --}}
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
        align-items: center;
        min-height: calc(100vh - 150px); /* Mengatur tinggi minimal agar terpusat */
        padding: 10px;
    }

    .profile-card {
        width: 1100px; /* Mengatur lebar agar konsisten */
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px;
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
        text-align: left; /* Mengatur teks tabel ke kiri */
        border-top: none;
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
        text-align: left; /* Mengatur tombol berada di kiri */
    }
</style>

{{-- <div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
        </ol>
    </nav>
</div> --}}

<div class="profile-content">
    <div class="container mt-4">
        <div class="card profile-card">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{ asset('adminlte/dist/img/user.jpg') }}" alt="Profile Picture" class="profile-picture">
                </div>
                <h5 class="text-center">{{ $user['nama'] }}</h5>
                <p class="text-center">{{ $user['jabatan'] }}</p>
                <table class="table">
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $user['nama'] }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>{{ $user['jabatan'] }}</td>
                    </tr>
                    <tr>
                        <th>NIDN</th>
                        <td>{{ $user['nidn'] }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user['email'] }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Telepon</th>
                        <td>{{ $user['nomor_telepon'] }}</td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td>{{ $user['password'] }}</td>
                    </tr>
                </table>
                <div class="btn-container">
                    <button class="btn btn-primary">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection