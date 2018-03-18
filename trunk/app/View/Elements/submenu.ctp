<?php if (!empty($sub_menu_sites)) { ?>
<div class="tool-nav" style="background-color: #a9bbd5;">
	<ul class="main-drop">
	<?php 
	$site_id = '';
	$site_auth_edit = '0';
	if ($this->Session->check('auth')) {
		$site_id = $this->Session->read('auth.SITE_ID');
		$site_auth_edit = 0 + $this->Session->read('auth.AUTH_EDIT');
	}
	foreach ($sub_menu_sites as $sub_menu) {
		$submenu_auth_edit = 0 + $sub_menu['auth_edit'];
		if ($submenu_auth_edit === 0 || ($submenu_auth_edit === 1 && $site_auth_edit === 1)) { 
			$submenu_name_id = $sub_menu['name'];
		?>
		<li>
			<span><?php echo $scrFieldLabels[$submenu_name_id];?></span>
			<?php 
			$sub_sites = $sub_menu['sub_screen_list'];
			if (!empty($sub_sites)) { ?>
				<ul>
				<?php 
				foreach ($sub_sites as $site) {
					$subscreen_id = $site['sub_screen_id'];
					$subscreen_name = '';
					if (RwsHelper::isNotEmpty($subscreen_id)) {
						$subscreen_name = $scrFieldLabels[$subscreen_id];
					} else {
						$subscreen_name = $site['sub_screen_name'];
					}
					
					$url = $site['url'];
					$params = $site['params'];
					if (RwsHelper::isNotEmpty($params)) {
						$url .= '?' . $params;
					}
				?>
					<li><a href="<?php echo $url;?>"><?php echo $subscreen_name;?></a></li>
				<?php }?>
				</ul>
			<?php }?>
		</li>
		<?php }?>
	<?php }?>
	</ul>
</div>
<?php }?>