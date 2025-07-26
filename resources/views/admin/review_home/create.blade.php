@extends('layouts.layout_admin')

@section('import', 'bootstrap')

@section('content')
    <link rel="stylesheet" href="/css/admin/article/create.css">
    <link rel="stylesheet" href="/css/component/tag_selector.css">
    <link rel="stylesheet" href="/css/component/image_overlay.css">
    <div class="container">
        <h2 class="text-center">
            @if (@isset($house))
                @if (request()->is('*edit*'))
                    แก้ไขรีวิวบ้าน
                @else
                    เพิ่มภาษารีวิวบ้าน
                @endif
                ({{ request()->query('lang') }}) <span data-id="{{ $house['id'] }}"></span>
            @else
                สร้างรีวิวบ้าน (ภาษาไทย)
            @endif
        </h2>

        <form id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="input-group article-input">
                <div>
                    <label for="title">ชื่อรีวิวบ้าน</label>
                    <input type="text" id="title" class="articleName thai form-control"
                        placeholder="กรอกชื่อรีวิวบ้านภาษาไทย" required>
                </div>
                <div class="cover-image-input">
                    <label for="cover">รูปภาพหน้าปก</label>
                    <div>
                        <input type="file" id="cover" accept="image/*" class="articleCoverImage thai form-control"
                            required>
                        <span class="btn btn-info view-cover">ดูรูปภาพ</span>
                    </div>
                </div>

                @if (!request()->is('*add_lang*'))
                    <div>
                        <label for="">เลือก Project</label>
                        <select name="" id="projectSelector" class="form-control">
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->translation }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label>สร้าง hashtag</label>
                        <div class="tag-input-container" id="tagContainer">
                            <input type="text" class="tag-input" id="tagInput"
                                placeholder="Search or create new tags...">
                            <div class="options-container" id="optionsContainer"></div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="item active thai">
                <h2>เนื้อหา</h2>
                <div id="summernote1"></div>
            </div>

            <a id="submit" class="btn btn-success">บันทึก</a>
        </form>

        <div id="imageOverlay" class="overlay">
            <span class="close-button">&times;</span>
            <img id="expandedImage" class="overlay-image" src="" alt="Full Image">
        </div>

        @if (!request()->is('*add_lang*'))
            <div class="modal_hashtag-overlay" id="bilingualmodal_hashtag">
                <div class="modal_hashtag">
                    <div class="modal_hashtag-header">
                        <h3 class="modal_hashtag-title">Create Bilingual Tag</h3>
                        <button class="modal_hashtag-close" id="modal_hashtagClose">&times;</button>
                    </div>
                    <div class="modal_hashtag-body">
                        <div class="form-group">
                            <label class="form-label" for="thaiTagInput">Thai (ภาษาไทย)</label>
                            <input type="text" class="form-input" id="thaiTagInput" placeholder="ป้ายชื่อภาษาไทย">
                            <div class="form-error" id="thaiTagError">Thai text is required</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="englishTagInput">English</label>
                            <input type="text" class="form-input" id="englishTagInput" placeholder="English tag name">
                            <div class="form-error" id="englishTagError">English text is required</div>
                        </div>
                    </div>
                    <div class="modal_hashtag-footer">
                        <button class="btn btn-secondary" id="cancelBtn">Cancel</button>
                        <button class="btn btn-primary" id="createTagBtn">Create Tag</button>
                    </div>
                </div>
            </div>
        @endif


        {{-- summernote --}}
        <script src="https://unpkg.com/pica@8.0.0/dist/pica.min.js"></script>
        <script type="module">
            import ResizeImage from '/js/component/resize_image.js';

            const resizeImage = new ResizeImage();

            $(document).ready(function() {
                var resize75Btn = function(context) {
                    var ui = $.summernote.ui;

                    var button = ui.button({
                        contents: '<span class="note-fontsize-10">75%</span>',
                        tooltip: 'Resize to 75%',
                        click: function() {
                            context.invoke('editor.resize', '0.75');
                        }
                    });

                    return button.render(); // return button as jquery object
                }

                const settings = {
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'italic', 'clear']],
                        ['fontname', ['fontname', 'fontsize', 'color', 'backcolor']],
                        ['para', ['ul', 'ol', 'hr', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'help']],
                    ],
                    popover: {
                        image: [
                            ['image', ['resizeFull', 'resize75', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                            ['float', ['paragraph']],
                            ['remove', ['removeMedia']]
                        ],
                        link: [
                            ['link', ['linkDialogShow', 'unlink']]
                        ],
                        table: [
                            ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                            ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                        ],
                        air: [
                            ['color', ['color']],
                            ['font', ['bold', 'underline', 'clear']],
                            ['para', ['ul', 'paragraph']],
                            ['table', ['table']],
                        ]
                    },
                    fontNames: ['FCSound', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact',
                        'Lucida Sans Unicode', 'Tahoma', 'Times New Roman', 'Trebuchet MS', 'Verdana'
                    ],
                    fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '22', '24', '26', '28', '36',
                        '48', '64', '82'
                    ],
                    fontNamesIgnoreCheck: ['FCSound'],
                    buttons: {
                        resize75: resize75Btn
                    },
                    callbacks: {
                        onImageUpload: function(files) {
                            for (let i = 0; i < files.length; i++) {
                                resizeAndInsert(files[i]);
                            }
                        },
                    }
                }

                $('#summernote1').summernote(settings);
                resizeImage.addListener(document.getElementById("cover"), "large");

                async function resizeAndInsert(file) {
                    const img = new Image();
                    const reader = new FileReader();

                    reader.onload = async function(e) {

                        await resizeImage.resizeBase64(e.target.result, "small").then((res) => {
                            console.log("resss : ", res);
                            const img = $('<img>').attr('src', res.base64).css('width', '100%');
                            $('#summernote1').summernote('insertNode', img[0]);
                        })
                    };


                    reader.readAsDataURL(file);
                }
            });
        </script>
    </div>

    <div class="tag-fetch hidden">
        @foreach ($projects as $project)
            <div data-id="{{ $project['id'] }}">
                <span>{{ $project->translation }}</span>
            </div>
        @endforeach
    </div>

    {{--  --}}
    @if (isset($house))
        @if (!request()->is('*add_lang*'))
            <div class="selected-tag-fetch hidden">
                <div data-id="{{ $house['project_id'] }}">
                    <span>{{ $house['project'] }}</span>
                </div>
            </div>
            <div class="hashtag-fetch hidden">
                @foreach ($house['hashtags'] as $hashtag)
                    <div>
                        @foreach ($hashtag as $key => $h)
                            <span lang="{{ $key }}">{{ $h }}</span>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const jj = @json($house);
                const titleThEle = document.getElementById("title");
                const coverThai = document.getElementById("cover");

                titleThEle.value = jj.translation.title;

                setTimeout(() => {
                    document.querySelector('.item.thai .note-editable').innerHTML = jj.translation.content;
                }, 100);

                fetch(jj.translation.coverPageImg)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.blob()
                    })
                    .then(blob => {
                        const url = URL.createObjectURL(blob);
                        const file = new File([blob], 'cover.jpg', {
                            type: blob.type
                        });

                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        document.getElementById('cover').files = dataTransfer.files;
                    });
            });
        </script>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spark-md5/3.0.2/spark-md5.min.js"></script>
    <script src="/js/admin/review_home/create.js" type="module"></script>
@endsection
