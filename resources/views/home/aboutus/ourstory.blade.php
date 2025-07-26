@extends('layouts.layout_home')

@section('content')
    <style>
        :root {
            --primary-blue: #2563eb;
            --light-blue: #3b82f6;
            --sky-blue: #0ea5e9;
            --blue-50: #eff6ff;
            --blue-100: #dbeafe;
            --blue-200: #bfdbfe;
            --blue-600: #2563eb;
            --blue-700: #1d4ed8;
            --blue-800: #1e40af;
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Sarabun', sans-serif;
            line-height: 1.6;
            color: var(--gray-700);
            background: var(--white);
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Floating Elements */
        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .floating-element {
            position: absolute;
            font-size: 2rem;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) { top: 10%; left: 10%; animation-delay: 0s; }
        .floating-element:nth-child(2) { top: 20%; right: 10%; animation-delay: 1s; }
        .floating-element:nth-child(3) { top: 60%; left: 5%; animation-delay: 2s; }
        .floating-element:nth-child(4) { bottom: 20%; right: 15%; animation-delay: 3s; }
        .floating-element:nth-child(5) { bottom: 10%; left: 20%; animation-delay: 4s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        /* Hero Section */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--blue-50) 0%, var(--white) 50%, var(--blue-100) 100%);
            overflow: hidden;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .hero-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary-blue), var(--sky-blue));
            opacity: 0.1;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            top: -150px;
            right: -150px;
            animation: pulse 4s ease-in-out infinite;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            bottom: -100px;
            left: -100px;
            animation: pulse 4s ease-in-out infinite 2s;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            top: 50%;
            left: 10%;
            animation: pulse 4s ease-in-out infinite 1s;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.1; }
            50% { transform: scale(1.1); opacity: 0.2; }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--white);
            color: var(--primary-blue);
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: var(--shadow-lg);
            margin-bottom: 2rem;
            border: 2px solid var(--blue-100);
        }

        .badge-icon {
            font-size: 1.2rem;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.1;
        }

        .title-line {
            display: block;
            color: var(--gray-700);
        }

        .title-highlight {
            display: block;
            background: linear-gradient(45deg, var(--primary-blue), var(--sky-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--gray-600);
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Section Styles */
        section {
            padding: 100px 0;
            position: relative;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--blue-50);
            color: var(--primary-blue);
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            border: 1px solid var(--blue-200);
        }

        .section-title {
            font-size: 3rem;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--gray-600);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Story Section */
        .story-section {
            background: var(--gray-50);
        }

        .story-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .story-timeline {
            position: relative;
        }

        .story-timeline::before {
            content: '';
            position: absolute;
            left: 30px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--blue-200);
        }

        .timeline-item {
            position: relative;
            padding-left: 80px;
            margin-bottom: 3rem;
        }

        .timeline-year {
            position: absolute;
            left: 0;
            top: 0;
            width: 60px;
            height: 60px;
            background: var(--primary-blue);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: var(--shadow-lg);
        }

        .timeline-content h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 0.5rem;
        }

        .timeline-content p {
            color: var(--gray-600);
            line-height: 1.6;
        }

        .story-visual {
            position: relative;
        }

        .story-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--gray-100);
        }

        .card-image {
            height: 300px;
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-content {
            padding: 2rem;
        }

        .card-content h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 1rem;
        }

        .card-content p {
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .card-features {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--blue-50);
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.9rem;
            color: var(--primary-blue);
            font-weight: 500;
        }

        /* Vision Section */
        .vision-section {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--sky-blue) 100%);
            color: var(--white);
        }

        .vision-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        .card-header {
            margin-bottom: 2rem;
        }

        .header-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .vision-text {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1.5rem;
        }

        .grid-item {
            text-align: center;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .item-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .item-text {
            font-weight: 600;
        }

        /* Values Section */
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .value-card {
            background: var(--white);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--gray-100);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .value-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(45deg, var(--primary-blue), var(--sky-blue));
        }

        .value-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
        }

        .card-header {
            margin-bottom: 1.5rem;
        }

        .card-icon {
            width: 80px;
            height: 80px;
            background: var(--blue-50);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            border: 2px solid var(--blue-100);
        }

        .icon-symbol {
            font-size: 2rem;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 1rem;
        }

        .card-description {
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .feature-point {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray-600);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        /* Founders Section */
        .founders-section {
            background: var(--gray-50);
        }

        .founders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 3rem;
        }

        .founder-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--gray-100);
            transition: all 0.3s ease;
        }

        .founder-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .founder-image {
            position: relative;
            height: 300px;
            overflow: hidden;
        }

        .founder-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 30%;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.7) 100%);
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 1rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .founder-card:hover .image-overlay {
            opacity: 1;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            transform: scale(1.1);
            background: var(--primary-blue);
            color: var(--white);
        }

        .founder-info {
            padding: 2rem;
        }

        .founder-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 0.5rem;
        }

        .founder-title {
            color: var(--primary-blue);
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .founder-subtitle {
            color: var(--gray-500);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .founder-achievements {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .achievement-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray-600);
            font-size: 0.9rem;
        }

        .achievement-icon {
            font-size: 1rem;
        }

        /* Commitment Section */
        .commitment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .commitment-item {
            background: var(--white);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--gray-100);
            transition: all 0.3s ease;
        }

        .commitment-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .commitment-item .item-icon {
            width: 60px;
            height: 60px;
            background: var(--blue-50);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            border: 2px solid var(--blue-100);
        }

        .commitment-item .icon-symbol {
            font-size: 1.5rem;
        }

        .commitment-item .item-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 1rem;
        }

        .commitment-item .item-description {
            color: var(--gray-600);
            line-height: 1.6;
        }

        /* Motto Section */
        .motto-section {
            text-align: center;
        }

        .motto-card {
            background: linear-gradient(135deg, var(--primary-blue), var(--sky-blue));
            color: var(--white);
            padding: 3rem;
            border-radius: 20px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: var(--shadow-xl);
        }

        .motto-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .motto-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .motto-text {
            font-size: 1.25rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }

        .motto-decoration {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .decoration-line {
            width: 50px;
            height: 2px;
            background: rgba(255, 255, 255, 0.5);
        }

        .decoration-dot {
            width: 8px;
            height: 8px;
            background: var(--white);
            border-radius: 50%;
        }

        /* Footer */
        .footer {
            background: var(--gray-800);
            color: var(--white);
            padding: 3rem 0 1rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-bottom: 2rem;
        }

        .footer-brand {
            max-width: 400px;
        }

        .footer-logo {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .footer-description {
            color: var(--gray-300);
            line-height: 1.6;
        }

        .footer-links {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .group-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--white);
        }

        .footer-link {
            display: block;
            color: var(--gray-300);
            text-decoration: none;
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: var(--primary-blue);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid var(--gray-700);
            color: var(--gray-400);
        }

        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            background: var(--primary-blue);
            color: var(--white);
            border: none;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
            z-index: 1000;
        }

        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            background: var(--blue-700);
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .story-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .values-grid,
            .founders-grid,
            .commitment-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .footer-links {
                grid-template-columns: 1fr;
            }

            section {
                padding: 60px 0;
            }

            .container {
                padding: 0 15px;
            }
        }

        /* Animation Classes */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .slide-in-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.6s ease;
        }

        .slide-in-left.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .slide-in-right {
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.6s ease;
        }

        .slide-in-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .scale-in {
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.6s ease;
        }

        .scale-in.visible {
            opacity: 1;
            transform: scale(1);
        }
    </style>

    <!-- Floating Elements -->
    <div class="floating-elements">
        <div class="floating-element" data-speed="0.5">🏠</div>
        <div class="floating-element" data-speed="0.3">🔍</div>
        <div class="floating-element" data-speed="0.7">⭐</div>
        <div class="floating-element" data-speed="0.4">🛡️</div>
        <div class="floating-element" data-speed="0.6">🔧</div>
    </div>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-background">
            <div class="hero-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
            </div>
        </div>
        <div class="container">
            <div class="hero-content fade-in">
                <div class="hero-badge">
                    <span class="badge-icon">🏆</span>
                    <span class="badge-text">ผู้นำอันดับ 1</span>
                </div>
                <h1 class="hero-title">
                    <span class="title-line">ผู้นำด้าน</span>
                    <span class="title-highlight">การตรวจบ้าน</span>
                </h1>
                <p class="hero-subtitle">บริการตรวจสอบบ้านที่ลูกค้าเชื่อถือมากที่สุดในประเทศไทย</p>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section" id="story">
        <div class="container">
            <div class="section-header fade-in">
                <div class="section-badge">
                    <span class="badge-icon">📖</span>
                    <span class="badge-text">เรื่องราวของเรา</span>
                </div>
                <h2 class="section-title">OUR STORY</h2>
                <p class="section-subtitle">การเดินทางสู่ความเป็นผู้นำด้านการตรวจบ้าน</p>
            </div>
            <div class="story-content">
                <div class="story-timeline slide-in-left">
                    <div class="timeline-item">
                        <div class="timeline-year">2015</div>
                        <div class="timeline-content">
                            <h3>จุดเริ่มต้น</h3>
                            <p>เริ่มต้นจากการตรวจบ้านให้กับเพื่อนและครอบครัว</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2018</div>
                        <div class="timeline-content">
                            <h3>การเติบโต</h3>
                            <p>ขยายบริการและได้รับการบอกต่อจากลูกค้า</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2023</div>
                        <div class="timeline-content">
                            <h3>ผู้นำตลาด</h3>
                            <p>กลายเป็นผู้นำด้านการตรวจบ้านในประเทศไทย</p>
                        </div>
                    </div>
                </div>
                <div class="story-visual slide-in-right">
                    <div class="story-card">
                        <div class="card-image">
                            <img src="/img/s1.png" alt="Company Story">
                        </div>
                        <div class="card-content">
                            <h3>ความมุ่งมั่นในคุณภาพ</h3>
                            <p>ต.ตรวจบ้าน เริ่มต้นเมื่อปี 2015 โดยเจ้าของ คุณสุเมธ เจตธำรงชัย และคุณสุเทพ เจตธำรงชัย
                                เริ่มจากการที่รับตรวจบ้าน
                                และคอนโดให้กับกลุ่มพี่น้องและเพื่อนฝูงคนรู้จักจนได้รับการบอกต่อปากต่อปาก</p>
                            <div class="card-features">
                                <div class="feature-item">
                                    <span class="feature-icon">🎯</span>
                                    <span class="feature-text">ความแม่นยำสูง</span>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-icon">⚡</span>
                                    <span class="feature-text">บริการรวดเร็ว</span>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-icon">💎</span>
                                    <span class="feature-text">คุณภาพพรีเมียม</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Section -->
    <section class="vision-section" id="vision">
        <div class="container">
            <div class="vision-content fade-in">
                <div class="vision-card">
                    <div class="card-header">
                        <div class="header-icon">🎯</div>
                        <h2 class="card-title">Our Vision and Mission</h2>
                    </div>
                    <div class="card-body">
                        <p class="vision-text">บริการตรวจสอบบ้านมือสองของบ้านและคอนโดก่อนโอนกรรมสิทธิ์ดีที่สุด อันดับ 1
                            ที่ลูกค้าเลือกมากที่สุดในประเทศไทย</p>
                        <div class="vision-features">
                            <div class="feature-grid">
                                <div class="grid-item">
                                    <div class="item-icon">🏆</div>
                                    <div class="item-text">ผู้นำตลาด</div>
                                </div>
                                <div class="grid-item">
                                    <div class="item-icon">🔍</div>
                                    <div class="item-text">ตรวจสอบละเอียด</div>
                                </div>
                                <div class="grid-item">
                                    <div class="item-icon">⭐</div>
                                    <div class="item-text">คุณภาพสูง</div>
                                </div>
                                <div class="grid-item">
                                    <div class="item-icon">🤝</div>
                                    <div class="item-text">ความไว้วางใจ</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section" id="values">
        <div class="container">
            <div class="section-header fade-in">
                <div class="section-badge">
                    <span class="badge-icon">💎</span>
                    <span class="badge-text">หลักการของเรา</span>
                </div>
                <h2 class="section-title">Our Core Values</h2>
                <p class="section-subtitle">สามเสาหลักที่ทำให้เราเป็นผู้นำ</p>
            </div>
            <div class="values-grid">
                <div class="value-card scale-in" data-tilt>
                    <div class="card-header">
                        <div class="card-icon">
                            <span class="icon-symbol">🛡️</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">TRUST</h3>
                        <p class="card-description">การสร้างความเชื่อมั่นด้วยการตรวจสอบที่มีมาตรฐาน</p>
                        <div class="card-features">
                            <div class="feature-point">✓ มาตรฐานสากล</div>
                            <div class="feature-point">✓ ความโปร่งใส</div>
                            <div class="feature-point">✓ ความน่าเชื่อถือ</div>
                        </div>
                    </div>
                </div>

                <div class="value-card" data-tilt>
                    <div class="card-background"></div>

                <div class="value-card scale-in" data-tilt>
                    <div class="card-header">
                        <div class="card-icon">
                            <span class="icon-symbol">🔧</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">TECH</h3>
                        <p class="card-description">บริการตรวจสอบคุณภาพบ้านโดยใช้เทคโนโลยีใหม่</p>
                        <div class="card-features">
                            <div class="feature-point">✓ เทคโนโลยีทันสมัย</div>
                            <div class="feature-point">✓ อุปกรณ์ล้ำสมัย</div>
                            <div class="feature-point">✓ ระบบดิจิทัล</div>
                        </div>
                    </div>
                </div>

                <div class="value-card" data-tilt>
                    <div class="card-background"></div>

                <div class="value-card scale-in" data-tilt>
                    <div class="card-header">
                        <div class="card-icon">
                            <span class="icon-symbol">👥</span>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">TEAM</h3>
                        <p class="card-description">ทีมงานคุณภาพพร้อมให้บริการลูกค้า</p>
                        <div class="card-features">
                            <div class="feature-point">✓ ผู้เชี่ยวชาญ</div>
                            <div class="feature-point">✓ ประสบการณ์สูง</div>
                            <div class="feature-point">✓ บริการเป็นเลิศ</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Founders Section -->
    <section class="founders-section" id="founders">
        <div class="container">
            <div class="section-header fade-in">
                <div class="section-badge">
                    <span class="badge-icon">👑</span>
                    <span class="badge-text">ผู้ก่อตั้ง</span>
                </div>
                <h2 class="section-title">Our Founders</h2>
                <p class="section-subtitle">ผู้นำที่มีวิสัยทัศน์และประสบการณ์</p>
            </div>
            <div class="founders-grid">
                <div class="founder-card slide-in-left">
                    <div class="founder-image">
                        <img src="/img/staff/CEO.jpg" alt="Sumes Chetthamrongchai">
                        <div class="image-overlay">
                            <div class="social-links">
                                <a href="#" class="social-link">📧</a>
                                <a href="#" class="social-link">📱</a>
                                <a href="#" class="social-link">💼</a>
                            </div>
                        </div>
                    </div>
                    <div class="founder-info">
                        <h3 class="founder-name">Sumes Chetthamrongchai</h3>
                        <p class="founder-title">Founder & Managing Director</p>
                        <p class="founder-subtitle">NACHI Certified Inspector</p>
                        <div class="founder-achievements">
                            <div class="achievement-item">
                                <span class="achievement-icon">🏆</span>
                                <span class="achievement-text">8+ ปีประสบการณ์</span>
                            </div>
                            <div class="achievement-item">
                                <span class="achievement-icon">📜</span>
                                <span class="achievement-text">ใบรับรองสากล</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="founder-card">
                    <div class="card-background"></div>

                <div class="founder-card slide-in-right">
                    <div class="founder-image">
                        <img src="/img/staff/CO-founder.jpg" alt="Suthep Chetthamrongchai">
                        <div class="image-overlay">
                            <div class="social-links">
                                <a href="#" class="social-link">📧</a>
                                <a href="#" class="social-link">📱</a>
                                <a href="#" class="social-link">💼</a>
                            </div>
                        </div>
                    </div>
                    <div class="founder-info">
                        <h3 class="founder-name">Suthep Chetthamrongchai</h3>
                        <p class="founder-title">Co-Founder & Civil Engineer</p>
                        <p class="founder-subtitle">Technical Director</p>
                        <div class="founder-achievements">
                            <div class="achievement-item">
                                <span class="achievement-icon">🔧</span>
                                <span class="achievement-text">วิศวกรโยธา</span>
                            </div>
                            <div class="achievement-item">
                                <span class="achievement-icon">🎯</span>
                                <span class="achievement-text">ผู้เชี่ยวชาญ</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Commitment Section -->
    <section class="commitment-section" id="commitment">
        <div class="container">
            <div class="section-header fade-in">
                <div class="section-badge">
                    <span class="badge-icon">🤝</span>
                    <span class="badge-text">คำมั่นสัญญา</span>
                </div>
                <h2 class="section-title">Our Commitment to the Client</h2>
                <p class="section-subtitle">สิ่งที่เรามุ่งมั่นให้กับลูกค้าทุกท่าน</p>
            </div>

            <div class="commitment-grid">
                <div class="commitment-item fade-in">
                    <div class="item-icon">
                        <span class="icon-symbol">🎯</span>
                    </div>
                    <div class="item-content">
                        <h3 class="item-title">ความซื่อสัตย์และโปร่งใส</h3>
                        <p class="item-description">ไม่ใช่คนในบริษัทอสังหาริมทรัพย์ออกมารับงานเองหรือตรวจงานโครงการตัวเอง</p>
                    </div>
                </div>

                <div class="commitment-item fade-in">
                    <div class="item-icon">
                        <span class="icon-symbol">🔍</span>
                    </div>
                    <div class="item-content">
                        <h3 class="item-title">การตรวจสอบครบถ้วน</h3>
                        <p class="item-description">ตรวจครบทุกฟังก์ชันการใช้งานหลัก ใช้เทคโนโลยีที่ทันสมัยเข้ามาใช้ในการตรวจเพื่อความแม่นยำ</p>
                    </div>
                </div>

                <div class="commitment-item fade-in">
                    <div class="item-icon">
                        <span class="icon-symbol">💼</span>
                    </div>
                    <div class="item-content">
                        <h3 class="item-title">อาชีพหลัก ไม่ใช่งานเสริม</h3>
                        <p class="item-description">ตรวจบ้านทุกวันเป็น "อาชีพหลัก ไม่ใช่งานเสริม"</p>
                    </div>
                </div>

                <div class="commitment-item fade-in">
                    <div class="item-icon">
                        <span class="icon-symbol">👨‍🔧</span>
                    </div>
                    <div class="item-content">
                        <h3 class="item-title">ช่างผู้เชี่ยวชาญ</h3>
                        <p class="item-description">ตรวจด้วยช่างผู้เชี่ยวชาญงานจริง ไม่ใช้คำว่าวิศวกรมาหากิน</p>
                    </div>
                </div>

                <div class="commitment-item fade-in">
                    <div class="item-icon">
                        <span class="icon-symbol">📋</span>
                    </div>
                    <div class="item-content">
                        <h3 class="item-title">คุณภาพ ไม่ใช่ปริมาณ</h3>
                        <p class="item-description">ไม่เน้นล่ารายการดีเฟคเพื่อให้เล่มรายงานดูเยอะ</p>
                    </div>
                </div>

                <div class="commitment-item fade-in">
                    <div class="item-icon">
                        <span class="icon-symbol">🏢</span>
                    </div>
                    <div class="item-content">
                        <h3 class="item-title">บริการโดยตรง</h3>
                        <p class="item-description">บริษัทรับงานเองและไม่มีการส่งงานต่อให้ซับกินค่าหัวคิว</p>
                    </div>
                </div>
            </div>

            <div class="motto-section">
                <div class="motto-card scale-in">
                    <div class="motto-icon">💫</div>
                    <h3 class="motto-title">คติของเรา</h3>
                    <p class="motto-text">"ตรวจจริง เห็นกับตา ไปพร้อมลูกค้า"</p>
                    <div class="motto-decoration">
                        <div class="decoration-line"></div>
                        <div class="decoration-dot"></div>
                        <div class="decoration-line"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop">
        <span class="arrow-up">↑</span>
    </button>

    <script>

        // Smooth Scrolling for Navigation Links
        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener("click", function (e) {
                e.preventDefault()
                const target = document.querySelector(this.getAttribute("href"))
                if (target) {
                    const offsetTop = target.offsetTop - 80
                    window.scrollTo({
                        top: offsetTop,
                        behavior: "smooth",
                    })
                }
            })
        })

        // Active Navigation Link
        window.addEventListener("scroll", () => {
            const sections = document.querySelectorAll("section[id]")
            const navLinks = document.querySelectorAll(".nav-link")

            let current = ""
            sections.forEach((section) => {
                const sectionTop = section.offsetTop - 100
                const sectionHeight = section.clientHeight
                if (window.pageYOffset >= sectionTop && window.pageYOffset < sectionTop + sectionHeight) {
                    current = section.getAttribute("id")
                }
            })

            navLinks.forEach((link) => {
                link.classList.remove("active")
                if (link.getAttribute("href") === `#${current}`) {
                    link.classList.add("active")
                }
            })
        })

        // Intersection Observer for Animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px",
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible")
                }
            })
        }, observerOptions)

        // Observe elements for animations
        document.addEventListener("DOMContentLoaded", () => {
            const animatedElements = document.querySelectorAll(".fade-in, .slide-in-left, .slide-in-right, .scale-in")
            animatedElements.forEach((el) => observer.observe(el))
        })

        // Counter Animation
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

        // Animate counters when they come into view
        const counterObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const counter = entry.target
                        const target = parseInt(counter.dataset.count)
                        animateCounter(counter, target)
                        counterObserver.unobserve(counter)
                    }
                })
            },
            { threshold: 0.5 },
        )

        document.querySelectorAll(".stat-number").forEach((counter) => {
            counterObserver.observe(counter)
        })

        // Tilt Effect for Cards
        document.querySelectorAll("[data-tilt]").forEach((card) => {
            card.addEventListener("mousemove", (e) => {
                const rect = card.getBoundingClientRect()
                const x = e.clientX - rect.left
                const y = e.clientY - rect.top

                const centerX = rect.width / 2
                const centerY = rect.height / 2

                const rotateX = (y - centerY) / 10
                const rotateY = (centerX - x) / 10

                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.05, 1.05, 1.05)`
            })

            card.addEventListener("mouseleave", () => {
                card.style.transform = "perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)"
            })
        })

        // Keyboard Navigation
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                // Close mobile menu
                if (navToggle && navMenu) {
                    navToggle.classList.remove("active")
                    navMenu.classList.remove("active")
                }
            }
        })

        let ticking = false

        function updateOnScroll() {
            if (!ticking) {
                requestAnimationFrame(() => {
                    ticking = false
                })
                ticking = true
            }
        }

        window.addEventListener("scroll", updateOnScroll)

        window.addEventListener("error", (e) => {
            console.error("JavaScript Error:", e.error)
        })

        document.addEventListener("DOMContentLoaded", () => {
            console.log("🏠 ต.ตรวจบ้าน website loaded successfully!")

            setTimeout(() => {
                document.body.classList.add("loaded")
            }, 100)
        })
    </script>
@endsection
