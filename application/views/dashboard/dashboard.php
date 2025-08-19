<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<?php 
$user_id_url = $this->uri->segment(3);
if(empty($user_id_url)) $user_id_url = 0;

$month_name_array = array(
	'01' => 'January',
	'02' => 'February',
	'03' => 'March',
	'04' => 'April',
	'05' => 'May',
	'06' => 'June',
	'07' => 'July',
	'08' => 'August',
	'09' => 'September',
	'10' => 'October',
	'11' => 'November',
	'12' => 'December'
);
?>


<section class="section">
    <?php 
    if($other_dashboard=='1')
    { ?>
      <div class="section-header chatwiser-header">
        <div class="header-content">
          <div class="header-main">
            <div class="header-icon">
              <i class="fas fa-user-tie"></i>
            </div>
            <div class="header-text">
              <h1 class="header-title">
                <?php echo $this->lang->line('Client Dashboard'); ?>
                <span class="header-badge"><?php echo $this->lang->line("Pro"); ?></span>
              </h1>
              <p class="header-subtitle">
                <?php echo $user_name; ?> • <?php echo $user_email; ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    <?php 
    } else {
    ?>
      <div class="section-header chatwiser-header">
        <div class="header-content">
          <div class="header-main">
            <div class="header-icon">
              <i class="fas fa-rocket"></i>
            </div>
            <div class="header-text">
              <h1 class="header-title">
                Welcome back, <?php echo $this->session->userdata('username'); ?>!
                <span class="header-wave">👋</span>
              </h1>
              <p class="header-subtitle">
                <?php echo $this->config->item('slogan'); ?> 
                <div class="header-quick-stats d-block d-md-none">
                <span id="current-date"><?php echo date('l, F j, Y'); ?></span> 
                <span class="quick-stat">
                  <i class="fas fa-clock text-primary"></i>
                  <span id="mobile-time"><?php echo date('g:i:s A'); ?></span>
                </span>
              </div>
              </p>
              
            </div>
          </div>
        </div>
      </div>
    <?php 
    }
   ?>

  <?php if($other_dashboard == 1) : ?>
  <div class="section-body">
  <?php endif; ?>

    <div class="row statistics-box justify-content-md-center" id="dashboard_statistics">
      <div class="col-lg-4 col-md-6 col-sm-12 pr-md-1" id="total_subscribers_card">
        <div class="card card-statistic-2 border">
          <!-- Date Selector at Top -->
          <div class="card-top-header">
            <div class="card-title-section">
              <h4 class="card-title-main">
                <i class="fas fa-chart-line mr-2"></i>
                <?php echo $this->lang->line('Total Subscribers'); ?>
              </h4>
              <p class="card-description"><?php echo $this->lang->line("Audience growth across all platforms"); ?></p>
            </div>
            <div class="card-actions">
              <div class="dropdown">
                <a class="dropdown-toggle month-selector" data-toggle="dropdown" href="#" id="orders-month" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-calendar-alt mr-1"></i>
                  <?php echo $month_name_array[$month_number]; ?>
                  <i class="fas fa-chevron-down ml-1"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-sm">
                  <!-- <li class="dropdown-title"><?php echo $this->lang->line('Select Month'); ?></li> -->
                  <li><a href="#" class="dropdown-item month_change <?php if($month_number == '01') echo 'active'; ?>" month_no="01"><?php echo $this->lang->line('January');?></a></li>
                  <li><a href="#" class="dropdown-item month_change <?php if($month_number == '02') echo 'active'; ?>" month_no="02"><?php echo $this->lang->line('February');?></a></li>
                  <li><a href="#" class="dropdown-item month_change <?php if($month_number == '03') echo 'active'; ?>" month_no="03"><?php echo $this->lang->line('March');?></a></li>
                  <li><a href="#" class="dropdown-item month_change <?php if($month_number == '04') echo 'active'; ?>" month_no="04"><?php echo $this->lang->line('April');?></a></li>
                  <li><a href="#" class="dropdown-item month_change <?php if($month_number == '05') echo 'active'; ?>" month_no="05"><?php echo $this->lang->line('May');?></a></li>
                  <li><a href="#" class="dropdown-item month_change <?php if($month_number == '06') echo 'active'; ?>" month_no="06"><?php echo $this->lang->line('June');?></a></li>
                  <li><a href="#" class="dropdown-item month_change <?php if($month_number == '07') echo 'active'; ?>" month_no="07"><?php echo $this->lang->line('July');?></a></li>
                  <li><a href="#" class="dropdown-item month_change <?php if($month_number == '08') echo 'active'; ?>" month_no="08"><?php echo $this->lang->line('August');?></a></li>
                  <li><a href="#" class="dropdown-item month_change <?php if($month_number == '09') echo 'active'; ?>" month_no="09"><?php echo $this->lang->line('September');?></a></li>
                  <li><a href="#" class="dropdown-item month_change <?php if($month_number == '10') echo 'active'; ?>" month_no="10"><?php echo $this->lang->line('October');?></a></li>
                  <li><a href="#" class="dropdown-item month_change <?php if($month_number == '11') echo 'active'; ?>" month_no="11"><?php echo $this->lang->line('November');?></a></li>
                  <li><a href="#" class="dropdown-item month_change <?php if($month_number == '12') echo 'active'; ?>" month_no="12"><?php echo $this->lang->line('December');?></a></li>
                  <li><a href="#" class="dropdown-item month_change <?php if($month_number == 'year') echo 'active'; ?>" month_no="year"><?php echo $this->lang->line('This Year');?></a></li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Chart Section -->
          <div class="card-chart">
            <canvas id="subscribers_chart_1" height="130"></canvas>
          </div>

          <!-- Stats Section -->
          <div class="card-stats mb-1">
            <div class="text-center waiting hidden" id="loader"><i class="fas fa-spinner fa-spin blue text-center" style="font-size: 40px;"></i></div>
            <div class="card-stats-items month_change_middle_content">
              <div class="card-stats-item">
                <div class="card-stats-item-count text-primary gradient" id="fbsub"><?php echo custom_number_format($fbsub); ?></div>
                <div class="card-stats-item-label"><?php echo $this->lang->line('Facebook'); ?></div>
              </div>
              <div class="card-stats-item">
                <div class="card-stats-item-count text-secondary gradient" id="igsub"><?php echo custom_number_format($igsub); ?></div>
                <div class="card-stats-item-label"><?php echo $this->lang->line('Instagram'); ?></div>
              </div>
              <div class="card-stats-item">
                <div class="card-stats-item-count text-info gradient" id="esub"><?php echo custom_number_format($esub); ?></div>
                <div class="card-stats-item-label"><?php echo $this->lang->line('Ecommerce'); ?></div>
              </div>
            </div>
          </div>

          <!-- Icon -->
          <div class="card-icon shadow-primary bg-primary gradient">
            <i class="fas fa-users"></i>
          </div>

          <!-- Total Value Section -->
          <div class="card-total-section">
            <div class="total-label"><?php echo $this->lang->line("Total Subscribers"); ?></div>
            <div class="total-value text-primary gradient" id="total_subscribers"><?php echo custom_number_format($total_sub); ?></div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12 pl-md-1 pr-md-1" id="bot_enabled_card">
        <div class="card card-statistic-2 border">
          <!-- Card Header -->
          <div class="card-top-header">
            <div class="card-title-section">
              <h4 class="card-title-main">
                <i class="fas fa-robot mr-2"></i>
                <?php echo $this->lang->line('Bot Enabled'); ?>
              </h4>
              <p class="card-description"><?php echo $this->lang->line("Automated engagement & responses"); ?></p>
              </div>
            <div class="card-actions">
              <div class="bot-status-indicator <?php echo ($number_of_bots > 0) ? 'status-active' : 'status-inactive'; ?>">
                <i class="fas fa-circle <?php echo ($number_of_bots > 0) ? 'text-success' : 'text-danger'; ?>"></i>
                <span class="status-text">
                  <?php echo custom_number_format($number_of_bots); ?> 
                  <?php echo ($number_of_bots > 0) ? $this->lang->line('Active') : $this->lang->line('Inactive'); ?>
                </span>
              </div>
              </div>
            </div>

          <!-- Bot Analytics Section -->
          <div class="bot-analytics-section">
            <div class="analytics-grid">
              <div class="analytics-item" title="<?php echo $this->lang->line('Comment Reply Campaign Enabled'); ?>" data-toggle="tooltip">
                <div class="analytics-value"><?php echo custom_number_format($number_of_auto_comment_reply_campaign);?></div>
                <div class="analytics-label"><?php echo $this->lang->line("Campaigns"); ?></div>
                <div class="analytics-icon">
                  <i class="fas fa-comments"></i>
                    </div>
                  </div>
              <div class="analytics-item" title="<?php echo $this->lang->line('FB - Comment Replied (Last 24 Hours)'); ?>" data-toggle="tooltip">
                <div class="analytics-value"><?php echo custom_number_format($number_of_auto_comment_report_fb);?></div>
                <div class="analytics-label"><?php echo $this->lang->line("FB Replies"); ?></div>
                <div class="analytics-icon">
                  <i class="fab fa-facebook"></i>
                </div>
              </div>
              <div class="analytics-item" title="<?php echo $this->lang->line('IG - Comment Replied (Last 24 Hours)'); ?>" data-toggle="tooltip">
                <div class="analytics-value"><?php echo custom_number_format($number_of_auto_comment_report_ig);?></div>
                <div class="analytics-label"><?php echo $this->lang->line("IG Replies"); ?></div>
                <div class="analytics-icon">
                  <i class="fab fa-instagram"></i>
              </div>
              </div>
            </div>
          </div>

          <!-- Performance Indicator -->
          <div class="bot-performance-section">
            <div class="performance-bar">
              <div class="performance-fill" style="width: 100%"></div>
            </div>
            <div class="performance-label"><?php echo $this->lang->line("Bot Performance"); ?></div>
        </div>

             <!-- Card Icon -->
             <div class="card-icon shadow-secondary bg-secondary gradient">
            <i class="fas fa-robot"></i>
      </div>
          <!-- Connected Platforms -->
          <div class="card-stats mb-1">
            <div class="card-stats-items">
              <div class="card-stats-item">
                <div class="card-stats-item-count text-primary gradient"><?php echo custom_number_format($total_pages); ?></div>
                <div class="card-stats-item-label"><?php echo $this->lang->line('Page'); ?></div>
              </div>
              <div class="card-stats-item">
                <div class="card-stats-item-count text-secondary gradient"><?php echo custom_number_format($total_ig_account); ?></div>
                <div class="card-stats-item-label"><?php echo $this->lang->line('Instagram'); ?></div>
              </div>
              <div class="card-stats-item">
                <div class="card-stats-item-count text-info gradient"><?php echo custom_number_format($number_of_bot_flow); ?></div>
                <div class="card-stats-item-label"><?php echo $this->lang->line('Flow'); ?></div>
              </div>
            </div>
          </div>

       


          </div>

      </div>

            <div class="col-lg-4 col-md-6 col-sm-12 pl-md-1" id="ecommerce_card">
        <div class="card card-statistic-2 border">
          <!-- Card Header -->
          <div class="card-top-header">
            <div class="card-title-section">
              <h4 class="card-title-main">
                <i class="fas fa-shopping-cart mr-2"></i>
                <?php echo $this->lang->line('Total Earnings'); ?>
              </h4>
              <p class="card-description"><?php echo $this->lang->line("Revenue from ecommerce sales"); ?></p>
            </div>
            <div class="card-actions">
              <div class="dropdown">
                <a class="dropdown-toggle month-selector" data-toggle="dropdown" href="#" id="ecommerce-month" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-calendar-alt mr-1"></i>
                  <?php echo $month_name_array[$month_number]; ?>
                  <i class="fas fa-chevron-down ml-1"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-sm">
                  <!-- <li class="dropdown-title"><?php echo $this->lang->line('Select Month'); ?></li> -->
                  <li><a href="#" class="dropdown-item ecommerce_month_change <?php if($month_number == '01') echo 'active'; ?>" month_no="01"><?php echo $this->lang->line('January');?></a></li>
                  <li><a href="#" class="dropdown-item ecommerce_month_change <?php if($month_number == '02') echo 'active'; ?>" month_no="02"><?php echo $this->lang->line('February');?></a></li>
                  <li><a href="#" class="dropdown-item ecommerce_month_change <?php if($month_number == '03') echo 'active'; ?>" month_no="03"><?php echo $this->lang->line('March');?></a></li>
                  <li><a href="#" class="dropdown-item ecommerce_month_change <?php if($month_number == '04') echo 'active'; ?>" month_no="04"><?php echo $this->lang->line('April');?></a></li>
                  <li><a href="#" class="dropdown-item ecommerce_month_change <?php if($month_number == '05') echo 'active'; ?>" month_no="05"><?php echo $this->lang->line('May');?></a></li>
                  <li><a href="#" class="dropdown-item ecommerce_month_change <?php if($month_number == '06') echo 'active'; ?>" month_no="06"><?php echo $this->lang->line('June');?></a></li>
                  <li><a href="#" class="dropdown-item ecommerce_month_change <?php if($month_number == '07') echo 'active'; ?>" month_no="07"><?php echo $this->lang->line('July');?></a></li>
                  <li><a href="#" class="dropdown-item ecommerce_month_change <?php if($month_number == '08') echo 'active'; ?>" month_no="08"><?php echo $this->lang->line('August');?></a></li>
                  <li><a href="#" class="dropdown-item ecommerce_month_change <?php if($month_number == '09') echo 'active'; ?>" month_no="09"><?php echo $this->lang->line('September');?></a></li>
                  <li><a href="#" class="dropdown-item ecommerce_month_change <?php if($month_number == '10') echo 'active'; ?>" month_no="10"><?php echo $this->lang->line('October');?></a></li>
                  <li><a href="#" class="dropdown-item ecommerce_month_change <?php if($month_number == '11') echo 'active'; ?>" month_no="11"><?php echo $this->lang->line('November');?></a></li>
                  <li><a href="#" class="dropdown-item ecommerce_month_change <?php if($month_number == '12') echo 'active'; ?>" month_no="12"><?php echo $this->lang->line('December');?></a></li>
                  <li><a href="#" class="dropdown-item ecommerce_month_change <?php if($month_number == 'year') echo 'active'; ?>" month_no="year"><?php echo $this->lang->line('This Year');?></a></li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Chart Section -->
          <div class="card-chart">
            <canvas id="ecommerce_chart_1" height="130"></canvas>
                  </div>

          <!-- Sales Analytics Section -->
          <div class="ecommerce-analytics-section">
            <div class="text-center waiting hidden" id="e_loader"><i class="fas fa-spinner fa-spin blue text-center" style="font-size: 40px;"></i></div>
            <div class="analytics-grid ecommerce_month_change_middle_content">
              <div class="analytics-item">
                <div class="analytics-value" id="order_block"><?php echo custom_number_format($total_orders); ?></div>
                <div class="analytics-label"><?php echo $this->lang->line('Orders'); ?></div>
                <div class="analytics-icon">
                  <i class="fas fa-shopping-bag"></i>
                </div> 
            </div>
              <div class="analytics-item">
                <div class="analytics-value" id="recovered_block"><?php echo custom_number_format($summary_recovered_cart); ?></div>
                <div class="analytics-label"><?php echo $this->lang->line('Pending'); ?></div>
                <div class="analytics-icon">
                  <i class="fas fa-clock"></i>
            </div>
              </div>
              <div class="analytics-item">
                <div class="analytics-value" id="checkout_block"><?php echo custom_number_format($summary_checkout_cart); ?></div>
                <div class="analytics-label"><?php echo $this->lang->line('Checkout'); ?></div>
                <div class="analytics-icon">
                  <i class="fas fa-check-circle"></i>
          </div>
        </div>
      </div>
    </div>
  
          <!-- Card Icon -->
          <div class="card-icon shadow-warning bg-warning gradient">
            <i class="fas fa-dollar-sign"></i>
          </div>

          <!-- Total Earnings Section -->
          <div class="card-total-section">
            <div class="total-label"><?php echo $this->lang->line("Total Revenue"); ?></div>
            <div class="total-value text-warning gradient" id="total_earning"><?php echo custom_number_format($summary_earning); ?></div>
          </div>
        </div>
      </div>
    </div>
  


    <div class="row" id="subscriber_gain_card">
      <div class="col-12">
        <div class="card mb-2 subscriber-gain-card">
          <!-- Enhanced Card Header -->
          <div class="card-header subscriber-gain-header">
            <div class="header-main-content">
              <div class="header-icon-wrapper">
                <i class="fas fa-chart-line" style="color: #000 !important;"></i>
          </div>
              <div class="header-text-content">
                <h4 class="card-title-enhanced">
                  <span class="title-text"><?php echo $this->lang->line("Messenger Subscriber Gain - 12 Months") ?></span>
                  <span class="title-badge"><?php echo $this->lang->line("Analytics"); ?></span>
                </h4>
                <p class="card-subtitle"><?php echo $this->lang->line("Track your audience growth across all channels over time"); ?></p>
              </div>
            </div>
            <div class="header-actions">
              <div class="time-range-indicator">
                <i class="fas fa-calendar-check mr-1"></i>
                <span><?php echo $this->lang->line("Last 12 Months"); ?></span>
              </div>
            </div>
          </div>

          <!-- Enhanced Card Body -->
          <div class="card-body subscriber-gain-body">
            <div class="row">
              <!-- Chart Section -->
              <div class="col-12 col-lg-8">
                <div class="chart-container">
              <canvas id="subscribers_stats" height="120"></canvas>
                </div>
              </div>
              
              <!-- Statistics Panel -->
              <div class="col-12 col-lg-4">
                <div class="statistics-panel">
                  <div class="panel-header">
                    <h5 class="panel-title">
                      <i class="fas fa-analytics mr-2"></i>
                      <?php echo $this->lang->line("Growth Summary"); ?>
                    </h5>
                    <p class="panel-subtitle"><?php echo $this->lang->line("Total gains across all channels"); ?></p>
              </div>
                  
                  <div class="statistics-grid">
                    <div class="statistic-item subscriber-stat">
                      <div class="stat-icon">
                        <i class="fas fa-users"></i>
                      </div>
                      <div class="stat-content">
                        <div class="stat-value text-primary gradient">
                      <?php 
                        if($subscribers_gain >= 1000) {
                               echo number_format($subscribers_gain/1000, 1) . "K";
                        }
                        else {
                                echo custom_number_format($subscribers_gain);
                        }
                      ?>
                    </div>
                        <div class="stat-label"><?php echo $this->lang->line("Subscriber Gain"); ?></div>
                        <div class="stat-progress">
                          <div class="progress-bar bg-primary" style="width: 100%"></div>
                  </div>
                      </div>
                    </div>
                    
                    <div class="statistic-item email-stat">
                      <div class="stat-icon">
                        <i class="fas fa-envelope"></i>
                      </div>
                      <div class="stat-content">
                        <div class="stat-value text-success gradient">
                      <?php 
                        if($email_gain >= 1000) {
                               echo number_format($email_gain/1000, 1) . "K";
                        }
                        else {
                                echo custom_number_format($email_gain);
                        }
                      ?>
                    </div>
                        <div class="stat-label"><?php echo $this->lang->line("Email Gain"); ?></div>
                        <div class="stat-progress">
                          <div class="progress-bar bg-success" style="width: <?php echo ($email_gain > 0 && $subscribers_gain > 0) ? min(100, ($email_gain/$subscribers_gain)*100) : 0; ?>%"></div>
                  </div>
                      </div>
                    </div>
                    
                    <div class="statistic-item phone-stat">
                      <div class="stat-icon">
                        <i class="fas fa-phone"></i>
                      </div>
                      <div class="stat-content">
                        <div class="stat-value text-info gradient">
                      <?php 
                        if($phone_gain >= 1000) {
                               echo number_format($phone_gain/1000, 1) . "K";
                        }
                        else {
                                echo custom_number_format($phone_gain);
                        }
                      ?>
                    </div>
                        <div class="stat-label"><?php echo $this->lang->line("Phone Number Gain"); ?></div>
                        <div class="stat-progress">
                          <div class="progress-bar bg-info" style="width: <?php echo ($phone_gain > 0 && $subscribers_gain > 0) ? min(100, ($phone_gain/$subscribers_gain)*100) : 0; ?>%"></div>
                  </div>
                </div>
              </div>
            </div>

                  <!-- Summary Footer -->
                  <div class="panel-footer">
                    <div class="total-summary">
                      <span class="summary-label"><?php echo $this->lang->line("Total Growth"); ?></span>
                      <span class="summary-value">
                        <?php echo custom_number_format($subscribers_gain + $email_gain + $phone_gain); ?>
                      </span>
          </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php if(!empty($latest_subscriber_list)) : ?>
      <div class="col-12" id="latest_subscriber_list">
        <div class="card latest-subscribers-card d-none">
          <!-- Enhanced Card Header -->
          <div class="card-header latest-subscribers-header">
            <div class="header-main-content">
              <div class="header-icon-wrapper">
                <i class="fas fa-user-plus"></i>
              </div>
              <div class="header-text-content">
                <h4 class="card-title-enhanced">
                  <span class="title-text"><?php echo $this->lang->line("Latest Subscribers"); ?></span>
                  <span class="title-badge"><?php echo $this->lang->line("New Members"); ?></span>
                </h4>
                <p class="card-subtitle">Welcome your newest community members and track recent growth</p>
                </div>
              </div>
            <div class="header-actions">
              <div class="subscriber-count-indicator">
                <i class="fas fa-users mr-1"></i>
                <span><?php echo count($latest_subscriber_list); ?> new today</span>
              </div>
              <div class="view-all-action">
                <a href="#" class="btn view-all-btn">
                  <i class="fas fa-eye mr-1"></i>
                  <span><?php echo $this->lang->line("View All"); ?></span>
                </a>
              </div>
            </div>
          </div>

          <!-- Enhanced Card Body -->
          <div class="card-body latest-subscribers-body">
            <div class="subscribers-container">
              <div class="subscribers-toolbar">
                <div class="toolbar-info">
                  <div class="growth-indicator">
                    <i class="fas fa-chart-line mr-2"></i>
                    <span class="growth-text">Recent Growth</span>
                    <span class="growth-badge positive">+<?php echo count($latest_subscriber_list); ?></span>
                  </div>
                </div>
                <div class="toolbar-actions">
                  <div class="filter-options">
                    <div class="filter-item active" data-filter="all">
                      <i class="fas fa-users mr-1"></i>
                      <span><?php echo $this->lang->line("All"); ?></span>
                    </div>
                    <div class="filter-item" data-filter="facebook">
                      <i class="fab fa-facebook mr-1"></i>
                      <span>Facebook</span>
                    </div>
                    <div class="filter-item" data-filter="instagram">
                      <i class="fab fa-instagram mr-1"></i>
                      <span>Instagram</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="subscribers-carousel-wrapper">
                <div class="subscribers-carousel owl-carousel owl-theme" id="latest-subscribers-carousel">
                  <?php foreach($latest_subscriber_list as $index => $value) : ?>
                  <div class="subscriber-item-wrapper">
                    <div class="subscriber-item">
                      <div class="subscriber-badge">
                        <i class="fas fa-star"></i>
                        <span class="badge-text">New</span>
                      </div>
                      
                      <div class="subscriber-avatar">
                        <img alt="<?php echo ($value['full_name'] != '') ? $value['full_name'] : $value['first_name'].' '.$value['last_name']; ?>" 
                             src="<?php echo $value['image_path']; ?>" 
                             class="avatar-image">
                        <div class="avatar-status online"></div>
                      </div>
                      
                      <div class="subscriber-info">
                        <div class="subscriber-name">
                          <?php echo ($value['full_name'] != '') ? $value['full_name'] : $value['first_name'].' '.$value['last_name']; ?>
                        </div>
                        <div class="subscriber-page">
                          <a href="https://facebook.com/<?php echo $value['page_id']; ?>" target="_BLANK" class="page-link">
                            <i class="fab fa-facebook mr-1"></i>
                            <?php echo $value['page_name']; ?>
                          </a>
                        </div>
                        <div class="subscriber-meta">
                          <div class="join-date">
                            <i class="fas fa-calendar-plus mr-1"></i>
                            <span><?php echo $value['subscribed_at']; ?></span>
                          </div>
                          <div class="subscriber-id">
                            <i class="fas fa-hashtag mr-1"></i>
                            <span><?php echo substr($value['subscriber_id'], -6); ?></span>
                          </div>
                        </div>
                      </div>
                      
                      <div class="subscriber-actions">
                        <button class="action-btn message-btn" title="Send Message">
                          <i class="fas fa-comment"></i>
                        </button>
                        <button class="action-btn profile-btn" title="View Profile">
                          <i class="fas fa-user"></i>
                        </button>
                        <button class="action-btn more-btn" title="More Options">
                          <i class="fas fa-ellipsis-v"></i>
                        </button>
                      </div>
            </div>
          </div>
          <?php endforeach; ?>
                </div>
                
                <div class="carousel-navigation">
                  <button class="nav-btn prev-btn">
                    <i class="fas fa-chevron-left"></i>
                  </button>
                  <button class="nav-btn next-btn">
                    <i class="fas fa-chevron-right"></i>
                  </button>
                </div>
              </div>
              
              <div class="subscribers-summary">
                <div class="summary-stats">
                  <div class="summary-item">
                    <div class="summary-icon">
                      <i class="fas fa-user-check"></i>
                    </div>
                    <div class="summary-content">
                      <div class="summary-value"><?php echo count($latest_subscriber_list); ?></div>
                      <div class="summary-label"><?php echo $this->lang->line("New Today"); ?></div>
                    </div>
                  </div>
                  <div class="summary-item">
                    <div class="summary-icon">
                      <i class="fas fa-clock"></i>
                    </div>
                    <div class="summary-content">
                      <div class="summary-value">24h</div>
                      <div class="summary-label">Time Range</div>
                    </div>
                  </div>
                  <div class="summary-item">
                    <div class="summary-icon">
                      <i class="fas fa-chart-trend-up"></i>
                    </div>
                    <div class="summary-content">
                      <div class="summary-value">+15%</div>
                      <div class="summary-label">Growth</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
    </div>


    <div class="row" id="subscriber_source_card">
      <div class="col-12">
        <div class="card mb-2 subscriber-source-card">
          <!-- Enhanced Card Header -->
          <div class="card-header subscriber-source-header">
            <div class="header-main-content">
              <div class="header-icon-wrapper">
                <i class="fas fa-share-alt"></i>
          </div>
              <div class="header-text-content">
                <h4 class="card-title-enhanced">
                  <span class="title-text"><?php echo $this->lang->line('Subscribers from Different Sources - 12 Months'); ?></span>
                  <span class="title-badge"><?php echo $this->lang->line("Sources"); ?></span>
                </h4>
                <p class="card-subtitle">Analyze subscriber acquisition channels and conversion paths</p>
              </div>
            </div>
            <div class="header-actions">
              <div class="total-sources-indicator">
                <i class="fas fa-chart-pie mr-1"></i>
                <span>6 Sources</span>
              </div>
            </div>
          </div>

          <!-- Enhanced Card Body -->
          <div class="card-body subscriber-source-body">
            <div class="row">             
              <!-- Sources Grid Section -->
              <div class="col-12 col-lg-8">
                <div class="sources-container">
                  <div class="sources-header">
                    <h5 class="sources-title">
                      <i class="fas fa-funnel-dollar mr-2"></i>
                      Acquisition Channels
                    </h5>
                    <p class="sources-subtitle">Track where your subscribers are coming from</p>
                  </div>
                  
                  <div class="sources-grid">
                    <div class="source-item checkbox-plugin-source">
                      <div class="source-icon">
                        <img src="<?php echo base_url('assets/img/icon/checkbox.png'); ?>" alt="Checkbox Plugin" />
                        </div>
                      <div class="source-content">
                        <div class="source-title"><?php echo $refferer_source_info['checkbox_plugin']['title']; ?></div>
                        <div class="source-count">
                          <?php echo isset($refferer_source_info['checkbox_plugin']['subscribers']) ? number_format($refferer_source_info['checkbox_plugin']['subscribers']) : 0 ?>
                        </div>
                        <div class="source-label">Subscribers</div>
                        </div>
                      <div class="source-trend">
                        <i class="fas fa-arrow-up text-success"></i>
                  </div>
                        </div>

                    <div class="source-item send-to-messenger-source">
                      <div class="source-icon">
                        <img src="<?php echo base_url('assets/img/icon/send_to_messenger.png'); ?>" alt="Send to Messenger" />
                        </div>
                      <div class="source-content">
                        <div class="source-title"><?php echo $refferer_source_info['sent_to_messenger']['title']; ?></div>
                        <div class="source-count">
                          <?php echo isset($refferer_source_info['sent_to_messenger']['subscribers']) ? number_format($refferer_source_info['sent_to_messenger']['subscribers']) : 0 ?>
                        </div>
                        <div class="source-label">Subscribers</div>
                  </div>
                      <div class="source-trend">
                        <i class="fas fa-arrow-up text-success"></i>
                </div>
              </div>

                    <div class="source-item customer-chat-source">
                      <div class="source-icon">
                        <img src="<?php echo base_url('assets/img/icon/customer_chat_plugin.png'); ?>" alt="Customer Chat Plugin" />
                      </div>
                      <div class="source-content">
                        <div class="source-title"><?php echo $refferer_source_info['customer_chat_plugin']['title']; ?></div>
                        <div class="source-count">
                          <?php echo isset($refferer_source_info['customer_chat_plugin']['subscribers']) ? number_format($refferer_source_info['customer_chat_plugin']['subscribers']) : 0 ?>
                        </div>
                        <div class="source-label">Subscribers</div>
                      </div>
                      <div class="source-trend">
                        <i class="fas fa-arrow-up text-success"></i>
                </div>
              </div>
              
                    <div class="source-item direct-source">
                      <div class="source-icon">
                        <img src="<?php echo base_url('assets/img/icon/direct.png'); ?>" alt="Direct" />
            </div>
                      <div class="source-content">
                        <div class="source-title"><?php echo $refferer_source_info['direct']['title']; ?></div>
                        <div class="source-count">
                          <?php echo isset($refferer_source_info['direct']['subscribers']) ? number_format($refferer_source_info['direct']['subscribers']) : 0 ?>
          </div>
                        <div class="source-label">Subscribers</div>
        </div>
                      <div class="source-trend">
                        <i class="fas fa-arrow-up text-primary"></i>
      </div>   
    </div>

                    <div class="source-item auto-reply-source">
                      <div class="source-icon">
                        <img src="<?php echo base_url('assets/img/icon/auto_reply.png'); ?>" alt="Auto Reply" />
                      </div>
                      <div class="source-content">
                        <div class="source-title"><?php echo $refferer_source_info['comment_private_reply']['title']; ?></div>
                        <div class="source-count">
                          <?php echo isset($refferer_source_info['comment_private_reply']['subscribers']) ? number_format($refferer_source_info['comment_private_reply']['subscribers']) : 0 ?>
                        </div>
                        <div class="source-label">Subscribers</div>
                      </div>
                      <div class="source-trend">
                        <i class="fas fa-arrow-up text-info"></i>
                      </div>
                    </div>

                    <div class="source-item me-link-source">
                      <div class="source-icon">
                        <img src="<?php echo base_url('assets/img/icon/me_link.png'); ?>" alt="Me Link" />
                      </div>
                      <div class="source-content">
                        <div class="source-title"><?php echo $refferer_source_info['me_link']['title']; ?></div>
                        <div class="source-count">
                          <?php echo isset($refferer_source_info['me_link']['subscribers']) ? number_format($refferer_source_info['me_link']['subscribers']) : 0 ?>
                        </div>
                        <div class="source-label">Subscribers</div>
                      </div>
                      <div class="source-trend">
                        <i class="fas fa-minus text-warning"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Chart Section -->
              <div class="col-12 col-lg-4">
                <div class="chart-panel">
                  <div class="chart-header">
                    <h5 class="chart-title">
                      <i class="fas fa-chart-pie mr-2"></i>
                      Distribution
                    </h5>
                    <p class="chart-subtitle">Source breakdown visualization</p>
                  </div>
                  
                  <div class="chart-container">
                    <canvas id="social_network_shared_data" height="170"></canvas>
                  </div>
                  
                  <div class="chart-footer">
                    <div class="chart-summary">
                      <span class="summary-label"><?php echo $this->lang->line("Total Sources"); ?></span>
                      <span class="summary-value"><?php echo $this->lang->line("6 Active"); ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>   
    </div>

    <div class="row no-gutters mb-4 d-none">     
      <div class="col-12 col-md-4 ltr">
        <div class="card card-large-icons card-condensed gradient">
          <div class="card-icon mr-3 ml-3">
            <canvas id="fbsubscribers" height="100"></canvas>
          </div>
          <div class="card-body justify-content-center align-self-center font-weight-bold text-primary gradient"><?php echo $this->lang->line('Facebook Subscribers'); ?> (<?php echo $fsub_chart_data??0; ?>%)</div>
        </div>  
      </div>
      <div class="col-12 col-md-4 ltr">
        <div class="card card-large-icons card-condensed border-right border-left no_radius">
          <div class="card-icon  mr-3 ml-3">
            <canvas id="igsubscribers" height="100"></canvas>
          </div>
          <div class="card-body justify-content-center align-self-center font-weight-bold text-primary gradient"><?php echo $this->lang->line('Instagram Subscribers'); ?> (<?php echo $igsub_chart_data??0; ?>%)</div>
        </div>
      </div>
      <div class="col-12 col-md-4 ltr">
        <div class="card card-large-icons card-condensed">
          <div class="card-icon  mr-3 ml-3">
            <canvas id="esubscribers" height="100"></canvas>
          </div>
          <div class="card-body justify-content-center align-self-center font-weight-bold text-primary gradient"><?php echo $this->lang->line('Ecommerce Customers'); ?> (<?php echo $esub_chart_data??0; ?>%)</div>
        </div>
      </div>

      <div class="col-12">
        <div class="owl-carousel owl-theme mt-2" id="products-carousel">
          <?php foreach($latest_subscriber_list as $value) : ?>
          <div>
            <div class="product-item pb-3">
              <div class="product-image">
                <img alt="image" src="<?php echo $value['image_path']; ?>" class="img-fluid rounded-circle" style="width:80px; height: 80px;">
              </div>
              <div class="product-details">
                <div class="product-name"><?php if($value['full_name'] != '') echo $value['full_name']; else echo $value['first_name'].' '.$value['last_name']; ?></div>
                <div class="product-review">
                  <a style="cursor: pointer;" href="https://facebook.com/<?php echo $value['page_id']; ?>" target="_BLANK"><?php echo $value['page_name']; ?></a>
                </div>
                <div class="text-muted text-small"><?php echo $value['subscribed_at']; ?></div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- Enhanced Ecommerce Earning Statistics -->
    <div class="row mt-3 <?php if(empty(array_values($fb_earning_chart_values))) echo 'd-none';?>" id="ecommerce_earning_statistics">
      <div class="col-12">
        <div class="card mb-0 ecommerce-earnings-card">
          <!-- Enhanced Card Header -->
          <div class="card-header ecommerce-earnings-header">
            <div class="header-main-content">
              <div class="header-icon-wrapper">
                <i class="fas fa-chart-bar"></i>
          </div>
              <div class="header-text-content">
                <h4 class="card-title-enhanced">
                  <span class="title-text"><?php echo $this->lang->line("Ecommerce Earnings")." (".$selected_curr.") - ".$this->lang->line("30 days"); ?></span>
                  <span class="title-badge">Revenue</span>
                </h4>
                <p class="card-subtitle">Monitor sales performance, customer activities, and top-selling products</p>
              </div>
            </div>
            <div class="header-actions">
              <div class="time-period-indicator">
                <i class="fas fa-calendar-day mr-1"></i>
                <span><?php echo $this->lang->line("30 days"); ?></span>
              </div>
            </div>
          </div>

          <!-- Enhanced Card Body -->
          <div class="card-body ecommerce-earnings-body">
            <div class="row">
              <!-- Chart Section -->
              <div class="col-12 col-lg-8">
                <div class="earnings-chart-container">
                  <div class="chart-header">
                    <h5 class="chart-title">
                      <i class="fas fa-line-chart mr-2"></i>
                      Revenue Trend
                    </h5>
                    <p class="chart-subtitle">Daily earnings performance over the last 30 days</p>
                  </div>
                  <div class="chart-wrapper">
                <canvas id="myChart_ecommerce" height="180"></canvas>
              </div>
                </div>
              </div>

              <!-- Activities & Products Sidebar -->
              <div class="col-12 col-lg-4">
                <div class="sidebar-panels">
                  <!-- Customer Activities Panel -->
                  <div class="activities-panel">
                    <div class="panel-header">
                      <h5 class="panel-title">
                        <i class="fas fa-stream mr-2"></i>
                        <?php echo $this->lang->line("Recent Activities"); ?>
                      </h5>
                      <p class="panel-subtitle"><?php echo $this->lang->line("Latest customer interactions"); ?></p>
                    </div>
                    
                    <div class="activities-container">
                      <div class="activities-scroll" id="cart_activities">
                        <?php if(empty($cart_data_graph)): ?>
                          <div class="no-activity-message">
                            <i class="fas fa-shopping-cart"></i>
                            <span><?php echo $this->lang->line("No activity found"); ?></span>
                          </div>
                        <?php else: ?>
                          <ul class="activities-list">
                            <?php foreach ($cart_data_graph as $key => $value): 
                      $hook_ago = date_time_calculator($value['updated_at'],true);
                              if($value['action_type']=='add') {
                        $hook_icon ='fas fa-cart-plus';
                        $hook_color = 'text-primary';
                        $hook_activity = $this->lang->line("Item added");
                                $activity_class = 'activity-add';
                              } else if($value['action_type']=='remove') {
                        $hook_icon ='fas fa-cart-arrow-down';
                        $hook_color = 'text-danger';
                        $hook_activity = $this->lang->line("Item removed");
                                $activity_class = 'activity-remove';
                              } else {
                        $hook_icon = 'fas fa-shopping-bag';
                        $hook_color = 'text-success';
                        $currency_icon = isset($currency_icons[strtoupper($value['currency'])]) ? $currency_icons[strtoupper($value['currency'])] : '';
                                $hook_activity = $this->lang->line("Checkout").' <span class="amount">('.$currency_icon.$value['payment_amount'].')</span>';
                                $activity_class = 'activity-checkout';
                      }
                      
                      $hook_user = ($value['first_name']!='') ? $value['first_name']." ".$value['last_name'] : $value['full_name'];
                              $profile_pic = ($value['profile_pic']!="") ? $value["profile_pic"] : base_url('assets/img/avatar/avatar-1.png');
                              $image_path = ($value["image_path"]!="") ? base_url($value["image_path"]) : $profile_pic;
                            ?>
                            <li class="activity-item <?php echo $activity_class; ?> webhook_data" data-id="<?php echo $value['id']; ?>" data-toggle="tooltip" title="<?php echo $value['email']." (".$value['subscriber_id'].')'; ?>">
                              <div class="activity-avatar">
                                <img src="<?php echo $image_path; ?>" alt="<?php echo $hook_user; ?>">
                              </div>
                              <div class="activity-content">
                                <div class="activity-user">
                                  <i class="<?php echo $hook_icon.' '.$hook_color; ?>"></i>
                                  <span class="user-name"><?php echo $hook_user; ?></span>
                                </div>
                                <div class="activity-details">
                                  <span class="activity-text"><?php echo $hook_activity; ?></span>
                                  <span class="activity-time"><?php echo $hook_ago; ?></span>
                                </div>
                              </div>
                            </li>
                            <?php endforeach; ?>
                  </ul>
                        <?php endif; ?>
                </div>
              </div>
                  </div>

                  <!-- Top Products Panel -->
                  <div class="products-panel">
                    <div class="panel-header">
                      <h5 class="panel-title">
                        <i class="fas fa-crown mr-2"></i>
                        <?php echo $this->lang->line("Top Products"); ?>
                      </h5>
                      <p class="panel-subtitle"><?php echo $this->lang->line("Best selling items"); ?></p>
                    </div>
                    
                    <div class="products-container">
                      <div class="products-scroll" id="cart_recent_sales">
                        <?php if(empty($top_products)): ?>
                          <div class="no-products-message">
                            <i class="fas fa-box-open"></i>
                            <span>No products available</span>
                          </div>
                        <?php else: ?>
                          <div class="products-grid">
                            <?php foreach($top_products as $product): 
                              $thumb = (isset($product["thumbnail"]) && !empty($product["thumbnail"])) ? base_url('upload/ecommerce/'.$product["thumbnail"]) : base_url('assets/img/products/product-1.jpg');
                        if(isset($product["woocommerce_product_id"]) && !is_null($product["woocommerce_product_id"]) && isset($product["thumbnail"]) && !empty($product["thumbnail"]))
                        $thumb = $product["thumbnail"];
                    ?>
                            <div class="product-card">
                        <div class="product-image">                                  
                                <a target="_BLANK" href="<?php echo base_url('ecommerce/product/'.$product['product_id']);?>">
                                  <img src="<?php echo $thumb; ?>" alt="<?php echo $product['product_name']; ?>">
                                </a>
                        </div>
                              <div class="product-info">
                                <div class="product-name">
                                  <a target="_BLANK" href="<?php echo base_url('ecommerce/product/'.$product['product_id']);?>"><?php echo $product['product_name']; ?></a>
                                </div>
                                <div class="product-sales">
                                  <i class="fas fa-chart-line mr-1"></i>
                                  <?php echo $product["sales_count"];?> <?php echo $this->lang->line("Sales"); ?>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row dashboard_fullCalendar no-gutters mt-4" id="dashboard_fullCalendar">
      <div class="col-12">
        <div class="card dashboard-calendar-card">
          <!-- Enhanced Card Header -->
          <div class="card-header dashboard-calendar-header">
            <div class="header-main-content">
              <div class="header-icon-wrapper">
                <i class="fas fa-calendar-check"></i>
              </div>
              <div class="header-text-content">
                <h4 class="card-title-enhanced">
                  <span class="title-text"><?php echo $this->lang->line("Activity Calendar") ?></span>
                  <span class="title-badge">Schedule</span>
              </h4>
                <p class="card-subtitle">Track your daily activities, campaigns, and important events in one unified view</p>
            </div>
            </div>
            <div class="header-actions">
              <div class="calendar-actions">
                <a href="<?php echo $this->user_id==$user_id_url || $user_id_url==0 ? base_url('calendar') : base_url('calendar/user/'.$user_id_url);?>" 
                   class="btn calendar-btn" target="_BLANK">
                  <i class="fas fa-calendar-alt mr-2"></i>
                  <span><?php echo $this->lang->line("Monthly Activity");?></span>
                </a>
                <div class="view-options">
                  <div class="view-toggle" data-view="month">
                    <i class="fas fa-calendar mr-1"></i>
                    <span><?php echo $this->lang->line("Month"); ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Enhanced Card Body -->
          <div class="card-body dashboard-calendar-body">
            <div class="calendar-container">
              <div class="calendar-toolbar">
                <div class="calendar-info">
                  <div class="current-date">
                    <i class="fas fa-calendar-day mr-2"></i>
                    <span id="current-calendar-date"><?php echo date('F Y'); ?></span>
                  </div>
                  <div class="activity-count">
                    <i class="fas fa-tasks mr-1"></i>
                    <span id="activity-counter">Loading...</span>
                  </div>
                </div>
                <div class="calendar-legend">
                  <div class="legend-item">
                    <div class="legend-color campaign"></div>
                    <span>Campaigns</span>
                  </div>
                  <div class="legend-item">
                    <div class="legend-color broadcast"></div>
                    <span>Broadcasts</span>
                  </div>
                  <div class="legend-item">
                    <div class="legend-color engagement"></div>
                    <span>Engagement</span>
                  </div>
                  <div class="legend-item">
                    <div class="legend-color ecommerce"></div>
                    <span>Ecommerce</span>
                  </div>
                </div>
              </div>
              
              <div class="calendar-wrapper">
                <div id="dashboard_calendar"></div>
            </div>
              
              <div class="calendar-footer d-none">
                <div class="calendar-stats">
                  <div class="stat-item">
                    <div class="stat-icon">
                      <i class="fas fa-rocket"></i>
                    </div>
                    <div class="stat-content">
                      <div class="stat-value" id="campaigns-count">0</div>
                      <div class="stat-label"><?php echo $this->lang->line("Active Campaigns"); ?></div>
                    </div>
                  </div>
                  <div class="stat-item">
                    <div class="stat-icon">
                      <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="stat-content">
                      <div class="stat-value" id="broadcasts-count">0</div>
                      <div class="stat-label">Scheduled Broadcasts</div>
                    </div>
                  </div>
                  <div class="stat-item">
                    <div class="stat-icon">
                      <i class="fas fa-chart-pulse"></i>
                    </div>
                    <div class="stat-content">
                      <div class="stat-value" id="engagement-count">0</div>
                      <div class="stat-label">Engagement Events</div>
                    </div>
                  </div>
                  <div class="stat-item">
                    <div class="stat-icon">
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-content">
                      <div class="stat-value" id="ecommerce-count">0</div>
                      <div class="stat-label">Sales Activities</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  <?php if($other_dashboard == 1) : ?>
  </div>
  <?php endif; ?>
</section>

<script type="text/javascript">
  
  var subscribers_chart = document.getElementById("subscribers_chart_1").getContext('2d');

  var sevendays_subscriber_chart_bgcolor = subscribers_chart.createLinearGradient(0, 0, 0, 70);
  sevendays_subscriber_chart_bgcolor.addColorStop(0, 'rgba(21, 233, 255, .3)');
  sevendays_subscriber_chart_bgcolor.addColorStop(1, 'rgba(21, 151, 229, 0)');

  var subscribers_myChart = new Chart(subscribers_chart, {
    type: 'line',
    data: {
      labels: <?php echo json_encode(array_values(array_slice($last_tweleve_month, -6, 6, true)))?>,
      datasets: [{
        label: '<?php echo $this->lang->line("Subscribers");?>',
        data:  <?php echo json_encode(array_values(array_slice($total_subscribers, -6, 6, true)))?>,
        backgroundColor: 'transparent',
        borderWidth: 2.5,
        borderColor: '#0D8BF1',
        pointBorderWidth: 0,
        pointBorderColor: 'transparent',
          pointRadius: 4,
          pointBackgroundColor: '#052CFF',
          pointHoverBackgroundColor: '#0ADCC7',
          pointHoverRadius: 6,
          fill: true,
          tension: 0.4,
      }]
    },
    options: {
      layout: {
        padding: {
          bottom: -1,
          left: -1
        }
      },
      plugins: {
        datalabels: {
            display: false,
        }
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          gridLines: {
            display: false,
            drawBorder: false,
          },
          ticks: {
            beginAtZero: true,
            display: false
          }
        }],
        xAxes: [{
          gridLines: {
            drawBorder: false,
            display: false,
          },
          ticks: {
            display: false
          }
        }]
        },
        responsive: true,
        maintainAspectRatio: false,
        animation: {
          duration: 1000,
          easing: 'easeInOutQuart'
        },
        tooltips: {
          mode: 'index',
          intersect: false,
          backgroundColor: 'rgba(5, 44, 255, 0.9)',
          titleFontColor: '#fff',
          bodyFontColor: '#fff',
          borderColor: '#0ADCC7',
          borderWidth: 1,
          cornerRadius: 8,
          displayColors: false
      }
    }
  });
    
  function initializeEcommerceChart() {
    var ecommerce_chart = document.getElementById("ecommerce_chart_1");
    if (!ecommerce_chart) return;
    
    var ctx = ecommerce_chart.getContext('2d');
    var ecommerceLabels = <?php echo json_encode(isset($earning_chart_labels) && is_array($earning_chart_labels) ? array_values(array_slice($earning_chart_labels, -6, 6, true)) : []) ?: '[]'?>;
    var ecommerceData = <?php echo json_encode(isset($total_earning_chart_values) && is_array($total_earning_chart_values) ? array_values(array_slice($total_earning_chart_values, -6, 6, true)) : []) ?: '[]'?>;
    
    if (!ecommerceLabels || ecommerceLabels.length === 0 || !ecommerceData || ecommerceData.length === 0) {
      ecommerce_chart.style.display = 'none';
      ecommerce_chart.parentElement.innerHTML = '<div class="no-data-message">No earnings data available</div>';
      return;
    }

    // Create gradient for ecommerce chart
    var gradient = ctx.createLinearGradient(0, 0, 0, 130);
    gradient.addColorStop(0, 'rgba(245, 135, 31, 0.3)');
    gradient.addColorStop(1, 'rgba(245, 135, 31, 0.05)');

    var ecommerce_myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ecommerceLabels,
      datasets: [{
        label: '<?php echo $this->lang->line("Earnings");?>',
          data: ecommerceData,
          backgroundColor: gradient,
          borderWidth: 3,
          borderColor: '#F5871F',
        pointBorderWidth: 0,
        pointBorderColor: 'transparent',
          pointRadius: 5,
          pointBackgroundColor: '#F5871F',
          pointHoverBackgroundColor: '#E07B1A',
          pointHoverRadius: 7,
          fill: true,
          tension: 0.4,
      }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
      layout: {
        padding: {
            top: 10,
            bottom: 10,
            left: 10,
            right: 10
        }
      },
      plugins: {
        datalabels: {
            display: false,
      },
      legend: {
        display: false
          }
      },
      scales: {
          y: {
            beginAtZero: true,
            display: false,
            grid: {
            display: false,
            drawBorder: false,
            }
          },
          x: {
            display: false,
            grid: {
              display: false,
              drawBorder: false,
            }
          }
          },
        elements: {
          point: {
            hoverRadius: 8
          }
      },
        interaction: {
          intersect: false,
          mode: 'index'
        }
    }
  });
  }

  // Initialize ecommerce chart when DOM is ready
  document.addEventListener('DOMContentLoaded', function() {
    initializeEcommerceChart();
    initializeCalendarEnhancements();
    initializeLatestSubscribers();
  });

  // Enhanced Calendar functionality
  function initializeCalendarEnhancements() {
    // Update current calendar date
    updateCalendarDate();
    
    // Initialize activity counters
    updateActivityCounters();
    
    // Add calendar event listeners
    addCalendarEventListeners();
  }

  // Enhanced Latest Subscribers functionality
  function initializeLatestSubscribers() {
    // Initialize Owl Carousel for subscribers
    if ($('#latest-subscribers-carousel').length) {
      $('#latest-subscribers-carousel').owlCarousel({
        items: 4,
        margin: 10,
        nav: false,
        dots: false,
        loop: false,
        responsive: {
          0: { items: 1 },
          576: { items: 2 },
          768: { items: 3 },
          992: { items: 4 },
          1200: { items: 5 }
        }
      });
    }

    // Filter functionality
    $('.filter-item').on('click', function() {
      $('.filter-item').removeClass('active');
      $(this).addClass('active');
      
      const filter = $(this).data('filter');
      console.log('Filter changed to:', filter);
      
      // Here you can add logic to filter subscribers
      // For now, we'll just show all items
      $('.subscriber-item-wrapper').show();
    });

    // Action buttons functionality
    $('.action-btn').on('click', function(e) {
      e.preventDefault();
      const action = $(this).hasClass('message-btn') ? 'message' : 
                    $(this).hasClass('profile-btn') ? 'profile' : 'more';
      const subscriberName = $(this).closest('.subscriber-item').find('.subscriber-name').text();
      
      console.log('Action:', action, 'for subscriber:', subscriberName);
      
      // Add your action logic here
      if (action === 'message') {
        // Open message dialog
        alert('Opening message for ' + subscriberName);
      } else if (action === 'profile') {
        // Open profile view
        alert('Opening profile for ' + subscriberName);
      }
    });

    // Custom navigation
    $('.nav-btn').on('click', function() {
      const carousel = $('#latest-subscribers-carousel');
      if ($(this).hasClass('prev-btn')) {
        carousel.trigger('prev.owl.carousel');
      } else {
        carousel.trigger('next.owl.carousel');
      }
    });
  }

  function updateCalendarDate() {
    const now = new Date();
    const options = { year: 'numeric', month: 'long' };
    const dateString = now.toLocaleDateString('en-US', options);
    const currentDateElement = document.getElementById('current-calendar-date');
    if (currentDateElement) {
      currentDateElement.textContent = dateString;
    }
  }

  function updateActivityCounters() {
    // Simulate activity counting - replace with actual data
    const activityCounter = document.getElementById('activity-counter');
    const campaignsCount = document.getElementById('campaigns-count');
    const broadcastsCount = document.getElementById('broadcasts-count');
    const engagementCount = document.getElementById('engagement-count');
    const ecommerceCount = document.getElementById('ecommerce-count');

    if (activityCounter) {
      // Count total activities - replace with actual calendar event count
      let totalActivities = 0;
      const calendarEvents = document.querySelectorAll('#dashboard_calendar .fc-event');
      totalActivities = calendarEvents.length;
      activityCounter.textContent = totalActivities + ' activities this month';
    }

    // Update individual counters - replace with actual data
    if (campaignsCount) campaignsCount.textContent = '5';
    if (broadcastsCount) broadcastsCount.textContent = '3';
    if (engagementCount) engagementCount.textContent = '12';
    if (ecommerceCount) ecommerceCount.textContent = '8';
  }

  function addCalendarEventListeners() {
    // View toggle functionality
    const viewToggle = document.querySelector('.view-toggle');
    if (viewToggle) {
      viewToggle.addEventListener('click', function() {
        // Toggle active state
        this.classList.toggle('active');
        
        // Here you can add logic to change calendar view
        console.log('Calendar view toggled');
      });
    }

    // Update counters when calendar changes
    setTimeout(() => {
      updateActivityCounters();
    }, 1000);
  }

