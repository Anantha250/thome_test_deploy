import ConfirmDialog from "/JS/component/confirm_dialog.js";

const artList = document.getElementById("articles-list");
// ข้อมูลตัวอย่าง
const confirmDialog = new ConfirmDialog();
// เลือก DOM elements
const searchInput = document.getElementById("search");
const filterSelect = document.getElementById("articles-filter");

// ค้นหาและกรองบทความ
async function searchAndFilterArticles() {
    const searchTerm = searchInput.value.toLowerCase();
    const filterTag = filterSelect.value == "all" ? "" : filterSelect.value;

    location.href = `/admin/article?search=${searchTerm}&tag=${filterTag}`;
}

// ลบบทความ
function deleteArticle() {
    document
        .querySelectorAll(".actions-buttons .delete-article")
        .forEach((btn) => {
            btn.addEventListener("click", (e) => {
                const id = e.target.getAttribute("data-id");
                const confirmDialog = new ConfirmDialog();
                confirmDialog.confirmAction(
                    "คุณแน่ใจหรือไม่ที่จะลบบทความนี้?",
                    "บทความนี้จะถูกลบอย่างถาวร",
                    "ไม่",
                    "ลบ",
                    '<button class="confirm-btn active confirm-yes" id="confirmYes"> ลบ </button>',
                    async () => {
                        window.showLoading();
                        await fetch(`/admin/article/${id}`, {
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
                <div class="form-group">
                    <label for="tag-name">ชื่อแท็ก(en):</label>
                    <input type="text" id="add-tag-name-en" class="form-control" placeholder="ป้อนชื่อแท็ก">
                </div>
            </div>`,
            "ไม่",
            "ใช่",
            '<button class="confirm-btn active confirm-yes" id="confirmYes"> Yes </button>',
            async () => {
                const tagName = document
                    .getElementById("add-tag-name")
                    .value.trim();
                const tagNameEn = document
                    .getElementById("add-tag-name-en")
                    .value.trim();

                window.showLoading();

                await fetch("/admin/article/add_tag", {
                    method: "POST",
                    headers: {
                        "content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                    },
                    body: JSON.stringify([
                        {
                            locale: "th",
                            name: tagName,
                        },
                        {
                            locale: "en",
                            name: tagNameEn,
                        },
                    ]),
                }).then(async (res) => {
                    window.hideLoading();
                    if (!res.ok) {
                        window.showToast("ไม่สามารถเพิ่มแท็กได้", "error");
                        await res.text().then((data) => {
                            console.log(data);
                        });
                    } else {
                        window.showToast("เพิ่มแท็กเรียบร้อยแล้ว", "success");
                        setTimeout(() => {
                            window.location.reload();
                        }, 2500);
                    }
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

function editArticle() {
    const langMap = {
        th: "ไทย",
        en: "อังกฤษ",
        cn: "จีน",
    };
    artList.querySelectorAll("tr").forEach((row) => {
        const articleId = row.getAttribute("data-id");
        row.querySelector("button[btn-type='edit']").addEventListener(
            "click",
            () => {
                let select = `<select class="form-select" id="select-lang">`;
                // /admin/article/add_lang/{{ $article['id'] }}/admin/article/add_lang/{{ $article['id'] }}
                // /admin/article/edit/{{ $article['id'] }}
                row.querySelectorAll("td.d-none span").forEach((lang) => {
                    select += `<option value="${lang.textContent.trim()}">${
                        langMap[lang.textContent.trim()]
                    }</option>`;
                });
                select += `</select>`;
                // <option value="th">ไทย</option>
                confirmDialog.confirmAction(
                    "แก้ไขบทความ",
                    `<div class="mt-3">
                        <div class="form-group mb-3">
                            <label for="tag-name">เลือกภาษา</label>
                            ${select}
                        </div>
                    </div>`,
                    "ไม่",
                    "ใช่",
                    '<button class="confirm-btn active confirm-yes" id="confirmYes"> Yes </button>',
                    async () => {
                        let select = document.getElementById("select-lang");
                        location.href = `/admin/article/${articleId}/edit?lang=${select.value}`;
                    }
                );
            }
        );

        row.querySelector("button[btn-type='add-lang']").addEventListener(
            "click",
            () => {
                let select = `<select class="form-select" id="select-lang">`;
                let availableLang = [];
                row.querySelectorAll("td.d-none span").forEach((lang) => {
                    availableLang.push(lang.textContent.trim());
                });
                Object.entries(langMap).forEach(([key, val]) => {
                    if (!availableLang.includes(key))
                        select += `<option value="${key}">${val}</option>`;
                });

                select += `</select>`;
                confirmDialog.confirmAction(
                    "เพิ่มภาษา",
                    `<div class="mt-3">
                        <div class="form-group mb-3">
                            <label for="tag-name">เลือกภาษา</label>
                            ${select}
                        </div>
                    </div>`,
                    "ไม่",
                    "ใช่",
                    '<button class="confirm-btn active confirm-yes" id="confirmYes"> Yes </button>',
                    async () => {
                        let select = document.getElementById("select-lang");
                        location.href = `/admin/article/${articleId}/add_lang?lang=${select.value}`;
                    }
                );
            }
        );

        row.querySelector("button[btn-type='edit-id']").addEventListener(
            "click",
            () => {
                confirmDialog.confirmWithVerify(
                    "เปลี่ยนเลข ID",
                    `<div class="mt-3">
                        <div class="form-group mb-3">
                            <label for="tag-name">ใส่เลข ID</label>
                            <input type="number" id="change-id" class="form-control" placeholder="ป้อน ID ของบทความ">
                            <p class="text-danger mt-1" id="change-id-error" style="font-size: 1rem;"></p>
                        </div>
                    </div>`,
                    "ไม่",
                    "ใช่",
                    '<button class="confirm-btn active confirm-yes" id="confirmYes"> Yes </button>',
                    async () => {
                        const idInput = document.getElementById("change-id");
                        const idInputError =
                            document.getElementById("change-id-error");
                        if (!idInput.value || idInput.value.trim() == "") {
                            idInputError.innerText = "*กรุณากรอก ID";
                            idInput.focus();
                            return false;
                        }
                        window.showLoading();
                        let res = await fetch(
                            `/admin/article/${articleId}/edit_id`,
                            {
                                method: "PUT",
                                headers: {
                                    "content-Type": "application/json",
                                    "X-CSRF-TOKEN": document.querySelector(
                                        'meta[name="csrf-token"]'
                                    ).content,
                                },
                                body: JSON.stringify({
                                    change_id: idInput.value.trim(),
                                }),
                            }
                        );
                        window.hideLoading();
                        if (!res.ok) {
                            await res.json().then((data) => {
                                let message = "ไม่สามารถแก้ไข ID ได้";
                                if (
                                    data.message &&
                                    data.message == "id already used"
                                ) {
                                    message = "ID นี้ถูกใช้แล้ว";
                                    idInputError.innerText =
                                        "*ID นี้ถูกใช้แล้ว";
                                    idInput.focus();
                                }
                                window.showToast(message, "error");
                            });
                            console.log("false");
                            return false;
                        } else {
                            window.showToast(
                                "แก้ไข ID เรียบร้อยแล้ว",
                                "success"
                            );
                            row.querySelector(".article-id").innerText =
                                idInput.value.trim();
                            row.querySelector(
                                ".article-link"
                            ).href = `/article/detail?news_id=${idInput.value.trim()}`;
                            row.setAttribute("data-id", idInput.value.trim());
                            return true;
                        }
                    }
                );
            }
        );
    });
}

function initCarusel() {
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
            navigation.textContent = "← จัดการ Article";
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

                await fetch(`/admin/article/edit_tag/${tagId}`, {
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

    async function confirmAddLang(
        superParent,
        parentDiv,
        dataLocale,
        tagId,
        btn
    ) {
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

                await fetch(`/admin/article/edit_tag/${tagId}`, {
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
                        await confirmEdit(
                            superParent,
                            parentDiv,
                            dataLocale,
                            tagId
                        );
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
                    await confirmAddLang(
                        superParent,
                        parentDiv,
                        dataLocale,
                        tagId,
                        btn
                    );
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
                        await fetch(`/admin/article/delete_tag/${tagId}`, {
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
                                window.showToast(
                                    "ลบแท็กเรียบร้อยแล้ว",
                                    "success"
                                );
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

    addTag();
    deleteArticle();

    editArticle();

    initCarusel();
    initTagManage();
});
