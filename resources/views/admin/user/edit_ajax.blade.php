@empty($user)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ url('/user') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
    @else
        <form action="{{ url('/user/' . $users->id . '/update_ajax') }}" method="POST" id="form-edit">
            @csrf
            @method('PUT')
            <div id="modal-master" class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data users</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="form-group">
                        <label for="id_user">Id User</label>
                        <input type="text" name="id_user" id="id_user" class="form-control" required>
                        <small id="error-id_level" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="id_level">Id Level</label>
                        <input type="text" name="id_level" id="id_level" class="form-control" required>
                        <small id="error-id_level" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="id_prodi">Id Prodi</label>
                        <input type="text" name="id_prodi" id="id_prodi" class="form-control" required>
                        <small id="error-id_prodi" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="id_pangkat">Id Pangkat</label>
                        <input type="text" name="id_pangkat" id="id_pangkat" class="form-control" required>
                        <small id="error-id_pangkat" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="id_golongan">Id Golongan</label>
                        <input type="text" name="id_golongan" id="id_golongan" class="form-control" required>
                        <small id="error-id_golongan" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="id_jabatan">Id Jabatan</label>
                        <input type="text" name="id_jabatan" id="id_jabatan" class="form-control" required>
                        <small id="error-id_jabatan" class="error-text form-text text-danger"></small>
                    </div>                    
                    <div class="form-group">
                        <label for="nama">Nama User</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                        <small id="error-nama" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email User</label>
                        <input type="text" name="email" id="email" class="form-control" required>
                        <small id="error-email" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon User</label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control" required>
                        <small id="error-no_telp" class="error-text form-text text-danger"></small>
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                        <small id="error-username" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <small id="error-password" class="error-text form-text text-danger"></small>
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti password.</small>
                    </div>                                     
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
        <script>
            $(document).ready(function () {
                $("#form-edit").validate({
                    rules: {
                        id_user: {
                            required: true,
                            digits: true,
                        },
                        id_level: {
                            required: true,
                            digits: true,
                        },
                        id_prodi: {
                            required: true,
                            digits: true,
                        },
                        id_pangkat: {
                            required: true,
                            digits: true,
                        },
                        id_golongan: {
                            required: true,
                            digits: true,
                        },
                        id_jabatan: {
                            required: true,
                            digits: true,
                        },
                        nama: {
                            required: true,
                            minlength: 3,
                            maxlength: 100,
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        no_telp: {
                            required: true,
                            digits: true,
                        },
                        username: {
                            required: true,
                            minlength: 3,
                            maxlength: 50,
                        },
                    },
                    submitHandler: function (form) {
                        $.ajax({
                            url: form.action,
                            type: form.method,
                            data: $(form).serialize(),
                            success: function (response) {
                                if (response.status) {
                                    $('#modal-master').modal('hide');
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message,
                                    });
                                    datausers.ajax.reload();
                                } else {
                                    $('.error-text').text('');
                                    $.each(response.msgField, function (prefix, val) {
                                        $('#error-' + prefix).text(val[0]);
                                    });
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Terjadi Kesalahan',
                                        text: response.message,
                                    });
                                }
                            },
                            error: function () {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Terjadi kesalahan saat memproses data.',
                                });
                            },
                        });
                        return false;
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    },
                });
            });

        </script>
    @endempty