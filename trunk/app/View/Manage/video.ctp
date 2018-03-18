<?php 
	echo $this->Html->css (array(
			'search','video'
	));
?>

<script type="text/javascript">
function nv_checkAll()
{
	var cnt = $("#hdn_id_cnt").val();
	var value = $("#id_check_all").val();
    if(value == "true"){
    	$("#id_check_all").val("false");
    	for(var i = 1 ; i <= cnt ; i++){
    		$("#id_check" + i).prop('checked', true);
    	}
    }
    else{
    	$("#id_check_all").val("true");
    	for(var i = 1 ; i <= cnt ; i++){
    		$("#id_check" + i).prop('checked', false);
    	}
    }
    nv_check();
}
function nv_check()
{
	var cnt = $("#hdn_id_cnt").val();
	var videoIds = "";
	for(var i = 1 ; i <= cnt ; i++){
		if($("#id_check" + i).is(':checked')){
			if(videoIds == ""){
				videoIds = $("#hdn_id_video_id" + i).val();	
			}
			else{
				videoIds = videoIds + "," + $("#hdn_id_video_id" + i).val();
			}
		}
	}
	$("#hdn_id_video_id_select").val(videoIds);
}

function getLink(){
	var html = "";
	var cnt = $("#hdn_id_cnt").val();
	for(var i = 1 ; i <= cnt ; i++){
		if($("#id_check" + i).is(':checked')){
			html = html + "https://www.youtube.com/watch?v=" + $("#hdn_id_video_id" + i).val() + "<br>";
		}
	}
	if(html != ""){
		html = "<h1>Get link</h1>" + html;
	}
	var divGetLinkArea = document.getElementById('getLinkArea');
	divGetLinkArea.innerHTML = html;
}

function fnc_reloadVideoStatus(){
	var action = '<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/manage/reloadVideoStatus';
    $('#TVideoIndexForm').attr('action', action);
	$('#TVideoIndexForm').submit();
}

function fnc_doSetVideoToHomepage(){
	var action = '<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/manage/doSetVideoToHomepage';
    $('#TVideoIndexForm').attr('action', action);
	$('#TVideoIndexForm').submit();
}

function fnc_doRemoveVideoFromHomepage(){
	var action = '<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/manage/doRemoveVideoFromHomepage';
    $('#TVideoIndexForm').attr('action', action);
	$('#TVideoIndexForm').submit();
}

