<style>
	.card { padding-top: 0 !important; }
	.card .media-body .media-title { margin-bottom: 0px !important; }
	.card .media-body .page_email { line-height: 12px !important; }
	.card .page_delete { margin-top:10px;margin-right:10px; padding: .1rem .5rem !important; }
	.card .right-button { margin-top:10px;margin-right:10px; padding: .1rem .5rem !important; }
	.card .enable_webhook { margin-top:10px; padding: .1rem .5rem !important; }
	.card .disable_webhook { margin-top:10px; padding: .1rem .5rem !important; }
	/* .profile-widget-header {margin-bottom: -18px !important;} */
	/* .profile-widget-header img { margin: -20px -5px 0 22px !important; } */
	/* .profile-widget-header h6 { text-align: left;margin-left: 20px; } */
	/*.profile-widget-header .delete_account { position: absolute;top:10px;right:10px;}*/
	.profile-widget .profile-widget-items:after{position: relative;}
	.list-unstyled .media{padding-right:10px;} 

	/* .profile-widget-item{border:none;} */
	.btn-circle{margin:0 !important;}

	@media (max-width: 575.98px)
	{
		.profile-widget { margin-top: 0 !important; }
	}

	.update_account {cursor: pointer;}
	
</style>
<style type="text/css">
.profile-widget .profile-widget-items .profile-widget-item{
	text-align: left !important;
	padding-left: 20px !important;
}
</style>

<!-- Chatwiser Connect Accounts Enhanced Styling -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/chatwiser-connect-accounts.css">

<?php $fb_login_button=str_replace("ThisIsTheLoginButtonForFacebook",$this->lang->line("Login with Facebook"), $fb_login_button); ?>

<section class="section accounts-import-section">
	<div class="section-header chatwiser-connect-header">
		<div class="header-content">
			<div class="header-main">
				<div class="header-icon">
					<i class="fab fa-facebook-square"></i>
					<i class="fab fa-instagram"></i>
				</div>
				<div class="header-text">
					<h1 class="header-title">
						<?php echo $this->lang->line("Connect Facebook & Instagram") ?>
						<span class="header-badge"><?php echo $this->lang->line("Social Hub"); ?></span>
					</h1>
					<p class="header-subtitle">
						<?php echo $this->lang->line("Connect your social media accounts to unlock powerful automation, messaging, and engagement features"); ?>
					</p>
				</div>
			</div>
		</div>
		
		<!-- Enhanced Status Bar -->
		<div class="status-bar">
			<div class="status-indicator">
				<div class="indicator-icon">
					<i class="fas fa-shield-check"></i>
				</div>
				<div class="indicator-content">
					<span class="indicator-title"><?php echo $this->lang->line("Secure Connection"); ?></span>
					<span class="indicator-subtitle"><?php echo $this->lang->line("Your data is protected with enterprise-grade security"); ?></span>
				</div>
			</div>
			<div class="connection-flow">
				<div class="flow-step active">
					<div class="step-icon"><i class="fas fa-user-check"></i></div>
					<span class="step-label"><?php echo $this->lang->line("Authenticate"); ?></span>
				</div>
				<div class="flow-arrow"><i class="fas fa-arrow-right"></i></div>
				<div class="flow-step">
					<div class="step-icon"><i class="fas fa-download"></i></div>
					<span class="step-label"><?php echo $this->lang->line("Import"); ?></span>
				</div>
				<div class="flow-arrow"><i class="fas fa-arrow-right"></i></div>
				<div class="flow-step">
					<div class="step-icon"><i class="fas fa-rocket"></i></div>
					<span class="step-label"><?php echo $this->lang->line("Activate"); ?></span>
				</div>
			</div>
			<div class="security-badges">
				<div class="badge-item">
					<i class="fab fa-facebook"></i>
					<span><?php echo $this->lang->line("Official API"); ?></span>
				</div>
				<div class="badge-item">
					<i class="fas fa-lock"></i>
					<span><?php echo $this->lang->line("SSL Encrypted"); ?></span>
				</div>
			</div>
		</div>
	</div>

	<?php 
		if($this->session->userdata('success_message') == 'success')
		{
			echo '<div class="alert alert-success" role="alert">
					  <h4 class="alert-heading">'.$this->lang->line('Well Done!').'</h4>
					  <p>'.$this->lang->line('Your account has been imported successfully.').'</p>
					  <p class="mb-0">'.$this->lang->line('Whenever you need to refresh access token or sync new data just login with Facebook again.').'</p>
					</div><br/>';
			$this->session->unset_userdata('success_message');
		}

		if($this->session->userdata('limit_cross') != '')
		{
			echo "<div class='alert alert-danger text-center'><i class='fas fa-times'></i> ".$this->session->userdata('limit_cross')."</div><br/>";
			$this->session->unset_userdata('limit_cross');
		}
		$is_demo=$this->is_demo;

		if($show_import_account_box==0)
		{						
			echo "<div class='alert alert-danger text-center'><i class='fas fa-times-circle'></i>". $this->lang->line('Due to system configuration change you have to delete one or more imported Facebook accounts and import again. Please check the following accounts and delete the account that has warning to delete.')."</div><br>";			
		}

		if($is_demo && $this->session->userdata("user_type")=="Admin")  
		{
			echo '<div class="alert alert-warning text-center">Account import has been disabled in admin account because you will not be able to unlink the Facebook account you import as admin. If you want to test with your own accout then <a href="'.base_url('home/sign_up').'" target="_BLANK">sign up</a> to create your own demo account then import your Facebook account there.</div>';
		}
		
	?>
	
	<div class="section-body">
		<?php
		if($existing_accounts != '0') {?>	
			<div class="float-right">
				<p data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line("You must be logged in your facebook account for which you want to refresh your access token. for synch your new page, simply refresh your token. if any access token is restricted for any action, refresh your access token.");?>"> <?php if($this->config->item('developer_access') != '1') echo $fb_login_button; ?></p>
			</div>
	    <?php } ?>

	    <div class="clearfix"></div>

		<?php if($existing_accounts != '0') : ?>		
		<div class="accounts-import-section">
			<div class="accounts-container">			
				<div class="row">
				<?php $i=0; foreach($existing_accounts as $value) : ?>
					<div class="col-12">
						
						<?php $profile_picture="https://graph.facebook.com/me/picture?access_token={$value['user_access_token']}&width=150&height=150"; ?>

				    	<div class="card enhanced-account-card">
				    		<div class="account-card-header">
				    			<div class="account-profile-section">
				    				<div class="profile-avatar">
				    					<img src="<?php echo $profile_picture; ?>" class="account-avatar-image">
				    					<div class="avatar-status-indicator active">
				    						<i class="fas fa-check"></i>
				    					</div>
				    				</div>
				    				<div class="profile-info">
				    					<div class="account-name">
				    						<h4 class="user-name"><?php echo $value['name']; ?></h4>
				    						<span class="account-type"><?php echo $this->lang->line("Facebook Account"); ?></span>
				    					</div>
				    					<div class="account-stats">
				    						<div class="stat-item">
				    							<i class="fab fa-facebook-square"></i>
				    							<span class="stat-value"><?php echo count($value['page_list']); ?></span>
				    							<span class="stat-label"><?php echo $this->lang->line("pages"); ?></span>
				    						</div>
    		                        	<?php if($this->config->item('facebook_poster_group_enable_disable')=='1') :?>
				    						<div class="stat-item">
				    							<i class="fas fa-users"></i>
				    							<span class="stat-value"><?php echo count($value['group_list']); ?></span>
				    							<span class="stat-label"><?php echo $this->lang->line("groups"); ?></span>
				    						</div>
	    		                        <?php endif; ?>
    		                        </div>
				    				</div>
				    			</div>
				    			<div class="account-actions">
				    				<div class="search-section">
				    					<div class="search-wrapper">
				    						<i class="fas fa-search"></i>
				    						<input type="text" class="enhanced-search-input" onkeyup="search_in_class(this,'page_list_ul')" placeholder="<?php echo $this->lang->line('Search pages'); ?>...">
				    					</div>
				    				</div>
				    				<div class="action-buttons">
				    					<button class="action-btn unlink-btn delete_account" table_id="<?php echo $value['userinfo_table_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line("Do you want to remove this account from our database? you can import again.");?>">
				    						<i class="fas fa-unlink"></i>
				    						<span><?php echo $this->lang->line("Unlink");?></span>
				    					</button>
				    				</div>
				    			</div>
    		                        	</div>
    		                        </div>

						<div class="card enhanced-pages-card">
						  <div class="pages-card-header">
						    <div class="pages-header-content">
						    	<div class="pages-title-section">
						    		<h5 class="pages-title">
						    			<i class="fab fa-facebook-square mr-2"></i>
						    			<?php echo $this->lang->line('Connected Pages') ?>
						    			<span class="pages-count-badge"><?php echo count($value['page_list']); ?></span>
						    		</h5>
						    		<p class="pages-subtitle"><?php echo $this->lang->line("Manage your Facebook pages and their bot connections"); ?></p>
						    	</div>
						    	<div class="pages-actions">
						    		<button class="pages-action-btn" data-toggle="tooltip" title="<?php echo $this->lang->line('Refresh all pages'); ?>">
						    			<i class="fas fa-sync-alt"></i>
						    		</button>
    		                    </div>
    		                </div>

						    <!-- Status Alerts -->
						    <?php if($value['need_to_delete'] == 1) : ?>
						    <div class="status-alert danger">
						    	<div class="alert-icon">
						    		<i class="fas fa-exclamation-triangle"></i>
						    	</div>
						    	<div class="alert-content">
						    		<strong>Action Required:</strong>
						    		<span><?php echo $this->lang->line('you have to delete this account.'); ?></span>
						    	</div>
						    </div>
						    <?php endif; ?>
						    
						    <?php if($value['validity'] == 'no') : ?>
						    <div class="status-alert danger">
						    	<div class="alert-icon">
						    		<i class="fas fa-clock"></i>
						    	</div>
						    	<div class="alert-content">
						    		<strong>Session Expired:</strong>
						    		<span><?php echo $this->lang->line('your login validity has been expired.'); ?></span>
						    	</div>
						    </div>
						    <?php endif; ?>
			    	  	</div>
						
						  <div class="pages-card-body">
						    <div class="pages-grid-container">
						      	<div class="pages-grid">								        
						        	<?php 
						        		foreach($value['page_list'] as $page_info) : ?>
						        		<div class="col-12 col-md-6 col-lg-4 page_list_ul">
							        		<div class="card enhanced-page-card">
							        			<div class="page-card-header">
							        				<div class="page-avatar-section">
							        					<div class="page-avatar">
							        						<img src="<?php echo $page_info['page_profile'];?>" class="page-avatar-image">
							        						<div class="page-status-indicator <?php echo ($page_info['bot_enabled'] == '1') ? 'active' : 'inactive'; ?>">
							        							<i class="fas <?php echo ($page_info['bot_enabled'] == '1') ? 'fa-robot' : 'fa-power-off'; ?>"></i>
							        						</div>
							        					</div>
							        					<div class="page-info">
							        						<h6 class="page-name">
							        							<a href="https://facebook.com/<?php echo $page_info['page_id'];?>" target="_BLANK" class="page-link">
							        								<?php echo $page_info['page_name']; ?>
							        							</a>
							        						</h6>
							        						<div class="page-meta">
							        							<div class="page-email">
							        								<i class="fas fa-at"></i>
							        								<span><?php echo $page_info['page_email']; ?></span>
							        							</div>
							        							<div class="page-id">
							        								<i class="fas fa-hashtag"></i>
							        								<span><?php echo $page_info['page_id']; ?></span>
			        		                    </div>
			        		                      </div>
			        		                  	  </div>
			        		                      </div>
							        				
			        		                      <?php if(isset($page_info['has_instagram']) && $page_info['has_instagram'] == '1') : ?>
							        				<div class="instagram-section">
							        					<div class="instagram-info">
							        						<div class="instagram-badge">
							        							<i class="fab fa-instagram"></i>
							        							<span><?php echo $this->lang->line("Instagram Connected"); ?></span>
							        						</div>
							        						<div class="instagram-username">
							        							<a href="https://www.instagram.com/<?php echo $page_info['insta_username']; ?>" target="_BLANK" class="instagram-link">
							        								@<?php echo $page_info['insta_username']; ?>
							        							</a>
							        							<button class="sync-instagram-btn update_account fas fa-sync-alt" table_id="<?php echo $page_info['id'];?>" title="<?php echo $this->lang->line("Sync Instagram Account");?>" data-toggle="tooltip">
							        								<!-- <i class="fas fa-sync-alt"></i> -->
							        							</button>
							        						</div>
							        					</div>
								              		</div>
									              <?php endif; ?>
							        			</div>
							        			
							        			<div class="page-card-body">
							        				<div class="page-actions-section">
							        					<div class="quick-actions">
							        						<a href="<?php echo base_url('messenger_bot_analytics/result/').$page_info['id'];?>" target="_BLANK" class="quick-action-btn analytics-btn">
							        							<i class="fas fa-chart-pie"></i>
							        							<span><?php echo $this->lang->line("Analytics");?></span>
							        						</a>
							        						<a href="https://facebook.com/<?php echo $page_info['page_id'];?>" target="_BLANK" class="quick-action-btn visit-btn">
							        							<i class="fas fa-external-link-alt"></i>
							        							<span><?php echo $this->lang->line("Visit Page"); ?></span>
							        						</a>
							        					</div>
							        					
							        					<div class="bot-controls">
							        						<div class="bot-status">
							        							<span class="status-label"><?php echo $this->lang->line("Bot Status"); ?>:</span>
							        							<span class="status-value <?php echo ($page_info['bot_enabled'] == '1') ? 'active' : 'inactive'; ?>">
							        								<?php echo ($page_info['bot_enabled'] == '1') ? $this->lang->line('Active') : $this->lang->line('Inactive'); ?>
							        							</span>
							        						</div>
							        						
							        						<div class="bot-action-buttons">
							        							<?php if($page_info['bot_enabled']=='0') : ?>
							        								<button class="bot-action-btn enable-btn enable_webhook" restart='0' bot-enable="<?php echo $page_info['id'];?>" id="bot-<?php echo $page_info['id'];?>" title="<?php echo $this->lang->line("Enable Bot Connection");?>" data-toggle="tooltip">
							        									<i class="fas fa-play"></i>
							        									<span><?php echo $this->lang->line("Enable Bot"); ?></span>
							        								</button>
							        							<?php elseif($page_info['bot_enabled']=='1') : ?>
							        								<button class="bot-action-btn disable-btn disable_webhook" restart='0' bot-enable="<?php echo $page_info['id'];?>" id="bot-<?php echo $page_info['id'];?>" title="<?php echo $this->lang->line("Disable Bot Connection");?>" data-toggle="tooltip">
							        									<i class="fas fa-pause"></i>
							        									<span><?php echo $this->lang->line("Disable Bot"); ?></span>
	      			              		              	</button>
							        							<?php else : ?>
							        								<button class="bot-action-btn restart-btn enable_webhook" restart='1' bot-enable="<?php echo $page_info['id'];?>" id="bot-<?php echo $page_info['id'];?>" title="<?php echo $this->lang->line("Re-start Bot Connection");?>" data-toggle="tooltip">
							        									<i class="fas fa-redo"></i>
							        									<span><?php echo $this->lang->line("Restart Bot"); ?></span>
							        								</button>
	      						              		<?php endif; ?>

							        							<?php if($page_info['bot_enabled'] == '1' || $page_info['bot_enabled'] == '2') :?>
							        								<button class="bot-action-btn delete-bot-btn delete_full_bot" bot-enable="<?php echo $page_info['id'];?>" id="bot-<?php echo $page_info['id'];?>" already_disabled="<?php echo ($page_info['bot_enabled'] == '1') ? 'no' : 'yes'; ?>" title="<?php echo $this->lang->line("Delete Bot Connection & all settings.");?>" data-toggle="tooltip">
							        									<i class="fas fa-robot"></i>
							        									<span><?php echo $this->lang->line("Reset Bot"); ?></span>
							        								</button>
	                    								<?php endif; ?>									              	  											
							        						</div>
							        					</div>
	      											
							        					<div class="page-management">
							        						<div class="management-actions">
	      											<?php if($page_info['bot_enabled'] == 1) :?>
							        															        								<button class="management-btn delete-disabled" table_id="<?php echo $page_info['id']; ?>" title="<?php echo $this->lang->line("To enable delete button, first disable bot connection.");?>" data-toggle="tooltip" disabled>
							        									<i class="fas fa-trash-alt"></i>
							        									<span><?php echo $this->lang->line("Delete Page"); ?></span>
							        								</button>
	      											<?php else : ?>
							        								<button class="management-btn delete-page-btn page_delete" table_id="<?php echo $page_info['id']; ?>" title="<?php echo $this->lang->line("Delete this page from database.");?>" data-toggle="tooltip">
	      			              			              	  	<i class="fas fa-trash-alt"></i> 
							        									<span>Delete Page</span>
	      			              		              	</button>            	  	
	      											<?php endif; ?>
							        						</div>
							        					</div>
			        		                    </div>
			        		                  </div>
			        		                </div>
										</div>
						          	<?php endforeach; ?>
						    	</div>

								<!-- group lists -->
								<?php if($this->config->item('facebook_poster_group_enable_disable') == '1') : ?>
									<div class="clearfix"></div>
					                <h6 class="mt-3"><?php echo $this->lang->line('Group List') ?> <span class="text-muted">(<?php echo count($value['group_list']); ?> <?php echo $this->lang->line("groups"); ?>)</span></h6>
					              	<div style="max-height: 310px;overflow-y:auto;" class="nicescroll row">
				        	        	<?php foreach($value['group_list'] as $group_info) : ?>
				        	        		<div class="col-12 col-md-6 page_list_ul">	
					        	        		<ul class="list-unstyled list-unstyled-border">
						        			        <li class="media bg-white p-4">
						        			            
						        			            <img alt="image" class="mr-3 rounded-circle" width="40" src="<?php echo $group_info['group_profile']; ?>">
						        			            
						        			            <div class="media-body">
						        			              	<div class="media-right">
						        			              	  	<a href="#" class="btn-circle btn btn-outline-danger group_delete" table_id="<?php echo $group_info['id']; ?>" title="<?php echo $this->lang->line("Do you want to remove this group from our database?");?>" data-placement="left" data-toggle="tooltip">
							        			              	  	<i class="fas fa-trash-alt"></i> 
						        			              	  	</a>
						        			              	</div>

						        			              	<div class="media-title"><a target="_BLANK" href="https://facebook.com/<?php echo $group_info['group_id'];?>" ><?php echo $group_info['group_name']; ?></a>
						        			              	</div>

							        			            <div class="text-small text-muted">
							        			                <i class="fas fa-circle"></i> </b> <?php echo $group_info['group_id']; ?>
							        			            </div> 
						        			            </div>
						        			        </li>
						        	        	</ul>
					        	        	</div>
				        	          	<?php endforeach; ?>
					            	</div>
								<?php endif; ?>
						      </div>
						    </div>
						  </div>
						</div>


					</div>

				<?php
					$i++;
					if($i%2 == 0)
						echo "</div><div class='row'>";
					endforeach;				
				?>
				</div> 
				</div> 
			</div>
		<?php else : ?>
			<div class="card" id="nodata">
			  <div class="card-body">
			    <div class="empty-state">
			      <img class="img-fluid" style="height: 200px" src="<?php echo base_url('assets/img/drawkit/drawkit-nature-man-colour.svg'); ?>" alt="image">
			      <h2 class="mt-0"><?php echo $this->lang->line("You haven not connected any account yet.")?></h2>
			      <br/>
			      <h4>
			      	<div class="text-center">
			      		<p data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line("you must be logged in your facebook account for which you want to refresh your access token. for synch your new page, simply refresh your token. if any access token is restricted for any action, refresh your access token.");?>"> <?php if($this->config->item('developer_access') != '1') echo $fb_login_button; ?></p>
			      	</div>
			      </h4>
			    </div>
			  </div>
			</div>
		<?php endif; ?>
	</div>
