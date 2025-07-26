import ConfirmDialog from "/JS/component/confirm_dialog.js";

const artList = document.getElementById("articles-list");
// ข้อมูลตัวอย่าง
const confirmDialog = new ConfirmDialog();
// เลือก DOM elements
const searchInput = document.getElementById("search");
const filterSelect = document.getElementById("articles-filter");

// ค้นหาและกรองสิทธิพิเศษ
async function searchAndFilterArticles() {
    const searchTerm = searchInput.value.toLowerCase();

    location.href = `/admin/privilege?search=${searchTerm}`;
}

// ลบสิทธิพิเศษ
function deleteArticle() {
    document
        .querySelectorAll(".actions-buttons .delete-article")
        .forEach((btn) => {
            btn.addEventListener("click", (e) => {
                const id = e.target.getAttribute("data-id");
                const confirmDialog = new ConfirmDialog();
                confirmDialog.confirmAction(
                    "คุณแน่ใจหรือไม่ที่จะลบสิทธิพิเศษนี้?",
                    "สิทธิพิเศษนี้จะถูกลบอย่างถาวร",
                    "ไม่",
                    "ลบ",
                    '<button class="confirm-btn active confirm-yes" id="confirmYes"> ลบ </button>',
                    async () => {
                        window.showLoading();
                        await fetch(`/admin/privilege/${id}`, {
                            method: "DELETE",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector(
                                    'meta[name="csrf-token"]'
                                ).content,
                            },
                        }).then((res) => {
                            if (!res.ok) {
                                window.showToast(
                                    "ไม่สามารถลบสิทธิพิเศษได้",
                                    "error"
                                );
                            } else {
                                window.showToast(
                                    "ลบสิทธิพิเศษเรียบร้อยแล้ว",
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
                // /admin/privilege/add_lang/{{ $article['id'] }}/admin/privilege/add_lang/{{ $article['id'] }}
                // /admin/privilege/edit/{{ $article['id'] }}
                row.querySelectorAll("td.d-none span").forEach((lang) => {
                    select += `<option value="${lang.textContent.trim()}">${
                        langMap[lang.textContent.trim()]
                    }</option>`;
                });
                select += `</select>`;
                // <option value="th">ไทย</option>
                confirmDialog.confirmAction(
                    "แก้ไขสิทธิพิเศษ",
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
                        location.href = `/admin/privilege/${articleId}/edit?lang=${select.value}`;
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
                        location.href = `/admin/privilege/${articleId}/add_lang?lang=${select.value}`;
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
                            <input type="number" id="change-id" class="form-control" placeholder="ป้อน ID ของสิทธิพิเศษ">
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
                            `/admin/privilege/${articleId}/edit_id`,
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
                            await res.text().then((data) => {
                                console.log(data);
                            });
                            // await res.json().then((data) => {
                            //     let message = "ไม่สามารถแก้ไข ID ได้";
                            //     if (
                            //         data.message &&
                            //         data.message == "id already used"
                            //     ) {
                            //         message = "ID นี้ถูกใช้แล้ว";
                            //         idInputError.innerText =
                            //             "*ID นี้ถูกใช้แล้ว";
                            //         idInput.focus();
                            //     }
                            //     window.showToast(message, "error");
                            // });
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
                            ).href = `/review/detail?news_id=${idInput.value.trim()}`;
                            row.setAttribute("data-id", idInput.value.trim());
                            return true;
                        }
                    }
                );
            }
        );
    });
}

function initTagManage() {
    async function confirmEdit(superParent, parentDiv, dataLocale, tagId) {
        confirmDialog.confirmAction(
            `แก้ไขproject ${dataLocale}`,
            `<div class="mt-3">
                <div class="form-group mb-3">
                    <label for="tag-name">ชื่อproject:</label>
                    <input type="text" value="${parentDiv.innerText.trim()}" id="add-tag-name" class="form-control" placeholder="ป้อนชื่อproject">
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

                await fetch(`/admin/privilege/edit_project/${tagId}`, {
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
                    window.showToast("แก้ไขprojectเรียบร้อยแล้ว", "success");
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
                    <label for="tag-name">ชื่อproject:</label>
                    <input type="text" id="add-tag-name" class="form-control" placeholder="ป้อนชื่อproject">
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

                await fetch(`/admin/privilege/edit_project/${tagId}`, {
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
                        window.showToast("ไม่สามารถเพิ่มprojectได้", "error");
                        await res.text().then((data) => {
                            console.log(data);
                        });
                        return
                    } else {
                        window.showToast(
                            "เพิ่มprojectเรียบร้อยแล้ว",
                            "success"
                        );
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
}

// Event Listeners
document.addEventListener("DOMContentLoaded", () => {
    searchListener();

    deleteArticle();

    editArticle();

    initTagManage();
});
