<html lang="<?php echo $language;?>"
	class="<?php echo $this->Session->read(RwsConstant::SESSION_LOGIN_CONTROL);?>">
<head>
<link rel="icon" type="image/x-icon"
	href="<?php echo RwsConstant::FULL_BASE_URL_HOST?>/favicon.ico">
<link rel="alternate" href="<?php echo RwsConstant::FULL_BASE_URL_HOST; ?>/?hl=vn" hreflang="vi-vn" />
<link rel="alternate" href="<?php echo RwsConstant::FULL_BASE_URL_HOST; ?>/?hl=ja" hreflang="<?php echo $language;?>" />
<title><?php echo $title;?></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="content-language" content="en" />
<META name=”description”
			content="Tổng hợp các tin tức nhà đất, tư vấn chuyên nghiệp nhà phố, hướng dẫn các thủ tục pháp lý mua bán nhà">
<META name="Language" CONTENT="english">
<META name="Author" CONTENT="admin, admin@nhapholocphat.com">
<META name="keywords"
			CONTENT="Mua nhà, bán nhà, nhà phố sài gòn, định giá nhà đất, tin tức nhà đất, tư vấn mua nhà, tư vấn bán nhà">
<META name="robots" CONTENT="noindex, nofollow">
<meta name="viewport" content="width=device-width, initial-scale=0.66">
<META name="Title" CONTENT="<?php echo $title;?>">

<link rel="stylesheet"
	href="https://s.ytimg.com/yts/cssbin/www-core-webp-vfl26ZckH.css"
	class="css-httpssytimgcomytscssbinwwwcorewebpvfl26ZckHcss">
<link rel="stylesheet"
	href="https://s.ytimg.com/yts/cssbin/www-pageframe-webp-vflHiBo5E.css"
	class="css-httpssytimgcomytscssbinwwwpageframewebpvflHiBo5Ecss">
<link rel="stylesheet"
	href="https://s.ytimg.com/yts/cssbin/www-guide-webp-vflpNbi_i.css"
	class="css-httpssytimgcomytscssbinwwwguidewebpvflpNbi_icss">
<?php
	// CSS
	echo $this->Html->css ( array (
			'default','responsive','menu.RealEstate-admin'
	), 'stylesheet', array (
			'media' => 'screen' 
	),
		array('async' => 'async')
	);
	// JQuery
	echo $this->Html->script ( array (
			'jquery/jquery-1.10.2.min'
	) );
	
	echo $this->Html->script ( array (
			'default',
			'atrk'
	),
		array('async' => 'async')
	);
?>
  
<script>
		function showGuide() {
			var f = document.getElementsByTagName("html")[0];
			if($('#id_hdn_show_guide').val() == '1'){
				f.className = "guide-pinned no-focus-outline";
				$('#id_hdn_show_guide').val('-1');
			}
			else{
				f.className = "guide-pinned no-focus-outline show-guide";
				$('#id_hdn_show_guide').val('1');
			}
			window.dispatchEvent(new Event('resize'));
		}
		function fnc_onchange_language() {
			var link = window.location.href; 
			var urlLanguage = $("#id_cmb_language").val();
			location.href = urlLanguage;
		}

		function getWidth() {
  		  	if (self.innerHeight) {
			    return self.innerWidth;
		    }
		
		    if (document.documentElement && document.documentElement.clientHeight) {
		    	return document.documentElement.clientWidth;
		    }
		
		    if (document.body) {
		    	return document.body.clientWidth;
		    }
		}

		$(window).resize(function() {
			if(getWidth() > 979){
				var widthContent = getWidth() - 340;
				$('#id_content_details').css("width",widthContent);
			}
			else{
				$('#id_content_details').css("width",getWidth()-30);
			}
		});

		$(document).ready(function() {
			if(getWidth() > 979){
				var widthContent = getWidth() - 340;
				$('#id_content_details').css("width",widthContent);
			}
			else{
				$('#id_content_details').css("width",getWidth()-30);
			}
		});
