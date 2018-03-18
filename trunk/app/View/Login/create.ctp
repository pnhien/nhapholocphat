
<div class="google-header-bar  centered">
	<div class="header content clearfix">
		<div class="logo1" aria-label="Google"></div>
	</div>
</div>
<div class="main content clearfix">
	<div class="banner">
		<div class="yt-masthead-logo-container ">
			<a id="logo-container" href="<?php echo RwsConstant::FULL_BASE_URL_HOST;?>"
				title="YouTube home"> <img alt="YoutubeSub Home"
				src="<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/img/subicon.png"
				height="64px" width="200px"></a>		
		</div>
		<h2>Tạo tài khoản quản lý Video</h2>
	</div>
	<div class="main-content">
		<div class="card create-card">
			<div class="circle-mask" style="">
				<canvas id="canvas" class="circle" width="96" height="96"></canvas>
			</div>
			<?php echo $this->Form->create('TUser', array('url' => array ('controller' => 'createUser', 'action' => 'doAddUser'), 'role' => 'form', 'novalidate' => true)); ?>
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
							<div>
								<label class="hidden-label" for="USER_PASSWORD"> Nhập password của bạn</label> 
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
							<div>
								<label class="hidden-label" for="USER_PASSWORD_CFM"> Nhập lại password của bạn</label> 
								<?php
								echo $this->Form->input ( 'USER_PASSWORD_CFM', array (
										'type' => 'password',
										'placeholder' => 'Nhập lại password của bạn',
										'spellcheck' => 'false',
										'label' => false,
										'div' => false,
										'error' => false,
										'id' => 'id_login_pass_cfm' 
								) );
								?>
									<input id="Passwd-hidden" type="password" spellcheck="false"
									class="hidden">
							</div>
							<div>
								<label class="hidden-label" for="MAIL_ADDRESS"> Nhập đại chỉ email của bạn</label> 
								<?php
								echo $this->Form->input ( 'MAIL_ADDRESS', array (
										'type' => 'email',
										'placeholder' => 'Nhập email của bạn',
										'spellcheck' => 'false',
										'label' => false,
										'div' => false,
										'error' => false,
										'id' => 'id_login_mail' 
								) );
								?>
									<input id="Passwd-hidden" type="password" spellcheck="false"
									class="hidden">
							</div>
						</div>
						<span role="alert" class="error-msg" id="errormsg_0_Email"></span>
					</div>
					<input id="signIn" name="signIn" class="rc-button rc-button-submit"
						type="submit" value="<?php echo $scrFieldLabels['SCR_LOGIN_CREATE'];?>">
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
	</div>
</div>