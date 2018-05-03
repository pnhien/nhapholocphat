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
			$('#id_bdsnews_district_code').append($("<option>").attr('value','').text(''));
			$(result['districtList']).each(function() 
			{
             $('#id_bdsnews_district_code').append($("<option>").attr('value',this['District']['DISTRICT_CODE']).text(this['District']['DISTRICT_NAME']));
         });
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
			$('#id_bdsnews_ward_code').append($("<option>").attr('value','').text(''));
			$(result['wardList']).each(function() 
			{
             $('#id_bdsnews_ward_code').append($("<option>").attr('value',this['Ward']['WARD_CODE']).text(this['Ward']['WARD_NAME']));
         });
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
			$('#id_bdsnews_street_code').append($("<option>").attr('value','').text(''));
			$(result['streetList']).each(function() 
			{
             $('#id_bdsnews_street_code').append($("<option>").attr('value',this['Street']['STREET_CODE']).text(this['Street']['STREET_NAME']));
         });
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


<div class="zone zone-content">

<?php echo $this->Form->create('BdsKhachHang', array('url' => array ('controller' => 'BdsKhachHang', 'action' => 'doSaveBdsKhachHang'), 'role' => 'form', 'novalidate' => true, 'enctype'=>'multipart/form-data')); ?>
<?php 
    echo $this->Form->input ( '', array (
				'name' => 'data[BdsKhachHang][KHACH_HANG_ID]',
				'id' => 'id_khach_hang_id',
				'type' => 'text',
				'type' => 'hidden',
				'div' => false
	) );
?>
<div class="edit-item">
    <div class="edit-item-primary">
            <div class="edit-item-content">

<!-- Navigation -->

<ul class="nav nav-tabs">
    <!-- Property -->
    	<li class="active">
    		<a href="https://nhapholocphat.com/BdsKhachHang" data-toggle="tab">BĐS</a>
    	</li>
        <!-- <li>
            <a href="https://dulieunhadat.vn/Admin/RealEstate/Customer/Edit/2268753?returnUrl=https%3A%2F%2Fdulieunhadat.vn%2FAdmin%2FRealEstate%2FCustomer#revisions" data-toggle="tab" class="lazy-loading-tab" data-url="/RealEstate.Admin/CustomerAdmin/Details/2268753">
                Lịch sử thay đổi
            </a>
        </li>
        <li>
            <a href="https://dulieunhadat.vn/Admin/RealEstate/Customer/Edit/2268753?returnUrl=https%3A%2F%2Fdulieunhadat.vn%2FAdmin%2FRealEstate%2FCustomer#visited" data-toggle="tab" class="lazy-loading-tab" data-url="/RealEstate.Admin/CustomerAdmin/VisitedProperties/2268753">
                Lịch sử xem nhà
            </a>
        </li>
        <li>
            <a href="https://dulieunhadat.vn/Admin/RealEstate/Customer/Edit/2268753?returnUrl=https%3A%2F%2Fdulieunhadat.vn%2FAdmin%2FRealEstate%2FCustomer#calledby" data-toggle="tab" class="lazy-loading-tab" data-url="/RealEstate.Admin/CustomerAdmin/CalledByUsers/2268753">
                Lịch sử cuộc gọi
            </a>
        </li> -->
