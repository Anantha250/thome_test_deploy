@extends('layouts.layout_admin')

@section('content')
    <link rel="stylesheet" href="/css/admin/static_page/create_project.css">
    <link rel="stylesheet" href="/css/component/image_overlay.css">

    <div class="container">
        <header>
            <h1>
                @if (isset($project))
                    แก้ไข
                @else
                    สร้าง
                @endif
                project หน้า <span>{{ $pageName }}</span></h1>
        </header>

        <div class="body">
            <div class="form-container">
                <div class="d-flex justify-content-between gap-4">
                    <div class="form-group mb-3" style="flex: 1;">
                        <label>เลือก tag</label>
                        @if (isset($project))
                            <select name="" id="tag-select" class="form-select" value="{{ $project->tag->id }}">
                                <option value="">เลือก tag</option>
                                @foreach ($tags as $tag)
                                    @if ($tag->id == $project->tag->id)
                                        <option class="form-option" value="{{ $tag->id }}" selected>
                                            {{ $tag->translation['title'] }}
                                        </option>
                                    @else
                                        <option class="form-option" value="{{ $tag->id }}">
                                            {{ $tag->translation['title'] }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        @else
                            <select name="" id="tag-select" class="form-select">
                                <option value="">เลือก tag</option>
                                @foreach ($tags as $tag)
                                    <option class="form-option" value="{{ $tag->id }}">{{ $tag->translation['title'] }}
                                    </option>
                                @endforeach
                            </select>
                        @endif

                    </div>
                    <div class="form-group mb-3 cover-image-input" style="flex: 1;">
                        <label>รูปภาพหน้าปก</label>
                        <div class="d-flex gap-3">
                            <input type="file" accept="image/*" name="coverPageImg" class="form-control mb-2"
                                placeholder="" required style="flex: 1;">
                            <span class="btn btn-info view-cover"
                                style="width: fit-content; height: fit-content;">ดูรูปภาพ</span>
                        </div>
                    </div>
                </div>

                @if (!isset($project))
                    <div class="form-group mb-3">
                        <label>ชื่อผลงาน</label>
                        <input type="text" name="title" class="form-control mb-2" placeholder="กรุณากรอกชื่อผลงาน"
                            required>
                    </div>
                    <div class="form-group mb-3">
                        <label>รายละเอียด</label>
                        <textarea type="text" id="detail" name="detail" class="form-control mb-2" placeholder="กรุณาใส่รายละเอียด"></textarea>
                    </div>
                @endif

                <div class="form-group mb-3">
                    <label>รูปภาพที่เกี่ยวข้อง</label>
                    <div class="upload-section">
                        <div class="upload-area" id="uploadArea">
                            <div class="upload-icon">📁</div>
                            <div class="upload-text">คลิกเพื่อเลือกไฟล์ภาพ</div>
                            <div class="upload-subtext">หรือลากไฟล์มาวางที่นี่</div>
                            <div class="upload-subtext">รองรับ: JPG, PNG, GIF, WebP</div>
                        </div>

                        <input type="file" id="fileInput" accept="image/*">

                        <div style="text-align: center;" class="mt-3">
                            <button class="btn btn-primary " onclick="document.getElementById('fileInput').click()">
                                เลือกไฟล์ภาพ
                            </button>
                            <button class="btn clear-all-btn" id="clearAllBtn" onclick="clearAllImages()"
                                style="display: none;">
                                ลบทั้งหมด
                            </button>
                        </div>

                        <div class="file-count" id="fileCount" style="display: none;"></div>

                        <div class="images-grid" id="imagesGrid">
                            {{-- @if (isset($project))
                                @foreach ($project->images as $image)
                                    <div class="image-card">

                                        <img src="{{ $image }}" class="image-preview">
                                        <button class="delete-btn" onclick="deleteImage()" title="ลบภาพ">×</button>

                                    </div>
                                @endforeach
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button btn-type="submit" class="btn btn-success px-5 py-2" style="font-size: 2rem;">บันทึก</button>
            </div>
            @if (isset($project))
                <div class="d-none">
                    <span proj="true">{{ $project->id }}</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Overlay Modal -->
    <div class="overlay-other" id="imageOverlay">
        <button class="overlay-close" id="overlayClose">×</button>
        <div class="overlay-content">
            <button class="overlay-nav prev" id="prevBtn">‹</button>
            <button class="overlay-nav next" id="nextBtn">›</button>

            <img src="/placeholder.svg" alt="" class="overlay-image-other" id="overlayImage">

            <div class="overlay-counter" id="overlayCounter"></div>
        </div>
    </div>

    <div id="coverImageOverlay" class="overlay">
        <span class="close-button">&times;</span>
        <img id="expandedImage" class="overlay-image" src="" alt="Full Image">
    </div>

    <script>
        document.querySelectorAll('textarea').forEach(textarea => {
            textarea.addEventListener("input", () => {
                textarea.style.height = "5px";
                textarea.style.height = textarea.scrollHeight + "px";
            });
        });
    </script>
    <script src="https://unpkg.com/pica@8.0.0/dist/pica.min.js"></script>
    <script type="module">
        import ResizeImage from '/js/component/resize_image.js';

        const resizeImage = new ResizeImage();
        resizeImage.addListener(document.querySelector('input[name="coverPageImg"]'))

        document.querySelectorAll("textarea").forEach((textarea) => {
            textarea.addEventListener("input", () => {
                textarea.style.height = "5px";
                textarea.style.height = textarea.scrollHeight + "px";
            });
        })

        let uploadedImages = [];
        let currentImageIndex = 0;

        // Overlay elements
        const imageOverlay = document.getElementById('imageOverlay');
        const overlayImage = document.getElementById('overlayImage');
        const overlayClose = document.getElementById('overlayClose');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const overlayCounter = document.getElementById('overlayCounter');

        // Overlay event listeners
        overlayClose.addEventListener('click', closeOverlay);
        prevBtn.addEventListener('click', showPrevImage);
        nextBtn.addEventListener('click', showNextImage);
        imageOverlay.addEventListener('click', function(e) {
            if (e.target === imageOverlay) {
                closeOverlay();
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (imageOverlay.classList.contains('active')) {
                switch (e.key) {
                    case 'Escape':
                        closeOverlay();
                        break;
                    case 'ArrowLeft':
                        showPrevImage();
                        break;
                    case 'ArrowRight':
                        showNextImage();
                        break;
                }
            }
        });

        const fileInput = document.getElementById('fileInput');
        const uploadArea = document.getElementById('uploadArea');
        const imagesGrid = document.getElementById('imagesGrid');
        const fileCount = document.getElementById('fileCount');
        const clearAllBtn = document.getElementById('clearAllBtn');

        // Event listeners
        fileInput.addEventListener('change', handleFileSelect);
        uploadArea.addEventListener('click', () => fileInput.click());
        uploadArea.addEventListener('dragover', handleDragOver);
        uploadArea.addEventListener('dragleave', handleDragLeave);
        uploadArea.addEventListener('drop', handleDrop);

        function handleFileSelect(event) {
            const files = Array.from(event.target.files);
            processFiles(files);
        }

        function handleDragOver(event) {
            event.preventDefault();
            uploadArea.classList.add('dragover');
        }

        function handleDragLeave(event) {
            event.preventDefault();
            uploadArea.classList.remove('dragover');
        }

        function handleDrop(event) {
            event.preventDefault();
            uploadArea.classList.remove('dragover');

            const files = Array.from(event.dataTransfer.files).filter(file =>
                file.type.startsWith('image/')
            );

            if (files.length > 0) {
                processFiles(files);
            }
        }

        function processFiles(files) {
            files.forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = async function(e) {
                        await resizeImage.resizeBase64(e.target.result, "small").then((res) => {
                            const imageData = {
                                id: Date.now() + Math.random(),
                                name: file.name,
                                size: formatFileSize(file.size),
                                src: res.base64
                            };
                            console.log("resss : ", res);
                            uploadedImages.push(imageData);
                            displayImage(imageData);
                            updateFileCount();
                            // console.log("resss : ", res);
                        });
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        @if (isset($project))
            function handleEditImages() {
                const jj = @json($project->images);

                jj.forEach((src) => {
                    const imageData = {
                        id: Date.now() + Math.random(),
                        name: Date.now() + Math.random() + ".jpg",
                        size: "100 kb",
                        src: src
                    }
                    uploadedImages.push(imageData);
                    displayImage(imageData);
                    updateFileCount();
                })
            }

            const coverImg = @json($project->coverPageImg);
            fetch(coverImg)
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
                    document.querySelector('input[name="coverPageImg"]').files = dataTransfer.files;
                });

            handleEditImages();
        @endif

        function displayImage(imageData) {
            const imageCard = document.createElement('div');
            imageCard.className = 'image-card';
            imageCard.setAttribute('data-id', imageData.id);

            console.log("imageData : ", imageData);
            imageCard.innerHTML = `
                <img src="${imageData.src}" alt="${imageData.name}" class="image-preview">
                <button class="delete-btn" title="ลบภาพ">×</button>
                <div class="image-info">
                    <div class="image-name">${imageData.name}</div>
                    <div class="image-size">${imageData.size}</div>
                </div>
            `;
            let round = uploadedImages.length - 1;
            imageCard.querySelector('img').addEventListener('click', () => {
                openOverlay(round);
            })
            imageCard.querySelector('button').addEventListener('click', () => {
                deleteImage(imageData.id);
            })
            imagesGrid.appendChild(imageCard);
        }

        function deleteImage(imageId) {
            // Remove from array
            uploadedImages = uploadedImages.filter(img => img.id !== imageId);

            // Remove from DOM
            const imageCard = document.querySelector(`[data-id="${imageId}"]`);
            if (imageCard) {
                imageCard.style.transform = 'scale(0)';
                imageCard.style.opacity = '0';
                setTimeout(() => {
                    imageCard.remove();
                    updateFileCount();
                }, 300);
            }
        }

        function clearAllImages() {
            if (confirm('คุณต้องการลบภาพทั้งหมดหรือไม่?')) {
                uploadedImages = [];
                imagesGrid.innerHTML = '';
                fileInput.value = '';
                updateFileCount();
            }
        }

        function updateFileCount() {
            const count = uploadedImages.length;

            if (count > 0) {
                fileCount.textContent = `ภาพทั้งหมด: ${count} ไฟล์`;
                fileCount.style.display = 'block';
                clearAllBtn.style.display = 'inline-block';
            } else {
                fileCount.style.display = 'none';
                clearAllBtn.style.display = 'none';
            }
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';

            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));

            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function openOverlay(index) {
            if (uploadedImages.length === 0) return;

            currentImageIndex = index;
            updateOverlayContent();
            imageOverlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }

        function closeOverlay() {
            imageOverlay.classList.remove('active');
            document.body.style.overflow = 'auto'; // Restore scrolling
        }

        function showPrevImage() {
            if (currentImageIndex > 0) {
                currentImageIndex--;
                updateOverlayContent();
            }
        }

        function showNextImage() {
            if (currentImageIndex < uploadedImages.length - 1) {
                currentImageIndex++;
                updateOverlayContent();
            }
        }

        function updateOverlayContent() {
            const currentImage = uploadedImages[currentImageIndex];

            overlayImage.src = currentImage.src;
            overlayImage.alt = currentImage.name;
            overlayCounter.textContent = `${currentImageIndex + 1} / ${uploadedImages.length}`;

            // Update navigation buttons
            prevBtn.disabled = currentImageIndex === 0;
            nextBtn.disabled = currentImageIndex === uploadedImages.length - 1;
        }

        // Prevent default drag behaviors on the document
        document.addEventListener('dragover', function(e) {
            e.preventDefault();
        });

        document.addEventListener('drop', function(e) {
            e.preventDefault();
        });
    </script>
    <script src="/js/admin/static_page/create_project.js"></script>
@endsection
