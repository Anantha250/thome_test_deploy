// employee
import ConfirmDialog from "/js/component/confirm_dialog.js";
const confirmDialog = new ConfirmDialog();

const contentDiv = document.querySelector(".content");

const emAddLang = document.querySelectorAll(".em-add-lang");
const emEdit = document.querySelectorAll(".em-edit");
const emDelete = document.querySelectorAll(".em-delete");
const emCreate = document.querySelectorAll(".free-card a");

const emModal = document.getElementById("employeeModal");
const emModalHeader = emModal.querySelector(".modal-header h1");
const emModalBody = emModal.querySelector(".modal-body");
const emModalSubmit = emModal.querySelector(".submit");

const emSelect = emModal.querySelector("select");
const emName = emModal.querySelector("input[name='name']");
const emPosition = emModal.querySelector("input[name='position']");
const emImage = emModal.querySelector("input[name='image']");



// department
const deAddLang = document.querySelectorAll(".de-add-lang");
const deEdit = document.querySelectorAll(".de-edit");
const deDelete = document.querySelectorAll(".de-delete");
const deCreate = document.getElementById("add-depart");
const deEditOrderBtn = document.querySelector(".de-edit-order");
const deOrder = document.querySelector(".block-container");
const deOrderClose = document.querySelector(".de-order-close");
const deOrderSave = document.querySelector(".de-order-save");

const deModal = document.getElementById("departmentModal");
const deModalHeader = deModal.querySelector(".modal-header h1");
const deModalBody = deModal.querySelector(".modal-body");
const deModalSubmit = deModal.querySelector(".submit");

const deSelect = deModal.querySelector("select");
const deName = deModal.querySelector("input[name='name']");

const coverImgInput = document.querySelectorAll(".cover-image-input");
const overlay = document.getElementById("imageOverlay");
const expandedImage = document.getElementById("expandedImage");
const closeButton = document.querySelector(".close-button");

const carousel1 = document.querySelector('div[carousel-item="1"]');
const carousel2 = document.querySelector('div[carousel-item="2"]');

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

function initCarousel() {
    const btn = document.querySelector(
        'button[data-bs-target="#carouselExample"]'
    );
    btn.addEventListener("click", function () {
        if (
            document
                .querySelector(".carousel-item")
                .classList.contains("active")
        ) {
            console.log("case1");
            btn.innerText = "← จัดการพนักงาน";
            deEditOrderBtn.style.display = "block";
            btn.setAttribute("data-bs-slide", "prev");
        } else {
            console.log("case2");
            btn.innerText = "จัดการแผนก →";
            deEditOrderBtn.style.display = "none";
            btn.setAttribute("data-bs-slide", "next");
        }
    });
}

