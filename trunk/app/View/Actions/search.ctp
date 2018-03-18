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
		html = "<h2>Get link</h2>" + html;
	}
	var divGetLinkArea = document.getElementById('getLinkArea');
	divGetLinkArea.innerHTML = html;
}

//function fnc_doAddVideoToSubscriptions() {	
//	$('#id_div_flash').empty().hide();
//	$('#id_div_error').empty().hide();
//	if (ajaxRunning == true) {
//		return;
//	}
//	ajaxRunning = true;
//	
//	var videoIDs = "";
//	var cnt = $("#hdn_id_cnt").val();
//	
//	for(var i = 1 ; i <= cnt ; i++){
//		if($("#id_check" + i).is(':checked')){
//			if(videoIDs == ""){
//				videoIDs = $("#hdn_id_video_id" + i).val();	
//			}
//			else{
//				videoIDs = videoIDs + "," + $("#hdn_id_video_id" + i).val();
//			}
//		}
//	}
//	if(videoIDs == ""){
//		alert("Please select videos");
//		ajaxRunning = false;
//		return;
//	}
//	
//	dataInput = [videoIDs];
//	$.ajax({
//		url : 'localshot:90/youman/search/addVideoToSubscriptions',
//		type : 'POST',
//		data : {'dataInput': dataInput},
//		cache : false,
//		dataType : 'json', 
//		async : false,
//		success : function(result) {
//			ajaxRunning = false;
//			if (result['success']) {
//				var html = '<div class="notice">';
//				html += '	<div class="success">';
//				html += '		<p>' + result['mesager'] + '</p>';
//				html += '	</div>';
//				html += '</div>';
//				$('#id_div_flash').append(html).show();
//			} else {
//				var html = '<div class="notice">';
//				html += '	<div class="error">';
//				html += '		<p>' + result['mesager'] + '</p>';
//				html += '	</div>';
//				html += '</div>';
//				$('#id_div_error').append(html).show();
//			}
//	    },
//	    error : function (result) {
//	    	var html = '<div class="notice">';
//			html += '	<div class="error">';
//			html += '		<p>' + result['success'] + '</p>';
//			html += '	</div>';
//			html += '</div>';
//			$('#id_div_error').append(html).show();
//	    	ajaxRunning = false;
//	    }
//	});
//}

function fnc_doAddVideoToSubscriptions(){
    var action = '<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/manage/addVideoToSubscriptions';
    $('#TCustomerIndexForm').attr('action', action);
	$('#TCustomerIndexForm').submit();
}

function fnc_doAddVideoToReup(){
    var action = '<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/manageReup/addVideoToReup';
    $('#TCustomerIndexForm').attr('action', action);
	$('#TCustomerIndexForm').submit();
}

function fnc_search_results(){
	var queryHtml = '<?php echo RwsConstant::FULL_BASE_URL_HOST;?>';	
	var masthead_search_term = $("#masthead-search-term").val();
	var id_select_upload_date =  $("#id_select_upload_date").val();
	var id_select_video_type = $("#id_select_video_type").val();
	var id_select_duration = $("#id_select_duration").val();
	var id_select_features = $("#id_select_features").val();
	var id_select_sort_by = $("#id_select_sort_by").val();
	var id_video_page = $("#id_video_page").val();

	if(masthead_search_term != ''){
		masthead_search_term = masthead_search_term.replace(" ", "+");
		masthead_search_term = masthead_search_term.replace("&", "%26");
		masthead_search_term = masthead_search_term.replace("=", "%3D");
		queryHtml = queryHtml + "/results?search_query=" + masthead_search_term;
		var filters = "";
		if(id_select_upload_date != ''){
			if(filters != ''){
				filters = filters + "%2C+" + id_select_upload_date; 
			}
			else{
				filters = "&filters=" + id_select_upload_date;
			}
		}
		if(id_select_video_type != ''){
			if(filters != ''){
				filters = filters + "%2C+" + id_select_video_type; 
			}
			else{
				filters = "&filters=" + id_select_video_type;
			}
		}
		if(id_select_duration != ''){
			if(filters != ''){
				filters = filters + "%2C+" + id_select_duration; 
			}
			else{
				filters = "&filters=" + id_select_duration;
			}
		}
		if(id_select_features != ''){
			if(filters != ''){
				filters = filters + "%2C+" + id_select_features;
			}
			else{
				filters = "&filters=" + id_select_features;
			}
		}
		queryHtml = queryHtml + filters;
		if(id_select_sort_by != ''){
			queryHtml = queryHtml + "&search_sort=" + id_select_sort_by;
		}
		if(id_video_page != ''){
			queryHtml = queryHtml + "&page=" + id_video_page;
		}
	}
	else{
		return;
	}
	window.location = queryHtml;
}

function fnc_SearchSubmit(){
	$('#id_hdn_prev_page_token').val('');
	$('#id_hdn_next_page_token').val('');
	$('#TCustomerIndexForm').submit();
}

function fnc_SearchNextSubmit(){
	$('#id_hdn_prev_page_token').val('');
	$('#TCustomerIndexForm').submit();	
}

function fnc_SearchPrevSubmit(){
	$('#id_hdn_next_page_token').val('');
	$('#TCustomerIndexForm').submit();
}

$(document).ready(function() {
	if($('#select_search_type').val() >= '1'){
		$('#id_search_youtube_1').css("display","none");
		$('#id_search_youtube_2').css("display","none");
	}
});
function fnc_change_search_type()
{
	if($('#select_search_type').val() >= '1'){
		$('#id_search_youtube_1').css("display","none");
		$('#id_search_youtube_2').css("display","none");
	}
	else{
		$('#id_search_youtube_1').css("display","");
		$('#id_search_youtube_2').css("display","");
	}
}

</script>

<?php echo $this->Form->create('TCustomer', array('id'=>'TCustomerIndexForm', 'url' => array ('controller' => 'search', 'action' => 'loadSearchInfo'), 'role' => 'form', 'novalidate' => true)); 
    	if(isset($typeSearch) && $typeSearch == 1){
    		if(isset($prevPageToken)){
    			echo "<input type='hidden' name='id_hdn_prev_page_token' id='id_hdn_prev_page_token' value='$prevPageToken'>";
    		}
    		if(isset($nextPageToken)){
    			echo "<input type='hidden' name='id_hdn_next_page_token' id='id_hdn_next_page_token' value='$nextPageToken'>";
    		}
    		if(isset($totalResults)){
    			echo "<input type='hidden' name='id_hdn_total_results' id='id_hdn_total_results' value='$totalResults'>";
    		}
    		if(isset($pageOfResults)){
    			echo "<input type='hidden' name='id_hdn_page_of_results' id='id_hdn_page_of_results' value='$pageOfResults'>";
    		}
    		if(isset($resultsPerPage)){
    			echo "<input type='hidden' name='id_hdn_results_per_page' id='id_hdn_results_per_page' value='$resultsPerPage'>";
    		}
    ?>
<table class='search'>
	<tr>
		<td><?php echo $scrFieldLabels['SCR_SEARCH_KEYWORD'];?></td>
		<td colspan="3"><input type="text" id="q" name="q"
			class="inputKeyword" placeholder="Enter Search Term"
			value="<?php echo (isset($q) ? $q : ''); ?>"></td>
		<td><?php echo $scrFieldLabels['SCR_SEARCH_TYPE'];?></td>
		<td> 
	    <?php 
	  		$searchTypeArr = array (
					RwsConstant::SEARCH_ITEM_ANY => $scrFieldLabels['SCR_SEARCH_KEYWORD'],
					RwsConstant::SEARCH_ITEM_VIDEO => 'Video',
					RwsConstant::SEARCH_ITEM_CHANNEL => 'Channel',
					RwsConstant::SEARCH_ITEM_URl => 'Web / Url'
			);
			echo $this->Form->input ( '', array (
					'name' => 'searchType',
					'id' => 'select_search_type',
					'options' => $searchTypeArr,
					'label' => false,
					'div' => false,
					'multiple' => false,
					'value' => isset($searchType)? $searchType : '0',
					'onClick' => 'fnc_change_search_type()'
			) );
	  	?> 
	  	</td>
	</tr>
	<tr id='id_search_youtube_1'>
		<td><?php echo $scrFieldLabels['SCR_SEARCH_DATE_FROM'];?></td>
		<td><input id="id_date_from" name="date1" type="date"
			value=<?php echo isset($date1) ? $date1 : '';?>></td>
		<td><?php echo $scrFieldLabels['SCR_SEARCH_DATE_TO'];?></td>
		<td><input id="id_date_to" name="date2" type="date"
			value=<?php echo isset($date2) ? $date2 : '';?>></td>
		<td><?php echo $scrFieldLabels['SCR_SEARCH_MAXROW'];?></td>
		<td><input type="text" id="maxResults" name="maxResults"
			value="<?php echo (isset($maxResults) ? $maxResults : '10'); ?>"></td>
	</tr>
	<tr id='id_search_youtube_2'>
		<td><?php echo $scrFieldLabels['SCR_SEARCH_HD'];?></td>
		<td>
		  	<?php 
		  		$hdTypeList = array (
						'any' => $scrFieldLabels['SCR_SEARCH_HD_ANY'],
						'high' => 'HD',
						'standard' => $scrFieldLabels['SCR_SEARCH_HD_NORMAL'] 
				);
				echo $this->Form->input ( '', array (
						'name' => 'videoDefinition',
						'id' => 'select_hd_type',
						'options' => $hdTypeList,
						'label' => false,
						'div' => false,
						'multiple' => false,
						'value' => isset($videoDefinition)? $videoDefinition : '0'
				) );
		  	?> 
		  </td>
		<td><?php echo $scrFieldLabels['SCR_SEARCH_LENGHT'];?></td>
		<td> 
		    <?php 
		  		$videoLongList = array (
						'any' => $scrFieldLabels['SCR_SEARCH_HD_ANY'],
						'long' => $scrFieldLabels['SCR_SEARCH_LENGHT_LONG'],
						'medium' => $scrFieldLabels['SCR_SEARCH_LENGHT_SHORT20'],
		  				'short' => $scrFieldLabels['SCR_SEARCH_LENGHT_SHORT4']
				);
				echo $this->Form->input ( '', array (
						'name' => 'videoDuration',
						'id' => 'select_video_long',
						'options' => $videoLongList,
						'label' => false,
						'div' => false,
						'multiple' => false,
						'value' => isset($videoDuration)? $videoDuration : '0'
				) );
		  	?> 
		  </td>
		<td><?php echo $scrFieldLabels['SCR_SEARCH_SORT'];?></td>
		<td> 
		    <?php 
		  		$sortTypeList = array (
						'date' => $scrFieldLabels['SCR_SEARCH_ORDER_DATE'],
						'rating' => $scrFieldLabels['SCR_SEARCH_ORDER_RATING'],
						'relevance' => $scrFieldLabels['SCR_SEARCH_ORDER_SEARCH'],
		  				'title' => $scrFieldLabels['SCR_SEARCH_ORDER_TITLE'],
				  		'videoCount' => $scrFieldLabels['SCR_SEARCH_ORDER_CHANNELVIDEO'],
				  		'viewCount' => $scrFieldLabels['SCR_SEARCH_ORDER_VIEW']
				);
				echo $this->Form->input ( '', array (
						'name' => 'order',
						'id' => 'select_video_long',
						'options' => $sortTypeList,
						'label' => false,
						'div' => false,
						'multiple' => false,
						'value' => isset($order)? $order : '0'
				) );
		  	?> 
		  </td>
	</tr>
	<tr>
		<td colspan="1"><input type="button" value="Search"
			onClick="fnc_SearchSubmit();"></td>
		<td>
	  	<?php  
	  	if(isset($prevPageToken)){
			echo '<a onClick="fnc_SearchPrevSubmit();" class="yt-uix-button  yt-uix-pager-button yt-uix-sessionlink yt-uix-button-default yt-uix-button-size-default" data-sessionlink="ei=CGHdVcaCKMbh4QL1vbOICg&amp;feature=pagination" data-link-type="prev" data-page="1"><span class="yt-uix-button-content">« Previous</span></a>';
	  	}
	  	if(isset($nextPageToken)){
			echo '<a onClick="fnc_SearchNextSubmit();" class="yt-uix-button  yt-uix-pager-button yt-uix-sessionlink yt-uix-button-default yt-uix-button-size-default" data-sessionlink="feature=pagination&amp;ei=wl7dVdfGNIiy4AKhs7uoBA" data-page="2" data-link-type="next"><span class="yt-uix-button-content">Next »</span></a>';
	  	}
	  	
	  	?>
	  </td>
	</tr>
</table>
<?php

} else {
    ?>
<table class='search'>
	<tr>
		<td>
			<?php echo $scrFieldLabels['SCR_SEARCH_UPLOAD_DATE']; ?>
		</td>
		<td>
		  	<?php 
		  		$hdUpdateDates = array (
		  				'' => '',
		  				'hour' => $scrFieldLabels['SCR_SEARCH_LAST_HOUR'],
						'today' => $scrFieldLabels['SCR_SEARCH_TODAY'],
						'week' => $scrFieldLabels['SCR_SEARCH_THIS_WEEK'], 
		  				'month' => $scrFieldLabels['SCR_SEARCH_THIS_MONTH'],
		  				'year' => $scrFieldLabels['SCR_SEARCH_THIS_YEAR']
				);
				echo $this->Form->input ( '', array (
						'name' => 'videoUploadDate',
						'id' => 'id_select_upload_date',
						'options' => $hdUpdateDates,
						'label' => false,
						'div' => false,
						'multiple' => false,
						'value' => isset($videoUploadDate)? $videoUploadDate : '0'
				) );
		  	?> 
		  </td>
		<td><?php echo $scrFieldLabels['SCR_SEARCH_TYPE'];?></td>
		<td> 
		    <?php 
		  		$videoTypes = array (
		  				'' => '',
						'video' => $scrFieldLabels['SCR_SEARCH_VIDEO'],
						'channel' => $scrFieldLabels['SCR_SEARCH_CHANNEL'],
						'playlist' => $scrFieldLabels['SCR_SEARCH_PLAYLIST'],
		  				'movie' => $scrFieldLabels['SCR_SEARCH_MOVIE'],
		  				'show' => $scrFieldLabels['SCR_SEARCH_SHOW']
				);
				echo $this->Form->input ( '', array (
						'name' => 'videoType',
						'id' => 'id_select_video_type',
						'options' => $videoTypes,
						'label' => false,
						'div' => false,
						'multiple' => false,
						'value' => isset($videoType)? $videoType : '0'
				) );
		  	?> 
		  </td>
		<td><?php echo $scrFieldLabels['SCR_SEARCH_DURATION'];?></td>
		<td> 
		    <?php 
		  		$videoDurations = array (
		  				'' => '',
						'sort' => $scrFieldLabels['SCR_SEARCH_SHORT4'],
						'long' => $scrFieldLabels['SCR_SEARCH_LONG20']						
				);
				echo $this->Form->input ( '', array (
						'name' => 'videoDuration',
						'id' => 'id_select_duration',
						'options' => $videoDurations,
						'label' => false,
						'div' => false,
						'multiple' => false,
						'value' => isset($videoDuration)? $videoDuration : '0'
				) );
		  	?> 
		  </td>
	</tr>
	<tr>
		<td><?php echo $scrFieldLabels['SCR_SEARCH_FEATURES'];?></td>
		<td>
		  	<?php 
		  		$videoFeatures = array (
		  				'' => '',
						'4k' => $scrFieldLabels['SCR_SEARCH_4K'],
						'hd' => $scrFieldLabels['SCR_SEARCH_HD'],
						'cc' => $scrFieldLabels['SCR_SEARCH_SUB_CC'],
		  				'creativecommons' => $scrFieldLabels['SCR_SEARCH_CREATIVE_COMMONS'], 
				  		'3d' => $scrFieldLabels['SCR_SEARCH_3D'],
				  		'live' => $scrFieldLabels['SCR_SEARCH_LIVE'],
				  		'purchased' => $scrFieldLabels['SCR_SEARCH_PURCHASED'],
		  				'spherical' => $scrFieldLabels['SCR_SEARCH_360'],
				);
				echo $this->Form->input ( '', array (
						'name' => 'videoFeature',
						'id' => 'id_select_features',
						'options' => $videoFeatures,
						'label' => false,
						'div' => false,
						'multiple' => false,
						'value' => isset($videoFeature)? $videoFeature : '0'
				) );
		  	?> 
		  </td>
		<td><?php echo $scrFieldLabels['SCR_SEARCH_SORT_BY'];?></td>
		<td> 
		    <?php 
		  		$videoSortBys = array (
		  				'' => '',
						'video' => $scrFieldLabels['SCR_SEARCH_RELEVANCE'],
						'video_date_uploaded' => $scrFieldLabels['SCR_SEARCH_UPLOAD_DATE'],
						'video_view_count' => $scrFieldLabels['SCR_SEARCH_VIEW_COUNT'],
		  				'video_avg_rating' => $scrFieldLabels['SCR_SEARCH_RATING']
				);
				echo $this->Form->input ( '', array (
						'name' => 'videoSortBy',
						'id' => 'id_select_sort_by',
						'options' => $videoSortBys,
						'label' => false,
						'div' => false,
						'multiple' => false,
						'value' => isset($videoSortBy)? $videoSortBy : '0'
				) );
		  	?> 
		  </td>
		<td><?php echo $scrFieldLabels['SCR_SEARCH_PAGE'];?></td>
		<td><input type="text" id="id_video_page" name="videoPage"
			value="<?php echo (isset($page) ? $page+1 : '1'); ?>"></td>
	</tr>
	<tr>
		<td colspan="2"><input type="button" value="Search"
			onClick="fnc_search_results();"></td>
	</tr>
</table>
<?php 
    }
    ?>
