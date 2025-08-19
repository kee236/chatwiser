<?php
// Modern Chatwiser Sign Up Page Styles - Updated with New Branding
?>

<style>
/* Import new brand fonts */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
    background: linear-gradient(135deg, #052CFF 0%, #0ADCC7 35%, #120132 100%);
    background-size: 400% 400%;
    animation: gradientShift 15s ease infinite;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    position: relative;
    overflow-x: hidden;
}

/* Animated background gradient */
@keyframes gradientShift {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

/* Floating animation elements */
body::before {
    content: '';
    position: absolute;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.08);
    top: -150px;
    left: -150px;
    animation: float 25s ease-in-out infinite;
}

body::after {
    content: '';
    position: absolute;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.06);
    bottom: -100px;
    right: -100px;
    animation: float 30s ease-in-out infinite reverse;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) translateX(0px) rotate(0deg);
        opacity: 0.08;
    }
    33% {
        transform: translateY(-40px) translateX(30px) rotate(120deg);
        opacity: 0.15;
    }
    66% {
        transform: translateY(30px) translateX(-20px) rotate(240deg);
        opacity: 0.12;
    }
}

/* Main Sign Up Container */
.signup-container {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 24px;
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(255, 255, 255, 0.1);
    padding: 40px;
    width: 100%;
    max-width: 800px;
    position: relative;
    z-index: 10;
    animation: slideUp 0.8s ease-out;
}

@keyframes slideUp {
    from {
        transform: translateY(30px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.signup-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #052CFF, #0ADCC7);
    border-radius: 24px 24px 0 0;
}

/* Logo Section */
.logo-section {
    text-align: center;
    margin-bottom: 20px;
}

.logo-only {
    display: inline-block;
    animation: logoFloat 3s ease-in-out infinite;
}

.logo-image {
    width: 50px;
    height: 50px;
    object-fit: contain;
    transition: all 0.3s ease;
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
}

.logo-image:hover {
    transform: scale(1.1);
    filter: drop-shadow(0 6px 12px rgba(0, 0, 0, 0.15));
}

@keyframes logoFloat {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-8px);
    }
}

/* Header Section */
.signup-header {
    text-align: center;
    margin-bottom: 32px;
}

.signup-title {
    font-size: 32px;
    font-weight: 700;
    color: #120132;
    margin: 0 0 12px 0;
    background: linear-gradient(45deg, #052CFF, #0ADCC7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: textShimmer 2s ease-in-out infinite alternate;
}

.signup-subtitle {
    font-size: 18px;
    color: #666;
    font-weight: 400;
    margin: 0 0 20px 0;
    opacity: 0.9;
}

.trust-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(10, 220, 199, 0.1);
    color: #0ADCC7;
    padding: 10px 20px;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 600;
    border: 1px solid rgba(10, 220, 199, 0.2);
}

.trust-badge i {
    font-size: 16px;
    color: #052CFF;
}

@keyframes textShimmer {
    0% {
        background-position: 0% 50%;
    }
    100% {
        background-position: 100% 50%;
    }
}

/* Alert Section */
.alert-section {
    margin-bottom: 24px;
}

.animated-alert {
    border-radius: 12px;
    border: none;
    padding: 16px 20px;
    margin-bottom: 16px;
    animation: slideInDown 0.5s ease-out;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 12px;
}

.animated-alert i {
    font-size: 18px;
    flex-shrink: 0;
}

.alert-success {
    background: rgba(34, 197, 94, 0.1);
    color: #059669;
    border-left: 4px solid #059669;
}

