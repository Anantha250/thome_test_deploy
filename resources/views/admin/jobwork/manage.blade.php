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
        <header>
            <h1>จัดการรับสมัครงาน</h1>
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
                    <h2>จัดการรับสมัครงาน</h2>
                    <a href="#" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#createBackdrop">เพิ่มรับสมัครงาน</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-2">ตำแหน่ง</th>
                                <th class="col-5">requirement</th>
                                <th class="col-3">ที่ทำงาน</th>
                                <th class="col-2">การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody id="articles-list">
                            @foreach ($jobs as $job)
                                <tr de-id="{{ $job->id }}">
                                    <td>{{ $job->translation->position }}</td>
                                    <td>{{ $job->translation->requirements }}</td>
                                    <td>{{ $job->translation->location }}</td>
                                    <td>
                                        <a href="#a" class="btn btn-primary" btn-type="edit" data-bs-toggle="modal"
                                            data-bs-target="#editBackdrop">แก้ไข</a>
                                        <form action="/admin/work/{{ $job->id }}"
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
            <form action="/admin/work" method="POST">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createBackdropLabel">สร้างรับสมัครงานใหม่</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="">ที่ทำงาน</label>
                                <select name="loc" id="" class="form-select">
                                    <option value="Office">Office</option>
                                    <option value="Onsite">Onsite</option>
                                    <option value="Hybrid">Hybrid</option>
                                    <option value="Remote">Remote</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="position">ตำแหน่ง</label>
                                <input type="text" name="pos-th" class="form-control mb-2"
                                    placeholder="กรุณากรอกตำแหน่ง" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="position">ตำแหน่ง en</label>
                                <input type="text" name="pos-en" class="form-control mb-2"
                                    placeholder="กรุณากรอกตำแหน่ง" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="position">requirement</label>
                                <input type="text" name="req-th" class="form-control mb-2"
                                    placeholder="กรุณากรอก requirement" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="position">requirement en</label>
                                <input type="text" name="req-en" class="form-control mb-2"
                                    placeholder="กรุณากรอก requirement" required>
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
            <form method="POST">
                @csrf
                @method('PUT')
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editBackdropLabel">แก้ไขรับสมัครงาน</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="">ที่ทำงาน</label>
                                <select name="loc" id="" class="form-select">
                                    <option value="Office">Office</option>
                                    <option value="Onsite">Onsite</option>
                                    <option value="Hybrid">Hybrid</option>
                                    <option value="Remote">Remote</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="position">ตำแหน่ง</label>
                                <input type="text" name="pos-th" class="form-control mb-2"
                                    placeholder="กรุณากรอกตำแหน่ง" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="position">ตำแหน่ง en</label>
                                <input type="text" name="pos-en" class="form-control mb-2"
                                    placeholder="กรุณากรอกตำแหน่ง" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="position">requirement</label>
                                <input type="text" name="req-th" class="form-control mb-2"
                                    placeholder="กรุณากรอก requirement" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="position">requirement en</label>
                                <input type="text" name="req-en" class="form-control mb-2"
                                    placeholder="กรุณากรอก requirement" required>
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
            console.log(editBackdrop)
            const jobworks = @json($jobs);
            console.log(jobworks)

            editButtons.forEach((button) => {
                let parent = button.parentElement.parentElement;
                button.addEventListener('click', function() {
                    console.log('Edit button clicked');
                    const job = jobworks.find(job => job.id == parent.getAttribute('de-id'));
                    console.log(job);
                    // editBackdrop.querySelector('form input[name="id"]').value = parent.getAttribute('de-id');
                    editBackdrop.querySelector('form input[name="pos-th"]').value = job.th.position;
                    editBackdrop.querySelector('form input[name="pos-en"]').value = job.en.position;
                    editBackdrop.querySelector('form input[name="req-th"]').value = job.th.requirements;
                    editBackdrop.querySelector('form input[name="req-en"]').value = job.en.requirements;
                    editBackdrop.querySelector('form select').value = job.location;

                    editBackdrop.querySelector('form').action = `/admin/work/${parent.getAttribute('de-id')}`;
                    // console.log(editBackdrop.querySelector('form input[name="id"]').value)
                })
            })
        })
    </script>
@endsection
