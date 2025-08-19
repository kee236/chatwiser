<?php
/*
Theme Name: Modern 
Unique Name: modern
Theme URI: https://chatpion.com
Author: Xerone IT
Author URI: https://xeroneit.net
Version: 1.0
Description: This is a default theme provided by the Author of ChatPion. We highly recommend not to change core files for your customization needs. For your own customization, create your own theme as per our <a href="https://xeroneit.net/blog/xerochat-front-end-theme-development-manual" target="_BLANK">documentation</a>. 
*/
?>
<!doctype html>
<html class="no-js" lang="en" <?php if($is_rtl) echo 'dir="rtl" style="overflow-x:hidden;"';?>>

<head>
	<meta charset="utf-8">

	<!--====== Title ======-->
	<title><?php echo $this->config->item('product_name'); if($this->config->item('slogan')!='') echo " | ".$this->config->item('slogan')?></title>

	<meta name="description" content="<?php echo $this->config->item('slogan'); ?>">
	<meta name="author" content="<?php echo $this->config->item('institute_address1');?>">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--====== Favicon Icon ======-->
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.png">

	<!--====== Animate CSS ======-->
	<link rel="stylesheet" href="<?php echo base_url('assets/modern/css/animate.css');?>">

	<!--====== Tiny slider CSS ======-->
	<link rel="stylesheet" href="<?php echo base_url('assets/modern/css/tiny-slider.css');?>">

	<!--====== Swiper slider css ======-->
	<link rel="stylesheet" href="<?php echo base_url('assets/modern/css/swiper.min.css');?>">

	<!--====== Glightbox CSS ======-->
	<link rel="stylesheet" href="<?php echo base_url('assets/modern/css/glightbox.min.css');?>">

	<!--====== Line Icons CSS ======-->
	<link rel="stylesheet" href="<?php echo base_url('assets/modern/css/LineIcons.2.0.css');?>">

	<!--====== Bootstrap CSS ======-->

	<?php if($is_rtl) 
	{ ?>
		<link rel="stylesheet" href="<?php echo base_url('assets/modern/css/rtl/bootstrap.rtl.min.css');?>">
		<?php 
	} 
	else 
	{ ?>
		<link rel="stylesheet" href="<?php echo base_url('assets/modern/css/bootstrap-5.0.5-alpha.min.css');?>">
		<?php
	} ?>

	<!--====== Style CSS ======-->
	<link rel="stylesheet" href="<?php echo base_url('assets/modern/css/style.css');?>">

</head>

