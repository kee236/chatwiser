<?php
// Clean Chatwiser Login Page Styles
?>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

/* Modern Login Card */
.login-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    padding: 40px;
    width: 100%;
    max-width: 700px;
    position: relative;
}

.login-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #DC4985, #F18DA2);
    border-radius: 16px 16px 0 0;
}

/* Branding Section */
.brand-section {
    text-align: center;
    margin-bottom: 32px;
}

.logo-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
}

.logo-icon {
    width: 56px;
    height: 56px;
    background: linear-gradient(45deg, #DC4985, #F18DA2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    font-weight: 600;
    margin-right: 16px;
    box-shadow: 0 8px 20px rgba(220, 73, 133, 0.3);
    transition: all 0.3s ease;
    overflow: hidden;
}

.logo-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.logo-icon:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 25px rgba(220, 73, 133, 0.4);
}

.logo-icon:hover .logo-image {
    transform: scale(1.1);
}

.brand-text {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.brand-name {
    font-size: 28px;
    font-weight: 700;
    color: #333;
    margin: 0;
}

.brand-tagline {
    font-size: 16px;
    color: #666;
    font-weight: 400;
    margin: 4px 0 0 0;
}

/* Form Fields */
.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-size: 14px;
    font-weight: 500;
    color: #333;
    margin-bottom: 8px;
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
    border-color: #DC4985;
    box-shadow: 0 0 0 3px rgba(220, 73, 133, 0.1);
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
    accent-color: #DC4985;
    cursor: pointer;
}

.checkbox-label {
    font-size: 14px;
    color: #666;
    font-weight: 400;
    cursor: pointer;
    user-select: none;
}

.forgot-link {
    color: #DC4985;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: color 0.3s ease;
}

.forgot-link:hover {
    color: #F18DA2;
}

/* Sign In Button */
.signin-btn {
    width: 100%;
    padding: 14px 24px;
    background: linear-gradient(45deg, #DC4985, #F18DA2);
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
    box-shadow: 0 8px 20px rgba(220, 73, 133, 0.3);
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
    border-color: #DC4985;
    color: #DC4985;
    background: rgba(220, 73, 133, 0.05);
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
    background: linear-gradient(45deg, #DC4985, #F18DA2);
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
    box-shadow: 0 8px 20px rgba(220, 73, 133, 0.3);
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
}

.footer-link a {
    color: #DC4985;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.footer-link a:hover {
    color: #F18DA2;
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
    position: relative;
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
@media (max-width: 768px) {
    body {
        padding: 16px;
    }

    .login-container {
        padding: 32px 24px;
        max-width: 100%;
    }

    .brand-name {
        font-size: 24px;
    }

    .brand-tagline {
        font-size: 14px;
    }

    .logo-icon {
        width: 48px;
        height: 48px;
        font-size: 20px;
        margin-right: 12px;
    }

    .logo-image {
        width: 100%;
        height: 100%;
    }

    .form-input {
        padding: 12px 14px;
        font-size: 16px; /* Prevents zoom on iOS */
    }

    .signin-btn {
        padding: 12px 20px;
        font-size: 16px;
    }

    .social-buttons {
        flex-direction: column;
        gap: 8px;
    }

    .social-btn {
        width: 100%;
        justify-content: flex-start;
        padding: 12px 14px;
    }

    .team-login-btn {
        width: 100%;
        justify-content: flex-start;
        padding: 12px 14px;
    }
}

@media (max-width: 480px) {
    body {
        padding: 12px;
    }

    .login-container {
        padding: 28px 20px;
        margin: 8px;
    }

    .brand-name {
        font-size: 22px;
    }

    .brand-tagline {
        font-size: 13px;
    }

    .logo-icon {
        width: 44px;
        height: 44px;
        font-size: 18px;
        margin-right: 10px;
    }

    .logo-image {
        width: 100%;
        height: 100%;
    }

    .form-input {
        padding: 10px 12px;
        font-size: 16px;
    }

    .signin-btn {
        padding: 10px 18px;
        font-size: 16px;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-options {
        margin-bottom: 20px;
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

    .logo-icon {
        width: 40px;
        height: 40px;
        font-size: 16px;
        margin-right: 8px;
    }

    .logo-image {
        width: 100%;
        height: 100%;
    }

    .brand-name {
        font-size: 20px;
    }

    .brand-tagline {
        font-size: 12px;
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
