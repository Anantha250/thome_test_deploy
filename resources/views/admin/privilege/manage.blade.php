@extends('layouts.layout_admin')

@section('content')
    <link rel="stylesheet" href="/css/admin/article/manage.css">
    <div class="container">
        <header>
            <h1>ระบบจัดการสิทธิพิเศษ</h1>
        </header>

        <div class="search-filter-container">
            <div class="search-box">
                <input type="text" id="search" placeholder="ค้นหาสิทธิพิเศษ...">
                <span class="search-icon">🔍</span>
            </div>
            <div class="filter-box">
                <label for="articles-filter">กรองตามแท็ก:</label>
                <select name="filter" id="articles-filter">
                    <option value="all">ทั้งหมด</option>
                    {{-- @foreach ($tags as $tag)
                        <option value="{{ $tag['id'] }}">{{ $tag->translation->name }}</option>
                    @endforeach --}}
                </select>
            </div>
        </div>

        <section class="articles-section">
            <div class="table-container">
                <div class="table-header">
                    <h2>จัดการสิทธิพิเศษ</h2>
                    <div>
                        <a id="add-article" class="btn btn-primary" href="/admin/privilege/create">เพิ่มสิทธิพิเศษ</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-1">ID</th>
                                <th class="col-3">รูปภาพ</th>
                                <th class="col-5">ชื่อหัวข้อ</th>
                                <th class="col-1">แท็ก</th>
                                <th class="col-2">การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody id="articles-list">
                            @foreach ($privileges as $privilege)
                                <tr data-id="{{ $privilege['id'] }}">
                                    <td class="d-none" label="available-languages">
                                        @foreach ($privilege['availablelang'] as $lang)
                                            <span>{{ $lang }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <span class="article-id">{{ $privilege['id'] }}</span>
                                    </td>
                                    <td>
                                        <img src="{{ $privilege->translation->coverPageImg }}" alt=""
                                            width="100%">
                                    </td>
                                    <td>
                                        <a href="/privilege/detail?news_id={{ $privilege->id }}"
                                            class="article-link">{{ $privilege->translation->title }}</a>
                                    </td>
                                    <td>
                                        {{-- @foreach ($privilege['tags'] as $tag)
                                                        <span class="tag">{{ $tag['name'] }}</span>
                                                    @endforeach --}}
                                    </td>
                                    <td class="actions-buttons">
                                        <button class="btn btn-info" btn-type="edit-id">แก้ ID</button>
                                        <button class="btn btn-success" btn-type="add-lang">เพิ่มภาษา</button>
                                        <button class="btn btn-edit" btn-type="edit">แก้ไข</button>
                                        <button class="btn btn-danger delete-article"
                                            data-id="{{ $privilege['id'] }}">ลบ</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($privileges->isEmpty())
                    <div id="no-results" class="no-results">ไม่พบสิทธิพิเศษที่ตรงกับการค้นหา</div>
                @endif

                {{ $privileges->links('vendor.pagination.default') }}
            </div>
        </section>
    </div>

    <script src="/js/admin/privilege/manage.js" type="module"></script>
@endsection
