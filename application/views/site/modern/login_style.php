<?php
// Clean Chatwiser Login Page Styles - Updated with New Branding
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
    overflow: hidden;
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
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    top: -100px;
    left: -100px;
    animation: float 20s ease-in-out infinite;
}

body::after {
    content: '';
    position: absolute;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.08);
    bottom: -75px;
    right: -75px;
    animation: float 25s ease-in-out infinite reverse;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) translateX(0px) rotate(0deg);
        opacity: 0.1;
    }
    33% {
        transform: translateY(-30px) translateX(20px) rotate(120deg);
        opacity: 0.2;
    }
    66% {
        transform: translateY(20px) translateX(-15px) rotate(240deg);
        opacity: 0.15;
    }
}

/* Modern Login Card */
.login-container {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 20px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(255, 255, 255, 0.1);
    padding: 40px;
    width: 100%;
    max-width: 700px;
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

.login-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #052CFF, #0ADCC7);
    border-radius: 16px 16px 0 0;
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
    width: 60px;
    height: 60px;
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
        transform: translateY(-10px);
    }
}

/* Brand Section */
.brand-section {
    text-align: center;
    margin-bottom: 32px;
}

.brand-title {
    font-size: 28px;
    font-weight: 700;
    color: #120132;
    margin: 0 0 8px 0;
    background: linear-gradient(45deg, #052CFF, #0ADCC7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: textShimmer 2s ease-in-out infinite alternate;
}

.brand-subtitle {
    font-size: 16px;
    color: #666;
    font-weight: 400;
    margin: 0 0 16px 0;
    opacity: 0.8;
}

.social-proof-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(5, 44, 255, 0.1);
    color: #052CFF;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
    border: 1px solid rgba(5, 44, 255, 0.2);
}

.social-proof-badge i {
    font-size: 16px;
    color: #0ADCC7;
}

@keyframes textShimmer {
    0% {
        background-position: 0% 50%;
    }
    100% {
        background-position: 100% 50%;
    }
}

/* Form Fields */
.form-group {
    margin-bottom: 20px;
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
    padding: 12px 16px;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    font-size: 16px;
    font-family: inherit;
    transition: all 0.3s ease;
    background: white;
}

.form-input:focus {
    outline: none;
    border-color: #052CFF;
    box-shadow: 0 0 0 3px rgba(5, 44, 255, 0.1);
}

.form-input::placeholder {
    color: #999;
}

/* Remember Device & Forgot Password */
.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.checkbox-group {
    display: flex;
    align-items: center;
}

.checkbox-input {
    width: 18px;
    height: 18px;
    margin-right: 8px;
    accent-color: #052CFF;
    cursor: pointer;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    color: #666;
    font-weight: 400;
    cursor: pointer;
    user-select: none;
}

.checkbox-label i {
    font-size: 14px;
    color: #0ADCC7;
}

.forgot-link {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #052CFF;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: color 0.3s ease;
}

.forgot-link:hover {
    color: #0ADCC7;
}

.forgot-link i {
    font-size: 14px;
}

/* Sign In Button */
.signin-btn {
    width: 100%;
    padding: 14px 24px;
    background: linear-gradient(45deg, #052CFF, #0ADCC7);
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: inherit;
    position: relative;
    overflow: hidden;
}

.signin-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(5, 44, 255, 0.3);
}

.signin-btn:active {
    transform: translateY(0);
}

/* Social Login Section */
.social-login-section {
    margin-top: 24px;
    text-align: center;
}

.divider {
    position: relative;
    margin-bottom: 20px;
}

.divider span {
    background: white;
    padding: 0 15px;
    font-size: 14px;
    color: #666;
    position: relative;
    z-index: 1;
}

.divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    width: 100%;
    height: 1px;
    background: #e1e5e9;
    z-index: 0;
}

.social-buttons {
    display: flex;
    justify-content: space-around;
    gap: 12px;
}

.social-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px 16px;
    border: 1px solid #e1e5e9;
    border-radius: 8px;
    color: #333;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    background: white;
}

.social-btn:hover {
    border-color: #052CFF;
    color: #052CFF;
    background: rgba(5, 44, 255, 0.05);
    transform: translateY(-1px);
}

.social-btn i {
    margin-right: 8px;
    font-size: 16px;
}

/* Team Login Section */
.team-login-section {
    margin-top: 20px;
    text-align: center;
}

.team-login-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px 24px;
    background: linear-gradient(45deg, #052CFF, #0ADCC7);
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    width: 100%;
}

.team-login-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(5, 44, 255, 0.3);
}

.team-login-btn i {
    margin-right: 8px;
    font-size: 16px;
}

/* Footer Link */
.footer-link {
    text-align: center;
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px solid #e1e5e9;
}

.footer-text {
    font-size: 14px;
    color: #666;
    margin-bottom: 12px;
}

.footer-link a,
.cta-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #052CFF;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.footer-link a:hover,
.cta-link:hover {
    color: #0ADCC7;
}

.cta-link {
    background: rgba(5, 44, 255, 0.1);
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 600;
    border: 1px solid rgba(5, 44, 255, 0.2);
    transition: all 0.3s ease;
}

.cta-link:hover {
    background: rgba(5, 44, 255, 0.15);
    transform: translateY(-1px);
}

.conversion-footer {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 12px;
    padding: 8px 16px;
    background: rgba(10, 220, 199, 0.1);
    border-radius: 8px;
    font-size: 13px;
    color: #0ADCC7;
    font-weight: 500;
}

