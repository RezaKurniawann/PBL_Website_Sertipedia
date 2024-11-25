
@empty($pelatihan)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('manage/event/pelatihan') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('manage/event/pelatihan/' . $pelatihan->id_pelatihan . '/delete_ajax') }}" method="POST" id="form-delete">
        @csrf
        @method('DELETE')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pelatihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h5><i class="icon fas fa-ban"></i> Konfirmasi !!!</h5>
                        Apakah Anda ingin menghapus data seperti di bawah ini?
                    </div>
                    <table class="table table-sm table-bordered table-striped"> 
                        <tr><th class="text-right col-3">Nama Pelatihan :</th><td class="col-9">{{ $pelatihan->nama }}</td></tr>
                        <tr><th class="text-right col-3">Vendor : </th><td class="col-9">{{ $pelatihan->vendor->nama }}</td></tr>
                        <tr><th class="text-right col-3">Kuota : </th><td class="col-9">{{ $pelatihan->kuota }}</td></tr>
                        <tr><th class="text-right col-3">Lokasi : </th><td class="col-9">{{ $pelatihan->lokasi }}</td></tr>
                        <tr><th class="text-right col-3">Biaya : </th><td class="col-9">Rp {{ number_format($pelatihan->biaya, 2, ',', '.') }}</td></tr>
                        <tr><th class="text-right col-3">Level Pelatihan : </th><td class="col-9">{{ $pelatihan->level_pelatihan }}</td></tr>
                        <tr><th class="text-right col-3">Tanggal Awal : </th><td class="col-9">{{ \Carbon\Carbon::parse($pelatihan->tanggal_awal)->format('d/m/Y') }}</td></tr>
                        <tr><th class="text-right col-3">Tanggal Akhir : </th><td class="col-9">{{ \Carbon\Carbon::parse($pelatihan->tanggal_akhir)->format('d/m/Y') }}</td></tr>
                        <tr><th class="text-right col-3">Periode : </th><td class="col-9">{{ $pelatihan->periode->tahun }}</td></tr>
                    </table>
                    <div class="mt-4">
                        <h4 class="font-weight-bold">Mata Kuliah</h4>
                        <div class="row">
                            @foreach ($matakuliah as $mk)
                                <div class="col-md-4 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $mk->nama }}</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
    
                    <div class="mt-4">
                        <h4 class="font-weight-bold">Bidang Minat</h4>
                        <div class="row">
                            @foreach ($bidangminat as $bm)
                                <div class="col-md-4 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $bm->nama }}</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $("#form-delete").validate({
                rules: {},
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
                                datapelatihan.ajax.reload();
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