@extends('layouts.layout_admin')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/article/manage.css') }}">
    <div class="container">
        <header>
            <h1>ระบบรีวิวบ้าน</h1>
        </header>

        <div class="search-filter-container">
            <div class="search-box">
                <input type="text" id="search" placeholder="ค้นหารีวิวบ้าน...">
                <span class="search-icon">🔍</span>
            </div>
            <div class="filter-box">
                <label for="articles-filter">กรองตามแท็ก:</label>
                <select name="filter" id="articles-filter">
                    <option value="all">ทั้งหมด</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project['id'] }}">{{ $project->translation }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <section class="articles-section">
            <div class="table-container">
                <div class="table-header">
                    <h2>จัดการรีวิวบ้าน</h2>
                    <div>
                        <a id="add-tag" class="btn btn-primary border" style="display:none;">เพิ่ม project</a>
                        <a id="add-article" class="btn btn-primary" href="/admin/review_home/create">เพิ่มรีวิวบ้าน</a>
                        <button class="btn btn-outline-success border" data-bs-target="#carouselExample"
                            data-bs-slide="next">จัดการ Project → </button>
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
                                            <th class="col-3">รูปภาพ</th>
                                            <th class="col-5">ชื่อโพสท์</th>
                                            <th class="col-1">โครงการ</th>
                                            <th class="col-2">การจัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody id="articles-list">
                                        @foreach ($houses as $house)
                                            <tr data-id="{{ $house['id'] }}">
                                                <td class="d-none" label="available-languages">
                                                    @foreach ($house['availablelang'] as $lang)
                                                        <span>{{ $lang }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span class="article-id">{{ $house['id'] }}</span>
                                                </td>
                                                <td>
                                                    <img src="{{ $house->translation->coverPageImg }}" alt=""
                                                        width="100%">
                                                </td>
                                                <td>
                                                    <a href="/review/detail?news_id={{ $house->id }}"
                                                        class="article-link">{{ $house->translation->title }}</a>
                                                </td>
                                                <td>
                                                    <span class="tag">{{ $house['project'] }}</span>
                                                </td>
                                                <td class="actions-buttons">
                                                    <button class="btn btn-info" btn-type="edit-id">แก้ ID</button>
                                                    <button class="btn btn-success" btn-type="add-lang">เพิ่มภาษา</button>
                                                    <button class="btn btn-edit" btn-type="edit">แก้ไข</button>
                                                    <button class="btn btn-danger delete-article"
                                                        data-id="{{ $house['id'] }}">ลบ</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if ($houses->isEmpty())
                                <div id="no-results" class="no-results">ไม่พบรีวิวบ้านที่ตรงกับการค้นหา</div>
                            @endif

                            {{ $houses->links('vendor.pagination.default') }}
                        </div>
                        <div class="carousel-item ">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            {{-- <th>ID</th> --}}
                                            <th class="col-4">ภาษาไทย</th>
                                            <th class="col-4">ภาษาอังกฤษ</th>
                                            <th class="col-4">ภาษาจีน</th>
                                            <th class="col-1">การจัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tags-list">
                                        @foreach ($projects as $project)
                                            <tr tag-id="{{ $project->id }}">
                                                <td data-locale="th">
                                                    <div>
                                                        <div>
                                                            {{ $project->th }}
                                                        </div>
                                                        <button class="btn btn-warning" btn-type="tag-edit">
                                                            แก้ไข
                                                        </button>
                                                    </div>
                                                </td>
                                                <td data-locale="en">
                                                    <div>
                                                        <div>
                                                            {{ $project->en }}
                                                        </div>
                                                        <button class="btn btn-warning" btn-type="tag-edit">
                                                            แก้ไข
                                                        </button>
                                                    </div>
                                                </td>
                                                <td data-locale="cn">
                                                    @if (@isset($project->cn))
                                                        <div>
                                                            <div>
                                                                {{ $project->cn }}
                                                            </div>
                                                            <button class="btn btn-warning" btn-type="tag-edit">
                                                                แก้ไข
                                                            </button>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <div>
                                                                ยังไม่มีภาษาจีน
                                                            </div>
                                                            <button class="btn btn-success" btn-type="tag-addlang">
                                                                เพิ่มภาษา
                                                            </button>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="actions-buttons">
                                                    <button class="btn btn-danger" btn-type='tag-delete'>ลบ</button>
                                                </td>
                                                {{-- <td>{{ $project }}</td> --}}
                                                {{-- {{ dd($project->translations) }} --}}
                                                {{-- @foreach ($project['th'] as $projectt)
                                                    <td>{{ $projectt['locale'] }}</td>
                                                @endforeach --}}
                                            </tr>
                                            {{-- <tr value="{{ $project['id'] }}">{{ $project->translation->name }}</tr> --}}
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>
    </div>

    <script src="{{ asset('js/admin/review_home/manage.js') }}" type="module"></script>
    <script></script>
@endsection
