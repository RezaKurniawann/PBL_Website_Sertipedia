<form action="{{ url('manage/event/pelatihan/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pelatihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Pelatihan</label>
                    <input value="" type="text" name="nama" id="nama" class="form-control"
                        placeholder="Masukkan Nama Lengkap" required>
                    <small id="error-nama" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Vendor</label>
                    <select name="id_vendor" id="id_vendor" class="form-control" required>
                        <option value="">- Pilih Vendor -</option>
                        @foreach ($vendor as $v)
                            @if ($v->kategori == 'Pelatihan')
                                <option value="{{ $v->id_vendor }}">{{ $v->nama }}</option>
                            @endif
                        @endforeach
                    </select>
                    <small id="error-id_vendor" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kuota</label>
                    <input value="" type="text" name="kuota" id="kuota" class="form-control"
                        placeholder="Masukkan Kuota Pelatihan" required>
                    <small id="error-kuota" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Lokasi</label>
                    <input value="" type="text" name="lokasi" id="lokasi" class="form-control"
                        placeholder="Masukkan Lokasi Pelatihan" required>
                    <small id="error-lokasi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Biaya</label>
                    <input value="" type="text" name="biaya" id="biaya" class="form-control"
                        placeholder="Contoh: 87000" required>
                    <small id="error-biaya" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="level_pelatihan">Level Pelatihan</label>
                    <select name="level_pelatihan" id="level_pelatihan" class="form-control" required>
                        <option value="">- Pilih Jenis pelatihan -</option>
                        <option value="Nasional">Nasional</option>
                        <option value="Internasional">Internasional</option>
                    </select>
                    <small id="error-level_pelatihan" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="tanggal_awal">Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required>
                    <small id="error-tanggal_awal" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="tanggal_akhir">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>
                    <small id="error-tanggal_akhir" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Periode</label>
                    <select name="id_periode" id="id_periode" class="form-control" required>
                        <option value="">- Pilih Periode -</option>
                        @foreach ($periode as $p)
                            <option value="{{ $p->id_periode }}">{{ $p->tahun }}</option>
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
        $("#form-tambah").validate({
            rules: {
                nama: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                id_vendor: {
                    required: true,
                },
                kuota: {
                    required: true
                },
                lokasi: {
                    required: true
                },
                biaya: {
                    required: true
                },
                level_pelatihan: {
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
                            datapelatihan.ajax.reload();
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
