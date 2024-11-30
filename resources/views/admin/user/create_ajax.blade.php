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
                        <input type="text" name="username" id="username" class="form-control" required pattern="^[0-9]+$"
                            aria-describedby="error-username" placeholder="Masukkan username">
                        <small id="error-username" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required
                            aria-describedby="error-password" placeholder="Masukkan Password">
                        <small id="error-password" class="error-text form-text text-danger"></small>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
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
                },
                "mata_kuliah[]": {
                    required: true
                },
                "bidang_minat[]": {
                    required: true
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