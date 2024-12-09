@extends('layouts.template')
@section('content')
    <div id="myModal" class="modal fade animate bounceIn" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header ">
            <h3 class="card-title font-weight-bold">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('manage/jurusan/kompetensi/import') }}')"
                    class="btn btn-sm btn-info mt-1 ">
                    <i class="fa fa-upload"></i> Import Kompetensi
                </button>
                <a href="{{ url('manage/jurusan/kompetensi/export_excel') }}" class="btn btn-sm btn-success mt-1 ">
                    <i class="fa fa-file-excel"></i> Export Excel
                </a>
                <a href="{{ url('manage/jurusan/kompetensi/export_pdf') }}" class="btn btn-sm btn-danger mt-1 ">
                    <i class="fa fa-file-pdf"></i> Export PDF
                </a>
                <button onclick="modalAction('{{ url('manage/jurusan/kompetensi/create_ajax') }}')"
                    class="btn btn-sm btn-primary mt-1 ">
                    <i class="fa fa-plus"></i> Tambah Data
                </button>
            </div>
        </div>
    <div class="card-body bg-light">
        <!-- Filter data -->
        <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="from-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="id_prodi" name="id_prodi" required>
                                <option value="">- Semua -</option>
                                @foreach ($prodi as $p)
                                    <option value="{{ $p->id_prodi }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Prodi</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        @endif
        @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
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
<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.1);
    }

    .custom-gradient-header {
        background-image: linear-gradient(to right bottom, #0d6efd, #4e7bfd, #6d88fc, #8696fc, #9ba4fb);
    }
</style>
@endpush

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function(){
            $('#myModal').modal('show');
        });
    }

    // var tableKompetensi;
    $(document).ready(function() {
        var datakompetensi = $('#table_kompetensi').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{ url('manage/jurusan/kompetensi/list') }}",
                "dataType": "json",
                "type": "POST", 
                "data": function (d) {
                    d.id_prodi = $('#id_prodi').val();
                }
            },
            columns: [
                {
                    // Nomor urut dari Laravel DataTable addIndexColumn()
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                    width: "5%",
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


        $('#id_prodi').on('change', function(){
            datakompetensi.draw();
        });
    });
</script>
@endpush
