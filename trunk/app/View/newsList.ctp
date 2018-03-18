<script>

	$(window).resize(function() {
		var myDiv = document.getElementById("id_content_view");
		var divWidth = myDiv.offsetWidth;
		var rowCount = Math.floor((divWidth)/212.5);
		$('#id_recommended_01').css("margin-left",(divWidth - rowCount * 212.5)/2);
		$('#id_recommended_01').css("margin-right",(divWidth - rowCount * 212.5)/2);
	});

	$(document).ready(function() {
		var myDiv = document.getElementById("id_content_view");
		var divWidth = myDiv.offsetWidth;
		var rowCount = Math.floor((divWidth)/212.5);
		$('#id_recommended_01').css("margin-left",(divWidth - rowCount * 212.5)/2);
		$('#id_recommended_01').css("margin-right",(divWidth - rowCount * 212.5)/2);
	});
		
</script>
<div id="id_content_view" class='content_view'>
<div id='id_recommended_01' class="recommended">
<h1>
	<?php
	if ($this->Session->check(RwsConstant::SESSION_LOGIN_USER_KEY)) { 
		$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		$login_user_role = 0 + $this->Session->read('login.user.AUTH_ROLE');
	}
	echo "<a href='".RwsConstant::FULL_BASE_URL_HOST."'>Nhà phố Lộc Phát</a>";
	
	if(isset($newsList)){
		if($newsList[0]['TRssNews']['TYPE'] == RwsConstant::NEWS_ITEM_TYPE_HOT){
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
	</h1>
</div>
<ul>
<?php 
	if(isset($newsList)){
		foreach ($newsList as $news){
			$linkSort = getLinkSort($news['TNews']['LINK']);
			$newsId = $news['TNews']['ID'];
			$host = RwsConstant::FULL_BASE_URL_HOST;
			?>
	<li class="yt-shelf-grid-item yt-uix-shelfslider-item">
		<div class="yt-lockup yt-lockup-grid yt-lockup-video clearfix">
			<div class="yt-lockup-dismissable">
				<?php
				if(isset($login_user_role) && $login_user_role <= RwsConstant::USER_AUTH_ROLE_SUB){
					if(isset($news['TNews']['CONTENT']) && $news['TNews']['CONTENT'] != ""){
						echo '<div style="display: inline-block;">';
						echo '<a class="youtubesubfbLink" title="Facebook" href="'.$host.'/editnews?id='.$newsId.'&'.$linkSort.'" style="display: inline-block; margin: 2px; padding: 0px; width: 16px; height: 16px; vertical-align: inherit; border: none; background: url('.$host.'/img/edit.png);"></a>';
						echo '</div>';	
					}
					else{
						echo '<div style="display: inline-block;">';
						echo '<a class="youtubesubfbLink" title="Facebook" href="'.$host.'/editnews?id='.$newsId.'&'.$linkSort.'" style="display: inline-block; margin: 2px; padding: 0px; width: 16px; height: 16px; vertical-align: inherit; border: none; background: url('.$host.'/img/edit_black.png);"></a>';
						echo '</div>';
					}
					
					echo '<div style="display: inline-block; float: right;">';
					echo $this->Form->create('TNews', array('id'=>'TNewsIndexForm'.$newsId, 'url' => array ('controller' => 'editNews', 'action' => 'doDeleteNews'), 'role' => 'form', 'novalidate' => true));
						echo "<input type='hidden' id='data[TNews][ID]' name='data[TNews][ID]' value='".$newsId."' >";
						echo '<a onclick="document.getElementById(\'TNewsIndexForm'.$newsId.'\').submit();"><img src="'.$host.'/img/trash_ico.png" /></a>';
					echo $this->Form->end();
					echo '</div>';
				}
				?>
				<?php echo "<a href='$host/news?id=$newsId&$linkSort'>"; ?>
				<div class="yt-lockup-thumbnail">
					<div class="yt-thumb video-thumb">
						<img alt="<?php echo $news['TNews']['TITLE'];?>" 
							src="<?php echo $news['TNews']['SUMMARY_IMG'];?>"  width="200" height="120">
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
	<?php
	    echo $this->Paginator->prev('« Previous ', null, null, array('class' => 'disabled')); //Shows the next and previous links
	    echo " | ".$this->Paginator->numbers()." | "; //Shows the page numbers
	    echo $this->Paginator->next(' Next »', null, null, array('class' => 'disabled')); //Shows the next and previous links
	    echo " Page ".$this->Paginator->counter(); // prints X of Y, where X is current page and Y is number of pages
	?>
</div>
<?php
	/**
     * Get insert/update news_details
     */
    function getLinkSort($link){
		$arr = explode('/',$link);
		$link = $arr[sizeof($arr)-1];
		$reg_link = "/(.+)\./";
		if(preg_match($reg_link, $link, $linkSort)){
			return $linkSort[1];
		}
		return "";
	}
?>
