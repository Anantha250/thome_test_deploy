@extends('layouts.layout_home')

@section('content')
    <link rel="stylesheet" href="/css/home/addon_service/app_inspector.css">
    <!-- New App Section -->
    <section class="new-app-section">
        <div class="container">
            <div class="new-app-header">
                <h1 class="main-title">{{ __('app_inspector.newapp_title') }}</h1>
                <h2 class="sub-title">{{ __('app_inspector.newapp_subtitle') }}</h2>
                <p class="description">{{ __('app_inspector.newapp_description') }}</p>
            </div>
            
            <div class="new-app-content">
                <div class="app-preview-grid">
                    <div class="app-preview-item">
                        <div class="preview-glow"></div>
                        <div class="preview-container">
                            <img src="/img/app1.png" alt="{{ __('app_inspector.app_preview_alt1') }}" class="preview-image">
                        </div>
                    </div>
                    <div class="app-preview-item">
                        <div class="preview-glow"></div>
                        <div class="preview-container">
                            <img src="/img/app2.png" alt="{{ __('app_inspector.app_preview_alt2') }}" class="preview-image">
                        </div>
                    </div>
                </div>
                
                <div class="main-cta">
                    <a href="https://liff.line.me/2005695449-36Xrdj94" class="btn-primary large">
                        <i class="fas fa-rocket"></i>
                        {{ __('app_inspector.newapp_button') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">{{ __('app_inspector.hero_title') }}</h1>
            <p class="hero-description">{{ __('app_inspector.hero_subtitle') }}</p>
            <a href="https://liff.line.me/2005695449-36Xrdj94" class="btn-gradient large">
                <i class="fas fa-play"></i>
                {{ __('app_inspector.hero_button') }}
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h2 class="section-title">{{ __('app_inspector.features_title') }}</h2>
            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="feature-title">{{ __('app_inspector.feature1_title') }}</h3>
                    <p class="feature-description">{{ __('app_inspector.feature1_description') }}</p>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">{{ __('app_inspector.feature2_title') }}</h3>
                    <p class="feature-description">{{ __('app_inspector.feature2_description') }}</p>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="feature-title">{{ __('app_inspector.feature3_title') }}</h3>
                    <p class="feature-description">{{ __('app_inspector.feature3_description') }}</p>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="feature-title">{{ __('app_inspector.feature4_title') }}</h3>
                    <p class="feature-description">{{ __('app_inspector.feature4_description') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section">
        <div class="container">
            <h2 class="section-title">{{ __('app_inspector.categories_title') }}</h2>
            <div class="categories-grid">
                <div class="category-item" data-aos="fade-right" data-aos-delay="0">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ __('app_inspector.category1') }}</span>
                </div>
                <div class="category-item" data-aos="fade-right" data-aos-delay="100">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ __('app_inspector.category2') }}</span>
                </div>
                <div class="category-item" data-aos="fade-right" data-aos-delay="200">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ __('app_inspector.category3') }}</span>
                </div>
                <div class="category-item" data-aos="fade-right" data-aos-delay="300">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ __('app_inspector.category4') }}</span>
                </div>
                <div class="category-item" data-aos="fade-right" data-aos-delay="400">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ __('app_inspector.category5') }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">{{ __('app_inspector.cta_title') }}</h2>
            <p class="cta-description">{{ __('app_inspector.cta_subtitle') }}</p>
            <a href="https://liff.line.me/2005695449-36Xrdj94" class="btn-white large">
                <i class="fas fa-arrow-right"></i>
                {{ __('app_inspector.cta_button') }}
            </a>
        </div>
    </section>
    <script>
        // App Inspector JavaScript (without language switching as it's handled by Laravel)
document.addEventListener("DOMContentLoaded", () => {
  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault()
      const target = document.querySelector(this.getAttribute("href"))
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        })
      }
    })
  })

  // Add parallax effect to hero section
  window.addEventListener("scroll", () => {
    const scrolled = window.pageYOffset
    const newAppSection = document.querySelector(".new-app-section")

    if (newAppSection) {
      newAppSection.style.transform = `translateY(${scrolled * 0.3}px)`
    }
  })

  // Add hover effects to buttons
  const buttons = document.querySelectorAll(".btn-primary, .btn-gradient, .btn-white")
  buttons.forEach((button) => {
    button.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-3px) scale(1.05)"
    })

    button.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0) scale(1)"
    })
  })

  // Add click ripple effect
  buttons.forEach((button) => {
    button.addEventListener("click", function (e) {
      const ripple = document.createElement("span")
      const rect = this.getBoundingClientRect()
      const size = Math.max(rect.width, rect.height)
      const x = e.clientX - rect.left - size / 2
      const y = e.clientY - rect.top - size / 2

      ripple.style.width = ripple.style.height = size + "px"
      ripple.style.left = x + "px"
      ripple.style.top = y + "px"
      ripple.classList.add("ripple")

      this.appendChild(ripple)

      setTimeout(() => {
        ripple.remove()
      }, 600)
    })
  })

  // Intersection Observer for animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate-fade-in-up")
      }
    })
  }, observerOptions)

  // Observe elements for animation
  document.querySelectorAll(".feature-card, .category-item").forEach((el) => {
    observer.observe(el)
  })
})

// Add CSS for ripple effect
const style = document.createElement("style")
style.textContent = `
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`
document.head.appendChild(style)

    </script>

@endsection
