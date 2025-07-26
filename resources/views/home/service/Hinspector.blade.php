@extends('layouts.layout_home')

@section('content')
    <!DOCTYPE html>

    <link rel="stylesheet" href="/css/home/service/Hinspector.css">

    <!-- Language Switcher จะใช้จาก navbar หลักแทน -->

    <section class="hero">
        <div class="bg bg1"></div>
        <div class="bg bg2"></div>

        <div class="overlay"></div>
        <div class="hero-content">
            <h1 class="animate-text">{{ __('hinspector.hero_title') }}<span>{{ __('hinspector.hero_title_highlight') }}</span></h1>
            <p class="animate-text delay-1">{{ __('hinspector.hero_subtitle') }}</p>
            <div class="hero-buttons animate-text delay-2">
                <a href="#pricing" class="btn btn-primary">{{ __('hinspector.btn_pricing') }}</a>
                <a href="#report" class="btn btn-secondary">{{ __('hinspector.btn_sample_report') }}</a>
            </div>
        </div>

        <div class="scroll-indicator">
            <div class="mouse">
                <div class="wheel"></div>
            </div>
            <div>
                <span class="scroll-arrows">
                    <span></span><span></span><span></span>
                </span>
            </div>
        </div>
    </section>

    <section class="services" id="services">
        <div class="section-container">
            <div class="section-header">
                <h2>{{ __('hinspector.services_title') }}</h2>
                <div class="underline"></div>
            </div>
            <div class="container-top">
                <div class="card-grid-top">
                    <div class="card-top">
                        <div class="header-top">
                            <div class="icon-top">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </div>
                            <h3 class="card-title-top">{{ __('hinspector.trust_title') }}</h3>
                        </div>
                        <div class="content-top">
                            <p>{{ __('hinspector.trust_description') }}</p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="card-top">
                        <div class="header-top">
                            <div class="icon-top">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </div>
                            <h3 class="card-title-top">{{ __('hinspector.tech_title') }}</h3>
                        </div>
                        <div class="content-top">
                            <p>{{ __('hinspector.tech_description') }}</p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="card-top">
                        <div class="header-top">
                            <div class="icon-top">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </div>
                            <h3 class="card-title-top">{{ __('hinspector.team_title') }}</h3>
                        </div>
                        <div class="content-top">
                            <p>{{ __('hinspector.team_description') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="service-description">
                <div class="text-content">
                    <h3>{{ __('hinspector.service_description_title') }}</h3>
                    <p>{{ __('hinspector.service_description_text') }}</p>
                    <ul>
                        <li><i class="fas fa-check-circle"></i> {{ __('hinspector.service_feature_1') }}</li>
                        <li><i class="fas fa-check-circle"></i> {{ __('hinspector.service_feature_2') }}</li>
                        <li><i class="fas fa-check-circle"></i> {{ __('hinspector.service_feature_3') }}</li>
                        <li><i class="fas fa-check-circle"></i> {{ __('hinspector.service_feature_4') }}</li>
                    </ul>
                </div>
                <div class="video-container">
                    <div class="video-wrapper">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/RlV_UDSCCD0"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inspection-scope">
        <div class="inspection-container">
            <h2 class="inspection-title">{{ __('hinspector.inspection_scope_title') }}</h2>
            <p class ="inspection-description">{{ __('hinspector.inspection_scope_description') }}</p>
            <div class="inspection-grid">
                <!-- แถวบน: 3 การ์ด -->
                <div class="inspection-row top-row">
                    <!-- ระบบไฟฟ้า -->
                    <div class="inspection-card" data-aos="fade-up">
                        <div class="inspection-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M18 16.236V7.764a2 2 0 0 0-1.106-1.789L9 2.118a2 2 0 0 0-1.894 0L1.106 5.974A2 2 0 0 0 0 7.764v8.472a2 2 0 0 0 1.106 1.789l6.894 3.855a2 2 0 0 0 1.894 0l6.894-3.855A2 2 0 0 0 18 16.236z">
                                </path>
                                <path d="M9 22v-8"></path>
                                <path d="M15 9L9 6"></path>
                            </svg>
                        </div>
                        <h3 class="inspection-card-title">{{ __('hinspector.electrical_title') }}</h3>
                        <div class="inspection-content">
                            <p>{{ __('hinspector.electrical_description') }}</p>
                            <a href="https://scopeofwork.thomeinspector.com/electrical" class="link-top">{{ __('hinspector.see_more_details') }}</a>
                        </div>
                    </div>

                    <!-- ระบบสุขาภิบาล -->
                    <div class="inspection-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="inspection-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z">
                                </path>
                                <path d="M12 8v8"></path>
                                <path d="M8 12h8"></path>
                            </svg>
                        </div>
                        <h3 class="inspection-card-title">{{ __('hinspector.sanitary_title') }}</h3>
                        <div class="inspection-content">
                            <p>{{ __('hinspector.sanitary_description') }}</p>
                            <a href="https://scopeofwork.thomeinspector.com/sanitary" class="link-top">{{ __('hinspector.see_more_details') }}</a>
                        </div>
                    </div>

                    <!-- งานหลังคา -->
                    <div class="inspection-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="inspection-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 20h20"></path>
                                <path d="M12 2L2 8l10 6 10-6-10-6z"></path>
                            </svg>
                        </div>
                        <h3 class="inspection-card-title">{{ __('hinspector.roof_title') }} <span class="inspection-badge">{{ __('hinspector.roof_badge') }}</span>
                        </h3>
                        <div class="inspection-content">
                            <p>{{ __('hinspector.roof_description') }}</p>
                            <a href="https://scopeofwork.thomeinspector.com/roof" class="link-top">{{ __('hinspector.see_more_details') }}</a>
                        </div>
                    </div>
                </div>

                <!-- แถวล่าง: 2 การ์ด -->
                <div class="inspection-row bottom-row">
                    <!-- งานรั่วซึม -->
                    <div class="inspection-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="inspection-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                            </svg>
                        </div>
                        <h3 class="inspection-card-title">{{ __('hinspector.leakage_title') }} <span class="inspection-badge">{{ __('hinspector.leakage_badge') }}</span>
                        </h3>
                        <div class="inspection-content">
                            <p>{{ __('hinspector.leakage_description') }}</p>
                            <a href="https://scopeofwork.thomeinspector.com/leakage" class="link-top">{{ __('hinspector.see_more_details') }}</a>
                        </div>
                    </div>

                    <!-- งานสถาปัตยกรรม -->
                    <div class="inspection-card" data-aos="fade-up" data-aos-delay="400">
                        <div class="inspection-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"></rect>
                                <line x1="7" y1="2" x2="7" y2="22"></line>
                                <line x1="17" y1="2" x2="17" y2="22"></line>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <line x1="2" y1="7" x2="7" y2="7"></line>
                                <line x1="2" y1="17" x2="7" y2="17"></line>
                                <line x1="17" y1="17" x2="22" y2="17"></line>
                                <line x1="17" y1="7" x2="22" y2="7"></line>
                            </svg>
                        </div>
                        <h3 class="inspection-card-title">{{ __('hinspector.architecture_title') }}</h3>
                        <div class="inspection-content">
                            <p>{{ __('hinspector.architecture_description') }}</p>
                            <a href="https://scopeofwork.thomeinspector.com/architecture" class="link-top">{{ __('hinspector.see_more_details') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simple animation on scroll
            const animateElements = document.querySelectorAll('[data-aos]');

            // Check if element is in viewport
            function isInViewport(element) {
                const rect = element.getBoundingClientRect();
                return (
                    rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.8 &&
                    rect.bottom >= 0
                );
            }

            // Add animation class when element is in viewport
            function checkAnimations() {
                animateElements.forEach(element => {
                    if (isInViewport(element)) {
                        element.classList.add('aos-animate');
                    }
                });
            }

            // Run on load
            checkAnimations();

            // Run on scroll
            window.addEventListener('scroll', checkAnimations);

            // Card hover effects
            const cards = document.querySelectorAll('.inspection-card');

            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    const icon = this.querySelector('.inspection-icon');
                    icon.style.transform = 'scale(1.1)';
                });

                card.addEventListener('mouseleave', function() {
                    const icon = this.querySelector('.inspection-icon');
                    icon.style.transform = 'scale(1)';
                });
            });
        });
    </script>

    <section class="process" id="process">
        <div class="container-process">
            <div class="section-header light">
                <h2>{{ __('hinspector.process_title') }}</h2>
                <div class="underline"></div>
            </div>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="timeline-content">
                        <h3>{{ __('hinspector.process_step_1_title') }}</h3>
                        <p>{{ __('hinspector.process_step_1_description') }}</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="timeline-content">
                        <h3>{{ __('hinspector.process_step_2_title') }}</h3>
                        <p>{{ __('hinspector.process_step_2_description') }}</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div class="timeline-content">
                        <h3>{{ __('hinspector.process_step_3_title') }}</h3>
                        <p>{{ __('hinspector.process_step_3_description') }}</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="timeline-content">
                        <h3>{{ __('hinspector.process_step_4_title') }}</h3>
                        <p>{{ __('hinspector.process_step_4_description') }}</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="timeline-content">
                        <h3>{{ __('hinspector.process_step_5_title') }}</h3>
                        <p>{{ __('hinspector.process_step_5_description') }}</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div class="timeline-content">
                        <h3>{{ __('hinspector.process_step_6_title') }}</h3>
                        <p>{{ __('hinspector.process_step_6_description') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const slides = document.querySelectorAll('.hero-slide');
        let currentSlide = 0;

        setInterval(() => {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }, 5000);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const counters = document.querySelectorAll('.counter');

            const updateCounter = (counter) => {
                const target = +counter.getAttribute('data-target');
                let count = 0;
                const speed = 200;
                const increment = target / speed;

                const update = () => {
                    count += increment;
                    if (count >= target) {
                        count = target;
                    }
                    counter.textContent = Math.floor(count);
                    if (count < target) {
                        requestAnimationFrame(update);
                    }
                };
                update();
            };

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        updateCounter(counter);
                        observer.unobserve(counter);
                    }
                });
            }, {
                threshold: 0.5
            });

            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>

    <div class="pricing-body" id="pricing">
        <div class="pricing-container">
            <h1 class="main-title">{{ __('hinspector.pricing_title') }}</h1>

            <div class="tabs">
                <button class="tab-btn active" data-tab="house">{{ __('hinspector.tab_house') }}</button>
                <button class="tab-btn" data-tab="condo">{{ __('hinspector.tab_condo') }}</button>
            </div>

            <!-- House Content -->
            <div class="tab-content active" id="house-content">
                <div class="section-header-pricing">
                    <h2>{{ __('hinspector.house_types') }}</h2>
                </div>

                <table class="pricing-table">
                    <thead>
                        <tr class="table-header">
                            <th rowspan="2" class="size-col">{{ __('hinspector.size') }}</th>
                            <th rowspan="2" class="area-col">{!! __('hinspector.usable_area') !!}</th>
                            <th colspan="2" class="price-col">{{ __('hinspector.inspection_price') }}</th>
                            <th rowspan="2" class="time-col">{{ __('hinspector.duration') }}</th>
                            <th rowspan="2" class="staff-col">{{ __('hinspector.staff_count') }}</th>
                        </tr>
                        <tr class="table-subheader">
                            <th class="round-col">{{ __('hinspector.round_1') }}</th>
                            <th class="round-col">{{ __('hinspector.round_2') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-row">
                            <td class="size-cell">S</td>
                            <td class="area-cell">{{ __('hinspector.not_exceed') }} 200</td>
                            <td class="price-cell">8,560 {{ __('hinspector.baht') }}</td>
                            <td class="price-cell">4,280 {{ __('hinspector.baht') }}</td>
                            <td class="time-cell">3 {{ __('hinspector.hours') }}</td>
                            <td class="staff-cell">
                                <div class="staff-info">
                                    <div class="staff-icons">
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <span class="staff-count">3 {{ __('hinspector.people') }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="size-cell">M</td>
                            <td class="area-cell">{{ __('hinspector.not_exceed') }} 400</td>
                            <td class="price-cell">12,840 {{ __('hinspector.baht') }}</td>
                            <td class="price-cell">6,420 {{ __('hinspector.baht') }}</td>
                            <td class="time-cell">3 {{ __('hinspector.hours') }}</td>
                            <td class="staff-cell">
                                <div class="staff-info">
                                    <div class="staff-icons">
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <span class="staff-count">3-4 {{ __('hinspector.people') }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="size-cell">L</td>
                            <td class="area-cell">{{ __('hinspector.not_exceed') }} 600</td>
                            <td class="price-cell">17,120 {{ __('hinspector.baht') }}</td>
                            <td class="price-cell">8,560 {{ __('hinspector.baht') }}</td>
                            <td class="time-cell">6 {{ __('hinspector.hours') }}</td>
                            <td class="staff-cell">
                                <div class="staff-info">
                                    <div class="staff-icons">
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <span class="staff-count">4 {{ __('hinspector.people') }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="size-cell">XL</td>
                            <td class="area-cell">{{ __('hinspector.not_exceed') }} 800</td>
                            <td class="price-cell">21,400 {{ __('hinspector.baht') }}</td>
                            <td class="price-cell">10,700 {{ __('hinspector.baht') }}</td>
                            <td class="time-cell">6 {{ __('hinspector.hours') }}</td>
                            <td class="staff-cell">
                                <div class="staff-info">
                                    <div class="staff-icons">
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <span class="staff-count">4-5 {{ __('hinspector.people') }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="size-cell">XXL</td>
                            <td class="area-cell">{{ __('hinspector.not_exceed') }} 1,000</td>
                            <td class="price-cell">25,680 {{ __('hinspector.baht') }}</td>
                            <td class="price-cell">12,840 {{ __('hinspector.baht') }}</td>
                            <td class="time-cell">6 {{ __('hinspector.hours') }}</td>
                            <td class="staff-cell">
                                <div class="staff-info">
                                    <div class="staff-icons">
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <span class="staff-count">5 {{ __('hinspector.people') }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="size-cell">3XL</td>
                            <td class="area-cell">{{ __('hinspector.not_exceed') }} 1,500</td>
                            <td class="price-cell">42,800 {{ __('hinspector.baht') }}</td>
                            <td class="price-cell">21,400 {{ __('hinspector.baht') }}</td>
                            <td class="time-cell">6 {{ __('hinspector.hours') }}</td>
                            <td class="staff-cell">
                                <div class="staff-info">
                                    <div class="staff-icons">
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <span class="staff-count">5-6 {{ __('hinspector.people') }}</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            <div class="notes-section">
                <h3 class="notes-title-vertical">{{ __('hinspector.notes') }}</h3>

                <div class="notes-layout">
                    <div class="notes-grid">
                        <div class="note-item">
                            <span class="note-number">1</span>
                            <span class="note-text">{!! __('hinspector.note_1') !!}</span>
                        </div>
                        <div class="note-item">
                            <span class="note-number">2</span>
                            <span class="note-text">{!! __('hinspector.note_2') !!}</span>
                        </div>
                        <div class="note-item">
                            <span class="note-number">3</span>
                            <span class="note-text">{{ __('hinspector.note_3') }}</span>
                        </div>
                        <div class="note-item">
                            <span class="note-number">4</span>
                            <span class="note-text">{{ __('hinspector.note_4') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Condo Content -->
            <div class="tab-content" id="condo-content">
                <div class="section-header-condo">
                    <h2>{{ __('hinspector.condo_types') }}</h2>
                </div>

                <table class="pricing-table">
                    <thead>
                        <tr class="table-header">
                            <th rowspan="2" class="size-col">{{ __('hinspector.size') }}</th>
                            <th rowspan="2" class="area-col">{!! __('hinspector.usable_area') !!}</th>
                            <th colspan="2" class="price-col">{{ __('hinspector.inspection_price') }}</th>
                            <th rowspan="2" class="time-col">{{ __('hinspector.duration') }}</th>
                            <th rowspan="2" class="staff-col">{{ __('hinspector.staff_count') }}</th>
                        </tr>
                        <tr class="table-subheader">
                            <th class="round-col">{{ __('hinspector.round_1') }}</th>
                            <th class="round-col">{{ __('hinspector.round_2') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-row">
                            <td class="size-cell">S</td>
                            <td class="area-cell">{{ __('hinspector.not_exceed') }} 50</td>
                            <td class="price-cell">5,350 {{ __('hinspector.baht') }}</td>
                            <td class="price-cell">2,675 {{ __('hinspector.baht') }}</td>
                            <td class="time-cell">2 {{ __('hinspector.hours_plus') }}</td>
                            <td class="staff-cell">
                                <div class="staff-info">
                                    <div class="staff-icons">
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <span class="staff-count">2 {{ __('hinspector.people') }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="size-cell">M</td>
                            <td class="area-cell">{{ __('hinspector.not_exceed') }} 100</td>
                            <td class="price-cell">6,420 {{ __('hinspector.baht') }}</td>
                            <td class="price-cell">3,210 {{ __('hinspector.baht') }}</td>
                            <td class="time-cell">3 {{ __('hinspector.hours_plus') }}</td>
                            <td class="staff-cell">
                                <div class="staff-info">
                                    <div class="staff-icons">
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <span class="staff-count">2-3 {{ __('hinspector.people') }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="size-cell">L</td>
                            <td class="area-cell">{{ __('hinspector.not_exceed') }} 150</td>
                            <td class="price-cell">7,490 {{ __('hinspector.baht') }}</td>
                            <td class="price-cell">3,745 {{ __('hinspector.baht') }}</td>
                            <td class="time-cell">3 {{ __('hinspector.hours_plus') }}</td>
                            <td class="staff-cell">
                                <div class="staff-info">
                                    <div class="staff-icons">
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <span class="staff-count">2-3 {{ __('hinspector.people') }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="size-cell">XL</td>
                            <td class="area-cell">{{ __('hinspector.not_exceed') }} 200</td>
                            <td class="price-cell">8,560 {{ __('hinspector.baht') }}</td>
                            <td class="price-cell">4,280 {{ __('hinspector.baht') }}</td>
                            <td class="time-cell">3 {{ __('hinspector.hours_plus') }}</td>
                            <td class="staff-cell">
                                <div class="staff-info">
                                    <div class="staff-icons">
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <span class="staff-count">2-3 {{ __('hinspector.people') }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="size-cell">XXL</td>
                            <td class="area-cell">{{ __('hinspector.not_exceed') }} 400</td>
                            <td class="price-cell">12,840 {{ __('hinspector.baht') }}</td>
                            <td class="price-cell">6,420 {{ __('hinspector.baht') }}</td>
                            <td class="time-cell">6 {{ __('hinspector.hours_plus') }}</td>
                            <td class="staff-cell">
                                <div class="staff-info">
                                    <div class="staff-icons">
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <span class="staff-count">3-4 {{ __('hinspector.people') }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="size-cell">3XL</td>
                            <td class="area-cell">{{ __('hinspector.not_exceed') }} 600</td>
                            <td class="price-cell">17,120 {{ __('hinspector.baht') }}</td>
                            <td class="price-cell">8,560 {{ __('hinspector.baht') }}</td>
                            <td class="time-cell">6 {{ __('hinspector.hours_plus') }}</td>
                            <td class="staff-cell">
                                <div class="staff-info">
                                    <div class="staff-icons">
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                        <svg class="staff-icon" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <span class="staff-count">4-5 {{ __('hinspector.people') }}</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="notes-section">
                    <div class="notes-layout">
                        <h3 class="notes-title-vertical">{{ __('hinspector.notes') }}</h3>
                        <div class="notes-grid">
                            <div class="note-item">
                                <span class="note-number">1</span>
                                <span class="note-text">{!! __('hinspector.note_1') !!}</span>
                            </div>
                            <div class="note-item">
                                <span class="note-number">2</span>
                                <span class="note-text">{!! __('hinspector.note_2') !!}</span>
                            </div>
                            <div class="note-item">
                                <span class="note-number">3</span>
                                <span class="note-text">{{ __('hinspector.note_3') }}</span>
                            </div>
                            <div class="note-item">
                                <span class="note-number">4</span>
                                <span class="note-text">{{ __('hinspector.note_4') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Promotional Banner -->
            <div class="promo-banner">
                <div class="promo-content">
                    <div class="promo-icons">
                        <div class="promo-item">
                            <div class="icon-box">
                                <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M21 2H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h7l-2 3v1h8v-1l-2-3h7c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 12H3V4h18v10z"/>
                                </svg>
                            </div>
                            <span>{{ __('hinspector.promo_web_app') }}</span>
                        </div>

                        <div class="plus-sign">+</div>

                        <div class="promo-item">
                            <div class="icon-box">
                                <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span>{{ __('hinspector.promo_drone_infrared') }}</span>
                        </div>

                        <div class="plus-sign">+</div>

                        <div class="promo-item">
                            <div class="icon-box">
                                <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                                </svg>
                            </div>
                            <span>{{ __('hinspector.promo_thermal_imaging') }}</span>
                        </div>
                    </div>

                    <div class="promo-text">
                        <div class="text-line">{{ __('hinspector.promo_text_1') }}</div>
                        <div class="text-line">{{ __('hinspector.promo_text_2') }}</div>
                        <div class="text-line">{{ __('hinspector.promo_text_3') }}</div>
                        <div class="highlight-text">{{ __('hinspector.promo_highlight') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="sample-reports" id="report">
        <div class="container-reports">
            <div class="content-reports">
                <h2>{{ __('hinspector.sample_reports_title') }}</h2>
                <p>{{ __('hinspector.sample_reports_description') }}</p>
                <div class="buttons-container">
                    <button class="cta-button pdf-button" onclick="showPdfSamples()">
                        <span class="icon">📄</span> {{ __('hinspector.view_pdf_samples') }}
                    </button>
                    <button class="cta-button online-button" onclick="showOnlineSamples()">
                        <span class="icon">🌐</span> {{ __('hinspector.view_online_samples') }}
                    </button>
                </div>
            </div>
            <div class="devices">
                <img src="img/report.png" alt="{{ __('hinspector.reports_on_devices') }}" class="devices-image">
            </div>
        </div>
    </section>

    <div id="pdf-modal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal('pdf-modal')">&times;</span>
            <h3>{{ __('hinspector.pdf_samples_title') }}</h3>
            <div class="samples-grid">
                <div class="sample-item">
                    <div class="sample-icon pdf-icon" style="background-color: #FF5733;"></div>
                    <p>{{ __('hinspector.house_report') }}</p>
                    <a href="https://www.dropbox.com/scl/fi/tjxe239nynmg1pta92uhc/2025.pdf?rlkey=xcsmo683gvkeza0k8soqs9wer&st=ctrnx95g&dl=1" download target="_blank" class="download-link">{{ __('hinspector.download_pdf') }}</a>
                </div>
                <div class="sample-item">
                    <div class="sample-icon pdf-icon" style="background-color: #33A8FF;"></div>
                    <p>{{ __('hinspector.condo_report') }}</p>
                    <a href="https://www.dropbox.com/scl/fi/o8ogutlr4wrq1loahq1zq/2025.pdf?rlkey=7z6nht3yv9bt6vborrryuloax&st=ksvc191d&dl=1" download target="_blank" class="download-link">{{ __('hinspector.download_pdf') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div id="online-modal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal('online-modal')">&times;</span>
            <h3>{{ __('hinspector.online_samples_title') }}</h3>
            <div class="samples-grid">
                <div class="sample-item">
                    <div class="sample-icon online-icon" style="background-color: #FF5733;"></div>
                    <p>{{ __('hinspector.house_report') }}</p>
                    <a href="https://www.dropbox.com/scl/fi/tjxe239nynmg1pta92uhc/2025.pdf?rlkey=xcsmo683gvkeza0k8soqs9wer&st=ctrnx95g&dl=0" class="view-link">{{ __('hinspector.view_online') }}</a>
                </div>
                <div class="sample-item">
                    <div class="sample-icon online-icon" style="background-color: #33A8FF;"></div>
                    <p>{{ __('hinspector.condo_report') }}</p>
                    <a href="https://www.dropbox.com/scl/fi/o8ogutlr4wrq1loahq1zq/2025.pdf?rlkey=7z6nht3yv9bt6vborrryuloax&st=ksvc191d&dl=0" class="view-link">{{ __('hinspector.view_online') }}</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Get all tab buttons and content
            const tabButtons = document.querySelectorAll(".tab-btn")
            const tabContents = document.querySelectorAll(".tab-content")

            // Add click event listeners to tab buttons
            tabButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    const targetTab = this.getAttribute("data-tab")

                    // Remove active class from all buttons and contents
                    tabButtons.forEach((btn) => btn.classList.remove("active"))
                    tabContents.forEach((content) => content.classList.remove("active"))

                    // Add active class to clicked button
                    this.classList.add("active")

                    // Show corresponding content
                    const targetContent = document.getElementById(targetTab + "-content")
                    if (targetContent) {
                        targetContent.classList.add("active")
                    }
                })
            })

            // Add hover effects to table rows
            const tableRows = document.querySelectorAll(".table-row")
            tableRows.forEach((row) => {
                row.addEventListener("mouseenter", function () {
                    this.style.transform = "scale(1.01)"
                    this.style.transition = "transform 0.2s ease"
                })

                row.addEventListener("mouseleave", function () {
                    this.style.transform = "scale(1)"
                })
            })

            // Add smooth scrolling for better UX
            function smoothScrollToElement(element) {
                element.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                })
            }

            // Add animation to notes when they come into view
            const observerOptions = {
                threshold: 0.1,
                rootMargin: "0px 0px -50px 0px",
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = "1"
                        entry.target.style.transform = "translateY(0)"
                    }
                })
            }, observerOptions)

            // Observe notes and promo banner
            const animatedElements = document.querySelectorAll(".notes-section, .promo-banner")
            animatedElements.forEach((element) => {
                element.style.opacity = "0"
                element.style.transform = "translateY(20px)"
                element.style.transition = "opacity 0.6s ease, transform 0.6s ease"
                observer.observe(element)
            })

            // Add click animation to buttons
            tabButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    this.style.transform = "scale(0.95)"
                    setTimeout(() => {
                        this.style.transform = "scale(1)"
                    }, 150)
                })
            })

            // Initialize with house tab active
            const houseTab = document.querySelector('[data-tab="house"]')
            const houseContent = document.getElementById("house-content")

            if (houseTab && houseContent) {
                houseTab.classList.add("active")
                houseContent.classList.add("active")
            }
        })

        // Add loading animation
        window.addEventListener("load", () => {
            document.body.style.opacity = "0"
            document.body.style.transition = "opacity 0.5s ease"

            setTimeout(() => {
                document.body.style.opacity = "1"
            }, 100)
        })

        function showPdfSamples() {
            document.getElementById('pdf-modal').style.display = 'block';
            animateModal('pdf-modal');
        }

        function showOnlineSamples() {
            document.getElementById('online-modal').style.display = 'block';
            animateModal('online-modal');
        }

        function animateModal(modalId) {
            const modalContent = document.querySelector(`#${modalId} .modal-content`);
            modalContent.style.animation = 'fadeIn 0.3s';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        window.onclick = function(event) {
            const pdfModal = document.getElementById('pdf-modal');
            const onlineModal = document.getElementById('online-modal');

            if (event.target === pdfModal) {
                closeModal('pdf-modal');
            }

            if (event.target === onlineModal) {
                closeModal('online-modal');
            }
        }

        const style = document.createElement('style');
        style.innerHTML = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    `;
        document.head.appendChild(style);

        document.addEventListener('DOMContentLoaded', function() {
            const devicesImage = document.querySelector('.devices-image');

            devicesImage.onerror = function() {
                const canvas = document.createElement('canvas');
                canvas.width = 500;
                canvas.height = 300;
                const ctx = canvas.getContext('2d');

                // Draw laptop
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(100, 100, 300, 180);

                // Draw tablet
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(150, 150, 100, 150);

                // Draw phone
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(280, 170, 50, 80);

                // Add colorful circles for report icons
                const colors = ['#FF5733', '#33A8FF', '#33FF57', '#F033FF'];
                for (let i = 0; i < 4; i++) {
                    ctx.fillStyle = colors[i];
                    ctx.beginPath();
                    ctx.arc(150 + i * 70, 140, 15, 0, Math.PI * 2);
                    ctx.fill();
                }

                // Replace the image source with the canvas data URL
                devicesImage.src = canvas.toDataURL();
            };

            // Add pulse animation to buttons periodically
            const buttons = document.querySelectorAll('.cta-button');
            setInterval(() => {
                buttons.forEach(button => {
                    button.style.animation = 'pulse 1s';
                    setTimeout(() => {
                        button.style.animation = '';
                    }, 300);
                });
            }, 5000);

            const downloadLinks = document.querySelectorAll('.download-link');
            downloadLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // แสดงข้อความกำลังโหลดแบบนุ่มนวล (เช่น Toast หรือข้อความใน DOM)
                    const msg = document.createElement('div');
                    msg.textContent = '{{ __("hinspector.downloading_pdf") }}';
                    msg.style.position = 'fixed';
                    msg.style.bottom = '20px';
                    msg.style.left = '50%';
                    msg.style.transform = 'translateX(-50%)';
                    msg.style.background = '#333';
                    msg.style.color = '#fff';
                    msg.style.padding = '10px 20px';
                    msg.style.borderRadius = '8px';
                    msg.style.zIndex = '1000';
                    document.body.appendChild(msg);

                    // ลบข้อความหลัง 2 วินาที
                    setTimeout(() => {
                        msg.remove();
                    }, 2000);

                    // สั่งดาวน์โหลดทันที
                    const a = document.createElement('a');
                    a.href = this.href;
                    a.setAttribute('download', '');
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                });
            });

            const viewLinks = document.querySelectorAll('.view-link');
            viewLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.open(this.href, '_blank');
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            // Add click event to tab buttons
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all buttons and contents
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));

                    // Add active class to clicked button
                    button.classList.add('active');

                    // Show corresponding content
                    const tabId = button.getAttribute('data-tab');
                    document.getElementById(`${tabId}-content`).classList.add('active');
                });
            });

            const tableRows = document.querySelectorAll('.table-row');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', () => {
                    row.style.transform = 'translateY(-2px)';
                    row.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
                    row.style.transition = 'all 0.3s ease';
                });

                row.addEventListener('mouseleave', () => {
                    row.style.transform = 'translateY(0)';
                    row.style.boxShadow = 'none';
                });
            });

            const infoItems = document.querySelectorAll('.info-item');
            infoItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                item.style.transition = 'all 0.5s ease';

                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, 300 + (index * 150));
            });
        });

        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', () => {
                const targetTab = button.getAttribute('data-tab');

                // Remove active class from all buttons and content
                document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

                // Add active class to clicked button and corresponding content
                button.classList.add('active');
                document.getElementById(targetTab + '-content').classList.add('active');
            });
        });
    </script>

    <section class="app-showcase">
        <div class="container-homebutler">
            <div class="app-content">
                <div class="app-text" data-aos="fade-right">
                    <span class="section-subtitle">{{ __('hinspector.app_subtitle') }}</span>
                    <h2 class="section-title">{{ __('hinspector.app_title') }}</h2>
                    <p class="section-title-sub">{{ __('hinspector.app_description') }}</p>

                    <div class="app-download">
                        <a href="https://line.me/download" class="app-btn">
                            <i class="fab fa-apple"></i>
                            <span>
                                <small>{{ __('hinspector.download_on') }}</small>
                                {{ __('hinspector.app_store') }}
                            </span>
                        </a>
                        <a href="https://line.me/download" class="app-btn">
                            <i class="fab fa-google-play"></i>
                            <span>
                                <small>{{ __('hinspector.download_on') }}</small>
                                {{ __('hinspector.google_play') }}
                            </span>
                        </a>
                    </div>
                </div>

                <div class="app-image" data-aos="fade-left">
                    <img src="/img/lineb3.png" alt="{{ __('hinspector.home_butler_app') }}">
                </div>
            </div>
        </div>
    </section>
@endsection
