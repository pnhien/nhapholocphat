<?php
$login_user_role = 0 + $this->Session->read('login.user.AUTH_ROLE');
?>

<div id="id_left_menu" class="menu-nav">
	<div class="inner">
		<div class="title-area"></div>
		<div class="list-area">
			<label for="menu1"><?php echo $scrFieldLabels['MENU_USER'];?></label>
			<input type="checkbox" id="menu1" name="menu1" class="on-off" />
			<ul>
				<li class="active">
					<a id="SCR_USER_SITELIST" href="<?php echo FULL_BASE_URL;?>/user/sitelist">
						<?php echo $scrFieldLabels['SCR_USER_SITELIST'];?>
					</a>
				</li>
				<li>
					<a id="SCR_USER_PROFILE" href="/user/profile">
						<?php echo $scrFieldLabels['SCR_USER_PROFILE'];?>
					</a>
				</li>
			</ul>
			
<?php 
// AUTH <= DUTY
if ($login_user_role <= RwsConstant::USER_AUTH_ROLE_SUB) {
?>
			<label for="menu2"><?php echo $scrFieldLabels['MENU_DUTY'];?></label>
			<input type="checkbox" id="menu2" name="menu2" class="on-off" />
			<ul>
				<li>
					<a id="SCR_DUTY_RECEIVE_ALARM" href="/duty/receivealarm">
						<?php echo $scrFieldLabels['SCR_DUTY_RECEIVE_ALARM'];?>
					</a>
				</li>
				<li>
					<a id="SCR_DUTY_UNNECCESSARY_CONTACT_ALARM_LIST" href="/duty/noneedcontactalarmlist">
						<?php echo $scrFieldLabels['SCR_DUTY_UNNECCESSARY_CONTACT_ALARM_LIST'];?>
					</a>
				</li>
				<li>
					<a id="SCR_DUTY_ALARM_EVENT_TRACE" href="/duty/alarmeventtrace">
						<?php echo $scrFieldLabels['SCR_DUTY_ALARM_EVENT_TRACE'];?>
					</a>
				</li>
				<li>
					<a id="SCR_DUTY_SYSTEM_HEALTH_CHECK" href="#">
						<?php echo $scrFieldLabels['SCR_DUTY_SYSTEM_HEALTH_CHECK'];?>
					</a>
				</li>
				<li>
					<a id="SCR_DUTY_DATA_ANALYSIS" href="/duty/dataanalysis">
						<?php echo $scrFieldLabels['SCR_DUTY_DATA_ANALYSIS'];?>
					</a>
				</li>
			</ul>
			<label for="menu3"><?php echo $scrFieldLabels['MENU_EDIT'];?></label>
			<input type="checkbox" id="menu3" name="menu3" class="on-off" />
			<ul>
				<li>
					<a id="SCR_EDIT_SITE" href="/edit/site">
						<?php echo $scrFieldLabels['SCR_EDIT_SITE'];?>
					</a>
				</li>
				<li>
					<a id="SCR_EDIT_USER" href="/edit/user">
						<?php echo $scrFieldLabels['SCR_EDIT_USER'];?>
					</a>
				</li>
				<li>
					<a id="SCR_EDIT_COMMON" href="/edit/common">
						<?php echo $scrFieldLabels['SCR_EDIT_COMMON'];?>
					</a>
				</li>
			</ul>
	<?php 
	// AUTH = ADMIN
	if ($login_user_role === 0) {
	?>
			<label for="menu4"><?php echo $scrFieldLabels['MENU_MANAGE'];?></label>
			<input type="checkbox" id="menu4" name="menu4" class="on-off" />
			<ul>
				<li>
					<a id="SCR_MANAGE_MEASURE_POINTID" href="/manage/measurepointid">
						<?php echo $scrFieldLabels['SCR_MANAGE_MEASURE_POINTID'];?>
					</a>
				</li>
				<li>
					<a id="SCR_MANAGE_SETTING" href="/manage/colorsoundsetting">
						<?php echo $scrFieldLabels['SCR_MANAGE_SETTING'];?>
					</a>
				</li>
				<li>
					<a id="SCR_MANAGE_VIEW_OPERATION_LOG" href="/manage/viewoperationhistorylog">
						<?php echo $scrFieldLabels['SCR_MANAGE_VIEW_OPERATION_LOG'];?>
					</a>
				</li>
				<li>
					<a id="SCR_MANAGE_VIEW_SERVER_SYSTEM_LOG" href="/manage/viewserversystemlog">
						<?php echo $scrFieldLabels['SCR_MANAGE_VIEW_SERVER_SYSTEM_LOG'];?>
					</a>
				</li>
				<li>
					<a id="SCR_MANAGE_SENT_ADVICE_EMAIL" href="/SentMailHistory/index">
						<?php echo $scrFieldLabels['SCR_MANAGE_SENT_ADVICE_EMAIL'];?>
					</a>
				</li>
				<li>
					<a id="SCR_MANAGE_CONFIG_SERVER" href="/manage/configserver">
						<?php echo $scrFieldLabels['SCR_MANAGE_CONFIG_SERVER'];?>
					</a>
				</li>
			</ul>
<?php }

}?>
		</div>
	</div>
</div>

<br class="clear" />

<script type="text/javascript">
$(document).ready(function() {
	$('#id_left_menu a').bind('click', function(e) {
		e.preventDefault();
		var screen_id = $(this).attr('id');
		var url = $(this).attr('href');
		// Execute ajax to write session the screen
		if (ajaxRunning == true) {
			return;
		}
		ajaxRunning = true;
		$.ajax({
			url : '/app/setSessionSelectedSite',
			type : 'POST',
			data : {
				screen_id: screen_id
			},
			cache : false,
			dataType : 'json',
			success: function(result) {
				ajaxRunning = false;
				if (result.success) {
					location.href = url;
				}
			},
			error: function() {
				ajaxRunning = false;
				openAlertDialog(MESSAGE_ERROR_AJAX);
			}
		});
	});
});
</script>