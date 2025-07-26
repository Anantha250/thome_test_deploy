<header class="navbar-container">
    <div class="top-bar">
        <div class="container row">
            <!-- Social Icons -->
            <div class="social-icons col justify-content-start">
                <a href="https://www.facebook.com/t.homeinspector/?locale=th_TH">
                    <img src="/icon/ICON/Fb.png" alt="Facebook">
                </a>
                <a href="https://www.instagram.com/t.homeinspector/">
                    <img src="/icon/ICON/IG.png" alt="Instagram">
                </a>
                <a href="https://page.line.me/t.home?openQrModal=true">
                    <img src="/icon/ICON/line.png" alt="Line">
                </a>
                <a href="tel:082-045-6165">
                    <img src="/icon/ICON/phone.png" alt="Phone">
                </a>
            </div>
            <!-- Logo -->
            <div class="logo col justify-content-center">
                <a href="/">
                    <img src="/img/s1.png" alt="T. Home Inspector Logo">
                </a>
            </div>

            <div class="actions col justify-content-end">
                <!-- Language Switcher -->
                <div class="language-switcher">
                    <a href="{{ url('lang/th') }}" class="lang-link">
                        <img src="/icon/ICON/thai.png" alt="Thai" title="ภาษาไทย">
                    </a>
                    <a href="{{ url('lang/en') }}" class="lang-link">
                        <img src="/icon/ICON/eng.png" alt="English" title="English">
                    </a>
                </div>

                <!-- Search Icon -->
                <!-- <i id="search-icon" class="fas fa-search"></i>
                <div id="search-bar" class="search-bar">
                    <input type="text" placeholder="Search..." />
                    <button onclick="searchFunction()">Search</button>
                </div> -->
                <!-- Hamburger Icon -->
                <i id="hamburger-icon" class="fas hamburger-icon full-tog fa-bars " onclick="toggleNav()"></i>
            </div>
        </div>
    </div>

    <div class="nav-links" id="nav-links">
        <ul>
            <li><a href="/" data-translate="nav.home">{{ __('header.home') }}</a>
            </li>
            <!-- <li><a href="/service" data-translate="nav.services">บริการ</a></li> -->
            <!-- Dropdown Menu -->
            <li class="dropdown">
                <a href="#a" class="menu-item" data-translate="nav.services">
                    {{ __('header.services') }} <span class="dropdown-icon"><i
                            class="fa-solid fa-caret-down"></i></span>
                </a>
                <ul class="dropdown-menu d-block">
                    <li><a href="/hinspector" >{{ __('header.hinspector') }}</a></li>
                    <li><a href="/hinterior" >{{ __('header.hinterior') }}</a></li>
                    <li><a href="/hconstruction" >{{ __('header.hconstruction') }}</a>
                    </li>
                    <li><a href="/hbutler" data-translate="nav.hbutler">{{ __('header.hbutler') }}</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#a" class="menu-item" data-translate="nav.service">
                    {{ __('header.addon_services') }} <span class="dropdown-icon"><i
                            class="fa-solid fa-caret-down"></i></span>
                </a>
                <ul class="dropdown-menu d-block">
                    <li><a href="/addon_service/app_inspector"
                            data-translate="nav.app-inspector">{{ __('header.app_inspector') }}</a></li>
                    <li><a href="/addon_service/cal_electric"
                            data-translate="nav.cal-electric">{{ __('header.cal_electric') }}</a></li>
                    <li><a href="/addon_service/checklist"
                            data-translate="nav.checklist">{{ __('header.checklist') }}</a></li>
                </ul>
            </li>
            <!-- Dropdown Menu -->
            {{-- <li class="dropdown">
                <a href="#a" class="menu-item" data-translate="nav.articles">
                    บทความ <span class="dropdown-icon"><i class="fa-solid fa-caret-down"></i></span>
                </a>
                <ul class="dropdown-menu d-block">
                    <li><a href="/article" data-translate="nav.articles">ความรู้ทั่วไป</a>
                    </li>
                    <li><a href="/review_home" data-translate="nav.reviewHome">รีวิวบ้าน</a>
                    </li>
                </ul>
            </li> --}}
            <li><a href="/article" data-translate="nav.articles">{{ __('header.articles') }}</a></li>
            <li><a href="/review" data-translate="nav.reviewHome">{{ __('header.review_home') }}</a></li>
            <li><a href="/privilege">{{ __('header.privilege') }}</a></li>
            {{-- <li><a href="/projects_media.html" data-translate="nav.projects">{{ __('header.projects') }}</a></li> --}}
            <!-- Dropdown Menu -->
            <li class="dropdown">
                <a href="#a" class="menu-item" data-translate="nav.aboutUs">
                    {{ __('header.about') }} <span class="dropdown-icon"><i class="fa-solid fa-caret-down"></i></span>
                </a>
                <ul class="dropdown-menu d-block">
                    <li><a href="/ourstory" data-translate="nav.ourStory">{{ __('header.ourstory') }}</a></li>
                    <li><a href="/ourteam" data-translate="nav.ourTeam">{{ __('header.ourteam') }}</a></li>
                </ul>
            </li>
            <li><a href="/joinwithus" data-translate="nav.joinUs">{{ __('header.joinus') }}</a></li>
            <li><a href="/contactus" data-translate="nav.contact">{{ __('header.contact') }}</a></li>
        </ul>
    </div>

    <!-- Fullscreen Navigation -->
    <div class="nav-fullscreen">
        <ul class="nav-menu">
            <li class="nav-item"><a href="/" class="nav-link">{{ __('header.home') }}</a></li>

            <li class="nav-item has-dropdown">
                <a href="#a" class="nav-link">{{ __('header.services') }}</a>
                <ul class="dropdown">
                    <li><a href="/hinspector">{{ __('header.hinspector') }}</a></li>
                    <li><a href="/hinterior">{{ __('header.hinterior') }}</a></li>
                    <li><a href="/hconstruction">{{ __('header.hconstruction') }}</a></li>
                    <li><a href="/hbutler">{{ __('header.hbutler') }}</a></li>
                </ul>
            </li>

            <li class="nav-item has-dropdown">
                <a href="#a" class="nav-link">{{ __('header.addon_services') }}</a>
                <ul class="dropdown">
                    <li><a href="/addon_service/app_inspector">{{ __('header.app_inspector') }}</a></li>
                    <li><a href="/addon_service/cal_electric">{{ __('header.cal_electric') }}</a></li>
                    <li><a href="/addon_service/checklist">{{ __('header.checklist') }}</a></li>
                </ul>
            </li>

            {{-- <li class="nav-item"><a href="/privileges" class="nav-link">{{ __('header.privileges') }}</a></li> --}}

            {{-- <li class="nav-item"><a href="/projects_media.html" class="nav-link">{{ __('header.projects') }}</a>
            </li> --}}

            <li class="nav-item"><a href="/article" class="nav-link">{{ __('header.articles') }}</a></li>
            <li class="nav-item"><a href="/review" class="nav-link">{{ __('header.review_home') }}</a></li>
            <li class="nav-item has-dropdown">
                <a href="#a" class="nav-link">{{ __('header.about') }}</a>
                <ul class="dropdown">
                    <li><a href="/ourstory">{{ __('header.ourstory') }}</a></li>
                    <li><a href="/ourteam">{{ __('header.ourteam') }}</a></li>
                </ul>
            </li>

            <li class="nav-item"><a href="/joinwithus" class="nav-link">{{ __('header.joinus') }}</a></li>
            <li class="nav-item"><a href="/contactus" class="nav-link">{{ __('header.contact') }}</a></li>
            <li class="nav-item">
                <div class="language-switcher">
                    <a href="{{ url('lang/th') }}" class="lang-link">
                        <img src="/icon/ICON/thai.png" alt="Thai" title="ภาษาไทย">
                    </a>
                    <a href="{{ url('lang/en') }}" class="lang-link">
                        <img src="/icon/ICON/eng.png" alt="English" title="English">
                    </a>
                </div>
            </li>
        </ul>
    </div>

    <script>
        const menuToggle = document.querySelector('.full-tog');
        const navbar = document.querySelector('.nav-fullscreen');
        const hamburger = document.querySelector('#hamburger-icon')

        function toggleNav() {
            navbar.classList.toggle('active');
            if (navbar.classList.contains('active')) {
                menuToggle.classList.remove('fa-bars');
                menuToggle.classList.add('fa-times');
                document.body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
            } else {
                menuToggle.classList.remove('fa-times');
                menuToggle.classList.add('fa-bars');
                document.body.style.overflow = 'auto';
            }

        }

        // Handle dropdown menus on mobile
        const dropdownItems = document.querySelectorAll('.has-dropdown');

        dropdownItems.forEach(item => {
            const link = item.querySelector('.nav-link');

            // For mobile view
            link.addEventListener('click', function(e) {
                // Only apply for mobile view
                if (window.innerWidth <= 1024) {
                    e.preventDefault();
                    item.classList.toggle('active');

                    // Close other dropdowns
                    dropdownItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.classList.remove('active');
                        }
                    });
                }
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!navbar.contains(e.target) && !menuToggle.contains(e.target) && navbar.classList.contains(
                    'active')) {
                toggleNav();
                // menuToggle.classList.remove('active');
            }
        });

        // Close mobile menu when window is resized to desktop size
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1024) {
                navbar.classList.remove('active');
                document.body.style.overflow = 'auto';

                dropdownItems.forEach(item => {
                    item.classList.remove('active');
                });
            }
        });
    </script>
</header>

<div class="navbar-blank"></div>
<script>
    const navbarContainer = document.querySelector('.navbar-container');
    const topBar = document.querySelector('.top-bar');
    const navLink = document.querySelector('.nav-links');

    let lastScrollTop = 0;

    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            // เลื่อนลง
            topBar.classList.add('hidden');
            navLink.classList.add('sticky');
        } else {
            // เลื่อนขึ้น
            topBar.classList.remove('hidden');
            navLink.classList.remove('sticky');
        }

        lastScrollTop = scrollTop;
    });
</script>


<!-- line -->
<div class="contact-container-float">
    <a id="phone-link" href="#a" class="contact-item" data-aos="fade-up-left">
        <div class="icon">
            <i class="fa-solid fa-phone"></i>
        </div>
        <span id="phone-text">โทร 02-454-2043</span>
    </a>

    <a id="line-link" href="#a" target="_blank" class="contact-item" data-aos="fade-up-right">
        <div class="icon">
            <i class="fa-brands fa-line" style="color: #00a347;"></i>
        </div>
        <span id="line-text">@t.home</span>
        {{-- <span>{{ app()->getLocale() }}</span> --}}
    </a>
</div>
