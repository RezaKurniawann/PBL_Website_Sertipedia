@extends ('layouts.template' )

@section('content')

<style>
    .col-lg-custom {
      flex: 0 0 20%; 
      max-width: 20%;
    }
    .parallax-image {
        display: block;
        width: 60%;
        margin: 0 auto; /* Menambahkan margin otomatis untuk kiri dan kanan */
    }
</style>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Halo, Selamat Datang!</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <div class="row">
            @if (Auth::user()->level->level_nama == 'Administrator')
            <!-- Card Jumlah Level -->
            <div class="col-lg-custom col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $levelCount }}</h3>
                        <p>Jumlah Level</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <a href="level" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Card Jumlah User -->
            <div class="col-lg-custom col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $userCount }}</h3>
                        <p>Jumlah User</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="/user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        
            <!-- Card Jumlah Supplier -->
            <div class="col-lg-custom col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $supplierCount }}</h3>
                        <p>Jumlah Supplier</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <a href="/supplier" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        
            <!-- Card Jumlah Kategori -->
            <div class="col-lg-custom col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $kategoriCount }}</h3>
                        <p>Jumlah Kategori</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <a href="/kategori" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        
            <!-- Card Jumlah Barang -->
            <div class="col-lg-custom col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $barangCount }}</h3>
                        <p>Jumlah Barang</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-cubes"></i>
                    </div>
                    <a href="/barang" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            @endif

            @if (Auth::user()->level->level_nama == 'Manager')
            <!-- Card Jumlah Supplier -->
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $supplierCount }}</h3>
                        <p>Jumlah Supplier</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <a href="/supplier" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        
            <!-- Card Jumlah Kategori -->
            <div class="col-lg-4 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $kategoriCount }}</h3>
                        <p>Jumlah Kategori</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <a href="/kategori" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        
            <!-- Card Jumlah Barang -->
            <div class="col-lg-4 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $barangCount }}</h3>
                        <p>Jumlah Barang</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-cubes"></i>
                    </div>
                    <a href="/barang" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            @endif

            @if (Auth::user()->level->level_nama == 'Staff')
            
            <!-- Card Jumlah Kategori -->
            <div class="col-lg-6 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $kategoriCount }}</h3>
                        <p>Jumlah Kategori</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <a href="/kategori" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        
            <!-- Card Jumlah Barang -->
            <div class="col-lg-6 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $barangCount }}</h3>
                        <p>Jumlah Barang</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-cubes"></i>
                    </div>
                    <a href="/barang" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            @endif
             
        </div>
    </div>
    
</div>

@endsection
