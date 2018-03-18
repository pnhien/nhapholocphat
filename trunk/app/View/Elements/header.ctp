<div class="header">
	<?php if ($this->Session->check(RwsConstant::SESSION_LOGIN_USER_KEY)) {?>
	<div class="common-header">
		<ul class="common-drop">
			<li class="li-user">
				<a href="#">
					<?php echo $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);?>
				</a>
				<ul>
					<li>
					<?php echo $this->Html->link(__('Log Out'), array('controller' => 'login', 'action' => 'doLogout'), array('escape' => false, 'id' => 'logout')); ?>
					</li>
				</ul>
			</li>
		</ul>
	</div>
	<?php }?>
	<div class="title-header">
		<div class="inner">
			<div class="system-name">Youman</div>
			<div class="user-info"></div>
		</div>
	</div>
</div>
