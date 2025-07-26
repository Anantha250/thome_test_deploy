@extends('layouts.layout_home')

@section('content')
    <link rel="stylesheet" href="/css/home/index.css">
    <section class="hero">
        <div class="hero-bg" id="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 id="hero-title">{{__('index.hero-title')}}</h1>
            <p id="hero-subtitle">{{__('index.hero-subtitle')}}</p>
        </div>
    </section>

    <script>
        // let texts = [{
        //         title: 'Thailand’s No.1',
        //         subtitle: 'Home Inspection Company'
        //     },
        //     {
        //         title: 'บริษัทตรวจบ้านอันดับ 1',
        //         subtitle: 'ที่ลูกค้าบอกต่อมากที่สุดในประเทศ'
        //     }
        // ];
        let bgImages = [
            '/img/hero-bg1.jpg',
            '/img/hero-bg3.jpg'
        ];
        let textIndex = 0;
        let bgIndex = 0;

        // เริ่มเปลี่ยนข้อความ + รูป
        function startHeroRotation() {
            updateHeroContent();

            setInterval(() => {
                textIndex = (textIndex + 1) % texts.length;
                bgIndex = (bgIndex + 1) % bgImages.length;
                updateHeroContent();
            }, 8000); // เปลี่ยนทุก 8 วินาที
        }

        // อัปเดตเนื้อหา Hero
        function updateHeroContent() {
            // document.getElementById('hero-title').innerHTML = texts[textIndex].title;
            // document.getElementById('hero-subtitle').innerText = texts[textIndex].subtitle;
            document.getElementById('hero-bg').style.backgroundImage = `url('${bgImages[bgIndex]}')`;
        }

        startHeroRotation();
    </script>

    {{-- <section class="services">
        <div class="services-header" data-aos="fade-up">
            <h2>บริการของเรา</h2>
        </div>
        <div class="services-grid">
            <div class="service-card" data-aos="fade-up-right">
                <div class="service-icon">
                    <a href="/hinspector">
                        <img src="/img/s1.png" alt="T. Home Inspector">
                    </a>
                </div>
                <h3>T. Home Inspector</h3>
            </div>

            <div class="service-card" data-aos="fade-up">
                <div class="service-icon">
                    <a href="/hinterior">
                        <img src="/img/s2.png" alt="T. Home Interior">
                    </a>
                </div>
                <h3>T. Home Interior</h3>
            </div>

            <div class="service-card" data-aos="fade-up">
                <div class="service-icon">
                    <a href="/hconstruction">
                        <img src="/img/s3.png" alt="T. Home Construction">
                    </a>
                </div>
                <h3>T. Home Construction</h3>
            </div>

            <div class="service-card" data-aos="fade-up-left">
                <div class="service-icon">
                    <a href="/hbutler">
                        <img src="/img/s4-bg.png" alt="Home Butler">
                    </a>
                </div>
                <h3>Home Butler</h3>
            </div>
        </div>
        <div class="wrapper" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
            <div class="inspection-info">
                <div class="info-content">
                    <h2>ตรวจบ้านต้องทำอย่างไร ?</h2>
                    <h3 data-translate="inspection-details">
                        รายละเอียดที่ต้องตกลง และเตรียมก่อนตรวจบ้าน
                    </h3>
                    <a href="/description">
                        <button data-translate="see-details">
                            <i class="fa-solid fa-eye"></i> ดูรายละเอียด
                        </button>
                    </a>
                </div>
                <div class="info-image">
                    </div>
            </div>
        </div>
    </section> --}}

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const servicesSection = document.querySelector(".services");
            const images = [
                "/img/inspector-bg.jpg",
                "/img/interior-bg.jpg",
                "/img/construction-bg.jpg",
                "/img/interior-bg.jpg"
            ]
            let index = 0;

            function changeBackground() {
                console.log("ok")
                servicesSection.style.backgroundImage = `url('${images[index]}')`;
                index = (index + 1) % images.length;
            }
            if (images.length > 0) {
                changeBackground();
                setInterval(changeBackground, 5000);
            }
        });
    </script> --}}



    <section class="services" data-aos="fade-right" data-aos-offset="200" data-aos-easing="ease-in-sine">
        <div class="services-header">
            <h2>{{__('index.services-title')}}</h2>
        </div>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <a href="/HOMESPECTOR/Homepage/service1.php">
                        <img src="/img/s1.png" alt="T. Home Inspector">
                    </a>
                </div>
                <h3>{{__('index.service1-title')}}</h3>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <a href="/HOMESPECTOR/Homepage/review_interior.php">
                        <img src="/img/s2.png" alt="T. Home Interior">
                    </a>
                </div>
                <h3>{{__('index.service2-title')}}</h3>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <a href="/HOMESPECTOR/Homepage/Hconstruction.php">
                        <img src="/img/s3.png" alt="T. Home Construction">
                    </a>
                </div>
                <h3>{{__('index.service3-title')}}</h3>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <a href="/HOMESPECTOR/Homepage/Hbulter.php">
                        <img src="/img/s4-bg.png" alt="Home Butler">
                    </a>
                </div>
                <h3>{{__('index.service4-title')}}</h3>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const servicesSection = document.querySelector(".services");

            const bgImages = [
                "/HOMESPECTOR/img/hero-bg3.jpg",
                "/HOMESPECTOR/img/inspector-bg.jpg",
                "/HOMESPECTOR/img/interior-bg.jpg",
                "/HOMESPECTOR/img/construction-bg.jpg",
            ];

            let index = 0;

            function changeBackground() {
                servicesSection.style.backgroundImage = `url(${bgImages[index]})`;
                index = (index + 1) % bgImages.length;
            }
            setInterval(changeBackground, 5000);
            changeBackground();
        });
    </script>


    <section class="why-choose-us" style="overflow: hidden;">
        <h2 class="section-title aos-init aos-animate" data-translate="why-choose-us-title" data-aos="fade-down">
            {{__('index.why-choose-us-title')}}</h2>
        <div class="content-container"><div class="text-section">
                <div class="text-item">
                    <div class="icon-box"><img src="/icon/ICON/trusted.png" alt="Trust Icon" data-aos="fade-right"
                            class="fr-fic fr-dii aos-init" style="width: 150px;"></div>
                    <div class="text-content aos-init" data-aos="fade-right">
                        <h3 data-translate="trust-title">{{__('index.trust-title')}}&nbsp;</h3>
                        <p data-translate="trust-details">{{__('index.trust-details')}}<br>
                        </p>
                    </div>
                </div>
                <div class="text-item">
                    <div class="icon-box"><img src="/icon/ICON/future.png" alt="Tech Icon" data-aos="fade-right"
                            class="fr-fic fr-dii aos-init" style="width: 148px;"></div>
                    <div class="text-content aos-init" data-aos="fade-right">
                        <h3 data-translate="tech-title">{{__('index.tech-title')}}</h3>
                        <p data-translate="tech-details">{{__('index.tech-details')}}<br>
                        </p>
                    </div>
                </div>
                <div class="text-item">
                    <div class="icon-box"><img src="/icon/ICON/group.png" alt="Team Icon" data-aos="fade-right"
                            class="fr-fic fr-dii aos-init" style="width: 203px;"></div>
                    <div class="text-content aos-init" data-aos="fade-right">
                        <h3 data-translate="team-title">{{__('index.team-title')}}</h3>
                        <p data-translate="team-details">{{__('index.team-details')}}</p>
                    </div>
                </div>
            </div><div class="image-section aos-init" data-aos="fade-up-left"><img
                    src="/img/uploads_old/1743739712_carousel2.1.jpg" alt="Example Image" class="fr-fic fr-dii"
                    loading="lazy"></div>
        </div>
        <div class="certifications aos-init" data-aos="fade-up-right">
            <div class=" certification"><img src="/img/certified1.png" alt="T. Home Inspector" class="fr-fic fr-dii">
                <p data-translate="certification1">{{__('index.certification1')}}</p>
            </div>
            <div class="certification aos-init" data-aos="fade-up-right"><img src="/img/certified2.png"
                    alt="Certified Professional Inspector" class="fr-fic fr-dii" style="width: 378px;">
                <p data-translate="certification2">{{__('index.certification2')}}</p>
            </div>
            <div class="certification aos-init" data-aos="fade-up-right"><img src="/img/certified3.png"
                    alt="Certified Professional Inspector" class="fr-fic fr-dii" style="width: 343px;">
                <p data-translate="certification3">{{__('index.certification3')}}</p>
            </div>
        </div>
    </section>
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('/backend/panel/get_why_choose_us')
                .then(res => res.json())
                .then(data => {
                    document.getElementById("why-choose-us-container").innerHTML = data.content;
                })
                .catch(err => console.error("โหลดเนื้อหาผิดพลาด:", err));
        });
    </script> --}}

    <div class="cal-container" data-aos="zoom-in-down">
        <div class="cal">
            <div class="cal-item">
                <div>
                    <h2><i class="fas fa-calculator"></i> {{__('index.calculator-title')}}</h2>
                    <p><i class="fas fa-info-circle"></i> {{__('index.calculator-description')}}
                        </p>
                    <p><i class="fas fa-check-circle"></i> {{ __('index.calculator-description2') }}
                        </p>
                    <p><i class="fas fa-phone"></i>{{ __('index.calculator-description3') }}
                        </p>
                </div>
                <div class="logo-container">
                    <img src="https://img.freepik.com/free-vector/household-HOMESPECTOR-utilities-design-concept-illustrated-consumption-accounting-energetic-water-resources-isometric-vector-illustration_98292-9053.jpg?t=st=1738919465~exp=1738923065~hmac=e56ee21aff5e511ecc26ae700c498f651b595e534afce2935ef0b8959ced7d59&w=1060"
                        alt="House Logo">
                </div>
            </div>

            <iframe class="cal-iframe" src="https://requestform.thomeinspector.com/calc/"></iframe>
        </div>

        <div class="cta-section" data-aos="fade-up">
            <h2>เริ่มต้นวางแผนระบบไฟฟ้าภายในบ้านของคุณ!</h2>
            <a href="cal-electric" class="btn">{{__('index.calculator-button')}}</a>
        </div>
    </div>



    <section class="projects" data-aos="fade-up" data-aos-duration="3000">
        <h2 class="projects-title">
            {{__('index.projects-title')}}
        </h2>
        <a href="/projects_media.html" class="btn btn-firstall">{{__('index.projects-see-all')}}</a>
        <div class="projects-grid" id="project-cards">
            </div>
    </section>

    <div class="carousel-container3 aos-init aos-animate" data-aos="fade-up" data-aos-anchor-placement="top-center">
        <div class="carousel-header3">
            <h2 class="carousel-title3">Content</h2>
            <a href="/Homepage/content.php" class="btn btn-all">{{__('index.see-all-articles')}}</a>
        </div>

        <div class="carousel3">
            <div class="carousel-slides3" id="carousel-slides">
                <div class="carousel-slide3 active">
                    <img src="/img/thumbnail4.jpg" alt="Feature 1">
                    <div class="slide-content3">
                        <h3>รีวิวตรวจบ้านดารา เซเลบ อินฟลู</h3>
                        <p>6 EPISODES</p>
                        <p>รีวิวการตรวจบ้านเดี่ยว พระเอกดัง!! " ตงตง เดอะสตาร์</p>
                        <a href="https://youtube.com/playlist?list=PLIwtiszxFa5g36GIhC4Iso1UpleYvXZ5s&si=reJz6hajDkFxSJD5" class="btn">{{__('index.see-all-articles')}}</a>
                    </div>
                </div>
                <div class="carousel-slide3">
                    <img src="/img/uploads_old/carousel_thumb1.jpg" alt="Feature 2">
                    <div class="slide-content3">
                        <h3>ต.ตรวจบ้าน x การตลาดวันละตอน</h3>
                        <p>5 EPISODES</p>
                        <p>พาดูบ้านหรู 89 ล้าน! แกรนด์ บางกอก บูเลอวาร์ด ยาร์ด บางนา</p>
                        <a href="https://www.youtube.com/playlist?list=PLIwtiszxFa5h-0SPx3aPGRdiUNyEa5UDg" class="btn">{{__('index.see-all-articles')}}</a>
                    </div>
                </div>
                <div class="carousel-slide3">
                    <img src="/img/uploads_old/thumbnail3.jpg" alt="Feature 3">
                    <div class="slide-content3">
                        <h3>สุดพิเศษ! พาดูบ้านหรู</h3>
                        <p>3 EPISODES</p>
                        <p>รีวิวตรวจบ้านหรู 40ล้าน! CEO #บุญนําพา</p>
                        <a href="https://www.youtube.com/playlist?list=PLIwtiszxFa5gZ0OZsERmV-FISAeNtZNxn" class="btn">{{__('index.see-all-articles')}}</a>
                    </div>
                </div>
                <div class="carousel-slide3">
                    <img src="/img/carousel_thumb2.jpg" alt="Feature 4">
                    <div class="slide-content3">
                        <h3>ตรวจบ้านก่อนโอน by ต.ตรวจบ้าน</h3>
                        <p>6 EPISODES</p>
                        <p>ตรวจบ้านก่อนโอน by ต.ตรวจบ้าน...🏡⛈️</p>
                        <a href="https://youtube.com/playlist?list=PLIwtiszxFa5hs10MSBr6L3Egom5r0F47j&si=FXvKwpMBhXNS09tO" class="btn">{{__('index.see-all-articles')}}</a>
                    </div>
                </div>
                <div class="carousel-slide3">
                    <img src="/img/warentty.jpg" alt="Feature 5">
                    <div class="slide-content3">
                        <h3>ประกันภัยบ้าน แฮปปี้โฮม ธนชาต</h3>
                        <p>8 EPISODES</p>
                        <p>ช่วงนี้หน้าฝน อย่ามองข้ามสิ่งนี้🏡⛈️</p>
                        <a href="https://www.youtube.com/playlist?list=PLIwtiszxFa5jKepWmlTC4FK7aK4bvcER1" class="btn">{{__('index.see-all-articles')}}</a>
                    </div>
                </div>
                <div class="carousel-slide3">
                    <img src="/img/team_thumb.jpg" alt="Feature 6">
                    <div class="slide-content3">
                        <h3>สนุก มันส์ ฮา กับช่างตรวจ</h3>
                        <p>10 EPISODES</p>
                        <p>สนุก มันส์ ฮา กับช่างตรวจ</p>
                        <a href="https://youtube.com/playlist?list=PLIwtiszxFa5g7IvwysRH4hXO0dJjoRFWn&si=3wzVLweorZkdnvs2" class="btn">{{__('index.see-all-articles')}}</a>
                    </div>
                </div>
            </div>

            <div class="carousel-thumbnails" id="carousel-thumbnails">
                <button class="prev-btn" onclick="changeSlide(-1)">&lt;</button>
                <div class="thumbnail active" onclick="showSlide(0)"><img src="/img/thumbnail4.jpg" alt="Thumb 1">
                </div>
                <div class="thumbnail" onclick="showSlide(1)"><img src="/img/uploads_old/carousel_thumb1.jpg"
                        alt="Thumb 2"></div>
                <div class="thumbnail" onclick="showSlide(2)"><img src="/img/uploads_old/thumbnail3.jpg" alt="Thumb 3">
                </div>
                <div class="thumbnail" onclick="showSlide(3)"><img src="/img/carousel_thumb2.jpg" alt="Thumb 4"></div>
                <div class="thumbnail" onclick="showSlide(4)"><img src="/img/uploads_old/warentty.jpg" alt="Thumb 5">
                </div>
                <div class="thumbnail" onclick="showSlide(5)"><img src="/img/uploads_old/team_thumb.jpg" alt="Thumb 6">
                </div><button class="next-btn" onclick="changeSlide(1)">&gt;</button>
            </div>
        </div>
    </div>

    <script>
        let currentSlide = 0;

        function showSlide(index) {
            const slides = document.querySelectorAll('.carousel-slide3');
            const thumbnails = document.querySelectorAll('.thumbnail');
            let totalSlides = thumbnails.length;

            console.log('before', slides, thumbnails)
            if (index < 0) index = totalSlides - 1;
            if (index >= totalSlides) index = 0;
            currentSlide = index;
            console.log('id :', index)
            slides.forEach((slide, i) => {
                if (i == index)
                    slide.classList.add('active');
                else if (slide.classList.contains('active'))
                    slide.classList.remove('active');
            });

            thumbnails.forEach((thumb, i) => {
                if (i == index)
                    thumb.classList.add('active');
                else if (thumb.classList.contains('active'))
                    thumb.classList.remove('active');;
            });
            console.log('after ', slides, thumbnails)
        }

        function changeSlide(step) {
            showSlide(currentSlide + step);
        }

        //     fetch("/backend/panel/fetch_content_carousel")
        //         .then(res => res.json())
        //         .then(data => {
        //             const slidesContainer = document.getElementById("carousel-slides");
        //             const thumbnailsContainer = document.getElementById("carousel-thumbnails");

        //             data.forEach((item, index) => {
        //                 // Slide
        //                 const slide = document.createElement("div");
        //                 slide.className = "carousel-slide3" + (index === 0 ? " active" : "");
        //                 slide.innerHTML = `
    //                 <img src="${item.image_url}" alt="Feature ${index + 1}">
    //                 <div class="slide-content3">
    //                     <h3>${item.title}</h3>
    //                     <p>${item.episodes}</p>
    //                     <p>${item.description}</p>
    //                     <a href="${item.link_url}" class="btn">ดูทั้งหมด</a>
    //                 </div>
    //                 `;
        //                 slidesContainer.appendChild(slide);

        //                 // Thumbnail
        //                 const thumb = document.createElement("div");
        //                 thumb.className = "thumbnail" + (index === 0 ? " active" : "");
        //                 thumb.setAttribute("onclick", `showSlide(${index})`);
        //                 thumb.innerHTML = `<img src="${item.thumbnail_url}" alt="Thumb ${index + 1}">`;
        //                 thumbnailsContainer.insertBefore(thumb, thumbnailsContainer.querySelector(".next-btn"));
        //             });

        //             totalSlides = data.length;
        //         });
        //
    </script>

    <section class="articles" data-aos="fade-up" data-aos-delay="100">
        <h2 class="articles-title">{{__('index.latest-articles-title')}}</h2>
        <a href="/article" class="btn btn-firstall">{{__('index.see-all-articles')}}</a>
        <div class="review-cards">
            @if (isset($latestArticles) && count($latestArticles) > 0)
                @foreach ($latestArticles as $article)
                    <div class="new-card">
                        <a href="/article/detail?news_id={{ $article->id }}"><img
                                src="{{ $article->translation->coverPageImg }}" alt="" loading="lazy"></a>
                        <a href="/article/detail?news_id={{ $article->id }}"
                            class="new-card-title">{{ $article->translation->title }}</a>
                        <div class="new-card-tags">
                            @foreach ($article->tags as $tag)
                                <a href="/article?tag={{ $tag->name }}">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                        <div>
                            <span
                                class="upload-date">{{ \Carbon\Carbon::parse($article->created_at)->locale(app()->getlocale())->isoFormat('D-MM-YYYY') }}
                            </span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

    <div class="container-newapp aos-init aos-animate" data-aos="fade-up" data-aos-duration="3000">
        <div class="header-newapp">
            <h1>New</h1>
            <h2>{{__('index.newapp-title')}}</h2>
            <p>{{__('index.newapp-description')}}</p>
        </div>
        <div class="content-newapp">
            <div class="app-preview">
                <img src="/img/app1.png" alt="App Preview 1">
                <img src="/img/app2.png" alt="App Preview 2">
            </div>
            <div class="main-btn">
                <button>
                    <a href="https://liff.line.me/2005695449-36Xrdj94">{{__('index.newapp-button')}}</a>
                </button>
            </div>
        </div>
    </div>



    <section class="stats-section" id="stats-section">
        <div class="content-wrapper">
            <div class="text-content">
                <p class="section-subtitle" id="review-subtitle">Please wait...</p>
            </div>
            <div class ="trustindex">
                <script defer async src='https://cdn.trustindex.io/loader.js?5ed29ff45a93626df0964d775e4'></script>
            </div>
            <div class="trustindex data-widget-id=5ed29ff45a93626df0964d775e4" data-elfsight-app-lazy></div>

            <div class="insight-metrics animate-text delay-3">
                <div class="metric-box">
                    <span class="metric-number" data-target="{{ $var['dev'] }}"></span><span class="metric-unit">developer</span>
                    <p class="metric-label">ตรวจบ้านมาแล้วกว่า</p>
                </div>
                <div class="metric-box">
                    <span class="metric-number" data-target="{{ $var['project'] }}"></span><span class="metric-unit">โครงการ</span>
                    <p class="metric-label">ตรวจบ้านมาแล้วกว่า</p>
                </div>
                <div class="metric-box">
                    <span class="metric-number" data-target="{{ $var['house'] }}"></span><span class="metric-unit">หลัง</span>
                    <p class="metric-label">ตรวจบ้านมาแล้วกว่า</p>
                </div>
                <div class="metric-box">
                    <span class="metric-number" data-target="{{ $var['satisfaction'] }}"></span><span class="metric-unit">%</span>
                    <p class="metric-label">ความพึงพอใจ</p>
                </div>

                <div class="metrics-extra" id="stats-container"></div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const counters = document.querySelectorAll('.metric-number');

                    const runCounter = (counter) => {
                        const target = +counter.getAttribute('data-target');
                        const duration = 1500; // ms
                        const stepTime = Math.max(Math.floor(duration / target), 10);
                        let current = 0;

                        const timer = setInterval(() => {
                            current += Math.ceil(target / (duration / stepTime));
                            if (current >= target) {
                                counter.textContent = target;
                                clearInterval(timer);
                            } else {
                                counter.textContent = current;
                            }
                        }, stepTime);
                    };

                    // Optional: Run when in viewport
                    const observer = new IntersectionObserver((entries, obs) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                runCounter(entry.target);
                                obs.unobserve(entry.target); // Run once
                            }
                        });
                    }, {
                        threshold: 0.5
                    });

                    counters.forEach(counter => observer.observe(counter));
                });
            </script>


    </section>

    <section class="faq" id="faq">
        <div class="faq-container">
            <h1 class="faq-title">{{__('index.faq-title')}}</h1>
            <div class="faq-content">
                <aside class="faq-menu">
                    <ul id="faq-category-list">
                        <li class="active" data-category="all" onclick="filterFAQ('all')">{{__('index.faq-category-all')}}</li>
                    </ul>
                </aside>

                <div class="faq-questions" id="faq-content">

                    @if (isset($faqs) && count($faqs) > 0)
                        @foreach ($faqs as $faq)
                            <div> {{ $faq->translation->question }}</div>
                            <div> {{ $faq->translation->answer }}</div>
                            <div>
                                @foreach ($faq->tags as $tag)
                                    <div> {{ $tag->name }}</div>
                                @endforeach
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <script>
            function slugify(str) {
                return str.toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '');
            }

            function toggleAnswer(button) {
                const answer = button.nextElementSibling;
                const icon = button.querySelector(".icon");
                const isVisible = answer.style.display === "block";
                answer.style.display = isVisible ? "none" : "block";
                icon.textContent = isVisible ? "+" : "−";
            }

            function filterFAQ(category) {
                document.querySelectorAll("#faq-category-list li").forEach(li => li.classList.remove("active"));
                document.querySelector(`#faq-category-list li[data-category="${category}"]`)?.classList.add("active");

                document.querySelectorAll(".faq-item").forEach(item => {
                    item.style.display = category === "all" || item.getAttribute("data-category") === category ?
                        "block" : "none";
                });
            }

            // Fetch FAQs
            window.addEventListener("DOMContentLoaded", () => {
                const faqs = @json($faqs);
                const categories = new Set();
                const faqContent = document.getElementById("faq-content");
                const categoryList = document.getElementById("faq-category-list");
                faqContent.innerHTML = "";

                const grouped = {};
                faqs.forEach(faq => {
                    faq.tags.forEach(cat => {
                        categories.add(cat.name);
                        if (!grouped[cat.name]) grouped[cat.name] = [];
                        grouped[cat.name].push(faq);
                    })
                });

                categories.forEach(cat => {
                    const li = document.createElement("li");
                    li.textContent = cat;
                    li.setAttribute("data-category", cat);
                    li.onclick = () => filterFAQ(cat);
                    categoryList.appendChild(li);
                });

                for (const cat in grouped) {
                    grouped[cat].forEach(faq => {
                        const item = document.createElement("div");
                        item.className = "faq-item";
                        item.setAttribute("data-category", cat);
                        item.innerHTML = `
                                <button class="faq-question" onclick="toggleAnswer(this)">
                                    <span class="icon">+</span>
                                    <span class="question-text">${faq.translation.question}</span>
                                </button>
                                <div class="faq-answer"><p>${faq.translation.answer}</p></div>
                                `;
                        faqContent.appendChild(item);
                    });
                }


                filterFAQ("all");
            });
        </script>
    </section>


    <section class="elfsight" data-aos="fade-up">
        <h1>Facebook</h1>

        <div class="trustindex-widget" data-widget-id="d4242bb455c262618f46fda8250"></div>
    </section>

    <script defer async src='https://cdn.trustindex.io/loader-feed.js?d4242bb455c262618f46fda8250'></script>
    <script></script>
@endsection
