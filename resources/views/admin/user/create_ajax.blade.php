<form action="{{ url('manage/user/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama User</label>
                        <input type="text" name="nama" id="nama" class="form-control" required
                            aria-describedby="error-nama" placeholder="Masukkan Nama Lengkap">
                        <small id="error-nama" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="id_level">Level</label>
                        <select name="id_level" id="id_level" class="form-control" required>
                            <option value="">- Pilih Level -</option>
                            @foreach ($level as $l)
                                <option value="{{ $l->id_level }}">{{ $l->nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_level" class="form-text text-danger"></small>
                    </div>
                    
                    <div class="form-group">
                        <label for="id_prodi">Prodi</label>
                        <select name="id_prodi" id="id_prodi" class="form-control" required>
                            <option value="">- Pilih Prodi -</option>
                            @foreach ($prodi as $p)
                                <option value="{{ $p->id_prodi }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_prodi" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="id_pangkat">Pangkat</label>
                        <select name="id_pangkat" id="id_pangkat" class="form-control" required>
                            <option value="">- Pilih Pangkat -</option>
                            @foreach ($pangkat as $t)
                                <option value="{{ $t->id_pangkat }}">{{ $t->nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_pangkat" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="id_golongan">Golongan</label>
                        <select name="id_golongan" id="id_golongan" class="form-control" required>
                            <option value="">- Pilih Golongan -</option>
                            @foreach ($golongan as $g)
                                <option value="{{ $g->id_golongan }}">{{ $g->nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_golongan" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="id_jabatan">Jabatan</label>
                        <select name="id_jabatan" id="id_jabatan" class="form-control" required>
                            <option value="">- Pilih Jabatan -</option>
                            @foreach ($jabatan as $j)
                                <option value="{{ $j->id_jabatan }}">{{ $j->nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_jabatan" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" required
                            aria-describedby="error-email" placeholder="Masukkan Email">
                        <small id="error-email" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon</label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control" required
                            aria-describedby="error-no_telp" placeholder="Masukkan Nomor Telepon">
                        <small id="error-no_telp" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required pattern="^[0-9]+$">
                            aria-describedby="error-username" placeholder="Masukkan username">
                        <small id="error-username" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required
                            aria-describedby="error-password" placeholder="Masukkan Password">
                        <small id="error-password" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#form-tambah").validate({
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