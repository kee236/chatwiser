/**
 * Counter Animation for Social Proof Statistics
 * Animates numbers from 0 to target value when element comes into view
 */

// Counter Animation Script
function animateCounter(element, target, duration = 2000, suffix = '') {
    let start = 0;
    const increment = target / (duration / 16);
    
    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            start = target;
            clearInterval(timer);
        }
        element.textContent = Math.floor(start) + suffix;
    }, 16);
}

// Initialize counters when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Select all counter elements with improved selectors
    const counters = document.querySelectorAll('[data-count], .trusted-count, .result-count, .trust-count');
    
    // Function to start animation for a counter
    function startAnimation(counter) {
        const target = parseInt(counter.getAttribute('data-count'));
        
        // Different durations and suffixes based on context
        let duration = 2000;
        let suffix = '';
        
        if (counter.classList.contains('trusted-count')) {
            duration = 2500;
        } else if (counter.classList.contains('result-count')) {
            duration = 1500;
        } else if (counter.classList.contains('trust-count')) {
            duration = 2000;
        }
        
        animateCounter(counter, target, duration, suffix);
    }
    
    // Intersection Observer to trigger animations when elements come into view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                if (counter.getAttribute('data-count') && !counter.classList.contains('animated')) {
                    counter.classList.add('animated');
                    startAnimation(counter);
                }
            }
        });
    }, {
        threshold: 0.5
    });
    
    // Observe all counter elements individually
    counters.forEach(counter => {
        if (counter.getAttribute('data-count')) {
            observer.observe(counter);
        }
    });
    
    // Also observe counter containers for backup
    const sections = document.querySelectorAll('.social-proof-stats, .trusted-by, .results-section, .trust-indicators, .form-trust, .trust-badges');
    sections.forEach(section => {
        if (section) {
            const sectionCounters = section.querySelectorAll('[data-count]');
            sectionCounters.forEach(counter => {
                observer.observe(counter);
            });
        }
    });
});

// Add some additional effects
document.addEventListener('DOMContentLoaded', function() {
    const statItems = document.querySelectorAll('.stat-item, .trust-item, .info-card');
    
    statItems.forEach((item, index) => {
        // Add staggered animation delay
        item.style.animationDelay = (index * 0.2) + 's';
        
        // Add hover effect for icons
        const icon = item.querySelector('.stat-icon, .trust-icon, .info-icon');
        if (icon) {
            item.addEventListener('mouseenter', () => {
                icon.style.transform = 'scale(1.1) rotate(5deg)';
            });
            
            item.addEventListener('mouseleave', () => {
                icon.style.transform = 'scale(1) rotate(0deg)';
            });
        }
    });
}); 
// Debug and Fallback Counter Animation
document.addEventListener('DOMContentLoaded', function() {
    console.log('Counter animation script loaded');
    
    // Immediate counter animation for testing
    setTimeout(() => {
        const allCounters = document.querySelectorAll('.trust-count[data-count], .trusted-count[data-count], .result-count[data-count]');
        console.log('Found counters:', allCounters.length);
        
        allCounters.forEach((counter, index) => {
            const target = parseInt(counter.getAttribute('data-count'));
            console.log(`Animating counter ${index}: target = ${target}`);
            
            if (target && !counter.classList.contains('animated')) {
                counter.classList.add('animated');
                animateCounter(counter, target, 2000);
            }
        });
    }, 1000);
});

// Manual trigger function for testing
window.triggerCounters = function() {
    const counters = document.querySelectorAll('[data-count]');
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-count'));
        if (target) {
            counter.classList.remove('animated');
            animateCounter(counter, target, 2000);
        }
    });
};
