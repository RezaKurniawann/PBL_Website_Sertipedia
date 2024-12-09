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
                    <select name="id_pelatihan" class="form-control" required>
                        <option value="">- Pilih Pelatihan -</option>
                        @foreach ($pelatihan as $p)
                            <option value="{{ $p->id_pelatihan }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Vendor</label>
                    <select name="id_vendor" class="form-control" required>
                        <option value="">- Pilih Vendor -</option>
                        @foreach ($vendor as $v)
                            @if ($v->kategori == 'Pelatihan')
                                <option value="{{ $v->id_vendor }}">{{ $v->nama }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Level Pelatihan</label>
                    <select name="level_pelatihan" class="form-control" required>
                        <option value="">- Pilih Jenis pelatihan -</option>
                        <option value="Nasional">Nasional</option>
                        <option value="Internasional">Internasional</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Periode</label>
                    <select name="id_periode" class="form-control" required>
                        <option value="">- Pilih Periode -</option>
                        @foreach ($periode as $p)
                            <option value="{{ $p->id_periode }}">{{ $p->tahun }}</option>
                        @endforeach
                    </select>
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
    // Fungsi untuk menambahkan baris baru
    function addNewRow() {
        const newField = `
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
                    <button type="button" class="btn btn-danger btn-remove-user" style="margin-left: 5px;">
                        <i class="fas fa-trash"></i> Remove
                    </button>
                </div>
            </div>
        `;
        $('#user-fields').append(newField); // Tambahkan baris baru
    }

    // Event listener untuk tombol "Add"
    $(document).on('click', '.btn-add-user', function () {
        addNewRow(); // Tambahkan baris baru
    });

    // Event listener untuk tombol "Remove"
    $(document).on('click', '.btn-remove-user', function () {
        if ($('.user-row').length > 1) {
            $(this).closest('.user-row').remove(); // Hapus baris terkait
        } else {
            showToast('Minimal satu dosen harus ada.'); // Tampilkan notifikasi jika hanya satu baris tersisa
        }
    });

    // Fungsi untuk menampilkan notifikasi (Toast)
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
        $('body').append(toastHTML); // Tambahkan notifikasi ke body
        const toastElement = $('.toast').last();
        const toast = new bootstrap.Toast(toastElement[0]);
        toast.show(); // Tampilkan notifikasi

        // Hapus notifikasi setelah disembunyikan
        toastElement.on('hidden.bs.toast', function () {
            $(this).remove();
        });
    }
});

</script>
@endpush
