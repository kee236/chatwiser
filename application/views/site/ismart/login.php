<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
      <div class="text-center mb-4">
        <a href="<?php echo base_url(); ?>">
          <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="<?php echo $this->config->item('product_name'); ?>" width="200">
        </a>
      </div>

      <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0 text-center">
            <i class="fas fa-sign-in-alt me-2"></i>
            <?php echo $is_team_login ? $this->lang->line("Team Login") : $this->lang->line("Login"); ?>
          </h4>
        </div>
        
        <div class="card-body">
          <?php $this->load->view('common/alert_messages'); ?>

          <form method="POST" action="<?php echo $is_team_login ? base_url('home/login/1') : base_url('home/login'); ?>" class="needs-validation" novalidate>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

            <div class="mb-3">
              <label for="username" class="form-label"><?php echo $is_team_login ? $this->lang->line("Email") : $this->lang->line("Email or Facebook ID"); ?></label>
              <input id="username" type="text" class="form-control" value="<?php echo set_value('username', $default_user); ?>" name="username" required autofocus>
              <div class="invalid-feedback"><?php echo form_error('username'); ?></div>
            </div>

            <div class="mb-3">
              <div class="d-flex justify-content-between align-items-center">
                <label for="password" class="form-label"><?php echo $this->lang->line("Password"); ?></label>
                <?php if (!$is_team_login): ?>
                  <a href="<?php echo site_url('home/forgot_password'); ?>" class="text-muted text-decoration-none">
                    <small><?php echo $this->lang->line("Forgot your password?"); ?></small>
                  </a>
                <?php endif; ?>
              </div>
              <input id="password" type="password" class="form-control" value="<?php echo set_value('password', $default_pass); ?>" name="password" required>
              <div class="invalid-feedback"><?php echo form_error('password'); ?></div>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary btn-lg login_btn">
                <i class="fa fa-sign-in-alt"></i> <?php echo $is_team_login ? $this->lang->line("Team Login") : $this->lang->line("Login"); ?>
              </button>
            </div>
          </form>

          <?php if($this->config->item('enable_signup_form') != '0' && !$is_team_login): ?>
            <div class="text-center mt-4">
              <p class="text-muted mb-2"><?php echo $this->lang->line("Or login with"); ?></p>
              <div class="row g-2">
                <div class="col-12 col-md-6 d-grid">
                  <?php echo str_replace("ThisIsTheLoginButtonForGoogle", $this->lang->line("Sign in with Google"), $google_login_button); ?>
                </div>
                <div class="col-12 col-md-6 d-grid">
                  <?php echo str_replace("ThisIsTheLoginButtonForFacebook", $this->lang->line("Sign in with Facebook"), $fb_login_button); ?>
                </div>
              </div>
            </div>
          <?php endif; ?>

          <div class="text-center mt-3">
            <?php if($this->config->item('enable_signup_form') != '0' && !$is_team_login): ?>
              <p class="text-muted mb-0">
                <?php echo $this->lang->line("Do not have an account?"); ?> 
                <a href="<?php echo base_url('home/sign_up'); ?>"><?php echo $this->lang->line("Create one"); ?></a>
              </p>
            <?php endif; ?>

            <?php if ($is_team_login): ?>
              <a href="<?php echo base_url('home/login'); ?>" class="text-muted text-decoration-none"><small><?php echo $this->lang->line("Login as User"); ?></small></a>
            <?php else: ?>
              <a href="<?php echo base_url('home/login/1'); ?>" class="text-muted text-decoration-none"><small><?php echo $this->lang->line("Login as Team"); ?></small></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
