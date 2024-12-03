@extends('layouts.template')

@section('content')

<style>
    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between; /* Agar card menyebar horizontal */
        gap: 15px; /* Jarak antar card */
    }

    .col-lg-custom {
        flex: 1; /* Setiap card memiliki ukuran yang sama */
        max-width: 23%; /* Atur agar maksimal 4 card dalam satu baris */
        min-width: 200px; /* Ukuran minimal card agar tidak terlalu kecil */
    }

    .small-box {
        height: 150px; /* Tinggi card tetap seragam */
    }
</style>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Halo, Selamat Datang di Halaman Statistik!</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <div class="card-container">
            <!-- Card Jumlah User -->
            <div class="col-lg-custom">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $userCount }}</h3>
                        <p>Jumlah User</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="/user/home" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Card Jumlah Sertifikasi -->
            <div class="col-lg-custom">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $sertifikasiCount }}</h3>
                        <p>Jumlah Sertifikasi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <a href="/user/home" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Card Jumlah Pelatihan -->
            <div class="col-lg-custom">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $pelatihanCount }}</h3>
                        <p>Jumlah Pelatihan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <a href="/user/home" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>      
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Status Sertifikasi</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>On Going</td>
                        <td>{{ $sertifikasiOnGoingCount }}</td>
                    </tr>
                    <tr>
                        <td>Finished</td>
                        <td>{{ $sertifikasiFinishedCount }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Status Pelatihan</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>On Going</td>
                        <td>{{ $pelatihanOnGoingCount }}</td>
                    </tr>
                    <tr>
                        <td>Finished</td>
                        <td>{{ $pelatihanFinishedCount }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection