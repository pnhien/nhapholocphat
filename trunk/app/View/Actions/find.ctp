<script type="text/javascript">
function nv_checkAll_find()
{
	var cnt = $("#hdn_id_cnt_find").val();
	var value = $("#id_check_all_find").val();
    if(value == "true"){
    	$("#id_check_all_find").val("false");
    	for(var i = 1 ; i <= cnt ; i++){
    		$("#id_check_find" + i).prop('checked', true);
    	}
    }
    else{
    	$("#id_check_all_find").val("true");
    	for(var i = 1 ; i <= cnt ; i++){
    		$("#id_check_find" + i).prop('checked', false);
    	}
    }
    nv_check_find();
}
function nv_check_find()
{
	var cnt = $("#hdn_id_cnt_find").val();
	var videoIds = "";
	for(var i = 1 ; i <= cnt ; i++){
		if($("#id_check_find" + i).is(':checked')){
			if(videoIds == ""){
				videoIds = $("#hdn_id_id_find" + i).val();	
			}
			else{
				videoIds = videoIds + "," + $("#hdn_id_id_find" + i).val();
			}
		}
	}
	$("#hdn_id_id_select_find").val(videoIds);
}

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

function fnc_doBeginFind(){
    var action = '<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/find/doBeginFind';
    $('#TFindIndexForm').attr('action', action);
	$('#TFindIndexForm').submit();
}

</script>
 <?php echo $this->Form->create('TCustomer', array('id'=>'TFindIndexForm', 'url' => array ('controller' => 'find', 'action' => 'doBeginFind'), 'role' => 'form', 'novalidate' => true)); 
    ?>
<div class="fl">
    <h1>Find</h1>
    <?php 
	$cntFind = 0;
	if(isset($findList)){
		$cntFind = sizeof($findList);
	}
	?>
	<input type='hidden' name='hdn_id_cnt_find' id='hdn_id_cnt_find' value='<?php echo $cntFind; ?>'>
	<input type='hidden' name='hdn_id_id_select_find' id='hdn_id_id_select_find' value=''>
	<table class="ymain bd">
		<tbody>
			<tr class="head">
				<td style="width:40px">STT</td>
	            <td style="width:30%;min-width: 200px;">key</td>
	            <td style="width:165px">IP_START</td>
				<td style="width:165px;">IP_CURRENT</td>
				<td style="width:165px">IP_FINISH</td>
				<td style="width:165px">Update</td>
				<td class="text-center"><input id="id_check_all_find" type="checkbox" onclick="nv_checkAll_find();" value="true"></td>
			</tr>
	        <?php 
			if(isset($findList) && (is_array($findList) || is_object($findList))){
				$cnt = 0;
				foreach ($findList as $find){
					$cnt++;
					echo "<input type='hidden' id='hdn_id_id_find$cnt' value='".$find['TFind']['ID']."'>";
		  	    ?>
		  	    <tr>
				<td style="text-align:center"><?php echo $cnt;?></td>
	            <td><?php echo $find['TFind']['KEY'];?></td>
				<td><?php echo $find['TFind']['IP_START'];?></td>
				<td><?php  echo $find['TFind']['IP_CURRENT']; ?></td>
	            <td><?php  echo $find['TFind']['IP_FINISH']; ?></td>
				<td><?php  echo $find['TFind']['UPDATE_YMD']; ?></td>
				<td class="text-center"><input type="checkbox" id="id_check_find<?php echo $cnt?>" onclick="nv_check_find();"></td>
				</tr>
				<?php 
				}
			}
				?>
				<tr>
				<td colspan="7">
					<?php echo "<input type='button' onClick='fnc_DeleteFind();' style='float:right;' value='Xóa' />"; ?>
					<?php echo "<input type='button' onClick='fnc_doBeginFind();' style='float:right;' value='Bắt đầu tìm' />"; ?>
					<?php echo "<input type='button' onClick='fnc_doReloadFindDetails();' style='float:right;' value='Reload' />"; ?>
				</td>
				</tr>
		</tbody>
	</table>
</div>
<?php echo $this->Form->end() ?>
 <?php echo $this->Form->create('TCustomer', array('id'=>'TFindDetailsIndexForm', 'url' => array ('controller' => 'find', 'action' => 'index'), 'role' => 'form', 'novalidate' => true)); 
    ?>
<div class="fl">
    <h1>Results</h1>
    <?php 
	$cnt = 0;
	if(isset($findDetails)){
		$cnt = sizeof($findDetails);
	}
	?>
	<input type='hidden' name='hdn_id_cnt' id='hdn_id_cnt' value='<?php echo $cnt; ?>'>
	<input type='hidden' name='hdn_id_video_id_select' id='hdn_id_video_id_select' value=''>
	<table class="ymain bd">
		<tbody>
			<tr class="head">
				<td style="width:40px">STT</td>
	            <td style="width:30%;min-width: 200px;">link</td>
	            <td style="width:15%">key</td>
				<td style="width:165px;">Ghi chú</td>
				<td style="width:10%">Ngày tạo</td>
				<td class="text-center"><input id="id_check_all" type="checkbox" onclick="nv_checkAll();" value="true"></td>
			</tr>
	        <?php 
	        $hdn_id_video_id_list = "";
			if(isset($findDetails) && (is_array($findDetails) || is_object($findDetails))){
				$cnt = 0;
				foreach ($findDetails as $findDetail){
		  	    ?>
		  	    <tr>
				<td style="text-align:center"><?php echo $cnt;?></td>
	            <td><img class="img-thumbnail" src="<?php echo $video['TVideoSub']['THUMBNAILS'];?>" style="max-width:inherit;width:90px"></td>
				<td><a target="_blank" title="<?php echo $video['TVideoSub']['TITLE'];?>" href="https://www.youtube.com/watch?v=<?php echo $video['TVideoSub']['VIDEO_ID'];?>"><?php echo $video['TVideoSub']['TITLE'] . "(".$video['TVideoSub']['DURATION'].")";?></a></td>
				<td><a target="_blank" title="<?php  echo $video['TVideoSub']['CHANNEL_TITLE']; ?>" href="https://www.youtube.com/channel/<?php echo $video['TVideoSub']['CHANNEL_ID'];?>"><?php  if(strlen($video['TVideoSub']['CHANNEL_TITLE']) == 0){ echo $video['TVideoSub']['CHANNEL_ID']; }else{ echo $video['TVideoSub']['CHANNEL_TITLE'];} ?></a></td>
	            <td><?php echo isset($video['TVideoSub']['ATTRIBUTION']) ? $video['TVideoSub']['ATTRIBUTION'] . $ga : "Only Vip Account"; //echo getMetaAttribution("https://www.youtube.com/watch?v=".$searchResult['id']);?></td>
				<td><?php 
					if(strlen($video['TVideoSub']['REJECTION_REASON']) == 0){
						echo "Bình Thường";
					}
					else{
						echo $video['TVideoSub']['REJECTION_REASON'];
					}
				?>
				</td>
				<td class="text-center"><input type="checkbox" id="id_check<?php echo $cnt?>" onclick="nv_check();"></td>
				</tr>
				<?php 
				}
			}
				?>
				<tr>
				<td colspan="11">
					<input type='hidden' name='hdn_id_video_id_list' id='hdn_id_video_id_list' value='<?php echo $hdn_id_video_id_list;?>'>
					<?php echo "<input type='button' onClick='getLink();' style='float:right;' value='".$scrFieldLabels['SCR_SEARCH_GET_LINK']."' />"; ?>
					<?php echo "<input type='button' onClick='fnc_doAddVideoToSubscriptions();' style='float:right;' value='".$scrFieldLabels['SCR_SEARCH_ADD_MANAGE']."' />"; ?>
					<?php echo "<input type='button' onClick='fnc_doAddVideoToReup();' style='float:right;' value='".$scrFieldLabels['SCR_SEARCH_ADD_YOUMAN']."' />"; ?>
				</td>
				</tr>
		</tbody>
	</table>
</div>