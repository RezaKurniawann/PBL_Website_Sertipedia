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
                                            <option value="{{ $user->id_user }}">{{ $user->nama }}</option>
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
    // Event handler for the "Add" button
    $(document).on('click', '.btn-add-user', function() {
        const newField = $('.user-row:first').clone(); // Clone the first user row
        newField.find('select').val(''); // Reset the select field value
        $('#user-fields').append(newField); // Append the cloned field to the user-fields container
    });

    // Event handler for the "Remove" button
    $(document).on('click', '.btn-remove-user', function() {
        if ($('.user-row').length > 1) {
            $(this).closest('.user-row').remove(); // Remove the closest user row
        } else {
            showToast('Minimal Satu Dosen Harus Ada.'); // Show toast if only one row remains
        }
    });
    function checkDuplicates() {
            const userValues = [];
            let duplicateFound = false;

            $("select[name='user[]']").each(function() {
                const value = $(this).val();
                if (userValues.includes(value) && value !== "") {
                    duplicateFound = true;
                    showToast('Dosen tidak boleh sama.'); // Show error toast
                }
                userValues.push(value);
            });

            return !duplicateFound;
        }
    // Form validation and submission
    $("#form-edit").validate({
        rules: {
            'user[]': {
                required: true,
            }
        },
        submitHandler: function(form) {
            if (!checkDuplicates()) {
                    return false; // Prevent form submission
                }
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
    function showToast(message) {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: message
            });
        }
});
    </script>
@endempty