function initDepartmentActions() {
    deCreate.addEventListener("click", function () {
        deModal.setAttribute("data-action", "create");
        deModalHeader.textContent = "เพิ่มแผนกใหม่";
        deSelect.value = "th";
        deSelect.disabled = true;
        deName.value = "";
        console.log("Create Department Modal Opened", deSelect.value);
    });

    deAddLang.forEach((btn) => {
        const superParent = btn.parentNode.parentNode;
        btn.addEventListener("click", function () {
            deModal.setAttribute("data-action", "add-lang");
            deModal.setAttribute(
                "data-id",
                superParent.getAttribute("data-id")
            );
            deSelect.disabled = false;
            deName.value = "";
            deModalHeader.textContent = "เพิ่มภาษา";

            const dataFetch = superParent.querySelector(".d-none");
            const availableLang = new Set();
            dataFetch.querySelectorAll(".lang-item").forEach((lang) => {
                availableLang.add(lang.getAttribute("data-lang"));
            });
            console.log("Available Languages:", availableLang);

            // Disable options in the select element based on available languages
            let flag = false;
            deSelect.querySelectorAll("option").forEach((option) => {
                if (availableLang.has(option.value)) {
                    option.disabled = true; // Disable already used languages
                } else {
                    option.disabled = false; // Enable available languages
                    deSelect.value = option.value;
                    flag = true; // Set flag to true if at least one option is available
                }
            });

            if (!flag) {
                window.showToast(
                    "ไม่สามารถเพิ่มภาษาได้ เนื่องจากแผนกนี้มีทุกภาษาแล้ว",
                    "error"
                );
                deModalSubmit.disabled = true;
            }
        });
    });

    deEdit.forEach((btn) => {
        const superParent = btn.parentNode.parentNode;
        btn.addEventListener("click", function () {
            deModal.setAttribute("data-action", "edit");
            deModal.setAttribute(
                "data-id",
                superParent.getAttribute("data-id")
            );
            deSelect.disabled = false;
            deModalHeader.textContent = "แก้ไขแผนก";

            const dataFetch = superParent.querySelector(".d-none");
            const availableLang = new Set();
            const availableLangObj = {};
            dataFetch.querySelectorAll(".lang-item").forEach((lang) => {
                availableLang.add(lang.getAttribute("data-lang"));
                availableLangObj[lang.getAttribute("data-lang")] =
                    lang.textContent.trim();
            });
            console.log("Available Languages:", availableLang);

            // Disable options in the select element based on available languages
            let flag = false;
            deSelect.querySelectorAll("option").forEach((option) => {
                if (availableLang.has(option.value)) {
                    option.disabled = false; // Disable already used languages
                    deSelect.value = option.value;
                    flag = true;
                    deName.value = availableLangObj[option.value];
                } else {
                    option.disabled = true; // Enable available languages
                    // option.replaceWith(option.cloneNode(true));
                }
            });

            deSelect.addEventListener("change", function () {
                deName.value = availableLangObj[deSelect.value] || "";
            });

            if (!flag) {
                window.showToast(
                    "ไม่สามารถเพิ่มภาษาได้ เนื่องจากแผนกนี้มีทุกภาษาแล้ว",
                    "error"
                );
                deModalSubmit.disabled = true;
            }
        });
    });

    deDelete.forEach((btn) => {
        const superParent = btn.parentNode.parentNode;
        btn.addEventListener("click", async function () {
            const deId = superParent.getAttribute("data-id");
            confirmDialog.confirmAction(
                "ลบแผนก",
                "ข้อมูลแผนกและพนักงานในแผนกจะหายไป",
                "ไม่",
                "ลบ",
                '<button class="confirm-btn active confirm-yes" id="confirmYes"> Yes </button>',
                async () => {
                    window.showLoading();
                    await fetch(`/admin/department/${deId}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content,
                        },
                    }).then(async (res) => {
                        if (res.ok) {
                            window.hideLoading();
                            window.showToast("ลบแผนกเรียบร้อยแล้ว", "success");
                            let de = carousel1.querySelector(`div[department-id="${deId}"]`);
                            de.nextElementSibling.remove();
                            de.remove();
                            carousel2.querySelector(`div[data-id="${deId}"]`).remove();
                        } else {
                            window.hideLoading();
                            window.showToast(
                                "เกิดข้อผิดพลาดในการลบแผนก",
                                "error"
                            );
                            const text = await res.text();
                            console.error("Error response:", text);
                        }
                    });
                }
            );
        });
    });

    deModalSubmit.addEventListener("click", async function () {
        if (deModal.getAttribute("data-action") === "create") {
            window.showLoading();
            await fetch("/admin/department", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({
                    major_id: contentDiv.getAttribute("major-id"),
                    locale: "th",
                    name: deName.value.trim(),
                }),
            }).then(async (res) => {
                if (res.ok) {
                    let deId;
                    res = await res.json();
                    deId = res.id;

                    window.hideLoading();
                    window.showToast("เพิ่มแผนกใหม่เรียบร้อยแล้ว", "success");

                    setTimeout(() => {
                        location.reload();
                    }, 2000)
                    // let newDiv = document.createElement("div");
                    // newDiv.className = "w-100 mb-4";
                    // newDiv.setAttribute("department-id", res.id);

                    // newDiv.innerHTML = `
                    //             <h3 class="text-center mb-2"> ${deName.value.trim()} </h3>
                    //             <div class="w-100 d-flex flex-row flex-wrap align-items-stretch justify-content-center gap-5">
                    //                                                     <div class="free-card">
                    //                     <a data-bs-toggle="modal" data-bs-target="#employeeModal">เพิ่มพนักงาน</a>
                    //                 </div>
                    //             </div>`;

                    // const emCreateBtn = newDiv.querySelector("a");
                    // console.log(emCreateBtn);
                    // emCreateClickEvent(emCreateBtn);

                    // carousel1.appendChild(newDiv);
                    // carousel1.appendChild(document.createElement("hr"));
                } else {
                    window.hideLoading();
                    window.showToast("เกิดข้อผิดพลาดในการเพิ่มแผนก", "error");
                    const text = await res.text();
                    console.error("Error response:", text);
                    console.log({
                        locale: "th",
                        name: deName.value,
                    });
                }
            });
        } else {
            const deId = deModal.getAttribute("data-id");
            window.showLoading();
            await fetch(`/admin/department/${deId}`, {
                method: "PUT",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({
                    locale: deSelect.value,
                    name: deName.value.trim(),
                }),
            }).then(async (res) => {
                if (res.ok) {
                    window.hideLoading();
                    window.showToast("แก้ไขแผนกเรียบร้อยแล้ว", "success");
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                } else {
                    window.hideLoading();
                    window.showToast("เกิดข้อผิดพลาดในการแก้ไขแผนก", "error");
                    const text = await res.text();
                    console.error("Error response:", text);
                }
            });
        }
    });

    deEditOrderBtn.addEventListener("click", function () {
        deEditOrderBtn.style.display = "none";
        deOrderSave.style.display = "block";
        deOrderClose.style.display = "block";
        window.showToast("ลากและวางเพื่อจัดเรียงแผนกใหม่", "simple");
        $(function () {
            $(".block-container").sortable({
                // Optional: Add a handle if you only want a specific part of the block to be draggable
                // handle: "h5", // or "h3" or a specific class
                // Optional: Callback after an item has been dropped
                update: function (event, ui) {
                    // You can get the new order of items here
                    var newOrder = $(this).sortable("toArray", {
                        attribute: "data-id",
                    });
                    console.log("New order of data-ids:", newOrder);
                    // If you need to send the new order to a server:
                    // $.post('/save_order', { order: newOrder });
                },
            });
            $("#sortable-container").disableSelection(); // Prevents text selection during drag
        });
    });

    deOrderSave.addEventListener("click", function () {
        const order = [];

        deOrder.querySelectorAll(".block").forEach((block) => {
            if (block.getAttribute("data-id"))
                order.push(block.getAttribute("data-id"));
        });

        console.log("Order to save:", JSON.stringify(order));

        confirmDialog.confirmAction(
            "บันทึกการจัดเรียงแผนก",
            "ยืนยันการบันทึกการจัดเรียงแผนกใหม่หรือไม่",
            "ไม่",
            "บันทึก",
            '<button class="confirm-btn active confirm-yes" id="confirmYes"> Yes </button>',
            async () => {
                window.showLoading();
                await fetch(`/admin/department/reorder`, {
                    method: "post",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                    },
                    body: JSON.stringify(order),
                }).then(async (res) => {
                    if (res.ok) {
                        window.hideLoading();
                        window.showToast("บันทึกเรียบร้อยแล้ว", "success");
                        $(".block-container").sortable("destroy");
                        deEditOrderBtn.style.display = "block";
                        deOrderSave.style.display = "none";
                        deOrderClose.style.display = "none";
                    } else {
                        window.hideLoading();
                        window.showToast("เกิดข้อผิดพลาดในการบันทึก", "error");
                        const text = await res.text();
                        console.error("Error response:", text);
                    }
                });
            }
        );
    });

    deOrderClose.addEventListener("click", function () {
        deEditOrderBtn.style.display = "block";
        deOrderSave.style.display = "none";
        deOrderClose.style.display = "none";
        $(".block-container").sortable("destroy");
    });
}

