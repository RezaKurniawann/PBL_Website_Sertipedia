@extends('layouts.template')

@section('content')
    <div id="myModal" class="modal fade animate bounceIn" tabindex="-1" role="dialog"
        data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">{{ $page->title }}</h3>
            <div class="card-tools">
                <a href="{{ url('manage/event/sertifikasi/export_excel') }}" class="btn btn-sm btn-success mt-1 ">
                    <i class="fa fa-file-excel"></i> Export Excel
                </a>
                <a href="{{ url('manage/event/sertifikasi/export_pdf') }}" class="btn btn-sm btn-danger mt-1 ">
                    <i class="fa fa-file-pdf"></i> Export PDF
                </a>
                <button onclick="modalAction('{{ url('manage/event/sertifikasi/create_ajax') }}')"
                    class="btn btn-sm btn-primary mt-1 ">
                    <i class="fa fa-plus"></i> Tambah Data
                </button>
            </div>
        </div>
        <div class="card-body bg-light">
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
            <table class="table table-bordered table-striped table-hover table-sm" id="table_sertifikasi">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Vendor</th>
                        <th>Biaya</th>
                        <th>Jenis Sertifikasi</th>
                        <th>Tanggal Awal</th>
                        <th>Tanggal Akhir</th>
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

    .custom-gradient-header {
        background-image: linear-gradient(to right bottom, #0d6efd, #4e7bfd, #6d88fc, #8696fc, #9ba4fb);
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
            $('#table_sertifikasi').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('manage/event/sertifikasi/list') }}",
                    dataType: "json",
                    type: "POST"
                },
                columns: [
                    { 
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: "nama",
                        className: "",
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: "vendor.nama",
                        className: "",
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: "biaya",
                        className: "",
                        orderable: true,
                        searchable: false,
                        render: function(data) {
                            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data);
                        }
                    },
                    {
                        data: "jenis_sertifikasi",
                        className: "",
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: "tanggal_awal",
                        className: "",
                        orderable: true,
                        searchable: true,
                        render: function(data) {
                            return new Date(data).toLocaleDateString('id-ID');
                        }
                    },
                    {
                        data: "tanggal_akhir",
                        className: "",
                        orderable: true,
                        searchable: true,
                        render: function(data) {
                            return new Date(data).toLocaleDateString('id-ID');
                        }
                    },
                    {
                        data: "periode.tahun",
                        className: "",
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: "aksi",
                        className: "text-center",
                        width: "15%",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
