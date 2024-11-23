@extends('layouts.template')
@section('content')
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ url('manage/pangkat/export_pdf') }}" class="btn btn-primary"><i class="fa fa-file-pdf"></i>Export Pangkat</a>
            <button onclick="modalAction('{{ url('manage/pangkat/create_ajax') }}')" class="btn btn-sm btn-success mt-1"><i class="fa fa-plus"></i>Tambah Ajax</button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }} </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_pangkat">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pangkat</th>
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
            var datapangkat = $('#table_pangkat').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('manage/pangkat/list') }}",
                    "dataType": "json",
                    "type": "POST"
                },
                columns: [
                    {
                        data: "DT_RowIndex",
                        className: "text-center",
                        width: "5%",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nama",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "aksi",
                        width: "20%",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
