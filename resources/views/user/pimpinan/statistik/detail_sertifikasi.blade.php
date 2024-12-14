@extends('layouts.template')

@section('content')
    <div id="myModal" class="modal fade animate bounceIn" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">{{ $page->title }}</h3>
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
            <table id="sertifikasi_table" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sertifikasi</th>
                        <th>Biaya</th>
                        <th>Jenis Sertifikasi</th>
                        <th>Tanggal Awal</th>
                        <th>Tanggal Akhir</th>
                        <th>Vendor</th>
                        <th>Periode</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#sertifikasi_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('statistik.detail_sertifikasi') }}', // Ganti dengan route yang sesuai
                columns: [{
                        data: 'id_sertifikasi',
                        name: 'id_sertifikasi'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'biaya',
                        name: 'biaya',
                        render: function(data) {
                        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data);
                    }
                    },
                    {
                        data: 'jenis_sertifikasi',
                        name: 'jenis_sertifikasi'
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
                        data: 'vendor',
                        name: 'vendor'
                    },
                    {
                        data: 'periode',
                        name: 'periode'
                    }
                ]
            });
        });
    </script>
@endpush
