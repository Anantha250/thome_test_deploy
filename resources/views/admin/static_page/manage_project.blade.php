@extends('layouts.layout_admin')

@section('content')
    <link rel="stylesheet" href="/css/admin/article/manage.css">
    <link rel="stylesheet" href="/css/admin/faq/manage.css">
    <link rel="stylesheet" href="/css/component/tag_selector.css">
    <style>
        .modal-content {
            top: 10%;
        }
    </style>
    <div class="container">
        <div>
            <a href="/admin/static_page/" class="btn btn-success">กลับไป</a>
        </div>
        <header>
            <h1>จัดการหน้า <span>{{ $pageName }}</span></h1>
        </header>

        <div class="search-filter-container">
            <div class="search-box">
                <input type="text" id="search" placeholder="ค้นหาโปรเจค...">
                <span class="search-icon">🔍</span>
            </div>
            <div class="filter-box">
                <label for="articles-filter">กรองตามแท็ก:</label>
                <select name="filter" id="articles-filter">
                    <option value="all">ทั้งหมด</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag['id'] }}">{{ $tag->translation['title']}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <section class="articles-section">
            <div class="table-container">
                <div class="table-header">
                    <h2>จัดการโปรเจค</h2>
                    <div>
                        <a id="add-tag" class="btn btn-primary border" style="display:none;">เพิ่ม tag</a>
                        <a id="add-article" class="btn btn-primary" href="/admin/static_page/project/{{ $pageName }}/create">เพิ่มผลงาน</a>
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
                                            <th class="col-3">ภาพหน้าปก</th>
                                            <th class="col-3">หัวข้อ</th>
                                            <th class="col-4">รายละเอียด</th>
                                            <th class="col-2">การจัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody id="articles-list">
                                        <!-- จะถูกเติมด้วย JavaScript -->
                                        @foreach ($projects as $project)
                                            <tr data-id="{{ $project->id }}">
                                                <td>
                                                    <img src="{{ $project->coverPageImg }}" alt="" width="100%">
                                                </td>
                                                <td>{{ $project->translation['title'] }}</td>
                                                <td>{{ $project->translation['detail'] }}</td>
                                                <td>
                                                    {{-- <button class="btn btn-success add-lang-btn"
                                                        data-id="{{ $project['id'] }}" data-bs-toggle="modal"
                                                        data-bs-target="#createBackdrop">
                                                        เพิ่มภาษา
                                                    </button> --}}
                                                    <button class="btn btn-success" data-id="{{ $project['id'] }}" btn-type="edit-lang">
                                                        {{-- data-bs-toggle="modal" data-bs-target="#createBackdrop"> --}}
                                                        แก้ไขภาษา
                                                    </button>
                                                    <a class="btn btn-info"
                                                        href="/admin/static_page/project/{{ $pageName }}/edit/{{ $project->id }}">
                                                        แก้ไขรูปภาพ
                                                    </a>

                                                    <form
                                                        action="/admin/static_page/project/{{ $pageName }}/{{ $project->id }}"
                                                        style="display:inline;" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('ต้องการลบใช่ไหม');">ลบ</button>
                                                    </form>
                                                </td>
                                                <td class="d-none">
                                                    @foreach ($project->translations as $translation)
                                                        <none class="lang-item">
                                                            <lang>{{ $translation['locale'] }}</lang>
                                                            <title>{{ $translation['title'] }}</title>
                                                            <detail>{{ $translation['detail'] }}</detail>
                                                        </none>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if ($projects->isEmpty())
                                <div id="no-results" class="no-results">ไม่พบโปรเจคที่ตรงกับการค้นหา</div>
                            @endif
                            {{ $projects->links('vendor.pagination.default') }}
                        </div>
                        <div class="carousel-item">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
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
                                                            {{ $t->th['title']}}
                                                        </div>
                                                        <button class="btn btn-warning" btn-type="tag-edit">
                                                            แก้ไข
                                                        </button>
                                                    </div>
                                                </td>
                                                <td data-locale="en">
                                                    @if ($t->en['locale'] == 'en')
                                                        <div>
                                                            <div>
                                                                {{ $t->en['title']}}
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
                                                    @if ($t->cn['locale'] == 'cn')
                                                        <div>
                                                            <div>
                                                                {{ $t->cn['title']}}
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
                                            {{-- <tr value="{{ $tag['id'] }}">{{ $tag->translation['title']}}</tr> --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <div class="modal fade" id="createBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="createBackdropLabel" aria-hidden="true">
            <form method="POST">
                @method('PUT')
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createBackdropLabel">แก้ไขภาษา <span></span> ของโปรเจค</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="d-none" name="locale">
                            <div class="form-group mb-3">
                                <label>ชื่อผลงาน</label>
                                <input type="text" name="title" class="form-control mb-2"
                                    placeholder="กรุณากรอกชื่อผลงาน" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>รายละเอียด</label>
                                <textarea name="detail" id="" class="form-control mb-2" placeholder="กรุณากรอกรายละเอียด" required></textarea>
                                {{-- <textarea name="detail" class="form-control mb-2"
                                    placeholder="กรุณากรอกรายละเอียด" required> --}}
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

    <script src="/js/admin/static_page/manage_project.js" type="module"></script>
    <script>
        const jj = @json($projects);
        console.log(jj);
    </script>
@endsection
