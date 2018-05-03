<?php 
	echo $this->Html->script (array(
			'jquery/ajaxform'
	));
?>
<script type="text/javascript">
function fnc_doGetDistricts() {
	$('#id_div_flash').empty().hide();
	$('#id_div_error').empty().hide();

	var province_code = $('#id_bdsnews_province_code').val();
	var dataInput = [province_code];
	$.ajax({
		url : <?php echo "'/bdsNews/doGetDistricts'"?> ,
		type : 'POST',
		data : {dataInput: dataInput},
		cache : false,
		dataType : 'json', 
		async : false,
		success : function(result) {
			if (!result['success']) {
				var html = '<div class="notice">';
				html += '	<div class="error">';
				html += '		<p>' + result['data'] + '</p>';
				html += '	</div>';
				html += '</div>';
				$('#id_div_error').append(html).show();
				$('#' + result['id_error']).focus();
			}
			$('#id_bdsnews_district_code option').remove();
			$('#id_bdsnews_ward_code option').remove();
			$('#id_bdsnews_street_code option').remove();
			$(result['districtList']).each(function() 
			{
             $('#id_bdsnews_district_code').append($("<option>").attr('value',this['District']['DISTRICT_CODE']).text(this['District']['DISTRICT_NAME']));
         });
			fnc_doGetWards();
			fnc_doGetStreets();
			fnc_makeAddress();
	    },
	    error : function (result) {
	    	openAlertDialog(MESSAGE_ERROR_AJAX);
	    }
	});
}
function fnc_doGetWards() {
	$('#id_div_flash').empty().hide();
	$('#id_div_error').empty().hide();

	var district_code = $('#id_bdsnews_district_code').val();
	var district_name = $('#id_bdsnews_district_code option:selected').text();
	var dataInput = [district_code];
	$.ajax({
		url : <?php echo "'/bdsNews/doGetWards'"?> ,
		type : 'POST',
		data : {dataInput: dataInput},
		cache : false,
		dataType : 'json', 
		async : false,
		success : function(result) {
			if (!result['success']) {
				var html = '<div class="notice">';
				html += '	<div class="error">';
				html += '		<p>' + result['data'] + '</p>';
				html += '	</div>';
				html += '</div>';
				$('#id_div_error').append(html).show();
				$('#' + result['id_error']).focus();
			}
			$('#id_bdsnews_ward_code option').remove();
			$('#id_bdsnews_street_code option').remove();
			$(result['wardList']).each(function() 
			{
             $('#id_bdsnews_ward_code').append($("<option>").attr('value',this['Ward']['WARD_CODE']).text(this['Ward']['WARD_NAME']));
         });
			fnc_doGetStreets();
			fnc_makeAddress();
	    },
	    error : function (result) {
	    	openAlertDialog(MESSAGE_ERROR_AJAX);
	    }
	});
}
function fnc_doGetStreets() {
	$('#id_div_flash').empty().hide();
	$('#id_div_error').empty().hide();

	var district_code = $('#id_bdsnews_district_code').val();
	var district_name = $('#id_bdsnews_district_code option:selected').text();
	var dataInput = [district_code];
	$.ajax({
		url : <?php echo "'/bdsNews/doGetStreets'"?> ,
		type : 'POST',
		data : {dataInput: dataInput},
		cache : false,
		dataType : 'json', 
		async : false,
		success : function(result) {
			if (!result['success']) {
				var html = '<div class="notice">';
				html += '	<div class="error">';
				html += '		<p>' + result['data'] + '</p>';
				html += '	</div>';
				html += '</div>';
				$('#id_div_error').append(html).show();
				$('#' + result['id_error']).focus();
			}
			$(result['streetList']).each(function() 
			{
             $('#id_bdsnews_street_code').append($("<option>").attr('value',this['Street']['STREET_CODE']).text(this['Street']['STREET_NAME']));
         });
			fnc_makeAddress();
	    },
	    error : function (result) {
	    	openAlertDialog(MESSAGE_ERROR_AJAX);
	    }
	});
}

function fnc_makeAddress(){
	var province_name = $('#id_bdsnews_province_code option:selected').text();
	var district_name = $('#id_bdsnews_district_code option:selected').text();
	var ward_name = $('#id_bdsnews_ward_code option:selected').text();
	var street_name = $('#id_bdsnews_street_code option:selected').text();
	var so_nha = $('#id_bdsnews_so_nha').val();
	$("#DisplayForAddress").html(so_nha + ", " +  street_name + ", " +  ward_name + ", " + district_name + ", " + province_name);
}
</script>

<?php echo $this->Form->create('BdsNews', array('url' => array ('controller' => 'BdsNews', 'action' => 'doSaveBdsNews'), 'role' => 'form', 'novalidate' => true, 'enctype'=>'multipart/form-data')); ?>

            <?php 
                echo $this->Form->input ( '', array (
								'name' => 'data[BdsNews][BDSNEWS_ID]',
								'id' => 'id_bdsnews_bdsnews_id',
								'type' => 'text',
								'type' => 'hidden',
								'div' => false
					) );
            ?>

            <!-- StaffInfo -->
            