</script>


<script>
  var user_id_url = '<?php echo $user_id_url;?>';
  var ctx = document.getElementById("subscribers_stats").getContext('2d');
  var v1 = '<?php echo $this->lang->line("Subscriber Gain"); ?>';
  var v2 = '<?php echo $this->lang->line("Email Gain"); ?>';
  var v3 = '<?php echo $this->lang->line("Phone Gain"); ?>';
  var gradient_warning = ctx.createLinearGradient(0, 0, 0, 600);
  gradient_warning.addColorStop(0, 'rgba(252, 74, 26)');
  gradient_warning.addColorStop(1, 'rgba(247, 183, 51)'); 

  var gradient_secondary = ctx.createLinearGradient(0, 0, 0, 600);
  gradient_secondary.addColorStop(0, 'rgba(241, 71, 147)');
  gradient_secondary.addColorStop(1, 'rgba(58, 9, 137)'); 

  var gradient_primary = ctx.createLinearGradient(0, 0, 0, 600);
  gradient_primary.addColorStop(0, 'rgba(13, 139, 241)');
  gradient_primary.addColorStop(1, 'rgba(7, 65, 204)'); 

  const labels = <?php echo json_encode(array_values($last_tweleve_month)); ?>;

  const subscribers_data = {
   labels: labels,
   datasets: [{
     label: v1,
     type:'line',
     backgroundColor: 'transparent',
     borderColor: gradient_warning,
     data: <?php echo json_encode(array_values($total_subscribers)) ?>,
     pointBorderWidth: 0,
     pointRadius: 0,
     pointBackgroundColor: 'transparent',
   },{
     label: v2,
     backgroundColor: gradient_primary,
     borderColor: 'transparent',
     data: <?php echo json_encode(array_values($email_subscribers)) ?>,
   },
   {
       label: v3,
       type:'bar',
       backgroundColor: gradient_secondary,
       borderColor: 'transparent',
       data: <?php echo json_encode(array_values($phone_subscribers)) ?>,
     }
   ]
  };

  const config = {
   type: 'bar',
   data: subscribers_data,
   options: {
     responsive: true,
     legend: {
       display: true
     },
     hover: {
      mode: false
     },
     plugins: {
       datalabels: {
           display: false,
       }
     },
     scales: {
       yAxes: [{
         ticks: {
           beginAtZero: true,
           stepSize: <?php echo $stepSize; ?>,
         }
       }],
     },
   }

  };

  const myChart2 = new Chart(ctx,config);

