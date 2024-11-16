{{-- //caca --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery Website</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <link rel="stylesheet" href="{{ url ('css/styleLanding.css') }}">
</head>
<body>
    
    <!-- Header -->
   <!-- Header -->
<header class="header">
    <a href="{{ url('/') }}" class="logo"> <i class="fas fa-bread-slice"></i> Awan Bakery </a>
    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#about">about</a>
        <a href="#gallery">gallery</a>
        <a href="#team">team</a>
        <a href="{{ url('/login') }}" class="btn">Login</a>
        <div id="menu-btn" class="fas fa-bars"></div>
    </nav>
</header>
<!-- Header end -->

    <!-- Home Section -->
    <section class="home" id="home">
        <div class="swiper-container home-slider">
            <div class="swiper-wrapper">
                @foreach ($slides as $slide)
                    <div class="swiper-slide slide" style="background: url('{{ url('storage/element/' . $slide->image) }}') no-repeat;"></div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Home section ends -->

    <!-- About Us -->
    <section class="about" id="about">
        <h1 class="heading"> <span>about</span> us </h1>
        <div class="row">
            <div class="image">
                <img src="{{ url('storage/element/about.png') }}" alt="">
            </div>
            <div class="content">
                <h3>good things come to those <span>who bake </span> for others</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit...</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                <a href="#" class="btn">read more</a>
            </div>
        </div>
    </section>
    <!-- About Us end -->

    <!-- Gallery Section -->
    <section class="gallery" id="gallery">
        <h1 class="heading">our <span> gallery</span></h1>
        <div class="gallery-container">
            @foreach ($galleryImages as $image)
                <a href="{{ url('storage/element/' . $image) }}" class="box">
                    <img src="{{ url('storage/element/' . $image) }}" alt="">
                    <div class="icons"><i class="fas fa-plus"></i></div>
                </a>
            @endforeach
        </div>
    </section>
    <!-- Gallery end -->

    <!-- Team Section -->
    <section class="team" id="team">
        <h1 class="heading">our <span>team</span></h1>
        <div class="box-container">
            @foreach ($teamMembers as $member)
                <div class="box">
                    <div class="image">
                        <img src="{{ url('storage/element/' . $member->image) }}" alt="">
                    </div>
                    <div class="content">
                        <h3>{{ $member->name }}</h3>
                        <p>{{ $member->position }}</p>
                        <div class="share">
                            <i class="fab fa-facebook-f"></i>
                            <i class="fab fa-twitter"></i>
                            <i class="fab fa-instagram"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- Team Section end -->

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="{{ url('../resources/js/scripts.js') }}"></script>

    <!-- Script for Slider and Navbar -->
</body>
</html>
