@extends('layouts.layout_admin')

@section('content')
    <link rel="stylesheet" href="/css/admin/article/manage.css">
    <link rel="stylesheet" href="/css/admin/faq/manage.css">
    <link rel="stylesheet" href="/css/component/tag_selector.css">
    <div class="container">
        <header>
            <h1>คำถามที่พบบ่อย</h1>
        </header>

        <div class="search-filter-container">
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
        </div>

        <section class="articles-section">
            <div class="table-container">
                <div class="table-header">
                    <h2>จัดการคำถามที่พบบ่อย</h2>
                    <div>
                        <a id="add-tag" class="btn btn-primary border" style="display:none;">เพิ่ม tag</a>
                        <button id="add-article" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">เพิ่มคำถามที่พบบ่อย</button>
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
                                            {{-- <th>ID</th> --}}
                                            <th class="col-3">คำถาม</th>
                                            <th class="col-6">คำตอบ</th>
                                            <th class="col-1">แท็ก</th>
                                            <th class="col-2">การจัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody id="articles-list">
                                        <!-- จะถูกเติมด้วย JavaScript -->
                                        @foreach ($faqs as $faq)
                                            <tr data-id="{{ $faq->id }}">
                                                {{-- <td>
                                        {{ $faq->id }}
                                    </td> --}}
                                                <div class="d-none">
                                                    @foreach ($faq->translations as $translation)
                                                        <none class="lang-item">
                                                            <lang>{{ $translation->locale }}</lang>
                                                            <question>{{ $translation->question }}</question>
                                                            <answer>{{ $translation->answer }}</answer>
                                                        </none>
                                                    @endforeach
                                                </div>
                                                <td>
                                                    {{ $faq->translation->question }}
                                                </td>
                                                <td>
                                                    {{ $faq->translation->answer }}
                                                </td>
                                                <td>
                                                    @foreach ($faq['tags'] as $tag)
                                                        <span class="tag"
                                                            tag-id="{{ $tag->faq_tag_id }}">{{ $tag->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td class="actions-buttons">
                                                    <button class="btn btn-success add-lang-btn"
                                                        data-id="{{ $faq['id'] }}" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop">
                                                        เพิ่มภาษา
                                                    </button>
                                                    <button class="btn btn-edit" data-id="{{ $faq['id'] }}"
                                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                        แก้ไข
                                                    </button>
                                                    <button class="btn btn-danger delete-article"
                                                        data-id="{{ $faq['id'] }}">ลบ</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if ($faqs->isEmpty())
                                <div id="no-results" class="no-results">ไม่พบบทความที่ตรงกับการค้นหา</div>
                            @endif
                            {{ $faqs->links('vendor.pagination.default') }}
                        </div>
                        <div class="carousel-item">
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

    <script src="/js/admin/faq/manage.js" type="module"></script>
    <script>
        const jj = @json($faqs);
        console.log(jj);
    </script>
@endsection
