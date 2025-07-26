import ConfirmDialog from "/js/component/confirm_dialog.js";
import { createTagSelector } from "/js/component/tag_selector.js";

// เลือก DOM elements
const searchInput = document.getElementById("search");
const filterSelect = document.getElementById("articles-filter");

const modalContent = document.querySelector(".modal-content");
const modalContainer = document.querySelector("#staticBackdrop");
const editBtns = document.querySelectorAll(".btn-edit");
const addLangBtn = document.querySelectorAll(".add-lang-btn");
const addFaqBtn = document.getElementById("add-article");

const tagSelectorContainer = document.getElementById("tag-selector-container");

let tagSelector;
const confirmDialog = new ConfirmDialog();

// ค้นหาและกรองบทความ
async function searchAndFilterArticles() {
    const searchTerm = searchInput.value.toLowerCase();
    const filterTag = filterSelect.value == "all" ? "" : filterSelect.value;

    location.href = `/admin/manage_faq?search=${searchTerm}&tag=${filterTag}`;
}

// ลบบทความ
function deleteArticle() {
    document
        .querySelectorAll(".actions-buttons .delete-article")
        .forEach((btn) => {
            btn.addEventListener("click", (e) => {
                const id = e.target.getAttribute("data-id");

                confirmDialog.confirmAction(
                    "ลบคำถามนี้?",
                    "คำถามนี้จะถูกลบอย่างถาวร",
                    "ไม่",
                    "ลบ",
                    '<button class="confirm-btn active confirm-yes" id="confirmYes"> ลบ </button>',
                    async () => {
                        window.showLoading();
                        await fetch(`/admin/manage_faq/${id}`, {
                            method: "DELETE",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector(
                                    'meta[name="csrf-token"]'
                                ).content,
                            },
                        }).then((res) => {
                            if (!res.ok) {
                                window.showToast(
                                    "ไม่สามารถลบบทความได้",
                                    "error"
                                );
                            } else {
                                window.showToast(
                                    "ลบบทความเรียบร้อยแล้ว",
                                    "success"
                                );
                                // articles = articles.filter((article) => article.id != id);
                                // maxPage = Math.ceil(articles.length / 10);
                                const row = document.querySelector(
                                    `#articles-list tr[data-id="${id}"]`
                                );
                                row.remove();
                            }
                        });

                        window.hideLoading();
                    }
                );
            });
        });
}