<div class="fl">
	<h1>
		<?php 
		if(isset($pageOfResults)){
			$resultsIndex = $resultsPerPage * ($pageOfResults - 1) + 1;
			echo "Page $pageOfResults from $resultsIndex"."st videos of about $totalResults results";
		}
		else{
			echo "Results";
		}?>
	</h1>
    <?php 
	$cnt = 0;
	if(isset($videos)){
		$cnt = sizeof($videos);
	}
	?>
	<input type='hidden' name='hdn_id_cnt' id='hdn_id_cnt'
		value='<?php echo $cnt; ?>'> <input type='hidden'
		name='hdn_id_video_id_select' id='hdn_id_video_id_select' value=''>
	<table class="ymain bd">
		<tbody>
			<tr class="head">
				<td style="width: 20px">STT</td>
				<td style="width: 90px">Ảnh</td>
				<td style="width: 30%; min-width: 200px;">Tên Video</td>
				<td style="width: 15%">Tên Kênh</td>
				<td style="width: 15%">Ga + NET</td>
				<td style="width: 10%; min-width: 50px">Tình trạng</td>
				<td style="width: 10%; min-width: 50px">Quảng cáo</td>
				<td style="width: 10%">Chặn quốc gia</td>
				<td style="width: 165px; min-width: 165px;">Thông tin</td>
				<td style="width: 10%">Trạng thái</td>
				<td class="text-center"><input id="id_check_all" type="checkbox"
					onclick="nv_checkAll();" value="true"></td>
			</tr>
        <?php 
        $hdn_id_video_id_list = "";
		if(isset($videos) && (is_array($videos) || is_object($videos))){
			$cnt = 0;
			foreach ($videos as $video){
				$cnt++;
				if($hdn_id_video_id_list == ""){
					$hdn_id_video_id_list = $video['TVideoSub']['VIDEO_ID'];
				}
				else{
					$hdn_id_video_id_list = $hdn_id_video_id_list . "," . $video['TVideoSub']['VIDEO_ID'];
				}
				if($cnt % 2 == 0){
	        		echo "<tr class=''>";
	        	}else{
			?>
			<tr class='second'>
		    <?php 
	        	}
		    	echo "<input type='hidden' id='hdn_id_video_id$cnt' value='".$video['TVideoSub']['VIDEO_ID']."'>";
		    	$ga = '';
		    	if($video['TVideoSub']['GA'] == 1){
		    		$ga = "(GA)";	
		    	}
	  	    ?>
			<td style="text-align: center"><?php echo $cnt;?></td>
				<td><img class="img-thumbnail"
					src="<?php echo $video['TVideoSub']['THUMBNAILS'];?>"
					style="max-width: inherit; width: 90px"></td>
				<td><a target="_blank"
					title="<?php echo $video['TVideoSub']['TITLE'];?>"
					href="<?php echo RwsConstant::FULL_BASE_URL_HOST; ?>/watch?v=<?php echo $video['TVideoSub']['VIDEO_ID'];?>"><?php echo $video['TVideoSub']['TITLE'] . "(".$video['TVideoSub']['DURATION'].")";?></a></td>
				<td><a target="_blank"
					title="<?php  echo $video['TVideoSub']['CHANNEL_TITLE']; ?>"
					href="https://www.youtube.com/channel/<?php echo $video['TVideoSub']['CHANNEL_ID'];?>"><?php  if(strlen($video['TVideoSub']['CHANNEL_TITLE']) == 0){ echo $video['TVideoSub']['CHANNEL_ID']; }else{ echo $video['TVideoSub']['CHANNEL_TITLE'];} ?></a></td>
				<td><?php echo isset($video['TVideoSub']['ATTRIBUTION']) ? $video['TVideoSub']['ATTRIBUTION'] . $ga : "Only Vip Account"; //echo getMetaAttribution("https://www.youtube.com/watch?v=".$searchResult['id']);?></td>
				<td><?php 
				if(strlen($video['TVideoSub']['REJECTION_REASON']) == 0){
					echo "Bình Thường";
				}
				else{
					echo $video['TVideoSub']['REJECTION_REASON'];
				}
			
			?></td>
				<td><?php 
			if($video['TVideoSub']['LICENSED_CONTENT'] == 1){
				echo "Có";
			}
			else{
				echo "Không";
			}
			?>
			</td>
				<td><?php echo $video['TVideoSub']['REGION_RESTRICTION_BLOCKED'];?></td>
				<td><span class="info"><span class="view">&nbsp;</span><?php echo getCountShot($video['TVideoSub']['VIEW_COUNT']);?></span>
					<span class="info"><span class="like">&nbsp;</span><?php echo getCountShot($video['TVideoSub']['LIKE_COUNT']);?></span>
					<span class="info"><span class="dislike">&nbsp;</span><?php echo getCountShot($video['TVideoSub']['DISLIKE_COUNT']);?></span>
					<span class="info"><span class="subcribe">&nbsp;</span><?php echo getCountShot($video['TVideoSub']['FAVORITE_COUNT']);?></span>
					<span class="info"><span class="comment">&nbsp;</span><?php echo getCountShot($video['TVideoSub']['COMMENT_COUNT']);?></span><br>
					<div class="clearfix"></div>
                Publis: <?php echo $video['TVideoSub']['PUBLISHED_AT'];?>
            </td>
				<td>
            	<?php echo $video['TVideoSub']['DIMENSION'] . "<br>" . $video['TVideoSub']['DEFINITION'] . "<br> " . $video['TVideoSub']['DELETE_YMD'];?>
            </td>
				<td class="text-center"><input type="checkbox"
					id="id_check<?php echo $cnt?>" onclick="nv_check();"></td>
			</tr>
	    <?php
			}
		}
		?>
		<tr>
				<td colspan="11"><input type='hidden' name='hdn_id_video_id_list'
					id='hdn_id_video_id_list'
					value='<?php echo $hdn_id_video_id_list;?>'>
					<?php echo "<input type='button' onClick='getLink();' style='float:right;' value='".$scrFieldLabels['SCR_SEARCH_GET_LINK']."' />"; ?>
					<?php echo "<input type='button' onClick='fnc_doAddVideoToSubscriptions();' style='float:right;' value='".$scrFieldLabels['SCR_SEARCH_ADD_MANAGE']."' />"; ?>
					<?php echo "<input type='button' onClick='fnc_doAddVideoToReup();' style='float:right;' value='".$scrFieldLabels['SCR_SEARCH_ADD_YOUMAN']."' />"; ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php echo $this->Form->end() ?>
	<div class='getlink'>
		<div id='getLinkArea'></div>
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