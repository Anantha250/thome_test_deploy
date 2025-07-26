@extends('layouts.layout_home')
@section('title', 'T. Home Construction')

@section('content')
    <link rel="stylesheet" href="/css/home/service/review_home.css">
    <link rel="stylesheet" href="/css/home/service/Hinterior.css">

    <section class="hero-section">
        <div id="carouselExampleIndicators" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="30000">
            <div class="carousel-indicators">
                <button type="buttxon" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner h-100">
                <div class="carousel-item active h-100">
                    <img src="/img/ปกPSD.png"
                        class="hero-bg" alt="...">
                    <div class="hero-content">
                        <div class="logo-container">
                            <img src="/img/s2.png" alt="T. HOME CONSTRUCTION Logo" class="hero-logo">
                        </div>
                        <h1 class="hero-title">{{ __('hinterior.hero-title') }}</h1>
                        <div class="hero-description">{{ __('hinterior.hero-description') }}</div>
                        <a href="/contactus" class="hero-btn">{{ __('hinterior.contact-btn') }}</a>
                    </div>
                </div>
                <div class="carousel-item h-100 p-0">
                    <img src="/img/after_review/interrior-bg1.jpg"
                        class="hero-bg" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- <img src="https://img.freepik.com/free-photo/people-renovating-house-concept_53876-20664.jpg" alt="" class="hero-bg"> -->
        <!-- <div class="hero-content">
                            <div class="logo-container">
                                <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/s3-3bLs5HKnwRUrK4px4T8zPO4uMNVUmo.png" alt="T. HOME CONSTRUCTION Logo" class="hero-logo">
                            </div>
                            <h1 class="hero-title">บริการต่อเติมบ้านคุณภาพ</h1>
                            <div class="hero-description">ต.ต่อเติม มุ่งมั่นที่จะมอบบริการต่อเติมบ้านที่มีคุณภาพสูงสุด ด้วยทีมงานมืออาชีพและประสบการณ์มากกว่า 10 ปี</div>
                            <a href="/Contactus.php" class="hero-btn">ติดต่อเรา</a>
                        </div> -->
    </section>



    <div class="review-page aos-init aos-animate" data-aos="fade-up">
        <h1>{{ __('hinterior.choose-style-title') }}</h1>
        <br>
        <div class="categories aos-init aos-animate" data-aos="fade-up" data-aos-duration="1500">
            <button class="category-btn active" data-category="all">All</button>
            @foreach ($tags as $tag)
                <button class="category-btn" data-category="{{ $tag->translation['title'] }}">{{ $tag->translation['title'] }}</button>
            @endforeach
            {{-- <button class="category-btn" data-category="Modern">Modern</button>
            <button class="category-btn" data-category="Modern Luxury">Modern Luxury</button>
            <button class="category-btn" data-category="Modern Classic">Modern Classic</button> --}}
        </div>
        <div class="review-cards">
            @foreach ($projects as $project)
                <a class="card" data-category="{{ $project->tag->translation['title'] }}" href="/hinterior/project/{{ $project->id }}">
                    <img src="{{ $project->coverPageImg }}">
                    <p>{{ $project->translation['title'] }}</p>
                </a>
            @endforeach
            {{-- <a class="card" data-category="Modern" href="https://thomeinspector1.netlify.app/after_review_interior2">
                <img src="/img/after_review/interrior-bg2.jpg" alt="House Review 1">
                <p>Nantawan Pinklao</p>
            </a>
            <a class="card" data-category="Modern" href="https://thomeinspector1.netlify.app/after_review_interior3">
                <img src="/img/after_review/interrior-bg3.jpg" alt="House Review 2">
                <p>Veritz Sathupradit34</p>
            </a>
            <a class="card" data-category="Modern Luxury"
                href="https://thomeinspector1.netlify.app/after_review_interior4">
                <img src="/img/after_review/interrior-bg4.jpg" alt="House Review 3">
                <p>CHAIYAPRUEK Bangna km 15</p>
            </a>
            <a class="card" data-category="Modern Luxury"
                href="https://thomeinspector1.netlify.app/after_review_interior5">
                <img src="/img/after_review/interrior-bg5.jpg" alt="House Review 5">
                <p>Grand Bangkok boulevard Krungthepkreetra</p>
            </a>
            <a class="card" data-category="Modern Luxury"
                href="https://thomeinspector1.netlify.app/after_review_interior6">
                <img src="/img/after_review/interrior-bg6.jpg" alt="House Review 6">
                <p>S'RIN Ratchapruek-Sai1</p>
            </a>
            <a class="card" data-category="Modern Classic"
                href="https://thomeinspector1.netlify.app/after_review_interior7">
                <img src="/img/after_review/interrior-bg7.jpg" alt="House Review 7">
                <p>MANTANA Barom-thaweewattana</p>
            </a>
            <a class="card" data-category="Modern Classic"
                href="https://thomeinspector1.netlify.app/after_review_interior8">
                <img src="/img/after_review/interrior-bg8.jpg" alt="House Review 8">
                <p>Prinn Sathorn-ratchapruek</p>
            </a>
            <a class="card" data-category="Modern Classic"
                href="https://thomeinspector1.netlify.app/after_review_interior9">
                <img src="/img/after_review/interrior-bg9.jpg" alt="House Review 9">
                <p>THE CITY Pinklao-sirinthorn</p>
            </a> --}}
        </div>
    </div>
    <div class="video-carousel aos-init" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <button class="prev" onclick="moveSlide(-1)">❮</button>
        <div class="video-wrapper" id="videoSlider">
            <div class="video-item">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/M-nLhplc-mc?si=cXWxjwDwR4Tk84WZ"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="video-item">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/JV3YbNgw_Uw?si=T--TiY3b7p2_3fFq"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="video-item">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/m_lOwlSrFng?si=akO-BDY7yZnghdR5"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="video-item">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/XiE60iwh4B8?si=2nUsa6ov1Us4sGQQ"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="video-item">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/V5cP06m2dqM?si=kIWEI0rr26nbiy9W"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="video-item">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/M-nLhplc-mc?si=cXWxjwDwR4Tk84WZ"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
        <button class="next" onclick="moveSlide(1)">❯</button>
    </div>
    <script src="/js/home/service/Hconstruction.js"></script>
    <script src="/js/home/service/Hinterior.js"></script>
@endsection