</script>
</head>
<body dir="ltr" id="body"
	class="  ltr  webkit webkit-537  exp-watch-controls-overlay   site-center-aligned site-as-giant-card guide-pinning-enabled    visibility-logging-enabled   not-nirvana-dogfood  not-yt-legacy-css    flex-width-enabled      flex-width-enabled-snap yt-user-logged-in  page-loaded">
	<?php 
		echo "<input type='hidden' id='id_hdn_show_guide' value='1' >";
		if ($this->Session->check(RwsConstant::SESSION_LOGIN_USER_KEY)) { 
			$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		}
	?>
	<div id="early-body"></div>
	<div id="body-container">
		<div id="masthead-positioner">
			<div id="sb-wrapper">
				<div id="sb-container" class="sb-card sb-off">
					<div class="sb-card-arrow"></div>
					<div class="sb-card-border">
						<div class="sb-card-body-arrow"></div>
						<div class="sb-card-content" id="sb-target"></div>
					</div>
				</div>
				<div id="sb-onepick-target" class="sb-off" style="top: 0px;"></div>
			</div>
			<div id="yt-masthead-container" class="clearfix yt-base-gutter">
				<button id="a11y-skip-nav" class="skip-nav" tabindex="3">Skip
					navigation</button>
				<div id="yt-masthead">
					<div class="yt-masthead-logo-container ">
						<a id="logo-container"
							href="<?php echo RwsConstant::FULL_BASE_URL_HOST;?>"
							title="Mua bán nhà phố - Tư vấn pháp lý"> <img
							alt="<?php echo RwsConstant::FULL_BASE_URL_HOST; ?>"
							src="<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/img/icon.png"
							height="32px" width="68px"><span class="content-region"><?php echo $language;?> </span></a>
						<?php if (isset($user_id_login)) {?>
						<div id="appbar-guide-button-container">
							<button
								class="yt-uix-button yt-uix-button-size-default yt-uix-button-text yt-uix-button-empty yt-uix-button-has-icon appbar-guide-toggle appbar-guide-clickable-ancestor"
								type="button" onclick="showGuide();" id="appbar-guide-button">
								<span class="yt-uix-button-icon-wrapper"><span
									class="yt-uix-button-icon yt-uix-button-icon-appbar-guide yt-sprite"></span></span><span
									class="yt-uix-button-arrow yt-sprite"></span>
							</button>
							<div id="appbar-guide-button-notification-check"
								class="yt-valign">
								<span
									class="appbar-guide-notification-icon yt-valign-content yt-sprite"></span>
							</div>
						</div>
						<?php }?>
						<div id="appbar-main-guide-notification-container"></div>
					</div>
					<div id="yt-masthead-user" class="yt-uix-clickcard">
						<span title="Looking for <?php echo RwsConstant::FULL_BASE_URL_HOST; ?>">
							<?php
							if (isset($user_id_login)) { 
							 	echo $user_id_login;
							}
							?>
						</span>
						<span id="yt-masthead-account-picker" class="yt-uix-clickcard">
							<button
								class="yt-uix-button yt-uix-button-size-default yt-masthead-user-icon yt-uix-clickcard-target"
								type="button"
								onclick="<?php 
									if (isset($user_id_login)) { 
										echo "location.href='".RwsConstant::FULL_BASE_URL_HOST."/login/doLogout'"; 
									}
									else{
										echo "location.href='".RwsConstant::FULL_BASE_URL_HOST."/login'";
									}
								?>"
								id="kbd-nav-968508">
								<span class="yt-uix-button-content"> <span
									class="video-thumb  yt-thumb yt-thumb-27"> <span
										class="yt-thumb-square"> <span class="yt-thumb-clip"> <img
												width="27"
												src="<?php 
													if (isset($user_id_login)) { 
														echo RwsConstant::FULL_BASE_URL_HOST."/img/inside-logout-icon.png";
													}
													else{
														echo RwsConstant::FULL_BASE_URL_HOST."/img/login-avatar.png";
													}
												?>"
												alt="" height="27"> <span class="vertical-align"></span>
										</span>
									</span>
								</span>
								</span>
							</button>
						</span>
					</div>
					<div id="yt-masthead-content">
						<form id="masthead-search" class="search-form consolidated-form"
							action="<?php echo RwsConstant::FULL_BASE_URL_HOST?>/results"
							onsubmit="if (document.getElementById('masthead-search-term').value == '') return false;">
							<button
								class="yt-uix-button yt-uix-button-size-default yt-uix-button-default search-btn-component search-button"
								type="submit"
								onclick="if (document.getElementById('masthead-search-term').value == '') return false; document.getElementById('masthead-search').submit(); return false;;return true;"
								id="search-btn" dir="ltr" tabindex="2">
								<span class="yt-uix-button-content"><?php echo  $scrFieldLabels['SCR_MENU_SEARCH'];?></span>
							</button>
							<div id="masthead-search-terms"
								class="masthead-search-terms-border " dir="ltr">
								<input id="masthead-search-term"
									onkeydown="if (!this.value && (event.keyCode == 40 || event.keyCode == 32 || event.keyCode == 34)) {this.onkeydown = null; this.blur();}"
									class="search-term masthead-search-renderer-input yt-uix-form-input-bidi"
									name="search_query"
									value="<?php echo isset($search_query)? $search_query : '';?>"
									type="text" tabindex="1" title="Search" dir="ltr"
									style="outline: none;">
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php 
				if(!isset($user_id_login)){
			?>
			<div id="masthead-appbar-container" class="clearfix">
				<div id="masthead-appbar">
					<div id="appbar-content" class="">
						<div id="appbar-nav" class="appbar-content-hidable">
							<ul class="appbar-nav-menu">
								<li>
								<?php if($_SERVER['REQUEST_URI'] == '/' ){ ?>
									<h2 class="epic-nav-item-heading " aria-selected="true">
								      <?php echo  $scrFieldLabels['HOME_CATALOG_001'];?>
								    </h2>
								<?php }
								else{
								?>
									<a href="<?php echo RwsConstant::FULL_BASE_URL_HOST?>"
									class="yt-uix-button   spf-link yt-uix-sessionlink yt-uix-button-epic-nav-item yt-uix-button-size-default"><span
										class="yt-uix-button-content"><?php echo  $scrFieldLabels['HOME_CATALOG_001'];?></span></a>
								<?php }?>
								</li>
								<li>
								<?php if($_SERVER['REQUEST_URI'] == '/newsList?type=1' ){ ?>
									<h2 class="epic-nav-item-heading " aria-selected="true">
								      <?php echo  $scrFieldLabels['HOME_CATALOG_004'];?>
								    </h2>
								<?php }
								else{
								?>
									<a
									href="<?php echo RwsConstant::FULL_BASE_URL_HOST?>/newsList?type=1"
									class="yt-uix-button   spf-link yt-uix-sessionlink yt-uix-button-epic-nav-item yt-uix-button-size-default"><span
										class="yt-uix-button-content"><?php echo  $scrFieldLabels['HOME_CATALOG_004'];?></span></a>
								<?php }?>
								</li>
								<li>
								<?php if($_SERVER['REQUEST_URI'] == '/newsList?type=0' ){ ?>
									<h2 class="epic-nav-item-heading " aria-selected="true">
								      <?php echo  $scrFieldLabels['HOME_CATALOG_005'];?>
								    </h2>
								<?php }
								else{
								?>
								<a
									href="<?php echo RwsConstant::FULL_BASE_URL_HOST?>/newsList?type=0"
									class="yt-uix-button   spf-link yt-uix-sessionlink yt-uix-button-epic-nav-item yt-uix-button-size-default"><span
										class="yt-uix-button-content"><?php echo  $scrFieldLabels['HOME_CATALOG_005'];?></span></a>
								<?php }?>
								</li>
							</ul>
						</div>

					</div>
				</div>
			</div>
			<?php }?>
		</div>
		<?php
		if($user_id_login == null){
		?>
		<div id="masthead-positioner-height-offset"></div>
		<?php }else{
			echo "<div id='masthead-positioner-height-offset-sub'></div>";
		}?>
		<div id="page-container">
			<div id="page" class="  home  clearfix">
				<?php
				if (isset($user_id_login)) {
					$login_user_role = 0 + $this->Session->read('login.user.AUTH_ROLE');
					?>
				<div id="guide" class="yt-scrollbar">
					<div id="appbar-guide-menu"
						class="appbar-menu appbar-guide-menu-layout appbar-guide-clickable-ancestor yt-uix-scroller"
						style="top: 0px;">
						<div id="guide-container">
							<div class="guide-module-content yt-scrollbar">
								<ul class="guide-toplevel">
									<li class="guide-section">
										<div class="guide-item-container personal-item">
											<ul class="guide-user-links yt-uix-tdl yt-box">
												
												<?php
												if($login_user_role <= RwsConstant::USER_AUTH_ROLE_M4){
												?>
												<li
													class="guide-channel guide-notification-item overflowable-list-item "
													id="what_to_watch-guide-item"><a
													class="guide-item yt-uix-sessionlink yt-valign spf-link  guide-item-selected  "
													href="<?php echo RwsConstant::FULL_BASE_URL_HOST;?>"
													title="Home"> <span class="yt-valign-container"> <span
															class="thumb guide-what-to-watch-icon yt-sprite"></span>
															<span class="display-name  no-count"> <span> <?php echo  $scrFieldLabels['SCR_MENU_HOME'];?> </span>
														</span>
													</span>
												</a></li>
												<?php 
												}
												if($login_user_role <= RwsConstant::USER_AUTH_ROLE_M3){
												?>
												<li
													class="guide-channel guide-notification-item overflowable-list-item "
													id="UCkwKXIFgDWCJkuTJbkg227A-guide-item"><a
													class="guide-item yt-uix-sessionlink yt-valign spf-link   "
													href="<?php echo RwsConstant::FULL_BASE_URL_HOST . "/bdsNewsList";?>"
													title="My Channel"> <span class="yt-valign-container"> <span
															class="thumb guide-my-channel-icon yt-sprite"></span> <span
															class="display-name  no-count"> <span> <?php echo  $scrFieldLabels['SCR_MENU_BDS_NEWS_LIST'];?> </span>
														</span>
													</span>
												</a></li>
												<?php 
												}
												if($login_user_role <= RwsConstant::USER_AUTH_ROLE_M3){
												?>
												<li
													class="guide-channel guide-notification-item overflowable-list-item "
													id="UCkwKXIFgDWCJkuTJbkg227A-guide-item"><a
													class="guide-item yt-uix-sessionlink yt-valign spf-link   "
													href="<?php echo RwsConstant::FULL_BASE_URL_HOST . "/bdsNews";?>"
													title="My Channel"> <span class="yt-valign-container"> <span
															class="thumb guide-my-channel-icon yt-sprite"></span> <span
															class="display-name  no-count"> <span> <?php echo  $scrFieldLabels['SCR_MENU_BDS_NEWS'];?> </span>
														</span>
													</span>
												</a></li>
												<?php 
												}
												if($login_user_role <= RwsConstant::USER_AUTH_ROLE_M2){
												?>
												<li
													class="guide-channel guide-notification-item overflowable-list-item "
													id="UCkwKXIFgDWCJkuTJbkg227A-guide-item"><a
													class="guide-item yt-uix-sessionlink yt-valign spf-link   "
													href="<?php echo RwsConstant::FULL_BASE_URL_HOST . "/quyHoach";?>"
													title="My Channel"> <span class="yt-valign-container"> <span
															class="thumb guide-my-channel-icon yt-sprite"></span> <span
															class="display-name  no-count"> <span> <?php echo  $scrFieldLabels['SCR_MENU_QUY_HOACH'];?> </span>
														</span>
													</span>
												</a></li>
												<br>
												<br>
												<br>
												<br>
												<br>
												<?php 
												}
												if($login_user_role <= RwsConstant::USER_AUTH_ROLE_M4){
												?>
												<li
													class="guide-channel guide-notification-item overflowable-list-item "
													id="UCkwKXIFgDWCJkuTJbkg227A-guide-item"><a
													class="guide-item yt-uix-sessionlink yt-valign spf-link   "
													href="<?php echo RwsConstant::FULL_BASE_URL_HOST . "/edit/user";?>"
													title="My Channel"> <span class="yt-valign-container"> <span
															class="thumb guide-my-channel-icon yt-sprite"></span> <span
															class="display-name  no-count"> <span> <?php echo  $scrFieldLabels['SCR_MENU_ADMIN'];?> </span>
														</span>
													</span>
												</a></li>
												<?php 
												}
												if($login_user_role <= RwsConstant::USER_AUTH_ROLE_M2){
												?>
												<li
													class="guide-channel guide-notification-item overflowable-list-item "
													id="subscriptions-guide-item"><a
													class="guide-item yt-uix-sessionlink yt-valign spf-link   "
													href="<?php echo RwsConstant::FULL_BASE_URL_HOST?>/manage"
													title="Subscriptions"> <span class="yt-valign-container"> <span
															class="thumb guide-my-subscriptions-icon yt-sprite"></span>
															<span class="display-name  no-count"> <span> <?php echo  $scrFieldLabels['SCR_MENU_SUBSCRIPTION'];?> </span>
														</span>
													</span>
												</a></li>
												<?php 
												}
												if($login_user_role <= RwsConstant::USER_AUTH_ROLE_M3){
												?>
												<li
													class="guide-channel guide-notification-item overflowable-list-item "
													id="subscriptions-guide-item"><a
													class="guide-item yt-uix-sessionlink yt-valign spf-link   "
													href="<?php echo RwsConstant::FULL_BASE_URL_HOST?>/youman"
													title="Subscriptions"> <span class="yt-valign-container"> <span
															class="thumb guide-my-subscriptions-icon yt-sprite"></span>
															<span class="display-name  no-count"> <span> <?php echo  $scrFieldLabels['SCR_MENU_REUP'];?> </span>
														</span>
													</span>
												</a></li>
												<?php 
												}
												if($login_user_role <= RwsConstant::USER_AUTH_ROLE_M4){
												?>
												<li
													class="guide-channel guide-notification-item overflowable-list-item "
													id="subscriptions-guide-item"><a
													class="guide-item yt-uix-sessionlink yt-valign spf-link   "
													href="<?php echo RwsConstant::FULL_BASE_URL_HOST?>/search?type=1"
													title="Search"> <span class="yt-valign-container"> <span
															class="thumb guide-my-subscriptions-icon yt-sprite"></span>
															<span class="display-name  no-count"> <span> <?php echo  $scrFieldLabels['SCR_MENU_SEARCH'];?> </span>
														</span>
													</span>
												</a></li>
												<?php 
												}
												if($login_user_role <= RwsConstant::USER_AUTH_ROLE_M4){
												?>
												<li
													class="guide-channel guide-notification-item overflowable-list-item "
													id="subscriptions-guide-item"><a
													class="guide-item yt-uix-sessionlink yt-valign spf-link   "
													href="<?php echo RwsConstant::FULL_BASE_URL_HOST?>/search?type=0"
													title="Search"> <span class="yt-valign-container"> <span
															class="thumb guide-my-subscriptions-icon yt-sprite"></span>
															<span class="display-name  no-count"> <span> <?php echo  $scrFieldLabels['SCR_MENU_SEARCH_YT'];?> </span>
														</span>
													</span>
												</a></li>
												<?php 
												}
												if($login_user_role <= RwsConstant::USER_AUTH_ROLE_M4){
												?>
												<li
													class="guide-channel guide-notification-item overflowable-list-item "
													id="subscriptions-guide-item"><a
													class="guide-item yt-uix-sessionlink yt-valign spf-link   "
													href="<?php echo RwsConstant::FULL_BASE_URL_HOST?>/seoTop"
													title="Search"> <span class="yt-valign-container"> <span
															class="thumb guide-my-subscriptions-icon yt-sprite"></span>
															<span class="display-name  no-count"> <span> <?php echo  $scrFieldLabels['SCR_MENU_SEO_TOP'];?> </span>
														</span>
													</span>
												</a></li>
												<?php }
												if($login_user_role <= RwsConstant::USER_AUTH_ROLE_SUB){
												?>
												<li
													class="guide-channel guide-notification-item overflowable-list-item "
													id="subscriptions-guide-item"><a
													class="guide-item yt-uix-sessionlink yt-valign spf-link   "
													href="<?php echo RwsConstant::FULL_BASE_URL_HOST?>/action/getRssNews"
													title="Search"> <span class="yt-valign-container"> <span
															class="thumb guide-my-subscriptions-icon yt-sprite"></span>
															<span class="display-name  no-count"> <span> <?php echo  $scrFieldLabels['SCR_MENU_GET_RSS_NEWS'];?> </span>
														</span>
													</span>
												</a></li>
												<?php 
												}
												if($login_user_role <= RwsConstant::USER_AUTH_ROLE_SUB){
												?>
												<li
													class="guide-channel guide-notification-item overflowable-list-item "
													id="subscriptions-guide-item"><a
													class="guide-item yt-uix-sessionlink yt-valign spf-link   "
													href="<?php echo RwsConstant::FULL_BASE_URL_HOST?>/action/find"
													title="Search"> <span class="yt-valign-container"> <span
															class="thumb guide-my-subscriptions-icon yt-sprite"></span>
															<span class="display-name  no-count"> <span> Xác nhận tin đăng </span>
														</span>
													</span>
												</a></li>
												
												<?php }?>
											</ul>
											
										</div>
									</li>

								</ul>
							</div>

						</div>
					</div>
				</div>
				<?php }?>
				<div id="content" class="content-alignment">
					<div id="container" class="main-area">
						<div class="inner">
				<?php
						// In HTML Mode
						if ($APP_MODE == RwsConstant::APP_MODE_HTML) {?>
							<div class="content_details">
								<div id="view_content">
									<?php echo $this->fetch('content'); ?>
								</div>
							</div>
				  <?php } else {
			  				echo "<div class='content_details_login'>";
	  				?>
				  			
								<!-- ERROR / SUCCESS MESSAGE -->
							<div id="id_div_flash"><?php echo $this->Session->flash(); ?></div>
							<!-- Used for Ajax error case -->
							<div id="id_div_error" style="display: none;"></div>
							<!-- PAGE CONTENT -->
							<div id="id_content_adv"><?php echo $this->fetch('content'); ?></div>
							<?php echo "</div>";?>
					<?php }?>
				</div>
					</div>
					<div
						class="branded-page-v2-container branded-page-base-bold-titles branded-page-v2-container-flex-width branded-page-v2-secondary-column-hidden">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="footer-container" class="yt-base-gutter force-layer">
		<div id="footer">
			<div id="footer-main">
			<?php
				$requestUri = str_replace("hl=".RwsConstant::LANGUAGE_VN, "", $_SERVER['REQUEST_URI']);
				$requestUri = str_replace("hl=".RwsConstant::LANGUAGE_EN, "", $requestUri);
				if($requestUri=='/'){
					$requestUri = $requestUri . '?';
				} else if($requestUri != '/?'){
					$requestUri = $requestUri . '&';
				}
			?>
			</div>

			<div id="footer-links">
				<div id="footer-logo1"></div>
				<ul id="footer-links-primary">
					<li><span><?php echo  $scrFieldLabels['SCR_LABLE_LANGUAGE'];?> : </span>
						<?php 
							$notlanguage = array('news');
							if(isset($this->params['controller']) && in_array($this->params['controller'],$notlanguage)){							
								if($language == RwsConstant::LANGUAGE_VN){
									echo 'Việt Nam';
								} else if($language == RwsConstant::LANGUAGE_EN){
									echo 'English';
								}
							} else {
								?>
									<a href='<?php echo "http://$_SERVER[HTTP_HOST]$requestUri" . 'hl=' . RwsConstant::LANGUAGE_VN; ?>'>Việt Nam</a>
									<a href='<?php echo "http://$_SERVER[HTTP_HOST]$requestUri" . 'hl=' . RwsConstant::LANGUAGE_EN; ?>'>English</a>
								<?php 
							}
						?>
					</li>
					<li><a href="<?php echo RwsConstant::FULL_BASE_URL_HOST?>/about/"> <?php echo  $scrFieldLabels['SCR_LABLE_ABOUT'];?> </a></li>
				</ul>
			</div>
		</div>
	</div>

	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>