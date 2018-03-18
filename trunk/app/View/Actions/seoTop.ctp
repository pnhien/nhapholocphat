<?php 
	echo $this->Html->css (array(
			'search','video'
	));
?>
<script type="text/javascript">
$(document).ready(function() {
	if($('#select_search_type').val() == '1'){
		$('#id_search_youtube_1').css("display","none");
		$('#id_search_youtube_2').css("display","none");
	}
	$('#id_progress_bar').css("display","none");
});
function fnc_change_search_type()
{
	if($('#select_search_type').val() == '1'){
		$('#id_search_youtube_1').css("display","none");
		$('#id_search_youtube_2').css("display","none");
		$('#id_your_url').attr('placeholder','<?php echo RwsConstant::FULL_BASE_URL_HOST; ?>');
	}
	else{
		$('#id_search_youtube_1').css("display","");
		$('#id_search_youtube_2').css("display","");
		$('#id_your_url').attr('placeholder','<?php echo RwsConstant::FULL_BASE_URL_HOST; ?>/watch?v=G2N0s2CTBBE');
	}
}
function fnc_SearchSubmit(){
	if($('#select_search_type').val() == '0'){
	 	var action = '<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/seoTop/doSearchSeoTopYoutube';
	}
	else{
		var action = '<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/seoTop/doSearchSeoTopWeb';
	}
    $('#TSeoTopIndexForm').attr('action', action);
    $('#TSeoTopIndexForm').submit();
    $('#id_progress_bar').css("display","");
  	//find the amount of "seconds" between now and target
	var seconds_left = (($('#id_top_search').val() - ($('#id_top_search').val() - 1)%10 - 1) / 10) * 0.5;
   	// get tag element
	var countdown = document.getElementById("countdown");
	// format countdown string + set tag value
    countdown.innerHTML = "Look in : " + seconds_left + "s";
}

</script>

<?php echo $this->Form->create('TSeoTop', array('id'=>'TSeoTopIndexForm', 'url' => array ('controller' => 'seoTop', 'action' => 'doSearchSeoTopYoutube'), 'role' => 'form', 'novalidate' => true));
	if(!isset($searchType)){
		$searchType = 0;
	} 
?>
<table class='search'>
	<tr>
		<td><?php echo $scrFieldLabels['SCR_SEARCH_KEYWORD'];?></td>
		<td colspan="3"><input type="text" id="q" name="q"
			class="inputUrl" placeholder="Enter search keyword"
			value='<?php echo (isset($q) ? $q : ''); ?>'></td>
		<td><?php echo $scrFieldLabels['SCR_SEARCH_TYPE'];?></td>
		<td> 
	    <?php 
	  		$searchTypeArr = array (
					"0" => 'Youtube',
					"1" => 'Web'
			);
			echo $this->Form->input ( '', array (
					'name' => 'searchType',
					'id' => 'select_search_type',
					'options' => $searchTypeArr,
					'label' => false,
					'div' => false,
					'multiple' => false,
					'value' => isset($searchType)? $searchType : '1',
					'onChange' => 'fnc_change_search_type()'
			) );
	  	?> 
	  	</td>
	</tr>
	<tr>
		<td><?php echo $scrFieldLabels['SCR_SEOTOP_YOUR_KEY'];?></td>
		<td colspan="3"><input type="text" id="id_your_url" name="yourUrl"
			class="inputUrl" placeholder="<?php echo RwsConstant::FULL_BASE_URL_HOST; ?>/watch?v=G2N0s2CTBBE"
			value="<?php echo (isset($yourUrl) ? $yourUrl : ''); ?>"></td>
			
		<td><?php echo $scrFieldLabels['SCR_SEOTOP_TOP_SEARCH'];?></td>
		<td><input type="text" id="id_top_search" name="topSearch" class="inputPage"
			value="<?php echo (isset($topSearch) ? $topSearch : '10'); ?>"></td>
	</tr>
	
	<tr id='id_search_youtube_1'>
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
				));
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
	<tr id='id_search_youtube_2'>
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
	</tr>
	
	<tr>
		<td colspan="1"><input type="button" value="Search"
			onClick="fnc_SearchSubmit();"></td>
		<td id='id_progress_bar'>
			<span id="countdown"></span>
		</td>		
	</tr>
</table>
<div class="fl">
	<h1>
		Results
	</h1>
    <?php 
    	
	$cnt = 0;
	if(isset($seoTopSearchArr)){
		$cnt = sizeof($seoTopSearchArr);
	}
	?>
	<input type='hidden' name='hdn_id_cnt' id='hdn_id_cnt'
		value='<?php echo $cnt; ?>'>
	<table class="ymain bd">
		<tbody>
			<tr class="head">
				<td style="width: 20px">STT</td>
				<td style="width: 50%">Link</td>
				<td style="width: 30%">Keyword</td>
				<td style="width: 200px">Date</td>
				<td style="width: 50px">Top</td>
			</tr>
        <?php 
		if(isset($seoTopSearchArr) && (is_array($seoTopSearchArr) || is_object($seoTopSearchArr))){
			$cnt = 0;
			foreach ($seoTopSearchArr as $seoTop){
				$cnt++;
				if($cnt % 2 == 0){
	        		echo "<tr class=''>";
	        	}else{
			?>
			<tr class='second'>
		    <?php 
	        	}
	  	    ?>
				<td style="text-align: center"><?php echo $cnt;?></td>			
				<td><a target="_blank"
						href="<?php echo $seoTop['TSeoTop']['LINK'];?>">
						<?php echo $seoTop['TSeoTop']['LINK'];?>
						</a></td>
				<td ><?php echo $seoTop['TSeoTop']['KEYWORD'];?></td>
				<td ><?php echo $seoTop['TSeoTop']['CREATE_YMD'];?></td>
				<td style="text-align: center"><a target="_blank" href='<?php echo $seoTop['TSeoTop']['LINK_GOOGLE'];?>'>
					<?php echo $seoTop['TSeoTop']['TOP'];?>
					</a>
				</td>
			</tr>
	    <?php
			}
		}
		?>
		<tr>
				<td colspan="11">

				</td>
			</tr>
		</tbody>
	</table>
	<?php echo $this->Form->end() ?>
	<?php 
		if(isset($pagesearch))
			foreach ($pagesearch as $pag)
				echo $pag . "<br>";
	?>
</div>