.conversion-footer i {
    font-size: 14px;
}

/* Loading State */
.signin-btn.loading {
    pointer-events: none;
    opacity: 0.8;
}

.btn-content {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    position: relative;
}

.btn-content i {
    font-size: 16px;
}

.btn-spinner {
    display: none;
    width: 16px;
    height: 16px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-right: 8px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.signin-btn.loading .btn-spinner {
    display: block;
}

/* Alert Styles */
.alert {
    border-radius: 8px;
    border: none;
    padding: 12px 16px;
    margin-bottom: 20px;
    font-size: 14px;
}

.alert-danger {
    background: #fee;
    color: #c53030;
    border-left: 4px solid #c53030;
}

.alert-success {
    background: #f0fff4;
    color: #2f855a;
    border-left: 4px solid #2f855a;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .login-container {
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

    .login-container {
        padding: 32px 24px;
        max-width: 100%;
        margin: 0 auto;
        border-radius: 16px;
    }

    .brand-title {
        font-size: 24px;
        line-height: 1.2;
    }

    .brand-subtitle {
        font-size: 14px;
        line-height: 1.4;
    }

    .social-proof-badge {
        font-size: 13px;
        padding: 6px 12px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .logo-image {
        width: 50px;
        height: 50px;
    }

    .form-input {
        padding: 12px 14px;
        font-size: 16px; /* Prevents zoom on iOS */
        min-height: 48px;
    }

    .signin-btn {
        padding: 12px 20px;
        font-size: 16px;
        min-height: 48px;
    }

    .social-buttons {
        flex-direction: column;
        gap: 8px;
    }

    .social-btn {
        width: 100%;
        justify-content: center;
        padding: 12px 14px;
        min-height: 44px;
    }

    .team-login-btn {
        width: 100%;
        justify-content: center;
        padding: 12px 14px;
        min-height: 44px;
    }

    .form-options {
        flex-direction: column;
        gap: 12px;
        align-items: flex-start;
    }

    .checkbox-group {
        width: 100%;
    }

    .forgot-link {
        align-self: flex-end;
        font-size: 13px;
    }
}

@media (max-width: 480px) {
    body {
        padding: 12px;
        padding-top: 20px;
    }

    .login-container {
        padding: 24px 20px;
        margin: 0;
        border-radius: 12px;
        min-height: auto;
    }

    .brand-title {
        font-size: 20px;
        line-height: 1.3;
    }

    .brand-subtitle {
        font-size: 13px;
        line-height: 1.4;
    }

    .social-proof-badge {
        font-size: 11px;
        padding: 4px 8px;
        flex-direction: column;
        gap: 4px;
        text-align: center;
    }

    .logo-image {
        width: 40px;
        height: 40px;
    }

    .form-input {
        padding: 12px 14px;
        font-size: 16px;
        min-height: 48px;
        border-radius: 8px;
    }

    .signin-btn {
        padding: 12px 18px;
        font-size: 16px;
        min-height: 48px;
        border-radius: 8px;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-options {
        margin-bottom: 20px;
        gap: 8px;
    }

    .checkbox-label {
        font-size: 13px;
    }

    .forgot-link {
        font-size: 12px;
    }

    .footer-text {
        font-size: 13px;
    }

    .conversion-footer {
        font-size: 12px;
        padding: 8px 12px;
    }
}

/* Landscape orientation on mobile */
@media (max-width: 768px) and (orientation: landscape) {
    body {
        padding: 8px;
    }

    .login-container {
        padding: 24px 20px;
    }

    .brand-section {
        margin-bottom: 20px;
    }

    .logo-image {
        width: 40px;
        height: 40px;
    }

    .brand-title {
        font-size: 20px;
    }

    .brand-subtitle {
        font-size: 12px;
    }

    .social-proof-badge {
        font-size: 11px;
        padding: 4px 8px;
    }
}

/* Touch device optimizations */
@media (hover: none) and (pointer: coarse) {
    .signin-btn:hover {
        transform: none;
        box-shadow: 0 8px 20px rgba(220, 73, 133, 0.3);
    }

    .login-container:hover {
        transform: none;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .logo-icon:hover {
        transform: none;
    }

    /* Increase touch targets */
    .signin-btn {
        min-height: 48px;
    }

    .social-btn {
        min-height: 48px;
    }

    .form-input {
        min-height: 48px;
    }
}

/* Accessibility */
.form-input:focus-visible {
    outline: 2px solid #DC4985;
    outline-offset: 2px;
}

.signin-btn:focus-visible {
    outline: 2px solid #DC4985;
    outline-offset: 2px;
}

.forgot-link:focus-visible,
.footer-link a:focus-visible {
    outline: 2px solid #DC4985;
    outline-offset: 2px;
    border-radius: 4px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('.login-form');
    const signinBtn = document.querySelector('.signin-btn');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            // Add loading state
            signinBtn.classList.add('loading');
        });
    }

    // Enhanced form validation
    const inputs = document.querySelectorAll('.form-input');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.style.borderColor = '#e74c3c';
            } else {
                this.style.borderColor = '#e1e5e9';
            }
        });

        input.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.style.borderColor = '#e1e5e9';
            }
        });
    });

    // Enhanced accessibility
    const checkboxes = document.querySelectorAll('.checkbox-input');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const label = this.nextElementSibling;
            if (this.checked) {
                label.style.color = '#DC4985';
            } else {
                label.style.color = '#666';
            }
        });
    });
});
</script>