</script>
    <?php echo $this->Form->create('TCustomer', array('id'=>'TVideoIndexForm', 'url' => array ('controller' => 'manage', 'action' => 'doDeleteVideo'), 'role' => 'form', 'novalidate' => true)); ?>
    <div class="fl">
    <?php 
	$cnt = 0;
	if(isset($videos)){
		$cnt = sizeof($videos);
	}
	?>
	<input type='hidden' name='hdn_id_cnt' id='hdn_id_cnt' value='<?php echo $cnt; ?>'>
	<input type='hidden' name='hdn_id_video_id_select' id='hdn_id_video_id_select' value='<?php isset($videoIdSelectArr) ? $videoIdSelectArr : "";?>'>
	<table class="ymain bd">
		<tbody><tr class="head">
			<td style="width:20px">STT</td>
			<td style="width:90px">Ảnh</td>
            <td style="width:30%;min-width: 200px;">Tên Video</td>
            <td style="width:15%">Tên Kênh</td>
			<td style="width:15%">Ga + NET</td>
			<td style="width:10%;min-width:50px">Tình trạng</td>
			<td style="width:10%;min-width:50px">Quảng cáo</td>
			<td style="width:10%">Chặn quốc gia</td>
			<td style="width:165px;min-width: 165px;">Thông tin</td>
			<td style="width:10%">Trạng thái</td>
			<td class="text-center"><input id="id_check_all" type="checkbox" onclick="nv_checkAll();" value="true"></td>
		</tr>
        <?php 
        $hdn_id_video_id_list = "";
		if(isset($videos) && (is_array($videos) || is_object($videos))){
			$cnt = 0;
			foreach ($videos as $video){
				$cnt++;
				if($hdn_id_video_id_list == ""){
					$hdn_id_video_id_list = $video['TVideo']['VIDEO_ID'];
				}
				else{
					$hdn_id_video_id_list = $hdn_id_video_id_list . "," . $video['TVideo']['VIDEO_ID'];
				}
				if($cnt % 2 == 0){
	        		echo "<tr class=''>";
	        	}else{
			?>
			<tr class='second'>
		    <?php 
	        	}
				$ga = '';
		    	if($video['TVideo']['GA'] == 1){
		    		$ga = "(GA)";	
		    	}
		    	echo "<input type='hidden' id='hdn_id_video_id$cnt' value='".$video['TVideo']['VIDEO_ID']."'>";
	  	    ?>
			<td style="text-align:center"><?php echo $cnt;?></td>
            <td><img class="img-thumbnail" src="<?php echo $video['TVideo']['THUMBNAILS'];?>" style="max-width:inherit;width:90px"></td>
			<td><a target="_blank" title="<?php echo $video['TVideo']['TITLE'];?>" href="<?php echo RwsConstant::FULL_BASE_URL_HOST.'/watch?v='.$video['TVideo']['VIDEO_ID'];?>"><?php echo $video['TVideo']['TITLE'];?></a></td>
			<td><a target="_blank" title="<?php  echo $video['TVideo']['CHANNEL_TITLE']; ?>" href="<?php echo RwsConstant::FULL_BASE_URL_HOST. '/channel/' . $video['TVideo']['CHANNEL_ID'];?>"><?php  if(strlen($video['TVideo']['CHANNEL_TITLE']) == 0){ echo $video['TVideo']['CHANNEL_ID']; }else{ echo $video['TVideo']['CHANNEL_TITLE'];} ?></a></td>
            <td><?php echo isset($video['TVideo']['ATTRIBUTION']) ? $video['TVideo']['ATTRIBUTION'] . $ga : "Only Vip Account"; //echo getMetaAttribution(RwsConstant::FULL_BASE_URL_HOST . "/watch?v=".$searchResult['id']);?></td>
			<td><?php 
				if(strlen($video['TVideo']['REJECTION_REASON']) == 0){
					echo "Bình Thường";
				}
				else{
					echo $video['TVideo']['REJECTION_REASON'];
				}
			
			?></td>
			<td><?php 
			if($video['TVideo']['LICENSED_CONTENT'] == 1){
				echo "Có";
			}
			else{
				echo "Không";
			}
			?>
			</td>
			<td><?php echo $video['TVideo']['REGION_RESTRICTION_BLOCKED'];?></td>
			<td>
				<span class="info"><span class="view">&nbsp;</span><?php echo getCountShot($video['TVideo']['VIEW_COUNT']);?></span>
				<span class="info"><span class="like">&nbsp;</span><?php echo getCountShot($video['TVideo']['LIKE_COUNT']);?></span>
				<span class="info"><span class="dislike">&nbsp;</span><?php echo getCountShot($video['TVideo']['DISLIKE_COUNT']);?></span>
				<span class="info"><span class="subcribe">&nbsp;</span><?php echo getCountShot($video['TVideo']['FAVORITE_COUNT']);?></span>
				<span class="info"><span class="comment">&nbsp;</span><?php echo getCountShot($video['TVideo']['COMMENT_COUNT']);?></span><br>
                <div class="clearfix"></div>
                Publis: <?php echo $video['TVideo']['PUBLISHED_AT'];?>
            </td>
            <td>
            	<?php 
					if($video['TManage']['TYPE'] == 2){
            			echo "YoutubeSub<br>";
            		}
            		echo $video['TVideo']['DIMENSION'] . "<br>". $video['TVideo']['DEFINITION'] . "<br> " . $video['TVideo']['DELETE_YMD'];
            	?>
            </td>
            <?php 
            if(isset($videoIdSelectArr) && strpos($videoIdSelectArr, $video['TVideo']['VIDEO_ID']) !== false){
            	?>
            	<td class="text-center"><input type="checkbox" id="id_check<?php echo $cnt?>" onclick="nv_check();" checked="checked"></td>
            <?php 
            }else{
            ?>
				<td class="text-center"><input type="checkbox" id="id_check<?php echo $cnt?>" onclick="nv_check();"></td>
			<?php 
            }
			?>
			</tr>
	    <?php
			}
		}
		?>
		<tr>
		<td colspan="11">
			<input type='hidden' name='hdn_id_video_id_list' id='hdn_id_video_id_list' value='<?php echo $hdn_id_video_id_list;?>'>
			<?php 
			echo "<input type='button' onClick='getLink();' style='float:right;' value='".$scrFieldLabels['SCR_SEARCH_GET_LINK']."' />";
			echo "<input type='submit' style='float:right;' value='".$scrFieldLabels['BTN_DELETE']."' />";
			echo "<input type='button' onClick='fnc_reloadVideoStatus();' style='float:left;' value='".$scrFieldLabels['SCR_MANAGE_RELOAD']."' />";
			$login_user_role = 0 + $this->Session->read('login.user.AUTH_ROLE');
			if ($this->Session->check(RwsConstant::SESSION_LOGIN_USER_KEY)) {
				if($login_user_role <= RwsConstant::USER_AUTH_ROLE_SUB){
					echo "<input type='button' onClick='fnc_doSetVideoToHomepage();' style='float:left;' value='Public' />";
					echo "<input type='button' onClick='fnc_doRemoveVideoFromHomepage();' style='float:left;' value='Private' />"; 
				}
			}
			?>
		</td>
		</tr>
	</tbody></table>
	<?php echo $this->Form->end() ?>
	<div class='getlink'>	
		<div id='getLinkArea'>		
		</div>
	</div>
	<div class="clear"></div>
	
	<?php 
	function getCountShot($numberLong){
    	if($numberLong < 1000){
    		return $numberLong;
    	}
    	else if($numberLong > 1000000){
    		$numberLong = substr($numberLong, 0, strlen($numberLong)-5);
    		$numberLong = $numberLong / 10.0;
    		return $numberLong . "m";
    	}
    	else{
    		$numberLong = substr($numberLong, 0, strlen($numberLong)-2);
    		$numberLong = $numberLong / 10.0;
    		return $numberLong . "k";
    	}
    }
	?>
</div>