</script>

<script>
    $(document).ready(function() {   

      var stepsize = "<?php echo $step_size; ?>"; 
      var fb_vs_ig_vs_web_earning_chart = document.getElementById('myChart_ecommerce').getContext('2d');

      var gradient_info = fb_vs_ig_vs_web_earning_chart.createLinearGradient(0, 0, 0, 600);
      gradient_info.addColorStop(0, 'rgba(21, 233, 255, .8)');
      gradient_info.addColorStop(1, 'rgba(19, 29, 75, .8)'); 

      var gradient_success = fb_vs_ig_vs_web_earning_chart.createLinearGradient(0, 0, 0, 600);
      gradient_success.addColorStop(0, 'rgba(83, 161, 100,.8)');
      gradient_success.addColorStop(1, 'rgba(19, 29, 75, .8)'); 

      var gradient_primary = fb_vs_ig_vs_web_earning_chart.createLinearGradient(0, 0, 0, 600);
      gradient_primary.addColorStop(0, 'rgba(13, 139, 241, .6)');
      gradient_primary.addColorStop(1, 'rgba(7, 65, 204, .6)'); 

      var gradient_secondary = fb_vs_ig_vs_web_earning_chart.createLinearGradient(0, 0, 0, 600);
      gradient_secondary.addColorStop(0, 'rgba(241, 71, 147, .7)');
      gradient_secondary.addColorStop(1, 'rgba(58, 9, 137, .7)'); 

      var gradient_warning = fb_vs_ig_vs_web_earning_chart.createLinearGradient(0, 0, 0, 600);
      gradient_warning.addColorStop(0, 'rgba(252, 74, 26, .8)');
      gradient_warning.addColorStop(1, 'rgba(247, 183, 51, .8)'); 

      var gradient_danger = fb_vs_ig_vs_web_earning_chart.createLinearGradient(0, 0, 0, 600);
      gradient_danger.addColorStop(0, 'rgba(255, 106, 0, .8)');
      gradient_danger.addColorStop(1, 'rgba(238, 9, 121, .8)'); 

      var myChart1 = new Chart(fb_vs_ig_vs_web_earning_chart, {
        type: 'line',
        data: {
          labels: <?php echo json_encode(array_values($earning_chart_labels));?>,
          datasets: [
          {
            label: '<?php echo $this->lang->line('Facebook'); ?>',
            data: <?php echo json_encode(array_values($fb_earning_chart_values));?>,
            borderWidth: 0,
            backgroundColor: gradient_primary,
            borderWidth: 0,
            borderColor: 'transparent',
            pointBorderWidth: 0 ,
            pointRadius: 0,
            pointBackgroundColor: 'transparent',
            pointHoverBackgroundColor: 'transparent',
          },          
          {
            label: '<?php echo $this->lang->line('Instagram'); ?>',
            data: <?php echo json_encode(array_values($ig_earning_chart_values));?>,
            borderWidth: 0,
            backgroundColor: gradient_secondary,
            borderWidth: 0,
            borderColor: 'transparent',
            pointBorderWidth: 0,
            pointRadius: 0,
            pointBackgroundColor: 'transparent',
            pointHoverBackgroundColor: 'rgba(13, 139, 241, .8)',
          },
          {
            label: '<?php echo $this->lang->line('Web'); ?>',
            data: <?php echo json_encode(array_values($web_earning_chart_values));?>,
            borderWidth: 0,
            backgroundColor: gradient_warning,
            borderWidth: 0,
            borderColor: 'transparent',
            pointBorderWidth: 0 ,
            pointRadius: 0,
            pointBackgroundColor: 'transparent',
            pointHoverBackgroundColor: 'transparent',
          }]          
        },
        options: {
          responsive: true,
          legend: {
            display: true
          },
          plugins: {
            datalabels: {
                display: false,
            }
          },
          scales: {
            yAxes: [{
              gridLines: {
                display: false,
                drawBorder: false,
                color: '#f2f2f2',
              },
              ticks: {
                beginAtZero: true,
                stepSize: stepsize,
                // display: false,
                // callback: function(value, index, values) {
                //   return value;
                // }
              }
            }],
            xAxes: [{
              gridLines: {
                display: false,
                tickMarkLength: 15,
              }
            }]
          },
        }
      });
    });
</script>

<!--
<script>
  var fbsubscriberProgress = document.getElementById("fbsubscribers");
  var fbsubscriberChart = new Chart(fbsubscriberProgress, {
    type: 'doughnut',
    data: {
      datasets: [{
        label: "Facebook",
        // percent: 60,
        percent: <?php echo $fsub_chart_data; ?>,
        backgroundColor: ['rgba(13, 139, 241, 1)']
      }]
    },
    plugins: [{
        beforeInit: (chart) => {
          const dataset = chart.data.datasets[0];
          chart.data.labels = [dataset.label];
          dataset.data = [dataset.percent, 100 - dataset.percent];
        },
        datalabels: {
            display: false,
        }
      },
      {
        beforeDraw: (chart) => {
          var width = chart.chart.width,
          height = chart.chart.height,
          ctx = chart.chart.ctx;
          ctx.restore();
          var fontSize = (height / 100).toFixed(2);
          ctx.font = fontSize + "em sans-serif";
          ctx.fillStyle = "#9b9b9b";
          ctx.textBaseline = "middle";
          var text = chart.data.datasets[0].percent + "%",
            textX = Math.round((width - ctx.measureText(text).width) / 2),
            textY = height / 2;
          ctx.fillText(text, textX, textY);
          ctx.save();

          ctx.shadowColor = "#eee";
          ctx.shadowBlur = 5;
          ctx.shadowOffsetX = 0;
          ctx.shadowOffsetY = 5;
        }
      }
    ],
    options: {
      // responsive: true,
      maintainAspectRatio: false,
      cutoutPercentage: 50,
      rotation: Math.PI / 2,
      legend: {
        display: false,
      },
      hover: {
         mode: false
       },
      tooltips: {
        enabled:false,
        filter: tooltipItem => tooltipItem.index == 0
      },
      plugins: {
        datalabels: {
          display: false,
        }
      },
    }
  });
</script>
<script>
  var igsubscriberProgress = document.getElementById("igsubscribers");
  var igsubscriberchart = new Chart(igsubscriberProgress, {
    type: 'doughnut',
    data: {
      datasets: [{
        label: 'Instagram',
        // percent: 70,
        percent: <?php echo $igsub_chart_data; ?>,
        backgroundColor: ['rgba(188, 80, 144, 1)']
      }]
    },
    plugins: [{
        beforeInit: (chart) => {
          const dataset = chart.data.datasets[0];
          chart.data.labels = [dataset.label];
          dataset.data = [dataset.percent, 100 - dataset.percent];
        },
        datalabels: {
            display: false,
        }
      },
      {
        beforeDraw: (chart) => {
          var width = chart.chart.width,
            height = chart.chart.height,
            ctx = chart.chart.ctx;
          ctx.restore();
          var fontSize = (height / 100).toFixed(2);
          ctx.font = fontSize + "em sans-serif";
          ctx.fillStyle = "#9b9b9b";
          ctx.textBaseline = "middle";
          var text = chart.data.datasets[0].percent + "%",
            textX = Math.round((width - ctx.measureText(text).width) / 2),
            textY = height / 2;
          ctx.fillText(text, textX, textY);
          ctx.save();

          ctx.shadowColor = "#eee";
          ctx.shadowBlur = 5;
          ctx.shadowOffsetX = 0;
          ctx.shadowOffsetY = 5;
        }
      }
    ],
    options: {
      // responsive: true,
      maintainAspectRatio: false,
      cutoutPercentage: 50,
      rotation: Math.PI / 2,
      legend: {
        display: false,
      },
      hover: {
         mode: false
       },
      tooltips: {
        enabled: false,
        filter: tooltipItem => tooltipItem.index == 0
      },
      plugins: {
        datalabels: {
            display: false,
        }
      },
    }
  });
</script>
<script>
  var esubscriberProgress = document.getElementById("esubscribers");
  var esubscriberchart = new Chart(esubscriberProgress, {
    type: 'doughnut',
    data: {
      datasets: [{
        label: 'Ecommerce',
        // percent: 55,
        percent: <?php echo $esub_chart_data; ?>,
        backgroundColor: ['rgba(252, 74, 26, 1)']
      }]
    },
    plugins: [{
        beforeInit: (chart) => {
          const dataset = chart.data.datasets[0];
          chart.data.labels = [dataset.label];
          dataset.data = [dataset.percent, 100 - dataset.percent];
        },
        datalabels: {
          display: false,
        },
      },
      {
        beforeDraw: (chart) => {
          var width = chart.chart.width,
            height = chart.chart.height,
            ctx = chart.chart.ctx;
          ctx.restore();
          var fontSize = (height / 100).toFixed(2);
          ctx.font = fontSize + "em sans-serif";
          ctx.fillStyle = "#9b9b9b";
          ctx.textBaseline = "middle";
          var text = chart.data.datasets[0].percent + "%",
            textX = Math.round((width - ctx.measureText(text).width) / 2),
            textY = height / 2;
          ctx.fillText(text, textX, textY);
          ctx.save();

          ctx.shadowColor = "#eee";
          ctx.shadowBlur = 5;
          ctx.shadowOffsetX = 0;
          ctx.shadowOffsetY = 5;
        }
      }
    ],
    options: {
      // responsive: true,
      maintainAspectRatio: false,
      cutoutPercentage: 50,
      rotation: Math.PI / 2,
      legend: {
        display: false,
      },
      hover: {
       mode: false
       },
      tooltips: {
        enabled: false,
        filter: tooltipItem => tooltipItem.index == 0
      },
      plugins: {
        datalabels: {
            display: false,
        }
      },
    }
  });
</script>
-->

<!-- Subscribers from different sources chart -->
<script>
  var social_network_shared_config = document.getElementById('social_network_shared_data').getContext('2d');
  var only_keys = <?php echo json_encode(array_keys(isset($subscribers_source_info) ? $subscribers_source_info : array())); ?>;
  var only_values = <?php echo json_encode(array_values(isset($subscribers_source_info) ? $subscribers_source_info : array())); ?>;

  // var bg_linear_gradient = ["","#C82372","#911670","#5A1A81","#340F70","#F47D6D"];
  var bg_linear_gradient = ["orange","#53a164","#5A1A81","#0dcde1","#0D8BF1","#FC427B"];

  var social_network_shared_chart_data = {
    type: 'doughnut',
    // type: 'pie',
    data: {
      datasets: [{
        data: only_values,
        backgroundColor: bg_linear_gradient,
        pointColor:bg_linear_gradient,
        
      }],
      labels: only_keys,
    },
    options: {
      cutoutPercentage : 40,
      responsive: true,
      legend: {
        display: false,
        align:'start',
        position: 'left',
        fullSize: true,
        labels: {
            fontColor: '#333',
            fontSize: 14,
            padding: 20
        },
      },
      hover: {
         mode: false
       },
      
      animation: {
        animateScale: true,
        animateRotate: true
      },
      plugins: {
        datalabels: {
            display: false,
        }
      },
    }
   };

  var social_network_info_my_chart = new Chart(social_network_shared_config, social_network_shared_chart_data);
