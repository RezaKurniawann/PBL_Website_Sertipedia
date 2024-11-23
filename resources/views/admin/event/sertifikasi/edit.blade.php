@empty($sertifikasi)
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
                <a href="{{ url('manage/event/sertifikasi') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('manage/event/sertifikasi/' . $sertifikasi->id_sertifikasi . '/update_ajax') }}" method="POST"
        id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Sertifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Sertifikasi</label>
                        <input value="{{ $sertifikasi->nama }}" type="text" name="nama" id="nama"
                            class="form-control" required>
                        <small id="error-nama" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Vendor</label>
                        <select name="id_vendor" id="id_vendor" class="form-control" required>
                            <option value="">- Pilih Vendor -</option>
                            @foreach ($vendor as $v)
                                @if ($v->kategori == 'Sertifikasi')
                                    <option {{ $v->id_vendor == $sertifikasi->id_vendor ? 'selected' : '' }}
                                        value="{{ $v->id_vendor }}">{{ $v->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        <small id="error-id_vendor" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Biaya</label>
                        <input value="{{ $sertifikasi->biaya }}" type="text" name="biaya" id="biaya"
                            class="form-control" required>
                        <small id="error-biaya" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="jenis_sertifikasi">Jenis Sertifikasi</label>
                        <select name="jenis_sertifikasi" id="jenis_sertifikasi" class="form-control" required>
                            <option value="">- Pilih Jenis Sertifikasi -</option>
                            <option value="Profesi" {{ $sertifikasi->jenis_sertifikasi == 'Profesi' ? 'selected' : '' }}>
                                Profesi</option>
                            <option value="Keahlian" {{ $sertifikasi->jenis_sertifikasi == 'Keahlian' ? 'selected' : '' }}>
                                Keahlian</option>
                        </select>
                        <small id="error-jenis_sertifikasi" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_awal">Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control"
                            value="{{ $sertifikasi->tanggal_awal->format('Y-m-d') }}" required>
                        <small id="error-tanggal_awal" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_akhir">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control"
                            value="{{ $sertifikasi->tanggal_akhir->format('Y-m-d') }}" required>
                        <small id="error-tanggal_akhir" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Periode</label>
                        <select name="id_periode" id="id_periode" class="form-control" required>
                            <option value="">- Pilih Periode -</option>
                            @foreach ($periode as $p)
                                <option {{ $p->id_periode == $sertifikasi->id_periode ? 'selected' : '' }}
                                    value="{{ $p->id_periode }}">{{ $p->tahun }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_periode" class="error-text form-text text-danger"></small>
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
                    nama: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    id_vendor: {
                        required: true,
                    },
                    biaya: {
                        required: true
                    },
                    jenis_sertifikasi: {
                        required: true
                    },
                    tanggal_awal: {
                        required: true
                    },
                    tanggal_akhir: {
                        required: true
                    },
                    id_periode: {
                        required: true
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
                                datasertifikasi.ajax.reload();
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
