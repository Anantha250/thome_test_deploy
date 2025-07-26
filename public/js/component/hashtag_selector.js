export default class BilingualTagSelector {
    constructor(containerId, options = []) {
        this.tagContainer = document.getElementById(containerId);
        this.tagInput = this.tagContainer.querySelector(".tag-input");
        this.optionsContainer =
            this.tagContainer.querySelector(".options-container");

        this.bilingualmodal_hashtag = document.getElementById(
            "bilingualmodal_hashtag"
        );
        this.modal_hashtagClose = document.getElementById("modal_hashtagClose");
        this.cancelBtn = document.getElementById("cancelBtn");
        this.createTagBtn = document.getElementById("createTagBtn");
        this.thaiTagInput = document.getElementById("thaiTagInput");
        this.englishTagInput = document.getElementById("englishTagInput");
        this.thaiTagError = document.getElementById("thaiTagError");
        this.englishTagError = document.getElementById("englishTagError");

        this.options = [];
        this.selectedTags = [];
        this.bilingualTags = new Map(); // Map to store Thai/English pairs

        if (options != []) {
            options.forEach((option) => {
                this.options.push(option.en);
                this.bilingualTags.set(option.en, {
                    thai: option.th,
                    english: option.en,
                });
                this.selectOption(option.en);
            });
        }

        this.init();
    }

    init() {
        this.addEventListeners();
        this.initOptions();
    }

    addEventListeners() {
        this.tagInput.addEventListener(
            "focus",
            this.handleTagInputFocus.bind(this)
        );
        this.tagInput.addEventListener(
            "input",
            this.handleTagInputInput.bind(this)
        );
        this.tagInput.addEventListener(
            "keydown",
            this.handleTagInputKeyDown.bind(this)
        );

        this.modal_hashtagClose.addEventListener(
            "click",
            this.closeBilingualmodal_hashtag.bind(this)
        );
        this.cancelBtn.addEventListener(
            "click",
            this.closeBilingualmodal_hashtag.bind(this)
        );
        this.createTagBtn.addEventListener(
            "click",
            this.createBilingualTag.bind(this)
        );

        this.bilingualmodal_hashtag.addEventListener(
            "click",
            this.handlemodal_hashtagOverlayClick.bind(this)
        );

        this.thaiTagInput.addEventListener(
            "keydown",
            this.handleThaiTagInputKeyDown.bind(this)
        );
        this.englishTagInput.addEventListener(
            "keydown",
            this.handleEnglishTagInputKeyDown.bind(this)
        );

        document.addEventListener("click", this.handleDocumentClick.bind(this));
    }

    initOptions() {
        this.optionsContainer.innerHTML = "";
        this.options.forEach((option) => {
            this.createOptionElement(option);
        });
    }

    createOptionElement(option) {
        const optionElement = document.createElement("div");
        optionElement.className = "option";
        if (this.selectedTags.includes(option)) {
            optionElement.classList.add("selected");
        }

        if (this.bilingualTags.has(option)) {
            const { thai, english } = this.bilingualTags.get(option);
            optionElement.textContent = `${english} (${thai})`;
        } else {
            optionElement.textContent = option;
        }

        optionElement.addEventListener("click", () =>
            this.selectOption(option)
        );
        this.optionsContainer.appendChild(optionElement);
    }

    filterOptions(query) {
        this.optionsContainer.innerHTML = "";

        if (query && query.trim() !== "") {
            const exactMatch = this.options.find(
                (option) => option.toLowerCase() === query.toLowerCase()
            );

            if (!exactMatch) {
                const createOption = document.createElement("div");
                createOption.className = "create-new-option";
                createOption.innerHTML = `<span class="plus-icon">+</span> Create bilingual tag for "${query}"`;
                createOption.addEventListener("click", () =>
                    this.openBilingualmodal_hashtag(query)
                );
                this.optionsContainer.appendChild(createOption);
            }
        }

        const filteredOptions = this.options.filter((option) => {
            if (option.toLowerCase().includes(query.toLowerCase())) {
                return true;
            }

            if (this.bilingualTags.has(option)) {
                const thaiText = this.bilingualTags.get(option).thai;
                return thaiText.toLowerCase().includes(query.toLowerCase());
            }

            return false;
        });

        if (filteredOptions.length === 0 && !query) {
            const noResult = document.createElement("div");
            noResult.className = "option";
            noResult.textContent = "No matching tags found";
            noResult.style.fontStyle = "italic";
            noResult.style.color = "#9ca3af";
            this.optionsContainer.appendChild(noResult);
            return;
        }

        filteredOptions.forEach((option) => {
            const optionElement = document.createElement("div");
            optionElement.className = "option";
            if (this.selectedTags.includes(option)) {
                optionElement.classList.add("selected");
            }

            let displayText = option;
            if (this.bilingualTags.has(option)) {
                const { thai, english } = this.bilingualTags.get(option);
                displayText = `${english} (${thai})`;
            }

            if (query) {
                const index = displayText
                    .toLowerCase()
                    .indexOf(query.toLowerCase());
                if (index >= 0) {
                    const before = displayText.substring(0, index);
                    const match = displayText.substring(
                        index,
                        index + query.length
                    );
                    const after = displayText.substring(index + query.length);
                    optionElement.innerHTML = `${before}<strong style="color: var(--primary-color)">${match}</strong>${after}`;
                } else {
                    optionElement.textContent = displayText;
                }
            } else {
                optionElement.textContent = displayText;
            }

            optionElement.addEventListener("click", () =>
                this.selectOption(option)
            );
            this.optionsContainer.appendChild(optionElement);
        });
    }

    openBilingualmodal_hashtag(initialText) {
        this.thaiTagInput.value = "";
        this.englishTagInput.value = initialText || "";
        this.thaiTagError.classList.remove("show");
        this.englishTagError.classList.remove("show");

        this.bilingualmodal_hashtag.classList.add("active");

        if (initialText) {
            this.thaiTagInput.focus();
        } else {
            this.englishTagInput.focus();
        }
    }

    closeBilingualmodal_hashtag() {
        this.bilingualmodal_hashtag.classList.remove("active");
    }

    createBilingualTag() {
        const thaiText = this.thaiTagInput.value.trim();
        const englishText = this.englishTagInput.value.trim();
        let isValid = true;

        if (!thaiText) {
            this.thaiTagError.classList.add("show");
            isValid = false;
        } else {
            this.thaiTagError.classList.remove("show");
        }

        if (!englishText) {
            this.englishTagError.classList.add("show");
            isValid = false;
        } else {
            this.englishTagError.classList.remove("show");
        }

        if (!isValid) return;

        const tagExists = this.options.some(
            (option) => option.toLowerCase() === englishText.toLowerCase()
        );

        if (!tagExists) {
            this.options.push(englishText);
            this.bilingualTags.set(englishText, {
                thai: thaiText,
                english: englishText,
            });
        }

        this.closeBilingualmodal_hashtag();
        this.selectOption(englishText);
        // console.log("options :", this.options);
        // console.log("bilingualTags :", this.bilingualTags);
        // console.log("selectedTags :", this.selectedTags);
    }

    selectOption(option) {
        if (!this.selectedTags.includes(option)) {
            this.selectedTags.push(option);
            this.renderTags();
            this.tagInput.value = "";
            this.filterOptions("");
            this.tagInput.focus();
        }
    }

    removeTag(tag) {
        this.selectedTags = this.selectedTags.filter((t) => t !== tag);
        this.renderTags();
        this.filterOptions(this.tagInput.value); // Re-filter options to update selected state
    }

    toggleTagLanguage(tagElement, tagName) {
        if (!this.bilingualTags.has(tagName)) return;

        const { thai, english } = this.bilingualTags.get(tagName);
        const currentText = tagElement.childNodes[0].nodeValue.trim();
        const isShowingEnglish = currentText === english;

        tagElement.childNodes[0].nodeValue = isShowingEnglish ? thai : english;

        const tooltip = tagElement.querySelector(".bilingual-tag-tooltip");
        if (tooltip) {
            tooltip.textContent = isShowingEnglish
                ? `English: ${english}`
                : `Thai: ${thai}`;
        }
    }

    renderTags() {
        this.tagContainer
            .querySelectorAll(".tag")
            .forEach((tag) => tag.remove());

        this.selectedTags.forEach((tag) => {
            const tagElement = document.createElement("div");
            tagElement.className = "tag";

            if (this.bilingualTags.has(tag)) {
                tagElement.classList.add("bilingual-tag");
                const { english } = this.bilingualTags.get(tag);

                tagElement.textContent = english;

                const toggleBtn = document.createElement("span");
                toggleBtn.className = "tag-language-toggle";
                toggleBtn.textContent = "TH";
                toggleBtn.addEventListener("click", (e) => {
                    e.stopPropagation();
                    this.toggleTagLanguage(tagElement, tag);
                    toggleBtn.textContent =
                        toggleBtn.textContent === "TH" ? "EN" : "TH";
                });
                tagElement.appendChild(toggleBtn);

                const tooltip = document.createElement("span");
                tooltip.className = "bilingual-tag-tooltip";
                tooltip.textContent = `Thai: ${
                    this.bilingualTags.get(tag).thai
                }`;
                tagElement.appendChild(tooltip);

                tagElement.addEventListener("mouseenter", () => {
                    tooltip.style.opacity = "1";
                });
                tagElement.addEventListener("mouseleave", () => {
                    tooltip.style.opacity = "0";
                });
            } else {
                tagElement.textContent = tag;
            }

            const removeBtn = document.createElement("span");
            removeBtn.className = "tag-remove";
            removeBtn.textContent = "×";
            removeBtn.addEventListener("click", (e) => {
                e.stopPropagation();
                this.removeTag(tag);
            });
            tagElement.appendChild(removeBtn);

            this.tagContainer.insertBefore(tagElement, this.tagInput);
        });

        this.optionsContainer
            .querySelectorAll(".option")
            .forEach((optionEl) => {
                const optionText = optionEl.textContent || optionEl.innerText;
                const englishPart = optionText.split(" (")[0];

                if (this.selectedTags.includes(englishPart)) {
                    optionEl.classList.add("selected");
                } else {
                    optionEl.classList.remove("selected");
                }
            });
    }

    // Event Handlers
    handleTagInputFocus() {
        this.optionsContainer.classList.add("show");
        this.filterOptions(this.tagInput.value);
    }

    handleTagInputInput() {
        this.filterOptions(this.tagInput.value);
        this.optionsContainer.classList.add("show");
    }

    handleTagInputKeyDown(e) {
        if (e.key === "Enter") {
            e.preventDefault();

            const inputValue = this.tagInput.value.trim();
            if (inputValue === "") return;

            const exactMatch = this.options.find(
                (option) => option.toLowerCase() === inputValue.toLowerCase()
            );

            if (exactMatch) {
                this.selectOption(exactMatch);
            } else {
                this.openBilingualmodal_hashtag(inputValue);
            }
        } else if (
            e.key === "Backspace" &&
            this.tagInput.value === "" &&
            this.selectedTags.length > 0
        ) {
            this.removeTag(this.selectedTags[this.selectedTags.length - 1]);
        }
    }

    handlemodal_hashtagOverlayClick(e) {
        if (e.target === this.bilingualmodal_hashtag) {
            this.closeBilingualmodal_hashtag();
        }
    }

    handleThaiTagInputKeyDown(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            this.englishTagInput.focus();
        }
    }

    handleEnglishTagInputKeyDown(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            this.createBilingualTag();
        }
    }

    handleDocumentClick(e) {
        if (
            !this.tagContainer.contains(e.target) &&
            !this.bilingualmodal_hashtag.contains(e.target)
        ) {
            this.optionsContainer.classList.remove("show");
        }
    }

    getSelectedTags() {
        let result = [];
        this.selectedTags.forEach((tag) => {
            if (this.bilingualTags.has(tag)) {
                const { thai, english } = this.bilingualTags.get(tag);
                result.push({ en: english, th: thai });
            } else {
                result.push({ en: tag, th: "" });
            }
        });
        return result;
    }
}

// document.addEventListener("DOMContentLoaded", function () {
//     new BilingualTagSelector("tagContainer", initialOptions);
// });
