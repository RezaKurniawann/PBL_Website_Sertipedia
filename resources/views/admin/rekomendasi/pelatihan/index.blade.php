@extends('layouts.template')
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Rekomendasi Pelatihan</h5>
        </div>
        <div class="card-body bg-light">
            <form action="{{ url('manage/rekomendasi/pelatihan/ajax') }}" method="POST" id="form-tambah">
                @csrf
                <div class="form-group">
                    <label>Pelatihan</label>
                    <select name="id_pelatihan" id="id_pelatihan" class="form-control" required>
                        <option value="">- Pilih Pelatihan -</option>
                        @foreach ($pelatihan as $p)
                            <option value="{{ $p->id_pelatihan }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
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
                </div>
                <div class="form-group">
                    <label for="level_pelatihan">Level Pelatihan</label>
                    <select name="level_pelatihan" id="level_pelatihan" class="form-control" required>
                        <option value="">- Pilih Jenis pelatihan -</option>
                        <option value="Nasional">Nasional</option>
                        <option value="Internasional">Internasional</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Periode</label>
                    <select name="id_periode" id="id_periode" class="form-control" required>
                        <option value="">- Pilih Periode -</option>
                        @foreach ($periode as $p)
                            <option value="{{ $p->id_periode }}">{{ $p->tahun }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="dosen">Dosen</label>
                    <div id="dosen-fields">
                        <div class="dosen-row form-row align-items-center">
                            <div class="form-group col-md-9">
                                <select name="dosen[]" class="form-control" required>
                                    <option value="">Pilih Dosen</option>
                                    @foreach ($dosen as $d)
                                        @if ($d->id_level == '3')
                                            <option value="{{ $d->id_user }}">{{ $d->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-success btn-add-dosen">
                                    <i class="fas fa-plus"></i> Add
                                </button>
                                <button type="button" class="btn btn-danger btn-remove-dosen" style="display: none;">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
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

@push('scripts')
<script>
$(document).ready(function () {
    // Tambahkan baris baru
    $(document).on('click', '.btn-add-dosen', function () {
        const newField = `
        <div class="dosen-row form-row align-items-center">
            <div class="form-group col-md-9">
                <select name="dosen[]" class="form-control" required>
                    <option value="">Pilih Dosen</option>
                    @foreach ($dosen as $d)
                        @if ($d->id_level == '3')
                            <option value="{{ $d->id_user }}">{{ $d->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3 d-flex justify-content-end">
                <button type="button" class="btn btn-success btn-add-dosen">
                    <i class="fas fa-plus"></i> Add
                </button>
                <button type="button" class="btn btn-danger btn-remove-dosen">
                    <i class="fas fa-trash"></i> Remove
                </button>
            </div>
        </div>`;
        
        $('#dosen-fields').append(newField);

        // Pastikan tombol Add hanya muncul di baris terakhir
        $('.btn-add-dosen').hide(); // Sembunyikan semua tombol Add
        $('.dosen-row:last .btn-add-dosen').show(); // Tampilkan tombol Add di baris terakhir
    });

    // Hapus baris
    $(document).on('click', '.btn-remove-dosen', function () {
        if ($('.dosen-row').length > 1) {
            $(this).closest('.dosen-row').remove();

            // Pastikan tombol Add tetap di baris terakhir
            $('.btn-add-dosen').hide();
            $('.dosen-row:last .btn-add-dosen').show();
        } else {
            alert('Minimal satu dosen harus ada!');
        }
    });
});

    // Validasi Form
    $("#form-tambah").validate({
        rules: {
            id_pelatihan: { required: true },
            id_vendor: { required: true },
            level_pelatihan: { required: true },
            id_periode: { required: true },
            "dosen[]": { required: true }
        },
        submitHandler: function (form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function (response) {
                    if (response.status) {
                        Swal.fire({ icon: 'success', title: 'Berhasil', text: response.message });
                        // Reload or reset form
                    } else {
                        Swal.fire({ icon: 'error', title: 'Terjadi Kesalahan', text: response.message });
                    }
                }
            });
            return false;
        }
    });
});
</script>
@endpush
