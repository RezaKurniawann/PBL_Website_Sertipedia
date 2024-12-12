@extends('layouts.template')

@section('content')
<!-- Modal -->
<div class="modal fade show d-block" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true" style="background: rgba(0, 0, 0, 0.5);">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" id="close-modal-btn" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 75vh; overflow-y: auto;">
                <form id="profile-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="nama" class="col-form-label">Nama</label>
                        <input id="nama" type="text" class="form-control" name="nama" value="{{ $user->nama }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="col-form-label">Email</label>
                        <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="no_telp" class="col-form-label">No Telepon</label>
                        <input id="no_telp" type="text" class="form-control" name="no_telp" value="{{ $user->no_telp }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="old_password" class="col-form-label" >Password Lama</label>
                        <div class="input-group">
                            <input id="old_password" type="password" class="form-control" name="old_password" required>
                            <span class="input-group-text toggle-password" data-target="#old_password" style="cursor: pointer;">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="col-form-label" >Password Baru</label>
                        <div class="input-group">
                            <input id="password" type="password" class="form-control" name="password" required>
                            <span class="input-group-text toggle-password" data-target="#password" style="cursor: pointer;">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password_confirmation" class="col-form-label">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            <span class="input-group-text toggle-password" data-target="#password_confirmation" style="cursor: pointer;">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="image" class="col-form-label">Ganti Foto Profil</label>
                        <input id="image" type="file" class="form-control" name="image">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close-modal-btn-footer">Kembali</button>
                <button type="button" class="btn btn-primary" id="save-profile-btn">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
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

    // Redirect to index page on close
    document.querySelectorAll('#close-modal-btn, #close-modal-btn-footer').forEach(button => {
        button.addEventListener('click', function () {
            window.location.href = "{{ url('profile') }}";
        });
    });

    document.getElementById('save-profile-btn').addEventListener('click', function () {
        const profileForm = document.getElementById('profile-form');
        fetch("{{ url('profile/' . $user->id_user . '/update') }}", {
            method: 'POST',
            body: new FormData(profileForm),
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: data.message,
                }).then(() => {
                    window.location.href = "{{ url('profile') }}";
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: data.message,
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
});
</script>
@endsection
