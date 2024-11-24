@empty($user)
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('manage/user') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('manage/user/' . $user->id_user . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input value="{{ $user->nama }}" type="text" name="nama" id="nama"
                            class="form-control" required>
                        <small id="error-nama" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select name="id_level" id="id_level" class="form-control" required>
                            <option value="">- Pilih Level -</option>
                            @foreach ($level as $l)
                                <option {{ $l->id_level == $user->id_level ? 'selected' : '' }}
                                    value="{{ $l->id_level }}">{{ $l->nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_level" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Prodi</label>
                        <select name="id_prodi" id="id_prodi" class="form-control" required>
                            <option value="">- Pilih Prodi -</option>
                            @foreach ($prodi as $p)
                                <option {{ $p->id_prodi == $user->id_prodi ? 'selected' : '' }}
                                    value="{{ $p->id_prodi }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_prodi" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Pangkat</label>
                        <select name="id_pangkat" id="id_pangkat" class="form-control" required>
                            <option value="">- Pilih Pangkat -</option>
                            @foreach ($pangkat as $t)
                                <option {{ $t->id_pangkat == $user->id_pangkat ? 'selected' : '' }}
                                    value="{{ $t->id_pangkat }}">{{ $t->nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_pangkat" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Golongan</label>
                        <select name="id_golongan" id="id_golongan" class="form-control" required>
                            <option value="">- Pilih Golongan -</option>
                            @foreach ($golongan as $g)
                                <option {{ $g->id_golongan == $user->id_golongan ? 'selected' : '' }}
                                    value="{{ $g->id_golongan }}">{{ $g->nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_golongan" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select name="id_jabatan" id="id_jabatan" class="form-control" required>
                            <option value="">- Pilih Jabatan -</option>
                            @foreach ($jabatan as $j)
                                <option {{ $j->id_jabatan == $user->id_jabatan ? 'selected' : '' }}
                                    value="{{ $j->id_jabatan }}">{{ $j->nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_jabatan" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input value="{{ $user->email }}" type="text" name="email" id="email"
                            class="form-control" required>
                        <small id="error-email" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input value="{{ $user->no_telp }}" type="text" name="no_telp" id="no_telp"
                            class="form-control" required>
                        <small id="error-no_telp" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input value="{{ $user->username }}" type="text" name="username" id="username"
                            class="form-control" required>
                        <small id="error-username" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $("#form-edit").validate({
                rules: {
                    nama: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    id_level: {
                        required: true
                    },
                    id_prodi: {
                        required: true
                    },
                    id_pangkat: {
                        required: true
                    },
                    id_golongan: {
                        required: true
                    },
                    id_jabatan: {
                        required: true
                    },
                    email: {
                        required: true,
                        minlength: 3,
                        maxlength: 50
                    },
                    no_telp: {
                        required: true,
                        minlength: 3,
                        maxlength: 15
                    },
                    username: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                        pattern: /^[0-9]+$/ // hanya angka
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        maxlength: 50
                    }
                },
                submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataLevel.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endempty