<body>
	<!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

	<!--====== PRELOADER PART START ======-->

	<!-- <div class="preloader">
		<div class="loader">
			<div class="ytp-spinner">
				<div class="ytp-spinner-container">
					<div class="ytp-spinner-rotator">
						<div class="ytp-spinner-left">
							<div class="ytp-spinner-circle"></div>
						</div>
						<div class="ytp-spinner-right">
							<div class="ytp-spinner-circle"></div>
						</div>
					</div>
				</div>
			</div>
	</div> -->

	<!--====== PRELOADER PART ENDS ======-->

	<!--====== HEADER PART START ======-->

	<header class="header_area">
		<div id="header_navbar" class="header_navbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<nav class="navbar navbar-expand-lg">
							<a class="navbar-brand" href="">
								<img id="logo" src="<?php echo base_url();?>assets/img/logo.png" alt="Logo">
							</a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
								aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<span class="toggler-icon"></span>
								<span class="toggler-icon"></span>
								<span class="toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
								<ul id="nav" class="navbar-nav ml-auto">
									<li class="nav-item">
										<a class="page-scroll active" href="#home"><?php echo $this->lang->line('Home'); ?></a>
									</li>
									<li class="nav-item">
										<a class="page-scroll" href="#feature"><?php echo $this->lang->line('Features');?></a>
									</li>									
									<li class="nav-item">
										<a class="page-scroll" href="#pricing"><?php echo $this->lang->line('Pricing'); ?></a>
									</li>
									<li class="nav-item">
										<a class="page-scroll" href="#contact"><?php echo $this->lang->line('Contact'); ?></a>
	                                </li>
	                                <?php if ($this->session->userdata('license_type') == 'double')  {?>
	                                <li class="nav-item">
	                                    <a href="<?php echo base_url('blog');?>"><?php echo $this->lang->line('Blog'); ?></a>
	                                </li>
	                                <?php } ?>
									
									<li class="nav-item">
									    <a class="button" href="<?php echo site_url('home/login'); ?>"><?php echo $this->lang->line('Login'); ?></a>
									</li>
								</ul>
							</div> <!-- navbar collapse -->
						</nav> <!-- navbar -->
					</div>
				</div> <!-- row -->
			</div> <!-- container -->
		</div> <!-- header navbar -->
	</header>

	<!--====== HEADER PART ENDS ======-->

	<!--====== HERO PART START ======-->
	<section id="home" class="hero-area bg_cover">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-xl-6 col-lg-6" style="padding-top: 100px;">
					<div class="hero-content">
						<!-- Trusted by section -->
						<div class="trusted-by wow fadeInUp" data-wow-delay=".1s">
							<i class="lni lni-checkmark-circle"></i>
							<span><?php echo $this->lang->line("Trusted by"); ?> <span class="trusted-count" data-count="10000">0</span>+ <?php echo $this->lang->line("businesses"); ?></span>
						</div>
						
						<h2 class="wow fadeInUp" data-wow-delay=".2s">
							<?php echo $this->lang->line("Never Miss Another Customer"); ?> 
							<span style="background: linear-gradient(45deg, #0ADCC7, #052CFF); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"><?php echo $this->lang->line("While You Sleep"); ?></span>
						</h2>
						<p class="wow fadeInUp" data-wow-delay=".4s"><?php echo $this->lang->line("Chatwiser automatically responds to social media messages and comments, converts followers into customers, and grows your business 24/7 with AI-powered conversations in any language."); ?></p>
						
						<div class="hero-btns-with-stats">
						<div class="hero-btns">
							<a href="<?php echo site_url('home/sign_up'); ?>" class="main-btn btn-hover wow fadeInUp <?php if($this->config->item('enable_signup_form') =='0') echo "d-none"; ?>" data-wow-delay=".45s"><?php echo $this->lang->line("Sign up now"); ?></a>
							</div>
							    

						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6">
					<div class="hero-img">
						<img src="<?php echo base_url();?>assets/modern/images/features-image-2.png" alt="" class="wow fadeInRight" data-wow-delay=".2s">
						<img src="<?php echo base_url();?>assets/modern/images/features-image-1.png" alt="" class="img-screen screen-1 wow fadeInUp" data-wow-delay=".25s">
						<img src="<?php echo base_url();?>assets/modern/images/features-image-2.png" alt="" class="img-screen screen-2 wow fadeInUp" data-wow-delay=".3s">
						<img src="<?php echo base_url();?>assets/modern/images/features-image-2.png" alt="" class="img-screen screen-3 wow fadeInUp" data-wow-delay=".35s">
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--====== HERO PART END ======-->

	<!--====== PROBLEM VS SOLUTION SECTION START ======-->
	<section id="problem-solution" class="problem-solution-area pt-130 pb-130">
		<div class="container">
			<!-- Section Header -->
			<div class="row">
				<div class="col-xl-10 col-lg-10 mx-auto">
					<div class="section-title text-center mb-70">
						<h2 class="title wow fadeInUp" data-wow-delay=".2s">
							<?php echo $this->lang->line("Stop Losing Customers to"); ?> 
							<span style="background: linear-gradient(45deg, #FF6B6B, #EE5A24); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"><?php echo $this->lang->line("Slow Responses"); ?></span>
						</h2>
						<p class="wow fadeInUp" data-wow-delay=".4s"><?php echo $this->lang->line("Businesses lose thousands of potential customers every month due to delayed social media responses. Here's how chatwiser solves this problem."); ?></p>
			</div>
				</div>
			</div>

			<!-- Problem vs Solution Content -->
			<div class="row align-items-center">
				<div class="col-xl-6 col-lg-6">
					<!-- The Problem Side -->
					<div class="problem-side">
						<div class="problem-header wow fadeInLeft" data-wow-delay=".2s">
							<div class="problem-icon">
								<i class="lni lni-cross-circle"></i>
							</div>
							<h3><?php echo $this->lang->line("The Problem"); ?></h3>
						</div>

						<div class="problem-list">
							<div class="problem-item wow fadeInLeft" data-wow-delay=".3s">
								<div class="problem-item-icon">
									<i class="lni lni-timer"></i>
								</div>
								<div class="problem-content">
									<h4><?php echo $this->lang->line("Missing Messages While You Sleep"); ?></h4>
									<p><?php echo $this->lang->line("Customers message you at night and weekends, but you can't respond until business hours - losing potential sales."); ?></p>
								</div>
							</div>

							<div class="problem-item wow fadeInLeft" data-wow-delay=".4s">
								<div class="problem-item-icon">
									<i class="lni lni-bubble"></i>
								</div>
								<div class="problem-content">
									<h4><?php echo $this->lang->line("Overwhelmed by Social Media"); ?></h4>
									<p><?php echo $this->lang->line("Managing Instagram, Facebook, WhatsApp messages manually takes hours every day, leaving no time for business growth."); ?></p>
								</div>
							</div>

							<div class="problem-item wow fadeInLeft" data-wow-delay=".5s">
								<div class="problem-item-icon">
									<i class="lni lni-users"></i>
								</div>
								<div class="problem-content">
									<h4><?php echo $this->lang->line("Language Barriers"); ?></h4>
									<p><?php echo $this->lang->line("Serving customers in both Arabic and English requires constant translation and cultural understanding."); ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-6 col-lg-6">
					<!-- The Solution Side -->
					<div class="solution-side">
						<div class="solution-header wow fadeInRight" data-wow-delay=".2s">
							<div class="solution-icon">
								<i class="lni lni-checkmark-circle"></i>
							</div>
							<h3><?php echo $this->lang->line("The Solution"); ?></h3>
						</div>

						<div class="solution-list">
							<div class="solution-item wow fadeInRight" data-wow-delay=".3s">
								<div class="solution-item-icon">
									<i class="lni lni-clock"></i>
								</div>
								<div class="solution-content">
									<h4><?php echo $this->lang->line("24/7 Automated Responses"); ?></h4>
									<p><?php echo $this->lang->line("ChatWiser responds to every message instantly, even at 3 AM, ensuring no customer is ever ignored."); ?></p>
								</div>
							</div>

							<div class="solution-item wow fadeInRight" data-wow-delay=".4s">
								<div class="solution-item-icon">
									<i class="lni lni-target"></i>
								</div>
								<div class="solution-content">
									<h4><?php echo $this->lang->line("Smart Lead Qualification"); ?></h4>
									<p><?php echo $this->lang->line("Our AI identifies hot prospects, qualifies leads, and schedules appointments automatically."); ?></p>
								</div>
							</div>

							<div class="solution-item wow fadeInRight" data-wow-delay=".5s">
								<div class="solution-item-icon">
									<i class="lni lni-world"></i>
								</div>
								<div class="solution-content">
									<h4><?php echo $this->lang->line("Bilingual AI Assistant"); ?></h4>
									<p><?php echo $this->lang->line("Fluent conversations in Arabic and English with cultural context and local business understanding."); ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Results Section -->
			<div class="row mt-100">
				<div class="col-xl-12">
					<div class="results-section text-center">
						<h3 class="results-title wow fadeInUp" data-wow-delay=".2s"><?php echo $this->lang->line("Real Results from ChatWiser Users"); ?></h3>
						<p class="results-subtitle wow fadeInUp" data-wow-delay=".3s"><?php echo $this->lang->line("Average improvements in the first 30 days"); ?></p>
						
						<div class="results-stats">
			<div class="row">
				<div class="col-xl-3 col-lg-3 col-md-6">
									<div class="result-item wow fadeInUp" data-wow-delay=".4s">
										<div class="result-number">
											<span class="result-count" data-count="300">0</span>%
						</div>
										<div class="result-label"><?php echo $this->lang->line("Faster Response Time"); ?></div>
						</div>
								</div>
								<div class="col-xl-3 col-lg-3 col-md-6">
									<div class="result-item wow fadeInUp" data-wow-delay=".5s">
										<div class="result-number">
											<span class="result-count" data-count="89">0</span>%
										</div>
										<div class="result-label"><?php echo $this->lang->line("Message Response Rate"); ?></div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6">
									<div class="result-item wow fadeInUp" data-wow-delay=".6s">
										<div class="result-number">
											<span class="result-count" data-count="45">0</span>%
										</div>
										<div class="result-label"><?php echo $this->lang->line("More Qualified Leads"); ?></div>
									</div>
								</div>
								<div class="col-xl-3 col-lg-3 col-md-6">
									<div class="result-item wow fadeInUp" data-wow-delay=".7s">
										<div class="result-number">
											<span class="result-count" data-count="5">0</span><?php echo $this->lang->line("hrs"); ?>
										</div>
										<div class="result-label"><?php echo $this->lang->line("Daily Time Saved"); ?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--====== PROBLEM VS SOLUTION SECTION END ======-->

	<!--====== FEATURE PART START ======-->
	<section id="feature" class="feature-area pt-130 pb-130">
		<div class="container">
			<!-- Section Header -->
			<div class="row">
				<div class="col-xl-8 col-lg-10 mx-auto">
					<div class="section-title text-center mb-80">
						<h2 class="title wow fadeInUp" data-wow-delay=".2s"><?php echo $this->lang->line("Powerful Features That Drive Results"); ?></h2>
						<p class="wow fadeInUp" data-wow-delay=".4s"><?php echo $this->lang->line("Everything you need to automate customer conversations and grow your business with AI-powered social media management."); ?></p>
					</div>
				</div>
			</div>

			<!-- Features Grid -->
			<div class="row">
				<!-- Feature 1: AI-Powered Automation -->
				<div class="col-xl-4 col-lg-4 col-md-6  mt-4">
					<div class="single-feature modern-feature wow fadeInUp" data-wow-delay=".2s">
						<div class="feature-icon-wrapper">
							<div class="feature-icon">
								<i class="lni lni-cog"></i>
							</div>
						</div>
						<div class="feature-content">
							<h4><?php echo $this->lang->line("AI-Powered Automation"); ?></h4>
							<p><?php echo $this->lang->line("Intelligent chatbots that understand context, learn from conversations, and provide human-like responses 24/7."); ?></p>
							<div class="feature-list">
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("Smart conversation flows"); ?></span>
						</div>
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("Natural language processing"); ?></span>
					</div>
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("Learning algorithms"); ?></span>
				</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Feature 2: Multi-Platform Integration -->
				<div class="col-xl-4 col-lg-4 col-md-6  mt-4">
					<div class="single-feature modern-feature wow fadeInUp" data-wow-delay=".4s">
						<div class="feature-icon-wrapper">
							<div class="feature-icon">
								<i class="lni lni-network"></i>
							</div>
						</div>
						<div class="feature-content">
							<h4><?php echo $this->lang->line("Multi-Platform Integration"); ?></h4>
							<p><?php echo $this->lang->line("Connect and manage all your social media channels from one unified dashboard with seamless integration."); ?></p>
							<div class="feature-list">
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("Facebook & Instagram"); ?></span>
						</div>
								<div class="feature-item coming-soon-item">
									<i class="lni lni-time"></i>
									<span><?php echo $this->lang->line("WhatsApp Business"); ?></span>
									<span class="coming-soon-badge"><?php echo $this->lang->line("Coming Soon"); ?></span>
					</div>
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("Unified inbox"); ?></span>
				</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Feature 3: Advanced Analytics -->
				<div class="col-xl-4 col-lg-4 col-md-6  mt-4">
					<div class="single-feature modern-feature wow fadeInUp" data-wow-delay=".6s">
						<div class="feature-icon-wrapper">
							<div class="feature-icon">
								<i class="lni lni-bar-chart"></i>
							</div>
						</div>
						<div class="feature-content">
							<h4><?php echo $this->lang->line("Advanced Analytics"); ?></h4>
							<p><?php echo $this->lang->line("Comprehensive insights and reporting to track performance, measure ROI, and optimize your customer engagement strategy."); ?></p>
							<div class="feature-list">
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("Real-time metrics"); ?></span>
						</div>
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("Conversion tracking"); ?></span>
								</div>
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("Custom reports"); ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Feature 4: Lead Management -->
				<div class="col-xl-4 col-lg-4 col-md-6 mt-4">
					<div class="single-feature modern-feature wow fadeInUp" data-wow-delay=".8s">
						<div class="feature-icon-wrapper">
							<div class="feature-icon">
								<i class="lni lni-users"></i>
							</div>
						</div>
						<div class="feature-content">
							<h4><?php echo $this->lang->line("Smart Lead Management"); ?></h4>
							<p><?php echo $this->lang->line("Automatically qualify leads, segment customers, and nurture prospects through personalized conversation workflows."); ?></p>
							<div class="feature-list">
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("Lead scoring"); ?></span>
								</div>
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("Customer segmentation"); ?></span>
								</div>
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("Automated follow-ups"); ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Feature 5: Multilingual Support -->
				<div class="col-xl-4 col-lg-4 col-md-6  mt-4">
					<div class="single-feature modern-feature wow fadeInUp" data-wow-delay="1s">
						<div class="feature-icon-wrapper">
							<div class="feature-icon">
								<i class="lni lni-world"></i>
							</div>
						</div>
						<div class="feature-content">
							<h4><?php echo $this->lang->line("Multilingual Support"); ?></h4>
							<p><?php echo $this->lang->line("Serve customers in their preferred language with AI-powered translation and culturally-aware responses."); ?></p>
							<div class="feature-list">
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("Real-time translation"); ?></span>
								</div>
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("Cultural context"); ?></span>
								</div>
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("50+ languages"); ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Feature 6: Easy Setup & Management -->
				<div class="col-xl-4 col-lg-4 col-md-6  mt-4">
					<div class="single-feature modern-feature wow fadeInUp" data-wow-delay="1.2s">
						<div class="feature-icon-wrapper">
							<div class="feature-icon">
								<i class="lni lni-cog"></i>
							</div>
						</div>
						<div class="feature-content">
							<h4><?php echo $this->lang->line("Easy Setup & Management"); ?></h4>
							<p><?php echo $this->lang->line("Get started in minutes with our intuitive interface and drag-and-drop workflow builder. No technical skills required."); ?></p>
							<div class="feature-list">
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("5-minute setup"); ?></span>
								</div>
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("Visual workflow builder"); ?></span>
								</div>
								<div class="feature-item">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("No coding required"); ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Call to Action -->
			<div class="row mt-80">
				<div class="col-xl-8 col-lg-10 mx-auto">
					<div class="features-cta text-center">
						<h3 class="cta-title wow fadeInUp" data-wow-delay=".2s"><?php echo $this->lang->line("Ready to Transform Your Customer Engagement?"); ?></h3>
						<p class="cta-subtitle wow fadeInUp" data-wow-delay=".4s"><?php echo $this->lang->line("Join thousands of businesses already using chatwiser to automate conversations and boost sales."); ?></p>
						<div class="cta-buttons wow fadeInUp" data-wow-delay=".6s">
							<a href="<?php echo site_url('home/sign_up'); ?>" class="main-btn btn-hover <?php if($this->config->item('enable_signup_form') =='0') echo "d-none"; ?>"><?php echo $this->lang->line("Start Free Trial"); ?></a>
							<a href="#pricing" class="btn-outline page-scroll"><?php echo $this->lang->line("View Pricing"); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--====== FEATURE PART ENDS ======-->

	<!--====== HOW-WORK PART START ======-->
	<section id="how-work" class="how-work-area pt-130 pb-130">
		<div class="container">
			<!-- Section Header -->
			<div class="row">
				<div class="col-xl-8 col-lg-10 mx-auto">
					<div class="section-title text-center mb-80">
						<h2 class="title wow fadeInUp" data-wow-delay=".2s"><?php echo $this->lang->line("How chatwiser Works"); ?></h2>
						<p class="wow fadeInUp" data-wow-delay=".4s"><?php echo $this->lang->line("Get started in minutes and transform your customer engagement with AI-powered automation."); ?></p>
					</div>
				</div>
			</div>

			<div class="row align-items-center">
				<div class="col-xl-5 col-lg-6">
					<div class="how-work-img text-center text-lg-left">
						<img src="<?php echo base_url();?>assets/modern/images/download-img.png" alt="chatwiser Dashboard" class="w-100 wow fadeInLeft img-fluid" data-wow-delay=".2s">
						<img src="<?php echo base_url();?>assets/modern/images/dots-shape.svg" alt="" class="shape dots-shape wow fadeInUp" data-wow-delay=".3s">
					</div>
				</div>
				<div class="col-xl-6 offset-xl-1 col-lg-6">
					<div class="how-work-content-wrapper">
						<div class="how-work-steps">
							<!-- Step 1 -->
							<div class="single-step wow fadeInUp" data-wow-delay=".2s">
								<div class="step-number">
									<span>1</span>
						</div>
								<div class="step-content">
									<h4><?php echo $this->lang->line("Connect Your Social Accounts"); ?></h4>
									<p><?php echo $this->lang->line("Link your Facebook, Instagram, and social media accounts in just one click. Our secure integration ensures your data is protected."); ?></p>
								</div>
									</div>

							<!-- Step 2 -->
							<div class="single-step wow fadeInUp" data-wow-delay=".3s">
								<div class="step-number">
									<span>2</span>
										</div>
								<div class="step-content">
									<h4><?php echo $this->lang->line("Set Up AI Automation"); ?></h4>
									<p><?php echo $this->lang->line("Configure your AI assistant with our intuitive visual builder. Create conversation flows and responses that match your brand voice."); ?></p>
									</div>
								</div>

							<!-- Step 3 -->
							<div class="single-step wow fadeInUp" data-wow-delay=".4s">
								<div class="step-number">
									<span>3</span>
								</div>
								<div class="step-content">
									<h4><?php echo $this->lang->line("Customize Responses"); ?></h4>
									<p><?php echo $this->lang->line("Train your AI to handle customer inquiries, qualify leads, and provide personalized responses in multiple languages."); ?></p>
								</div>
									</div>

							<!-- Step 4 -->
							<div class="single-step wow fadeInUp" data-wow-delay=".5s">
								<div class="step-number">
									<span>4</span>
										</div>
								<div class="step-content">
									<h4><?php echo $this->lang->line("Go Live & Monitor"); ?></h4>
									<p><?php echo $this->lang->line("Activate your AI assistant and watch it engage customers 24/7. Monitor performance and optimize with real-time analytics."); ?></p>
									</div>
								</div>
									</div>

						<div class="how-work-cta wow fadeInUp" data-wow-delay=".6s">
							<a href="<?php echo site_url('home/sign_up'); ?>" class="main-btn btn-hover <?php if($this->config->item('enable_signup_form') =='0') echo "d-none"; ?>"><?php echo $this->lang->line("Start Your Free Trial"); ?></a>
							<div class="setup-time">
								<i class="lni lni-timer"></i>
								<span><?php echo $this->lang->line("Setup takes less than 5 minutes"); ?></span>
										</div>
									</div>
								</div>
				</div>
			</div>
		</div>
	</section>
	<!--====== HOW-WORK PART ENDS ======-->

	<!--====== ECOMMERCE SECTION START ======-->
	<section id="ecommerce" class="ecommerce-area pt-130 pb-130">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-xl-6 col-lg-6">
					<div class="ecommerce-content">
						<div class="section-title">
							<h2 class="title wow fadeInUp" data-wow-delay=".2s"><?php echo $this->lang->line("Built-in Ecommerce Store"); ?></h2>
							<p class="wow fadeInUp" data-wow-delay=".4s"><?php echo $this->lang->line("Transform conversations into sales with chatwiser's integrated ecommerce platform. Sell directly through social media conversations."); ?></p>
									</div>

						<div class="ecommerce-features">
							<div class="ecommerce-feature wow fadeInUp" data-wow-delay=".5s">
								<div class="feature-icon">
									<i class="lni lni-cart"></i>
										</div>
								<div class="feature-content">
									<h4><?php echo $this->lang->line("Digital Menu & Catalog"); ?></h4>
									<p><?php echo $this->lang->line("Create beautiful product catalogs and digital menus that customers can browse and order from directly in chat."); ?></p>
									</div>
								</div>
								
							<div class="ecommerce-feature wow fadeInUp" data-wow-delay=".6s">
								<div class="feature-icon">
									<i class="lni lni-credit-cards"></i>
								</div>
								<div class="feature-content">
									<h4><?php echo $this->lang->line("Seamless Payments"); ?></h4>
									<p><?php echo $this->lang->line("Accept payments directly through conversations with secure payment processing and automated order confirmations."); ?></p>
								</div>
									</div>

							<div class="ecommerce-feature wow fadeInUp" data-wow-delay=".7s">
								<div class="feature-icon">
									<i class="lni lni-delivery"></i>
								</div>
								<div class="feature-content">
									<h4><?php echo $this->lang->line("Order Management"); ?></h4>
									<p><?php echo $this->lang->line("Track orders, manage inventory, and provide real-time delivery updates all through automated conversations."); ?></p>
										</div>
									</div>
								</div>
								
						<div class="ecommerce-cta wow fadeInUp" data-wow-delay=".8s">
							<a href="<?php echo site_url('home/sign_up'); ?>" class="main-btn btn-hover <?php if($this->config->item('enable_signup_form') =='0') echo "d-none"; ?>"><?php echo $this->lang->line("Explore Ecommerce Features"); ?></a>
							</div>
						</div>
						</div>
				<div class="col-xl-6 col-lg-6">
					<div class="ecommerce-mockup wow fadeInRight" data-wow-delay=".3s">
						<div class="mockup-container">
							<div class="phone-mockup">
								<div class="phone-screen">
									<div class="app-header">
										<div class="app-logo">
											<i class="lni lni-restaurant"></i>
											<span>chatwiser Store</span>
					</div>
				</div>
									<div class="search-bar">
										<i class="lni lni-search"></i>
										<span>Search products...</span>
									</div>
									<div class="categories">
										<div class="category-item active">
											<i class="lni lni-grid-alt"></i>
											<span>All Items</span>
										</div>
										<div class="category-item">
											<i class="lni lni-burger"></i>
											<span>Food</span>
										</div>
										<div class="category-item">
											<i class="lni lni-coffee-cup"></i>
											<span>Drinks</span>
										</div>
									</div>
									<div class="products-grid">
										<div class="product-item">
											<div class="product-image"></div>
											<div class="product-info">
												<h4>$25.00</h4>
												<p>Premium Product</p>
												<button class="add-to-cart">
													<i class="lni lni-cart"></i>
												</button>
											</div>
										</div>
										<div class="product-item">
											<div class="product-image"></div>
											<div class="product-info">
												<h4>$18.00</h4>
												<p>Popular Choice</p>
												<button class="add-to-cart">
													<i class="lni lni-cart"></i>
												</button>
											</div>
										</div>
										<div class="product-item">
											<div class="product-image"></div>
											<div class="product-info">
												<h4>$32.00</h4>
												<p>Best Seller</p>
												<button class="add-to-cart">
													<i class="lni lni-cart"></i>
												</button>
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
	</section>
	<!--====== ECOMMERCE SECTION END ======-->

	<!--====== CHATBOT FLOW BUILDER SECTION START ======-->
	<section id="flow-builder" class="flow-builder-area pt-130 pb-130">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-xl-6 col-lg-6">
					<div class="flow-builder-content">
						<div class="section-title">
							<h2 class="title wow fadeInUp" data-wow-delay=".2s"><?php echo $this->lang->line("Visual Drag & Drop Chatbot Editor"); ?></h2>
							<p class="wow fadeInUp" data-wow-delay=".4s"><?php echo $this->lang->line("Create sophisticated conversation flows with our intuitive visual editor. Build, test, and deploy intelligent chatbots without any coding required."); ?></p>
				</div>

						<div class="flow-builder-features">
							<div class="builder-feature wow fadeInUp" data-wow-delay=".5s">
								<div class="feature-icon">
									<i class="lni lni-vector"></i>
			</div>
								<div class="feature-content">
									<h4><?php echo $this->lang->line("Drag & Drop Interface"); ?></h4>
									<p><?php echo $this->lang->line("Build complex conversation flows by simply dragging and connecting elements. No technical skills needed."); ?></p>
								</div>
			</div>

							<div class="builder-feature wow fadeInUp" data-wow-delay=".6s">
								<div class="feature-icon">
									<i class="lni lni-code-alt"></i>
								</div>
								<div class="feature-content">
									<h4><?php echo $this->lang->line("Smart Logic Builder"); ?></h4>
									<p><?php echo $this->lang->line("Create conditional responses, user segmentation, and advanced branching logic with visual tools."); ?></p>
								</div>
							</div>

							<div class="builder-feature wow fadeInUp" data-wow-delay=".7s">
								<div class="feature-icon">
									<i class="lni lni-play"></i>
			        	  </div>
								<div class="feature-content">
									<h4><?php echo $this->lang->line("Real-time Testing"); ?></h4>
									<p><?php echo $this->lang->line("Test your chatbot flows instantly with our built-in simulator before going live with customers."); ?></p>
			        	</div>
			        </div>
			    </div>

						<div class="flow-builder-cta wow fadeInUp" data-wow-delay=".8s">
							<a href="<?php echo site_url('home/sign_up'); ?>" class="main-btn btn-hover <?php if($this->config->item('enable_signup_form') =='0') echo "d-none"; ?>"><?php echo $this->lang->line("Try Flow Builder"); ?></a>
							<div class="builder-stats">
								<span class="stat-item">
									<i class="lni lni-timer"></i>
									<?php echo $this->lang->line("Build in Minutes"); ?>
								</span>
								<span class="stat-item">
									<i class="lni lni-code"></i>
									<?php echo $this->lang->line("No Coding Required"); ?>
								</span>
		</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6">
					<div class="flow-builder-mockup wow fadeInRight" data-wow-delay=".3s">
						<div class="builder-interface">
							<!-- Header Card -->
							<div class="builder-header">
								<div class="header-card">
									<div class="card-icon">
										<i class="lni lni-cog"></i>
									</div>
									<div class="card-content">
										<h3><?php echo $this->lang->line("chatwiser Flow Builder"); ?></h3>
										<p><?php echo $this->lang->line("Visual Drag & Drop Chatbot Editor"); ?></p>
									</div>
								</div>
							</div>

							<!-- Flow Canvas -->
							<div class="flow-canvas">
								<!-- Start Node -->
								<div class="flow-node start-node">
									<div class="node-header">
										<i class="lni lni-play"></i>
										<span><?php echo $this->lang->line("Start Bot Flow"); ?></span>
			</div>
									<div class="node-content">
										<p><?php echo $this->lang->line("Welcome"); ?></p>
										<small><?php echo $this->lang->line("Initial greeting message"); ?></small>
						</div>
									<div class="node-connector right"></div>
					</div>

								<!-- Message Node -->
								<div class="flow-node message-node">
									<div class="node-header">
										<i class="lni lni-bubble"></i>
										<span><?php echo $this->lang->line("Message"); ?></span>
				</div>
									<div class="node-content">
										<p><?php echo $this->lang->line("How can I help you today?"); ?></p>
										<small><?php echo $this->lang->line("User interaction prompt"); ?></small>
						</div>
									<div class="node-connector left"></div>
									<div class="node-connector right"></div>
						</div>

								<!-- Button Node -->
								<div class="flow-node button-node">
									<div class="node-header">
										<i class="lni lni-hand"></i>
										<span><?php echo $this->lang->line("Quick Reply"); ?></span>
						</div>
									<div class="node-content">
										<div class="quick-buttons">
											<button class="quick-btn"><?php echo $this->lang->line("Product Info"); ?></button>
											<button class="quick-btn"><?php echo $this->lang->line("Support"); ?></button>
											<button class="quick-btn"><?php echo $this->lang->line("Pricing"); ?></button>
						</div>
						</div>
									<div class="node-connector left"></div>
									<div class="node-connector right"></div>
					</div>

								<!-- Condition Node -->
								<div class="flow-node condition-node">
									<div class="node-header">
										<i class="lni lni-direction"></i>
										<span><?php echo $this->lang->line("Condition"); ?></span>
					</div>
									<div class="node-content">
										<p><?php echo $this->lang->line("User Type"); ?></p>
										<small><?php echo $this->lang->line("Route based on user data"); ?></small>
				</div>
									<div class="node-connector left"></div>
									<div class="node-connector right"></div>
									<div class="node-connector bottom"></div>
								</div>

								<!-- Connection Lines -->
								<svg class="connection-lines">
									<path d="M 100 120 Q 150 120 200 120" stroke="#052CFF" stroke-width="2" fill="none"/>
									<path d="M 300 120 Q 350 120 400 120" stroke="#0ADCC7" stroke-width="2" fill="none"/>
									<path d="M 500 120 Q 550 120 600 120" stroke="#052CFF" stroke-width="2" fill="none"/>
									<path d="M 700 120 Q 750 120 800 160" stroke="#0ADCC7" stroke-width="2" fill="none"/>
								</svg>
							</div>

							<!-- Toolbar -->
							<div class="builder-toolbar">
								<div class="toolbar-section">
									<h4><?php echo $this->lang->line("Elements"); ?></h4>
									<div class="element-items">
										<div class="element-item">
											<i class="lni lni-bubble"></i>
											<span><?php echo $this->lang->line("Message"); ?></span>
										</div>
										<div class="element-item">
											<i class="lni lni-hand"></i>
											<span><?php echo $this->lang->line("Button"); ?></span>
										</div>
										<div class="element-item">
											<i class="lni lni-direction"></i>
											<span><?php echo $this->lang->line("Condition"); ?></span>
										</div>
										<div class="element-item">
											<i class="lni lni-target"></i>
											<span><?php echo $this->lang->line("Action"); ?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--====== CHATBOT FLOW BUILDER SECTION END ======-->

	<!--====== TESTIMONIAL PART START ======-->
	<section dir="ltr" class="testimonial-area modern-testimonials pt-150 pb-100 <?php if($this->config->item('display_review_block') == '0') echo 'd-none';?>">
		<div class="container">
			<!-- Section Header -->
			<div class="row">
				<div class="col-xl-8 col-lg-10 mx-auto">
					<div class="section-title text-center mb-80">
						<h2 class="title wow fadeInUp" data-wow-delay=".2s"><?php echo $this->lang->line("Trusted by Businesses Worldwide"); ?></h2>
						<p class="wow fadeInUp" data-wow-delay=".4s"><?php echo $this->lang->line("See what our customers say about transforming their customer engagement with chatwiser's AI-powered automation."); ?></p>
					</div>
				</div>
			</div>

			<!-- Testimonials Carousel -->
			<div class="row">				
				<div class="col-xl-12">
					<div class="testimonial-carousel-wrapper">
						<div class="testimonial-carousel swiper-container">
							<div class="swiper-wrapper">
							<?php 
			                	$customerReview = $this->config->item('customer_review');
				                $ct=0;
							    foreach($customerReview as $singleReview) : 
					                $ct++;
					                $original = $singleReview[2];
					                $base     = base_url();
					                if (substr($original, 0, 4) != 'http')   $img = $base.$original;
					                else $img = $original;			                
					            	?>
									<!-- start single testimonial  -->
										<div class="swiper-slide">
											<div class="single-testimonial modern-testimonial wow fadeInUp" data-wow-delay=".2s">
												<div class="testimonial-card">
										<div class="testimonial-header">
											<div class="client-info">
												<div class="client-img">
																<img src="<?php echo $img; ?>" alt="<?php echo $singleReview[0]; ?>">
																<div class="verified-badge">
																	<i class="lni lni-checkmark"></i>
												</div>
												</div>
															<div class="client-details">
																<h5><?php echo $singleReview[0]; ?></h5>
																<span class="client-position"><?php echo $singleReview[1]; ?></span>
											<div class="client-rating">
												<span><i class="lni lni-star-filled"></i></span>
												<span><i class="lni lni-star-filled"></i></span>
												<span><i class="lni lni-star-filled"></i></span>
												<span><i class="lni lni-star-filled"></i></span>
												<span><i class="lni lni-star-filled"></i></span>
																	<span class="rating-text">5.0</span>
											</div>
										</div>
										</div>
														<div class="quote-icon">
															<i class="lni lni-quotation"></i>
														</div>
													</div>
													
										<div class="testimonial-content">
											<p>
													<?php 
													    if(strlen($singleReview[3]) > 200 )
													    {
													        $str = substr($singleReview[3],0,180);
															        echo $str.". . ."."<a class='read-more-link' type='button' data-toggle='modal' data-target='#myModal".$ct."'>".$this->lang->line('Read More')."</a>";
													    
													    }
													    else echo $str = $singleReview[3];		
													?>
											</p>
										</div>
													
													<div class="testimonial-footer">
														<div class="social-proof">
															<i class="lni lni-checkmark-circle"></i>
															<span><?php echo $this->lang->line("Verified Customer"); ?></span>
														</div>
														<div class="chatwiser-badge">
															<span><?php echo $this->lang->line("chatwiser customer"); ?></span>
														</div>
													</div>
												</div>
											</div>
										</div> <!-- end single testimonial slide -->
								<?php endforeach; ?>
						</div>
							
							<!-- Navigation buttons -->
							<div class="swiper-button-next testimonial-next">
								<i class="lni lni-chevron-right"></i>
					</div>
							<div class="swiper-button-prev testimonial-prev">
								<i class="lni lni-chevron-left"></i>
				</div>
							
							<!-- Pagination -->
							<div class="swiper-pagination testimonial-pagination"></div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Call to Action -->
			<div class="row mt-60">
				<div class="col-xl-8 col-lg-10 mx-auto">
					<div class="testimonials-cta text-center">
						<h3 class="cta-title wow fadeInUp" data-wow-delay=".2s"><?php echo $this->lang->line("Join These Success Stories"); ?></h3>
						<p class="cta-subtitle wow fadeInUp" data-wow-delay=".4s"><?php echo $this->lang->line("Start automating your customer conversations and see results like these businesses."); ?></p>
						<div class="cta-buttons wow fadeInUp" data-wow-delay=".6s">
							<a href="<?php echo site_url('home/sign_up'); ?>" class="main-btn btn-hover <?php if($this->config->item('enable_signup_form') =='0') echo "d-none"; ?>"><?php echo $this->lang->line("Start Your Success Story"); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--====== TESTIMONIAL PART ENDS ======-->

	
	<!--====== PRICING PART START ======-->
	<?php if(!empty($pricing_table_data)) : ?>
	<section id="pricing" class="pricing-area modern-pricing pt-130 pb-100">
		<div class="container">
			<!-- Section Header -->
			<div class="row">
				<div class="col-xl-8 col-lg-10 mx-auto">
					<div class="section-title text-center mb-80">
						<h2 class="title wow fadeInUp" data-wow-delay=".2s"><?php echo $this->lang->line("Simple, Transparent Pricing"); ?></h2>
						<p class="wow fadeInUp" data-wow-delay=".4s"><?php echo $this->lang->line("Choose the perfect plan to automate your customer conversations and grow your business with chatwiser's AI-powered platform."); ?></p>
					</div>
				</div>
			</div>
			
			<!-- Pricing Cards -->
			<div class="row justify-content-center">
				<div class="col-12">
					<div class="pricing-wrapper">
						<div class="row">
							<?php
							$i=0;
							foreach($pricing_table_data as $pack) :    
					            $i++; ?>
								<div class="col-xl-4 col-lg-4 col-md-6 mt-4">
									<div class="single-price modern-price-card text-center <?php if($pack["highlight"]=='1') echo 'featured'; ?> wow fadeInUp" data-wow-delay="<?php echo (.2 + ($i * 0.1)); ?>s">
										<?php if($pack["highlight"]=='1') : ?>
											<div class="popular-badge">
												<span><?php echo $this->lang->line("Most Popular"); ?></span>
										</div>
										<?php endif; ?>
										
										<div class="price-header">
											<div class="price-icon">
												<i class="lni lni-rocket"></i>
											</div>
											<h4 class="package-name"><?php echo $pack["package_name"]; ?></h4>
											<div class="price-amount">
												<span class="currency"><?php echo $curency_icon; ?></span>
												<span class="amount"><?php echo $pack["price"]; ?></span>
												<span class="period">/ <?php echo $pack["validity"]; ?> <?php echo $this->lang->line("days"); ?></span>
											</div>
										</div>

										<div class="price-features">
										    <?php 
										        $module_ids=$pack["module_ids"];
										        $monthly_limit=json_decode($pack["monthly_limit"],true);
										        $module_names_array=$this->basic->execute_query('SELECT module_name,id FROM modules WHERE FIND_IN_SET(id,"'.$module_ids.'") > 0  ORDER BY module_name ASC');

										        // Count total features and get key metrics
										        $total_features = count($module_names_array);
										        $unlimited_count = 0;
										        $key_features = [];
										        
										        foreach ($module_names_array as $row) {
										            $limit = $monthly_limit[$row["id"]] ?? 0;
										            if($limit == "0") $unlimited_count++;
										            
										            // Collect key features with their limits
										            $key_features[] = [
										                'name' => $this->lang->line($row["module_name"]),
										                'limit' => $limit,
										                'id' => $row["id"]
										            ];
										        }
										        
										        // Sort by importance (unlimited first, then by limit size)
										        usort($key_features, function($a, $b) {
										            if($a['limit'] == "0" && $b['limit'] != "0") return -1;
										            if($a['limit'] != "0" && $b['limit'] == "0") return 1;
										            return $b['limit'] - $a['limit'];
										        });
										        
										        // Show top 4-5 most important features
										        $display_features = array_slice($key_features, 0, 5);
										        ?>
										        
										        <!-- Key Metrics Summary -->
										        <div class="feature-summary">
										            <div class="summary-item">
										                <span class="summary-number"><?php echo $total_features; ?></span>
										                <span class="summary-label"><?php echo $this->lang->line("Features Included"); ?></span>
										            </div>
										            <?php if($unlimited_count > 0): ?>
										            <div class="summary-item">
										                <span class="summary-number"><?php echo $unlimited_count; ?></span>
										                <span class="summary-label"><?php echo $this->lang->line("Unlimited Features"); ?></span>
										            </div>
										            <?php endif; ?>
										        </div>

											<!-- Top Features List -->
											<div class="top-features">
											    <h6 class="features-title"><?php echo $this->lang->line("Key Features"); ?></h6>
											    <ul class="feature-list">
										        <?php foreach ($display_features as $feature) : ?>
										        <li class="feature-item">
										            <div class="feature-icon">
										            	<i class="lni lni-checkmark-circle"></i>
										            </div>
										            <div class="feature-content">
										            <?php 
											                $limit = $feature['limit'];
											                if($limit == "0") {
											                    $limit_display = "<span class='unlimited'>".$this->lang->line("unlimited")."</span>";
											                } else {
											                    $limit_display = "<span class='limit'>".$limit."</span>";
											                    if($feature['id'] != "1" && $limit != "0") {
											                        $limit_display .= "<span class='per-month'>/".$this->lang->line("month")."</span>";
											                    }
											                }
											                
											                echo "<span class='feature-name'>".$feature['name']."</span>";
											                echo "<span class='feature-limit'>". $limit_display."</span>";
											            ?>
											        </div>
										        </li>
										    <?php endforeach; ?>
										        
										        <?php if($total_features > 5): ?>
										        <li class="feature-item more-features">
										            <div class="feature-icon">
										            	<i class="lni lni-plus"></i>
										            </div>
										            <div class="feature-content">
										                <span class="feature-name"><?php echo ($total_features - 5) . " " . $this->lang->line("more features"); ?></span>
										                <button class="view-all-btn" onclick="toggleFeatures(<?php echo $i; ?>)"><?php echo $this->lang->line("View All"); ?></button>
										            </div>
										        </li>
										        <?php endif; ?>
										</ul>
										    
										    <!-- Collapsible Full Features List -->
										    <?php if($total_features > 5): ?>
										    <div class="all-features" id="allFeatures<?php echo $i; ?>" style="display: none;">
										        <ul class="complete-feature-list">
										        <?php foreach ($module_names_array as $row) : ?>
										        <li class="complete-feature-item">
										            <i class="lni lni-checkmark-circle"></i>
										            <?php 
										                $limit = $monthly_limit[$row["id"]] ?? 0;
										                $feature_name = $this->lang->line($row["module_name"]);
										                if($limit == "0") {
										                    echo $feature_name . " - <span class='unlimited'>".$this->lang->line("unlimited")."</span>";
										                } else {
										                    $limit_text = $limit;
										                    if($row["id"] != "1" && $limit != "0") {
										                        $limit_text .= "/".$this->lang->line("month");
										                    }
										                    echo $feature_name . " - <span class='limit'>".$limit_text."</span>";
										                }
										            ?>
										        </li>
										        <?php endforeach; ?>
										        </ul>
										    </div>
										    <?php endif; ?>
										</div>
										</div>
										<div class="price-action">
											<a href="<?php echo site_url('home/sign_up'); ?>" class="price-btn <?php if($pack["highlight"]=='1') echo 'featured-btn'; else echo 'standard-btn'; ?> <?php if($this->config->item('enable_signup_form') == '0') echo "d-none"; ?>">
												<?php echo $this->lang->line("Get Started"); ?>
												<i class="lni lni-arrow-right"></i>
											</a>
											<p class="trial-info"><?php echo $this->lang->line("Free trial included"); ?></p>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Additional Info -->
			<div class="row mt-60">
				<div class="col-xl-10 col-lg-10 mx-auto">
					<div class="pricing-footer text-center">
						<h4 class="footer-title wow fadeInUp" data-wow-delay=".2s"><?php echo $this->lang->line("All Plans Include"); ?></h4>
						<div class="row mt-40">
							<div class="col-md-4">
								<div class="pricing-feature wow fadeInUp" data-wow-delay=".3s">
									<i class="lni lni-support"></i>
									<h6><?php echo $this->lang->line("24/7 Support"); ?></h6>
									<p><?php echo $this->lang->line("Expert assistance whenever you need it"); ?></p>
								</div>
							</div>
							<div class="col-md-4">
								<div class="pricing-feature wow fadeInUp" data-wow-delay=".4s">
									<i class="lni lni-shield"></i>
									<h6><?php echo $this->lang->line("Enterprise Security"); ?></h6>
									<p><?php echo $this->lang->line("Bank-level security for your data"); ?></p>
								</div>
							</div>
							<div class="col-md-4">
								<div class="pricing-feature wow fadeInUp" data-wow-delay=".5s">
									<i class="lni lni-reload"></i>
									<h6><?php echo $this->lang->line("Regular Updates"); ?></h6>
									<p><?php echo $this->lang->line("Continuous feature improvements"); ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>
	<!--====== PRICING PART ENDS ======-->

	<!--====== FAQ SECTION START ======-->
	<section id="faq" class="faq-area modern-faq-section pt-130 pb-130">
		<div class="container">
			<!-- Section Header -->
				<div class="row">
				<div class="col-xl-8 col-lg-10 mx-auto">
					<div class="section-title text-center mb-80">
						<h2 class="title wow fadeInUp" data-wow-delay=".2s"><?php echo $this->lang->line("Frequently Asked Questions"); ?></h2>
						<p class="wow fadeInUp" data-wow-delay=".4s"><?php echo $this->lang->line("Find answers to common questions about chatwiser's AI-powered automation platform."); ?></p>
					</div>
				</div>
							</div>
							    
			<div class="row justify-content-center">
				<div class="col-xl-10 col-lg-12">
					<div class="faq-wrapper modern-faq">
						<div class="faq-accordion modern-accordion">
							<div class="accordion" id="modernAccordion">
								<!-- FAQ 1 -->
								<div class="single-accordion wow fadeInUp" data-wow-delay=".3s">
									<div class="accordion-btn">
										<button class="btn-block text-left collapsed" type="button" data-toggle="collapse"
											data-target="#faq1" aria-expanded="false" aria-controls="faq1">
											<span><?php echo $this->lang->line("How quickly can I see results with chatwiser?"); ?></span>
											<i class="lni lni-chevron-down"></i>
										</button>
							</div>
									<div id="faq1" class="collapse" aria-labelledby="faq1" data-parent="#modernAccordion">
										<div class="accordion-content">
											<?php echo $this->lang->line("Most businesses see immediate improvements in response time once chatwiser is activated. You'll start automating conversations within hours of setup, and typically see 300% faster response rates and increased customer engagement within the first week."); ?>
						</div>
					</div>
						</div>

								<!-- FAQ 2 -->
								<div class="single-accordion wow fadeInUp" data-wow-delay=".4s">
									<div class="accordion-btn">
										<button class="btn-block text-left collapsed" type="button" data-toggle="collapse"
											data-target="#faq2" aria-expanded="false" aria-controls="faq2">
											<span><?php echo $this->lang->line("Is my customer data secure?"); ?></span>
											<i class="lni lni-chevron-down"></i>
										</button>
					</div>
									<div id="faq2" class="collapse" aria-labelledby="faq2" data-parent="#modernAccordion">
										<div class="accordion-content">
											<?php echo $this->lang->line("Absolutely. chatwiser uses enterprise-grade security with SSL encryption, GDPR compliance, and bank-level data protection. Your customer conversations are stored securely and never shared with third parties."); ?>
				</div>
			</div>
		</div>

								<!-- FAQ 3 -->
								<div class="single-accordion wow fadeInUp" data-wow-delay=".5s">
									<div class="accordion-btn">
										<button class="btn-block text-left collapsed" type="button" data-toggle="collapse"
											data-target="#faq3" aria-expanded="false" aria-controls="faq3">
											<span><?php echo $this->lang->line("Do I need technical skills to set up chatwiser?"); ?></span>
											<i class="lni lni-chevron-down"></i>
										</button>
									</div>
									<div id="faq3" class="collapse" aria-labelledby="faq3" data-parent="#modernAccordion">
										<div class="accordion-content">
											<?php echo $this->lang->line("Not at all! chatwiser is designed for business owners, not developers. Our intuitive drag-and-drop interface lets you set up AI conversations in minutes. Plus, our support team provides free setup assistance if needed."); ?>
										</div>
									</div>
								</div>

								<!-- FAQ 4 -->
								<div class="single-accordion wow fadeInUp" data-wow-delay=".6s">
									<div class="accordion-btn">
										<button class="btn-block text-left collapsed" type="button" data-toggle="collapse"
											data-target="#faq4" aria-expanded="false" aria-controls="faq4">
											<span><?php echo $this->lang->line("Can I customize the AI responses for my specific business?"); ?></span>
											<i class="lni lni-chevron-down"></i>
										</button>
									</div>
									<div id="faq4" class="collapse" aria-labelledby="faq4" data-parent="#modernAccordion">
										<div class="accordion-content">
											<?php echo $this->lang->line("Yes! chatwiser learns your brand voice and can be trained with your specific products, services, and business information. You can customize responses, set conversation flows, and even define escalation rules for complex inquiries."); ?>
										</div>
									</div>
								</div>

								<!-- FAQ 5 -->
								<div class="single-accordion wow fadeInUp" data-wow-delay=".7s">
									<div class="accordion-btn">
										<button class="btn-block text-left collapsed" type="button" data-toggle="collapse"
											data-target="#faq5" aria-expanded="false" aria-controls="faq5">
											<span><?php echo $this->lang->line("What social media platforms does chatwiser support?"); ?></span>
											<i class="lni lni-chevron-down"></i>
										</button>
									</div>
									<div id="faq5" class="collapse" aria-labelledby="faq5" data-parent="#modernAccordion">
										<div class="accordion-content">
											<?php echo $this->lang->line("Currently, chatwiser supports Facebook Messenger and Instagram Direct Messages. WhatsApp Business integration is coming soon. All platforms are managed from one unified dashboard for seamless conversation management."); ?>
										</div>
									</div>
									</div>

								<!-- FAQ 6 -->
								<div class="single-accordion wow fadeInUp" data-wow-delay=".8s">
									<div class="accordion-btn">
										<button class="btn-block text-left collapsed" type="button" data-toggle="collapse"
											data-target="#faq6" aria-expanded="false" aria-controls="faq6">
											<span><?php echo $this->lang->line("Can I try chatwiser before committing to a paid plan?"); ?></span>
											<i class="lni lni-chevron-down"></i>
										</button>
									</div>
									<div id="faq6" class="collapse" aria-labelledby="faq6" data-parent="#modernAccordion">
										<div class="accordion-content">
											<?php echo $this->lang->line("Yes! chatwiser offers a free trial so you can experience the platform before making any commitment. You can test all features and see how our AI automation works for your business."); ?>
										</div>
									</div>
								</div>

								<!-- FAQ 7 -->
								<div class="single-accordion wow fadeInUp" data-wow-delay=".9s">
									<div class="accordion-btn">
										<button class="btn-block text-left collapsed" type="button" data-toggle="collapse"
											data-target="#faq7" aria-expanded="false" aria-controls="faq7">
											<span><?php echo $this->lang->line("What if chatwiser gives wrong information to my customers?"); ?></span>
											<i class="lni lni-chevron-down"></i>
										</button>
									</div>
									<div id="faq7" class="collapse" aria-labelledby="faq7" data-parent="#modernAccordion">
										<div class="accordion-content">
											<?php echo $this->lang->line("chatwiser includes smart escalation features that automatically transfer complex inquiries to human agents. You can also set up approval workflows for sensitive topics and train the AI with your specific business information to ensure accurate responses."); ?>
										</div>
									</div>
									</div>

								<!-- FAQ 8 -->
								<div class="single-accordion wow fadeInUp" data-wow-delay="1s">
									<div class="accordion-btn">
										<button class="btn-block text-left collapsed" type="button" data-toggle="collapse"
											data-target="#faq8" aria-expanded="false" aria-controls="faq8">
											<span><?php echo $this->lang->line("How does billing work? Can I cancel anytime?"); ?></span>
											<i class="lni lni-chevron-down"></i>
										</button>
									</div>
									<div id="faq8" class="collapse" aria-labelledby="faq8" data-parent="#modernAccordion">
										<div class="accordion-content">
											<?php echo $this->lang->line("Billing is monthly or annual with discounts for annual plans. You can upgrade, downgrade, or cancel anytime from your dashboard. No long-term contracts or cancellation fees. If you cancel, you keep access until the end of your billing period."); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Call to Action -->
			<div class="row mt-60">
				<div class="col-xl-8 col-lg-10 mx-auto">
					<div class="faq-cta text-center">
						<h3 class="cta-title wow fadeInUp" data-wow-delay=".2s"><?php echo $this->lang->line("Still have questions?"); ?></h3>
						<p class="cta-subtitle wow fadeInUp" data-wow-delay=".4s"><?php echo $this->lang->line("Our support team is here to help you get started with chatwiser."); ?></p>
						<div class="cta-buttons wow fadeInUp" data-wow-delay=".6s">
							<a href="#contact" class="main-btn btn-hover page-scroll"><?php echo $this->lang->line("Contact Support"); ?></a>
							<a href="<?php echo site_url('home/sign_up'); ?>" class="btn-outline <?php if($this->config->item('enable_signup_form') =='0') echo "d-none"; ?>"><?php echo $this->lang->line("Start Free Trial"); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--====== FAQ SECTION END ======-->

	<!--====== CONTACT PART START ======-->
	<section id="contact" class="contact-area modern-contact pt-130 pb-130">
		<div class="container">
			<!-- Section Header -->
			<div class="row">
				<div class="col-xl-8 col-lg-10 mx-auto">
					<div class="section-title text-center mb-80">
						<h2 class="title wow fadeInUp" data-wow-delay=".2s"><?php echo $this->lang->line("Get in Touch"); ?></h2>
						<p class="wow fadeInUp" data-wow-delay=".4s"><?php echo $this->lang->line("Ready to transform your customer engagement? Our team is here to help you get started with chatwiser."); ?></p>
					</div>
				</div>
			</div>

			<div class="row justify-content-center">
				<!-- Contact Form -->
				<div class="col-xl-8 col-lg-10">
					<div class="contact-form-wrapper modern-contact-form">
						<div class="contact-header">
							<div class="brand-accent">
								<i class="lni lni-envelope"></i>
							</div>
							<h4 class="contact-title wow fadeInUp" data-wow-delay=".3s"><?php echo $this->lang->line("Send us a Message"); ?></h4>
							<p class="contact-subtitle wow fadeInUp" data-wow-delay=".4s"><?php echo $this->lang->line("Tell us about your business and how we can help you automate your customer conversations."); ?></p>
							
							<!-- Contact Info -->
							<div class="contact-info-cards wow fadeInUp" data-wow-delay=".5s">
								<div class="info-card">
									<div class="info-icon">
										<i class="lni lni-timer"></i>
									</div>
									<div class="info-content">
										<span class="info-label"><?php echo $this->lang->line("Response Time"); ?></span>
										<span class="info-value"><?php echo $this->lang->line("Within 2 hours"); ?></span>
									</div>
								</div>
								<div class="info-card">
									<div class="info-icon">
										<i class="lni lni-support"></i>
									</div>
									<div class="info-content">
										<span class="info-label"><?php echo $this->lang->line("Support Hours"); ?></span>
										<span class="info-value"><?php echo $this->lang->line("24/7 Available"); ?></span>
									</div>
								</div>
								<div class="info-card">
									<div class="info-icon">
										<i class="lni lni-shield"></i>
									</div>
									<div class="info-content">
										<span class="info-label"><?php echo $this->lang->line("Security"); ?></span>
										<span class="info-value"><?php echo $this->lang->line("Enterprise Grade"); ?></span>
									</div>
								</div>
							</div>
						</div>
						
                        <?php 
							if($this->session->userdata('mail_sent') == 1) {
							echo "<div class='alert alert-success'>".$this->lang->line("We have received your email. We will contact you through email as soon as possible.")."</div>";
							$this->session->unset_userdata('mail_sent');
							}
						?>
						<form action="<?php echo site_url("home/email_contact"); ?>" method="post" class="contact-form modern-form wow fadeInUp" data-wow-delay=".6s">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="email"><?php echo $this->lang->line("Your Email"); ?></label>
										<input type="email" class="form-control" required id="email" <?php echo set_value("email"); ?> placeholder="<?php echo $this->lang->line("Enter your email address");?>" name="email">
										<span class="text-danger"><?php echo form_error("email"); ?></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="subject"><?php echo $this->lang->line("Subject"); ?></label>
										<input type="text" class="form-control" required id="subject" <?php echo set_value("subject"); ?> placeholder="<?php echo $this->lang->line("What can we help you with?");?>" name="subject">		
									 <span class="text-danger"><?php echo form_error("subject"); ?></span>							
								</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label for="message"><?php echo $this->lang->line("Your Message"); ?></label>
										<textarea class="form-control" rows="4" required id="message" <?php echo set_value("message"); ?> placeholder="<?php echo $this->lang->line("Tell us about your business and how we can help...");?>" name="message"></textarea>
										<span class="text-danger"><?php echo form_error("message") ?></span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="captcha"><?php echo $this->lang->line("Security Check"); ?></label>
										<input type="number" class="form-control" step="1" required id="captcha" <?php echo set_value("captcha"); ?> placeholder="<?php echo $contact_num1. "+". $contact_num2." = ?"; ?>" name="captcha">	
									<span class="text-danger">
										<?php if(form_error('captcha')) echo form_error('captcha'); 
										else  
										{ 
											echo $this->session->userdata("contact_captcha_error"); 
											$this->session->unset_userdata("contact_captcha_error"); 
										} 
										?>
									</span>								

										<!-- Trust Indicators -->
										<div class="form-trust mt-3">
											<div class="trust-badges">
												<div class="trust-badge">
													<i class="lni lni-users"></i>
													<span><span class="trust-count" data-count="10000">0</span>+ <?php echo $this->lang->line("Users"); ?></span>
								</div>
												<div class="trust-badge">
													<i class="lni lni-star-filled"></i>
													<span>4.9/5 <?php echo $this->lang->line("Rating"); ?></span>
							</div>
											</div>
										</div>							
									</div>
								</div>
							</div>
							
							<div class="form-actions">
								<button class="contact-btn main-btn btn-hover" type="submit">
									<span class="btn-icon"><i class="lni lni-envelope"></i></span>
									<span class="btn-text"><?php echo $this->lang->line("Send Message");?></span>
								</button>
								<div class="form-note">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("We'll get back to you within 2 hours"); ?></span>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--====== CONTACT PART ENDS ======-->



	<!--====== FOOTER PART START ======-->
	<?php 
	    $facebook = $this->config->item('facebook');
	    $twitter  = $this->config->item('twitter');
	    $linkedin = $this->config->item('linkedin');
	    $youtube  = $this->config->item('youtube');

	    if($facebook=='' && $twitter=='' && $linkedin=='' && $youtube=='') $cls='d-none';
	?>
	<footer id="footer" class="footer-area modern-footer">
		<div class="container">
			<!-- Main Footer Content -->
			<div class="footer-content">
			<div class="row">
					<!-- Brand Column -->
					<div class="col-xl-4 col-lg-4 col-md-6">
						<div class="footer-widget brand-widget wow fadeInUp" data-wow-delay=".2s">
							<div class="footer-logo">
								<img src="<?php echo base_url();?>assets/img/logo-white.png" alt="chatwiser" class="logo">
					</div>
							<p class="brand-description"><?php echo $this->lang->line("Automate your customer conversations with AI-powered chatwiser. Never miss another customer while you sleep."); ?></p>
							
							<!-- Trust Badges -->
							<div class="footer-trust">
								<div class="trust-stats">
									<div class="trust-stat">
										<span class="trust-number"><span class="trust-count" data-count="10000">0</span>+</span>
										<span class="trust-label"><?php echo $this->lang->line("Active Users"); ?></span>
				</div>
									<div class="trust-stat">
										<span class="trust-number">4.9/5</span>
										<span class="trust-label"><?php echo $this->lang->line("Rating"); ?></span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Quick Links -->
					<div class="col-xl-2 col-lg-2 col-md-6">
						<div class="footer-widget links-widget wow fadeInUp" data-wow-delay=".4s">
							<h4 class="widget-title"><?php echo $this->lang->line("Product"); ?></h4>
							<ul class="footer-links">
								<li><a href="#feature" class="page-scroll"><?php echo $this->lang->line("Features"); ?></a></li>
							<li><a href="#pricing" class="page-scroll"><?php echo $this->lang->line("Pricing"); ?></a></li>
								<li><a href="#faq" class="page-scroll"><?php echo $this->lang->line("FAQ"); ?></a></li>
								<li><a href="<?php echo site_url('home/sign_up'); ?>" class="<?php if($this->config->item('enable_signup_form') =='0') echo "d-none"; ?>"><?php echo $this->lang->line("Sign Up"); ?></a></li>
							</ul>
						</div>
					</div>

					<!-- Support -->
					<div class="col-xl-2 col-lg-2 col-md-6">
						<div class="footer-widget links-widget wow fadeInUp" data-wow-delay=".6s">
							<h4 class="widget-title"><?php echo $this->lang->line("Support"); ?></h4>
							<ul class="footer-links">
								<li><a href="#contact" class="page-scroll"><?php echo $this->lang->line("Contact Us"); ?></a></li>
							<li><a href="<?php echo base_url('home/privacy_policy'); ?>" target="_blank"><?php echo $this->lang->line("Privacy Policy"); ?></a></li>
							<li><a href="<?php echo base_url('home/terms_use'); ?>" target="_blank"><?php echo $this->lang->line("Terms of Service"); ?></a></li>
							<li><a href="<?php echo base_url('home/gdpr'); ?>" target="_blank"><?php echo $this->lang->line("GDPR Compliant"); ?></a></li>	
						</ul>
					</div>
				</div>

					<!-- Contact Info -->
					<div class="col-xl-4 col-lg-4 col-md-6">
						<div class="footer-widget contact-widget wow fadeInUp" data-wow-delay=".8s">
							<h4 class="widget-title"><?php echo $this->lang->line("Get in Touch"); ?></h4>
							
							<div class="contact-info">
								<?php if(!empty($this->config->item('institute_email'))): ?>
								<div class="contact-item">
									<div class="contact-icon">
										<i class="lni lni-envelope"></i>
					</div>
									<div class="contact-details">
										<span class="contact-label"><?php echo $this->lang->line("Email"); ?></span>
										<a href="mailto:<?php echo $this->config->item('institute_email'); ?>" class="contact-value"><?php echo $this->config->item('institute_email'); ?></a>
				</div>				
			</div>
								<?php endif; ?>

								<?php if(!empty($this->config->item('institute_mobile'))): ?>
								<div class="contact-item">
									<div class="contact-icon">
										<i class="lni lni-phone"></i>
			</div>
									<div class="contact-details">
										<span class="contact-label"><?php echo $this->lang->line("Phone"); ?></span>
										<a href="tel:<?php echo $this->config->item('institute_mobile'); ?>" class="contact-value"><?php echo $this->config->item('institute_mobile'); ?></a>
		</div>
								</div>
								<?php endif; ?>

								<?php if(!empty($this->config->item('institute_address2'))): ?>
								<div class="contact-item">
									<div class="contact-icon">
										<i class="lni lni-map-marker"></i>
									</div>
									<div class="contact-details">
										<span class="contact-label"><?php echo $this->lang->line("Address"); ?></span>
										<span class="contact-value"><?php echo $this->config->item('institute_address2'); ?></span>
									</div>
								</div>
								<?php endif; ?>
							</div>

							<!-- Social Links -->
							<div class="social-links <?php if(isset($cls)) echo $cls; ?>">
								<div class="social-icons">
									<?php if($facebook!=''): ?>
									<a href="<?php echo $facebook; ?>" target="_blank" class="social-icon facebook" title="Facebook">
										<i class="lni lni-facebook-original"></i>
									</a>
									<?php endif; ?>
									<?php if($twitter!=''): ?>
									<a href="<?php echo $twitter; ?>" target="_blank" class="social-icon twitter" title="Twitter">
										<i class="lni lni-twitter-original"></i>
									</a>
									<?php endif; ?>
									<?php if($linkedin!=''): ?>
									<a href="<?php echo $linkedin; ?>" target="_blank" class="social-icon linkedin" title="LinkedIn">
										<i class="lni lni-linkedin-original"></i>
									</a>
									<?php endif; ?>
									<?php if($youtube!=''): ?>
									<a href="<?php echo $youtube; ?>" target="_blank" class="social-icon youtube" title="YouTube">
										<i class="lni lni-youtube"></i>
									</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Footer Bottom -->
			<div class="footer-bottom">
				<div class="row align-items-center">
					<div class="col-md-6">
						<div class="copyright">
							<p>&copy; <?php echo date('Y'); ?> <a href="<?php echo site_url(); ?>"><?php echo $this->config->item("institute_address1") ? $this->config->item("institute_address1") : 'chatwiser'; ?></a>. <?php echo $this->lang->line("All rights reserved."); ?></p>
	        </div>
	    </div>
					<div class="col-md-6">
						<div class="footer-security">
							<div class="security-badges">
								<div class="security-badge">
									<i class="lni lni-shield"></i>
									<span><?php echo $this->lang->line("SSL Secured"); ?></span>
								</div>
								<div class="security-badge">
									<i class="lni lni-checkmark-circle"></i>
									<span><?php echo $this->lang->line("GDPR Compliant"); ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!-- Cookie Alert -->
	<?php if($this->session->userdata('allow_cookie')!='yes') : ?>
	<div class="cookie-alert modern-cookie-alert">
		<div class="cookie-container">
			<div class="cookie-content">
				<div class="cookie-icon">
					<i class="lni lni-cake"></i>
				</div>
				<div class="cookie-text">
					<h6><?php echo $this->lang->line("We use cookies"); ?></h6>
					<p><?php echo $this->lang->line("This site uses cookies to improve your experience and analyze site usage. By continuing to use this site, you agree to our use of cookies."); ?></p>
				</div>
			</div>
			<div class="cookie-actions">
				<a href="<?php echo base_url('home/privacy_policy#cookie_policy');?>" class="cookie-link"><?php echo $this->lang->line("Learn more"); ?></a>
				<button type="button" class="accept-cookies modern-btn"><?php echo $this->lang->line("Accept All"); ?></button>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<!--====== FOOTER PART ENDS ======-->

	<!--====== BACK TOP TOP PART START ======-->
	<a href="#" class="back-to-top btn-hover"><i class="lni lni-chevron-up"></i></a>
	<!--====== BACK TOP TOP PART ENDS ======-->


	<script type="text/javascript">

		var base_url = "<?php echo base_url();?>";
	</script>

	<!--====== jQuery js ======-->
	<script src="<?php echo base_url('assets/modern/js/jquery-1.12.4.min.js');?>"></script>

	<!--====== Bootstrap js ======-->
	<script src="<?php echo base_url('assets/modern/js/bootstrap.bundle-5.0.0.alpha-min.js');?>"></script>

	<!--====== Tiny slider js ======-->
	<script src="<?php echo base_url('assets/modern/js/tiny-slider.js');?>"></script>

	<!--====== Swiper slider js ======-->
	<script src="<?php echo base_url('assets/modern/js/swiper.min.js');?>"></script>

	<!--====== glightbox js ======-->
	<script src="<?php echo base_url('assets/modern/js/glightbox.min.js');?>"></script>

	<!--====== wow js ======-->
	<script src="<?php echo base_url('assets/modern/js/wow.min.js');?>"></script>

	<!--====== count-up js ======-->
	<script src="<?php echo base_url('assets/modern/js/count-up.min.js');?>"></script>

	<!--====== contact form js ======-->
	<script src="<?php echo base_url('assets/modern/js/contact-form.js');?>"></script>

	<!--====== Main js ======-->
	<script src="<?php echo base_url('assets/modern/js/main.js');?>"></script>

	<!--====== Counter Animation js ======-->
	<script src="<?php echo base_url('assets/modern/js/counter-animation.js');?>"></script>

	<script src="<?php echo base_url('assets/js/system/site_default.js');?>"></script>

	<!-- Pricing Features Toggle Script -->
	<script>
		function toggleFeatures(cardId) {
			const allFeatures = document.getElementById('allFeatures' + cardId);
			const button = event.target;
			
			if (allFeatures.style.display === 'none' || allFeatures.style.display === '') {
				allFeatures.style.display = 'block';
				button.textContent = '<?php echo $this->lang->line("Hide"); ?>';
			} else {
				allFeatures.style.display = 'none';
				button.textContent = '<?php echo $this->lang->line("View All"); ?>';
			}
		}
	</script>

	<?php $this->load->view("include/fb_px"); ?> 
    <?php $this->load->view("include/google_code"); ?> 

    <?php if($is_rtl) { ?>
    	<style type="text/css">
    		.hero-area .hero-img .img-screen.screen-2 {
    		  bottom: 60px;
    		  left: -220px !important;
    		}

    		@media only screen and (min-width: 1200px) and (max-width: 1399px) {
    		  .hero-area .hero-img .img-screen.screen-2 {
    		    bottom: 180px;
    		    left: -276px !important;
    		}

    		@media only screen and (min-width: 992px) and (max-width: 1199px) {
    		  .hero-area .hero-img .img-screen.screen-2 {
    		    bottom: 180px;
    		    left: -276px !important;
    		  }
    		}
    	</style>
    <?php } ?>

    <?php if(!$is_rtl) { ?>
    	<style type="text/css">
    		.hero-area .hero-img .img-screen.screen-2 {
    		  bottom: 60px;
    		  right: -220px;
    		}

    		@media only screen and (min-width: 1200px) and (max-width: 1399px) {
    		  .hero-area .hero-img .img-screen.screen-2 {
    		    bottom: 180px;
    		    right: -276px;
    		  }
    		}

    		@media only screen and (min-width: 992px) and (max-width: 1199px) {
    		  .hero-area .hero-img .img-screen.screen-2 {
    		    bottom: 180px;
    		    right: -276px;
    		  }
    		}
    	</style>
    <?php } ?>

</body>

</html>


<!-- Modal -->
<?php   
    $ct=0;
    foreach($customerReview as $singleReview) : 
        $ct++;
        $original = $singleReview[2];
        $base     = base_url();

        if (substr($original, 0, 4) != 'http') {
            $img = $base.$original;
        } else {
           $img = $original;
        }
	?>
    <div class="modal fade" id="myModal<?php echo $ct; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-lg" role="document">
        <!-- Modal content-->
        <div class="modal-content">
        	<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('Full Review'); ?></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		     </div>
            
            <div class="modal-body name-and-designation  mt-2">
            	<div class="single-item mt-1 text-center">
            	    <div class="member-image">
            	        <img class="rounded-circle img-thumbnail" src="<?php echo $img; ?>" alt="reviewer">
            	    </div>
	                <h4 class="mt-2"><?php echo $singleReview[0]; ?></h4>
	                <p><?php echo $singleReview[1]; ?></p><br>
	                <p class="text-small text-justify"><small><?php echo $singleReview[3]; ?></small></p>
                </div>
        	</div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
            </div>
        </div>

      </div>
    </div>
	<?php endforeach;
?>