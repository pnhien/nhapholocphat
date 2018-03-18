<div class="recommended">
<h2>
	<?php 
	echo "<a href='".RwsConstant::FULL_BASE_URL_HOST."'>Nhà phố Lộc Phát</a>";
	if(isset($news)){
		if($news['TRssNews']['TYPE'] == RwsConstant::NEWS_ITEM_TYPE_HOT){
			echo " > "; 
			echo "<a href='".RwsConstant::FULL_BASE_URL_HOST."/newsList?type=1'>";
			echo $scrFieldLabels['HOME_CATALOG_004'];
		}
		else{
			echo " > ";
			echo "<a href='".RwsConstant::FULL_BASE_URL_HOST."/newsList?type=0'>";
			echo $scrFieldLabels['HOME_CATALOG_005'];
		}
		echo "</a>";
	}
	?>
	</h2>
</div>
<div class="news_content" style="  font-size: 15px;line-height: 21px;">
	<?php 
	if(isset($news)){
		$login_user_role = 0 + $this->Session->read('login.user.AUTH_ROLE');
		if ($this->Session->check(RwsConstant::SESSION_LOGIN_USER_KEY)) {
			if($login_user_role <= RwsConstant::USER_AUTH_ROLE_SUB){
				$linkSort = getLinkSort($news['TNews']['LINK'], $news['TRssNews']['HOME']);
				$newsId = $news['TNews']['ID'];
				$host = RwsConstant::FULL_BASE_URL_HOST;
				echo "<a target='_blank' href='$host/editnews?id=$newsId&$linkSort'> Edit</a>";	
			}
		}
		echo "<div class='block_timer'>" . $news['TNews']['PUB_DATE'] . "</div>";
		echo "<h1>" . $news['TNews']['TITLE'] . "</h1>";
		echo "<div>" . $news['TNews']['DESCRIPTION'] . "</div>";
		echo "<br>";
		echo $news['TNews']['CONTENT']; 
	?>
	<div class="icon_right">
		© Copyright from
		<a target="_blank" href="<?php echo $news['TRssNews']['HOME'];?>"><?php echo str_replace("http://","",$news['TRssNews']['HOME']);?></a><br>
		Direct Link : <a target="_blank" href="<?php echo $news['TNews']['LINK'];?>"><?php echo $news['TNews']['LINK'];?></a>
	</div>
	<?php 
	}else{
		echo "Page not found!";
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
	?>
</div>
<div style="line-height: 17px;">
        <h2><?php echo $scrFieldLabels['SCR_NEWS_GENERAL_NEWS'];?></h2>
	<ul>
	<?php 
		if(isset($newsList)){
			foreach ($newsList as $news){
				$linkSort = getLinkSort($news['TNews']['LINK'], $news['TRssNews']['HOME']);
				$newsId = $news['TNews']['ID'];
				$host = RwsConstant::FULL_BASE_URL_HOST;
				?>
					<li>
						<div>
								<?php 
									echo "<a href='$host/news?id=$newsId&$linkSort'>"; 
									echo $news['TNews']['TITLE'];
									echo "</a>";
								?>
						</div>
					</li>
				<?php
			}
		}
	?>
	</ul>
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
		return $link;
	}
?>
<script>
	var sharebutton_is_horizontal = true; 
	document.write('<script src="js/share4.js"></scr' + 'ipt>'); 
	document.write("<div style='display: none'>");</script>
<script>document.write("</div>");</script>