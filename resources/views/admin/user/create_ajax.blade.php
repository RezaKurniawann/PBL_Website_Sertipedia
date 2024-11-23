<form action="{{ url('/user/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_user">ID User</label>
                        <select name="id_user" id="id_user" class="form-control" required aria-describedby="error-id_user">
                            <option value="">- Pilih User -</option>
                            @foreach ($user as $l)
                                <option value="{{ $l->id_user }}">{{ $l->nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_user" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="id_level">ID Level</label>
                        <input type="text" name="id_level" id="id_level" class="form-control" required
                            aria-describedby="error-id_level" placeholder="Masukkan ID Level">
                        <small id="error-id_level" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="id_prodi">ID Prodi</label>
                        <input type="text" name="id_prodi" id="id_prodi" class="form-control" required
                            aria-describedby="error-id_prodi" placeholder="Masukkan ID Prodi">
                        <small id="error-id_prodi" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="id_pangkat">ID Pangkat</label>
                        <input type="text" name="id_pangkat" id="id_pangkat" class="form-control" required
                            aria-describedby="error-id_pangkat" placeholder="Masukkan ID Pangkat">
                        <small id="error-id_pangkat" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="id_golongan">ID Golongan</label>
                        <input type="text" name="id_golongan" id="id_golongan" class="form-control" required
                            aria-describedby="error-id_golongan" placeholder="Masukkan ID Golongan">
                        <small id="error-id_golongan" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="id_jabatan">ID Jabatan</label>
                        <input type="text" name="id_jabatan" id="id_jabatan" class="form-control" required
                            aria-describedby="error-id_jabatan" placeholder="Masukkan ID Jabatan">
                        <small id="error-id_jabatan" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama User</label>
                        <input type="text" name="nama" id="nama" class="form-control" required
                            aria-describedby="error-nama" placeholder="Masukkan Nama Lengkap">
                        <small id="error-nama" class="error-text form-text text-danger"></small>
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
                        <input type="text" name="username" id="username" class="form-control" required
                            aria-describedby="error-username" placeholder="Masukkan Username">
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
    $(document).ready(function () {
        $("#form-tambah").validate({
            rules: {
                id_user: { required: true },
                id_level: { required: true, number: true },
                id_prodi: { required: true, number: true },
                id_pangkat: { required: true, number: true },
                id_golongan: { required: true, number: true },
                id_jabatan: { required: true, number: true },
                nama: { required: true, minlength: 3, maxlength: 100 },
                email: { required: true, email: true, minlength: 3, maxlength: 255 },
                no_telp: { required: true, digits: true, minlength: 6, maxlength: 20 },
                username: { required: true, minlength: 3, maxlength: 100 },
                password: { required: true, minlength: 8, maxlength: 255 },
            },
            messages: {
                id_user: { required: "ID User wajib dipilih." },
                id_level: { required: "ID Level wajib diisi.", number: "ID Level harus berupa angka." },
                id_prodi: { required: "ID Prodi wajib diisi.", number: "ID Prodi harus berupa angka." },
                id_pangkat: { required: "ID Pangkat wajib diisi.", number: "ID Pangkat harus berupa angka." },
                id_golongan: { required: "ID Golongan wajib diisi.", number: "ID Golongan harus berupa angka." },
                id_jabatan: { required: "ID Jabatan wajib diisi.", number: "ID Jabatan harus berupa angka." },
                nama: { required: "Nama wajib diisi.", minlength: "Nama minimal 3 karakter.", maxlength: "Nama maksimal 100 karakter." },
                email: { required: "Email wajib diisi.", email: "Format email tidak valid.", minlength: "Email minimal 3 karakter.", maxlength: "Email maksimal 255 karakter." },
                no_telp: { required: "Nomor telepon wajib diisi.", digits: "Hanya angka yang diperbolehkan.", minlength: "Nomor telepon minimal 6 karakter.", maxlength: "Nomor telepon maksimal 20 karakter." },
                username: { required: "Username wajib diisi.", minlength: "Username minimal 3 karakter.", maxlength: "Username maksimal 100 karakter." },
                password: { required: "Password wajib diisi.", minlength: "Password minimal 8 karakter.", maxlength: "Password maksimal 255 karakter." },
            },
            submitHandler: function (form) {
                let saveButton = $(".btn-primary");
                saveButton.prop("disabled", true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function (response) {
                        if (response.status) {
                            $('#createModal').modal('hide');
                            Swal.fire({ icon: 'success', title: 'Berhasil', text: response.message });
                            $(form)[0].reset();
                            dataUser.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function (prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({ icon: 'error', title: 'Gagal', text: response.message });
                        }
                    },
                    error: function () {
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menyimpan data.' });
                    },
                    complete: function () {
                        saveButton.prop("disabled", false).html("Simpan");
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('text-danger').appendTo(element.closest('.form-group').find('.error-text'));
            },
        });
    });
</script>
