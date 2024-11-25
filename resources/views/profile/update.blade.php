@extends('layouts.template')

@section('title', 'Edit Profil')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Profil Pengguna</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="form-group">
                            <label for="nomor_telepon">Nomor Telepon</label>
                            <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $user->nomor_telepon) }}">
                        </div>

                        <!-- Foto Profil -->
                        <div class="form-group">
                            <label for="photo">Foto Profil</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                            @if ($user->avatar)
                                <img src="{{ asset($user->avatar) }}" alt="Foto Profil" class="img-thumbnail mt-3" width="150">
                            @endif
                        </div>

                        <!-- Tombol Simpan -->
                        <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                    </form>

                    <!-- Tombol Kembali -->
                    <a href="{{ route('profile.show') }}" class="btn btn-secondary w-100 mt-2">Kembali ke Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