</ul>
<div class="tab-content">
    <!-- Customer -->
    <div class="tab-pane active" id="customer">
        <div class="form-editor">

            <span id="Id" style="display:none;">2268753</span>

            <div class="save-button">
                <button value="submit.Save" name="submit.Save" type="submit" class="primaryAction">Save</button>
                <button value="submit.Save" name="submit.SaveContinue" type="submit" class="primaryAction">Save &amp; Continue</button>
            </div>

            <!-- Thông tin khách hàng -->
            <article class="content-item">
                <header>
                    <div class="header-wrapper">
                        <div class="header-center header-bg-green">
                            <div class="header-left header-bg-green">
                                <div class="header-left-triangle"></div>
                            </div>
                            <h1>Thông tin khách hàng</h1>
                            <div class="header-right"></div>
                        </div>
                        <div class="header-msg">
                            <p class="text-success">Các mục có dấu (<span class="text-error">*</span>) là bắt buộc nhập</p>
                        </div>
                    </div>
                </header>
                <article>
                    <!-- Status -->
                    <div class="control-group">
                        <label class="control-label">Tình trạng:</label>
                        <div class="controls">
						<?php 
	                		$option = array();
	                		foreach ($tinhTrangKhList as $tinhTrangKh){
	                				$option[$tinhTrangKh['TinhTrangKh']['TINH_TRANG_CODE']] = $tinhTrangKh['TinhTrangKh']['TINH_TRANG_NAME'];
	                		}
	                		echo $this->Form->select ( '', $option, array(
	                			'id' => 'id_tinh_trang_id', 
	                			'name' => 'data[BdsKhachHang][TINH_TRANG_CODE]',
	                			'class' => 'select-box'
	                		));
                		?>
						</div>
                    </div>
                    <!-- Note -->
                    <div class="control-group">
                        <label class="control-label">Ghi chú:</label>
                        <div class="controls">
                            <?php
							echo $this->Form->input ( '', array (
									'name' => 'data[BdsKhachHang][GHI_CHU]',
									'id' => 'id_bdskhachhang_bds_note',
									'type' => 'text',
									'class' => 'text text-box-medium'
							) );
							?>
                        </div>
                    </div>
                    <ul class="nav nav-tabs">
                        <!-- Customer -->
                        <li class="active">
                            <a href="http://nhapholocphat.com/CreateBdsKhachHang#customerInfo" data-toggle="tab">
                                Thông tin KH
                            </a>
                        </li>
                        <!-- Business -->
                        <li>
                            <a href="http://nhapholocphat.com/CreateBdsKhachHang#businessInfo" data-toggle="tab">
                                Thông tin Tổ chức
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="customerInfo">
                            <div class="form-horizontal pull-left">
                                <input id="IsRequirementExchange" name="IsRequirementExchange" type="hidden" value="False">
                                <input id="PropertyExchangeId" name="PropertyExchangeId" type="hidden" value="0">
                                <input id="PropertyAddress" name="PropertyAddress" type="hidden" value="">
                                <input id="PropertyLink" name="PropertyLink" type="hidden" value="">
                                <!-- ContactName -->
                                <div class="control-group">
                                    <label class="control-label"><span class="text-error">*</span> Tên khách hàng:</label>
                                    <div class="controls">
                                        <?php
										echo $this->Form->input ( '', array (
												'name' => 'data[BdsKhachHang][NAME]',
												'id' => 'id_bdskhachhang_name',
												'type' => 'text',
												'class' => 'text text-box-medium'
										) );
										?>
                                    </div>
                                </div>
                                <!-- ContactPhone -->
                                <div class="control-group">
                                    <label class="control-label"><span class="text-error">*</span> Điện thoại:</label>
                                    <div class="controls">
                                    	<?php
										echo $this->Form->input ( '', array (
												'name' => 'data[BdsKhachHang][PHONE]',
												'id' => 'id_bdskhachhang_phone',
												'type' => 'text',
												'class' => 'text text-box-medium'
										) );
										?>
									</div>
                                </div>
                                    <!-- ContactPhonePrivate -->
                                    <div class="control-group">
                                        <label class="control-label">Liên hệ độc quyền:</label>
                                        <div class="controls">
                                            <?php
											echo $this->Form->input ( '', array (
													'name' => 'data[BdsKhachHang][DOC_QUYEN]',
													'id' => 'id_bdskhachhang_doc_quyen',
													'type' => 'text',
													'class' => 'text text-box-medium'
											) );
											?>
                                        </div>
                                    </div>
                                <!-- ContactAddress -->
                                <div class="control-group">
                                    <label class="control-label">Địa chỉ:</label>
                                    <div class="controls">
                                        <?php
										echo $this->Form->input ( '', array (
												'name' => 'data[BdsKhachHang][DIA_CHI]',
												'id' => 'id_bdskhachhang_dia_chi',
												'type' => 'text',
												'class' => 'text text-box-medium'
										) );
										?>
                                    </div>
                                </div>
                                <!-- ContactEmail -->
                                <div class="control-group">
                                    <label class="control-label">Email:</label>
                                    <div class="controls">
                                        <?php
										echo $this->Form->input ( '', array (
												'name' => 'data[BdsKhachHang][EMAIL]',
												'id' => 'id_bdskhachhang_email',
												'type' => 'text',
												'class' => 'text text-box-medium'
										) );
										?>
                                    </div>
                                </div>
                                <!-- IdCardNumber -->
                                <div class="control-group">
                                    <label class="control-label">Số CMND:</label>
                                    <div class="controls">
                                        <?php
										echo $this->Form->input ( '', array (
												'name' => 'data[BdsKhachHang][CMND_SO]',
												'id' => 'id_bdskhachhang_cmnd_so',
												'type' => 'text',
												'class' => 'text text-box'
										) );
										?> Cấp ngày <?php
										echo $this->Form->input ( '', array (
												'name' => 'data[BdsKhachHang][CMND_NGAY_CAP]',
												'id' => 'id_bdskhachhang_cmnd_ngay_cap',
												'type' => 'date',
												'class' => 'text date-box hasDatepicker'
										) );
										?>
                                    </div>
                                </div>
                                <!-- IdCardIssuedBy -->
                                <div class="control-group">
                                    <label class="control-label">Số CMND Cấp bởi:</label>
                                    <div class="controls">
                                        <?php
										echo $this->Form->input ( '', array (
												'name' => 'data[BdsKhachHang][CMND_NOI_CAP]',
												'id' => 'id_bdskhachhang_cmnd_noi_cap',
												'type' => 'text',
												'class' => 'text text-box-medium'
										) );
										?>
                                    </div>
                                </div>

                                <!-- IsExternalCustomer -->
                            </div>
                            <div class="form-horizontal pull-left">
                                <ul style="padding-left:40px;">

                                        <li>
                                        	<?php
                                            echo $this->Form->input ( '', array (
														'name' => 'data[BdsKhachHang][DE_O]',
														'id' => 'id_bdskhachhang_de_o',
														'type' => 'checkbox',
														'label' => 'Để ở',
														'div' => false
											) );
											?>
                                        </li>
                                        <li>
                                        <?php
                                            echo $this->Form->input ( '', array (
														'name' => 'data[BdsKhachHang][LAM_VP]',
														'id' => 'id_bdskhachhang_lam_vp',
														'type' => 'checkbox',
														'label' => 'Làm văn phòng',
														'div' => false
											) );
										?>
                                        </li>
                                        <li>
                                        <?php
                                            echo $this->Form->input ( '', array (
														'name' => 'data[BdsKhachHang][KINH_DOANH]',
														'id' => 'id_bdskhachhang_kinh_doanh',
														'type' => 'checkbox',
														'label' => 'Kinh doanh buôn bán',
														'div' => false
											) );
										?>
                                        </li>
                                        <li>
                                        <?php
                                            echo $this->Form->input ( '', array (
														'name' => 'data[BdsKhachHang][LAM_SHOW_ROOM]',
														'id' => 'id_bdskhachhang_lam_show_room',
														'type' => 'checkbox',
														'label' => 'Làm showroom',
														'div' => false
											) );
										?>
                                        </li>
                                        <li>
                                    	<?php
                                            echo $this->Form->input ( '', array (
														'name' => 'data[BdsKhachHang][LAM_KHACH_SAN]',
														'id' => 'id_bdskhachhang_lam_khach_san',
														'type' => 'checkbox',
														'label' => 'Làm khách sạn',
														'div' => false
											) );
										?>
                                        </li>
                                        <li>
                                        <?php
                                            echo $this->Form->input ( '', array (
														'name' => 'data[BdsKhachHang][NHA_HANG_CAFE]',
														'id' => 'id_bdskhachhang_nha_hang_cafe',
														'type' => 'checkbox',
														'label' => 'Nhà hàng, cafe',
														'div' => false
											) );
										?>
                                        </li>
                                        <li>
                                        <?php
                                            echo $this->Form->input ( '', array (
														'name' => 'data[BdsKhachHang][CAO_OC_VP]',
														'id' => 'id_bdskhachhang_cao_oc_vp',
														'type' => 'checkbox',
														'label' => 'Cao ốc văn phòng',
														'div' => false
											) );
										?>
                                        </li>
                                        <li>
                                        <?php
                                            echo $this->Form->input ( '', array (
														'name' => 'data[BdsKhachHang][MUA_DAU_TU]',
														'id' => 'id_bdskhachhang_mua_dau_tu',
														'type' => 'checkbox',
														'label' => 'Mua đầu tư',
														'div' => false
											) );
										?>
                                        </li>
                                        <li>
                                        <?php
                                            echo $this->Form->input ( '', array (
														'name' => 'data[BdsKhachHang][MUA_CHO_THUE]',
														'id' => 'id_bdskhachhang_mua_cho_thue',
														'type' => 'checkbox',
														'label' => 'Mua cho thuê',
														'div' => false
											) );
										?>
                                        </li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="tab-pane" id="businessInfo">
                            <div class="form-horizontal">
                                <!-- BusinessName -->
                                <div class="control-group">
                                    <label class="control-label">Tên tổ chức:</label>
                                    <div class="controls">
                                        <input class="text text-box-medium" id="BusinessName" name="BusinessName" type="text" value="">
                                    </div>
                                </div>
                                <!-- BusinessPhone -->
                                <div class="control-group">
                                    <label class="control-label">Điện thoại:</label>
                                    <div class="controls">
                                        <input class="text text-box-medium" id="BusinessPhone" name="BusinessPhone" type="text" value="">
                                    </div>
                                </div>
                                <!-- BusinessAddress -->
                                <div class="control-group">
                                    <label class="control-label">Địa chỉ:</label>
                                    <div class="controls">
                                        <input class="text text-box-medium" id="BusinessAddress" name="BusinessAddress" type="text" value="">
                                    </div>
                                </div>
                                <!-- BusinessEmail -->
                                <div class="control-group">
                                    <label class="control-label">Email:</label>
                                    <div class="controls">
                                        <input class="text text-box-medium" id="BusinessEmail" name="BusinessEmail" type="text" value="">
                                    </div>
                                </div>
                                <!-- BusinessRegistrationNumber -->
                                <div class="control-group">
                                    <label class="control-label">Số ĐKKD:</label>
                                    <div class="controls">
                                        <input class="text text-box" id="BusinessRegistrationNumber" name="BusinessRegistrationNumber" type="text" value="">
                                        Cấp ngày
                                        <input class="text date-box hasDatepicker" id="BusinessRegistrationIssuedDate" name="BusinessRegistrationIssuedDate" type="text" value="">
                                    </div>
                                </div>
                                <!-- BusinessRegistrationIssuedBy -->
                                <div class="control-group">
                                    <label class="control-label">ĐKKD Cấp bởi:</label>
                                    <div class="controls">
                                        <input class="text text-box-medium" id="BusinessRegistrationIssuedBy" name="BusinessRegistrationIssuedBy" type="text" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <footer></footer>
            </article>

            <div id="Revisions"></div>
            <div id="VisitedProperties"></div>

            <!-- Yêu cầu của khách hàng -->
            <article class="content-item">
                <header>
                    <div class="header-wrapper">
                        <div class="header-center header-bg-green">
                            <div class="header-left header-bg-green">
                                <div class="header-left-triangle"></div>
                            </div>
                            <h1>Yêu cầu của khách hàng</h1>
                            <div class="header-right"></div>
                        </div>
                        <div class="header-msg">
                            <p class="text-success">Các mục có dấu (<span class="text-error">*</span>) là bắt buộc nhập</p>
                        </div>
                    </div>
                </header>
                <article>
                    <div class="form-horizontal pull-left">
                        <input id="GroupId" name="GroupId" type="hidden" value="">
                        <!-- AdsType -->
                        <div class="control-group">
                            <label class="control-label">Loại tin:</label>
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
                            </div>
                        </div>
                        <!-- TypeGroup -->
                        <div class="control-group">
                            <label class="control-label">Nhóm BĐS:</label>
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
                            </div>
                        </div>
                        <!-- Province -->
                        <div class="control-group">
                            <label class="control-label">Tỉnh / Thành Phố:</label>
                            <div class="controls">
                                <?php 
			                		$option = array();
			                		foreach ($provinceList as $province){
			                				$option[$province['Province']['PROVINCE_CODE']] = $province['Province']['PROVINCE_NAME'];
			                		}
			                		echo $this->Form->select ( '', $option, array(
			                			'id' => 'id_bdsnews_province_code', 
			                			'name' => 'data[BdsYeuCau][PROVINCE_CODE]',
			                			'class' => 'select-box',
			                			'onChange' => 'fnc_doGetDistricts();'
			                		));
			                	?>
		                		
                            </div>
                        </div>
                        <!-- Districts -->
                        <div class="control-group">
                            <label class="control-label"><span class="text-error not-apartment">*</span> Quận / Huyện:</label>
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
	                			'name' => 'data[BdsYeuCau][DISTRICT_CODE]',
	                			'class' => 'select-box',
	                			'onChange' => 'fnc_doGetWards();'
	                		));
                		?> 
                            </div>
                        </div>
                        <!-- Wards -->
                        <div class="control-group">
                            <label class="control-label">Phường / Xã:</label>
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
			                			'name' => 'data[BdsYeuCau][WARD_CODE]',
			                			'class' => 'select-box',
			                			'onChange' => 'fnc_doGetStreets();'
			                		));
		                		?>
                            </div>
                        </div>
                        <!-- Streets -->
                        <div class="control-group not-apartment">
                            <label class="control-label">Đường / Phố:</label>
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
			                			'name' => 'data[BdsYeuCau][STREET_CODE]',
			                			'class' => 'select-box',
			                			'onChange' => 'fnc_makeAddress();'
			                		));
		                		?>
                            </div>
                        </div>
                        <!-- Apartment -->
                        <div class="control-group apartment-name" style="display: none;">
                            <label class="control-label"> Tên dự án / Chung cư:</label>
                            <div class="controls">
                                
                            </div>
                        </div>
                        <!-- Area -->
                        <div class="control-group">
                            <label class="control-label">Diện tích tối thiểu:</label>
                            <div class="controls">
                                 <?php
									echo $this->Form->input ( '', array (
											'name' => 'data[BdsYeuCau][DIEN_TICH_TOI_THIEU]',
											'id' => 'id_bdsyeucau_dien_tich_toi_thieu',
											'type' => 'text',
											'class' => 'text text-box'
									) );
								?>
                            </div>
                        </div>
                        <!-- Width -->
                        <div class="control-group not-apartment">
                            <label class="control-label">Chiều ngang tối thiểu:</label>
                            <div class="controls">
                                <?php
									echo $this->Form->input ( '', array (
											'name' => 'data[BdsYeuCau][NGANG_TOI_THIEU]',
											'id' => 'id_bdsyeucau_ngang_toi_thieu',
											'type' => 'text',
											'class' => 'text text-box'
									) );
								?>
                            </div>
                        </div>
                        <!-- Length -->
                        <div class="control-group not-apartment">
                            <label class="control-label">Chiều dài tối thiểu:</label>
                            <div class="controls">
                                <?php
									echo $this->Form->input ( '', array (
											'name' => 'data[BdsYeuCau][DAI_TOI_THIEU]',
											'id' => 'id_bdsyeucau_dai_toi_thieu',
											'type' => 'text',
											'class' => 'text text-box'
									) );
								?>
                            </div>
                        </div>

                        <!-- MinBedrooms -->
                        <div class="control-group apartment-name" style="display: none;">
                            <label class="control-label">Số phòng ngủ tối thiểu:</label>
                            <div class="controls">
                                <?php
									echo $this->Form->input ( '', array (
											'name' => 'data[BdsYeuCau][PHONG_NGU_TOI_THIEU]',
											'id' => 'id_bdsyeucau_phong_ngu_toi_thieu',
											'type' => 'text',
											'class' => 'text text-box'
									) );
								?>
                            </div>
                        </div>

                        <!-- Floors -->
                        <div class="control-group not-apartment not-apartment-floor">
                            <label class="control-label">Số tầng tối thiểu:</label>
                            <div class="controls">
                                <?php
									echo $this->Form->input ( '', array (
											'name' => 'data[BdsYeuCau][LAU_TOI_THIEU]',
											'id' => 'id_bdsyeucau_lau_toi_thieu',
											'type' => 'text',
											'class' => 'text text-box'
									) );
								?>
                            </div>
                        </div>
                        <!-- Apartment Floor -->
                        <div class="control-group apartment-floor" style="display: none;">
                            <label class="control-label">Vị trí tầng:</label>
                            <div class="controls">
                                <?php
									echo $this->Form->input ( '', array (
											'name' => 'data[BdsYeuCau][VI_TRI_TANG_TU]',
											'id' => 'id_bdsyeucau_vi_tri_tang_tu',
											'type' => 'text',
											'class' => 'text text-box'
									) );
								?>
                            </div>
                        </div>

                        <!-- Direction -->
                        <div class="control-group">
                            <label class="control-label">Hướng BĐS:</label>
                            <div class="controls">
                                <?php 
			                		$option = array();
			                		foreach ($huongList as $huong){
			                				$option[$huong['Huong']['HUONG_CODE']] = $huong['Huong']['HUONG_NAME'];
			                		}
			                		echo $this->Form->select ( '', $option, array(
			                			'id' => 'id_bdsyeucau_huong_code', 
			                			'name' => 'data[BdsYeuCau][HUONG_CODE]',
			                			'class' => 'select-box'
			                		));
		                		?>
                            </div>
                        </div>
                        <!-- Location -->
                        <div class="control-group not-apartment">
                            <label class="control-label">Vị trí BĐS:</label>
                            <div class="controls">
                                <?php 
			                		$option = array();
			                		foreach ($viTriList as $viTri){
			                				$option[$viTri['ViTri']['VI_TRI_CODE']] = $viTri['ViTri']['VI_TRI_NAME'];
			                		}
			                		echo $this->Form->select ( '', $option, array(
			                			'id' => 'id_bdsyeucau_vi_tri_code', 
			                			'name' => 'data[BdsYeuCau][VI_TRI_CODE]',
			                			'class' => 'select-box'
			                		));
		                		?>
                            </div>
                        </div>
                        <!-- AlleyWidth -->
                        <div class="control-group not-apartment">
                            <label class="control-label">Hẻm rộng tối thiểu:</label>
                            <div class="controls">
                                <?php
									echo $this->Form->input ( '', array (
											'id' => 'id_bdsyeucau_hem_rong_toi_thieu',
											'name' => 'data[BdsYeuCau][HEM_RONG_TOI_THIEU]',
											'type' => 'text',
											'class' => 'text text-box'
									) );
								?>
                            </div>
                        </div>
                        <!-- AlleyTurns -->
                        <div class="control-group not-apartment">
                            <label class="control-label">Số lần rẽ tối đa:</label>
                            <div class="controls">
                                <?php
									echo $this->Form->input ( '', array (
											'id' => 'id_bdsyeucau_lan_re_toi_da',
											'name' => 'data[BdsYeuCau][LAN_RE_TOI_DA]',
											'type' => 'text',
											'class' => 'text text-box'
									) );
								?>
                            </div>
                        </div>
                        <!-- DistanceToStreet -->
                        <div class="control-group not-apartment">
                            <label class="control-label">K/c đến đường chính tối đa:</label>
                            <div class="controls">
                                <?php
									echo $this->Form->input ( '', array (
											'id' => 'id_bdsyeucau_khoang_cach_duong_chinh',
											'name' => 'data[BdsYeuCau][KHOANG_CACH_DUONG_CHINH]',
											'type' => 'text',
											'class' => 'text text-box'
									) );
								?>
                            </div>
                        </div>
                            <!-- Price -->
                            <div class="control-group">
                                <label class="control-label">Giá từ:</label>
                                <div class="controls">
                                    <?php
										echo $this->Form->input ( '', array (
												'id' => 'id_bdsyeucau_gia_tu',
												'name' => 'data[BdsYeuCau][GIA_TU]',
												'type' => 'text',
												'class' => 'text text-box'
										) );
									?>
                                    đến
                                <?php
										echo $this->Form->input ( '', array (
												'id' => 'id_bdsyeucau_gia_den',
												'name' => 'data[BdsYeuCau][GIA_DEN]',
												'type' => 'text',
												'class' => 'text text-box'
										) );
									

                                   $option = array();
									foreach ($loaiTienList as $loaiTien){
											$option[$loaiTien['LoaiTien']['LOAI_TIEN_CODE']] = $loaiTien['LoaiTien']['LOAI_TIEN_NAME'];
									}
									echo $this->Form->select ( '', $option, array(
										'id' => 'id_bdsnews_loai_tien_code', 
										'name' => 'data[BdsNews][LOAI_TIEN_CODE]',
										'class' => 'select-box'
									));
								?>
                                </div>
                            </div>
                        <div class="control-group">
                            <label class="control-label"></label>
                            <div class="controls">
                                <button type="submit" name="submit.AddNewRequirement" value="AddRequirement">Lưu yêu cầu</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-horizontal" style="padding-left:400px;">
                                   


