@extends('layouts.template')
@section('content')
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/user/create_ajax') }}')" class="btn btn-sm btn-success mt-1"><i class="fa fa-plus"></i>Tambah User</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            {{-- tidak menggunakan filter untuk users --}}
            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="users_id" name="users_id" required>
                                <option value="">- Semua -</option>
                                @foreach ($users as $item)
                                    <option value="{{ $item->users_id }}">{{ $item->users_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">users Pengguna</small>
                        </div>
                    </div>
                </div>
            </div> --}}
            <table class="table table-bordered table-striped table-hover table-sm" id="user">
                <thead>
                    <tr>
                        <th>ID Level</th>
                        <th>ID Prodi</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Image</th>
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
            var datausers = $('user').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('user/list') }}",
                    "dataType": "json",
                    "type": "POST"
                    // tidak perlu data dibawah karena tidak ada filter
                    // "data": function (d) {
                    //     d.users_id = $('#users_id').val();
                    // }
                },
                columns: [{
                    // nomor urut dari laravel datatable addIndexColumn()
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "id_level",
                    className: "",
                    // orderable: true, jika ingin kolom ini bisa diurutkan
                    orderable: true,
                    // searchable: true, jika ingin kolom ini bisa dicari
                    searchable: true
                }, {
                    data: "id_prodi",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "nama",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "email",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "no_telp",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "username",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "password",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "image",
                    className: "",
                    orderable: false,
                    searchable: false
                }{
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });
            // $('#users_id').on('change',function(){
            //     datausers.ajax.reload();
            // });
        });
    </script>
@endpush