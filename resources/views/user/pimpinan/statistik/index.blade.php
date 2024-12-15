@extends('layouts.template')

@section('content')
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 15px;
        }

        .col-lg-custom {
            flex: 1;
            max-width: 23%;
            min-width: 200px;
        }

        .small-box {
            height: 150px;
        }

        .form-inline {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
        }

        .form-inline select {
            width: auto;
            flex: 1;
        }

        .form-inline button {
            white-space: nowrap;
        }
    </style>

    <div class="container">
        <!-- Additional Stats -->
        <div class="card card-outline card-primary">
            <div class="card-header d-flex align-items-center" style="padding: 10px 20px;">
                <h5 class="card-title mb-0">Data Statistik</h5>
            </div>
            <div class="card-body">
                <div class="card-container">
                    <div class="col-lg-custom">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $userCount }}</h3>
                                <p>Dosen</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="/user/home" class="small-box-footer">Detail Info<i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-custom">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $sertifikasiCount }}</h3>
                                <p>Sertifikasi</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <a href="{{ route('statistik.detail_sertifikasi') }}" class="small-box-footer">Detail Info<i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-custom">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $pelatihanCount }}</h3>
                                <p>Pelatihan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-boxes"></i>
                            </div>
                            <a href="{{ route('statistik.detail_pelatihan') }}" class="small-box-footer">Detail Info<i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Sertifikasi dengan Filter -->
        <div class="card card-outline card-primary">
            <div class="card-header d-flex align-items-center" style="padding: 10px 20px;">
                <h5 class="card-title mb-0">Statistik Sertifikasi Berdasarkan Status</h5>
            </div>
            <div class="card-body">
                <!-- Filter Periode Sertifikasi -->
                <form id="filterFormSertifikasi" action="{{ route('statistik.index') }}" method="get"
                    class="form-inline align-items-center">
                    <div class="form-group">
                        <select name="periodeSertfikasi" id="periodeSertifikasi" class="form-control" style="width: 150px;">
                            @foreach (collect($daftarPeriodeSertifikasi)->sort() as $tanggal)
                                <option value="{{ $tanggal }}" {{ $tanggal == $tahunFilterSertifikasi ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm ms-3">Filter</button>
                </form>
                <!-- Diagram Sertifikasi -->
                <div class="mt-4">
                    <canvas id="statusChartSertifikasi" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Statistik Pelatihan dengan Filter -->
        <div class="card card-outline card-primary mt-4">
            <div class="card-header d-flex align-items-center" style="padding: 10px 20px;">
                <h5 class="card-title mb-0">Statistik Pelatihan Berdasarkan Status</h5>
            </div>
            <div class="card-body">
                <!-- Filter Periode Pelatihan -->
                <form id="filterFormPelatihan" action="{{ route('statistik.index') }}" method="get"
                    class="form-inline align-items-center">
                    <div class="form-group">
                        <select name="periodePelatihan" id="periodePelatihan" class="form-control" style="width: 150px;">
                            @foreach (collect($daftarPeriodePelatihan)->sort() as $tanggal)
                                <option value="{{ $tanggal }}" {{ $tanggal == $tahunFilterPelatihan ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm ms-3">Filter</button>
                </form>
                <!-- Diagram Pelatihan -->
                <div class="mt-4">
                    <canvas id="statusChartPelatihan" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data untuk chart sertifikasi
        const chartDataSertifikasi = @json($chartDataSertifikasi);

        const sertifikasiCtx = document.getElementById('statusChartSertifikasi').getContext('2d');
        new Chart(sertifikasiCtx, {
            type: 'bar',
            data: chartDataSertifikasi,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Status Sertifikasi'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
            },
        });

        // Data untuk chart pelatihan
        const chartDataPelatihan = @json($chartDataPelatihan);

        const pelatihanCtx = document.getElementById('statusChartPelatihan').getContext('2d');
        new Chart(pelatihanCtx, {
            type: 'bar',
            data: chartDataPelatihan,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Status Pelatihan'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
            },
        });
    </script>
@endsection
