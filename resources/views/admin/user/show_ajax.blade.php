@empty($user)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('manage/user/') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info-circle"></i> Informasi !!!</h5>
                    Berikut adalah detail data user:
                </div>
                <table class="table table-sm table-bordered table-striped">
                    <tr>
                        <th class="text-right col-3">Nama :</th>
                        <td class="col-9">{{ $user->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Level :</th>
                        <td class="col-9">{{ $user->level->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Prodi :</th>
                        <td class="col-9">{{ $user->prodi->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Pangkat :</th>
                        <td class="col-9">{{ $user->pangkat->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Golongan :</th>
                        <td class="col-9">{{ $user->golongan->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Jabatan :</th>
                        <td class="col-9">{{ $user->jabatan->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Email :</th>
                        <td class="col-9">{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Nomor Telepon :</th>
                        <td class="col-9">{{ $user->no_telp }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Username :</th>
                        <td class="col-9">{{ $user->username }}</td>
                    </tr>
                </table>
                <div class="mt-4">
                    <h4 class="font-weight-bold">Mata Kuliah</h4>
                    <div class="row">
                        @foreach ($matakuliah as $mk)
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $mk->nama }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4">
                    <h4 class="font-weight-bold">Bidang Minat</h4>
                    <div class="row">
                        @foreach ($bidangminat as $bm)
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $bm->nama }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary">Tutup</button>
            </div>
        </div>
    </div>
@endempty
