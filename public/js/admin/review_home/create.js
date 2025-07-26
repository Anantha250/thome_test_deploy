import ConfirmDialog from "/js/component/confirm_dialog.js";
import { createTagSelector } from "/js/component/tag_selector.js";
import BilingualTagSelector from "/js/component/hashtag_selector.js";

const confirmDialog = new ConfirmDialog();
const btnSubmit = document.getElementById("submit");
const titleEle = document.getElementById("title");
const cover = document.getElementById("cover");
const overlay = document.getElementById("imageOverlay");
const expandedImage = document.getElementById("expandedImage");
const closeButton = document.querySelector(".close-button");
const coverImgInput = document.querySelectorAll(".cover-image-input");

const projectSelector = document.getElementById("projectSelector");
let hashTagSelector;

function makeid(length = 40) {
    var result = "";
    var characters =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(
            Math.floor(Math.random() * charactersLength)
        );
    }
    return result;
}

async function tag_selector() {
    const initHashTag = [];
    if (location.href.includes("edit")) {
        document.querySelectorAll(".hashtag-fetch div").forEach((tag) => {
            let obj = {};
            tag.querySelectorAll("span").forEach((span) => {
                obj[span.getAttribute("lang")] = span.textContent.trim();
            });
            initHashTag.push(obj);
        });
    }
    hashTagSelector = new BilingualTagSelector("tagContainer", initHashTag);
}

