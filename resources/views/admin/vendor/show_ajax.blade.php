@empty($vendor) 
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
                <a href="{{ url('manage/vendor/') }}" class="btn btn-warning">Kembali</a> 
            </div> 
        </div> 
    </div> 
@else 
    <div id="modal-master" class="modal-dialog modal-lg" role="document"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Vendor</h5> 
                <button type="button" class="close" data-dismiss="modal" 
                aria-label="Close"><span aria-hidden="true">&times;</span></button> 
            </div> 
            <div class="modal-body"> 
                <div class="alert alert-info"> 
                    <h5><i class="icon fas fa-info-circle"></i> Informasi !!!</h5> 
                    Berikut adalah detail data Vendor:
                </div> 
                <table class="table table-sm table-bordered table-striped"> 
                    <tr><th class="text-right col-3">Nama :</th><td class="col-9">{{ $vendor->nama }}</td></tr>
                    <tr><th class="text-right col-3">Alamat :</th><td class="col-9">{{ $vendor->alamat}}</td></tr>
                    <tr><th class="text-right col-3">Kota :</th><td class="col-9">{{ $vendor->kota}}</td></tr>
                    <tr><th class="text-right col-3">Nomor Telepon :</th><td class="col-9">{{ $vendor->telepon }}</td></tr>
                    <tr><th class="text-right col-3">Alamat Website :</th><td class="col-9">{{ $vendor->alamatWeb }}</td></tr>
                    <tr><th class="text-right col-3">Kategori :</th><td class="col-9">{{ $vendor->kategori}}</td></tr>
                </table> 
            </div> 
            <div class="modal-footer"> 
                <button type="button" data-dismiss="modal" class="btn btn-primary">Tutup</button> 
            </div> 
        </div> 
    </div> 
@endempty