function addTag() {
    const btn = document.getElementById("add-tag");
    btn.addEventListener("click", () => {
        confirmDialog.confirmAction(
            "เพิ่มแท็ก",
            `<div class="mt-3">
                <div class="form-group mb-3">
                    <label for="tag-name">ชื่อแท็ก:</label>
                    <input type="text" id="add-tag-name" class="form-control" placeholder="ป้อนชื่อแท็ก">
                </div>
            </div>`,
            "ไม่",
            "ใช่",
            '<button class="confirm-btn active confirm-yes" id="confirmYes"> Yes </button>',
            async () => {
                const tagName = document
                    .getElementById("add-tag-name")
                    .value.trim();

                window.showLoading();

                await fetch("/admin/manage_faq/add_tag", {
                    method: "POST",
                    headers: {
                        "content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                    },
                    body: JSON.stringify({
                        locale: "th",
                        name: tagName,
                    }),
                }).then(async (res) => {
                    window.hideLoading();
                    if (!res.ok) {
                        window.showToast("ไม่สามารถเพิ่มแท็กได้", "error");
                    } else {
                        window.showToast("เพิ่มแท็กเรียบร้อยแล้ว", "success");
                    }
                    await res.text().then((data) => {
                        console.log(data);
                    });
                });
            }
        );
    });
}

function searchListener() {
    searchInput.value = new URLSearchParams(window.location.search).get(
        "search"
    );
    filterSelect.value =
        new URLSearchParams(window.location.search).get("tag") || "all";

    searchInput.addEventListener("keydown", (event) => {
        if (event.key && event.key !== "Enter") return;
        searchAndFilterArticles();
    });
    document.querySelector(".search-icon").addEventListener("click", () => {
        searchAndFilterArticles();
    });
    filterSelect.addEventListener("change", searchAndFilterArticles);
}

function modalListener() {
    const question = modalContent.querySelector("#question");
    // const questionEn = modalContent.querySelector("#question-eng");
    const ans = modalContent.querySelector("#ans");
    // const ansEn = modalContent.querySelector("#ans-eng");
    const langSelect = modalContent.querySelector("#lang-select");
    document.querySelectorAll("textarea").forEach((textarea) => {
        textarea.addEventListener("input", () => {
            textarea.style.height = "5px";
            textarea.style.height = textarea.scrollHeight + "px";
        });
    });

    // เพิ่มบทความ
    addFaqBtn.addEventListener("click", () => {
        modalContent.querySelector(".modal-header h1").innerText =
            "สร้างคำถามใหม่";
        modalContent.setAttribute("action-type", "create");

        langSelect.value = "th";
        langSelect.disabled = true;

        tagSelectorContainer.style.display = "block";
    });

    addLangBtn.forEach((btn) => {
        btn.addEventListener("click", async () => {
            console.log("add lang btn clicked");
            modalContent.querySelector(".modal-header h1").innerText =
                "เพิ่มภาษาใหม่";
            modalContent.setAttribute("action-type", "add-lang");
            modalContent.setAttribute("data-id", btn.getAttribute("data-id"));

            langSelect.disabled = false;
            tagSelectorContainer.style.display = "none";

            const faq = btn.parentNode.parentNode;
            const faqId = faq.getAttribute("data-id");
            let res = await fetch(`/api/faq/faq_and_available_lang/${faqId}`, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            });

            if (!res.ok) {
                window.showToast("ไม่สามารถดึงข้อมูลคำถามได้", "error");
                return;
            }
            res = await res.json();
            console.log("res", res.tags);

            const availableLang = new Set();

            res.translations.forEach((lang) => {
                availableLang.add(lang.locale);
            });

            let flag = false;
            langSelect.querySelectorAll("option").forEach((option) => {
                if (availableLang.has(option.value)) {
                    option.disabled = true; // Disable already used languages
                } else {
                    option.disabled = false; // Enable available languages
                    langSelect.value = option.value;
                    flag = true;
                    // option.replaceWith(option.cloneNode(true));
                }
            });

            if (!flag) {
                window.showToast("ไม่สามารถเพิ่มภาษาได้", "error");
                return;
            }
        });
    });

    editBtns.forEach((btn) => {
        btn.addEventListener("click", async () => {
            modalContent.querySelector(".modal-header h1").innerText =
                "แก้ไขคำถาม";
            modalContent.setAttribute("action-type", "edit");
            modalContent.setAttribute("data-id", btn.getAttribute("data-id"));

            langSelect.disabled = false;
            tagSelectorContainer.style.display = "block";

            const faq = btn.parentNode.parentNode;
            const faqId = faq.getAttribute("data-id");
            let res = await fetch(`/api/faq/faq_and_available_lang/${faqId}`, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            });

            if (!res.ok) {
                window.showToast("ไม่สามารถดึงข้อมูลคำถามได้", "error");
                return;
            }
            res = await res.json();
            console.log("res", res.tags);

            const availableLang = new Set();
            const availableLangObj = {};

            res.translations.forEach((lang) => {
                availableLang.add(lang.locale);
                availableLangObj[lang.locale] = lang;
            });

            langSelect.querySelectorAll("option").forEach((option) => {
                if (availableLang.has(option.value)) {
                    option.disabled = false; // Disable already used languages
                    langSelect.value = option.value;
                    question.value = availableLangObj[option.value].question;
                    ans.value = availableLangObj[option.value].answer;
                } else {
                    option.disabled = true; // Enable available languages
                    // option.replaceWith(option.cloneNode(true));
                }
            });

            langSelect.addEventListener("change", () => {
                const selectedLang = langSelect.value;
                if (availableLang.has(selectedLang)) {
                    question.value = availableLangObj[selectedLang].question;
                    ans.value = availableLangObj[selectedLang].answer;
                }
            });

            res.tags.forEach((tag) => {
                tagSelector.selectOptionById(tag.faq_tag_id);
            });
        });
    });

    document.querySelector(".submit").addEventListener("click", async () => {
        window.showLoading();

        if (modalContent.getAttribute("action-type") == "create") {
            const req = {
                locale: "th",
                question: question.value.trim(),
                answer: ans.value.trim(),
                tags: tagSelector.getSelectedTags(),
            };
            console.log(req);
            await fetch("/admin/manage_faq", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify(req),
            }).then(async (res) => {
                window.hideLoading();
                modalContainer.classList.remove("show");

                if (!res.ok) {
                    window.showToast("ไม่สามารถบันทึกคำถามได้", "error");
                    await res.text().then((data) => {
                        console.log("error :", data);
                    });
                } else {
                    window.showToast("บันทึกคำถามเรียบร้อยแล้ว", "success");
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
            });
        } else {
            const req = {
                locale: langSelect.value,
                question: question.value.trim(),
                answer: ans.value.trim(),
            };
            if (modalContent.getAttribute("action-type") == "edit") {
                req.tags = tagSelector.getSelectedTags();
            } else {
                req.tags = null;
            }
            console.log("req :", req);
            await fetch(
                `/admin/manage_faq/${modalContent.getAttribute("data-id")}`,
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
            ).then(async (res) => {
                window.hideLoading();
                modalContainer.classList.remove("show");

                if (!res.ok) {
                    window.showToast("ไม่สามารถแก้ไขคำถามได้", "error");
                    await res.text().then((data) => {
                        console.log("error :", data);
                    });
                } else {
                    window.showToast("บันทึกเรียบร้อย", "success");
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
            });
        }
    });
}

