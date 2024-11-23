@extends('layouts.template')
@section('content')
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a href="{{ url('manage/user/export_pdf') }}" class="btn btn-primary"><i class="fa fa-file-pdf"></i>Export level</a> 
                <button onclick="modalAction('{{ url('manage/user/create_ajax') }}')" class="btn btn-sm btn-success mt-1"><i class="fa fa-plus"></i>Tambah User</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }} </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="from-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="id_level" name="id_level" required>
                                <option value="">- Semua -</option>
                                @foreach ($level as $item)
                                    <option value="{{ $item->id_level }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Level Pengguna</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Nama Level</th>
                        <th>Nama Prodi</th>
                        <th>Nama Pangkat</th>
                        <th>Nama Golongan</th>
                        <th>Nama Jabatan</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
    <!-- Tambahkan custom CSS di sini jika diperlukan -->
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        $(document).ready(function() {
            var dataUser = $('#table_user').DataTable({
                // Mengaktifkan server-side processing 
                serverSide: true,
                ajax: {
                    "url": "{{ url('manage/user/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.id_level = $('#id_level').val();
                    }
                },
                columns: [{
                        // Nomor urut dari Laravel DataTable addIndexColumn()
                        data: "DT_RowIndex",
                        className: "text-center",
                        width:"5%",
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
                        data: "level.nama",
                        className: "",
                        searchable: true
                    },
                    {
                        data: "prodi.nama",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "pangkat.nama",
                        className: "",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "golongan.nama",
                        className: "",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "jabatan.nama",
                        className: "",
                        orderable: false,
                        searchable: false
                    },
                    
                    {
                        data: "email",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "no_telp",
                        className: "",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "username",
                        className: "",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "aksi",
                        className: "",
                        width:"15%",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#id_level').on('change', function() {
                dataUser.ajax.reload();
            });

        });
    </script>
@endpush