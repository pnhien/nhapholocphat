<!--scripts-->
<div id="content" class="group">
                <div class="zone zone-content">


<style>
    #main {
        min-width: 976px;
    }
</style>

<script type="text/javascript">
    // auto reload a page if there is no activity for 5 minutes on the page
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
                html += '   <div class="error">';
                html += '       <p>' + result['data'] + '</p>';
                html += '   </div>';
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
                html += '   <div class="error">';
                html += '       <p>' + result['data'] + '</p>';
                html += '   </div>';
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
                html += '   <div class="error">';
                html += '       <p>' + result['data'] + '</p>';
                html += '   </div>';
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

function searchBDS(){
    $("#bdsNewsListForm").submit();
}


</script>
<!--PHP code-->
<?php echo $this->Form->create('bdsNewsList', array('id'=>'bdsNewsListForm', 'url' => array ('controller' => 'BdsNewsList', 'action' => ''), 'novalidate' => true)); ?>
    <input id="IsPropertiesWatchList" name="IsPropertiesWatchList" type="hidden" value="False">
    <input id="IsPropertiesExchange" name="IsPropertiesExchange" type="hidden" value="False">
        <div id="tabsAdsType">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/bdsNewsList" ads="ad-selling" typegroup="gp-house" class="ad-selling-gp-house">
                        Nhà đất
                        Bán
                        <span class="count"></span>
                    </a>
                </li>
                <!--<li class="">
                    <a href="https://dulieunhadat.vn/Admin#" ads="ad-leasing" typegroup="gp-house" class="ad-leasing-gp-house">
                        Nhà đất
                        Cho thuê
                        <span class="count"></span>
                    </a>
                </li>
                <li class="">
                    <a href="https://dulieunhadat.vn/Admin#" ads="ad-selling" typegroup="gp-apartment" class="ad-selling-gp-apartment">
                        Căn hộ
                        Bán
                        <span class="count"></span>
                    </a>
                </li>
                <li class="">
                    <a href="https://dulieunhadat.vn/Admin#" ads="ad-leasing" typegroup="gp-apartment" class="ad-leasing-gp-apartment">
                        Căn hộ
                        Cho thuê
                        <span class="count"></span>
                    </a>
                </li>-->
            </ul>
        </div>
    <fieldset>
        <table class="filter-table">
            <tbody>
                <tr>
                    <td class="filter-label">Loại tin</td>
                    <td class="filter-label">Nhóm BĐS</td>
                    <td class="filter-label">Loại BĐS</td>
                    <td class="filter-label">Trạng thái</td>
                    <td class="filter-label">Đánh dấu</td>
                </tr>
                <tr>
                    <td>
                        <select class="select-box" id="id_bdsnews_loai_tin" name="id_bdsnews_loai_tin">                            
                            <?php
                                foreach ($loaiTinlist as $loaiTin){
                            ?>
                            <option 
                                <?php                                     
                                    if($querydata['id_bdsnews_loai_tin'] == $loaiTin['LoaiTin']['TYPE_NEWS_CODE']){
                                        echo 'selected="selected"';
                                    }
                                ?>
                            value="<?php echo $loaiTin['LoaiTin']['TYPE_NEWS_CODE'] ?>"><?php echo $loaiTin['LoaiTin']['TYPE_NEWS_NAME'] ?>
                            </option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="select-box" id="id_bdsnews_nhom_bds" name="id_bdsnews_nhom_bds" placeholder="-- Tất cả nhóm BĐS --">
                            <option value="">-- Tất cả nhóm BĐS --</option>
                            <?php
                                foreach ($nhomBdsList as $nhomBds){
                            ?>
                            <option 
                                <?php                                     
                                    if($querydata['id_bdsnews_nhom_bds'] == $nhomBds['NhomBds']['GROUP_CODE']){
                                        echo 'selected="selected"';
                                    }
                                ?>
                                value="<?php echo $nhomBds['NhomBds']['GROUP_CODE'] ?>"><?php echo $nhomBds['NhomBds']['GROUP_NAME'] ?></option>                           
                            <?php
                                }
                            ?>
                        </select>                        
                    </td>
                    <td>
                        <select class="select-box" id="id_bdsnews_loai_bds" name="id_bdsnews_loai_bds" placeholder="-- Tất cả loại BĐS --">
                            <option value="">-- Tất cả loại BĐS --</option>
                            <?php
                                foreach ($loaiBdsList as $loaiBds){
                            ?>
                            <option 
                                <?php                                     
                                    if($querydata['id_bdsnews_loai_bds'] == $loaiBds['LoaiBds']['LOAI_BDS_CODE']){
                                        echo 'selected="selected"';
                                    }                                    
                                ?>
                                value="<?php echo $loaiBds['LoaiBds']['LOAI_BDS_CODE'] ?>"><?php echo $loaiBds['LoaiBds']['LOAI_BDS_NAME'] ?></option>
                            <?php
                                }
                            ?>
                        </select>                        
                    </td>
                    <td>
                        <select class="select-box" id="id_tinh_trang_code" name="id_tinh_trang_code">
                            <?php
                                foreach ($tinhTranglist as $tinhTrang){
                            ?>
                            <option 
                                <?php 
                                    if($querydata['id_tinh_trang_code'] == $tinhTrang['TinhTrang']['TINH_TRANG_CODE']){
                                        echo 'selected="selected"';
                                    }
                                ?>
                                value="<?php echo $tinhTrang['TinhTrang']['TINH_TRANG_CODE'] ?>"><?php echo $tinhTrang['TinhTrang']['TINH_TRANG_NAME'] ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select class="select-box" id="id_bdsnews_danh_dau" name="id_bdsnews_danh_dau" placeholder="-- Vui lòng chọn --" >
                            <?php
                                foreach ($danhDaulist as $danhDau){
                            ?>
                            <option 
                                <?php 
                                    if(isset($dbsNews['BdsNews']['DANH_DAU_CODE'])){
                                        if($querydata['id_bdsnews_danh_dau'] == $danhDau['DanhDau']['DANH_DAU_CODE']){
                                            echo 'selected="selected"';
                                        }
                                    }
                                ?>
                                value="<?php echo $danhDau['DanhDau']['DANH_DAU_CODE'] ?>"><?php echo $danhDau['DanhDau']['DANH_DAU_NAME'] ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Tìm kiếm cơ bản -->
        <table class="filter-table margin-top-5">
            <tbody>                
                <tr>
                    <td>
                        <div class="controls">
                            <?php 
                                    $option = array();
                                    foreach ($provinceList as $province){
                                            $option[$province['Province']['PROVINCE_CODE']] = $province['Province']['PROVINCE_NAME'];
                                    }
                                    echo $this->Form->select ( '', $option, array(
                                        'id' => 'id_bdsnews_province_code', 
                                        'name' => 'id_bdsnews_province_code',
                                        'class' => 'select-box',
                                        'onChange' => 'fnc_doGetDistricts();',
                                        'value' => $querydata['id_bdsnews_province_code']
                                    ));
                                ?>
                        </div>
                    </td>
                    <td>
                        <div class="controls">
                            <?php 
                                $option = array();
                                foreach ($districtList as $district){
                                        $option[$district['District']['DISTRICT_CODE']] = $district['District']['DISTRICT_NAME'];
                                }
                                echo $this->Form->select ( '', $option, array(
                                    'id' => 'id_bdsnews_district_code', 
                                    'name' => 'id_bdsnews_district_code',
                                    'class' => 'select-box',
                                    'onChange' => 'fnc_doGetWards();',
                                    'value' => $querydata['id_bdsnews_district_code']
                                ));
                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="controls">
                            <?php 
                                    $option = array();
                                    foreach ($wardList as $ward){
                                            $option[$ward['Ward']['WARD_CODE']] = $ward['Ward']['WARD_NAME'];
                                    }
                                    echo $this->Form->select ( '', $option, array(
                                        'id' => 'id_bdsnews_ward_code', 
                                        'name' => 'id_bdsnews_ward_code',
                                        'class' => 'select-box',
                                        'onChange' => 'fnc_doGetStreets();',
                                        'value' => $querydata['id_bdsnews_ward_code']
                                    ));
                                ?>
                        </div>
                    </td>
                    <td>
                        <div class="controls">
                            <?php 
                                    $option = array();
                                    foreach ($streetList as $street){
                                            $option[$street['Street']['STREET_CODE']] = $street['Street']['STREET_NAME'];
                                    }
                                    echo $this->Form->select ( '', $option, array(
                                        'id' => 'id_bdsnews_street_code', 
                                        'name' => 'id_bdsnews_street_code',
                                        'class' => 'select-box',
                                        'onChange' => 'fnc_makeAddress();',
                                        'value' => $querydata['id_bdsnews_street_code']
                                    ));                                    
                                ?>
                        </div>
            </div>
                    </td>
                    <td>
                        <input class="text text-box" id="id_bdsnews_address_number" name="id_bdsnews_address_number" placeholder="Số nhà" type="text" value="<?php echo $querydata['id_bdsnews_address_number']?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="text number-box" id="id_bdsnews_min_price" name="id_bdsnews_min_price" placeholder="Giá từ" type="text" value="<?php echo $querydata['id_bdsnews_min_price']?>">
                        <input class="text number-box" id="id_bdsnews_max_price" name="id_bdsnews_max_price" placeholder="đến" type="text" value="<?php echo $querydata['id_bdsnews_max_price']?>">
                        <?php 
                        $option = array();
								foreach ($loaiTienList as $loaiTien){
										$option[$loaiTien['LoaiTien']['LOAI_TIEN_CODE']] = $loaiTien['LoaiTien']['LOAI_TIEN_NAME'];
								}
								echo $this->Form->select ( '', $option, array(
									'id' => 'id_bdsnews_loai_tien_code', 
									'name' => 'data[BdsNews][LOAI_TIEN_CODE]',
									'class' => 'select-box',
									'value' => $querydata['id_bdsnews_loai_tien_code']
								));
                        ?>
                        <select class="" id="id_bdsnews_tong_dien_tich" name="id_bdsnews_tong_dien_tich" style="width:112px; display: none">
                            <option selected="selected" value="unit-total">Tổng diện tích</option>
                            <option value="unit-m2">m2</option>
                        </select>
                    </td>

                    <!-- gp-apartment -->
                        <td></td>
                        <td></td>
                    <td>                        
                        <input class="text text-box" id="id_bdsnews_ngo_ngach" name="id_bdsnews_ngo_ngach" placeholder="Ngõ / Ngách" type="text" value="<?php echo $querydata['id_bdsnews_ngo_ngach']?>">
                    </td>
                </tr>
                <!--<tr>
                    <td>
                        <a href="https://dulieunhadat.vn/Admin#" class="advance-search-trigger"><span class="ui-icon icon-expand"></span> Tìm kiếm nâng cao</a>
                    </td>
                    <td class="filter-label">
                        <select class="select-box" id="LocationCssClass" name="LocationCssClass">
                            <option value="">-- Nhà MT / Hẻm --</option>
                            <option value="h-front">Mặt tiền</option>
                            <option value="h-alley">Trong hẻm</option>
                        </select>
                    </td>
                    <td>
                        <div class="ui-dropdown-checkbox-wrapper">
                            <div class="ui-dropdown-checkbox">
                                <label style="text-align: center;">Chi tiết tin rao</label>
                                <table class="noborder-table">
                                    <tbody><tr>
                                        <td>
                                            
                                            <label><input id="AdsNormal" name="AdsNormal" type="checkbox" value="true"><input name="AdsNormal" type="hidden" value="false">Tin thường</label>
                                            <label><input id="AdsGoodDeal" name="AdsGoodDeal" type="checkbox" value="true"><input name="AdsGoodDeal" type="hidden" value="false"><span title="BĐS giá rẻ" class="icon-ads-hot"></span> BĐS giá rẻ</label>
                                            
                                            <label><input id="AdsVIP1" name="AdsVIP1" type="checkbox" value="true"><input name="AdsVIP1" type="hidden" value="false"><span title="BĐS VIP 1" class="icon-ads-vip-3"></span> BĐS VIP 1</label>
                                            <label><input id="AdsVIP2" name="AdsVIP2" type="checkbox" value="true"><input name="AdsVIP2" type="hidden" value="false"><span title="BĐS VIP 2" class="icon-ads-vip-2"></span> BĐS VIP 2</label>
                                            <label><input id="AdsVIP3" name="AdsVIP3" type="checkbox" value="true"><input name="AdsVIP3" type="hidden" value="false"><span title="BĐS VIP 3" class="icon-ads-vip-1"></span> BĐS VIP 3</label>
                                            <label class="hidden"><input id="AdsHighlightRequest" name="AdsHighlightRequest" type="checkbox" value="true"><input name="AdsHighlightRequest" type="hidden" value="false"><span title="BĐS nổi bật" class="icon-ads-vip"></span> BĐS nổi bật</label>
                                            <label class="hidden"><input id="AdsGoodDealRequest" name="AdsGoodDealRequest" type="checkbox" value="true"><input name="AdsGoodDealRequest" type="hidden" value="false"><span title="BĐS giá rẻ" class="icon-ads-hot"></span> BĐS giá rẻ</label>
                                            <label class="hidden"><input id="AdsVIPRequest" name="AdsVIPRequest" type="checkbox" value="true"><input name="AdsVIPRequest" type="hidden" value="false"><span title="BĐS giao dịch gấp" class="icon-ads-vip"></span> BĐS giao dịch gấp</label>
                                            <label class="hidden"><input id="AdsRequest" name="AdsRequest" type="checkbox" value="true"><input name="AdsRequest" type="hidden" value="false"><span title="BĐS đăng quảng cáo" class="icon-ads-vip"></span> BĐS đăng quảng cáo</label>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <label><input id="IsAuthenticatedInfo" name="IsAuthenticatedInfo" type="checkbox" value="true"><input name="IsAuthenticatedInfo" type="hidden" value="false"><span class="ui-icon icon-check"></span> BĐS đã xác thực</label>
                                            <label><input id="AdsExpired" name="AdsExpired" type="checkbox" value="true"><input name="AdsExpired" type="hidden" value="false"><span title="BĐS hết hạn trên trang chủ" class="ui-icon icon-label-red" style="margin-bottom:-3px;"></span> Hết hạn đăng tin</label>
                                            <label><input id="AdsNotExpired" name="AdsNotExpired" type="checkbox" value="true"><input name="AdsNotExpired" type="hidden" value="false"><span title="BĐS đang hiện trên trang chủ" class="ui-icon icon-label-green" style="margin-bottom:-3px;"></span> Đang hiển thị</label>
                                            <label><input id="PublishAddress" name="PublishAddress" type="checkbox" value="true"><input name="PublishAddress" type="hidden" value="false">Hiện địa chỉ</label>
                                            <label><input id="PublishContact" name="PublishContact" type="checkbox" value="true"><input name="PublishContact" type="hidden" value="false">Hiện liên hệ</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><hr></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label></label>
                                            <label><input id="NoBroker" name="NoBroker" type="checkbox" value="true"><input name="NoBroker" type="hidden" value="false">Miễn trung gian</label>
                                            <label><input id="IsAuction" name="IsAuction" type="checkbox" value="true"><input name="IsAuction" type="hidden" value="false">BĐS phát mãi</label>
                                            
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <label><input id="ShowNeedUpdate" name="ShowNeedUpdate" type="checkbox" value="true"><input name="ShowNeedUpdate" type="hidden" value="false">BĐS cần cập nhật</label>
                                            <label><input id="ShowExcludedInEstimation" name="ShowExcludedInEstimation" type="checkbox" value="true"><input name="ShowExcludedInEstimation" type="hidden" value="false">BĐS loại khỏi định giá</label>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><hr></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            
                                            <label><input id="IsSoldByGroup" name="IsSoldByGroup" type="checkbox" value="true"><input name="IsSoldByGroup" type="hidden" value="false">Được bán bởi Group</label>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <label><input id="UseAccurateSearch" name="UseAccurateSearch" type="checkbox" value="true"><input name="UseAccurateSearch" type="hidden" value="false">Tìm kiếm chính xác</label>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div>
                        </div>
                    </td>
                    <td><input class="text text-box" id="ContactPhone" name="ContactPhone" placeholder="Liên hệ" type="text" value=""></td>
                    <td><input class="text text-box" id="IdStr" name="IdStr" placeholder="ID Mã tin" type="text" value=""></td>
                </tr>-->
            </tbody>
        </table>

        <div class="property-form-group-search">
            <div class="advance-search-right">
                <table class="filter-table">
                    <tbody>
                        <tr>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- Tìm kiếm nâng cao -->
        
    </fieldset>
    <fieldset class="bulk-actions left">
        <label for="Order">Sắp xếp theo:</label>
        <select id="id_bdsnews_order_by" name="id_bdsnews_order_by">
            <option <?php if($querydata['id_bdsnews_order_by']== 'LastUpdatedDate') echo "selected=selected" ?> value="LastUpdatedDate">Ngày sửa lần cuối</option>
            <option <?php if($querydata['id_bdsnews_order_by']== 'AddressNumber') echo "selected=selected" ?> value="AddressNumber">Số nhà</option>
            <option <?php if($querydata['id_bdsnews_order_by']== 'PriceProposedInVND') echo "selected=selected" ?> value="PriceProposedInVND">Giá rao</option>
        </select>

        <button type="button" name="btnSearch" onClick="searchBDS();">Tìm kiếm</button>
        Tìm được <strong><?php echo count($data) ?></strong> kết quả
    </fieldset>
    <fieldset style="float:left">
        <table class="items fixed-table float-header">
            <thead>
                <tr>
                    <th scope="col" class="w20 align-center"><input class="selectAll" type="checkbox" value="Properties"></th>
                    <th scope="col" class="w58">Id</th>
                    <th scope="col" class="w60">Giá (Tỷ)</th>
                    <th scope="col" class="w74">Số nhà</th>
                    <th scope="col" class="w130">Đường</th>
                    <th scope="col" class="w46">Phường</th>
                    <th scope="col" class="w36">Quận</th>
                    <th scope="col">Diện tích</th>
                    <th scope="col" class="w78">Nhà</th>
                    <th scope="col" class="w20">Hg</th>
                    <th scope="col" class="w58">MT/H</th>
                    <th scope="col" class="w30">LH</th>
                    <th scope="col" class="w30">Ng</th>
                    <th scope="col" class="w52">Ngày</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($data==NULL){
                    echo "<h2>Dada Empty</h2>";
                } else{
                    $idx = 0;
                    foreach($data as $item){
                ?>
                    <tr data-id="<?php $item['BdsNews']['BDSNEWS_ID']?>" class=" ">
                        <td class="align-center">
                            <input type="hidden" value="<?php echo $item['BdsNews']['BDSNEWS_ID']?>" name="Properties[<?php echo $idx ?>].Property.Id">
                            <input type="checkbox" value="true" name="Properties[<?php echo $idx ?>].IsChecked">
                            <div>
                                <span title="Lưu vào danh sách theo dõi" class="ui-icon icon-save pointer follow-property " data-id="<?php echo $item['BdsNews']['BDSNEWS_ID']?>"></span>
                                <span title="Xóa khỏi danh sách theo dõi" class="ui-icon icon-cross pointer unfollow-property hidden" data-id="<?php echo $item['BdsNews']['BDSNEWS_ID']?>"></span>
                            </div>
                        </td>
                        <td>
                            <!-- Published -->
                                <a href="<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/newsList?type=1">
                                <a href="<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/bdsNews?id=<?php echo $item['BdsNews']['BDSNEWS_ID'];?>" title="Xem trên web" target="_blank">
                                        <span title="BĐS đang hiện trên trang chủ" class="left ui-icon icon-label-green" style="margin-top:3px;"></span>
                                </a>
                            <!-- ID -->
                            <span class="">
                                <a class="p-id" href="<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/bdsNews?id=<?php echo $item['BdsNews']['BDSNEWS_ID']; ?>"><?php echo $item['BdsNews']['BDSNEWS_ID']; ?></a>
                            </span>
                            <!-- UserGroup -->
                                <div><small class="small"><?php echo $item['District']['DISTRICT_NAME']; ?></small></div>
                            <!-- AdsVIPRequest -->                            
                        </td>
                        <!-- PriceProposedInVND -->
                        <td class="deal-normal">
                            <!--<?php echo $item['BdsNews']['GIA_RAO'] . $item['BdsNews']['DON_VI_TIEN_ID']; ?>-->
                            <?php echo $item['BdsNews']['GIA_RAO'] ?>
                            <span data-toggle="tooltip"></span>
                            <div data-tooltip-content="" style="display:none">
                                <div><em><strong>Giá rao:</strong></em> <?php echo $item['BdsNews']['GIA_RAO'] . '/ Tổng DT'; ?></div>
                                <div><em><strong>Định giá:</strong></em><?php echo $item['BdsNews']['GIA_DU_KIEN']; ?></div>
                            </div>
                        </td>
                        <!-- PriceEstimatedInVND -->
                        <!-- PriceEstimatedInVND Rating -->
                        <!-- AddressNumber -->
                        <td class="st-selling"><?php echo $item['BdsNews']['SO_NHA']; ?>
                                <!-- PublishAddress -->
                                <!-- Status -->
                                <span class="small"></span>
                                <!-- Gallery -->
                                <!-- AddressCorner -->
                                <!-- ApartmentNumber -->
                        </td>
                        <!-- Street -->                        
                        <td><?php echo $item['Street']['STREET_NAME']; ?></td>
                        <!-- Ward -->
                        <td><?php echo $item['Ward']['WARD_NAME']; ?></td>
                        <!-- District -->
                        <td><?php echo $item['District']['DISTRICT_NAME']; ?></td>
                        <!-- Area -->
                        <td>
                            <div>DTKV: (<?php echo $item['BdsNews']['DIEN_TICH_RONG'];?>m x <?php echo $item['BdsNews']['DIEN_TICH_DAI']?> m)<br>
                                 DTQH: (<?php echo $item['BdsNews']['DIEN_TICH_QH_RONG'];?>m x <?php echo $item['BdsNews']['DIEN_TICH_QH_DAI']?> m)
                                    <?php 
                                    if($item['BdsNews']['BDS_NOTE'] != NULL){
                                    ?>
                                        <a href="<?php echo RwsConstant::FULL_BASE_URL_HOST . '/bdsNewsList#'; ?>" data-toggle="tooltip"></a>
                                        <div data-tooltip-content="" style="display:none">
                                            <div>
                                                <!-- Title -->                                     
                                                <!-- Content -->
                                                <div><em><strong>Nội dung:</strong></em> <p><?php echo $item['BdsNews']['BDS_NOTE']; ?></p></div>
                                                <!-- Advantages -->                                    
                                            </div>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                             </div>
                            <!-- Title -->
                            <!-- Content -->
                            <!-- Advantages -->
                        </td>
                        <!-- PropertyType -->
                        <td>
                            <?php //echo $item['LoaiBds']['LOAI_BDS_NAME']; ?>
                        </td>
                        <!-- Direction -->
                        <td><?php echo $item['Huong']['HUONG_NAME']; ?></td>
                        <!-- Location -->
                        <td>
                            <span data-toggle="tooltip" title="<?php echo $item['BdsNews']['KHOAN_CACH_DUONG_CHINH']; ?>"><?php echo $item['BdsNews']['KHOAN_CACH_DUONG_CHINH']; ?></span>
                        </td>
                        <!-- ContactPhone -->
                        <td class="nowrap">
                            <!-- PublishContact -->
                            <!-- ContactPhone -->
                            <div data-toggle="tooltip" title="<?php echo $item['BdsNews']['TEN_DIEN_THOAI']; ?><div></div><div class=color-note></div>"><?php echo $item['BdsNews']['TEN_LIEN_HE']; ?></div>
                        </td>
                        <!-- UserInfo -->
                        <td class="nowrap">
                            <div data-toggle="tooltip"><?php echo $item['BdsNews']['LIEN_HE_DOC_QUYEN']; ?></div>
                            <div data-tooltip-content="" style="display:none">
                                <div><em><strong>Nguồn gần nhất:</strong> <?php echo $item['BdsNews']['USER_UPDATE']; ?> - <strong>Sửa bởi:</strong> <?php echo $item['BdsNews']['USER_UPDATE']; ?> ngày <?php echo $item['BdsNews']['UPDATE_YMD']; ?></em></div>
                                <div><em><strong>Nguồn đầu tiên:</strong> <?php echo $item['BdsNews']['USER_CREATE']; ?> - <strong>Tạo bởi:</strong> <?php echo $item['BdsNews']['USER_CREATE']; ?> ngày <?php echo $item['BdsNews']['CREATE_YMD']; ?></em></div>
                            </div>
                        </td>
                        <!-- Date -->
                        <td>
                            <!-- Date -->
                            <span><?php echo $item['BdsNews']['CREATE_YMD'] ?></span>
                            <!-- AdsHighlight -->
                            <!-- AdsGoodDeal -->
                            <!-- AdsVIP -->
                        </td>
                    </tr>   
                    <?php
                        $idx++;
                    }
                }
                ?>                 
            </tbody>
        </table>
        <div class="floatHeader" style="display:none">
        <table class="items fixed-table float-header" style="width: 1017px;">
            <thead>
                <tr>
                    <th scope="col" class="w20 align-center" style="width: 19px;">
                        <input class="selectAll" type="checkbox" value="Properties">
                    </th>
                    <th scope="col" class="w58" style="width: 57px;">Id</th>
                    <th scope="col" class="w60" style="width: 39px;">Giá (Tỷ)</th>
                    <th scope="col" class="w74" style="width: 53px;">Số nhà</th>
                    <th scope="col" class="w130" style="width: 129px;">Đường</th>
                    <th scope="col" class="w46" style="width: 45px;">Phường</th>
                    <th scope="col" class="w36" style="width: 35px;">Quận</th>
                    <th scope="col" style="width: 199px;">Diện tích</th>
                    <th scope="col" class="w78" style="width: 77px;">Nhà</th>
                    <th scope="col" class="w20" style="width: 19px;">Hg</th>
                    <th scope="col" class="w58" style="width: 57px;">MT/H</th>
                    <th scope="col" class="w30" style="width: 29px;">LH</th>
                    <th scope="col" class="w30" style="width: 29px;">Ng</th>
                    <th scope="col" class="w52" style="width: 51px;">Ngày</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="floatHeader" style="position: fixed; top: 0px; left: 285px;">
        <table class="items fixed-table float-header" style="width: 1017px;">
            <thead>
                <tr>
                    <th scope="col" class="w20 align-center" style="width: 19px;">
                        <input class="selectAll" type="checkbox" value="Properties">
                    </th>
                    <th scope="col" class="w58" style="width: 57px;">Id</th>
                    <th scope="col" class="w60" style="width: 59px;">Giá (Tỷ)</th>
                    <th scope="col" class="w74" style="width: 73px;">Số nhà</th>
                    <th scope="col" class="w130" style="width: 129px;">Đường</th>
                    <th scope="col" class="w46" style="width: 45px;">Phường</th>
                    <th scope="col" class="w36" style="width: 35px;">Quận</th>
                    <th scope="col" style="width: 199px;">Diện tích</th>
                    <th scope="col" class="w78" style="width: 77px;">Nhà</th>
                    <th scope="col" class="w20" style="width: 19px;">Hg</th>
                    <th scope="col" class="w58" style="width: 57px;">MT/H</th>
                    <th scope="col" class="w30" style="width: 29px;">LH</th>
                    <th scope="col" class="w30" style="width: 29px;">Ng</th>
                    <th scope="col" class="w52" style="width: 51px;">Ngày</th>
                </tr>
            </thead>
        </table>
        <div class="floatHeader" style="display:none">
            <table class="items fixed-table float-header" style="width: 1015px;">
                <thead>
                    <tr> 
                        <th scope="col" class="w20 align-center" style="width: 19px;">
                            <input class="selectAll" type="checkbox" value="Properties">
                        </th>
                        <th scope="col" class="w58" style="width: 57px;">Id</th>
                        <th scope="col" class="w60" style="width: 59px;">Giá (Tỷ)</th>
                        <th scope="col" class="w74" style="width: 73px;">Số nhà</th>
                        <th scope="col" class="w130" style="width: 130px;">Đường</th>
                        <th scope="col" class="w46" style="width: 45px;">Phường</th>
                        <th scope="col" class="w36" style="width: 35px;">Quận</th>
                        <th scope="col" style="width: 201px;">Diện tích</th>
                        <th scope="col" class="w78" style="width: 77px;">Nhà</th>
                        <th scope="col" class="w20" style="width: 18px;">Hg</th>
                        <th scope="col" class="w58" style="width: 56px;">MT/H</th>
                        <th scope="col" class="w30" style="width: 28px;">LH</th>
                        <th scope="col" class="w30" style="width: 28px;">Ng</th>
                        <th scope="col" class="w52" style="width: 50px;">Ngày</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>        

    <div class="pager-footer">
            <!-- class="page-size-options group">                
                <?php
                    echo $this->Paginator->prev('« Previous ', null, null, array('class' => 'disabled')); //Hiện thj nút Previous
                    echo " | ".$this->Paginator->numbers()." | "; //Hiển thi các số phân trang
                    echo $this->Paginator->next(' Next »', null, null, array('class' => 'disabled')); //Hiển thị nút next
                    echo " Page ".$this->Paginator->counter(); // Hiển thị tổng trang
                ?>
            </div>-->            
            <span class="page-results">Showing items 1 - 20 of 66</span>
    </div>


    </fieldset>
</form>