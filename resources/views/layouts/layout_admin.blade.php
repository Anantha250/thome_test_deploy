<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Test</title>
    <link rel="icon" type="image/x-icon" href="/img/favicon1.png">

    @hasSection('import')
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <!-- include summernote css/js-->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    @else
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
            integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @endif

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/component/header_admin.css') }}">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2>{{ Auth::user()->name }}</h2>
            <button class="close-sidebar" id="closeSidebar">×</button>
        </div>
        {{-- <div class="user-info">
            <div class="avatar">
                <img src="https://via.placeholder.com/50" alt="User Avatar">
            </div>
            <div class="user-details">
                <h3>Admin Admin</h3>
                <p>Administrator</p>
            </div>
        </div> --}}
        <nav class="sidebar-nav flex-column">
            <ul>
                <li class="">
                    <a href="#dashboard">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon">
                            <rect width="7" height="9" x="3" y="3" rx="1"></rect>
                            <rect width="7" height="5" x="14" y="3" rx="1"></rect>
                            <rect width="7" height="9" x="14" y="12" rx="1"></rect>
                            <rect width="7" height="5" x="3" y="16" rx="1"></rect>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="/admin/static_page">
                        <i class="bi bi-file-earmark icon"></i>
                        Static Page
                    </a>
                </li>
                <li>
                    <a href="/admin/article">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        บทความ
                    </a>
                </li>
                <li>
                    <a href="/admin/review_home">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon">
                            <path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"></path>
                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                            <path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"></path>
                            <path d="M2 7h20"></path>
                        </svg>
                        รีวิวบ้าน
                    </a>
                </li>
                <li>
                    <a href="/admin/privilege">
                        <i class="bi bi-star-fill icon"></i>
                        สิทธิพิเศษ
                    </a>
                </li>
                <li>
                    <a href="/admin/employee">
                        <img src="https://cdn-icons-png.flaticon.com/512/1134/1134182.png" class="icon"></i>
                        โครงสร้างพนักงาน
                    </a>
                </li>
                <li>
                    <a href="/admin/manage_faq">
                        <img src="https://static.thenounproject.com/png/610769-200.png" class="icon"></i>
                        คำถามที่พบบ่อย
                    </a>
                </li>
                <li>
                    <a href="/admin/work">
                        <img src="https://static.thenounproject.com/png/3754647-200.png" class="icon"></i>
                        รับสมัครงาน
                    </a>
                </li>
                <li>
                    <a href="/admin/profile">
                        <img src="https://www.svgrepo.com/show/375092/reset-password.svg" class="icon"></i>
                        จัดการบัญชีผู้ใช้
                    </a>
                </li>
                <!-- <li>
                <a href="#analytics">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path d="M3 3v18h18"></path><path d="m19 9-5 5-4-4-3 3"></path></svg>
                    Analytics
                </a>
            </li>
            <li>
                <a href="#settings">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    Settings
                </a>
            </li> -->
            </ul>
            <ul class="flex me-4 h-fit-content">
                <li class="flex justify-content-start row lang-link">
                    <a href="{{ url('lang/th') }}" class="col-1 hover:none">
                        <img src="/icon/ICON/thai.png" alt="Thai" title="ภาษาไทย">
                    </a>
                    <a href="{{ url('lang/en') }}" class="col-1 hover:none">
                        <img src="/icon/ICON/eng.png" alt="English" title="English">
                    </a>
                </li>
            </ul>
        </nav>
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>

    @yield('content')

    <div id="loading-indicator" style="display: none;">
        <img src="https://i.gifer.com/ZKZg.gif" alt="กำลังโหลด...">
    </div>

    <script type="module">
        // Global function to show loading indicator
        window.showLoading = function() {
            document.getElementById('loading-indicator').style.display = 'flex';
            document.querySelector("body").classList.add('hide-over') // Prevent scrolling while loading
        }

        // Global function to hide loading indicator
        window.hideLoading = function() {
            document.getElementById('loading-indicator').style.display = 'none';
            document.querySelector("body").classList.remove('hide-over') // Restore scrolling after loading
        }

        // Sidebar toggle functionality
        document.getElementById('closeSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').style.display = 'none';
        });

        import ToastTemplate from "/js/component/toast_template.js"
        const toastTemplate = new ToastTemplate();

        window.showToast = async (content, type) => {
            await toastTemplate.changeToast(content, "");
            await toastTemplate.showToast(type);
        }

        window.changePage = async (content, redirectPath, type) => {
            await toastTemplate.changeToast(content, redirectPath);
            await toastTemplate.redirect(type);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
</body>
<script>
    AOS.init();
</script>
</body>

</html>
