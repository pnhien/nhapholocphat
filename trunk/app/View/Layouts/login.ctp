<html lang="vi">
<head>
<link rel="icon" type="image/x-icon"
	href="<?php echo RwsConstant::FULL_BASE_URL_HOST?>/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="content-language" content="en" />
<meta content="width=300, initial-scale=1" name="viewport">
<meta name="description" content="The system videos Youtube manage, Hệ thống quản lý video in youtube.">
<title><?php echo $title;?></title>
<meta name="Language" CONTENT="english">
<meta name="Author" CONTENT="YOUMAN, admin@nhapholocphat.com">
<meta name="keywords" CONTENT="Login, Video, News, Entertainment, Video youtube manage, Thời sự tổng hợp, giải trí, Quản lý video youtube">
<meta name="robots" CONTENT="nofollow">
  <?php 
  echo $this->Html->css(
				array(
						'login','createuser'
				));
  ?>
  
  <script>
		function fnc_onchange_language() {
			var link = window.location.href; 
			var lang = $("#id_cmb_language").val();
			var url = '<?php echo RwsConstant::FULL_BASE_URL_HOST;?>' + '/login/doChangeLanguage?language=' + lang + '&link=' + link;
			location.href = url;
		}
  </script>
</head>
<body>

	<!-- CONTENT
		================================================== -->
		<?php echo $this->fetch('content'); ?>
		
		<div id="footer-container" class="language">
		<div id="footer-links">
			<span><?php echo  $scrFieldLabels['SCR_LABLE_LANGUAGE'];?></span> <select
				id="id_cmb_language" onchange="fnc_onchange_language()">
				<option value="<?php echo RwsConstant::LANGUAGE_VN;?>"
					<?php if($language == RwsConstant::LANGUAGE_VN) { echo 'selected'; }?>>Việt
					Nam</option>
				<option value="<?php echo RwsConstant::LANGUAGE_EN;?>"
					<?php if($language == RwsConstant::LANGUAGE_EN) { echo 'selected'; }?>>English</option>
				<option value="<?php echo RwsConstant::LANGUAGE_JA;?>"
					<?php if($language == RwsConstant::LANGUAGE_JA) { echo 'selected'; }?>>日本語</option>
			</select>
		</div>
	</div>
	<!-- FOOTER
		================================================== -->
		<?php echo $this->Element('footer'); ?>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>