<table id="tblRequirements" class="items fixed-table">
    <tbody>
    <tr class="selected">
        <td class="w36">
            <a class="ui-icon icon-edit" groupid="77493" href="https://dulieunhadat.vn/Admin/RealEstate/Customer/Edit/2268753?groupId=77493">Edit</a>
            <a class="ui-icon icon-delete" groupid="77493" href="https://dulieunhadat.vn/RealEstate.Admin/CustomerAdmin/Delete?groupId=77493">Delete</a>
        </td>
        <td class="w20">
            <input checked="checked" groupid="77493" id="IsEnabled" name="IsEnabled" type="checkbox" value="true"><input name="IsEnabled" type="hidden" value="false">
        </td>
        <td class="w60">77493</td>
        <td>
                <div>
        <strong>Nhóm BĐS: </strong>
        <span class="color-note">Nhà đất</span>
    </div>

    <div>
        <strong>Tỉnh / Thành Phố: </strong>
        Tp. Hồ Chí Minh
    </div>

    <div>
        <strong>Khu vực: </strong>
        Quận 5
    </div>


    <div>
        <strong>Đường: </strong>
        An Dương Vương, Nguyễn Trãi
    </div>


    <div>
        <strong>Vị trí: </strong>
MT
    </div>



    <div>
        <strong>Giá: </strong>
         đến 20 Tỷ
    </div>

        </td>
    </tr>
    </tbody>
