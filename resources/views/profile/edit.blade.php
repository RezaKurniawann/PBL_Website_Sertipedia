@extends('layouts.template')

@section('content')
<div class="container my-0">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-outline card-primary">
                
                    <div class="card-body">
                        <div class="row text-center mb-4">
                            <div class="col-md-12">
                                <img id="profile-picture-preview" src="{{ $user->image ? asset('storage/photos/'.$user->image) : asset('storage/element/default-profile.jpg') }}" 
                                    class="img-thumbnail rounded-circle shadow-sm" 
                                    style="width: 150px; height: 150px; object-fit: cover;">
                                <h5 class="mt-3" style="color: #0d6efd;">{{ $user->nama }}</h5>
                            </div>
                        </div>

                        <form id="profile-form" enctype="multipart/form-data" method="POST">
                            @csrf
                            {{-- @method('PUT') --}}

                            <div class="form-group mb-3">
                                <label for="nama" class="col-form-label" style="color: #0d6efd;">{{ __('Nama') }}</label>
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ $user->nama }}" required>
                            </div>

                            {{-- <div class="form-group mb-3">
                                <label for="username" class="col-form-label" style="color: #0d6efd;">{{ __('Username') }}</label>
                                <input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}" required>
                            </div> --}}

                            <div class="form-group mb-3">
                                <label for="email" class="col-form-label" style="color: #0d6efd;">{{ __('Email') }}</label>
                                <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="no_telp" class="col-form-label" style="color: #0d6efd;">{{ __('No Telepon') }}</label>
                                <input id="no_telp" type="text" class="form-control" name="no_telp" value="{{ $user->no_telp }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="old_password" class="col-form-label" style="color: #0d6efd;">{{ __('Password Lama') }}</label>
                                <div class="input-group">
                                    <input id="old_password" type="password" class="form-control" name="old_password">
                                    <span class="input-group-text toggle-password" data-target="#old_password" style="cursor: pointer;">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="col-form-label" style="color: #0d6efd;">{{ __('Password Baru') }}</label>
                                <div class="input-group">
                                    <input id="password" type="password" class="form-control" name="password">
                                    <span class="input-group-text toggle-password" data-target="#password" style="cursor: pointer;">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password-confirm" class="col-form-label" style="color: #0d6efd;">{{ __('Confirm Password') }}</label>
                                <div class="input-group">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    <span class="input-group-text toggle-password" data-target="#password-confirm" style="cursor: pointer;">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="image" class="col-form-label" style="color: #0d6efd;">{{ __('Ganti Foto Profil') }}</label>
                                <input id="image" type="file" class="form-control" name="image" onchange="previewImage(event)">
                            </div>

                            <div class="text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <!-- Tombol Kembali -->
                                    <a href="{{ url('profile/') }}" class="btn btn-secondary mx-2" style="min-width: 150px;">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                    <!-- Tombol Simpan Perubahan -->
                                    <button type="button" class="btn btn-primary mx-2" id="save-profile-btn" style="min-width: 150px;">
                                        {{ __('Simpan Perubahan') }}
                                    </button>
                                </div>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </form>
                    </div>
                
            </div>
        </div>
    </div>
</div>

<style>
    .form-group {
        margin-bottom: 5px;
    }

    .form-group .col-form-label {
        margin-bottom: 3px;
    }

    .form-control {
        margin: 0;
        padding: 8px;
        font-size: 14px;
        line-height: 1.2;
    }
    
    .btn-hover {
        transition: transform 0.3s ease;
    }

    .btn-hover:hover {
        transform: scale(1.1);
    }
</style>

<script>
    //password
    document.querySelectorAll('.toggle-password').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const target = document.querySelector(this.dataset.target);
            const icon = this.querySelector('i');
            
            if (target.type === 'password') {
                target.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                target.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });

    // Preview uploaded image
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('profile-picture-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Handle form submission using AJAX
    document.getElementById('save-profile-btn').addEventListener('click', function () {
        const form = document.getElementById('profile-form');
        const formData = new FormData(form);

        fetch("{{ url('profile/' . $user->id_user . '/update') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'X-Requested-With': 'XMLHttpRequest'  // Untuk mendeteksi request AJAX
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Profil berhasil diperbarui.',
                }).then(() => {
                    location.reload(); // Refresh halaman untuk melihat perubahan
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Terjadi kesalahan saat memperbarui profil: ' + data.message,
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: 'Gagal menghubungi server. Silakan coba lagi.',
            });
        });
    });
</script>
@endsection
