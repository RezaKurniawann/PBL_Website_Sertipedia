@empty($detailSertifikasi)
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
                    <a href="{{ url('inputdata/sertifikasi') }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
@else
    <form action="{{ url('inputdata/sertifikasi/' . $detailSertifikasi->id_detail_sertifikasi . '/upload') }}" method="POST"
        id="form-edit" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Input Data Sertifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th class="text-left col-3">Nama Sertifikasi</th>
                                <td class="col-9">{{ $detailSertifikasi->sertifikasi->nama }}</td>
                            </tr>
                            <tr>
                                <th class="text-left col-3">Vendor</th>
                                <td class="col-9">{{ $detailSertifikasi->sertifikasi->vendor->nama }}</td>
                            </tr>
                            <tr>
                                <th class="text-left col-3">Jenis Sertifikasi</th>
                                <td class="col-9">{{ $detailSertifikasi->sertifikasi->jenis_sertifikasi }}</td>
                            </tr>
                            <tr>
                                <th class="text-left col-3">Periode</th>
                                <td class="col-9">{{ $detailSertifikasi->sertifikasi->periode->tahun }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label for="no_sertifikasi">No Sertifikasi</label>
                        <input type="text" name="no_sertifikasi" id="no_sertifikasi" class="form-control" required
                            aria-describedby="error-no_sertifikasi" placeholder="Masukkan No Sertifikasi">
                        <small id="error-no_sertifikasi" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="image_sertifikasi">Pilih Image</label>
                        <input type="file" name="image_sertifikasi" id="image_sertifikasi" class="form-control" required>
                        <small id="error-image_sertifikasi" class="error-text form-text text-danger"></small>
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
            $("#form-edit").validate({
                rules: {
                    image_sertifikasi: {
                        required: true,
                    },
                    no_sertifikasi: {
                        required: true,
                        minlength: 5,
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method, 
                        data: new FormData(form), 
                        processData: false,
                        contentType: false, 
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                datadetailsertifikasi.ajax.reload();
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
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan Server',
                                text: 'Terjadi kesalahan di server. Coba lagi nanti.'
                            });
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
