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
                <div class="form-group text-right">
                    <button type="button" id="cancel-form" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
<script>
$(document).ready(function() {
    $("#form-tambah").validate({
        rules: {
            id_sertifikasi: { required: true },
            id_vendor: { required: true },
            level_sertifikasi: { required: true },
            id_periode: { required: true }
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    if (response.status) {
                        $("#content-master").hide();
                        Swal.fire({ icon: 'success', title: 'Berhasil', text: response.message });
                        datasertifikasi.ajax.reload();
                    } else {
                        $(".error-text").text('');
                        $.each(response.msgField, function(prefix, val) {
                            $('#error-' + prefix).text(val[0]);
                        });
                        Swal.fire({ icon: 'error', title: 'Terjadi Kesalahan', text: response.message });
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
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        }
    });

    $("#cancel-form, #close-form").on('click', function() {
        $("#content-master").hide();
    });
});
</script>   