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

    .tab-button {
        background-color: #0d6efd; /* Warna biru */
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    .tab-button.active {
        background-color: #0056b3; /* Warna biru lebih gelap untuk tab aktif */
        font-weight: bold;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .tab-button:hover {
        background-color: #004085; /* Warna hover biru lebih gelap */
        color: white; /* Pastikan teks tetap putih */
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
                            <td>{{ $user->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>NIP</strong></td>
                            <td>{{ $user->nip ?? '-' }}</td>
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
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-start">
            <!-- Tab Buttons -->
            <button class="btn tab-button active" data-target="#pelatihan-tab">Pelatihan</button>
            <button class="btn tab-button" data-target="#sertifikasi-tab">Sertifikasi</button>
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
                                            <th>No</th>
                                            <th>Nama Pelatihan</th>
                                            <th>Vendor</th>
                                            <th>Level Pelatihan</th>
                                            <th>Periode</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pelatihan as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->pelatihan->nama ?? '-' }}</td>
                                            <td>{{ $item->pelatihan->vendor->nama ?? '-' }}</td>
                                            <td>{{ $item->pelatihan->level_pelatihan }}</td>
                                            <td>{{ $item->pelatihan->periode->tahun }}</td>
                                            <td>
                                                <img src="{{ asset('storage/photos/' . ($item->image ?? 'default.png')) }}" alt="Image" class="img-thumbnail" style="width: 100px; cursor: pointer;">
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
                                            <th>No</th>
                                            <th>Nama Sertifikasi</th>
                                            <th>Vendor</th>
                                            <th>Jenis Sertifikasi</th>
                                            <th>Periode</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($sertifikasi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->sertifikasi->nama ?? '-' }}</td>
                                            <td>{{ $item->sertifikasi->vendor->nama ?? '-' }}</td>
                                            <td>{{ $item->sertifikasi->jenis_sertifikasi }}</td>
                                            <td>{{ $item->sertifikasi->periode->tahun }}</td>
                                            <td>
                                                <img src="{{ asset('storage/photos/' . ($item->image ?? 'default.png')) }}" alt="Image" class="img-thumbnail" style="width: 100px; cursor: pointer;">
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

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img id="modalImage" src="" alt="Full Size Image" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const images = document.querySelectorAll('.img-thumbnail');
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');

        images.forEach(image => {
            image.addEventListener('click', function () {
                modalImage.src = this.src;
                $('#imageModal').modal('show');
            });
        });

        // Handle tab switching manually
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabs = document.querySelectorAll('.tab-pane');

        tabButtons.forEach(button => {
            button.addEventListener('click', function () {
                const target = document.querySelector(this.dataset.target);

                // Remove active class from all buttons and tabs
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabs.forEach(tab => tab.classList.remove('show', 'active'));

                // Add active class to the clicked button and corresponding tab
                this.classList.add('active');
                target.classList.add('show', 'active');
            });
        });
    });
</script>
@endsection
