<?php 
	echo $this->Html->script (array(
			'jquery/ajaxform'
	));
	
	// CSS
	echo $this->Html->css(
			array(
					'useredit'
			));
	
?>
<script type="text/javascript">
	
    function confirmDelete(id) {
    	var msg = "<?php echo Message::$messageList [$language] ['CONFIRM_DELETE'] ?>";
    	openConfirmDialog(msg, id);
    }

    function confirmDeleteSelf(id) {
    	var msg = "<?php echo Message::$messageList [$language] ['EDITUSER_CNF_000002'] ?>";
    	openConfirmDialog(msg, id);
    }

    function dialogCallback(selected, id){
    	if (selected) {
    		document.forms['deleteForm'+id].submit();
    	}
    }

    function callEditUserSiteAuthority(user_id){
    	window.location.href = "edit_user_site_authority?user_id="+user_id;
    }

    function fnc_doCheckAddUser() {
		$('#id_div_flash').empty().hide();
		$('#id_div_error').empty().hide();

		var id_user_id_new = $('#id_user_id_new').val();
		var id_user_password_new = $('#id_user_password_new').val();
		var id_mail_address_new = $('#id_mail_address_new').val();
		
		if (id_user_id_new == '') {
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>' + '<?php echo $messageList['EDITUSER_ERR_000001'];?>' + '</p>';
			html += '	</div>';
			html += '</div>';
			$('#id_div_error').append(html).show();
			$('#id_user_id_new').focus();
			return;
		}
		else if (id_user_id_new.match(/[^A-Za-z0-9\[\]()_]/) != null) {
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>' + '<?php echo $messageList['EDITUSER_ERR_000008'];?>' + '</p>';
			html += '	</div>';
			html += '</div>';
			$('#id_div_error').append(html).show();
			$('#id_user_id_new').focus();
			return;
		}
		
		var totalUser = $('#user_cnt').val();
		var user_id_login = $('#user_id_login').val();
		for(var i = 0 ; i < totalUser ; i++){
			if(id_user_id_new == user_id_login || id_user_id_new == $('#id_user_id'+i).val()){
				var html = '<div class="notice">';
				html += '	<div class="error">';
				html += '		<p>' + '<?php echo $messageList['EDITUSER_ERR_000004'];?>' + '</p>';
				html += '	</div>';
				html += '</div>';
				$('#id_div_error').append(html).show();
				$('#id_user_id_new').focus();
				return;
			}
		}

		if(id_user_password_new == ''){
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>' + '<?php echo $messageList['EDITUSER_ERR_000005'];?>' + '</p>';
			html += '	</div>';
			html += '</div>';
			$('#id_div_error').append(html).show();
			$('#id_user_password_new').focus();
			return;
		}
		else if (id_user_password_new.match(/[^A-Za-z0-9\@\.\[\]()_]/) != null) {
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>' + '<?php echo $messageList['EDITUSER_ERR_000009'];?>' + '</p>';
			html += '	</div>';
			html += '</div>';
			$('#id_div_error').append(html).show();
			$('#id_user_password_new').focus();
			return;
		}

		if (id_mail_address_new != '' && id_mail_address_new.match(/[^A-Za-z0-9\@\.\[\]()_]/) != null) {
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>' + '<?php echo $messageList['EDITUSER_ERR_000009'];?>' + '</p>';
			html += '	</div>';
			html += '</div>';
			$('#id_div_error').append(html).show();
			$('#id_user_password_new').focus();
			return;
		}
		
		document.forms['TUserNewIndexForm'].submit();
		
    }

    function fnc_doCheckUpdateUser(idx) {
		$('#id_div_flash').empty().hide();
		$('#id_div_error').empty().hide();

		var id_user_password = $('#id_user_password'+idx).val();
		var id_mail_address = $('#id_mail_address'+idx).val();
		if(id_user_password == ''){
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>' + '<?php echo $messageList['EDITUSER_ERR_000005'];?>' + '</p>';
			html += '	</div>';
			html += '</div>';
			$('#id_div_error').append(html).show();
			$('#id_user_password'+idx).focus();
			return;
		}
		else if (id_user_password.match(/[^A-Za-z0-9\@\.\[\]()_]/) != null) {
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>' + '<?php echo $messageList['EDITUSER_ERR_000009'];?>' + '</p>';
			html += '	</div>';
			html += '</div>';
			$('#id_div_error').append(html).show();
			$('#id_user_password'+idx).focus();
			return;
		}

		if (id_mail_address != '' && !validateEmail(id_mail_address)) {
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>' + '<?php echo $messageList['EDITUSER_ERR_000010'];?>' + '</p>';
			html += '	</div>';
			html += '</div>';
			$('#id_div_error').append(html).show();
			$('#id_user_password'+idx).focus();
			return;
		}
		
		document.forms['TUserNewIndexForm'+idx].submit();
		
    }

    function fnc_doCheckUpdateCustomer(idx) {
		$('#id_div_flash').empty().hide();
		$('#id_div_error').empty().hide();

		var id_customer_name = $('#id_customer_name'+idx).val();
		var id_api_key = $('#id_api_key'+idx).val();
		if(id_customer_name == ''){
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>' + '<?php echo $messageList['EDITUSER_ERR_000011'];?>' + '</p>';
			html += '	</div>';
			html += '</div>';
			$('#id_div_error').append(html).show();
			$('#id_user_password'+idx).focus();
			return;
		}

		if (id_api_key == '') {
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>' + '<?php echo $messageList['EDITUSER_ERR_000012'];?>' + '</p>';
			html += '	</div>';
			html += '</div>';
			$('#id_div_error').append(html).show();
			$('#id_user_password'+idx).focus();
			return;
		}
		
		document.forms['TCustomerNewIndexForm'+idx].submit();
    }