.alert-danger {
    background: rgba(239, 68, 68, 0.1);
    color: #dc2626;
    border-left: 4px solid #dc2626;
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Form Styling */
.signup-form {
    margin-bottom: 32px;
}

.form-section-title {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 16px;
    font-weight: 600;
    color: #120132;
    margin-bottom: 20px;
    padding-bottom: 8px;
    border-bottom: 2px solid rgba(5, 44, 255, 0.1);
}

.form-section-title i {
    font-size: 18px;
    color: #052CFF;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 24px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 500;
    color: #333;
    margin-bottom: 8px;
}

.form-label i {
    font-size: 16px;
    color: #052CFF;
}

.form-input {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid #e1e5e9;
    border-radius: 12px;
    font-size: 16px;
    font-family: inherit;
    transition: all 0.3s ease;
    background: white;
}

.form-input:focus {
    outline: none;
    border-color: #052CFF;
    box-shadow: 0 0 0 3px rgba(5, 44, 255, 0.1);
    transform: translateY(-1px);
}

.form-input::placeholder {
    color: #999;
}

/* Captcha Section */
.captcha-section {
    margin-bottom: 24px;
}

.captcha-group {
    display: flex;
    align-items: center;
    gap: 16px;
    background: rgba(5, 44, 255, 0.05);
    padding: 16px;
    border-radius: 12px;
    border: 1px solid rgba(5, 44, 255, 0.1);
}

.captcha-question {
    background: white;
    padding: 12px 16px;
    border-radius: 8px;
    border: 2px solid #052CFF;
    min-width: 120px;
    text-align: center;
}

.captcha-text {
    font-size: 18px;
    font-weight: 600;
    color: #052CFF;
}

.captcha-input {
    flex: 1;
    padding: 12px 16px;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    font-size: 16px;
    font-family: inherit;
    transition: all 0.3s ease;
}

.captcha-input:focus {
    outline: none;
    border-color: #052CFF;
    box-shadow: 0 0 0 3px rgba(5, 44, 255, 0.1);
}

/* Terms Section */
.terms-section {
    margin-bottom: 32px;
}

.checkbox-group {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.checkbox-input {
    width: 20px;
    height: 20px;
    margin-top: 2px;
    accent-color: #052CFF;
    cursor: pointer;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #666;
    font-weight: 400;
    cursor: pointer;
    user-select: none;
    line-height: 1.5;
}

.checkbox-label i {
    font-size: 16px;
    color: #0ADCC7;
}

.terms-link {
    color: #052CFF;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.terms-link:hover {
    color: #0ADCC7;
    text-decoration: underline;
}

/* Submit Section */
.submit-section {
    margin-bottom: 24px;
}

.signup-btn {
    width: 100%;
    padding: 16px 24px;
    background: linear-gradient(45deg, #052CFF, #0ADCC7);
    border: none;
    border-radius: 12px;
    color: white;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: inherit;
    position: relative;
    overflow: hidden;
}

.signup-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(5, 44, 255, 0.3);
}

.signup-btn:active {
    transform: translateY(0);
}

.btn-content {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    position: relative;
}

.btn-content i {
    font-size: 18px;
}

.btn-spinner {
    display: none;
    width: 18px;
    height: 18px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.signup-btn.loading {
    pointer-events: none;
    opacity: 0.8;
}

.signup-btn.loading .btn-spinner {
    display: block;
}

/* Footer Section */
.signup-footer {
    text-align: center;
    padding-top: 24px;
    border-top: 1px solid #e1e5e9;
}

.footer-text {
    font-size: 14px;
    color: #666;
    margin-bottom: 16px;
}

.signin-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #052CFF;
    text-decoration: none;
    font-weight: 600;
    background: rgba(5, 44, 255, 0.1);
    padding: 8px 16px;
    border-radius: 8px;
    border: 1px solid rgba(5, 44, 255, 0.2);
    transition: all 0.3s ease;
}

.signin-link:hover {
    color: #0ADCC7;
    background: rgba(5, 44, 255, 0.15);
    transform: translateY(-1px);
}

.community-footer {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 16px;
    padding: 12px 20px;
    background: rgba(10, 220, 199, 0.1);
    border-radius: 12px;
    font-size: 13px;
    color: #0ADCC7;
    font-weight: 500;
}

.community-footer i {
    font-size: 16px;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .signup-container {
        max-width: 90%;
    }
}

@media (max-width: 768px) {
    body {
        padding: 16px;
        min-height: 100vh;
        align-items: flex-start;
        padding-top: 40px;
    }

    .signup-container {
        padding: 32px 24px;
        max-width: 100%;
        border-radius: 20px;
        margin: 0 auto;
    }

    .signup-title {
        font-size: 26px;
        line-height: 1.2;
    }

    .signup-subtitle {
        font-size: 16px;
        line-height: 1.4;
    }

    .trust-badge {
        font-size: 13px;
        padding: 8px 16px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .form-row {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .form-input {
        min-height: 48px;
        font-size: 16px; /* Prevents zoom on iOS */
    }

    .captcha-group {
        flex-direction: column;
        gap: 12px;
        text-align: center;
    }

    .captcha-question {
        min-width: auto;
        width: 100%;
        padding: 16px;
    }

    .captcha-input {
        min-height: 48px;
        font-size: 16px;
    }

    .logo-image {
        width: 45px;
        height: 45px;
    }

    .signup-btn {
        padding: 14px 20px;
        font-size: 16px;
        min-height: 52px;
    }

    .checkbox-group {
        align-items: flex-start;
        gap: 8px;
    }

    .checkbox-input {
        margin-top: 4px;
        flex-shrink: 0;
    }

    .signin-link {
        font-size: 13px;
        padding: 6px 12px;
    }
}

@media (max-width: 480px) {
    body {
        padding: 12px;
        padding-top: 20px;
    }

    .signup-container {
        padding: 24px 20px;
        margin: 0;
        border-radius: 16px;
        min-height: auto;
    }

    .signup-title {
        font-size: 22px;
        line-height: 1.3;
    }

    .signup-subtitle {
        font-size: 14px;
        line-height: 1.4;
    }

    .trust-badge {
        font-size: 11px;
        padding: 6px 12px;
        flex-direction: column;
        gap: 4px;
        text-align: center;
    }

    .form-input {
        padding: 12px 14px;
        font-size: 16px; /* Prevents zoom on iOS */
        min-height: 48px;
        border-radius: 8px;
    }

    .captcha-input {
        padding: 12px 14px;
        font-size: 16px;
        min-height: 48px;
        border-radius: 8px;
    }

    .captcha-question {
        padding: 12px 16px;
        border-radius: 8px;
    }

    .signup-btn {
        padding: 12px 18px;
        font-size: 16px;
        min-height: 48px;
        border-radius: 8px;
    }

    .logo-image {
        width: 40px;
        height: 40px;
    }

    .form-section-title {
        font-size: 15px;
        margin-bottom: 16px;
    }

    .checkbox-label {
        font-size: 13px;
        line-height: 1.4;
    }

    .footer-text {
        font-size: 13px;
    }

    .community-footer {
        font-size: 12px;
        padding: 8px 12px;
    }

    .animated-alert {
        padding: 12px 16px;
        font-size: 13px;
    }
}

/* Landscape orientation on mobile */
@media (max-width: 768px) and (orientation: landscape) {
    body {
        padding: 8px;
    }

    .signup-container {
        padding: 24px 20px;
        margin: 4px;
    }

    .signup-header {
        margin-bottom: 20px;
    }

    .logo-image {
        width: 35px;
        height: 35px;
    }

    .signup-title {
        font-size: 22px;
    }

    .signup-subtitle {
        font-size: 14px;
    }
}

/* Touch device optimizations */
@media (hover: none) and (pointer: coarse) {
    .signup-btn:hover {
        transform: none;
        box-shadow: 0 12px 30px rgba(5, 44, 255, 0.3);
    }

    .signin-link:hover {
        transform: none;
    }

    .logo-image:hover {
        transform: none;
    }

    /* Increase touch targets */
    .signup-btn {
        min-height: 52px;
    }

    .form-input {
        min-height: 48px;
    }

    .captcha-input {
        min-height: 44px;
    }
}

/* Accessibility */
.form-input:focus-visible {
    outline: 2px solid #052CFF;
    outline-offset: 2px;
}

.signup-btn:focus-visible {
    outline: 2px solid #052CFF;
    outline-offset: 2px;
}

.terms-link:focus-visible,
.signin-link:focus-visible {
    outline: 2px solid #052CFF;
    outline-offset: 2px;
    border-radius: 4px;
}

/* Enhanced form validation styling */
.form-input.error {
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
}

.form-input.success {
    border-color: #059669;
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const signupForm = document.querySelector('.signup-form');
    const signupBtn = document.querySelector('.signup-btn');
    
    if (signupForm) {
        signupForm.addEventListener('submit', function(e) {
            // Add loading state
            signupBtn.classList.add('loading');
        });
    }

    // Enhanced form validation
    const inputs = document.querySelectorAll('.form-input, .captcha-input');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });

        input.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                validateField(this);
            }
        });
    });

    function validateField(field) {
        const value = field.value.trim();
        const isRequired = field.hasAttribute('required');
        
        // Remove existing validation classes
        field.classList.remove('error', 'success');
        
        if (isRequired && value === '') {
            field.classList.add('error');
            return false;
        }
        
        // Email validation
        if (field.type === 'email' && value !== '') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                field.classList.add('error');
                return false;
            }
        }
        
        // Password confirmation
        if (field.name === 'confirm_password') {
            const password = document.querySelector('input[name="password"]').value;
            if (value !== password) {
                field.classList.add('error');
                return false;
            }
        }
        
        if (value !== '') {
            field.classList.add('success');
        }
        
        return true;
    }

    // Enhanced accessibility
    const checkboxes = document.querySelectorAll('.checkbox-input');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const label = this.nextElementSibling;
            if (this.checked) {
                label.style.color = '#052CFF';
            } else {
                label.style.color = '#666';
            }
        });
    });

    // Form progress indicator
    const requiredFields = document.querySelectorAll('input[required]');
    function updateProgress() {
        const filledFields = Array.from(requiredFields).filter(field => {
            if (field.type === 'checkbox') {
                return field.checked;
            }
            return field.value.trim() !== '';
        });
        
        const progress = (filledFields.length / requiredFields.length) * 100;
        
        // Update submit button state
        if (progress === 100) {
            signupBtn.style.background = 'linear-gradient(45deg, #052CFF, #0ADCC7)';
        } else {
            signupBtn.style.background = 'linear-gradient(45deg, #ccc, #999)';
        }
    }

    requiredFields.forEach(field => {
        field.addEventListener('input', updateProgress);
        field.addEventListener('change', updateProgress);
    });

    // Initial progress check
    updateProgress();
});
</script>
