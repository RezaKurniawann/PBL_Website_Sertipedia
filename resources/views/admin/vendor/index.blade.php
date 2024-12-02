@extends('layouts.template')
@section('content')
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('manage/vendor/import') }}')" class="btn btn-sm btn-info mt-1"><i class="fa fa-upload"></i> Import vendor</button>
            <a href="{{ url('manage/vendor/export_excel') }}" class="btn btn-sm btn-success mt-1"><i class="fa fa-file-excel"></i> Export Excel</a>
            <a href="{{ url('manage/vendor/export_pdf') }}" class="btn btn-sm btn-danger mt-1"><i class="fa fa-file-pdf"></i> Export PDF</a>
            <button onclick="modalAction('{{ url('manage/vendor/create_ajax') }}')" class="btn btn-sm btn-primary mt-1"><i class="fa fa-plus"></i> Tambah Data</button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="kategori" name="kategori">
                            <option value="">- Semua -</option>
                            <option value="Pelatihan">Pelatihan</option>
                            <option value="Sertifikasi">Sertifikasi</option>
                        </select>
                        <small class="form-text text-muted">Kategori Vendor</small>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_vendor">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Vendor</th>
                    <th>Alamat Vendor</th>
                    <th>Kota</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat Website</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

    $(document).ready(function() {
        // Inisialisasi DataTable
        var datavendor = $('#table_vendor').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ url('manage/vendor/list') }}",
                type: "POST",
                data: function(d) {
                    d.kategori = $('#kategori').val(); // Kirim data kategori ke server
                }
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", width: "5%", orderable: false, searchable: false },
                { data: "nama", orderable: true, searchable: true },
                { data: "alamat", orderable: true, searchable: true },
                { data: "kota", orderable: false, searchable: true },
                { data: "telepon", orderable: false, searchable: false },
                { data: "alamatWeb", orderable: false, searchable: false },
                { data: "kategori", orderable: false, searchable: true },
                { data: "aksi", width: "15%", orderable: false, searchable: false }
            ]
        });

        // Reload DataTable ketika filter berubah
        $('#kategori').change(function() {
            datavendor.ajax.reload();
        });
    });
</script>
@endpush