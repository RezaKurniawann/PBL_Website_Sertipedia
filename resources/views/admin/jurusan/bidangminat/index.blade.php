@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Bidang Minat</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/bidangminat/import') }}')" class="btn btn-info"><i class="fa fa-file-import"></i> Import Kompetensi</button>
            <a href="{{ url('/bidangminat/export_excel') }}" class="btn btn-primary"><i class="fa fa-file excel"></i> Export User</a> 
            <a href="{{ url('/bidangminat/create') }}" class="btn btn-primary">Tambah Data</a>
            <button onclick="modalAction('{{ url('/bidangminat/create_ajax') }}')" class="btn btn-success">Tambah (Ajax)</button>
        </div>
    </div>
    <div class="card-body">
        <!-- Filter data -->
        <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-sm row text-sm mb-0">
                        <label for="filter_nama" class="col-md-1 col-form-label">Filter</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control form-control-sm filter_nama" placeholder="Filter berdasarkan Nama">
                            <small class="form-text text-muted">Nama Bidang Minat</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-sm table-striped table-hover" id="table_bidangminat">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Bidang Minat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="75%"></div>

@endsection

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function(){
            $('#myModal').modal('show');
        });
    }

    var tableBidangMinat;
    $(document).ready(function(){
        tableBidangMinat = $('#table_bidangminat').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{ url('/bidangminat/list') }}",
                "dataType": "json",
                "type": "POST", 
                data: function (d) {
                    d.filter_nama = $('.filter_nama').val();
                }
            },
            columns: [
                {
                    // Nomor urut dari Laravel DataTable addIndexColumn()
                    data: "DT_RowIndex",
                    // className: "text-center",
                    orderable: false,
                    searchable: false
                },
                { 
                    data: "nama", // Kolom Nama Bidang Minat
                    width: "60%",
                    orderable: false,
                    searchable: false
                },
                { 
                    data: "aksi", // Kolom Aksi untuk tombol
                    className: "text-center",
                    width: "15%",
                    orderable: false,
                    searchable: false
                }
            ],
            order: [[1, 'asc']], // Urutkan data berdasarkan ID Bidang Minat
            pageLength: 10 // Batas data per halaman
        });

        $('.filter_nama').keyup(function(){
            tableBidangMinat.draw();
        });
    });
</script>
@endpush
