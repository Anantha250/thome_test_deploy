@extends('layouts.layout_admin')

@section('content')
    <link rel="stylesheet" href="/css/admin/article/manage.css">
    <link rel="stylesheet" href="/css/admin/user/manage.css">
    <link rel="stylesheet" href="/css/component/tag_selector.css">
    <div class="container">
        <header>
            <h1>จัดการบัญชี Admin</h1>
        </header>

        <div class="search-filter-container">
            <div class="search-box">
                <input type="text" id="search" placeholder="ค้นหาคำถาม...">
                <span class="search-icon">🔍</span>
            </div>
        </div>

        <section class="articles-section">
            <div class="table-container">
                <div class="table-header">
                    <h2>จัดการบัญชี Admin</h2>
                    <div>
                        <a id="add-tag" class="btn btn-primary border" style="display:none;">เพิ่ม tag</a>
                        <button id="add-article" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">เพิ่ม Admin</button>
                        <button class="btn btn-outline-success border" data-bs-target="#carouselExample"
                            data-bs-slide="next"> จัดการ tag → </button>
                        {{-- <button class="btn btn-warning active" data-bs-target="#carouselExample" data-bs-slide="next">จัดการแผนก →</button> --}}
                    </div>
                </div>
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item item-1 active">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="col-1">ID</th>
                                            <th class="col-4">name</th>
                                            <th class="col-4">username</th>
                                            <th class="col-2">การจัดการ</th>
                                            {{-- {{ dd($users) }} --}}
                                        </tr>
                                    </thead>
                                    <tbody id="articles-list">
                                        <!-- จะถูกเติมด้วย JavaScript -->
                                        @foreach ($users as $user)
                                            <tr data-id="{{ $user->id }}">
                                                <td>
                                                    {{ $user->id }}
                                                </td>
                                                <td>
                                                    {{ $user->name }}
                                                </td>
                                                <td>
                                                    {{ $user->username }}
                                                </td>
                                                <td class="actions-buttons">
                                                    <button class="btn btn-success add-lang-btn"
                                                        data-id="{{ $user['id'] }}" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop">
                                                        เปลี่ยนรหัสผ่าน
                                                    </button>
                                                    <button class="btn btn-edit" data-id="{{ $user['id'] }}"
                                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                        แก้ไข
                                                    </button>
                                                    <button class="btn btn-danger delete-article"
                                                        data-id="{{ $user['id'] }}">ลบ</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- @if ($users->isEmpty())
                                <div id="no-results" class="no-results">ไม่พบบทความที่ตรงกับการค้นหา</div>
                            @endif --}}
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">สร้างคำถามใหม่</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="lang-select">เลือกภาษา</label>
                            <select id="lang-select" class="form-select mb-2">
                                <option value="th">ไทย</option>
                                <option value="en">อังกฤษ</option>
                                <option value="cn">จีน</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="question">คำถาม</label>
                            <input type="text" id="question" class="form-control mb-2" placeholder="กรุณากรอกคำถาม">
                            {{-- <label for="question">คำถาม (อังกฤษ)</label>
                            <input type="text" id="question-eng" class="form-control"
                                placeholder="Please enter the question"> --}}
                        </div>
                        <div class="form-group mb-3">
                            <label for="ans">คำตอบ</label>
                            <textarea type="text" id="ans" class="form-control mb-2" placeholder="กรุณากรอกคำตอบ"></textarea>
                            {{-- <label for="ans">คำตอบ (อังกฤษ)</label>
                            <textarea type="text" id="ans-eng" class="form-control" placeholder="Please enter the answer"></textarea> --}}
                        </div>
                        <div id="tag-selector-container" data-mode="create"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" class="btn btn-primary submit" data-bs-dismiss="modal">สร้าง</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="tagBackdrop" data-bs-backdrop="tag" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="tagBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tagBackdropLabel">เพิ่มภาษา</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="lang-select">ชื่อแท็ก</label>
                            <input type="text" id="tag-name" class="form-control mb-2"
                                placeholder="กรุณากรอกชื่อแท็ก">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" class="btn btn-primary submit">สร้าง</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/admin/user/manage.js" type="module"></script>
    <script>
        const jj = @json($users);
        console.log(jj);
    </script>
@endsection
