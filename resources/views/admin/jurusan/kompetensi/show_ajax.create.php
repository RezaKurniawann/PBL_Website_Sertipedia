@empty($kompetensi)
    <div class="alert alert-danger">
        <h5><i class="icon fas fa-ban"></i> Kesalahan</h5>
        Data yang Anda cari tidak ditemukan.
    </div>
@else
    <table class="table table-bordered">
        <tr>
            <th>Nama Prodi</th>
            <td>{{ $kompetensi->nama_prodi }}</td>
        </tr>
        <tr>
            <th>Deskripsi</th>
            <td>{{ $kompetensi->deskripsi }}</td>
        </tr>
    </table>
@endempty