</section>


<div class="modal fade" id="delete_confirmation" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center"><i class="fa fa-flag"></i> <?php echo $this->lang->line("Deletion Report") ?></h4>
            </div>
            <div class="modal-body" id="delete_confirmation_body">                

            </div>
        </div>
    </div>
</div>

<?php 
    
    $doyouwanttodelete = $this->lang->line("Do you want to delete this group from database?");
    $ifyoudeletethispage = $this->lang->line("If you delete this page, all the campaigns corresponding to this page will also be deleted. Do you want to delete this page from database?");
    $ifyoudeletethisaccount = $this->lang->line("If you delete this account, all the pages, groups and all the campaigns corresponding to this account will also be deleted form database. do you want to delete this account from database?");
    $facebooknumericidfirst = $this->lang->line("Please enter your facebook numeric id first");
    $ifyoudeletethisgroup = $this->lang->line("If you delete this group, all the campaigns corresponding to this group will also be deleted. Do you want to delete this group from database?");

?>


<script>
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip();
	});
	
	$("document").ready(function() {
		var base_url = "<?php echo base_url(); ?>";

		// instagram section
		$(document).on('click','.update_account',function(){
			var table_id = $(this).attr('table_id');
			$(this).removeClass('fas fa-sync-alt');
			$(this).addClass('fas fa-spinner');
			$.ajax({
				context: this,
				type:'POST' ,
				url:"<?php echo site_url();?>instagram_reply/update_your_account_info",
				dataType: 'json',
				data:{table_id:table_id},
				success:function(response){ 
					
					$(this).removeClass('fas fa-spinner');
					$(this).addClass('fas fa-sync-alt');

					if(response.status == 1)
					{
						swal('<?php echo $this->lang->line("Success"); ?>', response.message, 'success').then((value) => {
                              $("#media_count_"+table_id).text(response.media_count);
                              $("#follower_count_"+table_id).text(response.follower_count);
                            });
					}
					else
					{
						swal('<?php echo $this->lang->line("Error"); ?>', response.message, 'error');
					}
				},
				error:function(response){
					$(this).removeClass('fas fa-spinner');
					$(this).addClass('fas fa-sync-alt');
                    var span = document.createElement("span");
                    span.innerHTML = response.responseText;
                    swal({ title:'<?php echo $this->lang->line("Error!"); ?>', content:span,icon:'error'});
                }
			});
		});


		// sweet alert + confirmation
		$(document).on('click','.enable_webhook',function(){
			var restart = $(this).attr('restart');
			if(restart == 1)
			{
				var confirm_str = "<?php echo $this->lang->line("Do you really want to re-start Bot Connection for this page?"); ?>";
				var confirm_alert = '<?php echo $this->lang->line("Re-start Bot Connection"); ?>';
			}
			else
			{
				var confirm_str = "<?php echo $this->lang->line("Do you really want to enable Bot Connection for this page?"); ?>";
				var confirm_alert = '<?php echo $this->lang->line("Enable Bot Connection"); ?>';
			}
			swal({
				title: confirm_alert,
				text: confirm_str,
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) 
				{
					var page_id = $(this).attr('bot-enable');
					
					$(this).removeClass('btn-outline-primary');
					$(this).addClass('btn-primary');
					$(this).addClass('btn-progress');

					$.ajax({
						context: this,
						type:'POST' ,
						url:"<?php echo site_url();?>social_accounts/enable_disable_webhook",
						dataType: 'json',
						data:{page_id:page_id,enable_disable:'enable',restart:restart},
						success:function(response){ 
							$(this).removeClass('btn-progress');
							$(this).removeClass('btn-primary');
							$(this).addClass('btn-outline-primary');
							if(response.status == 1)
							{
								swal('<?php echo $this->lang->line("Success"); ?>', response.message, 'success').then((value) => {
				         			  location.reload();
									});
							}
							else
							{
								var success_message=response.message;
								var span = document.createElement("span");
								span.innerHTML = success_message;
								swal({ title:'<?php echo $this->lang->line("Error"); ?>', content:span, icon:'error'});
							}
						}
					});
				} 
			});


		});

		$(document).on('click','.disable_webhook',function(){

			swal({
				title: '<?php echo $this->lang->line("Disable Bot Connection"); ?>',
				text: '<?php echo $this->lang->line("Do you really want to disable Bot Connection for this page?"); ?>',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) 
				{
					var page_id = $(this).attr('bot-enable');
					var restart = $(this).attr('restart');

					$(this).removeClass('btn-outline-dark');
					$(this).addClass('btn-dark');
					$(this).addClass('btn-progress');

					$.ajax({
						context: this,
						type:'POST' ,
						url:"<?php echo site_url();?>social_accounts/enable_disable_webhook",
						dataType: 'json',
						data:{page_id:page_id,enable_disable:'disable',restart:restart},
						success:function(response){ 
							$(this).removeClass('btn-progress');
							$(this).removeClass('btn-dark');
							$(this).addClass('btn-outline-dark');
							if(response.status == 1)
							{
								swal('<?php echo $this->lang->line("Success"); ?>', response.message, 'success').then((value) => {
				         			  location.reload();
									});
							}
							else
							{
								swal('<?php echo $this->lang->line("Error"); ?>', response.message, 'error');
							}
						}
					});
				} 
			});


		});


		$(document).on('click','.delete_full_bot',function(){
			var confirm_str = "<?php echo $this->lang->line("By proceeding, it will delete all settings of messenger bot, auto reply campaign, posting campaign, subscribers and all campaign reports of this page. This data can not be retrived. It will not delete the page itself from the system."); ?>";
			swal({
				title: '<?php echo $this->lang->line("Delete Bot Connection & all settings"); ?>',
				text: confirm_str,
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) 
				{
					var page_id = $(this).attr('bot-enable');
				    var already_disabled = $(this).attr('already_disabled');

				    $(this).removeClass('btn-outline-danger');
				    $(this).addClass('btn-danger');
					$(this).addClass('btn-progress');

					$.ajax({
						context: this,
						type:'POST' ,
						url:"<?php echo site_url();?>social_accounts/delete_full_bot",
						dataType: 'json',
						data:{page_id:page_id,already_disabled:already_disabled},
						success:function(response){ 
							$(this).removeClass('btn-progress');
							$(this).removeClass('btn-danger');
							$(this).addClass('btn-outline-danger');
							if(response.status == 1)
							{
								swal('<?php echo $this->lang->line("Success"); ?>', response.message, 'success').then((value) => {
				         			  location.reload();
									});
							}
							else
							{
								swal('<?php echo $this->lang->line("Error"); ?>', response.message, 'error');
							}
						}
					});
				} 
			});


		});



		$(document).on('click','.group_delete',function(e){
			e.preventDefault();
			var ifyoudeletethisgroup = "<?php echo $ifyoudeletethisgroup; ?>";
  			var group_table_id = $(this).attr('table_id');
			swal({
				title: '<?php echo $this->lang->line("Warning!"); ?>',
				text: ifyoudeletethisgroup,
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) 
				{
					$(this).removeClass('btn-outline-danger');
				    $(this).addClass('btn-danger');
					$(this).addClass('btn-progress');

					$.ajax({
						context: this,
						type:'POST' ,
						url:"<?php echo site_url();?>social_accounts/group_delete_action",
						dataType: 'json',
						data:{group_table_id:group_table_id},
						success:function(response){ 
							$(this).removeClass('btn-progress');
							$(this).removeClass('btn-danger');
							$(this).addClass('btn-outline-danger');
							if(response.status == 1)
							{
								swal('<?php echo $this->lang->line("Success"); ?>', response.message, 'success').then((value) => {
				         			  location.reload();
									});
							}
							else
							{
								swal('<?php echo $this->lang->line("Error"); ?>', response.message, 'error');
							}
						}
					});
				} 
			});


		});



		$(document).on('click','.page_delete',function(){
			var ifyoudeletethispage = "<?php echo $ifyoudeletethispage; ?>";
			swal({
				title: '<?php echo $this->lang->line("Are you sure"); ?>',
				text: ifyoudeletethispage,
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) 
				{
					var page_table_id = $(this).attr('table_id');

					$(this).removeClass('btn-outline-danger');
				    $(this).addClass('btn-danger');
					$(this).addClass('btn-progress');

					$.ajax({
						context: this,
						type:'POST' ,
						url:"<?php echo site_url();?>social_accounts/page_delete_action",
						dataType: 'json',
						data:{page_table_id : page_table_id},
						success:function(response){
							$(this).removeClass('btn-progress');
							$(this).removeClass('btn-danger');
							$(this).addClass('btn-outline-danger');

							if(response.status == 1)
							{								
								swal('<?php echo $this->lang->line("Success"); ?>', response.message, 'success').then((value) => {
				         			  location.reload();
									});
							}
							else
							{
								swal('<?php echo $this->lang->line("Error"); ?>', response.message, 'error');
							}
						}
					});
				} 
			});


		});



		$(document).on('click','.delete_account',function(){
			var ifyoudeletethisaccount = "<?php echo $ifyoudeletethisaccount; ?>";
			swal({
				title: '<?php echo $this->lang->line("Are you sure"); ?>',
				text: ifyoudeletethisaccount,
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) 
				{
					var user_table_id = $(this).attr('table_id');
					$(this).removeClass('btn-outline-danger');
				    $(this).addClass('btn-danger');
					$(this).addClass('btn-progress');

					$.ajax({
						context: this,
						type:'POST' ,
						url:"<?php echo site_url();?>social_accounts/account_delete_action",
						dataType: 'json',
						data:{user_table_id : user_table_id},
						success:function(response){ 
							
							$(this).removeClass('btn-progress');
							$(this).removeClass('btn-danger');
							$(this).addClass('btn-outline-danger');

							if(response.status == 1)
							{
								swal('<?php echo $this->lang->line("Success"); ?>', response.message, 'success').then((value) => {
				         			  location.reload();
									});
							}
							else
							{
								swal('<?php echo $this->lang->line("Error"); ?>', response.message, 'error');
							}
						}
					});
				} 
			});


		});


		// $('#delete_confirmation').on('hidden.bs.modal', function () { 
		// 	location.reload(); 
		// });


		$("#submit").click(function(){
			var facebooknumericidfirst = "<?php echo $facebooknumericidfirst; ?>";
			var fb_numeric_id = $("#fb_numeric_id").val().trim();
			if(fb_numeric_id == '')
			{
				alert(facebooknumericidfirst);
				return false;
			}

			var loading = '<br/><br/><img src="'+base_url+'assets/pre-loader/Fading squares2.gif" class="center-block"><br/>';
        	$("#response").html(loading);

			$.ajax
			({
			   type:'POST',
			   // async:false,
			   url:base_url+'social_accounts/send_user_roll_access',
			   data:{fb_numeric_id:fb_numeric_id},
			   success:function(response)
			    {
			        $("#response").html(response);
			    }
			       
			});
		});

		
		$(document.body).on('click','#fb_confirm',function(){
			var loading = '<br/><br/><img src="'+base_url+'assets/pre-loader/Fading squares2.gif" class="center-block"><br/>';
        	$("#response").html(loading);
			$.ajax
			({
			   type:'POST',
			   // async:false,
			   url:base_url+'social_accounts/ajax_get_login_button',
			   data:{},
			   success:function(response)
			    {
			        $("#response").html(response);
			    }
			       
			});
		});


	});
	
</script>