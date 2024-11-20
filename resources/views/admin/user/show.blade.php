@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($user)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID Level</th>
                        <td>{{ $user->id_level }}</td>
                    </tr>
                    <tr>
                        <th>ID Prodi</th>
                        <td>{{ $user->id_prodi }}</td>
                    </tr>
                    <tr>
                        <th>Nama user</th>
                        <td>{{ $user->nama }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                    <th>Nomor Telepon</th>
                        <td>{{ $user->no_telp }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td>{{ $user->password }}</td>
                    </tr>
                    <tr>
                        <th>Level Image</th>
                        <td>{{ $user->image }}</td>
                    </tr>
                </table>
            @endempty
            <a href="{{ url('user') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush