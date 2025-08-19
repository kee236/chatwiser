<?php
// Modern Chatwiser Forgot Password Page Styles - Updated with New Branding
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
    width: 250px;
    height: 250px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.08);
    top: -125px;
    left: -125px;
    animation: float 22s ease-in-out infinite;
}

body::after {
    content: '';
    position: absolute;
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.06);
    bottom: -90px;
    right: -90px;
    animation: float 28s ease-in-out infinite reverse;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) translateX(0px) rotate(0deg);
        opacity: 0.08;
    }
    33% {
        transform: translateY(-35px) translateX(25px) rotate(120deg);
        opacity: 0.15;
    }
    66% {
        transform: translateY(25px) translateX(-18px) rotate(240deg);
        opacity: 0.12;
    }
}

/* Main Forgot Password Container */
.forgot-container {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 24px;
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(255, 255, 255, 0.1);
    padding: 40px;
    width: 100%;
    max-width: 600px;
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

.forgot-container::before {
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
    margin-bottom: 24px;
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
.forgot-header {
    text-align: center;
    margin-bottom: 32px;
}

.forgot-title {
    font-size: 30px;
    font-weight: 700;
    color: #120132;
    margin: 0 0 12px 0;
    background: linear-gradient(45deg, #052CFF, #0ADCC7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: textShimmer 2s ease-in-out infinite alternate;
}

.forgot-subtitle {
    font-size: 16px;
    color: #666;
    font-weight: 400;
    margin: 0 0 20px 0;
    opacity: 0.9;
}

.security-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(5, 44, 255, 0.1);
    color: #052CFF;
    padding: 10px 20px;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 500;
    border: 1px solid rgba(5, 44, 255, 0.2);
}

.security-badge i {
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

/* Form Styling */
.forgot-form {
    margin-bottom: 32px;
}

.form-section-title {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 16px;
    font-weight: 600;
    color: #120132;
    margin-bottom: 24px;
    padding-bottom: 8px;
    border-bottom: 2px solid rgba(5, 44, 255, 0.1);
}

.form-section-title i {
    font-size: 18px;
    color: #052CFF;
}

.form-group {
    margin-bottom: 24px;
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
    padding: 16px 20px;
    border: 2px solid #e1e5e9;
    border-radius: 12px;
    font-size: 16px;
    font-family: inherit;
    transition: all 0.3s ease;
    background: white;
    margin-bottom: 8px;
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

.form-input.error {
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
}

.form-input.success {
    border-color: #059669;
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
}

.input-help {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #666;
    margin-top: 4px;
}

.input-help i {
    font-size: 14px;
    color: #0ADCC7;
}

/* Submit Button */
.forgot-btn {
    width: 100%;
    padding: 16px 24px;
    background: linear-gradient(45deg, #052CFF, #0ADCC7);
    border: none;
    border-radius: 12px;
    color: white;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: inherit;
    position: relative;
    overflow: hidden;
    margin-bottom: 24px;
}

.forgot-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(5, 44, 255, 0.3);
}

.forgot-btn:active {
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
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.forgot-btn.loading {
    pointer-events: none;
    opacity: 0.8;
}

.forgot-btn.loading .btn-spinner {
    display: block;
}

/* Success Message */
.success-message {
    text-align: center;
    padding: 32px 24px;
    background: rgba(34, 197, 94, 0.1);
    border: 2px solid rgba(34, 197, 94, 0.2);
    border-radius: 16px;
    margin-bottom: 24px;
    animation: slideInUp 0.5s ease-out;
}

.success-message.animated-show {
    animation: slideInUp 0.5s ease-out;
}

.success-content i {
    font-size: 48px;
    color: #059669;
    margin-bottom: 16px;
    display: block;
}

.success-content h3 {
    font-size: 20px;
    font-weight: 600;
    color: #120132;
    margin-bottom: 8px;
}

.success-content p {
    font-size: 14px;
    color: #666;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Help Section */
.help-section {
    margin-bottom: 32px;
}

.help-card {
    display: flex;
    align-items: center;
    gap: 16px;
    background: rgba(10, 220, 199, 0.1);
    border: 1px solid rgba(10, 220, 199, 0.2);
    border-radius: 12px;
    padding: 20px;
    transition: all 0.3s ease;
}

.help-card:hover {
    background: rgba(10, 220, 199, 0.15);
    transform: translateY(-1px);
}

.help-card i {
    font-size: 24px;
    color: #0ADCC7;
    flex-shrink: 0;
}

.help-content h4 {
    font-size: 16px;
    font-weight: 600;
    color: #120132;
    margin-bottom: 4px;
}

.help-content p {
    font-size: 14px;
    color: #666;
    margin: 0;
}

.support-email-link {
    color: #052CFF;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.support-email-link:hover {
    color: #0ADCC7;
    text-decoration: underline;
}

/* Footer Section */
.forgot-footer {
    text-align: center;
    padding-top: 24px;
    border-top: 1px solid #e1e5e9;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #052CFF;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    background: rgba(5, 44, 255, 0.1);
    padding: 10px 20px;
    border-radius: 10px;
    border: 1px solid rgba(5, 44, 255, 0.2);
    transition: all 0.3s ease;
}

.back-link:hover {
    color: #0ADCC7;
    background: rgba(5, 44, 255, 0.15);
    transform: translateY(-1px);
}

.back-link i {
    font-size: 14px;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .forgot-container {
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

    .forgot-container {
        padding: 32px 24px;
        max-width: 100%;
        border-radius: 20px;
        margin: 0 auto;
    }

    .forgot-title {
        font-size: 24px;
        line-height: 1.2;
    }

    .forgot-subtitle {
        font-size: 15px;
        line-height: 1.4;
    }

    .security-badge {
        font-size: 13px;
        padding: 8px 16px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .form-input {
        padding: 14px 16px;
        font-size: 16px; /* Prevents zoom on iOS */
        min-height: 48px;
    }

    .forgot-btn {
        padding: 14px 20px;
        font-size: 16px;
        min-height: 52px;
    }

    .logo-image {
        width: 45px;
        height: 45px;
    }

    .help-card {
        flex-direction: column;
        text-align: center;
        gap: 12px;
        padding: 16px;
    }

    .success-message {
        padding: 24px 20px;
        margin-bottom: 20px;
    }

    .success-content i {
        font-size: 40px;
    }

    .back-link {
        font-size: 13px;
        padding: 8px 16px;
    }
}

@media (max-width: 480px) {
    body {
        padding: 12px;
        padding-top: 20px;
    }

    .forgot-container {
        padding: 24px 20px;
        margin: 0;
        border-radius: 16px;
        min-height: auto;
    }

    .forgot-title {
        font-size: 20px;
        line-height: 1.3;
    }

    .forgot-subtitle {
        font-size: 13px;
        line-height: 1.4;
    }

    .security-badge {
        font-size: 11px;
        padding: 6px 12px;
        flex-direction: column;
        gap: 4px;
        text-align: center;
    }

    .form-input {
        padding: 12px 14px;
        font-size: 16px;
        min-height: 48px;
        border-radius: 8px;
    }

    .forgot-btn {
        padding: 12px 18px;
        font-size: 16px;
        min-height: 48px;
        border-radius: 8px;
    }

    .logo-image {
        width: 40px;
        height: 40px;
    }

    .success-content i {
        font-size: 36px;
        margin-bottom: 12px;
    }

    .success-content h3 {
        font-size: 18px;
        margin-bottom: 6px;
    }

    .success-content p {
        font-size: 13px;
    }

    .form-section-title {
        font-size: 15px;
        margin-bottom: 16px;
    }

    .input-help {
        font-size: 12px;
    }

    .help-card {
        padding: 16px 12px;
    }

    .help-content h4 {
        font-size: 15px;
    }

    .help-content p {
        font-size: 13px;
    }

    .back-link {
        font-size: 12px;
        padding: 8px 12px;
        min-height: 40px;
    }
}

/* Landscape orientation on mobile */
@media (max-width: 768px) and (orientation: landscape) {
    body {
        padding: 8px;
    }

    .forgot-container {
        padding: 24px 20px;
        margin: 4px;
    }

    .forgot-header {
        margin-bottom: 20px;
    }

    .logo-image {
        width: 35px;
        height: 35px;
    }

    .forgot-title {
        font-size: 20px;
    }

    .forgot-subtitle {
        font-size: 13px;
    }
}

/* Touch device optimizations */
@media (hover: none) and (pointer: coarse) {
    .forgot-btn:hover {
        transform: none;
        box-shadow: 0 12px 30px rgba(5, 44, 255, 0.3);
    }

    .back-link:hover {
        transform: none;
    }

    .help-card:hover {
        transform: none;
    }

    .logo-image:hover {
        transform: none;
    }

    /* Increase touch targets */
    .forgot-btn {
        min-height: 52px;
    }

    .form-input {
        min-height: 48px;
    }

    .back-link {
        min-height: 44px;
    }
}

/* Accessibility */
.form-input:focus-visible {
    outline: 2px solid #052CFF;
    outline-offset: 2px;
}

.forgot-btn:focus-visible {
    outline: 2px solid #052CFF;
    outline-offset: 2px;
}

.back-link:focus-visible {
    outline: 2px solid #052CFF;
    outline-offset: 2px;
    border-radius: 4px;
}

/* Loading animation enhancements */
.forgot-btn.loading {
    background: linear-gradient(45deg, #8b9dc3, #7fb8b3);
}

.forgot-btn.loading .btn-content span {
    opacity: 0.7;
}

/* Form validation feedback */
.form-input.error + .input-help {
    color: #dc2626;
}

.form-input.success + .input-help {
    color: #059669;
}

/* Enhanced animations */
.forgot-container {
    animation: slideUp 0.8s ease-out, glow 2s ease-in-out infinite alternate;
}

@keyframes glow {
    0% {
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(255, 255, 255, 0.1);
    }
    100% {
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(255, 255, 255, 0.1), 0 0 20px rgba(5, 44, 255, 0.1);
    }
}
</style>
