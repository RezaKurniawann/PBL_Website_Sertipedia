<form action="{{ url('manage/event/sertifikasi/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Sertifikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Sertifikasi</label>
                    <input value="" type="text" name="nama" id="nama" class="form-control"
                        placeholder="Masukkan Nama Lengkap" required>
                    <small id="error-nama" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Vendor</label>
                    <select name="id_vendor" id="id_vendor" class="form-control" required>
                        <option value="">- Pilih Vendor -</option>
                        @foreach ($vendor as $v)
                            @if ($v->kategori == 'Sertifikasi')
                                <option value="{{ $v->id_vendor }}">{{ $v->nama }}</option>
                            @endif
                        @endforeach
                    </select>
                    <small id="error-id_vendor" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Biaya</label>
                    <input value="" type="text" name="biaya" id="biaya" class="form-control"
                        placeholder="Contoh: 87000" required>
                    <small id="error-biaya" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="jenis_sertifikasi">Jenis Sertifikasi</label>
                    <select name="jenis_sertifikasi" id="jenis_sertifikasi" class="form-control" required>
                        <option value="">- Pilih Jenis Sertifikasi -</option>
                        <option value="Profesi">Profesi</option>
                        <option value="Keahlian">Keahlian</option>
                    </select>
                    <small id="error-jenis_sertifikasi" class="error-text form-text text-danger"></small>
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
                <!-- Mata Kuliah -->
                <div id="mata-kuliah-fields">
                    <h5>Mata Kuliah</h5>
                    <div class="mata-kuliah-row form-row">
                        <div class="form-group col-md-10">
                            <select name="mata_kuliah[]" class="form-control" required>
                                <option value="">Pilih Mata Kuliah</option>
                                @foreach ($matakuliah as $m)
                                    <option value="{{ $m->id_matakuliah }}">{{ $m->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2 d-flex align-items-center">
                            <button type="button" class="btn btn-success btn-add-mata-kuliah">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Bidang Minat -->
                <div id="bidang-minat-fields">
                    <h5>Bidang Minat</h5>
                    <div class="bidang-minat-row form-row">
                        <div class="form-group col-md-10">
                            <select name="bidang_minat[]" class="form-control" required>
                                <option value="">Pilih Bidang Minat</option>
                                @foreach ($bidangminat as $b)
                                    <option value="{{ $b->id_bidangminat }}">{{ $b->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2 d-flex align-items-center">
                            <button type="button" class="btn btn-success btn-add-bidang-minat">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
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
        // Add Mata Kuliah Field
        $(document).on('click', '.btn-add-mata-kuliah', function() {
            const newField = $('.mata-kuliah-row:first').clone();
            newField.find('select').val('');
            $('#mata-kuliah-fields').append(newField);
            newField.find('.btn-add-mata-kuliah').removeClass('btn-add-mata-kuliah btn-success')
                .addClass('btn-remove-mata-kuliah btn-danger').html('<i class="fas fa-trash"></i>');
        });

        // Remove Mata Kuliah Field
        $(document).on('click', '.btn-remove-mata-kuliah', function() {
            $(this).closest('.mata-kuliah-row').remove();
        });

        // Add Bidang Minat Field
        $(document).on('click', '.btn-add-bidang-minat', function() {
            const newField = $('.bidang-minat-row:first').clone();
            newField.find('select').val('');
            $('#bidang-minat-fields').append(newField);
            newField.find('.btn-add-bidang-minat').removeClass('btn-add-bidang-minat btn-success')
                .addClass('btn-remove-bidang-minat btn-danger').html('<i class="fas fa-trash"></i>');
        });

        // Remove Bidang Minat Field
        $(document).on('click', '.btn-remove-bidang-minat', function() {
            $(this).closest('.bidang-minat-row').remove();
        });
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
                },
                "mata_kuliah[]": {
                    required: true
                },
                "bidang_minat[]": {
                    required: true
                }
            },
            messages: {
                "mata_kuliah[]": {
                    required: "Pilih minimal satu Mata Kuliah."
                },
                "bidang_minat[]": {
                    required: "Pilih minimal satu Bidang Minat."
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
                            dataSertifikasi.ajax.reload();
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
                if (element.closest('.mata-kuliah-row').length > 0 || element.closest(
                        '.bidang-minat-row').length > 0) {
                    element.closest('.form-group').append(error);
                } else {
                    element.closest('.form-group').append(error);
                }
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
