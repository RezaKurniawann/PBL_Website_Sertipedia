@extends('layouts.template')
@section('content')
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_sertifikasi">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sertifikasi</th>
                        <th>Vendor</th>
                        <th>Jenis Sertifikasi</th>
                        <th>Periode</th>
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
    var datagolongan = $('#table_sertifikasi').DataTable({
        serverSide: true,
        ajax: {
            url: "{{ url('manage/rekomendasi/sertifikasi/list') }}",
            dataType: "json",
            type: "POST"
        },
        columns: [
            {
                data: "DT_RowIndex",
                className: "text-center",
                orderable: false,
                searchable: false
            },
            {
                data: "nama",
                className: "",
                orderable: true,
                searchable: true
            },
            {
                data: "vendor.nama",
                className: "",
                orderable: true,
                searchable: true
            },
            {
                data: "jenis_sertifikasi",
                className: "",
                orderable: true,
                searchable: true
            },
            {
                data: "periode.tahun",
                className: "",
                orderable: true,
                searchable: true
            },
            {
                data: "aksi",
                className: "text-center",
                orderable: false,
                searchable: false
            }
        ]
    });
});
    </script>
@endpush
