@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Kompetensi</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/kompetensi/import') }}')" class="btn btn-info"><i class="fa fa-file-import"></i> Import Kompetensi</button>
            <a href="{{ url('/user/export_excel') }}" class="btn btn-primary"><i class="fa fa-file excel"></i> Export User</a> 
            <a href="{{ url('/kompetensi/create') }}" class="btn btn-primary">Tambah Data</a>
            <button onclick="modalAction('{{ url('manage/jurusan/kompetensi/create_ajax') }}')" class="btn btn-success">Tambah (Ajax)</button>
        </div>
    </div>
    <div class="card-body">
        <!-- Filter data -->
        <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-sm row text-sm mb-0">
                        <label for="filter_prodi" class="col-md-1 col-form-label">Filter</label>
                        <div class="col-md-3">
                            <select name="filter_prodi" class="form-control form-control-sm filter_prodi">
                                <option value="">- Semua -</option>
                                @foreach($prodi as $p)
                                    <option value="{{ $p->id_prodi }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Prodi</small>
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

        <table class="table table-bordered table-sm table-striped table-hover" id="table_kompetensi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Prodi</th>
                    <th>Nama Kompetensi</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="75%"></div>

@endsection

@push('css')
@endpush

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function(){
            $('#myModal').modal('show');
        });
    }

    var tableKompetensi;
    $(document).ready(function(){
        tableKompetensi = $('#table_kompetensi').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{ url('/kompetensi/list') }}",
                "dataType": "json",
                "type": "POST", 
                data: function (d) {
                    d.filter_prodi = $('.filter_prodi').val();
                }
            },
            columns: [
                {
                    // Nomor urut dari Laravel DataTable addIndexColumn()
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                { 
                    data: "prodi",
                    width: "15%",
                    orderable: true,
                    searchable: true
                },
                { 
                    data: "nama",
                    width: "20%",
                    orderable: true,
                    searchable: true
                },
                { 
                    data: "deskripsi",
                    width: "35%",
                    orderable: false,
                    searchable: false
                },
                { 
                    data: "aksi",
                    className: "text-center",
                    width: "20%",
                    orderable: false,
                    searchable: false
                }
            ],
            order: [[1, 'asc']], // Urutkan data berdasarkan nama prodi
            pageLength: 10 // Batas data per halaman
        });


        $('.filter_prodi').change(function(){
            tableKompetensi.draw();
        });
    });
</script>
@endpush
