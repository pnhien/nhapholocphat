<?php 
	echo $this->Html->script (array(
			'jquery/ajaxform'
	));
?>
<script type="text/javascript">
	function fnc_doChangePass() {
		$('#id_div_flash').empty().hide();
		$('#id_div_error').empty().hide();

		var user_password_old = $('#id_setting_old_pass').val();
		var user_password_new = $('#id_setting_new_pass').val();
		var user_password_new_confirm = $('#id_setting_new_pass_confirm').val();
		
		if (user_password_old == '') {
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>' + '<?php echo $messageList['USERSETTING_ERR_000000'];?>' + '</p>';
			html += '	</div>';
			html += '</div>';
			$('#id_div_error').append(html).show();
			$('#id_setting_old_pass').focus();
			return;
		}

		if (user_password_new == '') {
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>' + '<?php echo $messageList['USERSETTING_ERR_000002'];?>' + '</p>';
			html += '	</div>';
			html += '</div>';
			$('#id_div_error').append(html).show();
			$('#id_setting_new_pass').focus();
			return;
		}

		if (user_password_new_confirm == '') {
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>' + '<?php echo $messageList['USERSETTING_ERR_000006'];?>' + '</p>';
			html += '	</div>';
			html += '</div>';
			$('#id_div_error').append(html).show();
			$('#id_setting_new_pass_confirm').focus();
			return;
		}

		if (user_password_new_confirm != user_password_new) {
			var html = '<div class="notice">';
			html += '	<div class="error">';
			html += '		<p>' + '<?php echo $messageList['USERSETTING_ERR_000003'];?>' + '</p>';
			html += '	</div>';
			html += '</div>';
			$('#id_div_error').append(html).show();
			$('#id_setting_new_pass_confirm').focus();
			return;
		}
				
		var dataInput = [user_password_old, user_password_new, user_password_new_confirm];
		$.ajax({
			url : <?php echo (SUB_DOMAIN!='' ? "'/".SUB_DOMAIN : "")."/userPersonalSetting/doCheckChangePass'"?> ,
			type : 'POST',
			data : {dataInput: dataInput},
			cache : false,
			dataType : 'json', 
			async : false,
			success : function(result) {
				if (result['success']) {
					document.forms['TUserIndexForm'].submit();
				} else {
					var html = '<div class="notice">';
					html += '	<div class="error">';
					html += '		<p>' + result['data'] + '</p>';
					html += '	</div>';
					html += '</div>';
					$('#id_div_error').append(html).show();
					$('#' + result['id_error']).focus();
				}
		    },
		    error : function (result) {
		    	openAlertDialog(MESSAGE_ERROR_AJAX);
		    }
		});
    }
