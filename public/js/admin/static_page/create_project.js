const pageName = document.querySelector("header h1 span").textContent.trim();

const coverImgInput = document.querySelectorAll(".cover-image-input");
const overlay = document.getElementById("coverImageOverlay");
const expandedImage = document.getElementById("expandedImage");
const closeButton = document.querySelector(".close-button");

const tagSelect = document.getElementById("tag-select");
const coverInput = document.querySelector('input[name="coverPageImg"]');
const titleInput = document.querySelector('input[name="title"]');
const detailInput = document.getElementById("detail");
const imageGrid = document.querySelector(".images-grid");
const submitButton = document.querySelector('button[btn-type="submit"]');

let imagePathList = [];

function sendForm() {
    function validateForm() {
        if (!titleInput.value.trim()) {
            alert("กรุณากรอกชื่อโปรเจค");
            return false;
        }
        if (!detailInput.value.trim()) {
            alert("กรุณากรอกรายละเอียดโปรเจค");
            return false;
        }
        return validateEdit();
    }

    function validateEdit() {
        if (!tagSelect.value) {
            alert("กรุณาเลือก Tag");
            return false;
        }
        if (!coverInput.files.length) {
            alert("กรุณาเลือกภาพปก");
            return false;
        }
        if (imageGrid.querySelectorAll(".image-preview").length == 0) {
            alert("กรุณาเพิ่มภาพโปรเจค");
            return false;
        }
        return true;
    }

    function uploadCover() {
        const file = coverInput.files[0];
        const formData = new FormData();
        formData.append("image", file);
        return uploadImg(formData);
    }

    async function uploadRelate() {
        imagePathList = [];
        const imagePreviews = document.querySelectorAll(".image-preview");

        // const imagePromises = Array.from(imagePreviews).map(async (preview) => {
        //     const src = preview.getAttribute("src");
        //     if (src.startsWith("data:image")) {
        //         const blob = await fetch(src).then((res) => res.blob());
        //         const formData = new FormData();
        //         formData.append("image", blob, `image.png`);
        //         return await uploadImg(formData);
        //     }
        //     return src; // Skip if not a data URL
        // });
        const imagePromises = [];
        imagePreviews.forEach((preview) => {
            const promise = new Promise(async (resolve) => {
                const src = preview.getAttribute("src");
                if (src.startsWith("data:image")) {
                    const blob = await fetch(src).then((res) => res.blob());
                    const formData = new FormData();
                    formData.append("image", blob, `image.png`);
                    const path = await uploadImg(formData);
                    imagePathList.push(path);
                } else {
                    imagePathList.push(src);
                }
                resolve();
            });
            imagePromises.push(promise);
        });

        await Promise.all(imagePromises);
    }

    async function uploadImg(formData) {
        const response = await fetch("/admin/upload_image", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
            body: formData,
        });
        if (!response.ok) {
            const ttt = await response.text();
            console.log("Failed to upload image:", ttt);
            return Error("Failed to upload image. Please try again.");
        }
        let path = await response.text();
        return path;
    }

    submitButton.addEventListener("click", async (e) => {
        console.log("submitButton clicked");

        if (location.href.includes("edit")) {
            if (!validateEdit()) {
                e.preventDefault(); // Prevent form submission if validation fails
                return;
            }
            window.showLoading();
            const projectId = document.querySelector('span[proj="true"]').textContent.trim();

            await uploadRelate();
            const coverPath = await uploadCover();
            const data = {
                tag: tagSelect.value,
                coverPageImg: coverPath,
                images: imagePathList,
            };

            const res = await fetch(`/admin/static_page/project/${pageName}/${projectId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify(data),
            });
            window.hideLoading();
            if (!res.ok) {
                const errorText = await res.text();
                alert(`Error: ${errorText}`);
                return;
            }
            window.showToast("แก้ไขโปรเจคสำเร็จ", "success");

            setTimeout(() => {
                window.location.href = `/admin/static_page/project/${pageName}`;
            }, 2500); // Redirect after 2.5 seconds
        } else {
            if (!validateForm()) {
                e.preventDefault(); // Prevent form submission if validation fails
                return;
            }
            window.showLoading();
            await uploadRelate();
            const coverPath = await uploadCover();
            const data = {
                tag: tagSelect.value,
                coverPageImg: coverPath,
                title: titleInput.value.trim(),
                detail: detailInput.value.trim(),
                images: imagePathList,
            };

            const res = await fetch(`/admin/static_page/project/${pageName}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify(data),
            });
            window.hideLoading();
            if (!res.ok) {
                const errorText = await res.text();
                alert(`Error: ${errorText}`);
                return;
            }
            window.showToast("สร้างโปรเจคสำเร็จ", "success");

            setTimeout(() => {
                window.location.href = `/admin/static_page/project/${pageName}`;
            }, 2500); // Redirect after 2.5 seconds
        }
    });
}

function initOverlay() {
    coverImgInput.forEach((container) => {
        container.querySelector("span").addEventListener("click", function () {
            const inputFile = container.querySelector("input[type=file]");
            if (inputFile.files.length != 0) {
                expandedImage.src = URL.createObjectURL(inputFile.files[0]);
                overlay.style.display = "flex"; // Show the overlay
            }
        });
    });

    closeButton.addEventListener("click", function () {
        overlay.style.display = "none"; // Hide the overlay
    });

    // Close overlay when clicking outside the image
    overlay.addEventListener("click", function (event) {
        if (event.target === this) {
            this.style.display = "none";
        }
    });
}

document.addEventListener("DOMContentLoaded", () => {
    initOverlay();
    sendForm();
});
