<script>
	var row = 5;
	$(window).resize(function() {
		var myDiv = document.getElementById("id_content_view");
		var divWidth = myDiv.offsetWidth;
		var rowCount = Math.floor((divWidth)/212.5);
		$('#id_recommended_01').css("margin-left",(divWidth - rowCount * 212.5)/2);
		$('#id_recommended_02').css("margin-left",(divWidth - rowCount * 212.5)/2);
		$('#id_recommended_03').css("margin-left",(divWidth - rowCount * 212.5)/2);
		
		$('#id_recommended_01').css("width",rowCount * 212.5);
		$('#id_recommended_02').css("width",rowCount * 212.5);
		$('#id_recommended_03').css("width",rowCount * 212.5);
		rowCount = rowCount * row;

	  	if(rowCount != $('#hdn_id_stype_width').val()){
	  		$('#hdn_id_stype_width').val(rowCount);

	  		for(var i = 0 ; i < (rowCount/row)*2 ; i++){
		  		$('#id_video_li' + i).css("display","");
		  	}
	  		for(var i = 40 ; i >= (rowCount/row)*2 ; i--){
		  		$('#id_video_li' + i).css("display","none");
		  	}
	  		for(var i = 0 ; i < rowCount ; i++){
		  		$('#id_list0_li' + i).css("display","");
		  		$('#id_list1_li' + i).css("display","");
		  	}
	  		for(var i = 40 ; i >= rowCount ; i--){
		  		$('#id_list0_li' + i).css("display","none");
		  		$('#id_list1_li' + i).css("display","none");
		  	}
	  	}
	});

	$(document).ready(function() {
		var myDiv = document.getElementById("id_content_view");
		var divWidth = myDiv.offsetWidth;
		var rowCount = Math.floor((divWidth)/212.5);
		$('#id_recommended_01').css("margin-left",(divWidth - rowCount * 212.5)/2);
		$('#id_recommended_02').css("margin-left",(divWidth - rowCount * 212.5)/2);
		$('#id_recommended_03').css("margin-left",(divWidth - rowCount * 212.5)/2);
		
		$('#id_recommended_01').css("width",rowCount * 212.5);
		$('#id_recommended_02').css("width",rowCount * 212.5);
		$('#id_recommended_03').css("width",rowCount * 212.5);		
		rowCount = rowCount * row;
		for(var i = 40; i >= (rowCount/row)*2 ; i--){
	  		$('#id_video_li' + i).css("display","none");
	  	}
	  	for(var i = 40; i >= rowCount ; i--){
	  		$('#id_list0_li' + i).css("display","none");
	  		$('#id_list1_li' + i).css("display","none");
	  	}
	});
		
</script>

<div id="id_content_view" class='content_view'>

<?php 
	if ($this->Session->check(RwsConstant::SESSION_LOGIN_USER_KEY)) { 
		$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		$login_user_role = 0 + $this->Session->read('login.user.AUTH_ROLE');
		echo "<input type='hidden' name='hdn_id_session_login_user_key' id='hdn_id_session_login_user_key' value='".$user_id_login."'>";
	}
