{{-- filepath: c:\xampp\htdocs\example-app\resources\views\home\service\hconstruction.blade.php --}}
@extends('layouts.layout_home')
@section('title', 'T. Home Construction')

@section('content')

    <link rel="stylesheet" href="/css/home/service/hconstruction.css">

    <section class="hero-section">
        <div id="carouselExampleIndicators" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner h-100">
                <div class="carousel-item active h-100">
                    <img src="https://img.freepik.com/free-photo/people-renovating-house-concept_53876-20664.jpg"
                        class="hero-bg" alt="...">
                    <div class="hero-content">
                        <div class="logo-container">
                            <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/s3-3bLs5HKnwRUrK4px4T8zPO4uMNVUmo.png"
                                alt="T. HOME CONSTRUCTION Logo" class="hero-logo">
                        </div>
                        <h1 class="hero-title">{{ __('hconstruction.hero-title') }}</h1>
                        <div class="hero-description">{{ __('hconstruction.hero-description') }}</div>
                        <a href="Homepage/Contactus.php" class="hero-btn">{{ __('hconstruction.contact-btn') }}</a>
                    </div>
                </div>
                <div class="carousel-item h-100 p-0">
                    <div class="hero-detail-container">
                        <img src="img/Construction-bg.jpg" alt="...">
                    </div>
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
    </section>

    <!-- 🏠 Services Section -->
    <section class="services-section" id="services" data-aos="fade-up">
        <div>
            <h2 class="section-title">{{ __('hconstruction.services-title') }}</h2>
            <div class="services-description">
                <div>{{ __('hconstruction.services-description') }}</div>
            </div>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-tools"></i></div>
                    <div class="service-title">{{ __('hconstruction.service1-title') }}</div>
                    <div class="service-text">{{ __('hconstruction.service1-text') }}</div>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-paint-roller"></i></div>
                    <div class="service-title">{{ __('hconstruction.service2-title') }}</div>
                    <div class="service-text">{{ __('hconstruction.service2-text') }}</div>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-hard-hat"></i></div>
                    <div class="service-title">{{ __('hconstruction.service3-title') }}</div>
                    <div class="service-text">{{ __('hconstruction.service3-text') }}</div>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-lightbulb"></i></div>
                    <div class="service-title">{{ __('hconstruction.service4-title') }}</div>
                    <div class="service-text">{{ __('hconstruction.service4-text') }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ส่วนเกี่ยวกับเรา -->
    <section class="about-section" id="about" data-aos="fade-up">
        <div class="container">
            <h2 class="section-title">{{ __('hconstruction.about-title') }}</h2>
            <div class="about-container gap-sm-4 gap-md-5">
                <figure class="about-image justify-content-sm-center justify-content-md-end">
                    <img src="img/Hconstruction-bg.jpg" alt="ทีมงานของเรา">
                </figure>
                <div class="about-content">
                    <p class="about-description">{{ __('hconstruction.about-description') }}</p>
                    <ul class="about-features">
                        <li class="about-feature">
                            <span class="feature-icon"><i class="fas fa-check-circle"></i></span>
                            <span>{{ __('hconstruction.about-feature1') }}</span>
                        </li>
                        <li class="about-feature">
                            <span class="feature-icon"><i class="fas fa-check-circle"></i></span>
                            <span>{{ __('hconstruction.about-feature2') }}</span>
                        </li>
                        <li class="about-feature">
                            <span class="feature-icon"><i class="fas fa-check-circle"></i></span>
                            <span>{{ __('hconstruction.about-feature3') }}</span>
                        </li>
                        <li class="about-feature">
                            <span class="feature-icon"><i class="fas fa-check-circle"></i></span>
                            <span>{{ __('hconstruction.about-feature4') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="review-page aos-init aos-animate" data-aos="fade-up">
        <h1>{{ __('hconstruction.review-title') }}</h1>
        <br>
        <div class="categories aos-init aos-animate" data-aos="fade-up" data-aos-duration="1500">
            <button class="category-btn active" data-category="all">{{ __('hconstruction.category-all') }}</button>
            @foreach ($tags as $tag)
                <button class="category-btn" data-category="{{ $tag->translation['title'] }}">{{ $tag->translation['title'] }}</button>
            @endforeach
            {{-- <button class="category-btn" data-category="Modern">{{ __('hconstruction.category-modern') }}</button>
            <button class="category-btn"
                data-category="Modern Luxury">{{ __('hconstruction.category-modern-luxury') }}</button>
            <button class="category-btn"
                data-category="Modern Classic">{{ __('hconstruction.category-modern-classic') }}</button> --}}
        </div>
        <div class="review-cards">
            @foreach ($projects as $project)
                <a class="card" data-category="{{ $project->tag->translation['title'] }}"
                    href="/hconstruction/project/{{ $project->id }}">
                    <img src="{{ $project->coverPageImg }}">
                    <p>{{ $project->translation['title'] }}</p>
                </a>
            @endforeach

            {{-- <a class="card" data-category="Modern" href="https://thomeinspector1.netlify.app/after_review_interior2">
                <img src="/img/after_review/interrior-bg2.jpg" alt="House Review 2">
                <p>{{ __('hconstruction.review2-title') }}</p>
            </a>
            <a class="card" data-category="Modern" href="https://thomeinspector1.netlify.app/after_review_interior3">
                <img src="/img/after_review/interrior-bg3.jpg" alt="House Review 3">
                <p>{{ __('hconstruction.review3-title') }}</p>
            </a>
            <a class="card" data-category="Modern Luxury"
                href="https://thomeinspector1.netlify.app/after_review_interior4">
                <img src="/img/after_review/interrior-bg4.jpg" alt="House Review 4">
                <p>{{ __('hconstruction.review4-title') }}</p>
            </a>
            <a class="card" data-category="Modern Luxury"
                href="https://thomeinspector1.netlify.app/after_review_interior5">
                <img src="/img/after_review/interrior-bg5.jpg" alt="House Review 5">
                <p>{{ __('hconstruction.review5-title') }}</p>
            </a>
            <a class="card" data-category="Modern Luxury"
                href="https://thomeinspector1.netlify.app/after_review_interior6">
                <img src="/img/after_review/interrior-bg6.jpg" alt="House Review 6">
                <p>{{ __('hconstruction.review6-title') }}</p>
            </a>
            <a class="card" data-category="Modern Classic"
                href="https://thomeinspector1.netlify.app/after_review_interior7">
                <img src="/img/after_review/interrior-bg7.jpg" alt="House Review 7">
                <p>{{ __('hconstruction.review7-title') }}</p>
            </a>
            <a class="card" data-category="Modern Classic"
                href="https://thomeinspector1.netlify.app/after_review_interior8">
                <img src="/img/after_review/interrior-bg8.jpg" alt="House Review 8">
                <p>{{ __('hconstruction.review8-title') }}</p>
            </a>
            <a class="card" data-category="Modern Classic"
                href="https://thomeinspector1.netlify.app/after_review_interior9">
                <img src="/img/after_review/interrior-bg9.jpg" alt="House Review 9">
                <p>{{ __('hconstruction.review9-title') }}</p>
            </a> --}}
        </div>
    </div>

    <script src="/js/home/service/hconstruction.js"></script>

@endsection
