@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h3 class="font-weight-bold">Detail Dosen Jurusan Teknologi Informasi</h3>
        </div>
    </div>

    <!-- Profile Card -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body d-flex">
                    <!-- Foto Profil -->
                    <div>
                        <img src="{{ $user->image ? asset($user->image) : asset('adminlte/dist/img/defaultUser.jpg') }}" 
                             alt="Foto Profil" 
                             class="rounded-circle" 
                             width="120" 
                             height="120">
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
                                <td>{{ $user->user->id_user ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Prodi</strong></td>
                                <td>{{ $user->prodi->nama ?? '-' }}</td>
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
        <div class="col-12 text-center">
            <button class="btn btn-success mr-2">Pelatihan</button>
            <button class="btn btn-primary">Sertifikasi</button>
        </div>
    </div>

    <!-- Data Table -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Pelatihan</th>
                                    <th>Mata Kuliah</th>
                                    <th>Bidang Minat</th>
                                    <th>Vendor</th>
                                    <th>Periode</th>
                                    <th>Waktu Pelaksanaan</th>
                                    <th>Level Pelatihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pelatihan as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama_pelatihan }}</td>
                                    <td>{{ $item->mataKuliah->nama ?? '-' }}</td>
                                    <td>{{ $item->bidangMinat->nama ?? '-' }}</td>
                                    <td>{{ $item->vendor->nama ?? '-' }}</td>
                                    <td>{{ $item->periode }}</td>
                                    <td>{{ $item->waktu_pelaksanaan }}</td>
                                    <td>{{ $item->level_pelatihan }}</td>
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
            </div>
        </div>
    </div>
</div>
@endsection
