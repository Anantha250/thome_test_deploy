@extends('layouts.layout_admin')

@section('content')
    <link rel="stylesheet" href="/css/admin/article/manage.css">
    <div class="container">
        <header>
            <h1>ระบบจัดการบทความ</h1>
        </header>

        <div class="search-filter-container">
            <div class="search-box">
                <input type="text" id="search" placeholder="ค้นหาบทความ...">
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
        </div>

        <section class="articles-section">
            <div class="table-container">
                <div class="table-header">
                    <h2>จัดการบทความ</h2>
                    <div>
                        <a id="add-tag" class="btn btn-primary border" style="display:none;">เพิ่ม tag</a>
                        <a id="add-article" class="btn btn-primary" href="/admin/article/create">เพิ่มบทความ</a>
                        <button class="btn btn-outline-success border" data-bs-target="#carouselExample"
                            data-bs-slide="next">จัดการ tag → </button>
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
                                            <th class="col-5">ชื่อหัวข้อ</th>
                                            <th class="col-1">แท็ก</th>
                                            <th class="col-2">การจัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody id="articles-list">
                                        @foreach ($articles as $article)
                                            <tr data-id="{{ $article['id'] }}">
                                                <td class="d-none" label="available-languages">
                                                    @foreach ($article['availablelang'] as $lang)
                                                        <span>{{ $lang }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span class="article-id">{{ $article['id'] }}</span>
                                                </td>
                                                <td>
                                                    <img src="{{ $article->translation->coverPageImg }}" alt=""
                                                        width="100%">
                                                </td>
                                                <td>
                                                    <a href="/article/detail?news_id={{ $article->id }}"
                                                        class="article-link">{{ $article->translation->title }}</a>
                                                </td>
                                                <td>
                                                    @foreach ($article['tags'] as $tag)
                                                        <span class="tag">{{ $tag['name'] }}</span>
                                                    @endforeach
                                                </td>
                                                <td class="actions-buttons">
                                                    <button class="btn btn-info" btn-type="edit-id">แก้ ID</button>
                                                    <button class="btn btn-success" btn-type="add-lang">เพิ่มภาษา</button>
                                                    <button class="btn btn-edit" btn-type="edit">แก้ไข</button>
                                                    <button class="btn btn-danger delete-article"
                                                        data-id="{{ $article['id'] }}">ลบ</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if ($articles->isEmpty())
                                <div id="no-results" class="no-results">ไม่พบบทความที่ตรงกับการค้นหา</div>
                            @endif

                            {{ $articles->links('vendor.pagination.default') }}
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
                                        @foreach ($tags as $t)
                                            <tr tag-id="{{ $t->id }}">
                                                <td data-locale="th">
                                                    <div>
                                                        <div>
                                                            {{ $t->th->name }}
                                                        </div>
                                                        <button class="btn btn-warning" btn-type="tag-edit">
                                                            แก้ไข
                                                        </button>
                                                    </div>
                                                </td>
                                                <td data-locale="en">
                                                    @if ($t->en->locale == 'en')
                                                        <div>
                                                            <div>
                                                                {{ $t->en->name }}
                                                            </div>
                                                            <button class="btn btn-warning" btn-type="tag-edit">
                                                                แก้ไข
                                                            </button>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <div>
                                                                ยังไม่มีภาษาอังกฤษ
                                                            </div>

                                                            <button class="btn btn-success" btn-type="tag-addlang">
                                                                เพิ่มภาษา
                                                            </button>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td data-locale="cn">
                                                    @if ($t->cn->locale == 'cn')
                                                        <div>
                                                            <div>
                                                                {{ $t->cn->name }}
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
                                                {{-- <td>{{ $t }}</td> --}}
                                                {{-- {{ dd($t->translations) }} --}}
                                                {{-- @foreach ($t['th'] as $tt)
                                                    <td>{{ $tt['locale'] }}</td>
                                                @endforeach --}}
                                            </tr>
                                            {{-- <tr value="{{ $tag['id'] }}">{{ $tag->translation->name }}</tr> --}}
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

    <script src="/js/admin/article/manage.js" type="module"></script>
@endsection
