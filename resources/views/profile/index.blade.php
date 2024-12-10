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
            margin-bottom: 20px;
            text-align: left;
        }

        .active-tab {
            background-color: #004085;
            /* Warna lebih gelap untuk tombol aktif */
            border-color: #003366;
        }

        .hidden {
            display: none;
        }
    </style>
    {{-- menampilkan gambar  --}}
    <div class="profile-content">
        <div class="card profile-card card-outline card-primary">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{ $user->image ? asset('storage/photos/' . $user->image) : asset('storage/element/default-profile.jpg') }}"
                        alt="Profile Picture" class="profile-picture">
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
                        <td>{{ $user->nip }}</td>
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

    {{-- Tombol Pilihan --}}
    <div class="btn-container">
        <button type="button" class="btn btn-primary" id="btn-sertifikasi">Sertifikasi</button>
        <button type="button" class="btn btn-primary" id="btn-pelatihan">Pelatihan</button>
    </div>

    <!-- Sertifikasi Card -->
    <div id="sertifikasi-card" class="card card-outline card-primary">
        <div class="card-header">
            <h5 class="card-title">Sertifikasi</h5>
        </div>
        <div class="card-body">
            @if ($user->sertifikasi && $user->sertifikasi->count() > 0)
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
                                    <img src="{{ asset('storage/photos/' . ($item->image ?? 'default.png')) }}"
                                        alt="Image" class="img-thumbnail" style="width: 100px; cursor: pointer;">
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data sertifikasi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <p>Belum ada data sertifikasi dengan status Completed.</p>
            @endif
        </div>
    </div>

    <!-- Pelatihan Card -->
    <div id="pelatihan-card" class="card card-outline card-primary hidden">
        <div class="card-header">
            <h5 class="card-title">Pelatihan</h5>
        </div>
        <div class="card-body">
            @if ($user->pelatihan && $user->pelatihan->count() > 0)
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
                                    <img src="{{ asset('storage/photos/' . ($item->image ?? 'default.png')) }}"
                                        alt="Image" class="img-thumbnail" style="width: 100px; cursor: pointer;">
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data pelatihan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <p>Belum ada data pelatihan dengan status Completed.</p>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Full Size Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>


    <script>
        const sertifikasiCard = document.getElementById('sertifikasi-card');
        const pelatihanCard = document.getElementById('pelatihan-card');
        const btnSertifikasi = document.getElementById('btn-sertifikasi');
        const btnPelatihan = document.getElementById('btn-pelatihan');
        const images = document.querySelectorAll('.img-thumbnail');
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');

        images.forEach(image => {
            image.addEventListener('click', function() {
                modalImage.src = this.src;
                $('#imageModal').modal('show');
            });
        });


        document.getElementById('edit-profile-btn').addEventListener('click', function() {
            window.location.href = "{{ url('profile/' . $user->id_user . '/edit') }}";
        });

        // Fungsi untuk mengatur tab aktif
        function setActiveTab(activeButton, inactiveButton) {
            activeButton.classList.add('active-tab');
            inactiveButton.classList.remove('active-tab');
        }

        // Event listener untuk tombol Sertifikasi
        btnSertifikasi.addEventListener('click', () => {
            sertifikasiCard.classList.remove('hidden');
            pelatihanCard.classList.add('hidden');
            setActiveTab(btnSertifikasi, btnPelatihan); // Set tombol aktif
        });

        // Event listener untuk tombol Pelatihan
        btnPelatihan.addEventListener('click', () => {
            pelatihanCard.classList.remove('hidden');
            sertifikasiCard.classList.add('hidden');
            setActiveTab(btnPelatihan, btnSertifikasi); // Set tombol aktif
        });
    </script>
@endsection
