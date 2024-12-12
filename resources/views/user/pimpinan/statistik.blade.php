@extends('layouts.template')

@section('content')
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            /* Agar card menyebar horizontal */
            gap: 15px;
            /* Jarak antar card */
        }

        .col-lg-custom {
            flex: 1;
            /* Setiap card memiliki ukuran yang sama */
            max-width: 23%;
            /* Atur agar maksimal 4 card dalam satu baris */
            min-width: 200px;
            /* Ukuran minimal card agar tidak terlalu kecil */
        }

        .small-box {
            height: 150px;
            /* Tinggi card tetap seragam */
        }
    </style>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">STATISTIK SERTIFIKASI DAN PELATIHAN DOSEN JTI</h3>
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
                        <a href="/user/home" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
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
                        <a href="/user/home" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
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
                        <a href="/user/home" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
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
                        @foreach ($sertifikasiStatusCount as $status => $count)
                            <tr
                                class="
                                @if ($status == 'requested') bg-primary text-white
                                @elseif ($status == 'rejected') bg-danger text-white
                                @elseif ($status == 'accepted') bg-success text-white
                                @elseif ($status == 'on going') bg-warning text-dark
                                @elseif ($status == 'completed') bg-secondary text-white @endif
                            ">
                                <td>{{ ucfirst($status) }}</td>
                                <td>{{ $count }}</td>
                            </tr>
                        @endforeach
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
                        @foreach ($pelatihanStatusCount as $status => $count)
                            <tr
                                class="
                                @if ($status == 'requested') bg-primary text-white
                                @elseif ($status == 'rejected') bg-danger text-white
                                @elseif ($status == 'accepted') bg-success text-white
                                @elseif ($status == 'on going') bg-warning text-dark
                                @elseif ($status == 'completed') bg-secondary text-white @endif
                            ">
                                <td>{{ ucfirst($status) }}</td>
                                <td>{{ $count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection