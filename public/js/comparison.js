document.addEventListener('DOMContentLoaded', function() {
    // Initialize the page
    initializePage();
    
    // Add smooth scrolling
    addSmoothScrolling();
    
    // Add interactive effects
    addInteractiveEffects();
    
    // Handle responsive behavior
    handleResponsive();
    window.addEventListener('resize', handleResponsive);
});

function initializePage() {
    // Add loading animation
    const elements = document.querySelectorAll('.house-card, .comparison-category');
    elements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            element.style.transition = 'all 0.6s ease-out';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Highlight best features
    highlightBestFeatures();
}

function addSmoothScrolling() {
    // Smooth scroll for breadcrumb links
    const breadcrumbLinks = document.querySelectorAll('.breadcrumb-link');
    breadcrumbLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Add click effect
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    });
}

function addInteractiveEffects() {
    // House card hover effects
    const houseCards = document.querySelectorAll('.house-card');
    houseCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
            this.style.boxShadow = '0 1.5rem 4rem rgba(0, 0, 0, 0.2)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 0.5rem 1rem rgba(0, 0, 0, 0.15)';
        });
    });
    
    // Row data hover effects
    const rowData = document.querySelectorAll('.row-data');
    rowData.forEach(cell => {
        cell.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#e3f2fd';
            this.style.transform = 'scale(1.02)';
        });
        
        cell.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'white';
            this.style.transform = 'scale(1)';
        });
    });
    
    // Category icon animation
    const categoryIcons = document.querySelectorAll('.category-icon');
    categoryIcons.forEach(icon => {
        icon.addEventListener('mouseenter', function() {
            this.style.transform = 'rotate(360deg) scale(1.1)';
        });
        
        icon.addEventListener('mouseleave', function() {
            this.style.transform = 'rotate(0deg) scale(1)';
        });
    });
}

function highlightBestFeatures() {
    // Find and highlight the best price
    const priceCells = document.querySelectorAll('.highlight-price');
    if (priceCells.length > 0) {
        let lowestPrice = Infinity;
        let bestPriceCell = null;
        
        priceCells.forEach(cell => {
            const priceText = cell.textContent.replace(/[^\d]/g, '');
            const price = parseInt(priceText);
            
            if (price < lowestPrice) {
                lowestPrice = price;
                bestPriceCell = cell;
            }
        });
        
        if (bestPriceCell) {
            bestPriceCell.classList.add('best-value');
            bestPriceCell.innerHTML += ' <span class="best-badge">ราคาดีที่สุด</span>';
        }
    }
    
    // Count and highlight houses with most features
    highlightMostFeatures();
}

function highlightMostFeatures() {
    const houses = document.querySelectorAll('.house-card');
    const featureCounts = [];
    
    // Count features for each house
    houses.forEach((house, index) => {
        const houseIndex = index;
        const availableFeatures = document.querySelectorAll(`.row-data:nth-child(${index + 2}) .feature-status.available`);
        featureCounts.push({
            index: houseIndex,
            count: availableFeatures.length,
            element: house
        });
    });
    
    // Find house with most features
    const bestHouse = featureCounts.reduce((prev, current) => 
        (prev.count > current.count) ? prev : current
    );
    
    if (bestHouse && bestHouse.count > 0) {
        const badge = bestHouse.element.querySelector('.house-badge');
        if (badge) {
            badge.innerHTML += ' ⭐';
            badge.style.background = 'linear-gradient(45deg, #ffd700, #ffed4e)';
            badge.style.color = '#333';
        }
    }
}

function handleResponsive() {
    const screenWidth = window.innerWidth;
    const comparisonRows = document.querySelectorAll('.comparison-row');
    
    if (screenWidth <= 768) {
        // Mobile layout adjustments
        comparisonRows.forEach(row => {
            row.style.gridTemplateColumns = '1fr';
        });
        
        // Adjust category headers for mobile
        const categoryHeaders = document.querySelectorAll('.category-header');
        categoryHeaders.forEach(header => {
            header.style.flexDirection = 'column';
            header.style.textAlign = 'center';
        });
    } else {
        // Desktop layout
        comparisonRows.forEach(row => {
            const childCount = row.children.length - 1; // Subtract 1 for label
            row.style.gridTemplateColumns = `250px repeat(${childCount}, 1fr)`;
        });
        
        // Reset category headers for desktop
        const categoryHeaders = document.querySelectorAll('.category-header');
        categoryHeaders.forEach(header => {
            header.style.flexDirection = 'row';
            header.style.textAlign = 'left';
        });
    }
}

// Add scroll animations
function addScrollAnimations() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    const animatedElements = document.querySelectorAll('.comparison-category, .house-card');
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease-out';
        observer.observe(el);
    });
}

// Initialize scroll animations after page load
window.addEventListener('load', addScrollAnimations);

// Add comparison functionality
function addComparisonFeatures() {
    // Add feature comparison tooltips
    const featureStatuses = document.querySelectorAll('.feature-status');
    featureStatuses.forEach(status => {
        status.addEventListener('mouseenter', function() {
            const spec = this.parentElement.querySelector('.feature-spec');
            if (spec) {
                spec.style.display = 'block';
                spec.style.opacity = '1';
                spec.style.transform = 'translateY(0)';
            }
        });
    });
    
    // Add print functionality
    const printButton = document.createElement('button');
    printButton.innerHTML = '<i class="fas fa-print"></i> พิมพ์ผลการเปรียบเทียบ';
    printButton.className = 'print-button';
    printButton.style.cssText = `
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 1rem 1.5rem;
        border-radius: 50px;
        box-shadow: var(--shadow-lg);
        cursor: pointer;
        font-family: 'Kanit', sans-serif;
        font-weight: 500;
        z-index: 1000;
        transition: var(--transition);
    `;
    
    printButton.addEventListener('click', () => window.print());
    printButton.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.05)';
        this.style.boxShadow = '0 1.5rem 4rem rgba(74, 144, 226, 0.3)';
    });
    printButton.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
        this.style.boxShadow = 'var(--shadow-lg)';
    });
    
    document.body.appendChild(printButton);
}

// Initialize comparison features
setTimeout(addComparisonFeatures, 1000);