function initListener() {
    //submit
    btnSubmit.addEventListener("click", async function () {
        // console.log("tag :", hashTagSelector.selectedTags)
        const title = titleEle.value;
        if (title === "" || cover.files.length === 0) {
            window.showToast("กรุณาใส่ชื่อรีวิวบ้านและอัปโหลดภาพหน้าปก", "error");
            return;
        }

        async function uploadImg(formData, filename = makeid()) {
            formData.append("folder", `review_home`);
            formData.append("filename", filename + ".png");
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
                return Error("Failed to upload image. Please try again.");
            }
            let path = await response.text();
            path = path.replace("public/", "/storage/");
            return path;
        }

        async function uploadTagImage(tag) {
            const note = $(tag).summernote("code");
            const noteDiv = document.createElement("NoneTag");
            noteDiv.innerHTML = note;

            const imagePromises = [];

            for (const img of Array.from(noteDiv.querySelectorAll("img"))) {
                const src = img.getAttribute("src");
                if (src.startsWith("data:image")) {
                    const blob = await fetch(src).then((res) => res.blob());
                    const readFilePromise = new Promise((resolve, reject) => {
                        var a = new FileReader();
                        a.readAsArrayBuffer(blob);
                        a.onloadend = async function () {
                            try {
                                const formData = new FormData();
                                const filename = SparkMD5.ArrayBuffer.hash(
                                    a.result
                                );
                                console.log("filename: ", filename);
                                formData.append(
                                    "image",
                                    blob,
                                    `${filename}.png`
                                );
                                const path = await uploadImg(
                                    formData,
                                    filename
                                );
                                img.setAttribute("src", path);
                                resolve();
                            } catch (error) {
                                reject(error);
                            }
                        };
                    });
                    imagePromises.push(readFilePromise);
                }
            }
            await Promise.all(imagePromises);
            return noteDiv.innerHTML;
        }

        async function uploadCoverImage(cover) {
            const coverFile = document.getElementById(cover).files[0];
            const formData = new FormData();
            formData.append("image", coverFile);
            const urlParams = new URLSearchParams(window.location.search);
            const langParam = urlParams.get("lang") || "th";
            const path = await uploadImg(formData, `${title}-${cover}-${langParam}`);
            // const path = await uploadImg(formData, title + "-" + cover + "-" + );
            return path;
        }

        if (location.href.includes("edit")) {
            confirmDialog.confirmAction(
                "ยืนยันการแก้ไขรีวิวบ้าน",
                "คุณต้องการแก้ไขหรือไม่",
                "ไม่",
                "ยืนยัน",
                "",
                async () => {
                    const note1 = await uploadTagImage("#summernote1");
                    const coverPath = await uploadCoverImage("cover");
                    const req = {
                        title: title,
                        content: note1,
                        coverPageImg: coverPath,
                        project: projectSelector.value,
                        hashtags: hashTagSelector.getSelectedTags()
                    };
                    window.showLoading();
                    const res = await fetch(
                        window.location.pathname + window.location.search,
                        {
                            method: "PUT",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector(
                                    'meta[name="csrf-token"]'
                                ).content,
                            },
                            body: JSON.stringify(req),
                        }
                    );

                    if (res.ok) {
                        window.showToast("แก้ไขรีวิวบ้านสำเร็จ", "success");
                        window.hideLoading();
                        window.location.href = "/admin/review_home";
                    } else {
                        const errorText = await res.text();
                        console.log("errorText: ", errorText);
                        window.showToast(
                            "เกิดข้อผิดพลาดในการแก้ไขรีวิวบ้าน",
                            "error"
                        );
                        window.hideLoading();
                    }
                }
            );
        } else if (location.href.includes("add_lang")) {
            confirmDialog.confirmAction(
                "ยืนยันการสร้างภาษาใหม่",
                "คุณต้องการสร้างภาษาใหม่หรือไม่",
                "ไม่",
                "ยืนยัน",
                "",
                async () => {
                    const note1 = await uploadTagImage("#summernote1");
                    const coverPath = await uploadCoverImage("cover");
                    const req = {
                        title: title,
                        content: note1,
                        coverPageImg: coverPath,
                    };
                    window.showLoading();
                    const res = await fetch(
                        window.location.pathname + window.location.search,
                        {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector(
                                    'meta[name="csrf-token"]'
                                ).content,
                            },
                            body: JSON.stringify(req),
                        }
                    );

                    if (res.ok) {
                        window.showToast("แก้ไขรีวิวบ้านสำเร็จ", "success");
                        window.hideLoading();
                        window.location.href = "/admin/review_home";
                    } else {
                        const errorText = await res.text();
                        console.log("errorText: ", errorText);
                        window.showToast(
                            "เกิดข้อผิดพลาดในการแก้ไขรีวิวบ้าน",
                            "error"
                        );
                        window.hideLoading();
                    }
                }
            );
        } else {
            confirmDialog.confirmAction(
                "ยืนยันการสร้างรีวิวบ้าน",
                "คุณต้องการสร้างหรือไม่",
                "ไม่",
                "ยืนยัน",
                "",
                async () => {
                    const note1 = await uploadTagImage("#summernote1");
                    const coverPath = await uploadCoverImage("cover");
                    const req = {
                        title: title,
                        content: note1,
                        coverPageImg: coverPath,
                        project: projectSelector.value,
                        hashtags: hashTagSelector.getSelectedTags()
                    };
                    window.showLoading();
                    const res = await fetch("/admin/review_home/create", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content,
                        },
                        body: JSON.stringify(req),
                    });
                    if (res.ok) {
                        window.showToast("สร้างรีวิวบ้านสำเร็จ", "success");
                        window.hideLoading();
                        setTimeout(() => {
                            window.location.href = "/admin/review_home";
                        }, 2500);
                    } else {
                        const errorText = await res.text();
                        console.log("errorText: ", errorText);
                        window.showToast(
                            "เกิดข้อผิดพลาดในการสร้างรีวิวบ้าน",
                            "error"
                        );
                        window.hideLoading();
                    }
                }
            );
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

document.addEventListener("DOMContentLoaded", function () {
    if (!location.href.includes("add_lang")) tag_selector();
    initListener();
    initOverlay();

    // document.getElementById("test-test").addEventListener("click", async function () {
    //     coverImgInput.forEach((container) => {
    //         const inputFile = container.querySelector("input[type=file]")
    //         var a = new FileReader();
    //         a.readAsArrayBuffer(inputFile.files[0]);
    //         a.onloadend = function () {
    //             console.log(SparkMD5.ArrayBuffer.hash(a.result));
    //         };
    //     })
    // })
});
