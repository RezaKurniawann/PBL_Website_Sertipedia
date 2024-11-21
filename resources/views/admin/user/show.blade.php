@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            if (!$user) {
                return redirect('user')->with('error', 'Data tidak ditemukan');
            }            
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID User</th>
                        <td>{{ $user->id_user }}</td>
                    </tr>
                    <tr>
                        <th>ID Level</th>
                        <td>{{ $user->id_level }}</td>
                    </tr>
                    <tr>
                        <th>ID Prodi</th>
                        <td>{{ $user->id_prodi }}</td>
                    </tr>
                    <tr>
                        <th>ID Pangkat</th>
                        <td>{{ $user->id_pangkat }}</td>
                    </tr>
                    <tr>
                        <th>ID Golongan</th>
                        <td>{{ $user->id_golongan }}</td>
                    </tr>
                    <tr>
                        <th>ID Jabatan</th>
                        <td>{{ $user->id_jabatan }}</td>
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
                        <td>
                            @if($user->image)
                                <img src="{{ asset($user->image) }}" alt="User Image" class="img-thumbnail" width="100">
                            @else
                                <span>Tidak ada gambar</span>
                            @endif
                        </td>
                    </tr>
                </table>
            <a href="{{ url('user') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush