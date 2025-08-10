<!-- Clean Chatwiser Forgot Password Page -->
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

  <!-- Forgot Password Form -->
  <form method="POST" class="login-form">
    <div id="recovery_form">
      <p class="text-muted"><?php echo $this->lang->line("We will send you a email containing steps to reset password"); ?></p>
      <div class="form-group">
        <label for="email" class="form-label"><?php echo $this->lang->line("email"); ?> *</label>
        <input id="email" type="email" class="form-input" name="email" tabindex="1" autofocus>
        <div class="invalid-feedback"><?php echo $this->lang->line("Please enter your email"); ?></div>
      </div>
      <button type="submit" id="submit" class="signin-btn">
        <div class="btn-content">
          <div class="btn-spinner"></div>
          <span><i class="far fa-paper-plane"></i> <?php echo $this->lang->line("Send Reset Link"); ?></span>
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
<script src="<?php echo base_url('assets/js/system/forgot_password.js');?>"></script>
