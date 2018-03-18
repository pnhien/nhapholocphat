<style>
td {
    padding: 5px;
}
</style>
<div class="capture-area"><?php 
$login_user_role = 0 + $this->Session->read('login.user.AUTH_ROLE');
if($login_user_role <= RwsConstant::USER_AUTH_ROLE_SUB){
	echo $this->Form->create('TNews', array('url' => array ('controller' => 'editNews', 'action' => 'doUpdateNews'), 'id' => 'TNewsIndexForm', 'role' => 'form', 'novalidate' => true));
		echo "<input type='hidden' id='user_id_login' value='".$user_id_login."' >";
		echo "<input type='hidden' id='id_new_id' name='data[TNews][ID]' value='".$news['TNews']['ID']."' >";
	?>	
<table summary="authority list" class="table-list" cellpadding="10">
	<caption>Edit news</caption>
	<tbody class="table-center">
	<tr>
		<td>Title</td>
		<td>
		<?php 
		echo $this->Form->input ( '', array (
						'name' => 'data[TNews][TITLE]',
						'id' => 'id_news_title',
						'type' => 'text',
						'style'=>'width: 800px',
						'label' => false,
						'div' => false,
						'error' => false,
						'value' => $news['TNews']['TITLE']
			) );
		?>
		</td>
	</tr>
	<tr>
		<td>Descripton</td>
		<td>
		<?php
		echo $this->Form->input ( '', array (
							'name' => 'data[TNews][DESCRIPTION]',
							'id' => 'id_news_description',
							'type' => 'textarea',
							'style'=>'width: 800px',
							'label' => false,
							'div' => false,
							'error' => false,
							'value' => $news['TNews']['DESCRIPTION']
		) );
		?>
		</td>
	</tr>
	<tr>
		<td>Link</td>
		<td>
	<?php 
	echo $this->Form->input ( '', array (
						'name' => 'data[TNews][LINK]',
						'id' => 'id_news_link',
						'type' => 'text',
						'style'=>'width: 760px',
						'label' => false,
						'div' => false,
						'error' => false,
						'value' => $news['TNews']['LINK']
	) );
	?>
		<a target='_blank' href='<?php echo $news['TNews']['LINK']?>'> news</a>
		</td>
	</tr>
	<tr>
		<td>Content</td>
		<td>
	<?php 
	echo $this->Form->input ( '', array (
						'name' => 'data[TNews][CONTENT]',
						'id' => 'id_news_content',
						'type' => 'textarea',
						'style'=>'width: 800px;height: 350px',
						'label' => false,
						'div' => false,
						'error' => false,
						'value' => $news['TNews']['CONTENT']
	) );
?>
		</td>
	</tr>
		
	<tr>
			<td>Public date</td>
			<td>
				<?php 
				echo $this->Form->input ( '', array (
									'name' => 'data[TNews][PUB_DATE]',
									'id' => 'id_news_pub_date',
									'type' => 'text',
									'label' => false,
									'div' => false,
									'error' => false,
									'value' => $news['TNews']['PUB_DATE']
				) );
			?>
		</td>
	</tr>
	<tr>
		<td class='tc'><input type='button' onClick='fnc_doCheckUpdateNews();' class='addition_button' value='<?php echo $scrFieldLabels['BTN_EDIT']?>' />
		<?php 
			$linkSort = getLinkSort($news['TNews']['LINK'], $news['TRssNews']['HOME']);
			$newsId = $news['TNews']['ID'];
			$host = RwsConstant::FULL_BASE_URL_HOST;
			echo "<a target='_blank' href='$host/news?id=$newsId&$linkSort'> Preview</a>"; 
		?>
		</td>
		<td class='tc'><input type='button' onClick='fnc_doCheckDeleteNews();' class='addition_button' value='<?php echo $scrFieldLabels['BTN_DELETE']?>' /></td>
	</tr>
	</tbody>
</table>
	<?php
	echo $this->Form->end();
}
?></div>

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
<script type="text/javascript">

function fnc_doCheckUpdateNews() {
	$('#id_div_flash').empty().hide();
	$('#id_div_error').empty().hide();

	var id_news_title = $('#id_news_title').val();
	var id_news_description = $('#id_news_description').val();
	var id_news_link = $('#id_news_link').val();
	var id_news_content = $('#id_news_content').val();
	var id_news_pub_date = $('#id_news_pub_date').val();
	
	if(id_news_title == ''){
		var html = '<div class="notice">';
		html += '	<div class="error">';
		html += '		<p>Title null</p>';
		html += '	</div>';
		html += '</div>';
		$('#id_div_error').append(html).show();
		$('#id_news_title').focus();
		return;
	}

	if(id_news_description == ''){
		var html = '<div class="notice">';
		html += '	<div class="error">';
		html += '		<p>Description null</p>';
		html += '	</div>';
		html += '</div>';
		$('#id_div_error').append(html).show();
		$('#id_news_description').focus();
		return;
	}

	if(id_news_link == ''){
		var html = '<div class="notice">';
		html += '	<div class="error">';
		html += '		<p>Link null</p>';
		html += '	</div>';
		html += '</div>';
		$('#id_div_error').append(html).show();
		$('#id_news_link').focus();
		return;
	}
	if(id_news_content == ''){
		var html = '<div class="notice">';
		html += '	<div class="error">';
		html += '		<p>Content null</p>';
		html += '	</div>';
		html += '</div>';
		$('#id_div_error').append(html).show();
		$('#id_news_content').focus();
		return;
	}
	if(id_news_pub_date == ''){
		var html = '<div class="notice">';
		html += '	<div class="error">';
		html += '		<p>Title null</p>';
		html += '	</div>';
		html += '</div>';
		$('#id_div_error').append(html).show();
		$('#id_news_pub_date').focus();
		return;
	}
	
	document.forms['TNewsIndexForm'].submit();
}

function fnc_doCheckDeleteNews() {
	var action = '<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/editNews/doDeleteNews';
    $('#TNewsIndexForm').attr('action', action);
	$('#TNewsIndexForm').submit();
}
</script>

