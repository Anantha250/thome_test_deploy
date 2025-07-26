@extends('layouts.layout_home')
@section('content')
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('checklist.page_title') }}</title>
    <link rel="stylesheet" href="/css/home/addon_service/checklist.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="content-box">
        <!-- Checklist Container -->
        <div class="check-container" data-aos="zoom-in-down">
            <div class="checklist-section">
                <div class="checklist-item">
                    <div class="checklist-header">
                        <h2>
                            <i class="fas fa-list-alt"></i> 
                            <span>{{ __('checklist.checklist_title') }}</span>
                        </h2>
                        <div class="header-decoration"></div>
                    </div>
                    
                    <div class="checklist-info">
                        <div class="info-item">
                            <i class="fas fa-info-circle"></i>
                            <p>{{ __('checklist.info_professional') }}</p>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-check-circle"></i>
                            <p>{{ __('checklist.info_comprehensive') }}</p>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-home"></i>
                            <p>{{ __('checklist.info_detailed') }}</p>
                        </div>
                    </div>

                    <div class="checklist-categories">
                        <h3>{{ __('checklist.inspection_categories') }}</h3>
                        <ul class="checklist">
                            <li>
                                <i class="fas fa-file-alt"></i> 
                                <span>{{ __('checklist.category_documentation') }}</span>
                            </li>
                            <li>
                                <i class="fas fa-bath"></i> 
                                <span>{{ __('checklist.category_sanitary') }}</span>
                            </li>
                            <li>
                                <i class="fas fa-warehouse"></i> 
                                <span>{{ __('checklist.category_roofing') }}</span>
                            </li>
                            <li>
                                <i class="fas fa-bolt"></i> 
                                <span>{{ __('checklist.category_electrical') }}</span>
                            </li>
                        </ul>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-header">
                            <i class="fas fa-headset"></i>
                            <h4>{{ __('checklist.need_help') }}</h4>
                        </div>
                        <div class="contact-details">
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <span>+66 02 555 7890</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <span>info@homeinspector.com</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-clock"></i>
                                <span>{{ __('checklist.available_24_7') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="logo-container">
                    <div class="image-wrapper">
                        <img src="https://img.freepik.com/free-vector/two-tiny-men-preparing-move-flat-illustration_74855-18782.jpg?t=st=1740374071~exp=1740377671~hmac=d1c2f0c5a4d7d9c369ba799943d8894453b60118c73f95bcb1cdc7c29d092f8a&w=1380" alt="House Inspection Illustration">
                        <div class="image-overlay"></div>
                    </div>
                    <div class="image-caption">
                        <h4>{{ __('checklist.professional_service') }}</h4>
                        <p>{{ __('checklist.trusted_experts') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Section -->
        <div class="hero" data-aos="fade-up">
            <div class="hero-content">
                <div class="hero-icon">
                    <i class="fas fa-home"></i>
                </div>
                <h1>{{ __('checklist.hero_title') }}</h1>
                <p>{{ __('checklist.hero_subtitle') }}</p>
                <a href="/compare-houses" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                    <span>{{ __('checklist.compare_houses_btn') }}</span>
                </a>
            </div>
            <div class="hero-decoration">
                <div class="decoration-circle circle-1"></div>
                <div class="decoration-circle circle-2"></div>
                <div class="decoration-circle circle-3"></div>
            </div>
        </div>

        <!-- Content Section -->
        <section id="details" class="content">
            <div class="container">
                <div class="section-header">
                    <h2 data-aos="fade-right">{{ __('checklist.services_title') }}</h2>
                    <div class="section-decoration"></div>
                    <p>{{ __('checklist.services_subtitle') }}</p>
                </div>
                
                <div class="grid">
                    <div class="card" data-aos="zoom-in">
                        <div class="card-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>{{ __('checklist.service_structural_title') }}</h3>
                        <p>{{ __('checklist.service_structural_desc') }}</p>
                        <div class="card-decoration"></div>
                    </div>
                    
                    <div class="card" data-aos="zoom-in" data-aos-delay="100">
                        <div class="card-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3>{{ __('checklist.service_electrical_title') }}</h3>
                        <p>{{ __('checklist.service_electrical_desc') }}</p>
                        <div class="card-decoration"></div>
                    </div>
                    
                    <div class="card" data-aos="zoom-in" data-aos-delay="200">
                        <div class="card-icon">
                            <i class="fas fa-tint"></i>
                        </div>
                        <h3>{{ __('checklist.service_plumbing_title') }}</h3>
                        <p>{{ __('checklist.service_plumbing_desc') }}</p>
                        <div class="card-decoration"></div>
                    </div>
                    
                    <div class="card" data-aos="zoom-in" data-aos-delay="300">
                        <div class="card-icon">
                            <i class="fas fa-wind"></i>
                        </div>
                        <h3>{{ __('checklist.service_hvac_title') }}</h3>
                        <p>{{ __('checklist.service_hvac_desc') }}</p>
                        <div class="card-decoration"></div>
                    </div>
                    
                    <div class="card" data-aos="zoom-in" data-aos-delay="400">
                        <div class="card-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>{{ __('checklist.service_safety_title') }}</h3>
                        <p>{{ __('checklist.service_safety_desc') }}</p>
                        <div class="card-decoration"></div>
                    </div>
                    
                    <div class="card" data-aos="zoom-in" data-aos-delay="500">
                        <div class="card-icon">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <h3>{{ __('checklist.service_documentation_title') }}</h3>
                        <p>{{ __('checklist.service_documentation_desc') }}</p>
                        <div class="card-decoration"></div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Call to Action -->
        <section class="cta" data-aos="fade-up">
            <div class="container">
                <div class="cta-content">
                    <div class="cta-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h2>{{ __('checklist.cta_title') }}</h2>
                    <p>{{ __('checklist.cta_subtitle') }}</p>
                    <a href="/compare-houses" class="btn btn-cta">
                        <i class="fas fa-rocket"></i>
                        <span>{{ __('checklist.cta_button') }}</span>
                    </a>
                </div>
                <div class="cta-decoration">
                    <div class="decoration-shape shape-1"></div>
                    <div class="decoration-shape shape-2"></div>
                </div>
            </div>
        </section>
    </div>

    <script src="/js/home/addon_service/checklist.js"></script>
</body>
</html>
@endsection
