@extends('layouts.template')
@section('content')
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('manage/jurusan/bidangminat/import') }}')"
                    class="btn btn-sm btn-info mt-1 ">
                    <i class="fa fa-upload"></i> Import bidangminat
                </button>
                <a href="{{ url('manage/jurusan/bidangminat/export_excel') }}" class="btn btn-sm btn-success mt-1 ">
                    <i class="fa fa-file-excel"></i> Export Excel
                </a>
                <a href="{{ url('manage/jurusan/bidangminat/export_pdf') }}" class="btn btn-sm btn-danger mt-1 ">
                    <i class="fa fa-file-pdf"></i> Export PDF
                </a>
                <button onclick="modalAction('{{ url('manage/jurusan/bidangminat/create_ajax') }}')"
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
            <table class="table table-bordered table-striped table-hover table-sm w-auto" id="table_bidangminat">
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

    .table {
        table-layout: auto; /* Kolom akan menyesuaikan isi */
        width: 100%; /* Pastikan tabel tetap menggunakan seluruh ruang */
        border-spacing: 0px; /* Hilangkan spasi antar sel tabel */
        border-collapse: separate;
    }

    .table th,
    .table td {
        white-space: nowrap; /* Mencegah teks terpotong ke baris baru */
        text-align: center; /* Menjaga teks tetap rata tengah */
        vertical-align: middle; /* Vertikal rata tengah */
        padding-left: 50px; /* Jarak ke kiri */
        padding-right: 50px; /* Jarak ke kanan */
        padding-top: 5; /* Hilangkan jarak atas */
        padding-bottom: 5; /* Hilangkan jarak bawah */
    }

    .table th {
        font-weight: bold;
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
            var databidangminat = $('#table_bidangminat').DataTable({
                serverSide: true,
                autoWidth: true, // Mengaktifkan lebar kolom otomatis
                ajax: {
                    "url": "{{ url('manage/jurusan/bidangminat/list') }}",
                    "dataType": "json",
                    "type": "POST"
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "nama",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });
        });
    </script>
@endpush
