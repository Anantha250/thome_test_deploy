@extends('layouts.layout_admin')

@section('content')
    <link rel="stylesheet" href="/css/admin/article/manage.css">
    <link rel="stylesheet" href="/css/admin/faq/manage.css">
    <style>
        .modal-content {
            top: 10%;
        }
    </style>
    <div class="container">
        <div>
            <a href="/admin/employee" class="btn btn-secondary">กลับไป</a>
        </div>
        <header>
            <h1>จัดการฝ่าย</h1>
        </header>

        {{-- <div class="search-filter-container">
            <div class="search-box">
                <input type="text" id="search" placeholder="ค้นหาคำถาม...">
                <span class="search-icon">🔍</span>
            </div>
            <div class="filter-box">
                <label for="articles-filter">กรองตามแท็ก:</label>
                <select name="filter" id="articles-filter">
                    <option value="all">ทั้งหมด</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag['id'] }}">{{ $tag->translation->name }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}

        <section class="articles-section">
            <div class="table-container">
                <div class="table-header">
                    <h2>จัดการฝ่าย</h2>
                    <a href="#" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#createBackdrop">เพิ่มฝ่าย</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-1">รหัสฝ่าย</th>
                                <th class="col-3">ชื่อฝ่าย th</th>
                                <th class="col-3">ชื่อฝ่าย en</th>
                                <th class="col-3">ชื่อฝ่าย cn</th>
                                <th class="col-2">การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody id="articles-list">
                            @foreach ($major as $department)
                                <tr de-id="{{ $department->id }}">
                                    <td>{{ $department->id }}</td>
                                    <td>{{ $department->locale['th'] }}</td>
                                    <td>{{ $department->locale['en'] }}</td>
                                    <td>{{ $department->locale['cn'] ?? '' }}</td>
                                    <td>
                                        <a href="#a" class="btn btn-primary" btn-type="edit" data-bs-toggle="modal"
                                            data-bs-target="#editBackdrop">แก้ไข</a>
                                        <form action="/admin/major_department/{{ $department->id }}"
                                        style="display:inline;" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('ต้องการลบใช่ไหม');">ลบ</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <div class="modal fade" id="createBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="createBackdropLabel" aria-hidden="true">
            <form action="/admin/major_department" method="POST">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createBackdropLabel">สร้างฝ่ายใหม่</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="">ธีมสี</label>
                                <select name="theme" id="" class="form-select">
                                    <option value="blue-theme">สีน้ำเงิน</option>
                                    <option value="green-theme">สีเขียว</option>
                                    <option value="red-theme">สีแดง</option>
                                    <option value="orange-theme">สีส้ม</option>
                                    <option value="purple-theme">สีม่วง</option>
                                    <option value="gray-theme">สีเทา</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="question">ภาษาไทย</label>
                                <input type="text" name="name-th" class="form-control mb-2"
                                    placeholder="กรุณากรอกชื่อฝ่าย" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="question">ภาษาอังกฤษ</label>
                                <input type="text" name="name-en" class="form-control mb-2"
                                    placeholder="กรุณากรอกชื่อฝ่าย" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="question">ภาษาจีน</label>
                                <input type="text" name="name-cn" class="form-control mb-2"
                                    placeholder="กรุณากรอกชื่อฝ่าย" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="submit" class="btn btn-primary submit" data-bs-dismiss="modal">สร้าง</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal fade" id="editBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="editBackdropLabel" aria-hidden="true">
            <form action="/admin/major_department/{{ $department->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editBackdropLabel">แก้ไขฝ่าย</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" hidden name="id">
                            <div class="form-group mb-3">
                                <label for="">ธีมสี</label>
                                <select name="theme" id="" class="form-select">
                                    <option value="blue-theme">สีน้ำเงิน</option>
                                    <option value="green-theme">สีเขียว</option>
                                    <option value="red-theme">สีแดง</option>
                                    <option value="orange-theme">สีส้ม</option>
                                    <option value="purple-theme">สีม่วง</option>
                                    <option value="gray-theme">สีเทา</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="question">ภาษาไทย</label>
                                <input type="text" name="name-th" class="form-control mb-2"
                                    placeholder="กรุณากรอกชื่อฝ่าย" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="question">ภาษาอังกฤษ</label>
                                <input type="text" name="name-en" class="form-control mb-2"
                                    placeholder="กรุณากรอกชื่อฝ่าย" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="question">ภาษาจีน</label>
                                <input type="text" name="name-cn" class="form-control mb-2"
                                    placeholder="กรุณากรอกชื่อฝ่าย" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="submit" class="btn btn-primary submit" data-bs-dismiss="modal">แก้ไข</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('a[btn-type="edit"]');
            const editBackdrop = document.getElementById('editBackdrop');
            editButtons.forEach((button) => {
                let parent = button.parentElement.parentElement;
                button.addEventListener('click', function() {
                    console.log('Edit button clicked');
                    editBackdrop.querySelector('form input[name="id"]').value = parent.getAttribute('de-id');
                    editBackdrop.querySelector('form input[name="name-th"]').value = parent
                        .querySelector('td:nth-child(2)').textContent.trim();
                    editBackdrop.querySelector('form input[name="name-en"]').value = parent
                        .querySelector('td:nth-child(3)').textContent.trim();
                    editBackdrop.querySelector('form input[name="name-cn"]').value = parent
                        .querySelector('td:nth-child(4)').textContent.trim();

                    editBackdrop.querySelector('form').action = `/admin/major_department/${parent.getAttribute('de-id')}`;

                    // console.log(editBackdrop.querySelector('form input[name="id"]').value)
                })
            })
        })
    </script>
@endsection