//    function fnc_doCheckUpdateApprove(idx) {
//		$('#id_div_flash').empty().hide();
//		$('#id_div_error').empty().hide();
//
//		var id_backlink_link = $('#id_backlink_link'+idx).val();
//		if(id_backlink_link == ''){
//			var html = '<div class="notice">';
//			html += '	<div class="error">';
//			html += '		<p>' + 'Please input backlink of www.nhapholocphat.com.' + '</p>';
//			html += '	</div>';
//			html += '</div>';
//			$('#id_backlink_link'+idx).focus();
//			$('#id_div_error').append(html).show();
//			return;
//		}
//
//		var id_backlink_date = $('#id_backlink_date'+idx).val();
//		if(id_backlink_date == ''){
//			var html = '<div class="notice">';
//			html += '	<div class="error">';
//			html += '		<p>' + 'Please input date.' + '</p>';
//			html += '	</div>';
//			html += '</div>';
//			$('#id_div_error').append(html).show();
//			$('#id_backlink_date'+idx).focus();
//			return;
//		}
//		document.forms['TBacklinkIndexFormNew'].submit();
//    }

    function fnc_doCheckBackLinkNew() {
		$('#id_div_flash').empty().hide();
		$('#id_div_error').empty().hide();

		var id_backlink_link = $('#id_backlink_link_new').val();
		if(id_backlink_link == ''){
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>Please input backlink of <?php echo RwsConstant::FULL_BASE_URL_HOST ?></p>';
			html += '	</div>';
			html += '</div>';
			$('#id_backlink_link'+idx).focus();
			$('#id_div_error').append(html).show();
			return;
		}

		document.forms['TBacklinkIndexFormNew'].submit();
    }

    function fnc_doCheckUpdateApprove(idx) {
		$('#id_div_flash').empty().hide();
		$('#id_div_error').empty().hide();

		var id_backlink_link = $('#id_backlink_link'+idx).val();
		if(id_backlink_link == ''){
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>Please input backlink of <?php echo RwsConstant::FULL_BASE_URL_HOST ?></p>';
			html += '	</div>';
			html += '</div>';
			$('#id_backlink_link'+idx).focus();
			$('#id_div_error').append(html).show();
			return;
		}

		var id_backlink_date = $('#id_backlink_date'+idx).val();
		if(id_backlink_date == ''){
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>' + 'Please input date.' + '</p>';
			html += '	</div>';
			html += '</div>';
			$('#id_div_error').append(html).show();
			$('#id_backlink_date'+idx).focus();
			return;
		}
		document.forms['TBacklinkIndexForm'+idx].submit();
    }