<!-- Thông tin nội bộ -->
<article class="content-item">
    <header>
        <div class="header-wrapper">
            <div class="header-center header-bg-green">
                <div class="header-left header-bg-green">
                    <div class="header-left-triangle"></div>
                </div>
                <h1>Thông tin nội bộ</h1>
                <div class="header-right"></div>
            </div>
        </div>
    </header>
    <article>
        <br>
        <div class="form-horizontal pull-left">
            <!-- LastInfoFromUser -->
            <div class="control-group">
                <label class="control-label">Nguồn:</label>
                <div class="controls">
                	<?php 
                		$option = array();
                		foreach ($customerlist as $customer){
                				$option[$customer['TCustomer']['USER_ID']] = $customer['TCustomer']['CUSTOMER_NAME'];
                		}
                		echo $this->Form->select ( '', $option, array(
                			'id' => 'id_bdsnews_user_id', 
                			'name' => 'data[BdsNews][USER_ID]'
                		));
                	?>
                </div>
            </div>
            <!-- Flag -->
            <div class="control-group">
                <label class="control-label">Đánh dấu:</label>
                <div class="controls">
                	<?php 
                		$option = array();
                		foreach ($danhDaulist as $danhDau){
                				$option[$danhDau['DanhDau']['DANH_DAU_CODE']] = $danhDau['DanhDau']['DANH_DAU_NAME'];
                		}
                		echo $this->Form->select ( '', $option, array(
                			'id' => 'id_bdsnews_danh_dau_code', 
                			'name' => 'data[BdsNews][DANH_DAU_CODE]',
                			'class' => 'deal-good'
                		));
                		?>
                		<label>
							<?php
							echo $this->Form->input ( '', array (
											'name' => 'data[BdsNews][REMOVE_BDS_FLG]',
											'id' => 'id_bdsnews_remove_bds_flg',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Loại khỏi định giá</label>
						</div>
            </div>
            <!-- Status -->
            <div class="control-group">
                <label class="control-label">Tình trạng:</label>
                <div class="controls">
	                <?php 
	                		$option = array();
	                		foreach ($tinhTranglist as $tinhTrang){
	                				$option[$tinhTrang['TinhTrang']['TINH_TRANG_CODE']] = $tinhTrang['TinhTrang']['TINH_TRANG_NAME'];
	                		}
	                		echo $this->Form->select ( '', $option, array(
	                			'id' => 'id_bdsnews_tinh_trang_code', 
	                			'name' => 'data[BdsNews][TINH_TRANG_CODE]',
	                			'class' => 'select-box'
	                		));
                		?>
                		<label>
							<?php 
                		echo $this->Form->input ( '', array (
											'name' => 'data[BdsNews][BY_GROUP]',
											'id' => 'id_bdsnews_by_group',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
                		?>Được bán bởi Group</label>
                </div>
            </div>

            <!-- Note -->
            <div class="control-group">
                <label class="control-label">Ghi chú nội bộ:</label>
                <div class="controls">
                    <?php
							echo $this->Form->input ( '', array (
											'name' => 'data[BdsNews][BDS_NOTE]',
											'id' => 'id_bdsnews_bds_note',
											'type' => 'text',
											'class' => 'text text-box-medium'
								) );
							?>
                </div>
            </div>

            <!-- ContactPhoneToDisplay -->
            <div class="control-group">
                <label class="control-label">ĐT hiển thị:</label>
                <div class="controls">
						<?php
						echo $this->Form->input ( '', array (
										'name' => 'data[BdsNews][DIEN_THOAI]',
										'id' => 'id_bdsnews_dien_thoai',
										'type' => 'text',
										'class' => 'text text-box-medium'
							) );
						?>
					 </div>
            </div>
            <!-- Images -->
<!--            <div class="control-group">-->
<!--                <label class="control-label">Hình ảnh:</label>-->
<!--                <div class="controls">-->
<!--                    -->
<!---->
<!--<div id="uploadifive-file_upload" class="uploadifive-button" style="height: 30px; line-height: 30px; overflow: hidden; position: relative; text-align: center; width: 100px;">-->
<!--    Select Files-->
<!--    <input type="file" id="file_upload" name="file_upload" data-url="/RealEstate.Admin/Home/Upload?contentItemId=2166882&amp;userId=1667444&amp;isPublished=False" style="font-size: 30px; opacity: 0; position: absolute; right: -3px; top: -3px; z-index: 999;" multiple="multiple">-->
<!--</div>-->
<!--
<!-- The global progress bar 
<!--<div id="uploadifive-file_progress" class="uploadifive-queue-item" style="display:none;">-->
<!--    <span id="uploadifive-file_name"></span>-->
<!--    <div id="progress" class="progress">-->
<!--        <div class="progress-bar"></div>-->
<!--    </div>-->
<!--</div>-->
<!--<div id="errors"></div> -->
<!--                </div>-->
<!--            </div>-->
            <!-- Youtube Video -->
            <div class="control-group">
                <label class="control-label">Youtube Id:</label>
                <div class="controls">
                	<label>
                    <?php
							echo $this->Form->input ( '', array (
											'name' => 'data[BdsNews][YOUTUBE_ID]',
											'id' => 'id_bdsnews_youtube_id',
											'type' => 'text',
											'placeholder' => 'Dán YoutubeId vào đây',
											'class' => 'text text-box-medium'
								) );
							?>
<!--                    <div>-->
<!--                        Vào <a href="https://www.youtube.com/upload" target="_blank"><strong>Youtube.com</strong></a> để upload video, <br>-->
<!--                        sau đó copy YoutubeId giống như hình bên dưới và dán(paste) vào ô trên<br>-->
<!--                    </div>-->
                </div>
            </div>

        </div>
        <div class="form-horizontal pull-left">
            <div class="control-group" style="font-style:italic;">
                <!-- VisitedCount -->
                <!-- TODO -->
            </div>
        </div>
        <div class="clearfix"></div>
    </article>
    <footer></footer>
</article>

<!-- Hình ảnh -->
<article class="content-item">
    <header>
        <div class="header-wrapper">
            <div class="header-center header-bg-green">
                <div class="header-left header-bg-green">
                    <div class="header-left-triangle"></div>
                </div>
                <h1>Hình ảnh</h1>
                <div class="header-right"></div>
            </div>
        </div>
    </header>
    <article>
        <div class="form-horizontal">
            <div class="control-group">
                <div class="zoom_gallery">
                    <ul class="gallery">
                    		<li>
                    		<?php 
                        	echo $this->Form->input('files.', array(
                        				'name' => "files[HinhAnh][]",
                        				'id'=>"file_upload",
                        				'type'=>'file',
                        				'multiple' => true
                        			));
											//echo $this->Form->input('files.', array('type' => 'file', 'multiple'));
                        ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </article>
    <footer></footer>
</article>
            
<!-- Loại hình BĐS -->
<article class="content-item">
    <header>
        <div class="header-wrapper">
            <div class="header-center header-bg-green">
                <div class="header-left header-bg-green">
                    <div class="header-left-triangle"></div>
                </div>
                <h1>Loại hình BĐS</h1>
                <div class="header-right"></div>
            </div>
            <div class="header-msg">
                <p class="text-success">Các mục có dấu (<span class="text-error">*</span>) là bắt buộc nhập</p>
            </div>
        </div>
    </header>
    <br>
    <article>
        <div class="form-horizontal pull-left">
            <!-- AdsType -->
            <div class="control-group">
                <label class="control-label"><span class="text-error">*</span> Loại giao dịch:</label>
                <div class="controls">
                		<?php 
	                		$option = array();
	                		foreach ($loaiTinlist as $loaiTin){
	                				$option[$loaiTin['LoaiTin']['TYPE_NEWS_CODE']] = $loaiTin['LoaiTin']['TYPE_NEWS_NAME'];
	                		}
	                		echo $this->Form->select ( '', $option, array(
	                			'id' => 'id_bdsnews_type_news_code', 
	                			'name' => 'data[BdsNews][TYPE_NEWS_CODE]',
	                			'class' => 'select-box'
	                		));
                		?>
                    <!-- Published -->
                    <label class="w180">
                		<?php 
                			echo $this->Form->input ( '', array (
											'name' => 'data[BdsNews][TIN_DANG_ID_PUBLISHED]',
											'id' => 'id_bdsnews_tin_dang_id_published',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
                		?>
                    Published
                    </label>
                    <!-- AdsExpirationDate -->
                    <?php 
	                		$option = array();
	                		foreach ($dayList as $day){
	                				$option[$day['DayList']['DAY_LIST_CODE']] = $day['DayList']['DAY_LIST_NAME'];
	                		}
	                		echo $this->Form->select ( '', $option, array(
	                			'id' => 'id_bdsnews_published_day_list_code', 
	                			'name' => 'data[BdsNews][PUBLISHED_DAY_LIST_CODE]'
	                		));
	                		echo $this->Form->input('', array(
	                			 'id' => 'id_bdsnews_published_bat_dau', 
	                			 'name' => 'data[BdsNews][PUBLISHED_BAT_DAU]',
	                			 'type' => 'date',
								    'label' => false,
	                			 'div' => false
								));
                		?>
                </div>
            </div>
            <!-- TypeGroup -->
            <div class="control-group">
                <label class="control-label"><span class="text-error">*</span> Nhóm BĐS:</label>
                <div class="controls">
                		<?php 
	                		$option = array();
	                		foreach ($nhomBdsList as $nhomBds){
	                				$option[$nhomBds['NhomBds']['GROUP_CODE']] = $nhomBds['NhomBds']['GROUP_NAME'];
	                		}
	                		echo $this->Form->select ( '', $option, array(
	                			'id' => 'id_bdsnews_group_code', 
	                			'name' => 'data[BdsNews][GROUP_CODE]',
	                			'class' => 'select-box'
	                		));
                		?>
                    <!-- AdsGoodDeal -->
                    <label class="w180">
                		<?php 
                			echo $this->Form->input ( '', array (
											'name' => 'data[BdsNews][BDS_GIA_RE]',
											'id' => 'id_bdsnews_bds_gia_re',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
                		?>BĐS giá rẻ</label>
                    <!-- AdsGoodDealExpirationDate -->
                    <?php 
	                		$option = array();
	                		foreach ($dayList as $day){
	                				$option[$day['DayList']['DAY_LIST_CODE']] = $day['DayList']['DAY_LIST_NAME'];
	                		}
	                		echo $this->Form->select ( '', $option, array(
	                			'id' => 'id_bdsnews_published_gia_re_day_list_code', 
	                			'name' => 'data[BdsNews][BDS_GIA_RE_DAY_LIST_CODE]'
	                		));
	                		echo $this->Form->input('', array(
	                			 'id' => 'id_bdsnews_bds_gia_re_bat_dau', 
	                			 'name' => 'data[BdsNews][BDS_GIA_RE_BAT_DAU]',
	                			 'type' => 'date',
								    'label' => false,
	                			 'div' => false
								));
                		?>
                    <!-- AdsGoodDealRequest -->
                </div>
            </div>
            <!-- Type -->
            <div class="control-group">
                <label class="control-label"><span class="text-error">*</span> Loại BĐS:</label>
                <div class="controls">
                		<?php 
	                		$option = array();
	                		foreach ($loaiBdsList as $loaiBds){
	                				$option[$loaiBds['LoaiBds']['LOAI_BDS_CODE']] = $loaiBds['LoaiBds']['LOAI_BDS_NAME'];
	                		}
	                		echo $this->Form->select ( '', $option, array(
	                			'id' => 'id_bdsnews_loai_bds_code', 
	                			'name' => 'data[BdsNews][LOAI_BDS_CODE]',
	                			'class' => 'select-box'
	                		));
                		?>
                        <!-- AdsVIP -->
                        <label class="w99">
                        	<?php 
		                			echo $this->Form->input ( '', array (
													'name' => 'data[BdsNews][BDS_DANG]',
													'id' => 'id_bdsnews_bds_dang',
													'type' => 'checkbox',
													'label' => false,
													'div' => false
										) );
		                		?>BĐS đăng</label>
                        <!-- Type VIP -->
                        <?php 
		                		$option = array();
		                		foreach ($tinVipList as $tinVip){
		                				$option[$tinVip['TinVip']['TIN_VIP_CODE']] = $tinVip['TinVip']['TIN_VIP_NAME'];
		                		}
		                		echo $this->Form->select ( '', $option, array(
		                			'id' => 'id_bdsnews_tin_vip_code', 
		                			'name' => 'data[BdsNews][TIN_VIP_CODE]',
		                			'class' => 'select-box'
		                		));
	                		?>
                		
                        <!-- AdsVIPExpirationDate -->
                        <?php 
		                		$option = array();
		                		foreach ($dayList as $day){
		                				$option[$day['DayList']['DAY_LIST_CODE']] = $day['DayList']['DAY_LIST_NAME'];
		                		}
		                		echo $this->Form->select ( '', $option, array(
		                			'id' => 'id_bdsnews_tin_vip_day_list_code', 
		                			'name' => 'data[BdsNews][TIN_VIP_DAY_LIST_CODE]'
		                		));
		                		echo $this->Form->input('', array(
		                			 'id' => 'id_bdsnews_bds_tin_vip_bat_dau', 
		                			 'name' => 'data[BdsNews][TIN_VIP_BAT_DAU]',
		                			 'type' => 'date',
									    'label' => false,
		                			 'div' => false
									));
	                		?>
                </div>
            </div>
<!--            TODO-->
<!--            <div class="control-group">-->
<!--                <label class="control-label">Số dư hiện tại:</label>-->
<!--                <div class="controls">-->
<!--                    <div style="width:150px;float:left;color:red;">-->
<!--                        634,080,000 VNĐ-->
<!--                    </div>-->
<!--                    <div style="width:auto;float:left;">-->
<!--                        Số tiền phải trả: <span style="color:red;" id="writePrice">0</span> VNĐ-->
<!--                    </div>-->
<!--                    <div style="clear:both;"></div>-->
<!--                </div>-->
<!--            </div>-->
            <!--  -->
            <br>
        </div>
        <div class="clearfix"></div>
    </article>
    <footer></footer>
</article>

            <!-- AddressInfo -->
            
<!-- Địa chỉ -->
<article class="content-item content-item-address">
    <header>
        <div class="header-wrapper">
            <div class="header-center header-bg-green">
                <div class="header-left header-bg-green">
                    <div class="header-left-triangle"></div>
                </div>
                <h1>Địa chỉ</h1>
                <div class="header-right"></div>
            </div>
            <div class="header-msg">
                <p class="text-success">Các mục có dấu (<span class="text-error">*</span>) là bắt buộc nhập</p>
            </div>
        </div>
    </header>
    <article>
        <div class="form-horizontal pull-left">
        		<br>
				<!-- DisplayForAddress -->
            <div class="control-group">
                <label class="control-label"><span class="text-error">*</span> Địa chỉ:</label>
                <div class="controls">
                		<strong id="DisplayForAddress">
							</strong>
                </div>
            </div>
            <!-- Province -->
            <div class="control-group">
                <label class="control-label"><span class="text-error">*</span> Tỉnh / Thành Phố:</label>
                <div class="controls">
                    <?php 
                		$option = array();
                		foreach ($provinceList as $province){
                				$option[$province['Province']['PROVINCE_CODE']] = $province['Province']['PROVINCE_NAME'];
                		}
                		echo $this->Form->select ( '', $option, array(
                			'id' => 'id_bdsnews_province_code', 
                			'name' => 'data[BdsNews][PROVINCE_CODE]',
                			'class' => 'select-box',
                			'onChange' => 'fnc_doGetDistricts();'
                		));
            		?>
                </div>
            </div>

            <!-- District -->
            <div class="control-group">
                <label class="control-label"><span class="text-error">*</span> Quận / Huyện:</label>
                <div class="controls">
                    	<?php 
	                		$option = array();
	                		if(isset($districtList)){
		                		foreach ($districtList as $district){
		                				$option[$district['District']['DISTRICT_CODE']] = $district['District']['DISTRICT_NAME'];
		                		}
	                		}
	                		echo $this->Form->select ( '', $option, array(
	                			'id' => 'id_bdsnews_district_code', 
	                			'name' => 'data[BdsNews][DISTRICT_CODE]',
	                			'class' => 'select-box',
	                			'onChange' => 'fnc_doGetWards();'
	                		));
                		?>
                </div>
            </div>

            <!-- gp-apartment -->

            <!-- Ward -->
            <div class="control-group">
                <label class="control-label">
                        <span class="text-error">*</span>
                    Phường / Xã:
                </label>
                <div class="controls">
                    <?php 
	                		$option = array();
	                		if(isset($wardList)){
		                		foreach ($wardList as $ward){
		                				$option[$ward['Ward']['WARD_CODE']] = $ward['Ward']['WARD_NAME'];
		                		}
	                		}
	                		echo $this->Form->select ( '', $option, array(
	                			'id' => 'id_bdsnews_ward_code', 
	                			'name' => 'data[BdsNews][WARD_CODE]',
	                			'class' => 'select-box',
	                			'onChange' => 'fnc_doGetStreets();'
	                		));
                		?>
                </div>
            </div>

            <!-- Street -->
            <div class="control-group">
                <label class="control-label">
                        <span class="text-error">*</span>
                    Đường / Phố:
                </label>
                <div class="controls">
                    <?php 
                		$option = array();
                		if(isset($streetList)){
	                		foreach ($streetList as $street){
	                				$option[$street['Street']['STREET_CODE']] = $street['Street']['STREET_NAME'];
	                		}
                		}
                		echo $this->Form->select ( '', $option, array(
                			'id' => 'id_bdsnews_street_code', 
                			'name' => 'data[BdsNews][STREET_CODE]',
                			'class' => 'select-box',
                			'onChange' => 'fnc_makeAddress();'
                		));
            		?>
                </div>
            </div>

            <!-- AddressNumber -->
            <div class="control-group">
                <label class="control-label">Số nhà / Số lô:</label>
                <div class="controls">
                		<?php 
                		echo $this->Form->input('', array(
                			 'id' => 'id_bdsnews_so_nha', 
                			 'name' => 'data[BdsNews][SO_NHA]',
                			 'type' => 'text',
							    'label' => false,
                			 'div' => false,
                			 'onChange' => 'fnc_makeAddress()'
							));
							?>
                     <label>
                     <?php 
                     	echo $this->Form->input ( '', array (
											'name' => 'data[BdsNews][PUBLISH_ADDRESS]',
											'id' => 'id_bdsnews_publish_address',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Cho phép hiện địa chỉ</label>
                </div>
            </div>
            
            <!-- gp-apartment -->

        </div>
        <div class="clearfix"></div>
    </article>
    <footer></footer>
</article>


            <!-- Legal Status, Direction, Location, Alley -->

<!-- Hướng & Vị trí -->
<article class="content-item">
    <header>
        <div class="header-wrapper">
            <div class="header-center header-bg-green">
                <div class="header-left header-bg-green">
                    <div class="header-left-triangle"></div>
                </div>
                <h1>Hướng &amp; Vị trí</h1>
                <div class="header-right"></div>
            </div>
            <div class="header-msg">
                <p class="text-success">Các mục có dấu (<span class="text-error">*</span>) là bắt buộc nhập</p>
            </div>
        </div>
    </header>
    <article>
        <div class="form-horizontal pull-left">
        		<br>
            <!-- LegalStatus -->
            <div class="control-group">
                <label class="control-label">Tình trạng pháp lý:</label>
                <div class="controls">
                		<?php 
	                		$option = array();
	                		foreach ($phapLyList as $phapLy){
	                				$option[$phapLy['PhapLy']['PHAP_LY_CODE']] = $phapLy['PhapLy']['PHAP_LY_NAME'];
	                		}
	                		echo $this->Form->select ( '', $option, array(
	                			'id' => 'id_bdsnews_phap_ly_code', 
	                			'name' => 'data[BdsNews][PHAP_LY_CODE]',
	                			'class' => 'select-box'
	                		));
                		?>
                </div>
            </div>
            <!-- Direction -->
            <div class="control-group">
                <label class="control-label">Hướng của BĐS:</label>
                <div class="controls">
                		<?php 
	                		$option = array();
	                		foreach ($huongList as $huong){
	                				$option[$huong['Huong']['HUONG_CODE']] = $huong['Huong']['HUONG_NAME'];
	                		}
	                		echo $this->Form->select ( '', $option, array(
	                			'id' => 'id_bdsnews_huong_code', 
	                			'name' => 'data[BdsNews][HUONG_CODE]',
	                			'class' => 'select-box'
	                		));
                		?>
                </div>
            </div>
            <!-- Location -->
            <div class="control-group">
                <label class="control-label"><span class="text-error">*</span> Vị trí BĐS:</label>
                <div class="controls">
                		<?php 
	                		$option = array();
	                		foreach ($viTriList as $viTri){
	                				$option[$viTri['ViTri']['VI_TRI_CODE']] = $viTri['ViTri']['VI_TRI_NAME'];
	                		}
	                		echo $this->Form->select ( '', $option, array(
	                			'id' => 'id_bdsnews_vi_tri_code', 
	                			'name' => 'data[BdsNews][VI_TRI_CODE]',
	                			'class' => 'select-box'
	                		));
                		?>
                </div>
            </div>
            <!-- StreetWidth -->
            <div class="control-group" id="divStreetWidth" style="display:none;">
                <label class="control-label">Độ rộng đường trước nhà:</label>
                <div class="controls">
                    
                </div>
            </div>
            <!-- DistanceToStreet -->
            <div class="control-group form-horizontal-268" id="divDistanceToStreet" style="">
                <label class="control-label">Khoảng cách từ BĐS ra đường chính:</label>
                <div class="controls">
                    <?php 
                		echo $this->Form->input('', array(
                			 'id' => 'id_bdsnews_khoan_cach_duong_chinh', 
                			 'name' => 'data[BdsNews][KHOAN_CACH_DUONG_CHINH]',
                			 'type' => 'text',
							    'label' => false,
                			 'div' => false,
                			 'class' => 'text number-box-medium'
							));
							?> m
                </div>
            </div>
            <!-- AlleyTurns -->
            <div class="control-group form-horizontal-268" id="divAlleyTurns" style="">
                <label class="control-label">Số lần rẽ (quẹo) từ đường chính vào đến BĐS:</label>
                <div class="controls">
                    <?php 
                		echo $this->Form->input('', array(
                			 'id' => 'id_bdsnews_so_luong_hem', 
                			 'name' => 'data[BdsNews][SO_LUONG_HEM]',
                			 'type' => 'text',
							    'label' => false,
                			 'div' => false,
                			 'class' => 'text number-box-medium'
							));
							?>
                </div>
            </div>
            <div class="control-group" id="divAlleyWidth10" style="display: block;">
                <strong>Nhập độ rộng của các hẻm từ đường chính vào đến BĐS:</strong>
            </div>
            <!-- AlleyWidth1 -->
            <div class="control-group form-horizontal-268" id="divAlleyWidth1" style="display: block;">
                <label class="control-label">Lần rẽ thứ nhất (Hẻm đầu tiên) rộng:</label>
                <div class="controls">
                    <?php 
                		echo $this->Form->input('', array(
                			 'id' => 'id_bdsnews_dien_tich_hem_dau', 
                			 'name' => 'data[BdsNews][DIEN_TICH_HEM_DAU]',
                			 'type' => 'text',
							    'label' => false,
                			 'div' => false,
                			 'class' => 'text number-box-medium'
							));
							?>
                </div>
            </div>
            <!-- AlleyWidth2 -->
            <div class="control-group form-horizontal-268" id="divAlleyWidth2" style="display:none;">
                <label class="control-label">Lần rẽ thứ 2:</label>
                <div class="controls">
                    <input class="text number-box-medium" id="AlleyWidth2" name="AlleyWidth2" type="text" value=""> m
                    
                </div>
            </div>
            <!-- AlleyWidth3 -->
            <div class="control-group form-horizontal-268" id="divAlleyWidth3" style="display:none;">
                <label class="control-label">Lần rẽ thứ 3:</label>
                <div class="controls">
                    <input class="text number-box-medium" id="AlleyWidth3" name="AlleyWidth3" type="text" value=""> m
                    
                </div>
            </div>
            <!-- AlleyWidth4 -->
            <div class="control-group form-horizontal-268" id="divAlleyWidth4" style="display:none;">
                <label class="control-label">Lần rẽ thứ 4:</label>
                <div class="controls">
                    <input class="text number-box-medium" id="AlleyWidth4" name="AlleyWidth4" type="text" value=""> m
                    
                </div>
            </div>
            <!-- AlleyWidth5 -->
            <div class="control-group form-horizontal-268" id="divAlleyWidth5" style="display:none;">
                <label class="control-label">Lần rẽ thứ 5:</label>
                <div class="controls">
                    <input class="text number-box-medium" id="AlleyWidth5" name="AlleyWidth5" type="text" value=""> m
                    
                </div>
            </div>
            <!-- AlleyWidth6 -->
            <div class="control-group form-horizontal-268" id="divAlleyWidth6" style="display:none;">
                <label class="control-label">Lần rẽ thứ 6:</label>
                <div class="controls">
                    <input class="text number-box-medium" id="AlleyWidth6" name="AlleyWidth6" type="text" value=""> m
                    
                </div>
            </div>
        </div>
        <div class="form-horizontal pull-left">
        </div>
        <div class="clearfix"></div>
    </article>
    <footer></footer>
</article>
            <!-- AreaTotal, AreaLegal, AreaResidential -->

<!-- Diện tích -->
<article class="content-item">
    <header>
        <div class="header-wrapper">
            <div class="header-center header-bg-green">
                <div class="header-left header-bg-green">
                    <div class="header-left-triangle"></div>
                </div>
                <h1>Diện tích</h1>
                <div class="header-right"></div>
            </div>
            <div class="header-msg">
                <p class="text-success">Các mục có dấu (<span class="text-error">*</span>) là bắt buộc nhập</p>
            </div>
        </div>
    </header>
    <article>
        <div class="form-horizontal pull-left">
        		<br>
            <!-- AreaTotal -->
            <div class="control-group">
                <label class="control-label"><span class="text-error">*</span> Diện tích khuôn viên đất:</label>
                <div class="controls">
							<?php 
								echo $this->Form->input('', array(
                			 'id' => 'id_bdsnews_dien_tich', 
                			 'name' => 'data[BdsNews][DIEN_TICH]',
                			 'type' => 'text',
							    'label' => false,
                			 'div' => false,
                			 'class' => 'text number-box-long',
								 'placeholder' => 'diện tích'
							));
							?> m<sup>2</sup>&nbsp;
                    <?php 
								echo $this->Form->input('', array(
                			 'id' => 'id_bdsnews_dien_tich_rong', 
                			 'name' => 'data[BdsNews][DIEN_TICH_RONG]',
                			 'type' => 'text',
							    'label' => false,
                			 'div' => false,
                			 'class' => 'text number-box-long',
								 'placeholder' => 'chiều ngang'
							));
							?>
                    &nbsp;x&nbsp;
                    <?php 
								echo $this->Form->input('', array(
                			 'id' => 'id_bdsnews_dien_tich_dai', 
                			 'name' => 'data[BdsNews][DIEN_TICH_DAI]',
                			 'type' => 'text',
							    'label' => false,
                			 'div' => false,
                			 'class' => 'text number-box-long',
								 'placeholder' => 'chiều dài'
							));
							?> m
                    &nbsp;--&gt;&nbsp;
                    <?php 
								echo $this->Form->input('', array(
                			 'id' => 'id_bdsnews_dien_tich_hau', 
                			 'name' => 'data[BdsNews][DIEN_TICH_HAU]',
                			 'type' => 'text',
							    'label' => false,
                			 'div' => false,
                			 'class' => 'text number-box-long',
								 'placeholder' => 'mặt hậu'
							));
							?> m
                </div>
            </div>
            <!-- AreaLegal -->
            <div class="control-group">
                <label class="control-label"><span class="text-error">*</span> Diện tích phù hợp quy hoạch:</label>
                <div class="controls">
							<?php 
								echo $this->Form->input('', array(
                			 'id' => 'id_bdsnews_dien_tich_qh', 
                			 'name' => 'data[BdsNews][DIEN_TICH_QH]',
                			 'type' => 'text',
							    'label' => false,
                			 'div' => false,
                			 'class' => 'text number-box-long',
								 'placeholder' => 'diện tích'
							));
							?> m<sup>2</sup>&nbsp;
                    <?php 
								echo $this->Form->input('', array(
                			 'id' => 'id_bdsnews_dien_tich_qh_rong', 
                			 'name' => 'data[BdsNews][DIEN_TICH_QH_RONG]',
                			 'type' => 'text',
							    'label' => false,
                			 'div' => false,
                			 'class' => 'text number-box-long',
								 'placeholder' => 'chiều ngang'
							));
							?>
                    &nbsp;x&nbsp;
                    <?php 
								echo $this->Form->input('', array(
                			 'id' => 'id_bdsnews_dien_tich_qh_dai', 
                			 'name' => 'data[BdsNews][DIEN_TICH_QH_DAI]',
                			 'type' => 'text',
							    'label' => false,
                			 'div' => false,
                			 'class' => 'text number-box-long',
								 'placeholder' => 'chiều dài'
							));
							?> m
                    &nbsp;--&gt;&nbsp;
                    <?php 
								echo $this->Form->input('', array(
                			 'id' => 'id_bdsnews_dien_tich_qh_hau', 
                			 'name' => 'data[BdsNews][DIEN_TICH_QH_HAU]',
                			 'type' => 'text',
							    'label' => false,
                			 'div' => false,
                			 'class' => 'text number-box-long',
								 'placeholder' => 'mặt hậu'
							));
							?> m
                </div>
            </div>
            <!-- AreaIlegalRecognized -->
            <div class="control-group form-horizontal-402">
                <label class="control-label">Diện tích đất vi phạm lộ giới (quy hoạch) nhưng được công nhận:</label>
                <div class="controls">
                    <?php 
								echo $this->Form->input('', array(
                			 'id' => 'id_bdsnews_dien_tich_qh_cong_nhan', 
                			 'name' => 'data[BdsNews][DIEN_TICH_QH_CONG_NHAN]',
                			 'type' => 'text',
							    'label' => false,
                			 'div' => false,
                			 'class' => 'text number-box-long'
							));
							?> m<sup>2</sup>
                    
                </div>
            </div>
        </div>
                <div class="clearfix"></div>
    </article>
    <footer></footer>
</article>
            <!-- Construction -->
            
    <!-- Thông tin xây dựng -->
    <article class="content-item" id="tblConstruction">
        <header>
            <div class="header-wrapper">
                <div class="header-center header-bg-green">
                    <div class="header-left header-bg-green">
                        <div class="header-left-triangle"></div>
                    </div>
                    <h1>Thông tin xây dựng</h1>
                    <div class="header-right"></div>
                </div>
                <div class="header-msg">
                    <p class="text-success">Các mục có dấu (<span class="text-error">*</span>) là bắt buộc nhập</p>
                </div>
            </div>
        </header>
        <article>
            <div class="form-horizontal pull-left">
            	<br>
                <!-- AreaConstruction -->
                <div class="control-group">
                    <label class="control-label">Diện tích đất xây dựng:</label>
                    <div class="controls">
                        <?php 
									echo $this->Form->input('', array(
										 'id' => 'id_bdsnews_dien_tich_xay', 
										 'name' => 'data[BdsNews][DIEN_TICH_XAY]',
										 'type' => 'text',
										 'label' => false,
										 'div' => false,
										 'class' => 'text number-box-ext'
								));?> m<sup>2</sup>
                    </div>
                </div>
                <!-- AreaConstructionFloor -->
                <div class="control-group">
                    <label class="control-label">Dện tích sàn xây dựng:</label>
                    <div class="controls">
                        <?php 
									echo $this->Form->input('', array(
										 'id' => 'id_bdsnews_dien_tich_san', 
										 'name' => 'data[BdsNews][DIEN_TICH_SAN]',
										 'type' => 'text',
										 'label' => false,
										 'div' => false,
										 'class' => 'text number-box-ext'
								));?> m<sup>2</sup>
                    </div>
                </div>
                
                <!-- FloorsCount -->
                <div class="control-group">
                    <label class="control-label">Số tầng:</label>
                    <div class="controls">
                    <?php 
								$option = array();
								foreach ($soTangList as $soTang){
										$option[$soTang['SoTang']['SO_TANG_CODE']] = $soTang['SoTang']['SO_TANG_NAME'];
								}
								echo $this->Form->select ( '', $option, array(
									'id' => 'id_bdsnews_so_tang_code', 
									'name' => 'data[BdsNews][SO_TANG_CODE]',
									'class' => 'select-box'
								));
							?>
                    </div>
                </div>
                <!-- Floors -->
                <div class="control-group" style="display: none;">
                    <label class="control-label">Số lầu chính xác:</label>
                    <div class="controls">
                        <input class="text number-box-ext" id="Floors" name="Floors" type="text" value="0">
                    </div>
                </div>
                <!-- Bedrooms -->
                <div class="control-group">
                    <label class="control-label">Số phòng ngủ:</label>
                    <div class="controls">
                    		<?php 
									echo $this->Form->input('', array(
										 'id' => 'id_bdsnews_so_phong_ngu', 
										 'name' => 'data[BdsNews][SO_PHONG_NGU]',
										 'type' => 'text',
										 'label' => false,
										 'div' => false,
										 'class' => 'text number-box-ext'
									));
								?>	
                    </div>
                </div>
                <!-- Bathrooms -->
                <div class="control-group">
                    <label class="control-label">Số phòng vệ sinh:</label>
                    <div class="controls">
                    		<?php 
									echo $this->Form->input('', array(
										 'id' => 'id_bdsnews_so_phong_tolet', 
										 'name' => 'data[BdsNews][SO_PHONG_TOLET]',
										 'type' => 'text',
										 'label' => false,
										 'div' => false,
										 'class' => 'text number-box-ext'
									));
								?>	
                    </div>
                </div>
                <!-- TypeConstruction -->
                <div class="control-group">
                    <label class="control-label">Loại công trình xây dựng:</label>
                    <div class="controls">
	                    <?php 
									$option = array();
									foreach ($loaiCongTrinhList as $loaiCongTrinh){
											$option[$loaiCongTrinh['LoaiCongTrinh']['LOAI_CONG_TRINH_CODE']] = $loaiCongTrinh['LoaiCongTrinh']['LOAI_CONG_TRINH_NAME'];
									}
									echo $this->Form->select ( '', $option, array(
										'id' => 'id_bdsnews_loai_cong_trinh_code', 
										'name' => 'data[BdsNews][LOAI_CONG_TRINH_CODE]',
										'class' => 'select-box'
									));
								?>
                    </div>
                </div>
                <!-- Interior -->
                <div class="control-group">
                    <label class="control-label">Chọn mức độ đầu tư xây dựng:</label>
                    <div class="controls">
                    		<?php 
									$option = array();
									foreach ($mucXayList as $mucXay){
											$option[$mucXay['MucXay']['MUC_XAY_CODE']] = $mucXay['MucXay']['MUC_XAY_NAME'];
									}
									echo $this->Form->select ( '', $option, array(
										'id' => 'id_bdsnews_muc_xay_code', 
										'name' => 'data[BdsNews][MUC_XAY_CODE]',
										'class' => 'select-box'
									));
								?>
                    </div>
                </div>
                <!-- RemainingValue -->
                <div class="control-group">
                    <label class="control-label">Chất lượng nhà còn lại:</label>
                    <div class="controls">
                    		<?php 
									echo $this->Form->input('', array(
										 'id' => 'id_bdsnews_chat_luong_nha', 
										 'name' => 'data[BdsNews][CHAT_LUONG_NHA]',
										 'type' => 'text',
										 'label' => false,
										 'div' => false,
										 'class' => 'text number-box-ext'
									));
								?> %
                    </div>
                </div>
            </div>
            <div class="form-horizontal pull-left">
            	<br>
                <ul style="padding-left:40px;">
                    <li><label>
						 <?php 
							echo $this->Form->input ( '', array (
										'name' => 'data[BdsNews][CO_HAM]',
										'id' => 'id_bdsnews_co_ham',
										'type' => 'checkbox',
										'label' => false,
										'div' => false
							) );
						?>Có tầng hầm</label></li>
                    <li><label>
                    <?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[BdsNews][CO_LUNG]',
											'id' => 'id_bdsnews_co_lung',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Có lửng</label></li>
                    <li><label>
                    	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[BdsNews][CO_SAN_THUONG]',
											'id' => 'id_bdsnews_co_san_thuong',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Có sân thượng</label></li>
                    <li><label>
                    <?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[BdsNews][CO_GARA_OTO]',
											'id' => 'id_bdsnews_co_gara_oto',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Có gara ô tô</label></li>
                    <li><label>
                    <?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[BdsNews][CO_THANG_MAY]',
											'id' => 'id_bdsnews_co_thang_may',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Có thang máy</label></li>
                    <li><label>
                    <?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[BdsNews][CO_HO_BOI]',
											'id' => 'id_bdsnews_co_ho_boi',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Có hồ bơi</label></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </article>
        <footer></footer>
    </article>


            <!-- Advantage & Disadvantage -->

<!-- Đặc điểm tốt - Đặc điểm xấu -->
<article class="content-item">
    <header>
        <div class="header-wrapper pull-right">
            <div class="header-center header-bg-green">
                <div class="header-left header-bg-green">
                    <div class="header-left-triangle"></div>
                </div>
                <h1>Đặc điểm xấu</h1>
                <div class="header-right"></div>
            </div>
        </div>
        <div class="header-wrapper">
            <div class="header-center header-bg-green">
                <div class="header-left header-bg-green">
                    <div class="header-left-triangle"></div>
                </div>
                <h1>Đặc điểm tốt</h1>
                <div class="header-right"></div>
            </div>
        </div>
    </header>
    <article>
    		<br>
        <!-- Advantages -->
        <div class="p50 pull-left">
            <ul>
                <li>
                	<label>
						 <?php 
							echo $this->Form->input ( '', array (
										'name' => 'data[DiemTot][HAI_MAT_DUONG]',
										'id' => 'id_diem_tot_hai_mat_duong',
										'type' => 'checkbox',
										'label' => false,
										'div' => false
							) );
						?>Có 2 mặt đường chính (+15%)
						</label>
                </li>
                <li>
                	<label>
                	<?php 
							echo $this->Form->input ( '', array (
										'name' => 'data[DiemTot][HEM_BEN_HONG]',
										'id' => 'id_diem_tot_hem_ben_hong',
										'type' => 'checkbox',
										'label' => false,
										'div' => false
							) );
						?>Căn góc, có hẻm bên hông (+7%)
						</label>
                </li>
                <li>
                	<label>
                		<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[DiemTot][HEM_SAU_NHA]',
											'id' => 'id_diem_tot_hem_sau_nha',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Có hẻm sau nhà (+5%)
							</label>
                </li>
                <li>
	                	<label>
	                	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[DiemTot][GAN_CHO_SIEU_THI]',
											'id' => 'id_diem_tot_gan_cho_sieu_thi',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Gần chợ, siêu thị (&lt;500m) (+2%)
                    </label>

                </li>
                <li>
                		<label>
	                	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[DiemTot][GAN_CONG_VIEN_MALL]',
											'id' => 'id_diem_tot_gan_cong_vien_mall',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Gần công viên, trung tâm giải trí (&lt;500m) (+2%)
                    </label>

                </li>
                <li>
                		<label>
	                	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[DiemTot][CONG_BAO_VE]',
											'id' => 'id_diem_tot_cong_bao_ve',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Khu dân cư cao cấp có cổng bảo vệ (+5%)
                    </label>

                </li>
                <li>
                		<label>
	                	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[DiemTot][VI_TRI_DEP]',
											'id' => 'id_diem_tot_vi_tri_dep',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Vị trí đẹp nhất trong đoạn đường (+5%)
                    </label>

                </li>
                <li>
                		<label>
	                	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[DiemTot][TIEN_MO_QUAN]',
											'id' => 'id_diem_tot_tien_mo_quan',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Tiện làm quán cafe, nhà hàng, khách sạn (+2%)
                    </label>

                </li>
                <li>
                		<label>
	                	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[DiemTot][HEM_THONG]',
											'id' => 'id_diem_tot_hem_thong',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Hẻm thông ra đường khác đẹp hơn. (+5%)
                    </label>

                </li>
            </ul>
            <br>
            <div class="form-inline">
                <!-- OtherAdvantagesDesc -->
                <div class="control-group">
                    <label class="control-label">Đặc điểm tốt khác làm tăng giá trị của BĐS:</label>
                    <div class="controls">
                    		<?php 
									echo $this->Form->input('', array(
										 'id' => 'id_diem_tot_diem_tot_khac', 
										 'name' => 'data[DiemTot][DIEM_TOT_KHAC]',
										 'type' => 'text',
										 'label' => false,
										 'div' => false,
										 'class' => 'text text-box-medium'
									));
								?>	
                    </div>
                </div>
                <!-- OtherAdvantages -->
                <div class="control-group">
                    <label class="control-label">Nhập số phần trăm tăng thêm:</label>
                    <div class="controls">
                    		<?php 
									echo $this->Form->input('', array(
										 'id' => 'id_diem_tot_phan_tram_tang', 
										 'name' => 'data[DiemTot][PHAN_TRAM_TANG]',
										 'type' => 'text',
										 'label' => false,
										 'div' => false,
										 'class' => 'text number-box'
									));
								?>	%
                    </div>
                </div>
            </div>
        </div>
        <!-- DisAdvantages -->
        <div class="p50 pull-right">
            <ul style="margin-left:10px;">

                <li>
                		<label>
	                	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[DiemXau][DUONG_DAM_VAO_NHA]',
											'id' => 'id_diem_xau_duong_dam_vao_nha',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Đường, hẻm đâm thẳng vào nhà (-20%)
                    </label>

                </li>
                <li>
                		<label>
	                	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[DiemXau][GAN_CHUA_NHA_THO]',
											'id' => 'id_diem_xau_gan_chua_nha_tho',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Đối diện hoặc gần sát chùa, nhà thờ (-15%)
                    </label>

                </li>
                <li>
                		<label>
	                	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[DiemXau][GAN_NHA_TANG_LE]',
											'id' => 'id_diem_xau_gan_nha_tang_le',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Đối diện hoặc gần sát nhà tang lễ, nhà xác (-20%)
                    </label>

                </li>
                <li>
                		<label>
	                	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[DiemXau][CHAN_CAU_CAO_THE]',
											'id' => 'id_diem_xau_chan_cau_cao_the',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Dưới chân cầu hoặc dưới đường dây điện cao thế (-30%)
                    </label>

                </li>
                <li>
                		<label>
	                	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[DiemXau][CONG_TRUOC_NHA]',
											'id' => 'id_diem_xau_cong_truoc_nha',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Có cống trước nhà (-5%)
                    </label>
                </li>
                <li>
                		<label>
	                	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[DiemXau][TRU_DIEN_TRUOC_NHA]',
											'id' => 'id_diem_xau_tru_dien_truoc_nha',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Có trụ điện trước nhà (-5%)
                    </label>
                </li>
                <li>
                		<label>
	                	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[DiemXau][CAY_LON_TRUOC_NHA]',
											'id' => 'id_diem_xau_cay_lon_truoc_nha',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Có cây lớn trước nhà (-5%)
                    </label>

                </li>
                <li>
                		<label>
	                	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[DiemXau][KHONG_THE_XAY_MOI]',
											'id' => 'id_diem_xau_khong_the_xay_moi',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Không cho xây hoặc không thể xây mới (-10%)
                    </label>
                </li>
                <li>
                		<label>
	                	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[DiemXau][QUY_HOACH_TREO]',
											'id' => 'id_diem_xau_quy_hoach_treo',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Bị quy hoạch treo (-30%)
                    </label>
                </li>
            </ul>
            <br>
            <div class="form-inline" style="margin-left:10px;">
                <!-- OtherDisAdvantagesDesc -->
                <div class="control-group">
                    <label class="control-label">Đặc điểm xấu khác làm giảm giá trị BĐS:</label>
                    <div class="controls">
                        <?php 
									echo $this->Form->input('', array(
										 'id' => 'id_diem_xau_diem_xau_khac', 
										 'name' => 'data[DiemXau][DIEM_XAU_KHAC]',
										 'type' => 'text',
										 'label' => false,
										 'div' => false,
										 'class' => 'text text-box-medium'
									));
								?>	
                    </div>
                </div>
                <!-- OtherDisAdvantages -->
                <div class="control-group">
                    <label class="control-label">Nhập số phần trăm giảm đi:</label>
                    <div class="controls">
                        <?php 
									echo $this->Form->input('', array(
										 'id' => 'id_diem_xau_phan_tram_giam', 
										 'name' => 'data[DiemXau][PHAN_TRAM_GIAM]',
										 'type' => 'text',
										 'label' => false,
										 'div' => false,
										 'class' => 'text number-box'
									));
								?>	%
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="vr"></div>
    </article>
    <footer></footer>
</article>
            <!-- ContactInfo -->
            <!-- Thông tin liên hệ -->
<article class="content-item">
    <header>
        <div class="header-wrapper">
            <div class="header-center header-bg-green">
                <div class="header-left header-bg-green">
                    <div class="header-left-triangle"></div>
                </div>
                <h1>Thông tin liên hệ</h1>
                <div class="header-right"></div>
            </div>
            <div class="header-msg">
                <p class="text-success">Các mục có dấu (<span class="text-error">*</span>) là bắt buộc nhập</p>
            </div>
        </div>
    </header>
    <article>
    <br>
        <div class="form-horizontal pull-left">
            <!-- ContactPhone -->
            <div class="control-group">
                <label class="control-label"><span class="text-error">*</span> Nhập tên + điện thoại:</label>
                <div class="controls">
                		<?php 
								echo $this->Form->input('', array(
									 'id' => 'id_bdsnews_ten_dien_thoai', 
									 'name' => 'data[BdsNews][TEN_DIEN_THOAI]',
									 'type' => 'text',
									 'label' => false,
									 'div' => false,
									 'class' => 'text text-box-medium'
								));
							?>                       
						<label>
						 <?php 
							echo $this->Form->input ( '', array (
										'id' => 'id_bdsnews_cho_hien_ten_dien_thoai',
										'name' => 'data[BdsNews][CHO_HIEN_TEN_DIEN_THOAI]',
										'type' => 'checkbox',
										'label' => false,
										'div' => false
							) );
						?>Cho phép hiện Liên hệ</label>
                </div>
            </div>
            <!-- ContactName -->
            <div class="control-group">
                <label class="control-label">Nhập Tên liên hệ:</label>
                <div class="controls">
                		<?php 
								echo $this->Form->input('', array(
									 'id' => 'id_bdsnews_ten_lien_he', 
									 'name' => 'data[BdsNews][TEN_LIEN_HE]',
									 'type' => 'text',
									 'label' => false,
									 'div' => false,
									 'class' => 'text text-box-medium'
								));
							?>
                </div>
            </div>
            <!-- ContactAddress -->
            <div class="control-group">
                <label class="control-label">Nhập Địa chỉ liên hệ:</label>
                <div class="controls">
                    <?php 
								echo $this->Form->input('', array(
									 'id' => 'id_bdsnews_dia_chi_lien_he', 
									 'name' => 'data[BdsNews][DIA_CHI_LIEN_HE]',
									 'type' => 'text',
									 'label' => false,
									 'div' => false,
									 'class' => 'text text-box-medium'
								));
							?>
                </div>
            </div>
            <!-- ContactEmail -->
            <div class="control-group">
                <label class="control-label">Nhập Email liên hệ:</label>
                <div class="controls">
                    <?php 
								echo $this->Form->input('', array(
									 'id' => 'id_bdsnews_email_lien_he', 
									 'name' => 'data[BdsNews][EMAIL_LIEN_HE]',
									 'type' => 'text',
									 'label' => false,
									 'div' => false,
									 'class' => 'text text-box-medium'
								));
							?>
                </div>
            </div>
            <!--  -->
            <div class="control-group">
                <div class="controls">
                    <label>
							 <?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[BdsNews][TIN_CHINH_CHU]',
											'id' => 'id_bdsnews_tin_chinh_chu',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Tin chính chủ</label>
                    <label>
                    <?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[BdsNews][MIEN_TRUNG_GIAN]',
											'id' => 'id_bdsnews_mien_trung_gian',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Miễn trung gian</label>
                    <label>
                    	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[BdsNews][BDS_PHAT_MAI]',
											'id' => 'id_bdsnews_bds_phat_mai',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>BĐS phát mãi</label>
                </div>
            </div>
            <!-- IsAuctionContact -->
                <div class="control-group">
                    <label class="control-label">Liên hệ độc quyền:</label>
                    <div class="controls">
                    	<?php 
								echo $this->Form->input('', array(
									 'id' => 'id_bdsnews_lien_he_doc_quyen', 
									 'name' => 'data[BdsNews][LIEN_HE_DOC_QUYEN]',
									 'type' => 'text',
									 'label' => false,
									 'div' => false,
									 'class' => 'text text-box-medium'
								));
							?>
                    </div>
                </div>
        </div>
        <div class="clearfix"></div>
    </article>
    <footer></footer>
</article>

            <!-- PriceProposed -->
            
<!-- Giá rao -->
<article class="content-item">
    <header>
        <div class="header-wrapper">
            <div class="header-center header-bg-green">
                <div class="header-left header-bg-green">
                    <div class="header-left-triangle"></div>
                </div>
                <h1>Giá rao</h1>
                <div class="header-right"></div>
            </div>
            <div class="header-msg">
                <p class="text-success">Các mục có dấu (<span class="text-error">*</span>) là bắt buộc nhập</p>
            </div>
        </div>
    </header>
    <article>
    <br>
        <div class="form-horizontal pull-left">

            <!-- PriceEstimatedByStaff -->
            <div class="control-group" style="display:none;">
                <label class="control-label"><span class="text-error">*</span> Định giá bởi nhân viên:</label>
                <div class="controls">
                    <input class="text number-box" id="PriceEstimatedByStaff" name="PriceEstimatedByStaff" type="text" value="">
                    
                    Quảng cáo BĐS giá rẻ cho những BĐS chưa định giá được
                </div>
            </div>
            <!-- PriceNegotiable -->
            <div class="control-group">
                <label class="control-label"></label>
                <div class="controls">
                    <label>
                    	<?php 
								echo $this->Form->input ( '', array (
											'name' => 'data[BdsNews][THUONG_LUONG]',
											'id' => 'id_bdsnews_thuong_luong',
											'type' => 'checkbox',
											'label' => false,
											'div' => false
								) );
							?>Giá thương lượng</label>
                </div>
            </div>
            <!-- PriceProposed -->
            <div class="control-group">
                <label class="control-label"><span class="text-error">*</span> Giá rao:</label>
                <div class="controls">
                		<?php 
								echo $this->Form->input('', array(
									 'id' => 'id_bdsnews_gia_rao', 
									 'name' => 'data[BdsNews][GIA_RAO]',
									 'type' => 'text',
									 'label' => false,
									 'div' => false,
									 'class' => 'text number-box'
								));
								
								$option = array();
								foreach ($loaiTienList as $loaiTien){
										$option[$loaiTien['LoaiTien']['LOAI_TIEN_CODE']] = $loaiTien['LoaiTien']['LOAI_TIEN_NAME'];
								}
								echo $this->Form->select ( '', $option, array(
									'id' => 'id_bdsnews_loai_tien_code', 
									'name' => 'data[BdsNews][LOAI_TIEN_CODE]',
									'class' => 'select-box'
								));
								
								$option = array();
								foreach ($donViDoList as $donViDo){
										$option[$donViDo['DonViDo']['DON_VI_DO_CODE']] = $donViDo['DonViDo']['DON_VI_DO_NAME'];
								}
								echo $this->Form->select ( '', $option, array(
									'id' => 'id_bdsnews_don_vi_do_code', 
									'name' => 'data[BdsNews][DON_VI_DO_CODE]',
									'class' => 'select-box'
								));
							?>
							
                    <button value="submit.Estimate" name="submit.Estimate" type="button" class="primaryAction">Định giá</button>

                    <div>
                        Giá rao bằng chữ:
                        <span id="PriceProposedInWords" style="font-weight:bold;color:#3F48D5;"><?php echo isset($docSoTien)? $docSoTien : "";?></span>
                    </div>

                    <!-- ESTIMATION -->
<!--                    <div>-->
<!--                         Định giá OK -->
<!--                        <div id="EstimateOK" style="">-->
<!--                            <div id="FlagCssClass" class="deal-good">-->
<!--                                Định giá BĐS:-->
<!--                                <strong id="PriceEstimatedStr">3.285 Tỷ</strong>-->
<!--                                <span id="PriceChangedInPercent">(+26.34%)</span>-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                Định giá theo BGĐ:-->
<!--                                <strong id="PriceEstimatedMarketStr">1.531 Tỷ</strong>-->
<!--                                <span id="PriceEstimatedMarketChangedInPercent">(-41.13%)</span>-->
<!--                            </div>-->
<!--                            <div class="control-group" id="PriceEstimationMsg">T1 - Định giá từ 11 căn Hẻm nằm trên các đường có giá trị tương đương.</div>-->
<!--                                -->
<!--                                <div class="control-group">-->
<!--                                    <a class="button" href="http://seabank.dulieunhadat.vn" target="_blank">SeABank Dashboard</a>-->
<!--                                    <a class="button" href="http://www.newai.vn/vi/giai-phap/nhan-dang-chu-in/" target="_blank">Nhận Dạng Chữ In</a>-->
<!--                                    <a class="button" href="http://www.newai.vn/vi/giai-phap/bat-dong-san/" target="_blank">Rút Tin BĐS Tự Động</a>-->
<!--                                </div>-->
<!--                                -->
<!--                            <div class="debug-panel">-->
<!--    <div class="ui-growl ui-widget">-->
<!--        <div class="ui-growl-item-container ui-state-highlight ui-corner-all ui-shadow">-->
<!--            <div class="ui-growl-item">-->
<!--                <div style="display: none;" class="ui-growl-icon-close ui-icon ui-icon-closethick"></div>-->
<!--                <span class="ui-growl-image ui-growl-image-info"></span>-->
<!--                <div class="ui-growl-message">-->
<!--                    <div class="gp-house" style="">-->
<!--                        <div id="DebugAreaLegal">DT HQH: 38.5m<sup>2</sup> 3.5 x 11 Hậu 3.5</div>-->
<!--                        <div id="DebugAreaStandard">DT chuẩn: 38.5m<sup>2</sup></div>-->
<!--                        <div id="DebugAreaExcess">DT vượt chuẩn: N/A</div>-->
<!--                        <div>--</div>-->
<!--                        <div id="DebugAreaIlegalRecognized"> </div>-->
<!--                        <div id="DebugAreaIlegalNotRecognized"> </div>-->
<!--                        <div id="DebugAreaWidth">DT ngang: 38.5m<sup>2</sup></div>-->
<!--                        <div>--</div>-->
<!--                        <div id="DebugWidthCoeff">HS ngang: 1</div>-->
<!--                        <div id="DebugLengthCoeff">HS dài: 0.99</div>-->
<!--                        <div id="DebugAlleyCoeff">HS hẻm: 0.6</div>-->
<!--                        <div id="DebugAlleyUnitPrice">ĐG các cấp hẻm: 0.68</div>-->
<!--                        <div>--</div>-->
<!--                        <div id="DebugUnitPrice">Đơn giá MT rao bán: N/A</div>-->
<!--                        <div id="DebugPriceHouseEstimated">Giá nhà định giá: 0.101 Tỷ</div>-->
<!--                        <div id="DebugPriceLandProposed">Giá đất rao bán: 2.499 Tỷ</div>-->
<!--                        <div>--</div>-->
<!--                        <div id="DebugPriceLandEstimated">Giá đất định giá: 3.184 Tỷ</div>-->
<!--                        <div id="DebugUnitPriceEstimate">Đơn giá dùng ĐG: 0.084 Tỷ / m<sup>2</sup></div>-->
<!--                    </div>-->
<!--                    <div class="gp-apartment" style="display: none">-->
<!--                        <div id="m2">Diện tích sử dụng: N/A</div>-->
<!--                        <div id="gB">Giá rao bán: 0 Tỷ</div>-->
<!--                        <div>--</div>-->
<!--                        <div id="dgNt">Đơn giá xd nội thất: N/A</div>-->
<!--                        <div id="gNt">Giá xd nội thất: N/A</div>-->
<!--                        <div>--</div>-->
<!--                        <div id="pTi">%Tiện ích cộng thêm: N/A</div>-->
<!--                        <div id="gTi">Giá tiện ích: N/A</div>-->
<!--                        <div>--</div>-->
<!--                        <div id="dgT">Đơn giá thô: N/A</div>-->
<!--                        <div id="hsT">Hệ số tầng căn hộ: N/A</div>-->
<!--                        <div id="hsCc">Hệ số tòa chung cư: N/A</div>-->
<!--                        <div>--</div>-->
<!--                        <div id="dgTcs">Đơn giá thô cơ sở: N/A</div>-->
<!--                        <div>--</div>-->
<!--                        <div id="dgDG">Đơn giá dùng ĐG: N/A</div>-->
<!--                        <div>--</div>-->
<!--                        <div id="gCs">Giá cơ sở: N/A</div>-->
<!--                        <div id="gTiCs">Giá tiện ích cơ sở: N/A</div>-->
<!--                        <div>--</div>-->
<!--                        <div id="gDG">Giá Định giá: N/A</div>-->
<!--                    </div>-->
<!--                    <div>--</div>-->
<!--                    <div id="DebugFlagCssClass" class="deal-good">-->
<!--                        <span id="DebugPriceEstimatedInVND">Định giá BĐS: <strong>3.285 Tỷ</strong></span>-->
<!--                        <span id="DebugPriceChangedInPercent">(+26.34%)</span>-->
<!--                    </div>-->
<!--                    <div id="DebugPercent">Đặc điểm tốt / xấu: N/A</div>-->
<!--                    <div id="DebugPercentMsg"></div>-->
<!--                    <div>--</div>-->
<!--                    <div id="DebugEstimationMsg">T1 - Định giá từ <strong><a target="_blank" href="https://dulieunhadat.vn/Admin/RealEstate?Options.List=2166882_list">11</a></strong> căn Hẻm nằm trên các đường có giá trị tương đương.</div>-->
<!--                    <div>--</div>-->
<!--                    <div id="DebugBasePriceMarket">Đơn giá MT BGĐ: 0.063 Tỷ / m<sup>2</sup></div>-->
<!--                    <div id="DebugBasePriceMarketAlley">Đơn giá ĐG BGĐ: 0.038 Tỷ / m<sup>2</sup></div>-->
<!--                    <div id="DebugBasePriceMarketLandEstimated">Giá đất ĐG theo BGĐ: 1.43 Tỷ</div>-->
<!--                    <div id="DebugBasePriceMarketPropertyEstimated">Giá BĐS ĐG theo BGĐ: 1.531 Tỷ</div>-->
<!--                    <div id="DebugBasePriceMarketPropertyEstimatedFinal">Giá ĐG cuối theo BGĐ: 1.531 Tỷ</div>-->
<!--                </div>-->
<!--                <div style="clear: both;"></div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>                        </div>-->
<!--                         Chưa Định giá được -->
<!--                        <div id="EstimateFailed" style="display:none">Không đủ dữ liệu để định giá BĐS!</div>-->
<!--                         Thiếu thông tin để Định giá -->
<!--                        <div id="EstimateSkip" style="display:none">BĐS thiếu các thông tin bắt buộc để định giá!</div>-->
<!--                    </div>-->

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </article>
    <footer></footer>
</article>

<!-- Modal -->
<div class="modal fade" id="dialogCopyPropertyToAdsType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Copy sang Cho thuê</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <!-- AdsType -->
                    <div class="control-group">
                        <label class="control-label"><span class="text-error">*</span> Loại giao dịch:</label>
                        <div class="controls">
                            <select class="select-box" disabled="disabled" id="AdsTypeCssClassCopy" name="AdsTypeCssClassCopy"><option value="ad-selling">Bán</option>
<option selected="selected" value="ad-leasing">Cho thuê</option>
</select>
                            

                            <!-- Published -->
                            <label class="w130"><input checked="checked" id="PublishedCopy" name="PublishedCopy" type="checkbox" value="true"><input name="PublishedCopy" type="hidden" value="false">Published</label>

                        </div>
                    </div>
                    <!-- PriceProposedCopy -->
                    <div class="control-group">
                        <label class="control-label"><span class="text-error">*</span> Giá rao:</label>
                        <div class="controls">
                            <input class="text number-box" id="PriceProposedCopy" name="PriceProposedCopy" type="text" value="">
                            <select class="" id="PaymentMethodCssClassCopy" name="PaymentMethodCssClassCopy"><option value="pm-vnd-b">Tỷ đồng</option>
<option selected="selected" value="pm-vnd-m">Triệu đồng</option>
<option value="pm-vnd-k">Nghìn đồng</option>
<option value="pm-vnd-d">Đồng</option>
<option value="pm-usd">USD</option>
<option value="pm-usd-k">Nghìn USD</option>
<option value="pm-usd-m">Triệu USD</option>
<option value="pm-sjc">Lượng vàng</option>
</select>
                            <select class="" id="PaymentUnitCssClassCopy" name="PaymentUnitCssClassCopy"><option value="unit-total">Tổng diện tích</option>
<option value="unit-m2">m2</option>
</select>
                            
                            <label class="text-error" for="PriceProposedCopy"></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="primaryAction" value="submit.Save" name="submit.SaveCopyToAdsType">Copy sang Cho thuê</button>
            </div>
        </div>
    </div>
</div>


            <!-- Valuation -->
            
<!-- Thông tin thẩm định giá -->
<article class="content-item">
    <header>
        <div class="header-wrapper">
            <div class="header-center header-bg-green">
                <div class="header-left header-bg-green">
                    <div class="header-left-triangle"></div>
                </div>
                <h1>Thông tin thẩm định giá</h1>
                <div class="header-right"></div>
            </div>
        </div>
    </header>
    <article>
    <br>
        <div class="form-horizontal pull-left">

            <!-- ShapeOfProperty -->
            <div class="control-group">
                <label class="control-label">Hình dạng bất động sản:</label>
                <div class="controls">
                		<?php
								echo $this->Form->input('', array(
									 'id' => 'id_bdsnews_hinh_dang', 
									 'name' => 'data[BdsNews][HINH_DANG]',
									 'type' => 'text',
									 'label' => false,
									 'div' => false,
									 'class' => 'text text-box-medium',
									 'placeholder' => 'VD: Hình vuông, Hình chữ nhật, ...'
								));
							?>	
                </div>
            </div>

            <!-- NumberOfFronts -->
            <div class="control-group">
                <label class="control-label">Số mặt tiếp giáp đường / ngõ:</label>
                <div class="controls">
                		<?php
                			echo $this->Form->input('', array(
									 'id' => 'id_bdsnews_mat_tiep_giap', 
									 'name' => 'data[BdsNews][MAT_TIEP_GIAP]',
									 'type' => 'number',
									 'label' => false,
									 'div' => false,
									 'class' => 'text text-box-medium',
									 'placeholder' => 'VD: 2'
								));
							?>
                </div>
            </div>

            <!-- LivingEnvironment -->
            <div class="control-group">
                <label class="control-label">Môi trường sống:</label>
                <div class="controls">
                		<?php
								echo $this->Form->input('', array(
									 'id' => 'id_bdsnews_moi_truong_song', 
									 'name' => 'data[BdsNews][MOI_TRUONG_SONG]',
									 'type' => 'text',
									 'label' => false,
									 'div' => false,
									 'class' => 'text text-box-medium',
									 'placeholder' => 'VD: Hẻm an ninh, Đối diện là khách sạn, ...'
								));
							?>
                </div>
            </div>

            <!-- TransportInfrastructure -->
            <div class="control-group">
                <label class="control-label">Hạ tầng giao thông:</label>
                <div class="controls">
                		<?php
								echo $this->Form->input('', array(
									 'id' => 'id_bdsnews_ha_tang', 
									 'name' => 'data[BdsNews][HA_TANG]',
									 'type' => 'text',
									 'label' => false,
									 'div' => false,
									 'class' => 'text text-box-medium',
									 'placeholder' => 'VD: Đường bê tông, ...'
								));
							?>
                </div>
            </div>

            <!-- UnitPriceOfLand -->
            <div class="control-group">
                <label class="control-label">Đơn giá đất / m2:</label>
                <div class="controls">
                    <?php
								echo $this->Form->input('', array(
									 'id' => 'id_bdsnews_don_gia_dat', 
									 'name' => 'data[BdsNews][DON_GIA_DAT]',
									 'type' => 'text',
									 'label' => false,
									 'div' => false,
									 'class' => 'text text-box-medium'
								));
							?>
                </div>
            </div>

            <!-- UnitPriceOfConstruction -->
            <div class="control-group">
                <label class="control-label">Đơn giá xây dựng / m2:</label>
                <div class="controls">
                		<?php
								echo $this->Form->input('', array(
									 'id' => 'id_bdsnews_don_gia_xay', 
									 'name' => 'data[BdsNews][DON_GIA_XAY]',
									 'type' => 'text',
									 'label' => false,
									 'div' => false,
									 'class' => 'text text-box-medium'
								));
							?>
                </div>
            </div>
            
            <!-- PriceExpected -->
            <div class="control-group">
                <label class="control-label"> Giá dự kiến bán:</label>
                <div class="controls">
                    <?php
								echo $this->Form->input('', array(
									 'id' => 'id_bdsnews_gia_du_kien', 
									 'name' => 'data[BdsNews][GIA_DU_KIEN]',
									 'type' => 'text',
									 'label' => false,
									 'div' => false,
									 'class' => 'text number-box'
								));
							?>

                    <button value="submit.Estimate" name="submit.Estimate" type="button" class="primaryAction">Định giá</button>

                    <div id="PriceExpectedInWords" style="font-weight:bold;color:#3F48D5;"></div>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
    </article>
    <footer></footer>
</article>


            <!-- AdsContent -->
            
<!-- Thông tin khác -->
<article class="content-item">
    <header>
        <div class="header-wrapper">
            <div class="header-center header-bg-green">
                <div class="header-left header-bg-green">
                    <div class="header-left-triangle"></div>
                </div>
                <h1>Lưu thông tin</h1>
                <div class="header-right"></div>
            </div>
        </div>
    </header>
    <footer></footer>
</article>
        <article class="content-item content-item-map">
        <!-- Ban Do -->
        <div class="row">
            <div class="col-xs-12 col-map">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist" id="tabMaps">
                    <li><br></li>
                </ul>
            </div>
        </div> 
    </article>
<br>
    <?php echo $this->Form->end(__('Lưu Bất Động Sản'))?>
    <br>
	<br>