</table>
                    </div>
                    <div class="clearfix"></div>
                </article>
                <footer></footer>
            </article>

            <!-- BĐS của khách hàng -->
            <article class="content-item">
                <header>
                    <div class="header-wrapper">
                        <div class="header-center header-bg-green">
                            <div class="header-left header-bg-green">
                                <div class="header-left-triangle"></div>
                            </div>
                            <h1>BĐS của khách hàng</h1>
                            <div class="header-right"></div>
                        </div>
                        <div class="header-msg">
                            <p class="text-success">Các mục có dấu (<span class="text-error">*</span>) là bắt buộc nhập</p>
                        </div>
                    </div>
                </header>
                <article>
                    <div class="form-horizontal pull-left" id="listProperties">
                        

<div class="form-editor save-button">
    Mã số <input class="text text-box" id="PropertyId" name="PropertyId" type="text" value="">

    Ý kiến của KH
    <select class="select-box" id="FeedbackCssClass" name="FeedbackCssClass"><option value="" class="">Vui lòng chọn...</option>
<option value="fb-wait-visit" class="fb-wait-visit">Chờ xem</option>
<option value="fb-visited" class="fb-visited">Đã xem</option>
<option value="fb-dislike" class="fb-dislike">Không thích</option>
<option value="fb-considering" class="fb-considering">Đang xem xét</option>
<option value="fb-dealing" class="fb-dealing">Đang thương lượng</option>
<option value="fb-wait-deposit" class="fb-wait-deposit">Chờ đặt cọc</option>
<option value="fb-deposited" class="fb-deposited">Đã đặt cọc</option>
<option value="fb-bought-successful" class="fb-bought-successful">Mua thành công</option>
<option value="fb-bought-failed" class="fb-bought-failed">Mua thất bại</option>
<option value="fb-evaluation" class="fb-evaluation">Yêu cầu định giá</option>
</select>

    Nhân viên
    <select class="select-box multiselect" id="UserIds" multiple="multiple" name="UserIds" placeholder="-- Vui lòng chọn --" style="display: none;"><option value="2204476">Chi Tai.TB</option>
