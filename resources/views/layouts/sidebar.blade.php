<div class="sidebar">
    <style>
        .form-control-sidebar {
            background-color: #0D6EFD !important; /* Warna biru */
            color: #ffffff !important; /* Teks putih agar kontras */
            border: none; /* Menghapus border (opsional) */
        }

        .btn-sidebar i {
            color: #ffffff !important; /* Ikon pencarian menjadi putih */
        }
        
        .sidebar {
            background-color: #D9D9D9; /* Background color light gray */
            height: 150vh; /* Sidebar height */
        }

        .nav-link {
            color: #000 !important; /* Set text color to black */
        }

        .nav-link:hover {
            background-color: white !important; 
            color: #000 !important; /* Set text color to black */
        }

        .nav-link.active {
            background-color: white !important;
            color: #000 !important; /* Keep text color black */
            border-left: 4px solid #000; /* Optional: To highlight the active menu */
        }

        .form-control-sidebar {
            background-color: white !important; 
            color: #000 !important; /* Set text color to black */
        }

        .btn-sidebar i {
            color: #000 !important; /* Set button icon color to black */
        }

        .dropdown-menu {
        background-color: rgb(66, 66, 66); /* Warna latar dropdown (abu-abu gelap) */
        }

        .dropdown-menu .dropdown-item {
            color: #fff; /* Warna teks tetap putih */
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #0D6EFD; /* Warna biru kontras untuk hover */
            color: #fff; /* Warna teks tetap putih agar terlihat jelas */
        }
        
    </style>

    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" id="sidebarSearch" type="search" placeholder="Search" aria-label="Search" onkeyup="filterMenu()">
            <div class="input-group-append">
                <button class="btn btn-sidebar" type="button">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" id="sidebarMenu">
            <li class="nav-item">
                <a href="{{ url('/user/home') }}" class="nav-link {{ $activeMenu == 'home' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Home</p>
                </a>
            </li>


            @if (Auth::user()->level->nama == 'Admin')
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ $activeMenu == 'manage-user' ? 'active' : '' }}" data-toggle="dropdown">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Data User</p>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ url('/manage/user') }}" class="dropdown-item">
                        <i class="nav-icon fas fa-user"></i> User
                    </a>
                    <a href="{{ url('/manage/level') }}" class="dropdown-item">
                        <i class="nav-icon fas fa-layer-group"></i> Level User
                    </a>
                    <a href="{{ url('/manage/pangkat') }}" class="dropdown-item">
                        <i class="nav-icon fas fa-medal"></i> Pangkat User
                    </a>
                    <a href="{{ url('/manage/golongan') }}" class="dropdown-item">
                        <i class="nav-icon fas fa-sitemap"></i> Golongan User
                    </a>
                    <a href="{{ url('/manage/jabatan') }}" class="dropdown-item">
                        <i class="nav-icon fas fa-briefcase"></i> Jabatan User
                    </a>
                </div>
            </li>            
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ $activeMenu == 'manage-event' ? 'active' : '' }}" data-toggle="dropdown">
                    <i class="nav-icon fas fa-calendar-day"></i>
                    <p>Data Event</p>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ url('/manage/event/sertifikasi') }}" class="dropdown-item">
                        <i class="fas fa-certificate"></i> Sertifikasi
                    </a>
                    <a href="{{ url('/manage/event/pelatihan') }}" class="dropdown-item">
                        <i class="fas fa-chalkboard-teacher"></i> Pelatihan
                    </a>
                </div>
            </li>
            {{-- <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ $activeMenu == 'manage-detailevent' ? 'active' : '' }}" data-toggle="dropdown">
                    <i class="nav-icon fas fa-calendar-alt"></i> <!-- Changed to 'fa-calendar-alt' for a slightly different event-related icon -->
                    <p>Data Detail Event</p>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ url('/manage/detailevent/sertifikasi') }}" class="dropdown-item">
                        <i class="fas fa-certificate"></i> Sertifikasi
                    </a>
                    <a href="{{ url('/manage/detailevent/pelatihan') }}" class="dropdown-item">
                        <i class="fas fa-chalkboard-teacher"></i> Pelatihan
                    </a>
                </div>
            </li>  --}}
            <li class="nav-item">
                <a href="{{ url('/manage/vendor') }}" class="nav-link {{ $activeMenu == 'manage-vendor' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-truck"></i> <!-- Changed to 'fa-truck' for vendor-related icon -->
                    <p>Data Vendor</p>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ $activeMenu == 'manage-jurusan' ? 'active' : '' }}" data-toggle="dropdown">
                    <i class="nav-icon fas fa-school"></i> <!-- Changed to 'fa-school' for education-related icon -->
                    <p>Data Jurusan</p>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ url('/manage/jurusan/matakuliah') }}" class="dropdown-item">
                        <i class="fas fa-book"></i> Mata Kuliah <!-- Changed to 'fa-book' for subject-related icon -->
                    </a>
                    <a href="{{ url('/manage/jurusan/bidangminat') }}" class="dropdown-item">
                        <i class="fas fa-cogs"></i> Bidang Minat <!-- Changed to 'fa-cogs' for fields of interest -->
                    </a>
                    <a href="{{ url('/manage/jurusan/kompetensi') }}" class="dropdown-item">
                        <i class="fas fa-tasks"></i> Kompetensi <!-- Changed to 'fa-tasks' for competencies -->
                    </a>
                </div>
            </li>  
            <li class="nav-item">
                <a href="{{ url('/manage/periode') }}" class="nav-link {{ $activeMenu == 'manage-periode' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-clock"></i>
                    <p>Data Periode</p>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ $activeMenu == 'rekomendasi' ? 'active' : '' }}" data-toggle="dropdown">
                    <i class="nav-icon fas fa-thumbs-up"></i>
                    <p>Rekomendasi</p>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ url('/manage/rekomendasi/sertifikasi') }}" class="dropdown-item">
                        <i class="fas fa-certificate"></i> Sertifikasi
                    </a>
                    <a href="{{ url('/manage/rekomendasi/pelatihan') }}" class="dropdown-item">
                        <i class="fas fa-chalkboard-teacher"></i> Pelatihan
                    </a>
                </div>
            </li> 
           
            <li class="nav-item">
                <a href="{{ url('/statistik') }}" class="nav-link {{ $activeMenu == 'statistik' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-chart-bar"></i>
                    <p>Statistik</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/manage/surat') }}" class="nav-link {{ $activeMenu == 'manage-surat' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-envelope"></i>
                    <p>Notifikasi</p>
                </a>
            </li>           
            @elseif (Auth::user()->level->nama == 'Pimpinan')
                {{-- <li class="nav-header">Header</li> --}}
                <li class="nav-item">
                    <a href="{{ url('/profile') }}" class="nav-link {{ $activeMenu == 'profile' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('pimpinan/statistik') }}" class="nav-link {{ $activeMenu == 'statistik' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>Statistik</p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ $activeMenu == 'verifikasi' ? 'active' : '' }}" data-toggle="dropdown">
                        <i class="nav-icon far fa-check-circle"></i>
                        <p>Verifikasi Peserta</p>
                    </a>
                    <div class="dropdown-menu">
                        <a href="{{ url('pimpinan/verifikasi/sertifikasi') }}" class="dropdown-item ">
                            <i class="fas fa-certificate"></i> Sertifikasi
                        </a>
                        <a href="{{ url('pimpinan/verifikasi/pelatihan') }}" class="dropdown-item">
                            <i class="fas fa-chalkboard-teacher"></i> Pelatihan
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ url('pimpinan/kompetensi') }}" class="nav-link {{ $activeMenu == 'kompetensi' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-school"></i>
                        <p>Kompetensi Prodi</p>
                    </a>
                </li>                
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ $activeMenu == 'inputdata' ? 'active' : '' }}" data-toggle="dropdown">
                        <i class="nav-icon fas fa-award"></i>
                        <p>Input Data</p>
                    </a>
                    <div class="dropdown-menu">
                        <a href="{{ url('inputdata/sertifikasi') }}" class="dropdown-item ">
                            <i class="fas fa-certificate"></i> Sertifikasi
                        </a>
                        <a href="{{ url('inputdata/pelatihan') }}" class="dropdown-item">
                            <i class="fas fa-chalkboard-teacher"></i> Pelatihan
                        </a>
                    </div>
                </li>  
                <li class="nav-item">
                    <a href="{{ url('/notifikasi') }}" class="nav-link {{ $activeMenu == 'notifikasi' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Notifikasi</p>
                    </a>
                </li>
            @elseif (Auth::user()->level->nama == 'Dosen') 
            <li class="nav-item">
                <a href="{{ url('/profile') }}" class="nav-link {{ $activeMenu == 'profile' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Profile</p>
                </a>
            </li>       
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ $activeMenu == 'inputdata' ? 'active' : '' }}" data-toggle="dropdown">
                    <i class="nav-icon fas fa-award"></i>
                    <p>Input Data</p>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ url('inputdata/sertifikasi') }}" class="dropdown-item ">
                        <i class="fas fa-certificate"></i> Sertifikasi
                    </a>
                    <a href="{{ url('inputdata/pelatihan') }}" class="dropdown-item">
                        <i class="fas fa-chalkboard-teacher"></i> Pelatihan
                    </a>
                </div>
            </li>  
            <li class="nav-item">
                <a href="{{ url('/notifikasi') }}" class="nav-link {{ $activeMenu == 'notifikasi' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-bell"></i>
                    <p>Notifikasi</p>
                </a>
            </li>
            @endif

            {{-- <li class="nav-item">
                <a href="{{ url('/logout') }}" class="nav-link {{ $activeMenu == 'logout' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
            </li> --}}
            {{-- logout --}}
            <form id="logout-form" action="{{ url('/logout') }}" method="GET" style="display: none;">
                @csrf
            </form>  
            <li class="nav-item">
                <a href="javascript:void(0);" onclick="confirmLogout()" class="nav-link {{ $activeMenu == 'logout' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
            </li>         
        </ul>
    </nav>
</div>

<script>
    // Fungsi untuk memfilter item menu sidebar berdasarkan input pencarian
    function filterMenu() {
        const input = document.getElementById('sidebarSearch');
        const filter = input.value.toLowerCase(); 
        const ul = document.getElementById("sidebarMenu"); 
        const li = ul.getElementsByTagName('li'); 

      
        for (let i = 0; i < li.length; i++) {
            const a = li[i].getElementsByTagName("a")[0]; // Mengambil tag anchor di dalam item list
            if (a) {
                const txtValue = a.textContent || a.innerText; // Mengambil teks dari tag anchor
            
                li[i].style.display = txtValue.toLowerCase().indexOf(filter) > -1 ? "" : "none";
            }
        }
    }

    //fungsi popup logout
    function confirmLogout() {
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: "Apakah Anda yakin ingin keluar?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>

