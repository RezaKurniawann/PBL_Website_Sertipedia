<form action="{{ url('manage/vendor/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Data Vendor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama">Nama Vendor</label>
                    <input type="text" name="nama" id="nama" class="form-control" required
                        aria-describedby="error-nama" placeholder="Masukkan Nama Vendor">
                    <small id="error-nama" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat Vendor</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" required
                        aria-describedby="error-alamat" placeholder="Masukkan Alamat">
                    <small id="error-alamat" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="kota">Kota Vendor</label>
                    <input type="text" name="kota" id="kota" class="form-control" required
                        aria-describedby="error-kota" placeholder="Masukkan Kota Vendor">
                    <small id="error-kota" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="telepon">Nomor Telepon</label>
                    <input type="text" name="telepon" id="telepon" class="form-control" required
                        aria-describedby="error-telepon" placeholder="Masukkan Nomor Telepon">
                    <small id="error-telepon" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="alamatWeb">Alamat Website</label>
                    <input type="text" name="alamatWeb" id="alamatWeb" class="form-control" required
                        aria-describedby="error-alamatWeb" placeholder="Masukkan Alamat Website">
                    <small id="error-alamatWeb" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required aria-describedby="error-kategori">
                        <option value="">Pilih Kategori</option>
                        <option value="sertifikasi">Sertifikasi</option>
                        <option value="pelatihan">Pelatihan</option>
                    </select>
                    <small id="error-kategori" class="error-text form-text text-danger"></small>
                </div>
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
        $("#form-tambah").validate({
            rules: {
                nama: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                alamat: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                kota: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                telepon: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                alamatWeb: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                kategori: {
                    required: true
                },
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
                            datavendor.ajax.reload();
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