<option value="2209423">Ly Truong.TB</option>
<option value="2204364">PhuongTran.TB</option>
<option value="2204480">Thi Vo.TB</option>
<option value="2204475">Thinh Nguyen.TB</option>
<option value="2171286">TuanHoang.TB</option>
<option value="1640776">VuHoang.TB</option>
<option value="2207847">VyThao.TB</option>
</select><div class="btn-group form-control"><button type="button" class="multiselect dropdown-toggle text-left text-ellipsis placeholder" data-toggle="dropdown" title="" style="width: 100%;">-- Vui lòng chọn -- <b class="caret"></b></button><ul class="multiselect-container dropdown-menu"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span><input class="multiselect-search form-control input-sm" type="text" placeholder="Tìm kiếm..."></div><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="2204476"> Chi Tai.TB</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="2209423"> Ly Truong.TB</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="2204364"> PhuongTran.TB</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="2204480"> Thi Vo.TB</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="2204475"> Thinh Nguyen.TB</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="2171286"> TuanHoang.TB</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="1640776"> VuHoang.TB</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="2207847"> VyThao.TB</label></a></li></ul></div><div class="btn-group form-control"><button type="button" class="multiselect dropdown-toggle text-left text-ellipsis placeholder" data-toggle="dropdown" title="" style="width: 100%; display: none;">-- Vui lòng chọn -- <b class="caret"></b></button><div class="btn-group form-control"><button type="button" class="multiselect dropdown-toggle text-left text-ellipsis placeholder" data-toggle="dropdown" title="" style="width: 100%;">-- Vui lòng chọn -- <b class="caret"></b></button><ul class="multiselect-container dropdown-menu"></ul></div><ul class="multiselect-container dropdown-menu"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span><input class="multiselect-search form-control input-sm" type="text" placeholder="Tìm kiếm..."></div><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="2204476"> Chi Tai.TB</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="2209423"> Ly Truong.TB</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="2204364"> PhuongTran.TB</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="2204480"> Thi Vo.TB</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="2204475"> Thinh Nguyen.TB</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="2171286"> TuanHoang.TB</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="1640776"> VuHoang.TB</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="2207847"> VyThao.TB</label></a></li></ul></div>

    Ngày <input class="text date-box hasDatepicker" id="VisitedDate" name="VisitedDate" type="text" value="">
    <input id="IsWorkOverTime" name="IsWorkOverTime" type="checkbox" value="true"><input name="IsWorkOverTime" type="hidden" value="false">
    <label for="IsWorkOverTime">Làm ngoài giờ</label>

    <button type="submit" id="submit_BulkUpdateProperties" name="submit.BulkUpdateProperties" value="Mark Properties">Thêm BĐS</button>
