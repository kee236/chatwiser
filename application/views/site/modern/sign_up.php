<!-- Modern Chatwiser Sign Up Page -->
<div class="signup-container">
  <!-- Logo Section -->
  <div class="logo-section">
    <div class="logo-only">
      <img src="<?php echo base_url(); ?>assets/img/favicon.png" alt="<?php echo $this->config->item('product_name');?>" class="logo-image">
    </div>
  </div>

  <!-- Header Section -->
  <div class="signup-header">
    <h1 class="signup-title"><?php echo $this->lang->line("start_growing_today"); ?></h1>
    <p class="signup-subtitle"><?php echo $this->lang->line("free_account_no_credit"); ?></p>
    <div class="trust-badge">
      <i class="lni lni-users"></i>
      <span><?php echo $this->lang->line("trusted_by_businesses"); ?></span>
    </div>
  </div>

  <!-- Alert Messages -->
  <div class="alert-section">
    <?php 
      if($this->session->userdata('reg_success') == 1) {
        echo "<div class='alert alert-success animated-alert'><i class='lni lni-checkmark-circle'></i>".$this->lang->line("An activation code has been sent to your email. please check your inbox to activate your account.")."</div>";
        $this->session->unset_userdata('reg_success');
      }                  
      if($this->session->userdata('reg_success') == 'limit_exceed') {
        echo "<div class='alert alert-danger animated-alert'><i class='lni lni-cross-circle'></i>".$this->lang->line("Signup has been disabled. Please contact system admin.")."</div>";
        $this->session->unset_userdata('reg_success');
      }
      if(form_error('name') != '' || form_error('email') != '' || form_error('confirm_password') != '' ||form_error('password')!="" ) 
      {
        $form_error="";
        if(form_error('name') != '') $form_error.=str_replace(array("<p>","</p>"), array("",""), form_error('name'))."<br>";
        if(form_error('email') != '') $form_error.=str_replace(array("<p>","</p>"), array("",""), form_error('email'))."<br>";
        if(form_error('password') != '') $form_error.=str_replace(array("<p>","</p>"), array("",""), form_error('password'))."<br>";
        if(form_error('confirm_password') != '') $form_error.=str_replace(array("<p>","</p>"), array("",""), form_error('confirm_password'))."<br>";
        echo "<div class='alert alert-danger animated-alert'><i class='lni lni-warning'></i>".$form_error."</div>";
      }  
      if(form_error('captcha')) 
      echo "<div class='alert alert-danger animated-alert'><i class='lni lni-warning'></i>".form_error('captcha')."</div>"; 
      else if($this->session->userdata("sign_up_captcha_error")!='')  
      { 
        echo "<div class='alert alert-danger animated-alert'><i class='lni lni-warning'></i>".$this->session->userdata("sign_up_captcha_error")."</div>"; 
        $this->session->unset_userdata("sign_up_captcha_error"); 
      } 
    ?>
  </div>

  <!-- Sign Up Form -->
  <form method="POST" action="<?php echo site_url('home/sign_up_action');?>" class="signup-form">
    <input type="hidden" name="csrf_token" id="csrf_token" value="<?php echo $this->session->userdata('csrf_token_session'); ?>">
    
    <!-- Form Section Title -->
    <div class="form-section-title">
      <i class="lni lni-user"></i>
      <span><?php echo $this->lang->line("your_business_details"); ?></span>
    </div>

    <!-- Name and Email Row -->
    <div class="form-row">
      <div class="form-group">
        <label for="name" class="form-label">
          <i class="lni lni-user"></i>
          <?php echo $this->lang->line("full_name_label"); ?> *
        </label>
        <input 
          id="name" 
          type="text" 
          class="form-input" 
          name="name" 
          autofocus 
          required 
          value="<?php echo set_value('name');?>"
          placeholder="<?php echo $this->lang->line("full_name_label"); ?>"
        >
      </div>
      <div class="form-group">
        <label for="email" class="form-label">
          <i class="lni lni-envelope"></i>
          <?php echo $this->lang->line("business_email_label"); ?> *
        </label>
        <input 
          id="email" 
          type="email" 
          class="form-input" 
          name="email" 
          required 
          value="<?php echo set_value('email');?>"
          placeholder="you@yourcompany.com"
        >
      </div>
    </div>

    <!-- Password Row -->
    <div class="form-row">
      <div class="form-group">
        <label for="password" class="form-label">
          <i class="lni lni-lock"></i>
          <?php echo $this->lang->line("secure_password_label"); ?> *
        </label>
        <input 
          id="password" 
          type="password" 
          class="form-input" 
          required 
          name="password" 
          value="<?php echo set_value('password');?>"
          placeholder="<?php echo $this->lang->line("secure_password_label"); ?>"
        >
      </div>
      <div class="form-group">
        <label for="password2" class="form-label">
          <i class="lni lni-lock-alt"></i>
          <?php echo $this->lang->line("confirm_password_label");?> *
        </label>
        <input 
          id="password2" 
          type="password" 
          class="form-input" 
          required 
          name="confirm_password" 
          value="<?php echo set_value('confirm_password');?>"
          placeholder="<?php echo $this->lang->line("confirm_password_label"); ?>"
        >
      </div>
    </div>

    <!-- Captcha Section -->
    <div class="captcha-section">
      <div class="form-section-title">
        <i class="lni lni-shield"></i>
        <span><?php echo $this->lang->line("verify_human_label"); ?></span>
      </div>
      
      <div class="captcha-group">
        <div class="captcha-question">
          <span class="captcha-text"><?php echo $num1. " + ". $num2." = ?";?></span>
        </div>
        <input 
          type="number" 
          class="captcha-input" 
          required 
          name="captcha" 
          placeholder="<?php echo $this->lang->line("Put your answer here"); ?>"
        >
      </div>
    </div>

    <!-- Terms Agreement -->
    <div class="terms-section">
      <div class="checkbox-group">
        <input type="checkbox" name="agree" required class="checkbox-input" id="agree">
        <label class="checkbox-label" for="agree">
          <i class="lni lni-checkmark-circle"></i>
          <a target="_BLANK" href="<?php echo site_url();?>home/terms_use" class="terms-link">
            <?php echo $this->lang->line("terms_privacy_agree");?>
          </a>
        </label>
      </div>
    </div>

    <!-- Submit Button -->
    <div class="submit-section">
      <button type="submit" class="signup-btn">
        <div class="btn-content">
          <div class="btn-spinner"></div>
          <i class="lni lni-rocket"></i>
          <span><?php echo $this->lang->line("create_account_start"); ?></span>
        </div>
      </button>
    </div>
  </form>

  <!-- Footer Section -->
  <div class="signup-footer">
    <p class="footer-text">
      <?php echo $this->lang->line("already_member"); ?> 
      <a href="<?php echo base_url('home/login_page'); ?>" class="signin-link">
        <i class="lni lni-enter"></i>
        <?php echo $this->lang->line("sign_in_here"); ?>
      </a>
    </p>
    <div class="community-footer">
      <i class="lni lni-network"></i>
      <span><?php echo $this->lang->line("join_growth_community"); ?></span>
    </div>
  </div>
</div>

<?php
$current_theme = $this->config->item('current_theme');
if($current_theme == '') $current_theme = 'modern';
$style_url = "application/views/site/".$current_theme."/signup_style.php";
include($style_url);
?>