function emCreateClickEvent(btn) {
    const superParent = btn.parentNode.parentNode.parentNode;
    btn.addEventListener("click", function () {
        emModal.setAttribute("data-action", "create");
        emModal.setAttribute(
            "department-id",
            superParent.getAttribute("department-id")
        );
        emModalHeader.textContent = "เพิ่มพนักงานใหม่";
        emSelect.value = "th";
        emSelect.disabled = true;
        emName.value = "";
        emPosition.value = "";
        emImage.value = "";
        emImage.disabled = false;
        console.log("Create Employee Modal Opened", emSelect.value);
    });
}

function initEmployeeActions() {
    emCreate.forEach((btn) => {
        emCreateClickEvent(btn);
    });

    emAddLang.forEach((btn) => {
        const superParent = btn.parentNode.parentNode;
        btn.addEventListener("click", function () {
            emModal.setAttribute("data-action", "add-lang");
            emModal.setAttribute(
                "employee-id",
                superParent.getAttribute("employee-id")
            );
            emSelect.disabled = false;
            emName.value = "";
            emPosition.value = "";
            emImage.value = "";
            emImage.disabled = true;
            emModalHeader.textContent = "เพิ่มภาษา";

            const dataFetch = superParent.querySelector(".d-none");
            const availableLang = new Set();
            dataFetch.querySelectorAll(".lang-item").forEach((lang) => {
                availableLang.add(lang.getAttribute("data-lang"));
            });
            console.log("Available Languages:", availableLang);

            // Disable options in the select element based on available languages
            let flag = false;
            emSelect.querySelectorAll("option").forEach((option) => {
                if (availableLang.has(option.value)) {
                    option.disabled = true; // Disable already used languages
                } else {
                    option.disabled = false; // Enable available languages
                    emSelect.value = option.value;
                    flag = true; // Set flag to true if at least one option is available
                }
            });

            if (!flag) {
                window.showToast(
                    "ไม่สามารถเพิ่มภาษาได้ เนื่องจากพนักงานนี้มีทุกภาษาแล้ว",
                    "error"
                );
                emModalSubmit.disabled = true;
            }
        });
    });

    emEdit.forEach((btn) => {
        const superParent = btn.parentNode.parentNode;
        console.log("Edit Button Parent:", superParent);
        btn.addEventListener("click", function () {
            emModal.setAttribute("data-action", "edit");
            emModal.setAttribute(
                "employee-id",
                superParent.getAttribute("employee-id")
            );
            emSelect.disabled = false;
            emModalHeader.textContent = "แก้ไขข้อมูลพนักงาน";
            emImage.disabled = false;

            // load image
            fetch(superParent.querySelector(".card-img-top").src)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.blob();
                })
                .then((blob) => {
                    const url = URL.createObjectURL(blob);
                    const file = new File([blob], "cover.jpg", {
                        type: blob.type,
                    });

                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    emImage.files = dataTransfer.files;
                });

            // load name and position
            const dataFetch = superParent.querySelector(".d-none");
            const availableLang = new Set();
            const availableLangObj = {};
            dataFetch.querySelectorAll(".lang-item").forEach((lang) => {
                availableLang.add(lang.getAttribute("data-lang"));
                availableLangObj[lang.getAttribute("data-lang")] = {
                    name: lang.textContent.trim(),
                    position: lang.getAttribute("data-position") || "",
                };
            });
            console.log("Available Languages:", availableLang);

            // Disable options in the select element based on available languages
            let flag = false;
            emSelect.querySelectorAll("option").forEach((option) => {
                if (availableLang.has(option.value)) {
                    option.disabled = false; // Disable already used languages
                    emSelect.value = option.value;
                    flag = true;
                    emName.value = availableLangObj[option.value].name;
                    emPosition.value =
                        availableLangObj[option.value].position || "";
                } else {
                    option.disabled = true; // Enable available languages
                    // option.replaceWith(option.cloneNode(true));
                }
            });

            emSelect.addEventListener("change", function () {
                console.log(
                    "Selected language:",
                    availableLangObj[emSelect.value]
                );
                emName.value = availableLangObj[emSelect.value].name || "";
                emPosition.value =
                    availableLangObj[emSelect.value].position || "";
            });

            if (!flag) {
                window.showToast(
                    "ไม่สามารถเพิ่มภาษาได้ เนื่องจากพนักงานนี้ไม่มีทุกภาษา",
                    "error"
                );
                deModalSubmit.disabled = true;
            }
        });
    });

    emDelete.forEach((btn) => {
        btn.addEventListener("click", function () {
            const employeeId =
                btn.parentNode.parentNode.getAttribute("employee-id");
            confirmDialog.confirmAction(
                "ลบพนักงาน",
                "ข้อมูลพนักงานจะหายไป",
                "ไม่",
                "ลบ",
                '<button class="confirm-btn active confirm-yes" id="confirmYes"> Yes </button>',
                async () => {
                    window.showLoading();
                    await fetch(`/admin/employee/${employeeId}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content,
                        },
                    }).then(async (res) => {
                        if (res.ok) {
                            window.hideLoading();
                            window.showToast(
                                "ลบพนักงานเรียบร้อยแล้ว",
                                "success"
                            );

                            btn.parentElement.parentElement.remove();

                        } else {
                            window.hideLoading();
                            window.showToast(
                                "เกิดข้อผิดพลาดในการลบพนักงาน",
                                "error"
                            );
                            const text = await res.text();
                            console.error("Error response:", text);
                        }
                    });
                }
            );
        });
    });

    emModalSubmit.addEventListener("click", async function () {
        const departmentId = emModal.getAttribute("department-id");

        async function uploadImg() {
            const coverFile = emImage.files[0];
            const formData = new FormData();
            formData.append("image", coverFile);
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
            return path;
        }

        if (emModal.getAttribute("data-action") === "create") {
            window.showLoading();
            const imgPath = await uploadImg();

            await fetch(`/admin/employee`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({
                    department_id: departmentId,
                    locale: "th",
                    name: emName.value.trim(),
                    position: emPosition.value.trim(),
                    cover_image: imgPath,
                }),
            }).then(async (res) => {
                if (res.ok) {
                    window.hideLoading();
                    window.showToast(
                        "เพิ่มพนักงานใหม่เรียบร้อยแล้ว",
                        "success"
                    );
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                } else {
                    window.hideLoading();
                    window.showToast(
                        "เกิดข้อผิดพลาดในการเพิ่มพนักงาน",
                        "error"
                    );
                    const text = await res.text();
                    console.error("Error response:", text);
                }
            });
        } else {
            window.showLoading();
            let cover_image = null;
            if (
                emModal.getAttribute("data-action") === "edit" &&
                emImage.files.length > 0
            ) {
                cover_image = await uploadImg();
            }
            await fetch(
                `/admin/employee/${emModal.getAttribute("employee-id")}`,
                {
                    method: "PUT",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                    },
                    body: JSON.stringify({
                        locale: emSelect.value,
                        name: emName.value.trim(),
                        position: emPosition.value.trim(),
                        cover_image: cover_image,
                    }),
                }
            ).then(async (res) => {
                if (res.ok) {
                    window.hideLoading();
                    window.showToast(
                        "แก้ไขข้อมูลพนักงานเรียบร้อยแล้ว",
                        "success"
                    );
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                } else {
                    window.hideLoading();
                    window.showToast(
                        "เกิดข้อผิดพลาดในการแก้ไขข้อมูลพนักงาน",
                        "error"
                    );
                    const text = await res.text();
                    console.error("Error response:", text);
                }
            });
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    initOverlay();
    initCarousel();
    initDepartmentActions();
    initEmployeeActions();
});
