import ResizeImage from "/js/component/resize_image.js";

const resizeImage = new ResizeImage();
const relateImagesInput = document.querySelectorAll(".multiple-upload");

let uploadedImages = [];
let currentImageIndex = 0;

// Overlay elements
const imageOverlay = document.getElementById("imageOverlay");
const overlayImage = document.getElementById("overlayImage");
const overlayClose = document.getElementById("overlayClose");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");
const overlayCounter = document.getElementById("overlayCounter");

// Overlay event listeners
overlayClose.addEventListener("click", closeOverlay);
prevBtn.addEventListener("click", showPrevImage);
nextBtn.addEventListener("click", showNextImage);
imageOverlay.addEventListener("click", function (e) {
    if (e.target === imageOverlay) {
        closeOverlay();
    }
});

// Keyboard navigation
document.addEventListener("keydown", function (e) {
    if (imageOverlay.classList.contains("active")) {
        switch (e.key) {
            case "Escape":
                closeOverlay();
                break;
            case "ArrowLeft":
                showPrevImage();
                break;
            case "ArrowRight":
                showNextImage();
                break;
        }
    }
});

const fileInput = document.getElementById("fileInput");
const uploadArea = document.getElementById("uploadArea");
const imagesGrid = document.getElementById("imagesGrid");
const fileCount = document.getElementById("fileCount");
const clearAllBtn = document.getElementById("clearAllBtn");

// Event listeners
fileInput.addEventListener("change", handleFileSelect);
uploadArea.addEventListener("click", () => fileInput.click());
uploadArea.addEventListener("dragover", handleDragOver);
uploadArea.addEventListener("dragleave", handleDragLeave);
uploadArea.addEventListener("drop", handleDrop);

function handleFileSelect(event) {
    const files = Array.from(event.target.files);
    processFiles(files);
}

function handleDragOver(event) {
    event.preventDefault();
    uploadArea.classList.add("dragover");
}

function handleDragLeave(event) {
    event.preventDefault();
    uploadArea.classList.remove("dragover");
}

function handleDrop(event) {
    event.preventDefault();
    uploadArea.classList.remove("dragover");

    const files = Array.from(event.dataTransfer.files).filter((file) =>
        file.type.startsWith("image/")
    );

    if (files.length > 0) {
        processFiles(files);
    }
}

function processFiles(files) {
    files.forEach((file) => {
        if (file.type.startsWith("image/")) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const imageData = {
                    id: Date.now() + Math.random(),
                    name: file.name,
                    size: formatFileSize(file.size),
                    src: e.target.result,
                };

                uploadedImages.push(imageData);
                displayImage(imageData);
                updateFileCount();
            };

            reader.readAsDataURL(file);
        }
    });
}

function displayImage(imageData) {
    const imageCard = document.createElement("div");
    imageCard.className = "image-card";
    imageCard.setAttribute("data-id", imageData.id);

    imageCard.innerHTML = `
                <img src="${imageData.src}" alt="${
        imageData.name
    }" class="image-preview" onclick="openOverlay(${
        uploadedImages.length - 1
    })">
                <button class="delete-btn" onclick="deleteImage(${
                    imageData.id
                })" title="ลบภาพ">×</button>
                <div class="image-info">
                    <div class="image-name">${imageData.name}</div>
                    <div class="image-size">${imageData.size}</div>
                </div>
            `;

    imagesGrid.appendChild(imageCard);
}

function deleteImage(imageId) {
    // Remove from array
    uploadedImages = uploadedImages.filter((img) => img.id !== imageId);

    // Remove from DOM
    const imageCard = document.querySelector(`[data-id="${imageId}"]`);
    if (imageCard) {
        imageCard.style.transform = "scale(0)";
        imageCard.style.opacity = "0";
        setTimeout(() => {
            imageCard.remove();
            updateFileCount();
        }, 300);
    }
}

function clearAllImages() {
    if (confirm("คุณต้องการลบภาพทั้งหมดหรือไม่?")) {
        uploadedImages = [];
        imagesGrid.innerHTML = "";
        fileInput.value = "";
        updateFileCount();
    }
}

function updateFileCount() {
    const count = uploadedImages.length;

    if (count > 0) {
        fileCount.textContent = `ภาพทั้งหมด: ${count} ไฟล์`;
        fileCount.style.display = "block";
        clearAllBtn.style.display = "inline-block";
    } else {
        fileCount.style.display = "none";
        clearAllBtn.style.display = "none";
    }
}

function formatFileSize(bytes) {
    if (bytes === 0) return "0 Bytes";

    const k = 1024;
    const sizes = ["Bytes", "KB", "MB", "GB"];
    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + " " + sizes[i];
}

function openOverlay(index) {
    if (uploadedImages.length === 0) return;

    currentImageIndex = index;
    updateOverlayContent();
    imageOverlay.classList.add("active");
    document.body.style.overflow = "hidden"; // Prevent scrolling
}

function closeOverlay() {
    imageOverlay.classList.remove("active");
    document.body.style.overflow = "auto"; // Restore scrolling
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
    overlayCounter.textContent = `${currentImageIndex + 1} / ${
        uploadedImages.length
    }`;

    // Update navigation buttons
    prevBtn.disabled = currentImageIndex === 0;
    nextBtn.disabled = currentImageIndex === uploadedImages.length - 1;
}

relateImagesInput.forEach((input) => {
    input.addEventListener("change", function () {
        console.log("Input changed:", input);
        const files = Array.from(input.files);
        const container = input.parentElement.querySelector(".relate-images");
        container.innerHTML = ""; // Clear previous images
        files.forEach((file) => {
            const img = document.createElement("img");
            img.src = URL.createObjectURL(file);
            img.classList.add("img-thumbnail", "mb-2");
            img.style.width = "100px"; // Set a fixed width for the thumbnail
            container.appendChild(img);
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {});
