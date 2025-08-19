<!-- Modern Chatwiser Forgot Password Page -->
<div class="forgot-container">
  <!-- Logo Section -->
  <div class="logo-section">
    <div class="logo-only">
      <img src="<?php echo base_url(); ?>assets/img/favicon.png" alt="<?php echo $this->config->item('product_name');?>" class="logo-image">
    </div>
  </div>

  <!-- Header Section -->
  <div class="forgot-header">
    <h1 class="forgot-title"><?php echo $this->lang->line("reset_password_quickly"); ?></h1>
    <p class="forgot-subtitle"><?php echo $this->lang->line("back_to_business_fast"); ?></p>
    <div class="security-badge">
      <i class="lni lni-lock"></i>
      <span><?php echo $this->lang->line("password_reset_secure"); ?></span>
    </div>
  </div>

  <!-- Reset Password Form -->
  <form method="POST" class="forgot-form">
    <div id="recovery_form">
      <!-- Form Section Title -->
      <div class="form-section-title">
        <i class="lni lni-envelope"></i>
        <span><?php echo $this->lang->line("quick_access_account"); ?></span>
      </div>

      <!-- Email Field -->
      <div class="form-group">
        <label for="email" class="form-label">
          <i class="lni lni-user"></i>
          <?php echo $this->lang->line("email_address_label"); ?> *
        </label>
        <input 
          id="email" 
          type="email" 
          class="form-input" 
          name="email" 
          tabindex="1" 
          autofocus
          placeholder="<?php echo $this->lang->line("enter_business_email"); ?>"
          required
        >
        <div class="input-help">
          <i class="lni lni-information"></i>
          <span><?php echo $this->lang->line("check_email_shortly"); ?></span>
        </div>
      </div>

      <!-- Submit Button -->
      <button type="submit" id="submit" class="forgot-btn">
        <div class="btn-content">
          <div class="btn-spinner"></div>
          <i class="lni lni-envelope"></i>
          <span><?php echo $this->lang->line("send_reset_instructions"); ?></span>
        </div>
      </button>

      <!-- Success Message Container -->
      <div id="success-message" class="success-message" style="display: none;">
        <div class="success-content">
          <i class="lni lni-checkmark-circle"></i>
          <h3><?php echo $this->lang->line("Email Sent Successfully"); ?></h3>
          <p><?php echo $this->lang->line("check_email_shortly"); ?></p>
        </div>
      </div>
    </div>
  </form>

  <!-- Help Section -->
  <div class="help-section">
    <div class="help-card">
      <i class="lni lni-support"></i>
      <div class="help-content">
        <h4><?php echo $this->lang->line("Need Help?"); ?></h4>
        <p>
          <?php echo $this->lang->line("Having trouble?"); ?> 
          <a href="mailto:<?php echo $this->config->item('institute_email'); ?>" class="support-email-link">
            <?php echo $this->lang->line("Contact our support team"); ?>
          </a>
        </p>
      </div>
    </div>
  </div>

  <!-- Footer Section -->
  <div class="forgot-footer">
    <a href="<?php echo base_url('home/login_page'); ?>" class="back-link">
      <i class="lni lni-arrow-left"></i>
      <span><?php echo $this->lang->line("back_to_login_page"); ?></span>
    </a>
  </div>
</div>

<?php
$current_theme = $this->config->item('current_theme');
if($current_theme == '') $current_theme = 'modern';
$style_url = "application/views/site/".$current_theme."/forgot_password_style.php";
include($style_url);
?>
<script src="<?php echo base_url('assets/js/system/forgot_password.js');?>"></script>

<script>
// Enhanced forgot password functionality
document.addEventListener('DOMContentLoaded', function() {
    const forgotForm = document.querySelector('.forgot-form');
    const forgotBtn = document.querySelector('.forgot-btn');
    const emailInput = document.querySelector('#email');
    const successMessage = document.querySelector('#success-message');
    const recoveryForm = document.querySelector('#recovery_form');
    
    if (forgotForm) {
        forgotForm.addEventListener('submit', function(e) {
            // Add loading state
            forgotBtn.classList.add('loading');
            
            // Validate email
            if (!validateEmail(emailInput.value)) {
                e.preventDefault();
                emailInput.classList.add('error');
                forgotBtn.classList.remove('loading');
                return false;
            }
            
            // Show success message after form submission
            setTimeout(() => {
                if (successMessage && recoveryForm) {
                    recoveryForm.style.display = 'none';
                    successMessage.style.display = 'block';
                    successMessage.classList.add('animated-show');
                }
            }, 1500);
        });
    }

    // Email validation
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Enhanced form validation
    if (emailInput) {
        emailInput.addEventListener('blur', function() {
            validateField(this);
        });

        emailInput.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                validateField(this);
            }
        });
    }

    function validateField(field) {
        const value = field.value.trim();
        
        // Remove existing validation classes
        field.classList.remove('error', 'success');
        
        if (value === '') {
            field.classList.add('error');
            return false;
        }
        
        // Email validation
        if (field.type === 'email' && value !== '') {
            if (!validateEmail(value)) {
                field.classList.add('error');
                return false;
            }
        }
        
        if (value !== '') {
            field.classList.add('success');
        }
        
        return true;
    }
});
</script>