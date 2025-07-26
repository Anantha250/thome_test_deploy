// Initialize AOS animation library

const artName = document.querySelector(".art-name");

document.querySelectorAll(".facebook").forEach((el) => {
    el.setAttribute(
        "href",
        `https://www.facebook.com/sharer.php?u=${window.location.href}`
    );
});

document.querySelectorAll(".twitter").forEach((el) => {
    // console.log("twitter")
    el.setAttribute(
        "href",
        `https://twitter.com/intent/tweet?text=${artName.innerText}&url=${window.location.href}`
    );
});

document.querySelectorAll(".line").forEach((el) => {
    // console.log("line")
    el.setAttribute(
        "href",
        `https://lineit.line.me/share/ui?url=${window.location.href}"`
    );
});

// Copy link functionality
document.querySelectorAll(".copy-link").forEach((el) => {
    el.addEventListener("click", () => {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            console.log("Link copied to clipboard:", url);
            window.showToast("ลิงก์ถูกคัดลอกแล้ว!", "success");
        });
    });
});

document.querySelector(".btn-review").addEventListener("click", () => {
    window.open(
        "https://www.facebook.com/t.homeinspector/reviews?locale=th_TH",
        "_blank"
    );
});

// Add image zoom functionality
const articleImages = document.querySelectorAll(".art-content img");
articleImages.forEach((img) => {
    img.addEventListener("click", function () {
        // Create modal for image zoom
        const modal = document.createElement("div");
        modal.className = "image-zoom-modal";
        modal.innerHTML = `
      <div class="zoom-container">
        <img src="${this.src}" alt="${this.alt}">
        <button class="close-zoom">×</button>
      </div>
    `;

        // Style the modal
        modal.style.position = "fixed";
        modal.style.top = "0";
        modal.style.left = "0";
        modal.style.width = "100%";
        modal.style.height = "100%";
        modal.style.backgroundColor = "rgba(0,0,0,0.9)";
        modal.style.zIndex = "1000";
        modal.style.display = "flex";
        modal.style.alignItems = "center";
        modal.style.justifyContent = "center";
        modal.style.opacity = "0";
        modal.style.transition = "opacity 0.3s ease";

        const zoomContainer = modal.querySelector(".zoom-container");
        zoomContainer.style.position = "relative";
        zoomContainer.style.maxWidth = "90%";
        zoomContainer.style.maxHeight = "90%";

        const zoomImg = modal.querySelector("img");
        zoomImg.style.maxWidth = "100%";
        zoomImg.style.maxHeight = "90vh";
        zoomImg.style.display = "block";
        zoomImg.style.boxShadow = "0 5px 30px rgba(0,0,0,0.3)";

        const closeBtn = modal.querySelector(".close-zoom");
        closeBtn.style.position = "absolute";
        closeBtn.style.top = "-20px";
        closeBtn.style.right = "-20px";
        closeBtn.style.backgroundColor = "#ff6b6b";
        closeBtn.style.color = "white";
        closeBtn.style.border = "none";
        closeBtn.style.borderRadius = "50%";
        closeBtn.style.width = "40px";
        closeBtn.style.height = "40px";
        closeBtn.style.fontSize = "24px";
        closeBtn.style.cursor = "pointer";
        closeBtn.style.display = "flex";
        closeBtn.style.alignItems = "center";
        closeBtn.style.justifyContent = "center";

        document.body.appendChild(modal);
        setTimeout(() => {
            modal.style.opacity = "1";
        }, 10);

        // Close modal on button click or background click
        closeBtn.addEventListener("click", closeModal);
        modal.addEventListener("click", (e) => {
            if (e.target === modal) closeModal();
        });

        function closeModal() {
            modal.style.opacity = "0";
            setTimeout(() => {
                document.body.removeChild(modal);
            }, 300);
        }
    });

    // Add cursor pointer to indicate clickable
    img.style.cursor = "zoom-in";
});

// Add reading progress indicator
const progressBar = document.createElement("div");
progressBar.className = "reading-progress";
progressBar.style.position = "fixed";
progressBar.style.top = "0";
progressBar.style.left = "0";
progressBar.style.height = "4px";
progressBar.style.backgroundColor = "#ff6b6b";
progressBar.style.width = "0%";
progressBar.style.zIndex = "1000";
progressBar.style.transition = "width 0.1s";
document.body.appendChild(progressBar);

