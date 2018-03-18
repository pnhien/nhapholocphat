<div class="google-header-bar  centered">
	<div class="header content clearfix">
		<div class="logo1" aria-label="Google"></div>
	</div>
</div>
<div class="main content clearfix">
	<div class="banner">
		<div class="yt-masthead-logo-container ">
			<a id="logo-container" href="<?php echo RwsConstant::FULL_BASE_URL_HOST;?>"
				title="Nhà phố Lộc Phát"> <img alt="Nhà phố Lộc Phát"
				src="<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/img/subicon.png"
				height="auto" width="256px"></a>		
		</div>
		<h2>Đăng nhập để quản lý</h2>
	</div>
	<div class="main-content">
		<div class="card signin-card">
			<div class="circle-mask" style="">
				<canvas id="canvas" class="circle" width="96" height="96"></canvas>
			</div>
			<?php echo $this->Form->create('TUser', array('url' => array ('controller' => 'login', 'action' => 'doLogin'), 'role' => 'form', 'novalidate' => true)); ?>
				<div class="form-panel first valid" id="gaia_firstform">
				<div class="slide-out ">
					<div class="input-wrapper focused">
						<div id="identifier-shown">
							<div>
								<label class="hidden-label" for="USER_ID"> Nhập username của bạn</label>								
								<?php
								echo $this->Form->input ( 'USER_ID', array (
										'type' => 'text',
										'placeholder' => 'Nhập username của bạn',
										'spellcheck' => 'false',
										'autofocus' => 'autofocus',
										'label' => false,
										'div' => false,
										'error' => false,
										'id' => 'user_login_id' 
								) );
								?>
								<input id="Passwd-hidden" type="password" spellcheck="false"
									class="hidden">
							</div>
						</div>
						<span role="alert" class="error-msg" id="errormsg_0_Email"></span>
					</div>
					<div class="input-wrapper">
						<div id="identifier-shown">
							<div>
								<label class="hidden-label" for="Email"> Nhập password của bạn</label> 
								<?php
								echo $this->Form->input ( 'USER_PASSWORD', array (
										'type' => 'password',
										'placeholder' => 'Nhập password của bạn',
										'spellcheck' => 'false',
										'label' => false,
										'div' => false,
										'error' => false,
										'id' => 'id_login_pass' 
								) );
								?>
									<input id="Passwd-hidden" type="password" spellcheck="false"
									class="hidden">
							</div>
						</div>
						<span role="alert" class="error-msg" id="errormsg_0_Email"></span>
					</div>
					<input id="logIn" name="logIn" class="rc-button rc-button-submit"
						type="submit" value="<?php echo $scrFieldLabels['LOGIN_SUBMIT'];?>">
				</div>
				<?php
				if (! empty ( $errors )) {
					echo '<span id = "id_errors" style="color: red;">';
					RwsHelper::displayErrors ( $errors );
					echo '</span>';
				}
				else if (! empty ( $messages )) {
					echo '<span id = "id_errors" style="color: green;">';
					RwsHelper::displayErrors ( $messages );
					echo '</span>';
				}
				?>
			</div>
			<?php echo $this->Form->end()?>
			</div>
			<div class="card-mask">
			<div class="one-google">
				<p class="create-account"><span id="link-signup"> 
					<?php echo $this->Html->link(__($scrFieldLabels['SCR_LOGIN_CREATE']), array('controller' => 'createUser', 'action' => 'index'), array('escape' => false, 'id' => 'UserPersonnalSetting')); ?>
				</span></p>
				<p class="create-account"><span id="link-signup"> 
					<a href='<?php echo RwsConstant::FULL_BASE_URL_HOST . 'emailinput'?>' >Change pass</a>
				</span></p>
			</div>
			</div>
</div>
</div>