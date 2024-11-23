@empty($vendor)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/vendor') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/vendor/' . $vendor->id . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data vendor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input value="{{ $vendor->nama }}" type="text" name="nama" id="nama"
                            class="form-control" required>
                        <small id="error-nama" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Alamat Vendor</label>
                        <input value="{{ $vendor->alamat }}" type="text" name="alamat" id="alamat"
                            class="form-control" required>
                        <small id="error-alamat" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Kota</label>
                        <input value="{{ $vendor->kota }}" type="text" name="kota" id="kota"
                            class="form-control" required>
                        <small id="error-kota" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input value="{{ $vendor->telepon }}" type="text" name="telepon" id="telepon"
                            class="form-control" required>
                        <small id="error-telepon" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Alamat Website</label>
                        <input value="{{ $vendor->alamatWeb }}" type="text" name="alamatWeb" id="alamatWeb"
                            class="form-control" required>
                        <small id="error-alamatWeb" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <input value="{{ $vendor->kategori }}" type="text" name="nama" id="nama"
                            class="form-control" required>
                        <small id="error-nama" class="error-text form-text text-danger"></small>
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
                    alamat: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                    },
                    kota: {
                        required: true,
                        minlength: 3,
                        maxlength: 50
                    },
                    telepon: {
                        required: true,
                        digits: true,
                        minlength: 6,
                        maxlength: 20
                    },
                    alamatWeb: {
                        required: true,
                        url: true
                    },
                    kategori: {
                        required: true,
                        minlength: 3,
                        maxlength: 50
                    }
                },
                messages: {
                    nama: {
                        required: "Nama Vendor wajib diisi.",
                        minlength: "Nama Vendor minimal 3 karakter.",
                        maxlength: "Nama Vendor maksimal 100 karakter."
                    },
                    alamat: {
                        required: "Alamat wajib diisi.",
                        minlength: "Alamat minimal 3 karakter.",
                        maxlength: "Alamat maksimal 255 karakter."
                    },
                    kota: {
                        required: "Kota wajib diisi.",
                        minlength: "Kota minimal 3 karakter.",
                        maxlength: "Kota maksimal 50 karakter."
                    },
                    telepon: {
                        required: "Nomor telepon wajib diisi.",
                        digits: "Hanya angka yang diperbolehkan.",
                        minlength: "Nomor telepon minimal 6 karakter.",
                        maxlength: "Nomor telepon maksimal 20 karakter."
                    },
                    alamatWeb: {
                        required: "Alamat Website wajib diisi.",
                        url: "Format URL tidak valid. Contoh: https://example.com"
                    },
                    kategori: {
                        required: "Kategori wajib diisi.",
                        minlength: "Kategori minimal 3 karakter.",
                        maxlength: "Kategori maksimal 50 karakter."
                    }
                },
                submitHandler: function(form) {
                    let saveButton = $(".btn-primary");
                    saveButton.prop("disabled", true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
    
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
                                $('.error-text').text(''); // Reset pesan error sebelumnya
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Gagal menyimpan data.'
                            });
                        },
                        complete: function() {
                            saveButton.prop("disabled", false).html("Simpan");
                        }
                    });
                    return false;
                },
                errorElement: 'small',
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