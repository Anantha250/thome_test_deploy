@extends('layouts.layout_home')

@section('content')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/home/service/HbutlerComingSoon.css" />

    <section id="home" class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content item-1">
                    <h1>Coming Soon!</h1>
                    <p>{{ __('hbutler.hbutler_sub') }}</p>
                    <div class="hero-buttons">
                        <a href="#services" class="btn-custom btn-primary-custom">
                            <span>ค้นหาบริการอื่น</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 item-2">
                    <div class="image-container">
                        <img src="/img/s4-bg.png" alt="Home Butler Logo" class="w-100" />
                        <div class="floating-card card-1">
                            <i class="fas fa-broom"></i>
                            <span>ทำความสะอาด</span>
                        </div>
                        <div class="floating-card card-2">
                            <i class="fas fa-tools"></i>
                            <span>ซ่อมแซม</span>
                        </div>
                        <div class="floating-card card-3">
                            <i class="fas fa-leaf"></i>
                            <span>ดูแลสวน</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Smooth scrolling for anchor links
        // document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        //     anchor.addEventListener('click', function(e) {
        //         e.preventDefault();
        //         const target = document.querySelector(this.getAttribute('href'));
        //         if (target) {
        //             target.scrollIntoView({
        //                 behavior: 'smooth',
        //                 block: 'start'
        //             });
        //         }
        //     });
        // });

        // // Add parallax effect on scroll
        // window.addEventListener('scroll', function() {
        //     const scrolled = window.pageYOffset;
        //     const parallax = document.querySelector('.hero');
        //     const speed = scrolled * 0.5;
        //     parallax.style.transform = `translateY(${speed}px)`;
        // });

        // // Add intersection observer for animations
        // const observerOptions = {
        //     threshold: 0.1,
        //     rootMargin: '0px 0px -50px 0px'
        // };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        // Observe floating cards
        document.querySelectorAll('.floating-card').forEach(card => {
            observer.observe(card);
        });
    </script>
@endsection
