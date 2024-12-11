@empty($detailPelatihan)
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
                    <a href="{{ url('manage/rekomendasi/pelatihan') }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
@else
    <form action="{{ url('manage/rekomendasi/pelatihan/' . $detailPelatihan->id_pelatihan . '/upload') }}" method="POST"
        id="form-edit" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Input Data Pelatihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th class="text-left col-3">Nama Pelatihan</th>
                                <td class="col-9">{{ $detailPelatihan->nama }}</td>
                            </tr>
                            <tr>
                                <th class="text-left col-3">Vendor</th>
                                <td class="col-9">{{ $detailPelatihan->vendor->nama }}</td>
                            </tr>
                            <tr>
                                <th class="text-left col-3">Level Pelatihan</th>
                                <td class="col-9">{{ $detailPelatihan->level_pelatihan }}</td>
                            </tr>
                            <tr>
                                <th class="text-left col-3">Periode</th>
                                <td class="col-9">{{ $detailPelatihan->periode->tahun }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <div id="user-fields">
                            <h5>Dosen</h5>
                            <div class="user-row form-row align-items-center">
                                <!-- Field Bidang Minat -->
                                <div class="form-group col-md-9">
                                    <select name="user[]" class="form-control" required>
                                        <option value="">Pilih Dosen</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                        @endforeach
                                    </select>                                    
                                </div>
                                <!-- Tombol -->
                                <div class="form-group col-md-3 d-flex justify-content-end">
                                    <button type="button" class="btn btn-success btn-add-user mr-2">
                                        <i class="fas fa-plus"></i> Add
                                    </button>
                                    <button type="button" class="btn btn-danger btn-remove-user">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>    
                    </div>
                </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $('#myModal').on('shown.bs.modal', function() {
            // Hapus event handler lama jika ada
            $(document).off('click', '.btn-add-user');

            // Tambahkan event handler baru
            $(document).on('click', '.btn-add-user', function() {
                const newField = $('.user-row:first').clone();
                newField.find('select').val(''); // Reset the select field value
                $('#user-fields').append(newField);
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
            let duplicateFound = false;

            // Mata Kuliah validation
            $("select[name='user[]']").each(function() {
                const value = $(this).val();
                if (mataKuliahValues.includes(value) && value !== "") {
                    duplicateFound = true;
                    showToast('Dosen tidak boleh sama.');
                }
                mataKuliahValues.push(value);
            });
            return !duplicateFound; // Prevent form submission if duplicate found
        }

        $(document).on('click', '.btn-add-user', function() {
            const newField = $('.user-row:first').clone();
            newField.find('select').val(''); // Reset the select field value

            // Re-add the "Add" button to the cloned row
            newField.find('.btn-add-user').show();

            // Append the cloned field to the user-fields container
            $('#user-fields').append(newField);
        });

        $(document).on('click', '.btn-remove-user', function() {
            if ($('.user-row').length > 1) {
                $(this).closest('.user-row').remove();
            } else {
                showToast('Minimal Satu Dosen Harus Ada.');
            }
        });
            $("#form-edit").validate({
                rules: {
                    user[]: {
                        required: true,
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
                                datadetailPelatihan.ajax.reload();
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

