<!-- Clean Chatwiser Login Page -->
<div class="login-container">
  <!-- Logo Section -->
  <div class="logo-section">
    <div class="logo-only">
      <img src="<?php echo base_url(); ?>assets/img/favicon.png" alt="<?php echo $this->config->item('product_name');?>" class="logo-image">
    </div>
  </div>

  <!-- Brand Section -->
  <div class="brand-section">
    <h1 class="brand-title"><?php echo $this->lang->line("welcome_back_power_user"); ?></h1>
    <p class="brand-subtitle"><?php echo $this->lang->line("access_your_automation_hub"); ?></p>
    <div class="social-proof-badge">
      <i class="lni lni-shield"></i>
      <span><?php echo $this->lang->line("already_growing_with_us"); ?></span>
    </div>
  </div>

  <!-- Login Form -->
  <form method="POST" action="<?php echo $is_exist_team_member_addon && $is_team_login=='1' ? base_url('home/login/1') : base_url('home/login'); ?>" class="login-form">
    <input type="hidden" name="csrf_token" id="csrf_token" value="<?php echo $this->session->userdata('csrf_token_session'); ?>">
    
    <!-- Alert Messages -->
    <?php
      if($this->session->userdata('login_msg')!='')
      {
          echo "<div class='alert alert-danger'>";
              echo $this->session->userdata('login_msg');
          echo "</div>";
          $this->session->unset_userdata('login_msg');
      }
      if($this->session->flashdata('reset_success')!='')
      {
          echo "<div class='alert alert-success'>";
              echo $this->session->flashdata('reset_success');
          echo "</div>";
      }
      if($this->session->userdata('reg_success') != ''){
        echo '<div class="alert alert-success">'.$this->session->userdata("reg_success").'</div>';
        $this->session->unset_userdata('reg_success');
      }
      if(form_error('username') != '' || form_error('password')!="" )
      {
        $form_error="";
        if(form_error('username') != '') $form_error.=form_error('username');
        if(form_error('password') != '') $form_error.=form_error('password');
        echo "<div class='alert alert-danger'>".$form_error."</div>";
      }

      $default_user = $default_pass ="";
    ?>

    <!-- Username Field -->
    <div class="form-group">
      <label for="username" class="form-label">
        <i class="lni lni-user"></i>
        <?php echo $is_exist_team_member_addon && $is_team_login=='1' ? $this->lang->line("Email") : $this->lang->line("Email Or FB ID"); ?>
      </label>
      <input 
        type="text" 
        id="username" 
        name="username" 
        class="form-input" 
        value="<?php echo $default_user;?>" 
        placeholder="<?php echo $this->lang->line("login_instant_access"); ?>"
        required
        autocomplete="username"
      >
    </div>

    <!-- Password Field -->
    <div class="form-group">
      <label for="password" class="form-label">
        <i class="lni lni-lock"></i>
        <?php echo $this->lang->line("Password"); ?>
      </label>
      <input 
        type="password" 
        id="password" 
        name="password" 
        class="form-input" 
        value="<?php echo $default_pass;?>" 
        placeholder="<?php echo $this->lang->line("secure_login_protected"); ?>"
        required
        autocomplete="current-password"
      >
    </div>

    <!-- Remember Device & Forgot Password -->
    <div class="form-options">
      <div class="checkbox-group">
        <input type="checkbox" id="remember" class="checkbox-input" checked>
        <label for="remember" class="checkbox-label">
          <i class="lni lni-checkmark-circle"></i>
          <?php echo $this->lang->line("remember_secure_device"); ?>
        </label>
      </div>
      <?php if(!$is_exist_team_member_addon || $is_team_login=='0'):?>
        <a href="<?php echo site_url();?>home/forgot_password" class="forgot-link">
          <i class="lni lni-key"></i>
          <?php echo $this->lang->line("forgot_password_quick"); ?>
        </a>
      <?php endif;?>
    </div>

    <!-- Sign In Button -->
    <button type="submit" class="signin-btn">
      <div class="btn-content">
        <div class="btn-spinner"></div>
        <i class="lni lni-rocket"></i>
        <span>
          <?php echo $is_exist_team_member_addon && $is_team_login=='1' ? $this->lang->line("Team Login") : $this->lang->line("signin_start_growing"); ?>
        </span>
      </div>
    </button>
  </form>

  <!-- Social Login Section -->
  <?php if($this->config->item('enable_signup_form')!='0' && ($is_team_login=='0'|| !$is_exist_team_member_addon)) : ?>
  <div class="social-login-section">
    <div class="divider">
      <span>or continue with</span>
    </div>
    
    <div class="social-buttons">
      <div class="social-btn1 google-btn">
        <?php echo str_replace("ThisIsTheLoginButtonForGoogle",$this->lang->line("Sign in with Google"), $google_login_button); ?>
      </div>
      <div class="social-btn1 facebook-btn">
        <?php echo str_replace("ThisIsTheLoginButtonForFacebook",$this->lang->line("Sign in with Facebook"), $fb_login_button); ?>
      </div>
    </div>
  </div>
  <?php endif;?>

  <!-- Team Login Section -->
  <?php if($is_team_login=='0' && $is_exist_team_member_addon):?>
  <div class="team-login-section">
    <div class="divider">
      <span>or</span>
    </div>
    
    <a href="<?php echo base_url('home/login/1'); ?>" class="team-login-btn">
      <i class="fas fa-users"></i>
      <span><?php echo $this->lang->line("Login as Team"); ?></span>
    </a>
  </div>
  <?php endif;?>

  <!-- Footer Link -->
  <div class="footer-link">
    <?php if($is_team_login=='0' || !$is_exist_team_member_addon):?>
      <?php if($this->config->item('enable_signup_form')!='0'):?>
        <p class="footer-text">
          <?php echo $this->lang->line("new_to_chatwiser"); ?> 
          <a href="<?php echo base_url('home/sign_up'); ?>" class="cta-link">
            <i class="lni lni-plus"></i>
            <?php echo $this->lang->line("create_free_account"); ?>
          </a>
        </p>
        <div class="conversion-footer">
          <i class="lni lni-users"></i>
          <span><?php echo $this->lang->line("join_successful_businesses"); ?></span>
        </div>
      <?php endif;?>
    <?php endif;?>

    <?php if($is_team_login=='1' && $is_exist_team_member_addon):?>
      <p class="footer-text">
        <a href="<?php echo base_url('home/login'); ?>"><?php echo $this->lang->line("Login as User"); ?></a>
      </p>
    <?php endif;?>
  </div>
</div>

<?php
$current_theme = $this->config->item('current_theme');
if($current_theme == '') $current_theme = 'modern';
$style_url = "application/views/site/".$current_theme."/login_style.php";
include($style_url);
?>
