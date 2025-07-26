<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-translate="page-title">เลือกโครงการที่คุณสนใจ - เปรียบเทียบบ้าน</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: rgb(0, 217, 255);
            --primary-dark: rgb(0, 247, 255);
            --secondary-color: #2c3e50;
            --accent-blue: #3498db;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --text-primary: #2c3e50;
            --text-secondary: #7f8c8d;
            --text-light: #bdc3c7;
            --bg-primary: #ffffff;
            --bg-secondary: #f8f9fa;
            --bg-overlay: rgba(0, 0, 0, 0.7);
            --border-color: #e9ecef;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 8px 25px rgba(0,0,0,0.15);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Kanit', sans-serif;
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            line-height: 1.6;
            transition: var(--transition);
        }

        body.lang-en {
            font-family: 'Inter', sans-serif;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Language Toggle */
        .language-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 0.5rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .language-toggle:hover {
            border-color: var(--primary-color);
        }

        .lang-option {
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            transition: var(--transition);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .lang-option.active {
            background: var(--primary-color);
            color: white;
        }

        .lang-option:not(.active) {
            color: var(--text-secondary);
        }

        /* Header */
        .header {
            background: var(--bg-primary);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .nav-filters {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .filter-group {
            position: relative;
        }

        .filter-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            font-family: inherit;
            font-size: 0.9rem;
            color: var(--text-primary);
        }

        .filter-btn:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .filter-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .filter-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            z-index: 1000;
            display: none;
            max-height: 300px;
            overflow-y: auto;
            min-width: 200px;
        }

        .filter-dropdown.show {
            display: block;
        }

        .filter-option {
            padding: 0.75rem 1rem;
            cursor: pointer;
            transition: var(--transition);
            border-bottom: 1px solid var(--border-color);
        }

        .filter-option:last-child {
            border-bottom: none;
        }

        .filter-option:hover {
            background: var(--bg-secondary);
        }

        .filter-option.selected {
            background: var(--primary-color);
            color: white;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .results-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .view-toggle {
            display: flex;
            gap: 0.5rem;
        }

        .view-btn {
            padding: 0.5rem;
            border: 1px solid var(--border-color);
            background: var(--bg-primary);
            cursor: pointer;
            transition: var(--transition);
            border-radius: 6px;
        }

        .view-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Main Content */
        .main-content {
            padding: 2rem 0;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 2rem;
            color: var(--text-primary);
        }

        /* Loading */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 4rem;
            flex-direction: column;
            gap: 1rem;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--border-color);
            border-top: 3px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Houses Grid */
        .houses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .house-card {
            background: var(--bg-primary);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            position: relative;
            cursor: pointer;
        }

        .house-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .house-image {
            position: relative;
            height: 240px;
            overflow: hidden;
        }

        .house-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .house-card:hover .house-image img {
            transform: scale(1.05);
        }

        .house-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, var(--bg-overlay));
            padding: 2rem 1.5rem 1.5rem;
            color: white;
        }

        .house-status {
            position: absolute;
            top: 1rem;
            left: 1rem;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-ready {
            background: var(--success-color);
            color: white;
        }

        .status-new {
            background: var(--accent-blue);
            color: white;
        }

        .status-promotion {
            background: var(--warning-color);
            color: white;
        }

        .house-actions {
            position: absolute;
            top: 1rem;
            right: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .action-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            color: var(--text-secondary);
        }

        .action-btn:hover {
            background: white;
            color: var(--primary-color);
            transform: scale(1.1);
        }

        .action-btn.active {
            background: var(--primary-color);
            color: white;
        }

        .house-info {
            padding: 1.5rem;
        }

        .house-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: white;
        }

        .house-location {
            color: white;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .house-specs {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .spec-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .house-price {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .house-features {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .feature-tag {
            padding: 0.25rem 0.5rem;
            background: var(--bg-secondary);
            border-radius: 15px;
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .feature-tag.highlight {
            background: var(--primary-color);
            color: white;
        }

        /* Compare Panel */
        .compare-panel {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--bg-primary);
            box-shadow: 0 -4px 20px rgba(0,0,0,0.1);
            padding: 1rem;
            transform: translateY(100%);
            transition: var(--transition);
            z-index: 200;
        }

        .compare-panel.active {
            transform: translateY(0);
        }

        .compare-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1400px;
            margin: 0 auto;
        }

        .compare-items {
            display: flex;
            gap: 1rem;
            flex: 1;
        }

        .compare-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: var(--bg-secondary);
            border-radius: var(--border-radius);
            position: relative;
        }

        .compare-item img {
            width: 50px;
            height: 40px;
            object-fit: cover;
            border-radius: 6px;
        }

        .compare-item-info h4 {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .compare-item-info p {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .remove-compare {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            border: none;
            cursor: pointer;
            font-size: 0.7rem;
        }

        .compare-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .compare-btn {
            padding: 0.75rem 1.5rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
        }

        .compare-btn:hover {
            background: var(--primary-dark);
        }

        .compare-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Error Message */
        .error-message {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--warning-color);
        }

        .error-message i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .error-message h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .error-message p {
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .retry-btn {
            padding: 0.75rem 1.5rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
        }

        .retry-btn:hover {
            background: var(--primary-dark);
        }

        /* No Results */
        .no-results {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-secondary);
        }

        .no-results i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .no-results h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .no-results p {
            font-size: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }

            .header-left {
                flex-direction: column;
                gap: 1rem;
                width: 100%;
            }

            .nav-filters {
                flex-wrap: wrap;
                gap: 1rem;
            }

            .houses-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .compare-content {
                flex-direction: column;
                gap: 1rem;
            }

            .compare-items {
                overflow-x: auto;
                padding-bottom: 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 0.5rem;
            }

            .house-card {
                margin: 0 0.5rem;
            }

            .page-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="header-left">
                    <div class="logo">
                        <i class="fas fa-home"></i> HouseCompare
                    </div>
                    
                    <div class="nav-filters">
                        <div class="filter-group">
                            <button class="filter-btn" id="typeFilter">
                                <i class="fas fa-building"></i>
                                <span data-translate="filter-type">ประเภท</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="filter-dropdown" id="typeDropdown">
                                <div class="filter-option selected" data-value="" data-translate="filter-all">ทั้งหมด</div>
                                <div class="filter-option" data-value="บ้านเดี่ยว" data-translate="house-type-detached">บ้านเดี่ยว</div>
                                <div class="filter-option" data-value="ทาวน์เฮาส์" data-translate="house-type-townhouse">ทาวน์เฮาส์</div>
                                <div class="filter-option" data-value="คอนโด" data-translate="house-type-condo">คอนโด</div>
                                <div class="filter-option" data-value="บ้านแฝด" data-translate="house-type-duplex">บ้านแฝด</div>
                            </div>
                        </div>
                        
                        <div class="filter-group">
                            <button class="filter-btn" id="locationFilter">
                                <i class="fas fa-map-marker-alt"></i>
                                <span data-translate="filter-location">ที่ตั้ง</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="filter-dropdown" id="locationDropdown">
                                <div class="filter-option selected" data-value="" data-translate="filter-all">ทั้งหมด</div>
                            </div>
                        </div>
                        
                        <div class="filter-group">
                            <button class="filter-btn" id="priceFilter">
                                <i class="fas fa-tag"></i>
                                <span data-translate="filter-price">ราคา</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="filter-dropdown" id="priceDropdown">
                                <div class="filter-option selected" data-value="" data-translate="filter-all">ทั้งหมด</div>
                                <div class="filter-option" data-value="0-2000000" data-translate="price-under-2m">ต่ำกว่า 2 ล้าน</div>
                                <div class="filter-option" data-value="2000000-5000000" data-translate="price-2-5m">2-5 ล้าน</div>
                                <div class="filter-option" data-value="5000000-10000000" data-translate="price-5-10m">5-10 ล้าน</div>
                                <div class="filter-option" data-value="10000000-20000000" data-translate="price-10-20m">10-20 ล้าน</div>
                                <div class="filter-option" data-value="20000000-999999999" data-translate="price-over-20m">มากกว่า 20 ล้าน</div>
                            </div>
                        </div>
                        
                        <div class="filter-group">
                            <button class="filter-btn" id="sortFilter">
                                <i class="fas fa-sort"></i>
                                <span data-translate="filter-sort">เรียงตาม</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="filter-dropdown" id="sortDropdown">
                                <div class="filter-option selected" data-value="newest" data-translate="sort-newest">ใหม่ล่าสุด</div>
                                <div class="filter-option" data-value="price-low" data-translate="sort-price-low">ราคาต่ำ-สูง</div>
                                <div class="filter-option" data-value="price-high" data-translate="sort-price-high">ราคาสูง-ต่ำ</div>
                                <div class="filter-option" data-value="area-large" data-translate="sort-area-large">พื้นที่ใหญ่-เล็ก</div>
                                <div class="filter-option" data-value="area-small" data-translate="sort-area-small">พื้นที่เล็ก-ใหญ่</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="header-right">
                    <div class="results-info">
                        <span id="resultsCount" data-translate="loading">กำลังโหลด...</span>
                        <div class="view-toggle">
                            <button class="view-btn active" data-view="grid">
                                <i class="fas fa-th"></i>
                            </button>
                            <button class="view-btn" data-view="list">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Language Toggle -->
                    <div class="language-toggle" id="languageToggle">
                        <div class="lang-option active" data-lang="th">ไทย</div>
                        <div class="lang-option" data-lang="en">EN</div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <h1 class="page-title" data-translate="page-heading">เลือกโครงการที่คุณสนใจ</h1>
            
            <!-- Loading -->
            <div class="loading" id="loading">
                <div class="spinner"></div>
                <p data-translate="loading-text">กำลังโหลดข้อมูลบ้าน...</p>
            </div>

            <!-- Error Message -->
            <div class="error-message" id="errorMessage" style="display: none;">
                <i class="fas fa-exclamation-triangle"></i>
                <h3 data-translate="error-title">เกิดข้อผิดพลาด</h3>
                <p id="errorText" data-translate="error-text">ไม่สามารถโหลดข้อมูลได้ กรุณาลองใหม่อีกครั้ง</p>
                <button class="retry-btn" onclick="fetchHouses()" data-translate="retry-btn">ลองใหม่</button>
            </div>

            <!-- Houses Grid -->
            <div class="houses-grid" id="housesGrid" style="display: none;">
                <!-- Houses will be populated here -->
            </div>

            <!-- No Results -->
            <div class="no-results" id="noResults" style="display: none;">
                <i class="fas fa-search"></i>
                <h3 data-translate="no-results-title">ไม่พบข้อมูลบ้าน</h3>
                <p data-translate="no-results-text">ลองปรับเปลี่ยนเงื่อนไขการค้นหา</p>
            </div>
        </div>
    </main>

    <!-- Compare Panel -->
    <div class="compare-panel" id="comparePanel">
        <div class="compare-content">
            <div class="compare-items" id="compareItems">
                <!-- Compare items will be populated here -->
            </div>
            <div class="compare-actions">
                <span id="compareCount">0/3</span>
                <button class="compare-btn" id="compareBtn" disabled>
                    <i class="fas fa-balance-scale"></i>
                    <span data-translate="compare-btn">เปรียบเทียบ</span>
                </button>
                <button class="compare-btn" id="clearCompare" style="background: var(--text-secondary);">
                    <i class="fas fa-times"></i>
                    <span data-translate="clear-btn">ล้าง</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Language translations
        const translations = {
            th: {
                'page-title': 'เลือกโครงการที่คุณสนใจ - เปรียบเทียบบ้าน',
                'page-heading': 'เลือกโครงการที่คุณสนใจ',
                'filter-type': 'ประเภท',
                'filter-location': 'ที่ตั้ง',
                'filter-price': 'ราคา',
                'filter-sort': 'เรียงตาม',
                'filter-all': 'ทั้งหมด',
                'house-type-detached': 'บ้านเดี่ยว',
                'house-type-townhouse': 'ทาวน์เฮาส์',
                'house-type-condo': 'คอนโด',
                'house-type-duplex': 'บ้านแฝด',
                'price-under-2m': 'ต่ำกว่า 2 ล้าน',
                'price-2-5m': '2-5 ล้าน',
                'price-5-10m': '5-10 ล้าน',
                'price-10-20m': '10-20 ล้าน',
                'price-over-20m': 'มากกว่า 20 ล้าน',
                'sort-newest': 'ใหม่ล่าสุด',
                'sort-price-low': 'ราคาต่ำ-สูง',
                'sort-price-high': 'ราคาสูง-ต่ำ',
                'sort-area-large': 'พื้นที่ใหญ่-เล็ก',
                'sort-area-small': 'พื้นที่เล็ก-ใหญ่',
                'loading': 'กำลังโหลด...',
                'loading-text': 'กำลังโหลดข้อมูลบ้าน...',
                'error-title': 'เกิดข้อผิดพลาด',
                'error-text': 'ไม่สามารถโหลดข้อมูลได้ กรุณาลองใหม่อีกครั้ง',
                'retry-btn': 'ลองใหม่',
                'no-results-title': 'ไม่พบข้อมูลบ้าน',
                'no-results-text': 'ลองปรับเปลี่ยนเงื่อนไขการค้นหา',
                'compare-btn': 'เปรียบเทียบ',
                'clear-btn': 'ล้าง',
                'results-count': 'จำนวน {count} โครงการ',
                'no-data': 'ไม่พบข้อมูล',
                'error-occurred': 'เกิดข้อผิดพลาด',
                'million-baht': 'ล้านบาท',
                'contact-price': 'ราคาติดต่อ',
                'not-specified': 'ไม่ระบุ',
                'house': 'บ้าน',
                'smart-home': 'Smart Home',
                'ready-to-move': 'พร้อมอยู่',
                'sqm': 'ตร.ม.',
                'max-compare-alert': 'สามารถเปรียบเทียบได้สูงสุด {max} รายการ',
                'min-compare-alert': 'กรุณาเลือกบ้านอย่างน้อย 2 หลังเพื่อเปรียบเทียบ'
            },
            en: {
                'page-title': 'Choose Your Interested Project - House Comparison',
                'page-heading': 'Choose Your Interested Project',
                'filter-type': 'Type',
                'filter-location': 'Location',
                'filter-price': 'Price',
                'filter-sort': 'Sort by',
                'filter-all': 'All',
                'house-type-detached': 'Detached House',
                'house-type-townhouse': 'Townhouse',
                'house-type-condo': 'Condo',
                'house-type-duplex': 'Duplex',
                'price-under-2m': 'Under 2M',
                'price-2-5m': '2-5M',
                'price-5-10m': '5-10M',
                'price-10-20m': '10-20M',
                'price-over-20m': 'Over 20M',
                'sort-newest': 'Newest',
                'sort-price-low': 'Price: Low-High',
                'sort-price-high': 'Price: High-Low',
                'sort-area-large': 'Area: Large-Small',
                'sort-area-small': 'Area: Small-Large',
                'loading': 'Loading...',
                'loading-text': 'Loading house data...',
                'error-title': 'Error Occurred',
                'error-text': 'Unable to load data. Please try again.',
                'retry-btn': 'Try Again',
                'no-results-title': 'No Houses Found',
                'no-results-text': 'Try adjusting your search criteria',
                'compare-btn': 'Compare',
                'clear-btn': 'Clear',
                'results-count': '{count} Projects',
                'no-data': 'No Data',
                'error-occurred': 'Error Occurred',
                'million-baht': 'Million Baht',
                'contact-price': 'Contact for Price',
                'not-specified': 'Not Specified',
                'house': 'House',
                'smart-home': 'Smart Home',
                'ready-to-move': 'Ready to Move',
                'sqm': 'sqm',
                'max-compare-alert': 'You can compare up to {max} items',
                'min-compare-alert': 'Please select at least 2 houses to compare'
            }
        };

        // Global variables
        let houses = [];
        let filteredHouses = [];
        let compareList = [];
        let currentLanguage = 'th';
        const maxCompare = 3;

        // Filter states
        let currentFilters = {
            type: '',
            location: '',
            price: '',
            sort: 'newest'
        };

        // DOM elements
        const loading = document.getElementById('loading');
        const errorMessage = document.getElementById('errorMessage');
        const errorText = document.getElementById('errorText');
        const housesGrid = document.getElementById('housesGrid');
        const noResults = document.getElementById('noResults');
        const resultsCount = document.getElementById('resultsCount');
        const comparePanel = document.getElementById('comparePanel');
        const compareItems = document.getElementById('compareItems');
        const compareCount = document.getElementById('compareCount');
        const compareBtn = document.getElementById('compareBtn');
        const clearCompareBtn = document.getElementById('clearCompare');
        const languageToggle = document.getElementById('languageToggle');

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            initializeLanguage();
            fetchHouses();
            setupEventListeners();
        });

        // Initialize language
        function initializeLanguage() {
            const savedLanguage = localStorage.getItem('language') || 'th';
            setLanguage(savedLanguage);
        }

        // Set language
        function setLanguage(lang) {
            currentLanguage = lang;
            localStorage.setItem('language', lang);
            
            // Update HTML lang attribute
            document.documentElement.lang = lang;
            
            // Update body class for font switching
            document.body.className = lang === 'en' ? 'lang-en' : '';
            
            // Update language toggle buttons
            languageToggle.querySelectorAll('.lang-option').forEach(option => {
                option.classList.toggle('active', option.dataset.lang === lang);
            });
            
            // Update all translatable elements
            updateTranslations();
            
            // Re-display houses with new language if houses are already loaded
            if (houses.length > 0) {
                displayHouses();
                updateResultsCount();
            }
        }

        // Update translations
        function updateTranslations() {
            const elements = document.querySelectorAll('[data-translate]');
            elements.forEach(element => {
                const key = element.getAttribute('data-translate');
                if (translations[currentLanguage] && translations[currentLanguage][key]) {
                    if (element.tagName === 'INPUT' && element.type === 'text') {
                        element.placeholder = translations[currentLanguage][key];
                    } else {
                        element.textContent = translations[currentLanguage][key];
                    }
                }
            });
            
            // Update page title
            document.title = translations[currentLanguage]['page-title'];
            
            // Update results count if houses are loaded
            if (filteredHouses.length > 0) {
                updateResultsCount();
            }
        }

        // Get translation
        function t(key, params = {}) {
            let text = translations[currentLanguage][key] || key;
            
            // Replace parameters
            Object.keys(params).forEach(param => {
                text = text.replace(`{${param}}`, params[param]);
            });
            
            return text;
        }

        // Fetch houses from API
        async function fetchHouses() {
            try {
                showLoading();
                hideError();
                
                const response = await fetch('/api/houses');
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                houses = data;
                filteredHouses = [...houses];
                
                populateLocationFilter();
                populateTypeFilter();
                displayHouses();
                updateResultsCount();
                
            } catch (error) {
                console.error('Error fetching houses:', error);
                showError(error.message);
            } finally {
                hideLoading();
            }
        }

        // Show loading
        function showLoading() {
            loading.style.display = 'flex';
            housesGrid.style.display = 'none';
            noResults.style.display = 'none';
            errorMessage.style.display = 'none';
        }

        // Hide loading
        function hideLoading() {
            loading.style.display = 'none';
        }

        // Show error
        function showError(message) {
            errorText.textContent = message || t('error-text');
            errorMessage.style.display = 'block';
            housesGrid.style.display = 'none';
            noResults.style.display = 'none';
            resultsCount.textContent = t('error-occurred');
        }

        // Hide error
        function hideError() {
            errorMessage.style.display = 'none';
        }

        // Populate location filter based on available data
        function populateLocationFilter() {
            const locations = [...new Set(houses.map(house => {
                const translatedHouse = translateHouseData(house);
                return translatedHouse.location;
            }))].filter(Boolean);
            
            const locationDropdown = document.getElementById('locationDropdown');
            
            // Clear existing options except "All"
            locationDropdown.innerHTML = `<div class="filter-option selected" data-value="" data-translate="filter-all">${t('filter-all')}</div>`;
            
            locations.forEach(location => {
                const option = document.createElement('div');
                option.className = 'filter-option';
                option.dataset.value = location;
                option.textContent = location;
                locationDropdown.appendChild(option);
            });
        }

        // Populate type filter based on available data
        function populateTypeFilter() {
            const types = [...new Set(houses.map(house => {
                const translatedHouse = translateHouseData(house);
                return translatedHouse.type;
            }))].filter(Boolean);
            
            const typeDropdown = document.getElementById('typeDropdown');
            
            // Update existing options with translations
            typeDropdown.querySelectorAll('.filter-option').forEach(option => {
                const key = option.getAttribute('data-translate');
                if (key) {
                    option.textContent = t(key);
                }
            });
            
            // Add dynamic types from backend if they don't exist
            types.forEach(type => {
                const existingOption = Array.from(typeDropdown.querySelectorAll('.filter-option'))
                    .find(opt => opt.dataset.value === type);
                
                if (!existingOption) {
                    const option = document.createElement('div');
                    option.className = 'filter-option';
                    option.dataset.value = type;
                    option.textContent = type;
                    typeDropdown.appendChild(option);
                }
            });
        }

        // Translate house data based on current language
        function translateHouseData(house) {
            // Create a copy to avoid modifying original data
            const translatedHouse = { ...house };
            
            // Translate house name if needed
            if (currentLanguage === 'en' && house.name_en) {
                translatedHouse.name = house.name_en;
            }
            
            // Translate location if needed
            if (currentLanguage === 'en' && house.location_en) {
                translatedHouse.location = house.location_en;
            }
            
            // Translate type if needed
            if (currentLanguage === 'en') {
                const typeTranslations = {
                    'บ้านเดี่ยว': 'Detached House',
                    'ทาวน์เฮาส์': 'Townhouse',
                    'คอนโด': 'Condo',
                    'บ้านแฝด': 'Duplex'
                };
                if (typeTranslations[house.type]) {
                    translatedHouse.type = typeTranslations[house.type];
                }
            }
            
            return translatedHouse;
        }

        // Setup event listeners
        function setupEventListeners() {
            // Language toggle
            languageToggle.addEventListener('click', function(e) {
                if (e.target.classList.contains('lang-option')) {
                    const lang = e.target.dataset.lang;
                    if (lang !== currentLanguage) {
                        setLanguage(lang);
                    }
                }
            });

            // Filter dropdowns
            setupFilterDropdown('typeFilter', 'typeDropdown', 'type');
            setupFilterDropdown('locationFilter', 'locationDropdown', 'location');
            setupFilterDropdown('priceFilter', 'priceDropdown', 'price');
            setupFilterDropdown('sortFilter', 'sortDropdown', 'sort');

            // Compare toggle
            document.addEventListener('click', function(e) {
                if (e.target.closest('.compare-toggle')) {
                    const btn = e.target.closest('.compare-toggle');
                    const houseId = parseInt(btn.dataset.houseId);
                    toggleCompare(houseId);
                }
            });

            // Compare actions
            compareBtn.addEventListener('click', showComparison);
            clearCompareBtn.addEventListener('click', clearCompare);

            // View toggle
            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    const view = this.dataset.view;
                    if (view === 'list') {
                        housesGrid.style.gridTemplateColumns = '1fr';
                    } else {
                        housesGrid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(320px, 1fr))';
                    }
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.filter-group')) {
                    document.querySelectorAll('.filter-dropdown').forEach(dropdown => {
                        dropdown.classList.remove('show');
                    });
                }
            });
        }

        // Setup individual filter dropdown
        function setupFilterDropdown(buttonId, dropdownId, filterType) {
            const button = document.getElementById(buttonId);
            const dropdown = document.getElementById(dropdownId);

            button.addEventListener('click', function(e) {
                e.stopPropagation();
                
                // Close other dropdowns
                document.querySelectorAll('.filter-dropdown').forEach(d => {
                    if (d !== dropdown) d.classList.remove('show');
                });
                
                dropdown.classList.toggle('show');
            });

            dropdown.addEventListener('click', function(e) {
                if (e.target.classList.contains('filter-option')) {
                    const value = e.target.dataset.value;
                    const text = e.target.textContent;
                    
                    // Update selected option
                    dropdown.querySelectorAll('.filter-option').forEach(opt => {
                        opt.classList.remove('selected');
                    });
                    e.target.classList.add('selected');
                    
                    // Update button text
                    const span = button.querySelector('span');
                    if (value === '') {
                        span.textContent = t(`filter-${filterType}`);
                        button.classList.remove('active');
                    } else {
                        span.textContent = text;
                        button.classList.add('active');
                    }
                    
                    // Update filter
                    currentFilters[filterType] = value;
                    applyFilters();
                    
                    dropdown.classList.remove('show');
                }
            });
        }

        // Apply filters
        function applyFilters() {
            filteredHouses = houses.filter(house => {
                // Type filter
                if (currentFilters.type && house.type !== currentFilters.type) {
                    return false;
                }
                
                // Location filter
                if (currentFilters.location && house.location !== currentFilters.location) {
                    return false;
                }
                
                // Price filter
                if (currentFilters.price) {
                    const [min, max] = currentFilters.price.split('-').map(Number);
                    const housePrice = parseFloat(house.price) || 0;
                    if (housePrice < min || housePrice > max) {
                        return false;
                    }
                }
                
                return true;
            });

            // Apply sorting
            applySorting();
            
            displayHouses();
            updateResultsCount();
        }

        // Apply sorting
        function applySorting() {
            switch (currentFilters.sort) {
                case 'price-low':
                    filteredHouses.sort((a, b) => (parseFloat(a.price) || 0) - (parseFloat(b.price) || 0));
                    break;
                case 'price-high':
                    filteredHouses.sort((a, b) => (parseFloat(b.price) || 0) - (parseFloat(a.price) || 0));
                    break;
                case 'area-large':
                    filteredHouses.sort((a, b) => (parseFloat(b.area) || 0) - (parseFloat(a.area) || 0));
                    break;
                case 'area-small':
                    filteredHouses.sort((a, b) => (parseFloat(a.area) || 0) - (parseFloat(b.area) || 0));
                    break;
                case 'newest':
                default:
                    filteredHouses.sort((a, b) => {
                        const yearA = parseInt(a.year_built) || 0;
                        const yearB = parseInt(b.year_built) || 0;
                        if (yearA === yearB) {
                            return (b.id || 0) - (a.id || 0);
                        }
                        return yearB - yearA;
                    });
                    break;
            }
        }

        // Display houses
        function displayHouses() {
            if (filteredHouses.length === 0) {
                showNoResults();
                return;
            }

            housesGrid.innerHTML = '';
            housesGrid.style.display = 'grid';
            noResults.style.display = 'none';

            filteredHouses.forEach(house => {
                const houseCard = createHouseCard(house);
                housesGrid.appendChild(houseCard);
            });
        }

        // Create house card
        function createHouseCard(house) {
            const translatedHouse = translateHouseData(house);
            const card = document.createElement('div');
            card.className = 'house-card';
            card.dataset.houseId = house.id;

            const imageUrl = translatedHouse.image_url || '/placeholder.svg?height=240&width=320';
            const isInCompare = compareList.some(item => item.id === house.id);
            
            // Determine status
            let statusHtml = '';
            if (translatedHouse.has_smart_home) {
                statusHtml = `<div class="house-status status-new">${t('smart-home')}</div>`;
            } else if (translatedHouse.year_built && translatedHouse.year_built >= 2023) {
                statusHtml = `<div class="house-status status-ready">${t('ready-to-move')}</div>`;
            }

            // Features
            const features = [];
            if (translatedHouse.has_smart_home) features.push(t('smart-home'));
            if (translatedHouse.has_solar_roof) features.push('Solar Roof');
            if (translatedHouse.has_ev_charger) features.push('EV Charger');
            if (translatedHouse.has_cctv_camera) features.push('CCTV');
            if (translatedHouse.has_security_home_system) features.push('Security System');

            // Format price
            const price = parseFloat(translatedHouse.price) || 0;
            const formattedPrice = price > 0 ? 
                (price / 1000000).toFixed(1) + ' ' + t('million-baht') : 
                t('contact-price');

            card.innerHTML = `
                <div class="house-image">
                    <img src="${imageUrl}" alt="${translatedHouse.name || t('house')}" loading="lazy" onerror="this.src='/placeholder.svg?height=240&width=320'">
                    ${statusHtml}
                    <div class="house-actions">
                        <button class="action-btn compare-toggle ${isInCompare ? 'active' : ''}" 
                                data-house-id="${house.id}" title="${t('compare-btn')}">
                            <i class="fas fa-balance-scale"></i>
                        </button>
                    </div>
                    <div class="house-overlay">
                        <div class="house-title">${translatedHouse.name || t('house')}</div>
                        <div class="house-location">
                            <i class="fas fa-map-marker-alt"></i>
                            ${translatedHouse.location || t('not-specified')}
                        </div>
                    </div>
                </div>
                <div class="house-info">
                    <div class="house-specs">
                        <div class="spec-item">
                            <i class="fas fa-bed"></i>
                            <span>${translatedHouse.bedrooms || 0}</span>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-bath"></i>
                            <span>${translatedHouse.bathrooms || 0}</span>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-ruler-combined"></i>
                            <span>${translatedHouse.area || 0} ${t('sqm')}</span>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-car"></i>
                            <span>${translatedHouse.car_park || 0}</span>
                        </div>
                    </div>
                    <div class="house-price">
                        ${formattedPrice}
                    </div>
                    <div class="house-features">
                        ${features.slice(0, 3).map(feature => 
                            `<span class="feature-tag highlight">${feature}</span>`
                        ).join('')}
                        ${features.length > 3 ? `<span class="feature-tag">+${features.length - 3}</span>` : ''}
                    </div>
                </div>
            `;

            return card;
        }

        // Toggle compare
        function toggleCompare(houseId) {
            const house = houses.find(h => h.id === houseId);
            if (!house) return;

            const existingIndex = compareList.findIndex(item => item.id === houseId);
            
            if (existingIndex > -1) {
                // Remove from compare
                compareList.splice(existingIndex, 1);
            } else {
                // Add to compare
                if (compareList.length >= maxCompare) {
                    alert(t('max-compare-alert', { max: maxCompare }));
                    return;
                }
                compareList.push(house);
            }

            updateCompareUI();
            updateCompareButtons();
        }

        // Update compare UI
        function updateCompareUI() {
            compareItems.innerHTML = '';
            
            compareList.forEach(house => {
                const item = document.createElement('div');
                item.className = 'compare-item';
                
                const imageUrl = house.image_url || '/placeholder.svg?height=40&width=50';
                
                item.innerHTML = `
                    <img src="${imageUrl}" alt="${house.name || t('house')}" onerror="this.src='/placeholder.svg?height=40&width=50'">
                    <div class="compare-item-info">
                        <h4>${house.name || t('house')}</h4>
                        <p>${house.location || t('not-specified')}</p>
                    </div>
                    <button class="remove-compare" onclick="toggleCompare(${house.id})">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                
                compareItems.appendChild(item);
            });

            // Update compare count
            compareCount.textContent = `${compareList.length}/${maxCompare}`;
            
            // Show/hide compare panel
            if (compareList.length > 0) {
                comparePanel.classList.add('active');
            } else {
                comparePanel.classList.remove('active');
            }

            // Enable/disable compare button
            compareBtn.disabled = compareList.length < 2;
        }

        // Update compare buttons
        function updateCompareButtons() {
            document.querySelectorAll('.compare-toggle').forEach(btn => {
                const houseId = parseInt(btn.dataset.houseId);
                const isInCompare = compareList.some(item => item.id === houseId);
                
                if (isInCompare) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
        }

        // Clear compare
        function clearCompare() {
            compareList = [];
            updateCompareUI();
            updateCompareButtons();
        }

        // Show comparison
        function showComparison() {
            if (compareList.length < 2) {
                alert(t('min-compare-alert'));
                return;
            }

            // Create comparison URL with house IDs
            const houseIds = compareList.map(house => house.id).join(',');
            const comparisonUrl = `/admin/compare/comparison?houses=${houseIds}`;
            window.open(comparisonUrl, '_blank');
        }

        // Update results count
        function updateResultsCount() {
            resultsCount.textContent = t('results-count', { count: filteredHouses.length });
        }

        // Show no results
        function showNoResults() {
            housesGrid.style.display = 'none';
            noResults.style.display = 'block';
            resultsCount.textContent = t('no-data');
        }
    </script>
</body>
</html>
