<div class="notice">
	<?php if ($message_type === RwsConstant::MSG_SUCCESS) {?>
	<div class="success">
		<p><?php echo h($message); ?></p>
	</div>
	<?php } else {?>
	<div class="error">
		<p><?php echo h($message); ?></p>
	</div>
	<?php }?>
</div>