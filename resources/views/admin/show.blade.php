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
        border: 3px solid #ffffff;
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
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h3 class="font-weight-bold">Detail Dosen Jurusan Teknologi Informasi</h3>
        </div>
    </div>

    <!-- Profile Card -->
    <div class="profile-content">
        <div class="card profile-card card-outline card-primary">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{$user->image ? asset('storage/photos/' . $user->image) : asset('storage/element/default-profile.jpg') }}" 
                         alt="Profile Picture" 
                         class="profile-picture">
                </div>
                
                    <!-- Detail User -->
                    <div class="ml-4 w-100">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Nama Lengkap</strong></td>
                                <td>{{ $user->nama ?? 'Nama Tidak Tersedia' }}</td>
                            </tr>
                            <tr>
                                <td><strong>NIP</strong></td>
                                <td>{{ $user->username ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>{{ $user->email ?? 'Email Tidak Tersedia' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jabatan</strong></td>
                                <td>{{ $user->jabatan->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Pangkat</strong></td>
                                <td>{{ $user->pangkat->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Prodi</strong></td>
                                <td>{{ $user->prodi->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Golongan</strong></td>
                                <td>{{ $user->golongan->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Bidang Minat</strong></td>
                                <td>
                                    @forelse($user->bidangMinat as $bidang)
                                        {{ $bidang->nama }}<br>
                                    @empty
                                        Tidak ada bidang minat
                                    @endforelse
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Mata Kuliah</strong></td>
                                <td>
                                    @forelse($user->mataKuliah as $mataKuliah)
                                        {{ $mataKuliah->nama }}<br>
                                    @empty
                                        Tidak ada mata kuliah
                                    @endforelse
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-start">
            <!-- Tab Buttons -->
            <button class="btn btn-success mr-2" data-toggle="tab" href="#pelatihan-tab">Pelatihan</button>
            <button class="btn btn-primary" data-toggle="tab" href="#sertifikasi-tab">Sertifikasi</button>
        </div>
    </div>
   
    <!-- Tabs Content -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Tab Pelatihan -->
                        <div class="tab-pane fade show active" id="pelatihan-tab">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Pelatihan</th>
                                            <th>image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pelatihan as $item)
                                        <tr>
                                            <td>{{ $item->id_detail_pelatihan }}</td>
                                            <td>{{ $item->pelatihan->nama_pelatihan ?? '-' }}</td>
                                            <td>
                                                <img src="{{ asset('images/' . ($item->pelatihan->image ?? 'default.png')) }}" alt="Image" class="img-thumbnail" style="width: 100px;">
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data pelatihan</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Tab Sertifikasi -->
                        <div class="tab-pane fade" id="sertifikasi-tab">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Sertifikasi</th>
                                            <th>No Sertifikasi</th>
                                            <th>image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($sertifikasi as $item)
                                        <tr>
                                            <td>{{ $item->id_detail_sertifikasi }}</td>
                                            <td>{{ $item->sertifikasi->nama_sertifikasi ?? '-' }}</td>
                                            <td>{{ $item->no_sertifikasi }}</td>
                                            <td>
                                                <img src="{{ asset('images/' . ($item->pelatihan->image ?? 'default.png')) }}" alt="Image" class="img-thumbnail" style="width: 100px;">
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data sertifikasi</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
