@extends('layouts.layout_home')

@section('content')
    <link rel="stylesheet" href="/css/home/service/view_project.css">
    <div class="content-box">
        <div class="content-box">

            <div class="interior-container">
                <!-- Banner Image -->
                <div class="interior-banner">
                    <img id="thumbnail" alt="Project Thumbnail" src="{{ $project->coverPageImg }}">
                </div>

                <!-- Text Box -->
                <div class="banner-text">
                    <div class="review-title" id="project-name"> {{ $project->translation['title'] }}</div>
                    <div class="photo-description" id="project-description">{{ $project->translation['detail'] }}</div>
                </div>
            </div>

            <!-- Related Images -->
            <div class="review-page">
                <h3 class="related-images-title">รูปภาพที่เกี่ยวข้อง</h3>
                <div class="image-gallery" id="image-list">
                    @foreach ($project->images as $image)
                        <div class="image-item">
                            <img src="{{ $image }}" onclick="openModal('{{ $image }}')">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Modal for Zoomed Image (ใช้ fullImage ตามที่คุณต้องการ) -->
            <div id="imageModal" class="modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="fullImage" alt="Zoomed Image">
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const params = new URLSearchParams(window.location.search);
                    const id = params.get('id') || 1;

                    // ฟังก์ชันแสดง modal
                    function openModal(src) {
                        document.getElementById("imageModal").classList.add("show");
                        document.getElementById("fullImage").src = src;
                        document.body.style.overflow = "hidden"; // ปิดการเลื่อนของ body
                    }

                    // ปิด modal
                    document.querySelector("#imageModal .close").addEventListener("click", function() {
                        document.getElementById("imageModal").classList.remove("show");
                        document.body.style.overflow = ""; // เปิดการเลื่อนของ body
                    });

                    document.getElementById("imageModal").addEventListener("click", function(e) {
                        if (e.target === this) {
                            this.classList.remove("show");
                        }
                    });

                    // ให้ modal ใช้งานได้ทั่ว scope
                    window.openModal = openModal;
                });
            </script>

        </div>
    </div>
@endsection
