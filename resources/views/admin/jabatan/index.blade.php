@extends('layouts.template')
@section('content')
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                {{-- <button onclick="modalAction('{{ url('manage/jabatan/import') }}')"
                    class="btn btn-sm btn-info mt-1 ">
                    <i class="fa fa-upload"></i> Import jabatan
                </button>
                <a href="{{ url('manage/jabatan/export_excel') }}" class="btn btn-sm btn-success mt-1 ">
                    <i class="fa fa-file-excel"></i> Export Excel
                </a>
                <a href="{{ url('manage/jabatan/export_pdf') }}" class="btn btn-sm btn-danger mt-1 ">
                    <i class="fa fa-file-pdf"></i> Export PDF
                </a> --}}
                <button onclick="modalAction('{{ url('manage/jabatan/create_ajax') }}')"
                    class="btn btn-sm btn-primary mt-1 ">
                    <i class="fa fa-plus"></i> Tambah Data
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_jabatan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
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

</style>
@endpush
@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        $(document).ready(function() {
            var dataJabatan = $('#table_jabatan').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    "url": "{{ url('manage/jabatan/list') }}",
                    "dataType": "json",
                    "type": "POST"
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                    width: "5%" 
                }, {
                    data: "nama",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "aksi",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                    width: "20%"
                }]
            });
        });
    </script>
@endpush
