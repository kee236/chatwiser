<!-- Clean Chatwiser Reset Password Page -->
<div class="login-container">
  <!-- Branding Section -->
  <div class="brand-section">
    <div class="logo-container">
      <div class="logo-icon">
        <img src="<?php echo base_url(); ?>assets/img/logo.png" alt="<?php echo $this->config->item('product_name');?>" class="logo-image">
      </div>
      <div class="brand-text">
        <h1 class="brand-name"><?php echo $this->config->item('product_name');?></h1>
        <p class="brand-tagline">Your Social Campaigns</p>
      </div>
    </div>
  </div>

  <!-- Reset Password Form -->
  <form method="POST" class="login-form">
    <div id="recovery_form">
      <p class="text-muted"><?php echo $this->lang->line("You are one step away to get back access to your account"); ?></p>
      <div class="form-group">
        <label for="code" class="form-label"><?php echo $this->lang->line("Password Reset Code"); ?></label>
        <input id="code" type="text" class="form-input" name="code" tabindex="1" required autofocus>
        <div class="invalid-feedback"><?php echo $this->lang->line("Please enter your email"); ?></div>
      </div>
      <div class="form-group">
        <label for="new_password" class="form-label"><?php echo $this->lang->line("New Password"); ?> *</label>
        <input id="new_password" type="password" class="form-input password" name="new_password">
        <div class="invalid-feedback"><?php echo $this->lang->line("You have to type new password twice"); ?></div>
      </div>
      <div class="form-group">
        <label for="new_password_confirm" class="form-label"><?php echo $this->lang->line("Confirm New Password");?> *</label>
        <input id="new_password_confirm" type="password" class="form-input password" name="new_password_confirm">
        <div class="invalid-feedback"><?php echo $this->lang->line("Passwords does not match"); ?></div>
      </div>
      <button type="submit" id="submit" class="signin-btn">
        <div class="btn-content">
          <div class="btn-spinner"></div>
          <span><i class="fas fa-key"></i> <?php echo $this->lang->line("Reset Password"); ?></span>
        </div>
      </button>
    </div>
  </form>

  <!-- Footer Link -->
  <div class="footer-link">
    <p class="footer-text">
      <a href="<?php echo base_url('home/login'); ?>">&larr; <?php echo $this->lang->line("Back to Login"); ?></a>
    </p>
  </div>
</div>

<?php
$current_theme = $this->config->item('current_theme');
if($current_theme == '') $current_theme = 'modern';
$style_url = "application/views/site/".$current_theme."/login_style.php";
include($style_url);
?>
<script src="<?php echo base_url('assets/js/system/password_recovery.js');?>"></script>