function tag_selector() {
    const tagss = [];
    const tagFetch = document.querySelectorAll(".filter-box option");

    for (let i = 1; i < tagFetch.length; i++) {
        tagss.push({
            id: tagFetch[i].value,
            name: tagFetch[i].innerText,
        });
    }

    tagSelector = createTagSelector("tag-selector-container", tagss);
}

function initCarusel() {
    const tableHeader = document.querySelector(".table-header");
    const addTagBtn = document.querySelector("#add-tag");
    const addArticleBtn = document.querySelector("#add-article");
    const navigation = document.querySelector(
        "button[data-bs-target='#carouselExample']"
    );

    navigation.addEventListener("click", () => {
        if (
            document
                .querySelector(".carousel-item.item-1")
                .classList.contains("active")
        ) {
            addTagBtn.style.display = "inline-block";
            addArticleBtn.style.display = "none";
            navigation.textContent = "← จัดการ Faq";
            navigation.setAttribute("data-bs-slide", "prev");
        } else {
            addTagBtn.style.display = "none";
            addArticleBtn.style.display = "inline-block";
            navigation.textContent = "จัดการ Tag →";
            navigation.setAttribute("data-bs-slide", "next");
        }
    });
}

function initTagManage() {
    const tagListContainer = document.getElementById("tags-list");
    const tagList = tagListContainer.querySelectorAll("tr");

    async function confirmEdit(superParent, parentDiv, dataLocale, tagId) {
        confirmDialog.confirmAction(
            `แก้ไขแท็ก ${dataLocale}`,
            `<div class="mt-3">
                <div class="form-group mb-3">
                    <label for="tag-name">ชื่อแท็ก:</label>
                    <input type="text" value="${parentDiv.innerText.trim()}" id="add-tag-name" class="form-control" placeholder="ป้อนชื่อแท็ก">
                </div>
            </div>`,
            "ไม่",
            "ใช่",
            '<button class="confirm-btn active confirm-yes" id="confirmYes"> Yes </button>',
            async () => {
                const tagName = document
                    .getElementById("add-tag-name")
                    .value.trim();

                window.showLoading();

                await fetch(`/admin/manage_faq/edit_tag/${tagId}`, {
                    method: "PUT",
                    headers: {
                        "content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                    },
                    body: JSON.stringify({
                        locale: dataLocale,
                        name: tagName,
                    }),
                }).then(async (res) => {
                    window.hideLoading();
                    if (!res.ok) {
                        window.showToast("ไม่สามารแก้ไขได้", "error");
                        await res.text().then((data) => {
                            console.log(data);
                        });
                        return;
                    }
                    window.showToast("แก้ไขแท็กเรียบร้อยแล้ว", "success");
                    parentDiv.innerText = tagName;
                });
            }
        );
    }

    async function confirmAddLang(superParent, parentDiv, dataLocale, tagId, btn) {
        confirmDialog.confirmAction(
            `เพิ่มภาษา ${dataLocale}`,
            `<div class="mt-3">
                <div class="form-group mb-3">
                    <label for="tag-name">ชื่อแท็ก:</label>
                    <input type="text" id="add-tag-name" class="form-control" placeholder="ป้อนชื่อแท็ก">
                </div>
            </div>`,
            "ไม่",
            "ใช่",
            '<button class="confirm-btn active confirm-yes" id="confirmYes"> Yes </button>',
            async () => {
                const tagName = document
                    .getElementById("add-tag-name")
                    .value.trim();

                window.showLoading();

                await fetch(`/admin/manage_faq/edit_tag/${tagId}`, {
                    method: "PUT",
                    headers: {
                        "content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                    },
                    body: JSON.stringify({
                        locale: dataLocale,
                        name: tagName,
                    }),
                }).then(async (res) => {
                    window.hideLoading();
                    if (!res.ok) {
                        window.showToast("ไม่สามารถเพิ่มแท็กได้", "error");
                    } else {
                        window.showToast("เพิ่มแท็กเรียบร้อยแล้ว", "success");
                    }
                    btn.remove();
                    const parent = parentDiv.parentNode;
                    const newBtn = document.createElement("button");
                    newBtn.setAttribute("btn-type", "tag-edit");
                    newBtn.addEventListener("click", async () => {
                        await confirmEdit(superParent, parentDiv, dataLocale, tagId);
                    });
                    newBtn.className = "btn btn-warning";
                    newBtn.innerText = "แก้ไข";
                    parent.appendChild(newBtn);
                    parentDiv.innerText = tagName;
                });
            }
        );
    }

    tagList.forEach((tag) => {
        const tagId = tag.getAttribute("tag-id");
        // tag edit button
        tag.querySelectorAll("button[btn-type='tag-edit']").forEach((btn) => {
            const superParent = btn.parentNode.parentNode;
            const parentDiv = btn.parentNode.querySelector("div");
            const dataLocale = superParent.getAttribute("data-locale");
            btn.addEventListener("click", async () => {
                await confirmEdit(superParent, parentDiv, dataLocale, tagId);
            });
        });

        // tag add-lang button
        tag.querySelectorAll("button[btn-type='tag-addlang']").forEach(
            (btn) => {
                const superParent = btn.parentNode.parentNode;
                const parentDiv = btn.parentNode.querySelector("div");
                const dataLocale = superParent.getAttribute("data-locale");
                btn.addEventListener("click", async () => {
                    await confirmAddLang(superParent, parentDiv, dataLocale, tagId, btn);
                });
            }
        );
        // tag delete button
        tag.querySelectorAll("button[btn-type='tag-delete']").forEach((btn) => {
            btn.addEventListener("click", (e) => {
                const superParent = btn.parentNode.parentNode;

                confirmDialog.confirmAction(
                    `ลบแท็ก`,
                    `<div class="mt-3">
                        <p>คุณแน่ใจหรือไม่ว่าต้องการลบแท็กนี้?</p>
                    </div>`,
                    "ไม่",
                    "ใช่",
                    '<button class="confirm-btn active confirm-yes" id="confirmYes"> ลบ </button>',
                    async () => {
                        window.showLoading();
                        await fetch(`/admin/manage_faq/delete_tag/${tagId}`, {
                            method: "DELETE",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector(
                                    'meta[name="csrf-token"]'
                                ).content,
                            },
                        }).then(async (res) => {
                            window.hideLoading();
                            if (!res.ok) {
                                window.showToast("ไม่สามารถลบแท็กได้", "error");
                                await res.text().then((data) => {
                                    console.log(data);
                                });
                            } else {
                                window.showToast("ลบแท็กเรียบร้อยแล้ว", "success");
                                superParent.remove();
                            }
                        });
                    }
                );
            });
        });
    });
}

// Event Listeners
document.addEventListener("DOMContentLoaded", () => {
    searchListener();
    modalListener();
    tag_selector();

    addTag();
    deleteArticle();

    initCarusel();
    initTagManage();
});
