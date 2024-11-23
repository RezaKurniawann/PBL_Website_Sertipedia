@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Mata Kuliah</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/matakuliah/import') }}')" class="btn btn-info"><i class="fa fa-file-import"></i> Import Mata Kuliah</button>
            <a href="{{ url('/matakuliah/create') }}" class="btn btn-primary">Tambah Data</a>
            <button onclick="modalAction('{{ url('/matakuliah/create_ajax') }}')" class="btn btn-success">Tambah (Ajax)</button>
        </div>
    </div>
    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-sm table-striped table-hover" id="table-matakuliah">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="75%"></div>

@endsection

@push('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function modalAction(url = '') {
        $('#myModal').load(url, function(){
            $('#myModal').modal('show');
        });
    }

    var tableMatakuliah;
    $(document).ready(function(){
        tableMatakuliah = $('#table-matakuliah').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('matakuliah/list') }}",
                dataType: "json",
                type: "POST", // Pastikan metode POST digunakan karena CSRF
                data: function (d) {
                    d.filter_nama = $('.filter_nama').val(); // Mengirimkan filter nama
                }
            },
            columns: [
                {
                    // Nomor urut dari Laravel DataTable addIndexColumn()
                    data: "DT_RowIndex",
                    // className: "text-center",
                    orderable: false,
                    searchable: false
                },
                { 
                    data: "nama", // Kolom Nama Mata Kuliah
                    width: "35%"
                },
                { 
                    data: "aksi", // Kolom Aksi untuk tombol
                    // className: "text-center",
                    width: "50%"
                }
            ],
            order: [[1, 'asc']], // Urutkan data berdasarkan ID Mata Kuliah
            pageLength: 10 // Batas data per halaman
        });

        // Ketika filter nama berubah, muat ulang data tabel
        $('.filter_nama').on('input', function(){
            tableMatakuliah.draw();
        });
    });
</script>
@endpush
