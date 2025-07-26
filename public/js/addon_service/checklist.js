// Navigation Toggle
const navToggle = document.getElementById("nav-toggle")
const navMenu = document.getElementById("nav-menu")

if (navToggle && navMenu) {
  navToggle.addEventListener("click", () => {
    navMenu.classList.toggle("active")
    navToggle.classList.toggle("active")
  })

  // Close mobile menu when clicking on a link
  document.querySelectorAll(".nav-link").forEach((link) => {
    link.addEventListener("click", () => {
      navMenu.classList.remove("active")
      navToggle.classList.remove("active")
    })
  })
}

// Smooth scrolling function
function scrollToSection(sectionId) {
  const element = document.getElementById(sectionId)
  if (element) {
    const offsetTop = element.offsetTop - 70 // Account for fixed navbar
    window.scrollTo({
      top: offsetTop,
      behavior: "smooth",
    })
  }
}

// Modal functions
function openContactModal() {
  const modal = document.getElementById("contactModal")
  if (modal) {
    modal.style.display = "block"
    document.body.style.overflow = "hidden"
  }
}

function closeContactModal() {
  const modal = document.getElementById("contactModal")
  if (modal) {
    modal.style.display = "none"
    document.body.style.overflow = "auto"
  }
}

// Close modal when clicking outside
window.addEventListener("click", (event) => {
  const modal = document.getElementById("contactModal")
  if (modal && event.target === modal) {
    closeContactModal()
  }
})

// Close modal with Escape key
document.addEventListener("keydown", (event) => {
  if (event.key === "Escape") {
    closeContactModal()
  }
})

// Navbar scroll effect
window.addEventListener("scroll", () => {
  const navbar = document.querySelector(".navbar")
  if (navbar) {
    if (window.scrollY > 50) {
      navbar.style.background = "rgba(255, 255, 255, 0.98)"
      navbar.style.boxShadow = "0 2px 20px rgba(0, 0, 0, 0.1)"
    } else {
      navbar.style.background = "rgba(255, 255, 255, 0.95)"
      navbar.style.boxShadow = "none"
    }
  }
})

// Animated counter for statistics
function animateCounter(element, target, duration = 2000) {
  let start = 0
  const increment = target / (duration / 16)

  const timer = setInterval(() => {
    start += increment
    if (start >= target) {
      element.textContent = target
      clearInterval(timer)
    } else {
      element.textContent = Math.floor(start)
    }
  }, 16)
}

// Intersection Observer for animations
const observerOptions = {
  threshold: 0.1,
  rootMargin: "0px 0px -50px 0px",
}

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      // Add fade-in animation
      entry.target.classList.add("fade-in-up")

      // Animate counters if they're stat numbers
      if (entry.target.classList.contains("stat-number")) {
        const target = Number.parseInt(entry.target.getAttribute("data-target"))
        animateCounter(entry.target, target)
        entry.target.classList.add("animate")
      }

      // Unobserve after animation
      observer.unobserve(entry.target)
    }
  })
}, observerOptions)

// Observe elements for animation
document.addEventListener("DOMContentLoaded", () => {
  // Observe feature cards
  document.querySelectorAll(".feature-card").forEach((card) => {
    observer.observe(card)
  })

  // Observe stat numbers
  document.querySelectorAll(".stat-number").forEach((stat) => {
    observer.observe(stat)
  })

  // Observe other elements
  document.querySelectorAll(".info-card, .inspection-categories, .contact-info").forEach((element) => {
    observer.observe(element)
  })

  // Initialize animations
  initializeAnimations()

  // Handle iframe loading
  handleIframeLoading()

  // Add smooth scrolling to buttons
  addSmoothScrolling()

  // Add hover effects
  addHoverEffects()

  // Update language buttons to use enhanced switching
  document.querySelectorAll(".lang-btn").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.stopPropagation()
      const lang = btn.getAttribute("data-lang")
      enhancedLanguageSwitch(lang)
    })
  })
})

// Initialize animations
function initializeAnimations() {
  // Add staggered animation delays to cards
  const cards = document.querySelectorAll(".card")
  cards.forEach((card, index) => {
    card.style.animationDelay = `${index * 0.1}s`
  })

  // Add staggered animation delays to checklist items
  const checklistItems = document.querySelectorAll(".checklist li")
  checklistItems.forEach((item, index) => {
    item.style.animationDelay = `${index * 0.05}s`
    item.style.animation = "fadeInUp 0.6s ease-out forwards"
    item.style.opacity = "0"
  })

  // Trigger animations on scroll
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = "1"
          entry.target.classList.add("animate")
        }
      })
    },
    {
      threshold: 0.1,
      rootMargin: "0px 0px -50px 0px",
    },
  )

  // Observe elements for animation
  document.querySelectorAll("[data-aos]").forEach((el) => {
    observer.observe(el)
  })
}

// Handle iframe loading
function handleIframeLoading() {
  const iframe = document.querySelector(".check-iframe")
  const loadingElement = document.querySelector(".iframe-loading")

  if (iframe && loadingElement) {
    iframe.addEventListener("load", () => {
      loadingElement.style.display = "none"
      iframe.classList.add("loaded")
    })

    // Hide loading after timeout as fallback
    setTimeout(() => {
      if (loadingElement) {
        loadingElement.style.display = "none"
        iframe.classList.add("loaded")
      }
    }, 5000)
  }
}

