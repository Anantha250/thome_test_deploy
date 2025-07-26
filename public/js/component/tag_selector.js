// tagSelector.js

export function createTagSelector(containerId, artTags = [], tagInputName = 'หมวด') {
    const container = document.getElementById(containerId);
    if (!container) {
        console.error(`Container with ID '${containerId}' not found.`);
        return;
    }

    container.innerHTML = `
        <label for="tagInput">${tagInputName}</label>
        <div class="tag-input-container" id="${containerId}-tagContainer">
            <input type="text" class="tag-input" id="${containerId}-tagInput" placeholder="Search or select tags...">
            <div class="options-container" id="${containerId}-optionsContainer"></div>
        </div>
    `;

    // Available options
    let options = [...artTags];

    // DOM elements
    const tagContainer = document.getElementById(`${containerId}-tagContainer`);
    const tagInput = document.getElementById(`${containerId}-tagInput`);
    const optionsContainer = document.getElementById(`${containerId}-optionsContainer`);

    let selectedTags = [];
    let customTags = new Set();

    function initOptions() {
        optionsContainer.innerHTML = '';
        options.forEach(option => {
            const optionElement = document.createElement('div');
            optionElement.className = 'option';
            if (selectedTags.includes(option)) {
                optionElement.classList.add('selected');
            }
            optionElement.textContent = option.name;
            optionElement.setAttribute('data-value', option.name);
            optionElement.setAttribute('data-id', option.id);
            optionElement.addEventListener('click', () => selectOption(option));
            optionsContainer.appendChild(optionElement);
        });
    }

    function filterOptions(query) {
        optionsContainer.innerHTML = '';

        if (query?.trim() !== '') {
            const exactMatch = options.find(opt => opt.name.toLowerCase() === query.toLowerCase());
            // if (!exactMatch) {
            //     const createOption = document.createElement('div');
            //     createOption.className = 'create-new-option';
            //     createOption.innerHTML = `<span class="plus-icon">+</span> Create "${query}"`;
            //     createOption.addEventListener('click', () => createNewTag(query));
            //     optionsContainer.appendChild(createOption);
            // }
        }

        const filteredOptions = options.filter(opt => opt.name.toLowerCase().includes(query.toLowerCase()));
        if (filteredOptions.length === 0 && !query) {
            const noResult = document.createElement('div');
            noResult.className = 'option';
            noResult.textContent = 'No matching tags found';
            noResult.style.fontStyle = 'italic';
            noResult.style.color = '#9ca3af';
            optionsContainer.appendChild(noResult);
            return;
        }

        filteredOptions.forEach(option => {
            const optionElement = document.createElement('div');
            optionElement.className = 'option';
            if (selectedTags.includes(option)) {
                optionElement.classList.add('selected');
            }

            if (query) {
                const index = option.name.toLowerCase().indexOf(query.toLowerCase());
                if (index >= 0) {
                    const before = option.name.substring(0, index);
                    const match = option.name.substring(index, index + query.length);
                    const after = option.name.substring(index + query.length);
                    optionElement.innerHTML = `${before}<strong style="color: var(--primary-color)">${match}</strong>${after}`;
                }
            } else {
                optionElement.textContent = option.name;
            }
            optionElement.addEventListener('click', () => selectOption(option));
            optionsContainer.appendChild(optionElement);
        });
    }

    function createNewTag(tagName) {
        if (!tagName?.trim()) return;
        tagName = tagName.trim();
        const tagExists = options.some(opt => opt.name.toLowerCase() === tagName.toLowerCase());

        if (!tagExists) {
            options.push(tagName);
            customTags.add(tagName);
        }

        selectOption(tagName);
    }

    function selectOption(option) {
        console.log('selectOption', option);
        if (!selectedTags.includes(option)) {
            selectedTags.push(option);
            renderTags();
            tagInput.value = '';
            filterOptions('');
            tagInput.focus();
        }
    }

    function selectOptionById(id){
        const option = options.find(opt => opt.id == id);
        console.log('selectOption', option);
        if (!selectedTags.includes(option)) {
            selectedTags.push(option);
            renderTags();
            tagInput.value = '';
            filterOptions('');
            tagInput.focus();
        }
    }

    function removeTag(tag) {
        selectedTags = selectedTags.filter(t => t !== tag);
        renderTags();
    }

    function renderTags() {
        const existingTags = tagContainer.querySelectorAll('.tag');
        existingTags.forEach(tag => tag.remove());

        selectedTags.forEach(tag => {
            const tagElement = document.createElement('div');
            tagElement.className = 'tag';
            tagElement.setAttribute('data-value', tag.name);
            tagElement.setAttribute('data-id', tag.id); // Use name as id if not provided

            if (customTags.has(tag)) {
                tagElement.classList.add('new-tag');
            }

            tagElement.innerHTML = `
                ${tag.name}
                <span class="tag-remove">×</span>
            `;

            tagElement.querySelector('.tag-remove').addEventListener('click', (e) => {
                e.stopPropagation();
                removeTag(tag);
            });

            tagContainer.insertBefore(tagElement, tagInput);
        });

        const optionElements = optionsContainer.querySelectorAll('.option');
        optionElements.forEach(el => {
            const text = el.textContent || el.innerText;
            el.classList.toggle('selected', selectedTags.includes(text));
        });
    }

    function clearContainer() {
        options = [...artTags];
        selectedTags = [];
        customTags.clear();
        renderTags();
    }

    tagInput.addEventListener('focus', () => {
        optionsContainer.classList.add('show');
        filterOptions(tagInput.value);
    });

    tagInput.addEventListener('input', () => {
        filterOptions(tagInput.value);
        optionsContainer.classList.add('show');
    });

    tagInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            const val = tagInput.value.trim();
            if (!val) return;

            const exactMatch = options.find(opt => opt.toLowerCase() === val.toLowerCase());
            exactMatch ? selectOption(exactMatch) : null;
        } else if (e.key === 'Backspace' && tagInput.value === '' && selectedTags.length > 0) {
            removeTag(selectedTags[selectedTags.length - 1]);
        }
    });

    document.addEventListener('click', (e) => {
        if (!tagContainer.contains(e.target)) {
            optionsContainer.classList.remove('show');
        }
    });

    initOptions();

    return {
        getSelectedTags: () => selectedTags.map(tag => Number(tag.id)),
        selectOption: (option) => selectOption(option),
        selectOptionById: (id) => selectOptionById(id),
        clearContainer: () => clearContainer(),
    };
}