</div>
<input type="hidden" id="CurrentCustomerId" value="2268753">


<div id="suggestionProperties">
    <ul class="nav nav-tabs">
        <!-- Property -->
        <li class="active">
            <a href="https://dulieunhadat.vn/Admin/RealEstate/Customer/Edit/2268753?returnUrl=https%3A%2F%2Fdulieunhadat.vn%2FAdmin%2FRealEstate%2FCustomer#savedProperties" data-toggle="tab">
                BĐS đã xem
            </a>
        </li>
            <li>
                <a href="https://dulieunhadat.vn/Admin/RealEstate/Customer/Edit/2268753?returnUrl=https%3A%2F%2Fdulieunhadat.vn%2FAdmin%2FRealEstate%2FCustomer#reqsProperties77493" data-toggle="tab" class="lazy-loading-tab" data-url="/RealEstate.Admin/CustomerAdmin/SearchCustomerReqsProperties?customerId=2268753&amp;reqsGroupId=77493">
                    Yêu cầu 77493
                </a>
            </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active ajax-content ajax-paging" id="savedProperties" data-onload="initTooltip(),updateCustomerPropertyStatus()"> 

<table id="tblProperties" class="items fixed-table float-header">
    <thead>
        <tr>
            <th scope="col" class="w20"><input class="selectAll" type="checkbox" value="Properties"></th>
            <th scope="col" class="w42">Id</th>
            <th scope="col" class="w40">Giá</th>
            <th scope="col" class="w240">Địa chỉ</th>
            <th scope="col" class="w40">Nhà</th>
            <th scope="col" class="w14">Hg</th>
            <th scope="col" class="w40">MT/H</th>
            <th scope="col" class="w40">LH</th>
            <th scope="col" class="w120">Ý kiến KH</th>
            <th scope="col" class="w100">NV</th>
            <th scope="col" class="w68">Ngày</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table><div class="floatHeader" style="display: none;"><table id="tblProperties" class="items fixed-table float-header" style="width: 862px;">
    
    