?>
<input type='hidden' name='hdn_id_stype_width' id='hdn_id_stype_width' value='18'>
<?php
	if(isset($resultsHtml)){
?>
		<input type='hidden' name='hdn_id_results_param' id='hdn_id_results_param' value='<?php echo $resultsParam; ?>'>
		<div id='id_recommended_01' class="recommended">
			<h1>Tìm kiếm video</h1>
		</div>
		<div class='results_content'>
		<?php echo $resultsHtml; ?>
		</div>
<?php
	}
	if(isset($videos)){
?>
<div id='id_recommended_01' class="recommended">
	<h2>
		<?php 
			echo $scrFieldLabels['HOME_CATALOG_003'] . " " . $scrFieldLabels['HOME_CATALOG_001'];
		?>
	</h2>
</div>
<ul id="id_list_video">
	<?php
	$host = RwsConstant::FULL_BASE_URL_HOST;
	$cntNews = 0;
	foreach ($videos as $video){
	?>
	<li class="yt-shelf-grid-item yt-uix-shelfslider-item" id="id_video_li<?php echo $cntNews++;?>">
		<div class="yt-lockup yt-lockup-grid yt-lockup-video clearfix">
			<div class="yt-lockup-dismissable">
				<?php echo "<a href='$host/watch?v=".$video['TVideo']['VIDEO_ID']."'>"; ?>
				<div class="yt-lockup-thumbnail">
					<div class="yt-thumb video-thumb">
						<img alt="<?php echo $video['TVideo']['TITLE'];?>"
							src="<?php echo $video['TVideo']['THUMBNAILS'];?>" width="200"
							height="120">
					</div>
				</div>
				<?php echo "</a>";?>
				<?php echo "<a href='$host/watch?v=".$video['TVideo']['VIDEO_ID']."'>"; ?>
				<div class="yt-lockup-content">
					<h3 class="yt-lockup-title">
						<?php 
							echo $video['TVideo']['TITLE'];
						?>
					</h3>
				</div>
				<?php echo "</a>";?>
			</div>
		</div>
	</li>
	<?php 
	}
	?>
</ul>
<?php 
	}
	if(isset($newsList)){
?>

	<div id='id_recommended_03' class="recommended">
		<h2><a href="<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/newsList?type=1">
		<?php 
			echo $scrFieldLabels['HOME_CATALOG_004'] . " - " . $scrFieldLabels['HOME_CATALOG_NOTE_001'];
		?>
		</a></h2>
	</div>
	<ul id="id_list_1">
	<?php 
			$cntNews = 0;
			foreach ($newsList as $news){
				if($news['TRssNews']['TYPE'] == RwsConstant::NEWS_ITEM_TYPE_HOT){
					$linkSort = getLinkSort($news['TNews']['LINK'], $news['TRssNews']['HOME']);
					$newsId = $news['TNews']['ID'];
					$host = RwsConstant::FULL_BASE_URL_HOST;
				?>
		<li class="yt-shelf-grid-item yt-uix-shelfslider-item" id="id_list1_li<?php echo $cntNews++;?>">
			<div class="yt-lockup yt-lockup-grid yt-lockup-video clearfix">
				<div class="yt-lockup-dismissable">
					<?php
					if(isset($login_user_role) && $login_user_role <= RwsConstant::USER_AUTH_ROLE_SUB){
						echo '<div style="display: inline-block;">';
						echo '<a title="Edit" href="'.$host.'/editnews?id='.$newsId.'&'.$linkSort.'" style="display: inline-block; margin: 2px; padding: 0px; width: 16px; height: 16px; vertical-align: inherit; border: none; background: url('.$host.'/img/edit.png);"></a>';
						echo '</div>';
						
						echo '<div style="display: inline-block; float: right;">';
						echo $this->Form->create('TNews', array('id'=>'TNewsIndexForm'.$newsId, 'url' => array ('controller' => 'editNews', 'action' => 'doDeleteNews'), 'role' => 'form', 'novalidate' => true));
							echo "<input type='hidden' id='data[TNews][ID]' name='data[TNews][ID]' value='".$newsId."' >";
							echo '<a onclick="document.getElementById(\'TNewsIndexForm'.$newsId.'\').submit();"><img src="'.$host.'/img/trash_ico.png" /></a>';
						echo $this->Form->end();
						echo '</div>';
					}
					?>
					
					<?php //echo "<a href='$host/news?id=$newsId&$linkSort'>"; ?>
					<?php echo "<a target='_blank' href='".$news['TNews']['LINK']."'>"; ?>
					<div class="yt-lockup-thumbnail">
						<div class="yt-thumb video-thumb">
							<img alt="<?php echo $news['TNews']['TITLE'];?>"
								src="<?php echo $news['TNews']['SUMMARY_IMG'];?>" width="200"
								height="120">
						</div>
					</div>
					<?php echo "</a>";?>
					<?php echo "<a href='$host/news?id=$newsId&$linkSort'>"; ?>
					<?php //echo "<a target='_blank' href='".$news['TNews']['LINK']."'>"; ?>
					<div class="yt-lockup-content">
						<h3 class="yt-lockup-title">
							<?php 
									echo $news['TNews']['TITLE'];
							?>
						</h3>
					</div>
					<?php echo "</a>";?>
				</div>
			</div>
		</li>
				<?php 
				}
			}
	?> 
	</ul>
	
	<div id='id_recommended_02' class="recommended">
		<h2><a href="<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/newsList?type=0">
		<?php 
			echo $scrFieldLabels['HOME_CATALOG_005'] . " - " . $scrFieldLabels['HOME_CATALOG_NOTE_001'];
		?>
		</a></h2>
	</div>
	<ul  id="id_list_0">
		<?php
			$cntNews = 0;
			foreach ($newsList as $news){
				if($news['TRssNews']['TYPE'] == RwsConstant::NEWS_ITEM_TYPE_FUN){
					$linkSort = getLinkSort($news['TNews']['LINK'], $news['TRssNews']['HOME']);
					$newsId = $news['TNews']['ID'];
					$host = RwsConstant::FULL_BASE_URL_HOST;
				?>
		<li class="yt-shelf-grid-item yt-uix-shelfslider-item" id="id_list0_li<?php echo $cntNews++;?>">
			<div class="yt-lockup yt-lockup-grid yt-lockup-video clearfix">
				<div class="yt-lockup-dismissable">
					<?php
					if(isset($login_user_role) && $login_user_role <= RwsConstant::USER_AUTH_ROLE_SUB){
						echo '<div style="display: inline-block;">';
						echo '<a title="Facebook" href="'.$host.'/editnews?id='.$newsId.'&'.$linkSort.'" style="display: inline-block; margin: 2px; padding: 0px; width: 16px; height: 16px; vertical-align: inherit; border: none; background: url('.$host.'/img/edit.png);"></a>';
						echo '</div>';
						
						echo '<div style="display: inline-block; float: right;">';
						echo $this->Form->create('TNews', array('id'=>'TNewsIndexForm'.$newsId, 'url' => array ('controller' => 'editNews', 'action' => 'doDeleteNews'), 'role' => 'form', 'novalidate' => true));
							echo "<input type='hidden' id='data[TNews][ID]' name='data[TNews][ID]' value='".$newsId."' >";
							echo '<a onclick="document.getElementById(\'TNewsIndexForm'.$newsId.'\').submit();"><img src="'.$host.'/img/trash_ico.png" /></a>';
						echo $this->Form->end();
						echo '</div>';
					}
					?>
					<?php //echo "<a href='$host/news?id=".$newsId."&".$linkSort."'>"; ?>
					<?php echo "<a target='_blank' href='".$news['TNews']['LINK']."'>"; ?>
					<div class="yt-lockup-thumbnail">
						<div class="yt-thumb video-thumb">
							<img alt="<?php echo $news['TNews']['TITLE'];?>"
								src="<?php echo $news['TNews']['SUMMARY_IMG'];?>" width="200"
								height="120">
						</div>
					</div>
					<?php echo "</a>";?>
					<?php echo "<a href='$host/news?id=".$newsId."&".$linkSort."'>"; ?>
					<?php //echo "<a target='_blank' href='".$news['TNews']['LINK']."'>"; ?>
					<div class="yt-lockup-content">
						<h3 class="yt-lockup-title">
							<?php 
								echo $news['TNews']['TITLE'];
							?>
						</h3>
					</div>
					<?php echo "</a>";?>
				</div>
			</div>
		</li>
				<?php 
				}
			}
		?>
	</ul>
<?php 
	}
	
?>
</div>

<?php
	/**
     * Get insert/update news_details
     */
    function getLinkSort($link, $homePage){
    	if($homePage == 'http://abcnews.go.com'){
    		$arr = explode('/',$link);
    		if(strpos($link, '/video/') > 0){
    			$link = $arr[sizeof($arr)-1];
    		}
    		else {
    			$link = $arr[sizeof($arr)-2];
    		}    		
			return $link;
    	}
    	else{
			$arr = explode('/',$link);
			$link = $arr[sizeof($arr)-1];
			$reg_link = "/(.+)\./";
			if(preg_match($reg_link, $link, $linkSort)){
				return $linkSort[1];
			}
    	}
		return "";
	}
?>