window.addEventListener("scroll", () => {
    const windowHeight = window.innerHeight;
    const fullHeight = document.body.scrollHeight - windowHeight;
    const scrolled = window.scrollY;
    const progress = (scrolled / fullHeight) * 100;
    progressBar.style.width = progress + "%";
});

// Add estimated reading time
const articleContent = document.querySelector(".art-content");
if (articleContent) {
    const text = articleContent.textContent;
    const wordCount = text.split(/\s+/).length;
    const readingTime = Math.ceil(wordCount / 200); // Average reading speed: 200 words per minute

    const readingTimeElement = document.querySelector(".reading-time span");
    readingTimeElement.innerText = `${readingTime}`;

    // const artHeader = document.querySelector(".art-cover-img");
    // artHeader.appendChild(readingTimeElement);
}

class ResponsiveCarousel {
    constructor() {
        this.wrapper = document.getElementById("carouselWrapper");
        this.prevBtn = document.getElementById("prevBtn");
        this.nextBtn = document.getElementById("nextBtn");
        this.dotsContainer = document.getElementById("dotsContainer");
        this.items = document.querySelectorAll(".article-carousel-item");

        this.currentIndex = 0;
        this.itemsPerView = this.getItemsPerView();
        this.totalSlides = Math.ceil(this.items.length / this.itemsPerView);

        this.init();
        this.setupEventListeners();
    }

    getItemsPerView() {
        if (window.innerWidth <= 576) return 1;
        else if (window.innerWidth <= 992) return 2;
        return 3;
    }

    init() {
        this.createDots();
        this.updateCarousel();
        this.updateButtons();
    }

    createDots() {
        this.dotsContainer.innerHTML = "";
        for (let i = 0; i < this.totalSlides; i++) {
            const dot = document.createElement("div");
            dot.className = "dot";
            dot.addEventListener("click", () => this.goToSlide(i));
            this.dotsContainer.appendChild(dot);
        }
    }

    updateCarousel() {
        const translateX = -(this.currentIndex * (100 / this.itemsPerView));
        this.wrapper.style.transform = `translateX(${translateX}%)`;

        // Update dots
        document.querySelectorAll(".dot").forEach((dot, index) => {
            dot.classList.toggle("active", index === this.currentIndex);
        });
    }

    updateButtons() {
        this.prevBtn.disabled = this.currentIndex === 0;
        this.nextBtn.disabled = this.currentIndex >= this.totalSlides - 1;
    }

    goToSlide(index) {
        this.currentIndex = Math.max(0, Math.min(index, this.totalSlides - 1));
        this.updateCarousel();
        this.updateButtons();
    }

    next() {
        if (this.currentIndex < this.totalSlides - 1) {
            this.currentIndex++;
            this.updateCarousel();
            this.updateButtons();
        }
    }

    prev() {
        if (this.currentIndex > 0) {
            this.currentIndex--;
            this.updateCarousel();
            this.updateButtons();
        }
    }

    handleResize() {
        const newItemsPerView = this.getItemsPerView();
        if (newItemsPerView !== this.itemsPerView) {
            this.itemsPerView = newItemsPerView;
            this.totalSlides = Math.ceil(this.items.length / this.itemsPerView);
            this.currentIndex = Math.min(
                this.currentIndex,
                this.totalSlides - 1
            );
            this.createDots();
            this.updateCarousel();
            this.updateButtons();
        }
    }

    setupEventListeners() {
        this.nextBtn.addEventListener("click", () => this.next());
        this.prevBtn.addEventListener("click", () => this.prev());

        window.addEventListener("resize", () => this.handleResize());

        // Touch/swipe support
        let startX = 0;
        let isDragging = false;

        this.wrapper.addEventListener("touchstart", (e) => {
            startX = e.touches[0].clientX;
            isDragging = true;
        });

        this.wrapper.addEventListener("touchmove", (e) => {
            if (!isDragging) return;
            e.preventDefault();
        });

        this.wrapper.addEventListener("touchend", (e) => {
            if (!isDragging) return;
            isDragging = false;

            const endX = e.changedTouches[0].clientX;
            const diff = startX - endX;

            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    this.next();
                } else {
                    this.prev();
                }
            }
        });

        // Keyboard navigation
        document.addEventListener("keydown", (e) => {
            if (e.key === "ArrowLeft") {
                this.prev();
            } else if (e.key === "ArrowRight") {
                this.next();
            }
        });
    }
}

// Initialize carousel when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
    new ResponsiveCarousel();
});