<thead><tr>
            
            
            
            
            
            
            
            
            
            
            
        <th scope="col" class="w20" style="width: 19px;"><input class="selectAll" type="checkbox" value="Properties"></th><th scope="col" class="w42" style="width: 41px;">Id</th><th scope="col" class="w40" style="width: 39px;">Giá</th><th scope="col" class="w240" style="width: 239px;">Địa chỉ</th><th scope="col" class="w40" style="width: 39px;">Nhà</th><th scope="col" class="w14" style="width: 13px;">Hg</th><th scope="col" class="w40" style="width: 39px;">MT/H</th><th scope="col" class="w40" style="width: 39px;">LH</th><th scope="col" class="w120" style="width: 119px;">Ý kiến KH</th><th scope="col" class="w100" style="width: 99px;">NV</th><th scope="col" class="w68" style="width: 67px;">Ngày</th></tr></thead></table></div>





<div class="spacer"></div>
</div>
            <div class="tab-pane ajax-content ajax-paging" id="reqsProperties77493" data-onload="initTooltip(),updateCustomerPropertyStatus()">
                <div class="overlay-content">
    <p><img src="./ReeSoft - Cập nhật khách hàng s_files/bigrotation2.gif" alt="loading..."> Loading...</p>
</div>
            </div>
    </div>
