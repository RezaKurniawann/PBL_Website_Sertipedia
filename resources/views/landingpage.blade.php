<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SERTIPEDIA</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <link rel="stylesheet" href="{{ url ('css/styleLanding.css') }}">
</head>
<body>

   <!-- Header -->
<header class="header">
    <a href="{{ url('/') }}" class="logo"> <i class=""></i> SERTIPEDIA </a>
    <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>
        <a href="{{ url('/login') }}" class="btn">Login</a>
    </nav>
</header>
<!-- Header end -->

    <!-- Home Section -->
    <section class="home hero" id="home">
        <div class="swiper-container home-slider">
            {{-- <div class="swiper-wrapper">
                @foreach ($slides as $slide)
                    <img src="{{ url('storage/element/FOTO POLINEMA.jpg') }}" alt="Foto Polinema">
                @endforeach
            </div> --}}
            <div class="home-text">
                <h1>Sertifikasi dan Pelatihan</h1>
                <p>Aplikasi ini dirancang khusus untuk mengelola data sertifikasi dan pelatihan dosen 
                    di Jurusan Teknologi Informasi (JTI). Melalui sistem berbasis web ini, 
                    kami berkomitmen untuk memudahkan proses pendataan dan pemantauan kompetensi dosen, 
                    serta menyediakan informasi yang akurat dan terkini tentang kualifikasi dan pelatihan yang telah diikuti oleh dosen.</p>
            </div>
        </div>
    </section>
    <!-- Home section ends -->

    <!-- About Us -->
    <section class="about" id="about">
        <div class="row">
            <div class="content">
                <h3>Sistem Pendataan Sertifikasi dan Pelatihan</h3>
                <p>Sistem Pendataan Sertifikasi dan Pelatihan Dosen JTI 
                    adalah sebuah platform berbasis web yang dikembangkan untuk 
                    memudahkan pengelolaan data sertifikasi dan pelatihan dosen 
                    di Jurusan Teknologi Informasi (JTI). Kami berkomitmen untuk 
                    menyediakan solusi yang efektif dalam pendataan kompetensi dosen, 
                    dengan fokus pada peningkatan kualitas pengajaran dan profesionalisme 
                    dosen di lingkungan akademik. Platform ini dirancang untuk memenuhi 
                    kebutuhan dosen dalam mencatat, melacak, dan memetakan perkembangan 
                    kompetensi mereka. Dengan mengintegrasikan sistem pendataan sertifikasi 
                    dan pelatihan, kami mendukung dosen untuk terus meningkatkan 
                    keterampilan dan kualifikasi mereka, sesuai dengan standar pendidikan yang berlaku.
                </p>
            </div>
        </div>
    </section>
    <!-- About Us end -->

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="contact-container">
          <!-- Info Kontak -->
          <div class="contact-info">
            <div class="logos">
                <img src="{{ url('adminlte/dist/img/LOGO_BLU.png') }}" alt="Logo BLU">
                <img src="{{ url('adminlte/dist/img/LOGO_POLINEMA.png') }}" alt="Logo Polinema">
                <img src="{{ url('adminlte/dist/img/LOGO_JTI.png') }}" alt="Logo JTI">
            </div>
            <h3>BLU POLITEKNIK NEGERI MALANG<br>JTI POLINEMA</h3>
            <p>Jurusan Teknologi Informatika Politeknik Negeri Malang</p>
            <p>Jl. Soekarno-Hatta No. 9 Malang 65141</p>
            <p>Po.Box 04 Malang</p>
            <p>Telepon: +62 (0341) 404424 - 404425</p>
            <p>Faks: +62 (0341) 404420</p>
          </div>
          <!-- Ikon Media Sosial -->
          <div class="social-icons">
            <a href="#"><i class="fas fa-envelope"></i></a>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-x-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
      </section>
    <!-- Contact end -->

   {{-- Footer --}}

   <footer>
        <div class="footer-content">
            <p>Copyright &copy; 2024 Polinema. All rights reserved.</p>
        </div>
    </footer>

   {{-- Footer end --}}

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="{{ url('../resources/js/scripts.js') }}"></script>

    <!-- Script for Slider and Navbar -->
</body>
</html>