</script>


<script type="text/javascript">
	$(document).on('click', '.no_action', function(event) {
	  event.preventDefault();
	});
</script>

<script>
	$(document).ready(function() {

    $(document).on('click', '.currency_item', function(event) {
      event.preventDefault();
      var item_name = $(this).attr('store_id');
      $.ajax({
        url: '<?php echo base_url() ?>'+'dashboard/set_currency',
        type: 'POST',
        data: {item_name: item_name},
        success:function(){
          location.reload();
        }
      })
      
    });
		
		$(document).on('click', 'a.month_change', function(e) {
		  e.preventDefault(); 
		  $(".month_change").removeClass('active');
		  $(this).addClass('active');
		  var month_no = $(this).attr('month_no');
		  var month_name = $(this).html();
		  		  $("#orders-month").html('<i class="fas fa-calendar-alt mr-1"></i>' + month_name + '<i class="fas fa-chevron-down ml-1"></i>');

		  $(".month_change_middle_content").hide();
		  $("#loader").removeClass('hidden');

      var url = "<?php echo base_url('dashboard/get_first_div_content')?>";
      
		  $.ajax({
		     type:'POST' ,
		     url: url,
		     data: {month_no,user_id_url},
		     dataType : 'JSON',
		     success:function(response)
		     {
		      	$("#loader").addClass('hidden');
		      	$("#fbsub").html(response.fbsub);
		      	$("#igsub").html(response.igsub);
		      	$("#esub").html(response.esub);
		      	$("#total_subscribers").html(response.total_sub);
		      	$(".month_change_middle_content").show();
		     }
		  });
		});
    
    $(document).on('click', 'a.ecommerce_month_change', function(e) {
      e.preventDefault(); 
      $(".ecommerce_month_change").removeClass('active');
      $(this).addClass('active');
      var month_no = $(this).attr('month_no');
      var month_name = $(this).html();
      $("#ecommerce-month").html('<i class="fas fa-calendar-alt mr-1"></i>' + month_name + '<i class="fas fa-chevron-down ml-1"></i>');

      $(".ecommerce_month_change_middle_content").hide();
      $("#e_loader").removeClass('hidden');
      
      var url = "<?php echo base_url('dashboard/get_ecommerce_div_content')?>";

      $.ajax({
         type:'POST' ,
         url: url,
         data: {month_no,user_id_url},
         dataType : 'JSON',
         success:function(response)
         {
            $("#e_loader").addClass('hidden');
            $("#order_block").html(response.total_orders);
            $("#recovered_block").html(response.summary_recovered_cart);
            $("#checkout_block").html(response.summary_checkout_cart);
            $("#total_earning").html(response.summary_earning);
            $(".ecommerce_month_change_middle_content").show();
         }
      });
    });

    $("#products-carousel").owlCarousel({
      items: 6,
      rtl : is_rtl,
      margin: 10,
      autoplay: true,
      autoplayTimeout: 1000,
      autoplayHoverPause:true,
      loop: true,
      responsive: {
        0: {
          items: 2
        },
        768: {
          items: 4
        },
        1200: {
          items: 6
        }
      }
    });

    // Real-time clock functionality
    function updateDateTime() {
        const now = new Date();
        
        // Format time (12-hour format with seconds)
        const timeOptions = {
            hour: 'numeric',
            minute: '2-digit',
            second: '2-digit',
            hour12: true
        };
        const timeString = now.toLocaleTimeString('en-US', timeOptions);
        
        // Format date (full date)
        const dateOptions = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const dateString = now.toLocaleDateString('en-US', dateOptions);
        
        // Update elements if they exist
        const currentTimeElement = document.getElementById('current-time');
        const currentDateElement = document.getElementById('current-date');
        const mobileTimeElement = document.getElementById('mobile-time');
        
        if (currentTimeElement) {
            currentTimeElement.textContent = timeString;
        }
        
        if (currentDateElement) {
            currentDateElement.textContent = dateString;
        }
        
        if (mobileTimeElement) {
            mobileTimeElement.textContent = timeString;
        }
    }
    
    // Update time immediately and then every second
    updateDateTime();
    setInterval(updateDateTime, 1000);
    
  }); // Close document.ready function
</script>


<?php include(APPPATH.'views/ecommerce/cart_modal.php'); ?>

<?php include(APPPATH.'views/calendar/fullcalendar_css.php'); ?>
<?php include(APPPATH.'views/calendar/fullcalendar_custom_js.php'); ?>

<link rel="stylesheet" href="<?php echo base_url('assets/css/system/dashboard.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/system/dashboard.css'); ?>">