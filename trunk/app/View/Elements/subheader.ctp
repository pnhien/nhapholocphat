<div class="bc-nav">
<?php if (!empty($urlHistories)) {?>
	<ul>
	<?php if (count($urlHistories) > 2) {?>
		<li class="prevp"><a href="javascript:void(0);" onclick="fnc_goback();" class="button">戻る</a></li>
	<?php }
	$last_url = '';
	for ($i = 0; $i < count($urlHistories); $i++) {?>
		<?php if ($i === 0) {?>
			<li><span><?php echo $urlHistories[$i];?></span>&gt;</li>
		<?php } else if ($i < count($urlHistories) - 1) {?>
			<li><span><?php echo $urlHistories[$i];?></span>&gt;</li>
		<?php } else {
			$last_url = $urlHistories[$i]; ?>
			<li class="active"><span><?php echo $urlHistories[$i];?></span></li>
	<?php } 
	}?>
	</ul>
<?php }?>
</div>

<h1><?php echo $last_url;?></h1>