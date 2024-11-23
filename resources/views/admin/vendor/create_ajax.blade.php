<form action="{{ url('/vendor/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Data vendor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_vendor">ID vendor</label>
                        <select name="id_vendor" id="id_vendor" class="form-control" required aria-describedby="error-id_vendor">
                            <option value="">- Pilih vendor -</option>
                            @foreach ($vendor as $l)
                                <option value="{{ $l->id_vendor }}">{{ $l->nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_vendor" class="error-text form-text text-danger"></small>
                    </div>
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
                            aria-describedby="error-kota" placeholder="Masukkan Nomor Telepon">
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
                        <input type="alamatWeb" name="alamatWeb" id="alamatWeb" class="form-control" required
                            aria-describedby="error-alamatWeb" placeholder="Masukkan Alamat Website">
                        <small id="error-alamatWeb" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="kategori" name="kategori" id="kategori" class="form-control" required
                            aria-describedby="error-kategori" placeholder="Masukkan Kategori">
                        <small id="error-kategori" class="error-text form-text text-danger"></small>
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
                id_vendor: { required: true },
                nama: { required: true, minlength: 3, maxlength: 100 },
                alamat: { required: true, minlength: 3, maxlength: 255 },
                kota: { required: true, minlength: 3, maxlength: 50 },
                telepon: { required: true, digits: true, minlength: 6, maxlength: 20 },
                alamatWeb: { required: true, url: true },
                kategori: { required: true, minlength: 3, maxlength: 50 },
            },
            messages: {
                id_vendor: { required: "ID Vendor wajib dipilih." },
                nama: {
                    required: "Nama Vendor wajib diisi.",
                    minlength: "Nama Vendor minimal 3 karakter.",
                    maxlength: "Nama Vendor maksimal 100 karakter.",
                },
                alamat: {
                    required: "Alamat wajib diisi.",
                    minlength: "Alamat minimal 3 karakter.",
                    maxlength: "Alamat maksimal 255 karakter.",
                },
                kota: {
                    required: "Kota wajib diisi.",
                    minlength: "Kota minimal 3 karakter.",
                    maxlength: "Kota maksimal 50 karakter.",
                },
                telepon: {
                    required: "Nomor telepon wajib diisi.",
                    digits: "Hanya angka yang diperbolehkan.",
                    minlength: "Nomor telepon minimal 6 karakter.",
                    maxlength: "Nomor telepon maksimal 20 karakter.",
                },
                alamatWeb: {
                    required: "Alamat Website wajib diisi.",
                    url: "Format URL tidak valid. Contoh: https://example.com",
                },
                kategori: {
                    required: "Kategori wajib diisi.",
                    minlength: "Kategori minimal 3 karakter.",
                    maxlength: "Kategori maksimal 50 karakter.",
                },
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
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                            });
                            $(form)[0].reset(); // Reset form setelah berhasil
                            datavendors.ajax.reload(); // Reload data tabel
                        } else {
                            $('.error-text').text(''); // Kosongkan pesan error sebelumnya
                            $.each(response.msgField, function (prefix, val) {
                                $('#error-' + prefix).text(val[0]); // Tampilkan error spesifik
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message,
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat menyimpan data.',
                        });
                    },
                    complete: function () {
                        saveButton.prop("disabled", false).html("Simpan");
                    },
                });
                return false; // Mencegah submit form secara default
            },
            errorElement: 'small',
            errorPlacement: function (error, element) {
                error.addClass('text-danger').appendTo(element.closest('.form-group').find('.error-text'));
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>