</script>
		<div class="capture-area">
          	<?php echo $this->Form->create('TUser', array('url' => array ('controller' => 'userPersonalSetting', 'action' => 'doChangePass'), 'role' => 'form', 'novalidate' => true)); ?>
            <table summary="user list" class="table-noColor w380">
              <caption><?php echo  $scrFieldLabels['USERSETTING_PASSCHANGE'];?></caption>
              <tbody>
                <tr>
                  <td><?php echo  $scrFieldLabels['USERSETTING_OLDPASS'];?></td>
                  <td>
                  	<?php
                  	if(!isset($user_password_old)){
                  		$user_password_old = "";
                  	}
					echo $this->Form->input ( 'USER_PASSWORD_OLD', array (
							'type' => 'text',
							'class' => 'w100',
							'label' => false,
							'div' => false,
							'error' => false,
							'id' => 'id_setting_old_pass',
							'value' => $user_password_old
					) );
					?>
                  </td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><?php echo  $scrFieldLabels['USERSETTING_NEWPASS'];?></td>
                  <td>
                  	<?php
                  	if(!isset($user_password_new)){
                  		$user_password_new = "";
                  	}
					echo $this->Form->input ( 'USER_PASSWORD_NEW', array (
							'type' => 'text',
							'class' => 'w100',
							'label' => false,
							'div' => false,
							'error' => false,
							'id' => 'id_setting_new_pass',
							'value' => $user_password_new
					) );
					?>
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <td><?php echo  $scrFieldLabels['USERSETTING_NEWPASSCNF'];?></td>
                  <td>
                  	<?php
                  	if(!isset($user_password_new_confirm)){
                  		$user_password_new_confirm = "";
                  	}
					echo $this->Form->input ( 'USER_PASSWORD_NEW_CONFIRM', array (
							'type' => 'text',
							'class' => 'w100',
							'label' => false,
							'div' => false,
							'error' => false,
							'id' => 'id_setting_new_pass_confirm',
							'value' => $user_password_new_confirm
					) );
					?>
                  </td>
                  <td>
                  <input type="button" onClick="fnc_doChangePass();" value="<?php echo  $scrFieldLabels['BTN_USERSETTING_PASS_CHANGE'];?>"></td>
                </tr>
              </tbody>
            </table>
            <?php echo $this->Form->end() ?>
            
            <?php echo $this->Form->create('TUser', array('url' => array ('controller' => 'userPersonalSetting', 'action' => 'doChangeLanguage'), 'role' => 'form', 'novalidate' => true)); ?>
            <table summary="user list" class="table-noColor w380">
              <caption><?php echo  $scrFieldLabels['USERSETTING_USERLANGUAGE'];?></caption>
              <tbody>
                <tr>
                  <td colspan="3">
                  
                  <?php
                  	$options = array('0' => 'Tiếng Việt &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '1' => 'English');
                  	$attributes = array('legend' => false);
                  	if(isset($userlanguage)){
	                  	if($userlanguage == '1') {
	                  		$attributes['default'] = '1';
	                  	}
	                  	else{
	                  		$attributes['default'] = '0';
	                  	}
                  	}
					echo $this->Form->radio('LANGUAGE', $options, $attributes);	
					
					?>
	                  </td>
                  <td><input type="submit" value="<?php echo  $scrFieldLabels['BTN_USERSETTING_USERLANGUAGE_CHANGE'];?>"></td>
                </tr>
              </tbody>
            </table>
            <?php echo $this->Form->end() ?>
            
            <?php echo $this->Form->create('TCustomer', array('url' => array ('controller' => 'userPersonalSetting', 'action' => 'doChangeCustomer'), 'role' => 'form', 'novalidate' => true)); ?>
            <table summary="user list" class="table-noColor w480">
              <caption>Thay đổi thông tin</caption>
              <colgroup>
				  <col style='width: 150px;'>
				  <col style='width: 150px;'>
			  </colgroup>
              <tbody>
              <tr>
              <td>Tên người dùng</td>
              <td>
              	<?php
					echo $this->Form->input ( 'CUSTOMER_NAME', array (
							'type' => 'text',
							'class' => 'w150',
							'label' => false,
							'div' => false,
							'error' => false,
							'id' => 'id_customer_name',
							'value' => isset($TCustomer['CUSTOMER_NAME']) ? $TCustomer['CUSTOMER_NAME'] : '' 
					) );
					?>
              </td>
              <td>&nbsp;</td>
            </tr>
              <tr>
                <td>API Key</td>
                <td>
                	<?php
					echo $this->Form->input ( 'API_KEY', array (
							'type' => 'text',
							'class' => 'w150',
							'label' => false,
							'div' => false,
							'error' => false,
							'id' => 'id_api_key',
							'value' => isset($TCustomer['API_KEY']) ? $TCustomer['API_KEY'] : '' 
					) );
					?>
                </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Hiển thị ảnh đại diện</td>
                <td>
                	<?php
					echo $this->Form->input ( 'SHOW_AVATA', array (
							'type' => 'checkbox',
							'class' => 'w100',
							'label' => false,
							'div' => false,
							'error' => false,
							'id' => 'id_show_avata',
							'checked' => isset($TCustomer['SHOW_AVATA']) ? $TCustomer['SHOW_AVATA'] : '0'
					) );
					?>
                </td>
                <td></td>
              </tr>
              <tr>
                <td>Thông báo bằng Email</td>
                <td>
                	<?php
					echo $this->Form->input ( 'NOTICE_EMAIL', array (
							'type' => 'checkbox',
							'class' => 'w100',
							'label' => false,
							'div' => false,
							'error' => false,
							'id' => 'id_notice_email',
							'checked' => isset($TCustomer['NOTICE_EMAIL']) ? $TCustomer['NOTICE_EMAIL'] : '0'
					) );
					?>
                </td>
                <td>
              </tr>
              <tr>
              <td>Hiển thị tiêu đề Video</td>
              <td>
              	<?php
					echo $this->Form->input ( 'SHOW_TITLE_VIDEO', array (
							'type' => 'checkbox',
							'class' => 'w100',
							'label' => false,
							'div' => false,
							'error' => false,
							'id' => 'id_show_title_video',
							'checked' => isset($TCustomer['SHOW_TITLE_VIDEO']) ? $TCustomer['SHOW_TITLE_VIDEO'] : '0'
					) );
					?>
              </td>
              <td>
              <input type="submit"  value="Thay đổi thiết lập"></td>
            </tr>
            </tbody>
            </table>
            <?php echo $this->Form->end() ?>
          </div>