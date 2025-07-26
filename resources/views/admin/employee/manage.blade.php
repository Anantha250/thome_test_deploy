@extends('layouts.layout_admin')

@section('content')
    <link rel="stylesheet" href="/css/admin/employee/manage.css">
    <link rel="stylesheet" href="/css/component/image_overlay.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <div class="container">
        <header class="mb-3 mt-5 text-center" style="font-size: 2.2rem;">
            <h2> ระบบจัดการพนักงาน </h2>
        </header>
        <div class="mb-4 bg-white p-3 rounded shadow-sm d-flex justify-content-between">
            <div>
                @foreach ($major as $maj)
                    @if ($maj->id == $major_id)
                        <a class="btn btn-primary" href="/admin/employee?major={{ $maj->id }}"
                            style="pointer-events: none; ">
                            {{-- <i class="{{ $maj->icon }}"></i> --}}
                            {{ $maj->translation }}
                        </a>
                    @else
                        <a class="btn btn-outline-primary" href="/admin/employee?major={{ $maj->id }}">
                            {{-- <i class="{{ $maj->icon }}"></i> --}}
                            {{ $maj->translation }}
                        </a>
                    @endif
                @endforeach
            </div>
            <a class="btn btn-secondary" href="/admin/major_department">จัดการฝ่าย</a>
        </div>
        <div class="content" major-id="{{ $major_id }}">
            <div class="d-flex justify-content-end gap-3 mb-4">
                <button class="btn btn-outline-success de-edit-order" style="display: none;"> แก้ไขลำดับแผนก </button>
                <button class="btn btn-warning active" data-bs-target="#carouselExample" data-bs-slide="next">จัดการแผนก
                    →</button>
            </div>
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item active" carousel-item="1">
                        @foreach ($departments as $department)
                            <div class="w-100 mb-4" department-id="{{ $department->id }}">
                                <h3 class="text-center mb-2"> {{ $department->translation->name }} </h3>
                                <div
                                    class="w-100 d-flex flex-row flex-wrap align-items-stretch justify-content-center gap-5">
                                    @foreach ($department->employees as $employee)
                                        <div class="card sortable-card" employee-id="{{ $employee->id }}">
                                            <img src="{{ $employee->cover_image }}" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $employee->translation->name }}</h5>
                                                <div class="card-text">
                                                    <div>{{ $employee->translation->position }}</div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="#" class="btn btn-success em-add-lang" data-bs-toggle="modal"
                                                    data-bs-target="#employeeModal">เพิ่มภาษา</a>
                                                <a href="#" class="btn btn-warning em-edit" data-bs-toggle="modal"
                                                    data-bs-target="#employeeModal">แก้ไข</a>
                                                <a href="#" class="btn btn-danger em-delete">ลบ</a>
                                            </div>
                                            <div class="d-none">
                                                <div class="available-lang">
                                                    @foreach ($employee->translations as $translation)
                                                        <none class="lang-item" data-lang="{{ $translation->locale }}"
                                                            data-position="{{ $translation->position }}">
                                                            {{ $translation->name }} </none>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="free-card">
                                        <a data-bs-toggle="modal" data-bs-target="#employeeModal">เพิ่มพนักงาน</a>
                                    </div>
                                </div>
                            </div>

                            <hr>
                        @endforeach
                    </div>
                    <div class="carousel-item" carousel-item="2">
                        <div class="center">
                            <div class="block-container" id="sortable-container">
                                @foreach ($departments as $department)
                                    <div class="block" data-id="{{ $department->id }}">
                                        <h5>{{ $department->translation->name }}</h5>
                                        <div class="d-none">
                                            <div class="available-lang">
                                                @foreach ($department->translations as $translation)
                                                    <none class="lang-item" data-lang="{{ $translation->locale }}">
                                                        {{ $translation->name }} </none>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div>
                                            <a href="#" class="btn btn-success de-add-lang" data-bs-toggle="modal"
                                                data-bs-target="#departmentModal">เพิ่มภาษา</a>
                                            <a href="#" class="btn btn-warning de-edit" data-bs-toggle="modal"
                                                data-bs-target="#departmentModal">แก้ไข</a>
                                            <a href="#" class="btn btn-danger de-delete">ลบ</a>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="block free-block no-move">
                                    <a data-bs-toggle="modal" data-bs-target="#departmentModal"
                                        id="add-depart">สร้างแผนกใหม่</a>
                                </div>
                            </div>
                        </div>
                        <div class="align-right w-100 gap-2">
                            <a class="btn btn-secondary de-order-close" style="display: none;">ปิด</a>
                            <a class="btn btn-primary de-order-save" style="display: none;">
                                Save
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="employeeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="employeeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="employeeModalLabel">เพิ่มภาษา</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>ภาษา</label>
                            <select name="" id="" class="form-select">
                                <option value="th">ไทย</option>
                                <option value="en">อังกฤษ</option>
                                <option value="cn">จีน</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">ชื่อ-นามสกุล</label>
                            <input type="text" class="form-control" placeholder="กรอกชื่อ-นามสกุล" name="name"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">ตำแหน่ง</label>
                            <input type="text" class="form-control" placeholder="กรอกตำแหน่ง" name="position"
                                required>
                        </div>
                        <div class="cover-image-input mb-3">
                            <label for="">รูปพนักงาน</label>
                            <div>
                                <input type="file" id="eng-cover" accept="image/*"
                                    class="articleCoverImage eng form-control" name="image" requried>
                                <span class="btn btn-info view-cover">ดูรูปภาพ</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" class="btn btn-primary submit">ยืนยัน</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="departmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="departmentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="departmentModalLabel">เพิ่มแผนก</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>ภาษา</label>
                            <select name="" id="" class="form-select">
                                <option value="th">ไทย</option>
                                <option value="en">อังกฤษ</option>
                                <option value="cn">จีน</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">ชื่อแผนก</label>
                            <input type="text" class="form-control" placeholder="กรอกชื่อแผนก" name="name"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" class="btn btn-primary submit">ยืนยัน</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="imageOverlay" class="overlay">
        <span class="close-button">&times;</span>
        <img id="expandedImage" class="overlay-image" src="" alt="Full Image">
    </div>

    <script src="https://unpkg.com/pica@8.0.0/dist/pica.min.js"></script>
    <script type="module">
        import ResizeImage from '/js/component/resize_image.js';

        const resizeImage = new ResizeImage();
        resizeImage.addListener(document.getElementById('eng-cover'), "med");
    </script>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/js/admin/employee/manage.js" type="module"></script>
    {{-- <script>
        const deEditOrderBtn = document.querySelector(".de-edit-order");
        const deOrder = document.querySelector(".block-container");

    </script> --}}
@endsection