</div>



                    </div>
                    <div class="clearfix"></div>
                </article>
                <footer></footer>
            </article>
        </div>
    </div>
    <!-- Revisions -->
    <div class="tab-pane" id="revisions" data-onload="">
        <div class="overlay-content">
    <p><img src="./ReeSoft - Cập nhật khách hàng s_files/bigrotation2.gif" alt="loading..."> Loading...</p>
</div>
    </div>
    <!-- Visited Properties -->
    <div class="tab-pane" id="visited" data-onload="">
        <div class="overlay-content">
    <p><img src="./ReeSoft - Cập nhật khách hàng s_files/bigrotation2.gif" alt="loading..."> Loading...</p>
</div>
    </div>
    <!-- Visited Properties -->
    <div class="tab-pane" id="calledby" data-onload="">
        <div class="overlay-content">
    <p><img src="./ReeSoft - Cập nhật khách hàng s_files/bigrotation2.gif" alt="loading..."> Loading...</p>
</div>
    </div>
</div>

            </div>
    </div>
    <div class="edit-item-secondary group">
                    <div class="edit-item-sidebar group">
                <fieldset class="save-button">
    <button class="primaryAction" type="submit" name="submit.Save" value="submit.Save">Save</button><button value="submit.SaveContinueRequirement" name="submit.SaveContinueRequirement" type="submit" class="primaryAction" style="margin-left: 4px; display: none;">Lưu và cập nhật BĐS yêu cầu</button><button value="submit.Save" name="submit.SaveContinue" type="submit" class="primaryAction" style="margin-left: 4px;">Save &amp; Continue</button><button value="submit.Save" name="submit.SaveContinue" type="submit" class="primaryAction" style="margin-left: 4px;">Save &amp; Continue</button><button value="submit.SaveContinueRequirement" name="submit.SaveContinueRequirement" type="submit" class="primaryAction" style="margin-left: 4px; display: none;">Lưu và cập nhật BĐS yêu cầu</button><button value="submit.Save" name="submit.SaveContinue" type="submit" class="primaryAction" style="margin-left: 4px;">Save &amp; Continue</button>
    

    
        <a id="button-cancel" href="https://dulieunhadat.vn/Admin/RealEstate/Customer" class="button">Cancel</a>
</fieldset>
            </div>
    </div>
</div>

<input id="returnUrl" name="returnUrl" type="hidden" value="https://dulieunhadat.vn/Admin/RealEstate/Customer"><input name="__RequestVerificationToken" type="hidden" value="famNNJZ9NulwpYgX2I9qHE-ui0OHRhWdPlzATupiJJTqoJ7c2KkAUbi7fITy6mG_B-e8lZ1bnXr37h8ZaSJqT-nR5x6beHAF3qIYFPr1PGQ1kpxsjdVUA3HedGPOWEA20"></form></div>