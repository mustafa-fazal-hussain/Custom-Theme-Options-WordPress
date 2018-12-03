<?php

	function mithemes_options_init()
	{
		register_setting( 'mi_options', 'mi_theme_options','mi_options_validate');
	} 
	add_action( 'admin_init', 'mithemes_options_init' );
	
	
	function mithemes_framework_load_scripts($hook){
		
		if($GLOBALS['mi-theme'] === $hook){
			
			wp_enqueue_media();
			wp_enqueue_style( 'dashboard-style', get_template_directory_uri(). '/theme-dashboard/css/style.css' ,false, '2.0.0');
			wp_enqueue_style( 'dashboard-font', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' ,false, '2.0.0');
			wp_enqueue_style( 'dashboard-bootstrap', get_template_directory_uri(). '/theme-dashboard/css/bootstrap.min.css' ,false, '2.0.0');
			// Enqueue JS
			wp_enqueue_script( 'dashboard-script', get_template_directory_uri(). '/theme-dashboard/js/default.js', array( 'jquery' ) );
			
			//wp_enqueue_script( 'dashboard-jquery-min', get_template_directory_uri(). '/theme-dashboard/js/jquery.min.js', array( 'jquery' ) );
			wp_enqueue_script( 'dashboard-bootstrap-js', get_template_directory_uri(). '/theme-dashboard/js/bootstrap.min.js', array( 'jquery' ) );
			wp_enqueue_script( 'media-uploader', get_template_directory_uri(). '/theme-dashboard/js/media-uploader.js', array( 'jquery') );	
			
			//color-pikker
			wp_enqueue_script('wp-color-picker');
			wp_enqueue_style( 'wp-color-picker' );
		}
	}
	add_action( 'admin_enqueue_scripts', 'mithemes_framework_load_scripts' );
	
	function mithemes_framework_menu_settings() 
	{
		$mi_theme_menu = array(
					'page_title' => __( 'Custom Theme Options By Mustafa Fazal', 'our_theme'),
					'menu_title' => __('Theme Options', 'our_theme'),
					'capability' => 'manage_options',
					'menu_slug'  => 'theme_options_framework',
					'callback'   => 'theme_options_framework_page'
					);
					
		return apply_filters( 'mithemes_framework_menu', $mi_theme_menu );
	}
	add_action( 'admin_menu', 'theme_options_add_page' ); 
	function theme_options_add_page() 
	{
		$mi_theme_menu = mithemes_framework_menu_settings();
		$GLOBALS['mi-theme'] =  add_menu_page($mi_theme_menu['page_title'],$mi_theme_menu['menu_title'],$mi_theme_menu['capability'],$mi_theme_menu['menu_slug'],$mi_theme_menu['callback']);
	} 
	function theme_options_framework_page(){ 
			global $select_options; 
			if ( ! isset( $_REQUEST['settings-updated'] ) ) 
			$_REQUEST['settings-updated'] = false;		

	?>
	
	<form method="post" action="options.php" id="form-option" class="theme_option_ft">
	<?php 
		settings_fields( 'mi_options' );  
		$theme_options = get_option( 'mi_theme_options' );
	?>	
	<div class="theme-start">
			<div class="row header-bg">
				<div class="col-lg-2 header-logo">
					<img class="center-block" src="<?php echo get_template_directory_uri(); ?>/theme-dashboard/images/logo.png" /> 
				</div>
				<div class="col-lg-10 header-content">
					<div class="col-lg-6 text-left">
						<h3 class="header-logoName">Theme Options</h3>
						<p class="header-contentText">CONFIGURE YOUR THEME STYLES & LAYOUTS</p>
					</div>
					<div class="col-lg-6 text-right margin-top-8">
					<div class="pull-right "><input type="submit"  class="btn btn-theme btn-blueTheme btn-rightMargin" value="Save Changes" /></div>
					<div class="pull-right themeSpiner" ><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></div>
					</div>
				</div>
			</div>
			<div class="row profile">
				<div class="col-md-2 no-padding">
					<div class="profile-sidebar">
						<!-- END SIDEBAR BUTTONS -->
						<!-- SIDEBAR MENU -->
						<div class="profile-usermenu">
							<ul class="nav">
								<li class="active">
									<a data-toggle="tab" href="#logo">
									<i class="fa fa-picture-o" aria-hidden="true"></i>
									Site Logo </a>
								</li>
								<li >
									<a data-toggle="tab" href="#header">
									<i class="fa fa-arrow-up" aria-hidden="true"></i>
									Header </a>
								</li>
								<li>
									<a data-toggle="tab" href="#footer">
									<i class="fa fa-arrow-down" aria-hidden="true"></i>
									Footer </a>
								</li>
								<li>
									<a data-toggle="tab" href="#import-export">
									<i class="fa fa-database" aria-hidden="true"></i>
									Import/Export </a>
								</li>
								<li>
									<a data-toggle="tab" href="#social">
									<i class="fa fa-hashtag" aria-hidden="true"></i>
									Social Settings </a>
								</li>
							</ul>
						</div>
						<!-- END MENU -->
					</div>
				</div>
				
				<div class="tab-content">
					<div id="logo" class="tab-pane fade in active col-md-10 profile-content-col extra-padding">
						<div class="profile-content">
							<ul class="nav nav-tabs nav-tabsTheme">
								<li class="active"><a data-toggle="tab" href="#main-logo">Main Logo & Favicon</a></li>
								<li><a data-toggle="tab" href="#footer-logo">Footer Logo</a></li>
								<li><a data-toggle="tab" href="#mobile-logo">Mobile Logo</a></li>
							  </ul>
							  <div class="tab-content">
								<div id="main-logo" class="tab-pane fade in active">
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Default Logo</h5>
										</div>
										<div class="col-lg-9 theme-rightCol section">
											<input id="logo-img-inner" class="theme-input theme-inputSetting upload" type="text" name="mi_theme_options[logo]" 
												value="<?php if(!empty($theme_options['logo'])) { echo esc_url($theme_options['logo']); } ?>" placeholder="No file chosen" />
											<button id="upload_image_button" class="btn-blueTheme upload-button button" />
												<i class="fa fa-upload" aria-hidden="true"></i>
											</button>
											<div class="screenshot" id="logo-image-inner">
											  <?php if(!empty($theme_options['logo']))  { ?>
												 <img class="img-responsive" src="<?php echo esc_url($theme_options['logo']) ?>"/>
												 <a class='remove-image'>Remove</a>
												<?php } ?>
											</div>
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Favicon</h5>
										</div>
										<div class="col-lg-9 theme-rightCol section">
											<input id="logo-img" class="theme-input theme-inputSetting upload" type="text" name="mi_theme_options[favicon]" 
												value="<?php if(!empty($theme_options['favicon'])) { echo esc_url($theme_options['favicon']); } ?>" placeholder="No file chosen" />
											<button id="upload_image_button" class="btn-blueTheme upload-button button" />
												<i class="fa fa-upload" aria-hidden="true"></i>
											</button>
											<div class="screenshot" id="logo-image" style="width:5%">
											  <?php if(!empty($theme_options['favicon']))  { ?>
												 <img class="img-responsive" src="<?php echo esc_url($theme_options['favicon-logo']) ?>"/>
												 <a class='remove-image'>Remove</a>
												<?php } ?>
											</div>
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Text Logo</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<input name="mi_theme_options[text-logo]"  value="<?php if(!empty($theme_options['text-logo'])) { echo esc_attr($theme_options['text-logo']); } ?>" type="text" class="theme-input" />
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Use Text Logo</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<div class="onoffswitch">
												<input type="checkbox"  name="mi_theme_options[use-text-logo]" class="onoffswitch-checkbox" id="logoonoffswitch" value="true" <?php echo ( 'true' == $theme_options['use-text-logo'] ) ? 'checked="checked"' : ''; ?>>
												<label class="onoffswitch-label" for="logoonoffswitch">
													<span class="onoffswitch-inner"></span>
													<span class="onoffswitch-switch"></span>
												</label>
											</div>
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Text Logo Settings</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<div class="col-lg-6 no-padding">
												<p>Font size</p>
												<input name="mi_theme_options[logo-font-size]" type="number" class="theme-input no-margin" value="<?php if(!empty($theme_options['logo-font-size'])) { echo esc_attr($theme_options['logo-font-size']); } ?>" />
											</div>
											<div class="col-lg-6 no-paddingRight">
												<p>Font color</p>
												<input name="mi_theme_options[logo-font-color]" type="text" value="<?php if(!empty($theme_options['logo-font-color'])) { echo esc_attr($theme_options['logo-font-color']); } ?>" class="color-field" data-default-color="#effeff" />
											</div>
										</div>
									</div>
								</div>
								<div id="footer-logo" class="tab-pane fade">
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Footer Logo</h5>
										</div>
										<div class="col-lg-9 theme-rightCol section">
											<input id="logo-img" class="theme-input theme-inputSetting upload" type="text" name="mi_theme_options[footer-logo]" 
												value="<?php if(!empty($theme_options['footer-logo'])) { echo esc_url($theme_options['footer-logo']); } ?>" placeholder="No file chosen" />
											<button id="upload_image_button" class="btn-blueTheme upload-button button" />
												<i class="fa fa-upload" aria-hidden="true"></i>
											</button>
											<div class="screenshot" id="logo-image">
											  <?php if(!empty($theme_options['footer-logo']))  { ?>
												 <img class="img-responsive" src="<?php echo esc_url($theme_options['footer-logo']) ?>"/>
												 <a class='remove-image'>Remove</a>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								<div id="mobile-logo" class="tab-pane fade">
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Mobile Logo</h5>
										</div>
										<div class="col-lg-9 theme-rightCol section">
											<input id="logo-img" class="theme-input theme-inputSetting upload" type="text" name="mi_theme_options[mobile-logo]" 
												value="<?php if(!empty($theme_options['mobile-logo'])) { echo esc_url($theme_options['mobile-logo']); } ?>" placeholder="No file chosen" />
											<button id="upload_image_button" class="btn-blueTheme upload-button button" />
												<i class="fa fa-upload" aria-hidden="true"></i>
											</button>
											<div class="screenshot" id="logo-image">
											  <?php if(!empty($theme_options['mobile-logo']))  { ?>
												 <img class="img-responsive" src="<?php echo esc_url($theme_options['mobile-logo']) ?>"/>
												 <a class='remove-image'>Remove</a>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							  </div>
						</div>
					</div>
					
					<div id="header" class="tab-pane fade col-md-10 profile-content-col extra-padding">
						<div class="profile-content">
							<ul class="nav nav-tabs nav-tabsTheme">
								<li class="#"><a data-toggle="tab" href="#general-header" class="theme-headerTab">General Header</a></li>
							  </ul>
							  <div class="tab-content">
								<div id="general-header" class="tab-pane fade in active">
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Phone Number</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<input type="text" name="mi_theme_options[phone-number-caption]"  class="theme-input"  value="<?php if(!empty($theme_options['phone-number-caption'])) { echo esc_attr($theme_options['phone-number-caption']); } ?>" placeholder="Caption"/>
											<p></p>
											<input type="text" name="mi_theme_options[phone-number]"  class="theme-input"  value="<?php if(!empty($theme_options['phone-number'])) { echo esc_attr($theme_options['phone-number']); } ?>" placeholder="Number"/>
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Email Address</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<input type="text" name="mi_theme_options[email-caption]"  class="theme-input"  value="<?php if(!empty($theme_options['email-caption'])) { echo esc_attr($theme_options['email-caption']); } ?>" placeholder="Caption"/>
											<p></p>
											<input type="text" name="mi_theme_options[email-address]"  class="theme-input"  value="<?php if(!empty($theme_options['email-address'])) { echo esc_attr($theme_options['email-address']); } ?>" placeholder="Email"/>
										</div>
									</div>
								</div>
							  </div>
						</div>
						<div class="profile-content">
							<ul class="nav nav-tabs nav-tabsTheme">
								<li class="#"><a data-toggle="tab" href="#header-settings" class="theme-headerTab">Additional Header Settings</a></li>
							  </ul>
							  <div class="tab-content">
									<div id="header-settings" class="tab-pane fade in active">
										<div class="row option-row">
											<div class="col-lg-3 theme-leftCol">
												<h5 class="theme-leftText">Sticky Header</h5>
											</div>
											<div class="col-lg-9 theme-rightCol">
												<div class="onoffswitch">
													<input type="checkbox" name="mi_theme_options[sticky-header]"  class="onoffswitch-checkbox" id="stickyonoffswitch" value="true" <?php echo ( 'true' == $theme_options['sticky-header'] ) ? 'checked="checked"' : ''; ?>>
													<label class="onoffswitch-label" for="stickyonoffswitch">
														<span class="onoffswitch-inner"></span>
														<span class="onoffswitch-switch"></span>
													</label>
												</div>
											</div>
										</div>
									</div>
							  </div>
						</div>
					</div>
					
					<div id="footer" class="tab-pane fade in col-md-10 profile-content-col extra-padding">
						<div class="profile-content">
							  <div class="tab-content">
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Copyright Bar</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<div class="onoffswitch">
												<input type="checkbox" name="mi_theme_options[copyright-bar]"  class="onoffswitch-checkbox" id="copyrightonoffswitch" value="true" <?php echo ( 'true' == $theme_options['copyright-bar'] ) ? 'checked="checked"' : ''; ?>>
												<label class="onoffswitch-label" for="copyrightonoffswitch">
													<span class="onoffswitch-inner"></span>
													<span class="onoffswitch-switch"></span>
												</label>
											</div>
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Copyright Text</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<textarea name="mi_theme_options[copyright-text]"  rows="5" class="theme-input theme-textarea"><?php if(!empty($theme_options['copyright-text'])) { echo esc_attr($theme_options['copyright-text']); } ?></textarea>
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Play Store</h5>
										</div>
										<div class="col-lg-9 theme-rightCol section">
											<input id="logo-img-playstore" class="theme-input theme-inputSetting upload" type="text" name="mi_theme_options[google-play-store-img]" 
												value="<?php if(!empty($theme_options['google-play-store-img'])) { echo esc_url($theme_options['google-play-store-img']); } ?>" placeholder="Google Play Store Image" />
											<button id="upload_image_button" class="btn-blueTheme upload-button button" />
												<i class="fa fa-upload" aria-hidden="true"></i>
											</button>
											<div class="screenshot" id="play-logo-image">
												<?php if(!empty($theme_options['google-play-store-img']))  { ?>
													<img class="img-responsive" src="<?php echo esc_url($theme_options['google-play-store-img']) ?>"/>
													<a class='remove-image'>Remove</a>
												<?php } ?>
											</div>
											<p></p>
											<input type="url" name="mi_theme_options[google-play-store-url]"  class="theme-input"  value="<?php if(!empty($theme_options['google-play-store-url'])) { echo esc_attr($theme_options['google-play-store-url']); } ?>" placeholder="Play store URL"/>
											<p></p>
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">App Store</h5>
										</div>
										<div class="col-lg-9 theme-rightCol section">
											
											<input id="logo-img-appstore" class="theme-input theme-inputSetting upload" type="text" name="mi_theme_options[app-store]" 
												value="<?php if(!empty($theme_options['app-store'])) { echo esc_url($theme_options['app-store']); } ?>" placeholder="App Store Image" />
											<button id="upload_image_button" class="btn-blueTheme upload-button button" />
												<i class="fa fa-upload" aria-hidden="true"></i>
											</button>
											<div class="screenshot" id="app-logo-image">
												<?php if(!empty($theme_options['app-store']))  { ?>
													<img class="img-responsive" src="<?php echo esc_url($theme_options['app-store']) ?>"/>
													<a class='remove-image'>Remove</a>
												<?php } ?>
											</div>
											<p></p>
											<input type="url" name="mi_theme_options[app-store-url]"  class="theme-input"  value="<?php if(!empty($theme_options['app-store-url'])) { echo esc_attr($theme_options['app-store-url']); } ?>" placeholder="App store URL"/>
											<p></p>
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Address</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<textarea name="mi_theme_options[address]"  rows="5" class="theme-input theme-textarea"><?php if(!empty($theme_options['address'])) { echo esc_attr($theme_options['address']); } ?></textarea>
										</div>
									</div>
							  </div>
						</div>
					</div>
					
					<div id="import-export" class="tab-pane fade in col-md-10 profile-content-col extra-padding">
						<div class="profile-content">
							  <div class="tab-content">
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Select Demo</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<textarea rows="10"  id="theme-textareaImport" class="theme-input theme-textarea theme-textareaImport"></textarea>
											<a href="javascript:void(0)" class="btn btn-theme btn-blueTheme btn-rightMargin" id="im">Import</a>
											<p class="theme-instructLine">Choose a demo, then click import button</p>
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Export</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<textarea rows="10"  id="theme-textareaExport" class="theme-input theme-textarea theme-textareaExport"></textarea>
											<a href="javascript:void(0)" class="btn btn-theme btn-blueTheme btn-rightMargin" id="ex">Export</a>
											<p class="theme-instructLine">Download and make a backup of your options.</p>
										</div>
									</div>
							  </div>
						</div>
					</div>
					
					<div id="social" class="tab-pane fade in col-md-10 profile-content-col extra-padding">
						<div class="profile-content">
							  <div class="tab-content">
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Facebook</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<input type="text" name="mi_theme_options[facebook]"  class="theme-input"  value="<?php if(!empty($theme_options['facebook'])) { echo esc_attr($theme_options['facebook']); } ?>" />
											<p class="theme-instructLine">Facebook profile or page URL i.e. https://facebook.com/username/</p>
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Twitter</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<input type="text" name="mi_theme_options[twitter]"   class="theme-input"  value="<?php if(!empty($theme_options['twitter'])) { echo esc_attr($theme_options['twitter']); } ?>" />
											<p class="theme-instructLine">Twitter profile or page URL i.e. https://twitter.com/username/</p>
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Instagram</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<input type="text" name="mi_theme_options[instagram]"   class="theme-input"  value="<?php if(!empty($theme_options['instagram'])) { echo esc_attr($theme_options['instagram']); } ?>" />
											<p class="theme-instructLine">instagram profile or page URL i.e. https://instagram.com/username/</p>
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Linkedin</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<input type="text" name="mi_theme_options[linkedin]"   class="theme-input"  value="<?php if(!empty($theme_options['linkedin'])) { echo esc_attr($theme_options['linkedin']); } ?>" />
											<p class="theme-instructLine">Linkedin profile or page URL i.e. https://linkedin.com/username/</p>
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Youtube</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<input name="mi_theme_options[youtube]"   type="text" class="theme-input"  value="<?php if(!empty($theme_options['youtube'])) { echo esc_attr($theme_options['youtube']); } ?>" />
											<p class="theme-instructLine">Youtube profile or page URL i.e. https://youtube.com/username/</p>
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Pinterest</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<input type="text" name="mi_theme_options[pinterest]"   class="theme-input"  value="<?php if(!empty($theme_options['pinterest'])) { echo esc_attr($theme_options['pinterest']); } ?>" />
											<p class="theme-instructLine">Pinterest profile or page URL i.e. https://pinterest.com/username/</p>
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">Google+</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<input name="mi_theme_options[google-plus]"   type="text" class="theme-input"  value="<?php if(!empty($theme_options['google-plus'])) { echo esc_attr($theme_options['google-plus']); } ?>" />
											<p class="theme-instructLine">Facebook profile or page URL i.e. https://plus.google.com/username/</p>
										</div>
									</div>
									<div class="row option-row">
										<div class="col-lg-3 theme-leftCol">
											<h5 class="theme-leftText">RSS</h5>
										</div>
										<div class="col-lg-9 theme-rightCol">
											<input name="mi_theme_options[rss]"   type="text" class="theme-input"  value="<?php if(!empty($theme_options['rss'])) { echo esc_attr($theme_options['rss']); } ?>" />
											<p class="theme-instructLine">RSS profile or page URL i.e. https://rss.com/username/</p>
										</div>
									</div>
							  </div>
						</div>
					</div>
				</div>
			</div>
			<p class="theme-instructLine">Design & Develop by <a href="http://mustafafazal.me" target="_blank">Mustafa Fazal</a></p>
		</div>
		<div class="save-options" style="display:none;" ><h2>OPTION SAVED SUCCESSFULLY</h2></div>
	</form>
	<script type="text/javascript">
	jQuery("#im").click(function (e)
	{

		var import_data = jQuery('.theme-textareaImport').val();
		var unpackArr = JSON.parse( import_data );
		jQuery.each(unpackArr, function(index, value) 
		{
			jQuery("input[name='"+index+"']").val(value);
		});
		var postData = jQuery('#form-option').serializeArray();
		jQuery.ajax({
			type: "POST",
			url: "options.php",
			data: postData,
			dataType: "json",
			success: function(data, textStatus, jqXHR) {
				jQuery('.save-options').fadeIn();
				setTimeout(function () {jQuery('.save-options').fadeOut();}, 3000);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				//console.log(errorThrown);
			}
		});
		
	});
	</script>
<?php } ?>		