</script>
<?php
	if(isset($deletesuccess)){
		if($deletesuccess == 'true'){
			echo "<script language='javascript'>alert('".Message::$messageList[$language]['EDITUSER_ERR_000008']."');</script>"; 
		}
		else{
			echo "<script language='javascript'>alert('".Message::$messageList[$language]['EDITUSER_ERR_000007']."');</script>"; 
		}
	}
?>
<div class="capture-area">
	<?php
		$login_user_role = 0 + $this->Session->read('login.user.AUTH_ROLE');
		if($login_user_role == RwsConstant::USER_AUTH_ROLE_ADMIN){
	?>
	<table summary="authority list" class="table-list">
	<caption><?php echo $scrFieldLabels['SCR_EDITUSER_CREATE'];?></caption>
		<thead>
			<tr>
				<th></th>
				<th></th>
				<th colspan="5"></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<th>Username</th>
				<th>Password</th>
				<th>Admin</th>
				<th>Sub</th>
				<th>M2</th>
				<th>M3</th>
				<th>M4</th>
				<th>Email</th>
				<th>Super</th>
				<th></th>
			</tr>
		</thead>
		<tbody class="table-center">
			<tr>
				<?php 
				echo "<input type='hidden' id='user_id_login' value='".$user_id_login."' >";
				echo $this->Form->create('TUserNew', array('url' => array ('controller' => 'editUser', 'action' => 'doAddUser'), 'role' => 'form', 'novalidate' => true));
				
				echo "<td>";
				if(!isset($user['USER_ID'])){
					$user['USER_ID'] = '';
				}
				echo $this->Form->input ( '', array (
						'name' => 'data[TUser][USER_ID]',
						'id' => 'id_user_id_new',
						'type' => 'text',
						'class' => 'w70',
						'label' => false,
						'div' => false,
						'error' => false,
						'maxlength' => '32',
						'value' => $user['USER_ID']
				) );
				echo "</td>";
				
				echo "<td>";
				if(!isset($user['USER_PASSWORD'])){
					$user['USER_PASSWORD'] = '';
				}
				echo $this->Form->input ( '', array (
						'name' => 'data[TUser][USER_PASSWORD]',
						'id' => 'id_user_password_new',
						'type' => 'text',
						'class' => 'w100',
						'label' => false,
						'div' => false,
						'error' => false,
						'maxlength'=>'32',
						'value' => $user['USER_PASSWORD']
				) );
				echo "</td>";
				
				if(!isset($user['AUTH_ROLE'])){
					$user['AUTH_ROLE'] = '4';
				}
				$attributes = array('name'=> 'data[TUser][AUTH_ROLE]','legend' => false, 'default' => $user['AUTH_ROLE'], 'label' => false);
				echo "<td>";
					$options = array('0' => '');
					echo $this->Form->radio('AUTH_ROLE', $options, $attributes);
				echo "</td>";
				echo "<td>";
					$options = array('1' => '');
					echo $this->Form->radio('AUTH_ROLE', $options, $attributes);
				echo "</td>";
				echo "<td>";
				$options = array('2' => '');
				echo $this->Form->radio('AUTH_ROLE', $options, $attributes);
				echo "</td>";
				echo "<td>";
				$options = array('3' => '');
				echo $this->Form->radio('AUTH_ROLE', $options, $attributes);
				echo "</td>";
				echo "<td>";
				$options = array('4' => '');
				echo $this->Form->radio('AUTH_ROLE', $options, $attributes);
				echo "</td>";
				
				echo "<td>";
				if(!isset($user['MAIL_ADDRESS'])){
					$user['MAIL_ADDRESS'] = '';
				}
				echo $this->Form->input ( '', array (
						'name' => 'data[TUser][MAIL_ADDRESS]',
						'id' => 'id_mail_address_new',
						'type' => 'text',
						'class' => 'w150',
						'label' => false,
						'div' => false,
						'error' => false,
						'maxlength'=>'255',
						'value' => $user['MAIL_ADDRESS']
				) );
				echo "</td>";

				if(!isset($user['AUTH_DEMAND_FORECAST_EDIT'])){
					$user['AUTH_DEMAND_FORECAST_EDIT'] = '0';
				}
				echo "<td>".$this->Form->input('', array('name' => 'data[TUser][AUTH_DEMAND_FORECAST_EDIT]','type'=>'checkbox','label' => false, 'checked' => $user['AUTH_DEMAND_FORECAST_EDIT']))."</td>";
				
				echo "<td class='tc'><input type='button' onClick='fnc_doCheckAddUser();' class='addition_button' value='".$scrFieldLabels['BTN_ADD']."' /></td>";
				echo $this->Form->end();
				?>
			</tr>
		</tbody>
	</table>
	<?php } ?>
	<table summary="user list" class="table-list_edit">
		<caption><?php echo $scrFieldLabels['SCR_EDITUSER_USERLIST'];?></caption>
		<thead>
			<tr>
				<th>Username</th>
				<th>Password</th>
				<?php 
				if($login_user_role == RwsConstant::USER_AUTH_ROLE_ADMIN){
				?>
				<th>Admin</th>
				<?php 
				}
				if($login_user_role <= RwsConstant::USER_AUTH_ROLE_SUB){
				?>
				<th>Sub</th>
				<?php 
				}
				if($login_user_role <= RwsConstant::USER_AUTH_ROLE_M2){
				?>
				<th>M2</th>
				<?php 
				}
				if($login_user_role <= RwsConstant::USER_AUTH_ROLE_M3){
				?>
				<th>M3</th>
				<?php 
				}
				?>
				<th>M4</th>
				<th>Email</th>
				<?php if($login_user_role <= RwsConstant::USER_AUTH_ROLE_SUB){ ?>
				<th>Login</th>
				<?php } ?>
				<th>Super</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody class="table-center">
			<?php 
				if(isset($userlist)){
					$cnt = 0;
					echo "<input type='hidden' id='user_cnt' value='".sizeof($userlist)."' >";
					foreach ($userlist as $userDeltais){
						if($cnt % 2 == 0){
							echo "<tr>";
						}
						else{
							echo "<tr class='trc'>";
						}
						echo $this->Form->create('', array('name' => 'TUserNewIndexForm'.$cnt, 'url' => array ('controller' => 'editUser', 'action' => 'doChangeUser'), 'role' => 'form', 'novalidate' => true));
						
						echo "<input type='hidden' name='data[TUser][USER_ID]' id='id_user_id$cnt' value='".$userDeltais['TUser']['USER_ID']."' >";
						echo "<td>";
						echo $this->Form->label ( '',$userDeltais['TUser']['USER_ID'], array (
								'name' => 'data[TUser][USER_ID]',
								'value' => $userDeltais['TUser']['USER_ID']
						) );
						echo "</td>";
						
						echo "<td>";
						echo $this->Form->input ( '', array (
								'name' => 'data[TUser][USER_PASSWORD]',
								'id' => 'id_user_password'.$cnt,
								'type' => 'text',
								'class' => 'w100',
								'label' => false,
								'div' => false,
								'error' => false,
								'maxlength'=>'32',
								'value' => $userDeltais['TUser']['USER_PASSWORD']
						) );
						echo "</td>";
						
						$attributes = array('name'=> 'data[TUser][AUTH_ROLE]','legend' => false, 'default' => $userDeltais['TUser']['AUTH_ROLE'], 'label' => false);
						if($login_user_role == RwsConstant::USER_AUTH_ROLE_ADMIN){
							echo "<td>";
							$options = array('0' => '');
							echo $this->Form->radio('AUTH_ROLE', $options, $attributes);
							echo "</td>";
						}
						if($login_user_role <= RwsConstant::USER_AUTH_ROLE_SUB){
							echo "<td>";
								$options = array('1' => '');
								echo $this->Form->radio('AUTH_ROLE', $options, $attributes);
							echo "</td>";
						}
						if($login_user_role <= RwsConstant::USER_AUTH_ROLE_M2){
							echo "<td>";
							$options = array('2' => '');
							echo $this->Form->radio('AUTH_ROLE', $options, $attributes);
							echo "</td>";
						}
						if($login_user_role <= RwsConstant::USER_AUTH_ROLE_M3){
							echo "<td>";
							$options = array('3' => '');
							echo $this->Form->radio('AUTH_ROLE', $options, $attributes);
							echo "</td>";
						}
						
						echo "<td>";
						$options = array('4' => '');
						echo $this->Form->radio('AUTH_ROLE', $options, $attributes);
						echo "</td>";
						
						echo "<td>";
						echo $this->Form->input ( '', array (
								'name' => 'data[TUser][MAIL_ADDRESS]',
								'id' => 'id_mail_address'.$cnt,
								'type' => 'text',
								'class' => 'w150',
								'label' => false,
								'div' => false,
								'error' => false,
								'value' =>  $userDeltais['TUser']['MAIL_ADDRESS'],
								'maxlength'=>'255'
						) );
						echo "</td>";

						if($login_user_role <= RwsConstant::USER_AUTH_ROLE_SUB){
							echo "<td>";
							echo $this->Form->label ( '',$userDeltais['TUser']['LAST_LOGIN'], array (
									'name' => 'data[TUser][LAST_LOGIN]',
									'value' => $userDeltais['TUser']['LAST_LOGIN']
							) );
							echo "</td>";
						}

						echo "<td>".$this->Form->input('', array('name' => 'data[TUser][AUTH_DEMAND_FORECAST_EDIT]','type'=>'checkbox','label' => false, 'checked' => $userDeltais['TUser']['AUTH_DEMAND_FORECAST_EDIT']))."</td>";
						
						echo "<td class='tc' style='width: 12%;'><input type='button' onClick='fnc_doCheckUpdateUser($cnt);' style='float:left;' value='".$scrFieldLabels['BTN_EDITUSER_CHANGE']."' />";
						echo $this->Form->end();
						
						echo $this->Form->create('TUserNew', array('name'=>'deleteForm'.$cnt, 'url' => array ('controller' => 'editUser', 'action' => 'doDeleteUser'), 'role' => 'form', 'novalidate' => true));
						echo "<input type='hidden' name='user_id' value='".$userDeltais['TUser']['USER_ID']."' >";
						if($userDeltais['TUser']['USER_ID'] == $user_id_login){
							echo "<a onclick=\"confirmDeleteSelf(".$cnt.")\"><img src='../img/trash_ico.png' /></a></td>";
						}
						else{
							echo "<a onclick=\"confirmDelete(".$cnt.")\"><img src='../img/trash_ico.png' /></a></td>";
						}
						echo "<td></td>";
						echo $this->Form->end();
						echo "</tr>";
						
						$cnt++;
					}
				}
			?>
		</tbody>
	</table>
	
	<table summary="user list" class="table-list_edit">
		<caption><?php echo $scrFieldLabels['SCR_EDITUSER_USERINFO'];?></caption>
		<thead>
			<tr>
				<th>Username</th>
				<th>Full name</th>
				<th>Api Key</th>
				<th>Show avata</th>
				<th>Notice email</th>
				<th>Show title video</th>
				<th></th>
			</tr>
		</thead>
		<tbody class="table-center">
			<?php 
				if(isset($userlist)){
					$cnt = 0;
					echo "<input type='hidden' id='user_cnt' value='".sizeof($userlist)."' >";
					foreach ($userlist as $userDeltais){
						if($cnt % 2 == 0){
							echo "<tr>";
						}
						else{
							echo "<tr class='trc'>";
						}
						echo $this->Form->create('', array('name' => 'TCustomerNewIndexForm'.$cnt, 'url' => array ('controller' => 'editUser', 'action' => 'doChangeCustomer'), 'role' => 'form', 'novalidate' => true));
						
						echo "<input type='hidden' name='data[TCustomer][USER_ID]' id='id_user_id$cnt' value='".$userDeltais['TCustomer']['USER_ID']."' >";
						echo "<td>";
						echo $this->Form->label ( '',$userDeltais['TCustomer']['USER_ID'], array (
								'name' => 'data[TCustomer][USER_ID]',
								'value' => $userDeltais['TCustomer']['USER_ID']
						) );
						echo "</td>";
						
						
						echo "<td>";
						echo $this->Form->input ( '', array (
								'name' => 'data[TCustomer][CUSTOMER_NAME]',
								'id' => 'id_customer_name'.$cnt,
								'type' => 'text',
								'class' => 'w150',
								'label' => false,
								'div' => false,
								'error' => false,
								'value' =>  $userDeltais['TCustomer']['CUSTOMER_NAME'],
								'maxlength'=>'255'
						) );
						echo "</td>";
						
						echo "<td>";
						echo $this->Form->input ( '', array (
								'name' => 'data[TCustomer][API_KEY]',
								'id' => 'id_api_key'.$cnt,
								'type' => 'text',
								'class' => 'w200',
								'label' => false,
								'div' => false,
								'error' => false,
								'value' =>  $userDeltais['TCustomer']['API_KEY'],
								'maxlength'=>'255'
						) );
						echo "</td>";
						
						echo "<td>".$this->Form->input('id_show_avata', array('name' => 'data[TCustomer][SHOW_AVATA]','type'=>'checkbox','label' => false, 'checked' => $userDeltais['TCustomer']['SHOW_AVATA']))."</td>";
						echo "<td>".$this->Form->input('id_notice_email', array('name' => 'data[TCustomer][NOTICE_EMAIL]','type'=>'checkbox','label' => false, 'checked' => $userDeltais['TCustomer']['NOTICE_EMAIL']))."</td>";
						echo "<td>".$this->Form->input('id_show_title_video', array('name' => 'data[TCustomer][SHOW_TITLE_VIDEO]','type'=>'checkbox','label' => false, 'checked' => $userDeltais['TCustomer']['SHOW_TITLE_VIDEO']))."</td>";
						
						echo "<td class='tc' style='width: 12%;'><input type='button' onClick='fnc_doCheckUpdateCustomer($cnt);' style='float:left;' value='".$scrFieldLabels['BTN_EDITUSER_CHANGE']."' />";
						echo $this->Form->end();
						echo "</tr>";
						
						$cnt++;
					}
				}
			?>
		</tbody>
	</table>
	
	
	<table class="table-list_edit">
		<caption>Backlink - Hãy tạo backlink cho trang web này, bạn sẽ được sử dụng miễn phí.
		<br>
		<a href="<?php echo RwsConstant::FULL_BASE_URL_HOST ?>/news?id=55495&Cach_tao_backlink">Hướng dẫn tạo backlink </a>, hoặc đơn giản là share trang này lên facebook, g+. 
		</caption>
		<thead>
			<tr>
				<th>Username</th>
				<th>Link</th>
				<th>Create date</th>
				<th>Approve</th>
				<th>Note</th>
				<th></th>
			</tr>
		</thead>
		<tbody class="table-center">
			<?php 
				if(isset($backlinkList)){
					$cnt = 0;
					echo "<input type='hidden' id='backlink_cnt' value='".sizeof($backlinkList)."' >";
					foreach ($backlinkList as $backlink){
						if($cnt % 2 == 0){
							echo "<tr>";
						}
						else{
							echo "<tr class='trc'>";
						}
						if($login_user_role >= RwsConstant::USER_AUTH_ROLE_SUB){
							echo $this->Form->create('', array('name' => 'TBacklinkIndexForm'.$cnt, 'url' => array ('controller' => 'editUser', 'action' => 'doChangeApprove'), 'role' => 'form', 'novalidate' => true));
							echo "<input type='hidden' name='data[TBacklink][ID]' id='id_backlnk_id$cnt' value='".$backlink['TBacklink']['ID']."' >";
							echo "<input type='hidden' name='data[TBacklink][USER_ID]' id='id_backlnk_user_id$cnt' value='".$backlink['TBacklink']['USER_ID']."' >";
							
							echo "<td>";
							echo $backlink['TBacklink']['USER_ID'];
							echo "</td>";
							
							echo "<td>";
							echo $this->Form->input ( '', array (
									'name' => 'data[TBacklink][LINK]',
									'id' => 'id_backlink_link'.$cnt,
									'type' => 'text',
									'class' => 'wP100',
									'label' => false,
									'div' => false,
									'error' => false,
									'value' =>  $backlink['TBacklink']['LINK'],
									'maxlength'=>'255'
							) );
							echo "</td>";
							
							echo "<td>";
							echo $this->Form->input ( '', array (
									'name' => 'data[TBacklink][DATE]',
									'id' => 'id_backlink_date'.$cnt,
									'type' => 'text',
									'class' => 'wP100',
									'label' => false,
									'div' => false,
									'error' => false,
									'value' =>  $backlink['TBacklink']['DATE'],
									'maxlength'=>'255'
							) );
							echo "</td>";
							echo "<td>".$this->Form->input('id_chk_approve'.$cnt, array('name' => 'data[TBacklink][APPROVE]','type'=>'checkbox','label' => false, 'checked' => $backlink['TBacklink']['APPROVE']))."</td>";
							echo "<td>";
							echo $this->Form->input ( '', array (
									'name' => 'data[TBacklink][NOTE]',
									'id' => 'id_backlink_note'.$cnt,
									'type' => 'text',
									'class' => 'w200',
									'label' => false,
									'div' => false,
									'error' => false,
									'value' =>  $backlink['TBacklink']['NOTE'],
									'maxlength'=>'255'
							) );
							echo "</td>";
							
							echo "<td class='tc' style='width: 12%;'><input type='button' onClick='fnc_doCheckUpdateApprove($cnt);' style='float:left;' value='".$scrFieldLabels['BTN_EDITUSER_CHANGE']."' />";
							echo $this->Form->end();
							echo "</tr>";
						} else {
							echo "<input type='hidden' name='data[TBacklink][ID]' id='id_backlnk_id$cnt' value='".$backlink['TBacklink']['ID']."' >";
							echo "<td>";
							echo $backlink['TBacklink']['USER_ID'];
							echo "</td>";
							echo "<td>";
							echo $backlink['TBacklink']['LINK'];
							echo "</td>";
							echo "<td>";							
							echo $backlink['TBacklink']['DATE'];							
							echo "</td>";
							echo "<td>".$this->Form->input('id_chk_approve'.$cnt, array('name' => 'data[TBacklink][APPROVE]','type'=>'checkbox','label' => false, 'checked' => $backlink['TBacklink']['APPROVE'], 'onclick' => 'return false;'))."</td>";
							echo "<td>";
							echo $backlink['TBacklink']['NOTE'];
							echo "</td>";
							echo "</tr>";
						}
						$cnt++;
					}
				}
				
				//Create new link 
				if($cnt % 2 == 0){
					echo "<tr>";
				}
				else{
					echo "<tr class='trc'>";
				}
				echo $this->Form->create('', array('name' => 'TBacklinkIndexFormNew', 'url' => array ('controller' => 'editUser', 'action' => 'doCreateNewBacklink'), 'role' => 'form', 'novalidate' => true));
				$date = new DateTime();
				echo "<input type='hidden' name='data[TBacklink][USER_ID]' id='id_backlnk_id_new' value='$user_id_login' >";
				echo "<input type='hidden' name='data[TBacklink][DATE]' id='id_backlnk_date_new' value=".$date->format('Y-m-d')." >";
				echo "<td style='width: 10%;'>";
				echo $user_id_login;
				echo "</td>";
				
				echo "<td>";
				echo $this->Form->input ( '', array (
						'name' => 'data[TBacklink][LINK]',
						'id' => 'id_backlink_link_new',
						'type' => 'text',
						'class' => 'wP100',
						'label' => false,
						'div' => false,
						'error' => false,
						'value' =>  '',
						'maxlength'=>'1000'
				) );
				echo "</td>";
				
				echo "<td style='width: 9%;'>";
				
				echo $this->Form->label ( '',$date->format('Y-m-d'), array (
						'name' => 'data[TBacklink][DATE]',
						'value' => $date->format('Y-m-d')
				) );
				echo "</td>";
				
				echo "<td style='width: 9%;'></td>";
				echo "<td style='width: 20%;'></td>";
				
				echo "<td class='tc' style='width: 50px;'><input type='button' onClick='fnc_doCheckBackLinkNew();' style='float:left;' value='".$scrFieldLabels['BTN_ADD']."' />";
				echo $this->Form->end();
				echo "</tr>";
			?>
		</tbody>
	</table>
</div>
