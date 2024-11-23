@empty($sertifikasi) 
    <div id="modal-master" class="modal-dialog modal-lg" role="document"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5> 
                <button type="button" class="close" data-dismiss="modal" 
                aria-label="Close"><span aria-hidden="true">&times;</span></button> 
            </div> 
            <div class="modal-body"> 
                <div class="alert alert-danger"> 
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5> 
                    Data yang anda cari tidak ditemukan
                </div> 
                <a href="{{ url('manage/event/sertifikasi') }}" class="btn btn-warning">Kembali</a> 
            </div> 
        </div> 
    </div> 
@else 
    <div id="modal-master" class="modal-dialog modal-lg" role="document"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Sertifikasi</h5> 
                <button type="button" class="close" data-dismiss="modal" 
                aria-label="Close"><span aria-hidden="true">&times;</span></button> 
            </div> 
            <div class="modal-body"> 
                <div class="alert alert-info"> 
                    <h5><i class="icon fas fa-info-circle"></i> Informasi !!!</h5> 
                    Berikut adalah detail data Sertifikasi:
                </div> 
                <table class="table table-sm table-bordered table-striped"> 
                    <tr><th class="text-right col-3">Nama Sertifikasi :</th><td class="col-9">{{ $sertifikasi->nama }}</td></tr>
                    <tr><th class="text-right col-3">Vendor : </th><td class="col-9">{{ $sertifikasi->vendor->nama }}</td></tr>
                    <tr><th class="text-right col-3">Biaya : </th><td class="col-9">Rp {{ number_format($sertifikasi->biaya, 2, ',', '.') }}</td></tr>
                    <tr><th class="text-right col-3">Jenis Sertifikasi : </th><td class="col-9">{{ $sertifikasi->jenis_sertifikasi }}</td></tr>
                    <tr><th class="text-right col-3">Tanggal Awal : </th><td class="col-9">{{ \Carbon\Carbon::parse($sertifikasi->tanggal_awal)->format('d/m/Y') }}</td></tr>
                    <tr><th class="text-right col-3">Tanggal Akhir : </th><td class="col-9">{{ \Carbon\Carbon::parse($sertifikasi->tanggal_akhir)->format('d/m/Y') }}</td></tr>
                    <tr><th class="text-right col-3">Periode : </th><td class="col-9">{{ $sertifikasi->periode->tahun }}</td></tr>
                </table> 
            </div> 
            <div class="modal-footer"> 
                <button type="button" data-dismiss="modal" class="btn btn-primary">Tutup</button> 
            </div> 
        </div> 
    </div> 
@endempty
