@extends('layouts.layout_home')

@section('content')
    <!DOCTYPE html>
    <html lang="th">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>บริการบ้าน - ตรวจบ้าน ต่อเติม ตกแต่ง</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/css/home/aboutus/ourteam.css">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Sarabun', sans-serif;
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                min-height: 100vh;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }

            /* Header Styles */
            .main-header {
                text-align: center;
                margin-bottom: 40px;
            }

            .title {
                font-size: 2.5rem;
                font-weight: 700;
                color: #2c3e50;
                margin-bottom: 10px;
            }

            .title-underline {
                width: 100px;
                height: 4px;
                background: linear-gradient(45deg, #3498db, #2980b9);
                margin: 0 auto;
                border-radius: 2px;
            }

            /* Service Selection */
            .service-selection {
                display: flex;
                justify-content: center;
                gap: 20px;
                margin-bottom: 40px;
                flex-wrap: wrap;
            }

            .service-btn {
                padding: 15px 30px;
                border: none;
                border-radius: 25px;
                font-size: 1.1rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }


            .service-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            }

            .service-btn.active {
                transform: scale(1.05);
            }

            /* Service Content */
            .service-content {
                display: none;
            }

            .service-content.active {
                display: block;
            }

            /* Filter Styles */
            .filter-container {
                background: white;
                border-radius: 15px;
                padding: 20px;
                margin-bottom: 30px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            }

            .filter-header {
                text-align: center;
                margin-bottom: 15px;
            }

            .filter-header i {
                font-size: 1.5rem;
                color: #7f8c8d;
            }

            .filter-tabs {
                display: flex;
                justify-content: center;
                gap: 10px;
                flex-wrap: wrap;
            }

            .filter-btn {
                padding: 10px 20px;
                border: 2px solid transparent;
                border-radius: 20px;
                background: #ecf0f1;
                color: #2c3e50;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            /* Theme-specific filter buttons */

            .filter-btn:hover {
                transform: translateY(-1px);
            }

            /* Department Section */
            .department-section {
                margin-bottom: 40px;
            }

            .department-header {
                display: flex;
                align-items: center;
                gap: 15px;
                margin-bottom: 25px;
            }

            .department-title {
                font-size: 1.8rem;
                font-weight: 600;
                color: #2c3e50;
            }

            .department-line {
                flex: 1;
                height: 3px;
                border-radius: 2px;
            }

            /* Theme-specific department lines */
            .department-count {
                background: #ecf0f1;
                color: #2c3e50;
                padding: 5px 15px;
                border-radius: 15px;
                font-weight: 600;
            }

            /* Team Grid */
            .team-grid {
                display: flex;
                /* display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); */
                gap: 25px;
            }

            .team-card {
                background: white;
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                width: 300px;
                cursor: pointer;
            }

            .team-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            }

            .card-image {
                position: relative;
                height: 250px;
                overflow: hidden;
            }

            .card-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .team-card:hover .card-image img {
                transform: scale(1.05);
            }

            .image-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
                z-index: 1;
            }

            .card-image-content {
                position: absolute;
                bottom: 20px;
                left: 20px;
                right: 20px;
                z-index: 2;
                color: white;
            }

            .department-badge {
                display: inline-block;
                padding: 5px 12px;
                border-radius: 15px;
                font-size: 0.8rem;
                font-weight: 600;
                margin-bottom: 8px;
            }

            /* Theme-specific badges */

            .card-image-content h3 {
                font-size: 1.3rem;
                font-weight: 600;
                margin-bottom: 5px;
            }

            .card-image-content p {
                font-size: 0.9rem;
                opacity: 0.9;
            }

            .card-content {
                padding: 20px;
            }

            .contact-info {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 15px;
                color: #7f8c8d;
            }

            .contact-info i {
                width: 16px;
            }

            .skills {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
            }

            .skill-badge {
                background: #ecf0f1;
                color: #2c3e50;
                padding: 5px 12px;
                border-radius: 12px;
                font-size: 0.8rem;
                font-weight: 500;
            }

            /* Modal Styles */
            .modal {
                display: none;
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(5px);
            }

            .modal-content {
                background-color: white;
                margin: 2% auto;
                padding: 0;
                border-radius: 15px;
                width: 90%;
                max-width: 800px;
                max-height: 90vh;
                overflow-y: auto;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            }

            .close-modal {
                position: absolute;
                right: 20px;
                top: 20px;
                font-size: 2rem;
                font-weight: bold;
                cursor: pointer;
                z-index: 10;
                color: white;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            }

            .modal-header {
                background: linear-gradient(135deg, #2c3e50, #3498db);
                color: white;
                padding: 30px;
                text-align: center;
                position: relative;
            }

            .modal-header h2 {
                font-size: 2rem;
                margin-bottom: 10px;
            }

            .modal-body {
                padding: 30px;
            }

            .modal-profile {
                display: grid;
                grid-template-columns: 1fr 2fr;
                gap: 30px;
            }

            .modal-avatar img {
                width: 100%;
                border-radius: 15px;
                margin-bottom: 20px;
            }

            .modal-contact-item {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 10px;
                color: #7f8c8d;
            }

            .modal-section {
                margin-bottom: 25px;
            }

            .modal-section h3 {
                color: #2c3e50;
                margin-bottom: 15px;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .modal-skills {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
            }

            .modal-footer {
                padding: 20px 30px;
                text-align: center;
                border-top: 1px solid #ecf0f1;
            }

            .close-btn {
                background: #e74c3c;
                color: white;
                border: none;
                padding: 12px 30px;
                border-radius: 25px;
                cursor: pointer;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .close-btn:hover {
                background: #c0392b;
                transform: translateY(-2px);
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .title {
                    font-size: 2rem;
                }

                .service-selection {
                    flex-direction: column;
                    align-items: center;
                }

                .service-btn {
                    width: 100%;
                    max-width: 300px;
                }

                .filter-tabs {
                    flex-direction: column;
                    align-items: center;
                }

                .filter-btn {
                    width: 100%;
                    max-width: 200px;
                }

                .team-grid {
                    /* grid-template-columns: 1fr; */
                }

                .modal-profile {
                    grid-template-columns: 1fr;
                }

                .department-header {
                    flex-direction: column;
                    text-align: center;
                    gap: 10px;
                }

                .department-line {
                    width: 100px;
                    margin: 0 auto;
                }
            }

            /* Hidden class for filtering */
            .hidden {
                display: none !important;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <header class="main-header">
                <h1 class="title">{{__('header.ourteam')}}</h1>
                <div class="title-underline"></div>
            </header>

            <!-- Service Selection -->
            <div class="service-selection">
                @foreach ($major as $maj)
                    @if ($loop->first)
                        <button class="service-btn active {{ $maj->theme }}" data-service="{{ $maj->translation }}">
                            {{ $maj->translation }}
                        </button>
                    @else
                        <button class="service-btn {{ $maj->theme }}" data-service="{{ $maj->translation }}">
                            {{ $maj->translation }}
                        </button>
                    @endif
                @endforeach
            </div>


            @foreach ($major as $maj)
                @if($loop->first)
                <div class="service-content {{ $maj->theme }} active" id="{{ $maj->translation }}">
                @else
                <div class="service-content {{ $maj->theme }}" id="{{ $maj->translation }}">
                @endif
                    <div class="filter-container">
                        <div class="filter-header">
                            <i class="fas fa-filter"></i>
                        </div>
                        <div class="filter-tabs">
                            <button class="filter-btn active" data-category="all">ทั้งหมด</button>
                            @foreach ($maj->departments as $department)
                                <button class="filter-btn"
                                    data-category="{{ $department->translation->name }}">{{ $department->translation->name }}</button>
                            @endforeach
                        </div>
                    </div>

                    @foreach ($maj->departments as $department)
                        <section class="department-section" data-category="{{ $department->translation->name }}">
                            <div class="department-header">
                                <h2 class="department-title">{{ $department->translation->name }}</h2>
                                <div class="department-line"></div>
                                <span class="department-count"> {{ count($department->employees) }} {{ __('header.ourteam_professor') }}
                                </span>
                            </div>
                            <div class="team-grid">
                                @foreach ($department->employees as $employee)
                                    <div class="team-card" data-id="{{ $employee->id }}">
                                        <div class="card-image">
                                            <div class="image-overlay"></div>
                                            <img src="{{ $employee->cover_image }}"
                                                alt="{{ $employee->translation->name }}">
                                            <div class="card-image-content">
                                                <span class="department-badge">{{ $department->translation->name }}</span>
                                                <h3>{{ $employee->translation->name }}</h3>
                                                <p>{{ $employee->translation->position }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </section>
                    @endforeach

                </div>
            @endforeach
        </div>

        <!-- Modal -->
        <div class="modal" id="profileModal">
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <div class="modal-header">
                    <h2 id="modal-name">ชื่อผู้เชี่ยวชาญ</h2>
                    <p id="modal-position">ตำแหน่ง - บริการ</p>
                </div>
                <div class="modal-body">
                    <div class="modal-profile">
                        <div class="modal-avatar">
                            <img id="modal-image" src="https://via.placeholder.com/300x400" alt="ผู้เชี่ยวชาญ">
                            <div class="modal-contact">
                                <div class="modal-contact-item">
                                    <i class="fas fa-phone"></i>
                                    <span id="modal-phone">+66 89 123 4567</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-info">
                            <div class="modal-section">
                                <h3><i class="fas fa-user"></i> ประวัติ</h3>
                                <p id="modal-bio">ประวัติผู้เชี่ยวชาญ...</p>
                            </div>
                            <div class="modal-section">
                                <h3><i class="fas fa-award"></i> ความสำเร็จ</h3>
                                <ul id="modal-achievements">
                                    <li>ความสำเร็จ 1</li>
                                    <li>ความสำเร็จ 2</li>
                                    <li>ความสำเร็จ 3</li>
                                </ul>
                            </div>
                            <div class="modal-section">
                                <h3>ทักษะ</h3>
                                <div id="modal-skills" class="modal-skills">
                                    <span class="skill-badge">ทักษะ 1</span>
                                    <span class="skill-badge">ทักษะ 2</span>
                                    <span class="skill-badge">ทักษะ 3</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="close-btn">ปิด</button>
                </div>
            </div>
        </div>

        <script>
            // Service switching functionality
            const serviceButtons = document.querySelectorAll('.service-btn');
            const serviceContents = document.querySelectorAll('.service-content');

            serviceButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const targetService = button.getAttribute('data-service');

                    // Remove active class from all buttons and contents
                    serviceButtons.forEach(btn => btn.classList.remove('active'));
                    serviceContents.forEach(content => content.classList.remove('active'));

                    // Add active class to clicked button and corresponding content
                    button.classList.add('active');
                    document.getElementById(targetService).classList.add('active');
                });
            });

            // Filter functionality for each service
            function initializeFilters() {
                const allServices = Array.from(document.querySelectorAll('.service-selection button'))
                    .map(btn => btn.textContent.trim())

                // const allServices = ['inspection', 'extension', 'decoration'];

                allServices.forEach(serviceName => {
                    const serviceElement = document.getElementById(serviceName);
                    const filterButtons = serviceElement.querySelectorAll('.filter-btn');
                    const departmentSections = serviceElement.querySelectorAll('.department-section');

                    filterButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            const targetCategory = button.getAttribute('data-category');

                            // Remove active class from all filter buttons in this service
                            filterButtons.forEach(btn => btn.classList.remove('active'));

                            // Add active class to clicked button
                            button.classList.add('active');

                            // Show/hide department sections based on filter
                            departmentSections.forEach(section => {
                                const sectionCategory = section.getAttribute('data-category');

                                if (targetCategory === 'all' || sectionCategory ===
                                    targetCategory) {
                                    section.classList.remove('hidden');
                                } else {
                                    section.classList.add('hidden');
                                }
                            });
                        });
                    });
                });
            }

            // Modal functionality
            const modal = document.getElementById('profileModal');
            const closeModal = document.querySelector('.close-modal');
            const closeBtn = document.querySelector('.close-btn');
            const teamCards = document.querySelectorAll('.team-card');

            // Sample data for modal (you can expand this with real data)
            const employeeData = {
                1: {
                    name: "สมชาย วิศวกรรม",
                    position: "วิศวกรโครงสร้างอาวุโส - ตรวจบ้าน",
                    email: "somchai@inspection.com",
                    phone: "+66 89 123 4567",
                    bio: "วิศวกรโครงสร้างที่มีประสบการณ์กว่า 15 ปี เชี่ยวชาญในการตรวจสอบและประเมินความแข็งแรงของโครงสร้างอาคาร",
                    achievements: [
                        "ได้รับใบรับรองวิศวกรโครงสร้างจากสภาวิศวกร",
                        "มีประสบการณ์ตรวจสอบอาคารมากกว่า 500 หลัง",
                        "ผู้เชี่ยวชาญด้านการประเมินความเสี่ยงโครงสร้าง"
                    ],
                    skills: ["ตรวจสอบฐานราก", "วิเคราะห์โครงสร้าง", "ประเมินความปลอดภัย"]
                },
                // Add more employee data as needed
            };

            teamCards.forEach(card => {
                card.addEventListener('click', () => {
                    const employeeId = card.getAttribute('data-id');
                    const data = employeeData[employeeId];

                    if (data) {
                        document.getElementById('modal-name').textContent = data.name;
                        document.getElementById('modal-position').textContent = data.position;
                        document.getElementById('modal-email').textContent = data.email;
                        document.getElementById('modal-phone').textContent = data.phone;
                        document.getElementById('modal-bio').textContent = data.bio;

                        // Update achievements
                        const achievementsList = document.getElementById('modal-achievements');
                        achievementsList.innerHTML = '';
                        data.achievements.forEach(achievement => {
                            const li = document.createElement('li');
                            li.textContent = achievement;
                            achievementsList.appendChild(li);
                        });

                        // Update skills
                        const skillsContainer = document.getElementById('modal-skills');
                        skillsContainer.innerHTML = '';
                        data.skills.forEach(skill => {
                            const span = document.createElement('span');
                            span.className = 'skill-badge';
                            span.textContent = skill;
                            skillsContainer.appendChild(span);
                        });

                        // Update image
                        const cardImage = card.querySelector('.card-image img');
                        document.getElementById('modal-image').src = cardImage.src;
                    } else {
                        // Default data if no specific data found
                        const cardContent = card.querySelector('.card-image-content');
                        const name = cardContent.querySelector('h3').textContent;
                        const position = cardContent.querySelector('p').textContent;
                        const email = card.querySelector('.contact-info span').textContent;

                        document.getElementById('modal-name').textContent = name;
                        document.getElementById('modal-position').textContent = position;
                        document.getElementById('modal-email').textContent = email;
                        document.getElementById('modal-phone').textContent = "+66 89 123 4567";
                        document.getElementById('modal-bio').textContent =
                            "ผู้เชี่ยวชาญที่มีประสบการณ์และความเชี่ยวชาญในสาขาของตน พร้อมให้บริการด้วยความใส่ใจและคุณภาพสูงสุด";

                        // Default achievements
                        const achievementsList = document.getElementById('modal-achievements');
                        achievementsList.innerHTML = `
                        <li>มีประสบการณ์ในสาขามากกว่า 10 ปี</li>
                        <li>ได้รับการรับรองจากหน่วยงานที่เกี่ยวข้อง</li>
                        <li>ให้บริการลูกค้าด้วยความเป็นมิตรและมืออาชีพ</li>
                    `;

                        // Get skills from card
                        const skillsContainer = document.getElementById('modal-skills');
                        skillsContainer.innerHTML = '';
                        const cardSkills = card.querySelectorAll('.skill-badge');
                        cardSkills.forEach(skillElement => {
                            const span = document.createElement('span');
                            span.className = 'skill-badge';
                            span.textContent = skillElement.textContent;
                            skillsContainer.appendChild(span);
                        });

                        // Update image
                        const cardImage = card.querySelector('.card-image img');
                        document.getElementById('modal-image').src = cardImage.src;
                    }

                    modal.style.display = 'block';
                    document.body.style.overflow = 'hidden';
                });
            });

            // Close modal functionality
            closeModal.addEventListener('click', () => {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            });

            closeBtn.addEventListener('click', () => {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            });

            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });

            // Initialize filters when page loads
            document.addEventListener('DOMContentLoaded', () => {
                initializeFilters();
            });

            // Smooth scrolling for better UX
            document.querySelectorAll('.service-btn').forEach(button => {
                button.addEventListener('click', () => {
                    setTimeout(() => {
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    }, 100);
                });
            });
        </script>
    </body>

    </html>
@endsection
