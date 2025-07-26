@extends('layouts.layout_home  ')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <link rel="stylesheet" href="/css/home/service/Hbutler.css">


    <section id="home" class="hero">
        <div class="hero-bg-animation">
            <div class="shape shape1"></div>
            <div class="shape shape2"></div>
            <div class="shape shape3"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-text reveal-left">
                    <img src="/img/s4-bg.png" alt="Home Butler Logo" class="hero-logo" />
                    <h1 class="gradient-text">โฮมบัตเลอร์ ผู้ช่วยดูแลบ้านครบวงวร</h1>
                    <h2>ครอบคลุมทุกบริการ " เรื่องบ้าน "</h2>
                    <p>บริการดูแลบ้านระดับพรีเมียม ที่จะทำให้ชีวิตคุณสะดวกสบายยิ่งขึ้น
                        ด้วยทีมงานมืออาชีพที่พร้อมให้บริการตลอด 24 ชั่วโมง</p>
                    <div class="hero-buttons">
                        <a href="#services" class="btn btn-primary btn-lg with-icon">
                            <span>ค้นหาบริการ</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="#how-it-works" class="btn btn-secondary btn-lg with-icon">
                            <span>วิธีใช้งาน</span>
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="hero-image reveal-right">
                <div class="image-container">
                    <img src="/img/homeb2.jpg" alt="Home Butler Service">
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

    <section id="services" class="services">
        <div class="container-homebutler">
            <div class="section-header">
                <span class="section-subtitle">บริการของเรา</span>
                <h2 class="section-title">บริการครบวงจรสำหรับบ้านของคุณ</h2>
                <p class="section-description">เราพร้อมให้บริการดูแลบ้านของคุณอย่างมืออาชีพ
                    ด้วยทีมงานที่ผ่านการคัดเลือกและฝึกอบรมมาอย่างดี</p>
            </div>

            <div class="services-grid">
                <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-icon">
                        <i class="fas fa-broom"></i>
                    </div>
                    <div class="service-content">
                        <h3>ทำความสะอาดบ้าน</h3>
                        <p>บริการทำความสะอาดบ้านแบบครบวงจร ทั้งรายวัน รายสัปดาห์ และรายเดือน
                            ด้วยอุปกรณ์และน้ำยาคุณภาพสูง</p>
                        <a href="#" class="service-link">
                            <span>รายละเอียดเพิ่มเติม</span>
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                </div>

                <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="service-content">
                        <h3>ซ่อมแซมบ้าน</h3>
                        <p>บริการซ่อมแซมอุปกรณ์ไฟฟ้า ประปา และโครงสร้างบ้านโดยช่างผู้เชี่ยวชาญ พร้อมรับประกันผลงาน
                        </p>
                        <a href="#" class="service-link">
                            <span>รายละเอียดเพิ่มเติม</span>
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                </div>

                <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <div class="service-content">
                        <h3>ดูแลสวน</h3>
                        <p>บริการจัดสวน ตัดหญ้า และดูแลต้นไม้โดยทีมงานมืออาชีพ ช่วยให้สวนของคุณสวยงามตลอดทั้งปี</p>
                        <a href="#" class="service-link">
                            <span>รายละเอียดเพิ่มเติม</span>
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                </div>

                <div class="service-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="service-content">
                        <h3>ระบบความปลอดภัย</h3>
                        <p>ติดตั้งและดูแลระบบรักษาความปลอดภัยบ้านแบบสมาร์ทโฮม ควบคุมผ่านแอปพลิเคชันได้ทุกที่ทุกเวลา
                        </p>
                        <a href="#" class="service-link">
                            <span>รายละเอียดเพิ่มเติม</span>
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                </div>

                <div class="service-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-icon">
                        <i class="fas fa-couch"></i>
                    </div>
                    <div class="service-content">
                        <h3>ทำความสะอาดเฟอร์นิเจอร์</h3>
                        <p>บริการทำความสะอาดเฟอร์นิเจอร์ โซฟา พรม และม่าน ด้วยเทคโนโลยีและน้ำยาที่ปลอดภัยต่อสุขภาพ
                        </p>
                        <a href="#" class="service-link">
                            <span>รายละเอียดเพิ่มเติม</span>
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                </div>

                <div class="service-card" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-icon">
                        <i class="fas fa-snowflake"></i>
                    </div>
                    <div class="service-content">
                        <h3>ล้างแอร์และซ่อมบำรุง</h3>
                        <p>บริการล้างแอร์ ซ่อมบำรุง และติดตั้งเครื่องปรับอากาศทุกรุ่น ทุกยี่ห้อ โดยช่างผู้เชี่ยวชาญ
                        </p>
                        <a href="#" class="service-link">
                            <span>รายละเอียดเพิ่มเติม</span>
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="services-cta">
                <a href="#" class="btn btn-primary btn-lg">ดูบริการทั้งหมด</a>
            </div>
        </div>
    </section>

    <section id="how-it-works" class="how-it-works">
        <div class="container-homebutler">
            <div class="section-header">
                <span class="section-subtitle">วิธีการใช้บริการ</span>
                <h2 class="section-title">ขั้นตอนง่ายๆ เพียง 4 ขั้นตอน</h2>
                <p class="section-description">เพียงไม่กี่คลิก คุณก็สามารถจองบริการและรับบริการได้อย่างสะดวกรวดเร็ว
                </p>
            </div>

            <div class="steps-container">
                <div class="steps-timeline">
                    <div class="timeline-line"></div>
                </div>

                <div class="steps">
                    <div class="step" data-aos="fade-right">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h3>เลือกบริการ</h3>
                            <p>เลือกบริการที่คุณต้องการจากรายการบริการของเรา</p>
                        </div>
                    </div>

                    <div class="step" data-aos="fade-left">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h3>นัดหมาย</h3>
                            <p>เลือกวันและเวลาที่สะดวกสำหรับคุณผ่านระบบนัดหมายออนไลน์</p>
                        </div>
                    </div>

                    <div class="step" data-aos="fade-right">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h3>ชำระเงิน</h3>
                            <p>ชำระเงินผ่านช่องทางที่สะดวกสำหรับคุณ ทั้งบัตรเครดิต โอนเงิน หรือชำระเงินปลายทาง</p>
                        </div>
                    </div>

                    <div class="step" data-aos="fade-left">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h3>รับบริการ</h3>
                            <p>ทีมงานมืออาชีพของเราจะมาให้บริการตามที่นัดหมาย พร้อมรับประกันความพึงพอใจ</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="how-it-works-cta">
                <a href="#" class="btn btn-primary btn-lg">เริ่มใช้บริการเลย</a>
            </div>
        </div>
    </section>


    <section class="app-showcase">
        <div class="container-homebutler">
            <div class="app-content">
                <div class="app-text" data-aos="fade-right">
                    <span class="section-subtitle">แอปพลิเคชัน</span>
                    <h2 class="section-title">จองบริการง่ายๆ ผ่านแอปพลิเคชันLine</h2>
                    <p>ดาวน์โหลดแอปพลิเคชันLine เพื่อจองบริการ ติดตามสถานะ และรับโปรโมชันพิเศษได้ทุกที่ทุกเวลา</p>

                    <ul class="app-features">
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>จองบริการได้ตลอด 24 ชั่วโมง</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>ติดตามสถานะงานแบบเรียลไทม์</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>ชำระเงินออนไลน์ได้หลายช่องทาง</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>รับโปรโมชันพิเศษจากทางเรา</span>
                        </li>
                    </ul>

                    <div class="app-download">
                        <a href="https://line.me/download" class="app-btn">
                            <i class="fab fa-apple"></i>
                            <span>
                                <small>ดาวน์โหลดบน</small>
                                App Store
                            </span>
                        </a>
                        <a href="https://line.me/download" class="app-btn">
                            <i class="fab fa-google-play"></i>
                            <span>
                                <small>ดาวน์โหลดบน</small>
                                Google Play
                            </span>
                        </a>
                    </div>
                </div>

                <div class="app-image" data-aos="fade-left">
                    <img src="/img/lineb3.png" alt="Home Butler App">
                </div>
            </div>
        </div>
    </section>

    <!-- <div class="hero-stats animate-text delay-3">
                        <div class="stat">
                            <span class="counter" data-target="1250">1250</span><span>+</span>
                            <p>ตรวจบ้านมาแล้วกว่า</p>
                        </div>
                        <div class="stat">
                            <span class="counter" data-target="99.9">99.9</span><span>%</span>
                            <p>ความพึงพอใจ</p>
                        </div>
                        <div class="stat">
                            <span class="counter" data-target="10">10</span><span>+ปี</span>
                            <p>ประสบการณ์กว่า</p>
                        </div> -->
    <!-- <div class="hero-image animate-fade-in">
                    <div class="image-container">
                        <img src="https://www.thomeinspector.com/assets/upload/flora/6b65378f16b42ccd06773094898e35e043d6bc67.png" alt="Modern home inspection">
                    </div>
                </div> -->

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

    <!-- Our Services Section -->
    <!-- <section class="services" data-aos="fade-up" data-aos-anchor-placement="top-center">
                    <div class="service-container">

                        <div class="image-container">
                            <div class="image-box">
                                <div class="image-bg"></div>
                                <img src="/img/homebultter-bg.JPG" alt="Home Inspection">
                            </div>
                            <div class="call-box">
                                <i class="fa-solid fa-phone"></i> 082-045-6165
                            </div>
                        </div>


                        <div class="text-container">
                            <h2 class="main-title">ต. ตรวจบ้าน รับตรวจรับบ้านและคอนโดก่อนโอนกรรมสิทธิ์</h2>
                            <p class="description">
                                ทำไมต้องเลือกเรา "ตรวจจริง เห็นกับตา ไปพร้อมลูกค้า" ตรวจบ้านและคอนโดโดยใช้อุปกรณ์จริง
                                (ไม่ได้ตรวจสอบด้วยตาเปล่า) และเทคโนโลยีที่ทันสมัย
                            </p>

                            <h2 class="contact-title">Requesting Services on the Telephone</h2>
                            <p><i class="fa-solid fa-user-tie"></i> 082-045-6165, 02-301-0283</p>
                            <p><i class="fa-solid fa-user"></i> 082-669-9666</p>
                            <p><i class="fa-solid fa-user"></i> 086-500-0019</p>
                            <p><i class="fa-solid fa-location-dot"></i> 2043 Soi Kanchanaphisek 008, Bangkae, Bangkae
                                Bangkok 10160 Thailand</p>


                            <div class="social-icons">
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
                        </div>
                    </div>
                </section>


                <section class="carousel2 py-4" data-aos="fade-up" data-aos-duration="3000">
                    <div id="customCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <div class="carousel-content mx-auto text-center">
                                    <div class="carousel-heading">ราคาค่าบริการตรวจบ้านทาวน์โฮม</div>
                                    <img src="/img/servicecharge1.png" alt="Service Pricing 1"
                                        class="img-fluid">
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-content mx-auto text-center">
                                    <div class="carousel-heading">ราคาค่าบริการตรวจบ้านทาวน์โฮม</div>
                                    <img src="/img/servicecharge2.png" alt="Service Pricing 2"
                                        class="img-fluid">
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-content mx-auto text-center">
                                    <div class="carousel-heading">ราคาค่าบริการตรวจบ้านทาวน์โฮม</div>
                                    <img src="/img/servicecharge3.png" alt="Service Details" class="img-fluid">
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-content mx-auto text-center">
                                    <div class="carousel-heading">ราคาค่าบริการตรวจบ้านทาวน์โฮม</div>
                                    <img src="/img/servicecharge4.png" alt="Service Details" class="img-fluid">
                                </div>
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#customCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"
                                style="background-color: rgba(0, 0, 0, 0.5); border-radius: 50%; width: 40px; height: 40px;"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#customCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"
                                style="background-color: rgba(0, 0, 0, 0.5); border-radius: 50%; width: 40px; height: 40px;"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </section> -->

    <!-- 🏠 Services Section -->
    {{-- <section class="services">
            <div class="services container">
                <div class="service-content">
                    //<?php echo $row_services['content']; ?>
                </div>
            </div>
        </section> --}}

    <!-- 🎞️ Carousel Section -->
    {{-- <section class="carousel2 py-4">
            <div class="carousel slide">
                <div class="carousel-inner">
                    ?php echo $row_carousel['content']; ?>
                </div>
                <!-- Previous Button -->
                <button class="carousel-control-prev" type="button" data-bs-target="#customCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"
                        style="background-color: rgba(0, 0, 0, 0.5); border-radius: 50%; width: 40px; height: 40px;"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <!-- Next Button -->
                <button class="carousel-control-next" type="button" data-bs-target="#customCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"
                        style="background-color: rgba(0, 0, 0, 0.5); border-radius: 50%; width: 40px; height: 40px;"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section> --}}


    <script src="/JS/Toggle_Navbar.js"></script>
    <script src="/JS/dropdown.js"></script>
    <script src="/JS/carousel.js"></script>
    <script src="/JS/carousel2.js"></script>
    <script src="/JS/carousel5.js"></script>
    <script src="/JS/search_ham.js"></script>
    <script src="/JS/footer.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection
