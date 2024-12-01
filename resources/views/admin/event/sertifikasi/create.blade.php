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
                <div class="mata-kuliah-row form-row align-items-center">
                    <!-- Field Mata Kuliah -->
                    <div class="form-group col-md-9">
                        <select name="mata_kuliah[]" class="form-control" required>
                            <option value="">Pilih Mata Kuliah</option>
                            @foreach ($matakuliah as $m)
                                <option value="{{ $m->id_matakuliah }}">{{ $m->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Tombol -->
                    <div class="form-group col-md-3 d-flex justify-content-end">
                        <button type="button" class="btn btn-success btn-add-mata-kuliah mr-2">
                            <i class="fas fa-plus"></i> Add
                        </button>
                        <button type="button" class="btn btn-danger btn-remove-mata-kuliah">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
            </div>

            <!-- Bidang Minat -->
            <div id="bidang-minat-fields">
                <h5>Bidang Minat</h5>
                <div class="bidang-minat-row form-row align-items-center">
                    <!-- Field Bidang Minat -->
                    <div class="form-group col-md-9">
                        <select name="bidang_minat[]" class="form-control" required>
                            <option value="">Pilih Bidang Minat</option>
                            @foreach ($bidangminat as $b)
                                <option value="{{ $b->id_bidangminat }}">{{ $b->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Tombol -->
                    <div class="form-group col-md-3 d-flex justify-content-end">
                        <button type="button" class="btn btn-success btn-add-bidang-minat mr-2">
                            <i class="fas fa-plus"></i> Add
                        </button>
                        <button type="button" class="btn btn-danger btn-remove-bidang-minat">
                            <i class="fas fa-trash"></i> Remove
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
       // Tambahkan event handler saat modal pertama kali dibuka
       $('#myModal').on('shown.bs.modal', function() {
            // Hapus event handler lama jika ada
            $(document).off('click', '.btn-add-mata-kuliah');
            $(document).off('click', '.btn-add-bidang-minat');

            // Tambahkan event handler baru
            $(document).on('click', '.btn-add-mata-kuliah', function() {
                const newField = $('.mata-kuliah-row:first').clone();
                newField.find('select').val(''); // Reset the select field value
                $('#mata-kuliah-fields').append(newField);
            });

            $(document).on('click', '.btn-add-bidang-minat', function() {
                const newField = $('.bidang-minat-row:first').clone();
                newField.find('select').val(''); // Reset the select field value
                $('#bidang-minat-fields').append(newField);
            });
        });

        function showToast(message) {
            const toastHTML = `
        <div class="toast align-items-center text-white border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; bottom: 1rem; right: 1rem; z-index: 1050; min-width: 250px; border-radius: 10px; background: linear-gradient(45deg, #ff6b6b, #f0a500); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
            <div class="d-flex">
                <div class="toast-body" style="padding: 10px 15px; font-size: 16px;">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;
            $('body').append(toastHTML);
            const toastElement = $('.toast').last();
            const toast = new bootstrap.Toast(toastElement[0]);
            toast.show();

            toastElement.on('hidden.bs.toast', function() {
                $(this).remove();
            });
        }

        function checkDuplicates() {
            const mataKuliahValues = [];
            const bidangMinatValues = [];
            let duplicateFound = false;

            // Mata Kuliah validation
            $("select[name='mata_kuliah[]']").each(function() {
                const value = $(this).val();
                if (mataKuliahValues.includes(value) && value !== "") {
                    duplicateFound = true;
                    showToast('Mata Kuliah tidak boleh sama.');
                }
                mataKuliahValues.push(value);
            });

            // Bidang Minat validation
            $("select[name='bidang_minat[]']").each(function() {
                const value = $(this).val();
                if (bidangMinatValues.includes(value) && value !== "") {
                    duplicateFound = true;
                    showToast('Bidang Minat tidak boleh sama.');
                }
                bidangMinatValues.push(value);
            });

            return !duplicateFound; // Prevent form submission if duplicate found
        }

        $(document).on('click', '.btn-add-mata-kuliah', function() {
            const newField = $('.mata-kuliah-row:first').clone();
            newField.find('select').val(''); // Reset the select field value

            // Re-add the "Add" button to the cloned row
            newField.find('.btn-add-mata-kuliah').show();

            // Append the cloned field to the mata-kuliah-fields container
            $('#mata-kuliah-fields').append(newField);
        });

        $(document).on('click', '.btn-remove-mata-kuliah', function() {
            if ($('.mata-kuliah-row').length > 1) {
                $(this).closest('.mata-kuliah-row').remove();
            } else {
                showToast('Minimal Satu Mata Kuliah Harus Ada.');
            }
        });

        $(document).on('click', '.btn-add-bidang-minat', function() {
            const newField = $('.bidang-minat-row:first').clone();
            newField.find('select').val(''); // Reset the select field value

            // Re-add the "Add" button to the cloned row
            newField.find('.btn-add-bidang-minat').show();

            // Append the cloned field to the bidang-minat-fields container
            $('#bidang-minat-fields').append(newField);
        });

        $(document).on('click', '.btn-remove-bidang-minat', function() {
            if ($('.bidang-minat-row').length > 1) {
                $(this).closest('.bidang-minat-row').remove();
            } else {
                showToast('Minimal Satu Bidang Minat Harus Ada.');
            }
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
                if (!checkDuplicates()) {
                    return false;
                }
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
