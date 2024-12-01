@empty($user)
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
                    <a href="{{ url('manage/user') }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
    @else
        <form action="{{ url('manage/user/' . $user->id_user . '/update_ajax') }}" method="POST" id="form-edit">
            @csrf
            @method('PUT')
            <div id="modal-master" class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input value="{{ $user->nama }}" type="text" name="nama" id="nama"
                                class="form-control" required>
                            <small id="error-nama" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <select name="id_level" id="id_level" class="form-control" required>
                                <option value="">- Pilih Level -</option>
                                @foreach ($level as $l)
                                    <option {{ $l->id_level == $user->id_level ? 'selected' : '' }}
                                        value="{{ $l->id_level }}">{{ $l->nama }}</option>
                                @endforeach
                            </select>
                            <small id="error-id_level" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Prodi</label>
                            <select name="id_prodi" id="id_prodi" class="form-control" required>
                                <option value="">- Pilih Prodi -</option>
                                @foreach ($prodi as $p)
                                    <option {{ $p->id_prodi == $user->id_prodi ? 'selected' : '' }}
                                        value="{{ $p->id_prodi }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                            <small id="error-id_prodi" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Pangkat</label>
                            <select name="id_pangkat" id="id_pangkat" class="form-control" required>
                                <option value="">- Pilih Pangkat -</option>
                                @foreach ($pangkat as $t)
                                    <option {{ $t->id_pangkat == $user->id_pangkat ? 'selected' : '' }}
                                        value="{{ $t->id_pangkat }}">{{ $t->nama }}</option>
                                @endforeach
                            </select>
                            <small id="error-id_pangkat" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Golongan</label>
                            <select name="id_golongan" id="id_golongan" class="form-control" required>
                                <option value="">- Pilih Golongan -</option>
                                @foreach ($golongan as $g)
                                    <option {{ $g->id_golongan == $user->id_golongan ? 'selected' : '' }}
                                        value="{{ $g->id_golongan }}">{{ $g->nama }}</option>
                                @endforeach
                            </select>
                            <small id="error-id_golongan" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <select name="id_jabatan" id="id_jabatan" class="form-control" required>
                                <option value="">- Pilih Jabatan -</option>
                                @foreach ($jabatan as $j)
                                    <option {{ $j->id_jabatan == $user->id_jabatan ? 'selected' : '' }}
                                        value="{{ $j->id_jabatan }}">{{ $j->nama }}</option>
                                @endforeach
                            </select>
                            <small id="error-id_jabatan" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input value="{{ $user->email }}" type="text" name="email" id="email"
                                class="form-control" required>
                            <small id="error-email" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input value="{{ $user->no_telp }}" type="text" name="no_telp" id="no_telp"
                                class="form-control" required>
                            <small id="error-no_telp" class="error-text form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input value="{{ $user->username }}" type="text" name="username" id="username"
                                class="form-control" required>
                            <small id="error-username" class="error-text form-text text-danger"></small>
                        </div>
                        <div id="mata-kuliah-fields">
                            <h5>Mata Kuliah</h5>
                            @foreach ($user->matakuliah as $m)
                                <div class="mata-kuliah-row form-row">
                                    <div class="form-group col-md-9">
                                        <select name="mata_kuliah[]" class="form-control" required>
                                            <option value="">Pilih Mata Kuliah</option>
                                            @foreach ($matakuliah as $mk)
                                                <option value="{{ $mk->id_matakuliah }}"
                                                    {{ isset($m) && $m->id_matakuliah == $mk->id_matakuliah ? 'selected' : '' }}>
                                                    {{ $mk->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 d-flex align-items-center">
                                        <button type="button" class="btn btn-success btn-add-mata-kuliah mr-2">
                                            <i class="fas fa-plus"></i> Add
                                        </button>
                                        <button type="button" class="btn btn-danger btn-remove-mata-kuliah">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div id="bidang-minat-fields">
                            <h5>Bidang Minat</h5>
                            @foreach ($user->bidangminat as $b)
                                <div class="bidang-minat-row form-row">
                                    <div class="form-group col-md-9">
                                        <select name="bidang_minat[]" class="form-control" required>
                                            <option value="">Pilih Bidang Minat</option>
                                            @foreach ($bidangminat as $bm)
                                                <option value="{{ $bm->id_bidangminat }}"
                                                    {{ isset($b) && $b->id_bidangminat == $bm->id_bidangminat ? 'selected' : '' }}>
                                                    {{ $bm->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 d-flex align-items-center">
                                        <button type="button" class="btn btn-success btn-add-bidang-minat mr-2">
                                            <i class="fas fa-plus"></i> Add
                                        </button>
                                        <button type="button" class="btn btn-danger btn-remove-bidang-minat">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
        </form>
        <script>
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
            $(document).ready(function() {
                $("#form-edit").validate({
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
