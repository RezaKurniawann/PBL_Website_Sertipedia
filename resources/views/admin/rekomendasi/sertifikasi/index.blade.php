@extends('layouts.template')
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Rekomendasi Sertifikasi</h5>
        </div>
        <div class="card-body bg-light">
            <form action="{{ url('manage/rekomendasi/sertifikasi/ajax') }}" method="POST" id="form-tambah">
                @csrf
                <div class="form-group">
                    <label>Sertifikasi</label>
                    <select name="id_sertifikasi" id="id_sertifikasi" class="form-control" required>
                        <option value="">- Pilih Sertifikasi -</option>
                        @foreach ($sertifikasi as $p)
                                <option value="{{ $p->id_sertifikasi }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
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
                    <label for="level_sertifikasi">Level Sertifikasi</label>
                    <select name="level_sertifikasi" id="level_sertifikasi" class="form-control" required>
                        <option value="">- Pilih Jenis Sertifikasi -</option>
                        <option value="Nasional">Nasional</option>
                        <option value="Internasional">Internasional</option>
                    </select>
                    <small id="error-level_sertifikasi" class="error-text form-text text-danger"></small>
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
                <div class="form-group">
                    <label for="dosen">Dosen</label>
                    <div id="user-fields">
                        <div class="user-row form-row align-items-center">
                            <div class="form-group col-md-9">
                                <select name="user[]" class="form-control" required>
                                    <option value="">Pilih Dosen</option>
                                    @foreach ($user as $u)
                                        <option value="{{ $u->id_user }}">{{ $u->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-success btn-add-user">
                                    <i class="fas fa-plus"></i> Add
                                </button>
                                <button type="button" class="btn btn-danger btn-remove-user" style="display: none;">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function () {
    $(document).off('click', '.btn-add-user');
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
            $("select[name='mata_kuliah[]']").each(function() {
                const value = $(this).val();
                if (mataKuliahValues.includes(value) && value !== "") {
                    duplicateFound = true;
                    showToast('Mata Kuliah tidak boleh sama.');
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
                showToast('Minimal Satu Mata Kuliah Harus Ada.');
            }
        });

    // Validasi Form
    $("#form-tambah").validate({
        rules: {
            id_pelatihan: { required: true },
            id_vendor: { required: true },
            level_pelatihan: { required: true },
            id_periode: { required: true },
            "user[]": { required: true }
        },
        submitHandler: function (form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function (response) {
                    if (response.status) {
                        Swal.fire({ icon: 'success', title: 'Berhasil', text: response.message });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Terjadi Kesalahan', text: response.message });
                    }
                }
            });
            return false;
        }
    });
</script>
@endpush