// Add smooth scrolling to buttons
function addSmoothScrolling() {
  const buttons = document.querySelectorAll('a[href^="#"]')
  buttons.forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault()
      const targetId = this.getAttribute("href").substring(1)
      const targetElement = document.getElementById(targetId)

      if (targetElement) {
        targetElement.scrollIntoView({
          behavior: "smooth",
          block: "start",
        })
      }
    })
  })
}

// Add hover effects
function addHoverEffects() {
  // Add ripple effect to buttons
  const buttons = document.querySelectorAll(".btn")
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

  // Add floating animation to hero icon
  const heroIcon = document.querySelector(".hero-icon")
  if (heroIcon) {
    setInterval(() => {
      heroIcon.style.transform = "translateY(-5px)"
      setTimeout(() => {
        heroIcon.style.transform = "translateY(0)"
      }, 1000)
    }, 2000)
  }

  // Add floating animation to cta icon
  const ctaIcon = document.querySelector(".cta-icon")
  if (ctaIcon) {
    setInterval(() => {
      ctaIcon.style.transform = "translateY(-3px) scale(1.05)"
      setTimeout(() => {
        ctaIcon.style.transform = "translateY(0) scale(1)"
      }, 1000)
    }, 3000)
  }
}

// Add parallax effect to decoration elements
window.addEventListener("scroll", () => {
  const scrolled = window.pageYOffset
  const decorationCircles = document.querySelectorAll(".decoration-circle")
  const decorationShapes = document.querySelectorAll(".decoration-shape")

  decorationCircles.forEach((circle, index) => {
    const speed = 0.5 + index * 0.1
    circle.style.transform = `translateY(${scrolled * speed}px)`
  })

  decorationShapes.forEach((shape, index) => {
    const speed = 0.3 + index * 0.1
    shape.style.transform = `translateY(${scrolled * speed}px)`
  })
})

// Add CSS for ripple effect
const rippleCSS = `
.btn {
    position: relative;
    overflow: hidden;
}

.ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
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

.hero-icon, .cta-icon {
    transition: transform 1s ease-in-out;
}
`

// Inject CSS
const style = document.createElement("style")
style.textContent = rippleCSS
document.head.appendChild(style)

// Handle navigation to /compare-houses
document.addEventListener("click", (e) => {
  const target = e.target.closest('a[href="/compare-houses"]')
  if (target) {
    e.preventDefault()

    // Add loading effect
    const originalContent = target.innerHTML
    target.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span data-translate="loading">Loading...</span>'
    target.style.pointerEvents = "none"

    // Update loading text based on current language
    const loadingText = window.currentLanguage === "th" ? "กำลังโหลด..." : "Loading..."
    const loadingSpan = target.querySelector("span[data-translate]")
    if (loadingSpan) {
      loadingSpan.textContent = loadingText
    }

    // Simulate navigation (replace with actual navigation logic)
    setTimeout(() => {
      // In a real application, you would navigate to the compare-houses page
      // For demo purposes, we'll show an alert
      const alertMessage =
        window.currentLanguage === "th"
          ? "กำลังนำทางไปยังหน้าเปรียบเทียบบ้าน...\n\nในแอปพลิเคชันจริง จะเปลี่ยนเส้นทางไปยัง /compare-houses"
          : "Navigating to Compare Houses page...\n\nIn a real application, this would redirect to /compare-houses"

      alert(alertMessage)

      // Reset button
      target.innerHTML = originalContent
      target.style.pointerEvents = "auto"
    }, 1500)
  }
})

// Add entrance animations
function addEntranceAnimations() {
  const elements = document.querySelectorAll(".checklist-item, .hero, .card")

  elements.forEach((element, index) => {
    element.style.opacity = "0"
    element.style.transform = "translateY(30px)"
    element.style.transition = "all 0.6s ease-out"

    setTimeout(() => {
      element.style.opacity = "1"
      element.style.transform = "translateY(0)"
    }, index * 100)
  })
}

// Initialize entrance animations when page loads
window.addEventListener("load", addEntranceAnimations)

// Add language-aware notifications
function showNotification(messageKey, type = "info") {
  const messages = {
    en: {
      loading: "Loading...",
      success: "Success!",
      error: "Error occurred",
    },
    th: {
      loading: "กำลังโหลด...",
      success: "สำเร็จ!",
      error: "เกิดข้อผิดพลาด",
    },
  }

  const message = messages[window.currentLanguage || "en"][messageKey] || messageKey

  // Create notification element
  const notification = document.createElement("div")
  notification.className = `notification notification-${type}`
  notification.textContent = message
  notification.style.cssText = `
    position: fixed;
    top: 100px;
    right: 20px;
    background: ${type === "error" ? "#ef4444" : type === "success" ? "#10b981" : "#3b82f6"};
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 1000;
    transform: translateX(100%);
    transition: transform 0.3s ease;
  `

  document.body.appendChild(notification)

  // Animate in
  setTimeout(() => {
    notification.style.transform = "translateX(0)"
  }, 100)

  // Remove after delay
  setTimeout(() => {
    notification.style.transform = "translateX(100%)"
    setTimeout(() => {
      document.body.removeChild(notification)
    }, 300)
  }, 3000)
}

// Enhanced language switching with smooth transitions
function enhancedLanguageSwitch(lang) {
  // Add visual feedback
  document.body.style.transition = "opacity 0.2s ease"
  document.body.style.opacity = "0.8"

  setTimeout(() => {
    window.setLanguage(lang)
    document.body.style.opacity = "1"
    showNotification("success")
  }, 200)
}
