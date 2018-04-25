<!--scripts-->
<div id="content" class="group">
                <div class="zone zone-content">


<style>
    #main {
        min-width: 976px;
    }
    img {
        height: auto;
        width: 100px;
        display: none
    }
    .hover-me:hover img {  
        display: block;
    }
    button, .button, a.button {
    background:#6a7b42;
    border:1px solid #487328;
    color:#fff;
    cursor: pointer;
    display: inline-block;
    font: 12px Arial,Helvetica,sans-serif;
    padding: 5px 14px 5px 14px;

    /*position: relative;*/
    text-align: center;
    text-decoration: none;

    /*----CSS3 properties----*/
     text-shadow: rgba(40,53,9,.2) 0px 0px 1px;
    -webkit-box-shadow: inset 0px 0px 1px rgba(255, 255, 255, 1.0), 1px 1px 1px rgba(102, 102, 102, 0.2);
    -moz-box-shadow: inset 0px 0px 1px rgba(255, 255, 255, 1.0), 1px 1px 1px rgba(102, 102, 102, 0.2);
     box-shadow: inset 0px 0px 1px rgba(255, 255, 255, 1.0), 1px 1px 1px rgba(102, 102, 102, 0.2);


    /*----In ie the first couplet sets the alpha value so 00=transparent and ff=opaque)----*/
     filter:progid:DXImageTransform.Microsoft.Gradient(GradientType=0, startColorstr='#ff9bb36c',  endColorstr='#ff809f43');
     background: -webkit-gradient(linear, 0 0, 0 100%, from(rgba(155, 179, 108, 1.0)), to(rgba(128, 159, 67, 1.0)));
     background: -moz-linear-gradient(top, rgba(155, 179, 108, 1.0), rgba(128, 159, 67, 1.0));

     /*test - base green in pallet is 155,179,108*/
     background: -moz-linear-gradient(top, rgba(155, 179, 108, 1.0), rgba(133, 154, 93, 1.0));

    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
     border-radius: 2px;
    }
</style>

<script type="text/javascript">
function showHideAdvanceSearch(){
    $('#tblAdvanceSearch').show();
};
    // auto reload a page if there is no activity for 5 minutes on the page
function fnc_doGetDistricts() {
    $('#id_div_flash').empty().hide();
    $('#id_div_error').empty().hide();

    var province_code = $('#id_bdsnews_province_code').val();
    alert(province_code);
    console.log('got provinceocde:' + province_code);
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
    if(district_code != ''){
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
    } else{
        $('#id_bdsnews_ward_code option').remove();
        $('#id_bdsnews_street_code option').remove();
    }
    
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
                                   if($querydata['id_bdsnews_danh_dau'] == $danhDau['DanhDau']['DANH_DAU_CODE']){
                                        echo 'selected="selected"';
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
									'name' => 'id_bdsnews_loai_tien_code',
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
                <tr>
                    <td>
                        <button class="advance-search-trigger" onclick="showHideAdvanceSearch()">Tìm kiếm nâng cao</button>
                    </td>
                    <td class="filter-label">
                        <select class="select-box" id="LocationCssClass" name="LocationCssClass">
                            <option value="">-- Nhà MT / Hẻm --</option><option value="h-front">Mặt tiền</option>
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
                </tr>
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
        <table id="tblAdvanceSearch" class="filter-table" style="display: none;">
            <tbody>
                <!-- gp-house -->
                <tr>
                    <td class="filter-label">Chiều ngang</td>
                    <td><input class="text number-box" id="MinAreaTotalWidth" name="MinAreaTotalWidth" type="text" value=""> đến <input class="text number-box" id="MaxAreaTotalWidth" name="MaxAreaTotalWidth" type="text" value=""> m</td>
                    <td class="filter-label">Chiều sâu</td>
                    <td><input class="text number-box" id="MinAreaTotalLength" name="MinAreaTotalLength" type="text" value=""> đến <input class="text number-box" id="MaxAreaTotalLength" name="MaxAreaTotalLength" type="text" value=""> m</td>
                    <td class="filter-label">Số lầu</td>
                    <td>
                        <input class="text number-box" id="MinFloors" name="MinFloors" type="text" value=""> đến <input class="text number-box" id="MaxFloors" name="MaxFloors" type="text" value="">
                    </td>
                </tr>
                <tr>
                    <td class="filter-label">DTKV từ &nbsp;</td>
                    <td>
                        <input class="text number-box" id="MinAreaTotal" name="MinAreaTotal" type="text" value=""> đến <input class="text number-box" id="MaxAreaTotal" name="MaxAreaTotal" type="text" value=""> m<sup>2</sup>
                    </td>
                    <td class="filter-label">Hẻm rộng</td>
                    <td><input class="text number-box" id="MinAlleyWidth" name="MinAlleyWidth" type="text" value=""> đến <input class="text number-box" id="MaxAlleyWidth" name="MaxAlleyWidth" type="text" value=""> m</td>
                    <td class="filter-label">Số lần rẽ</td>
                    <td><input class="text number-box" id="MinAlleyTurns" name="MinAlleyTurns" type="text" value=""> đến <input class="text number-box" id="MaxAlleyTurns" name="MaxAlleyTurns" type="text" value=""></td>
                    <td class="filter-label">KcMT</td>
                    <td><input class="text number-box" id="MinDistanceToStreet" name="MinDistanceToStreet" type="text" value=""> đến <input class="text number-box" id="MaxDistanceToStreet" name="MaxDistanceToStreet" type="text" value=""> m</td>
                </tr>
                <!-- gp-apartment -->
                <tr>
                    <td class="filter-label">Hướng</td>
                    <td>
                        <select class="select-box multiselect" id="DirectionCssClasses" multiple="multiple" name="DirectionCssClasses" placeholder="-- Hướng --" style="display: none;"><option value="d-east">Ðông</option>
                            <option value="d-west">Tây</option>
                            <option value="d-south">Nam</option>
                            <option value="d-north">Bắc</option>
                            <option value="d-northeast">Đông Bắc</option>
                            <option value="d-southeast">Đông Nam</option>
                            <option value="d-northwest">Tây Bắc</option>
                            <option value="d-southwest">Tây Nam</option>
                        </select>
                        <div class="btn-group form-control"><button type="button" class="multiselect dropdown-toggle text-left text-ellipsis placeholder" data-toggle="dropdown" title="" style="width: 100%;">-- Hướng -- <b class="caret"></b></button><ul class="multiselect-container dropdown-menu"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span><input class="multiselect-search form-control input-sm" type="text" placeholder="Tìm kiếm..."></div><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="d-east"> Ðông</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="d-west"> Tây</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="d-south"> Nam</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="d-north"> Bắc</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="d-northeast"> Đông Bắc</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="d-southeast"> Đông Nam</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="d-northwest"> Tây Bắc</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="d-southwest"> Tây Nam</label></a></li></ul></div>
                    </td>
                    <td class="filter-label">Pháp lý</td>
                    <td>
                        <select class="select-box" id="LegalStatusId" name="LegalStatusId"><option value="">-- Tất cả --</option>
                            <option value="41">Sổ hồng</option>
                            <option value="42">Sổ đỏ</option>
                            <option value="43">Mẫu chủ quyền cũ</option>
                            <option value="143053">Hợp đồng mua bán</option>
                            <option value="45">Hợp đồng góp vốn</option>
                            <option value="46">Đang hợp thức hóa</option>
                            <option value="143056">Giấy xác nhân Phường, Xã</option>
                            <option value="47">Hợp đồng thuê dài hạn</option>
                            <option value="48">Tờ khai nhà đất</option>
                            <option value="49">Không có chủ quyền</option>
                            <option value="50">Giấy tay tự lập</option>
                            <option value="44">Giấy tờ hợp lệ khác</option>
                        </select>
                    </td>
                    <td class="filter-label">Số PN</td>
                    <td><input class="text number-box" id="MinBedrooms" name="MinBedrooms" type="text" value=""> đến <input class="text number-box" id="MaxBedrooms" name="MaxBedrooms" type="text" value=""></td>
                    <td class="filter-label">Số WC</td>
                    <td><input class="text number-box" id="MinBathrooms" name="MinBathrooms" type="text" value=""> đến <input class="text number-box" id="MaxBathrooms" name="MaxBathrooms" type="text" value=""></td>
                </tr>
                <tr>
                    <td class="filter-label">Đặc điểm tốt</td>
                    <td>
                        <select class="select-box multiselect" id="AdvantageIds" multiple="multiple" name="AdvantageIds" placeholder="-- Vui lòng chọn --" style="display: none;"><option value="85728">Có 2 mặt đường chính</option>
                            <option value="85729">Căn góc, có hẻm bên hông</option>
                            <option value="85730">Có hẻm sau nhà</option>
                            <option value="85732">Gần chợ, siêu thị (&lt;500m)</option>
                            <option value="85733">Gần công viên, trung tâm giải trí (&lt;500m)</option>
                            <option value="85734">Khu dân cư cao cấp có cổng bảo vệ</option>
                            <option value="85735">Vị trí đẹp nhất trong đoạn đường</option>
                            <option value="85736">Tiện làm quán cafe, nhà hàng, khách sạn</option>
                            <option value="85794">Hẻm thông ra đường khác đẹp hơn.</option>
                        </select>
                    <div class="btn-group form-control"><button type="button" class="multiselect dropdown-toggle text-left text-ellipsis placeholder" data-toggle="dropdown" title="" style="width: 100%;">-- Vui lòng chọn -- <b class="caret"></b></button><ul class="multiselect-container dropdown-menu"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span><input class="multiselect-search form-control input-sm" type="text" placeholder="Tìm kiếm..."></div><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85728"> Có 2 mặt đường chính</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85729"> Căn góc, có hẻm bên hông</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85730"> Có hẻm sau nhà</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85732"> Gần chợ, siêu thị (&lt;500m)</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85733"> Gần công viên, trung tâm giải trí (&lt;500m)</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85734"> Khu dân cư cao cấp có cổng bảo vệ</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85735"> Vị trí đẹp nhất trong đoạn đường</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85736"> Tiện làm quán cafe, nhà hàng, khách sạn</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85794"> Hẻm thông ra đường khác đẹp hơn.</label></a></li></ul></div>
                    </td>
                    <td class="filter-label">Ngày tạo</td>
                    <td colspan="3">
                        <input class="text date-box hasDatepicker" id="CreatedFrom" name="CreatedFrom" type="text" value=""> đến <input class="text date-box hasDatepicker" id="CreatedTo" name="CreatedTo" type="text" value="">
                        <div class="select2-container text text-box" id="s2id_CreatedUserId"><a href="javascript:void(0)" class="select2-choice select2-default" tabindex="-1">   <span class="select2-chosen" id="select2-chosen-1">-- Tạo bởi --</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen1" class="select2-offscreen"></label><input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-1" id="s2id_autogen1"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen1_search" class="select2-offscreen"></label>       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-1" id="s2id_autogen1_search" placeholder="">   </div>   <ul class="select2-results" role="listbox" id="select2-results-1">   </ul></div></div><div class="select2-container text text-box" id="s2id_CreatedUserId" title="" style="display: none;"><a href="javascript:void(0)" class="select2-choice select2-default" tabindex="-1">   <span class="select2-chosen" id="select2-chosen-1">-- Tạo bởi --</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen1" class="select2-offscreen"></label><input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-1" id="s2id_autogen1" tabindex="-1"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen1_search" class="select2-offscreen"></label>       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-1" id="s2id_autogen1_search" placeholder="">   </div>   <ul class="select2-results" role="listbox" id="select2-results-1">   </ul></div></div><input class="text text-box select2-user select2-group-user" group="1580848" id="CreatedUserId" name="CreatedUserId" placeholder="-- Tạo bởi --" type="text" value="" tabindex="-1" title="" style="display: none;">
                    </td>
                    <td class="filter-label">Nguồn</td>
                    <td><div class="select2-container text text-box" id="s2id_FirstInfoFromUserId"><a href="javascript:void(0)" class="select2-choice select2-default" tabindex="-1">   <span class="select2-chosen" id="select2-chosen-2">-- Nguồn --</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen2" class="select2-offscreen"></label><input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-2" id="s2id_autogen2"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen2_search" class="select2-offscreen"></label>       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-2" id="s2id_autogen2_search" placeholder="">   </div>   <ul class="select2-results" role="listbox" id="select2-results-2">   </ul></div></div><div class="select2-container text text-box" id="s2id_FirstInfoFromUserId" title="" style="display: none;"><a href="javascript:void(0)" class="select2-choice select2-default" tabindex="-1">   <span class="select2-chosen" id="select2-chosen-2">-- Nguồn --</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen2" class="select2-offscreen"></label><input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-2" id="s2id_autogen2" tabindex="-1"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen2_search" class="select2-offscreen"></label>       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-2" id="s2id_autogen2_search" placeholder="">   </div>   <ul class="select2-results" role="listbox" id="select2-results-2">   </ul></div></div><input class="text text-box select2-user select2-group-user" group="1580848" id="FirstInfoFromUserId" name="FirstInfoFromUserId" placeholder="-- Nguồn --" type="text" value="" tabindex="-1" title="" style="display: none;"></td>
                </tr>
                <tr>
                    <td class="filter-label">Đặc điểm xấu</td>
                    <td>
                        <select class="select-box multiselect" id="DisAdvantageIds" multiple="multiple" name="DisAdvantageIds" placeholder="-- Vui lòng chọn --" style="display: none;"><option value="85737">Đường, hẻm đâm thẳng vào nhà</option>
                            <option value="85738">Đối diện hoặc gần sát chùa, nhà thờ</option>
                            <option value="85739">Đối diện hoặc gần sát nhà tang lễ, nhà xác</option>
                            <option value="85740">Dưới chân cầu hoặc dưới đường dây điện cao thế</option>
                            <option value="85741">Có cống trước nhà</option>
                            <option value="85742">Có trụ điện trước nhà</option>
                            <option value="85743">Có cây lớn trước nhà</option>
                            <option value="85744">Không cho xây hoặc không thể xây mới</option>
                            <option value="85745">Bị quy hoạch treo</option>
                        </select>
                        <div class="btn-group form-control"><button type="button" class="multiselect dropdown-toggle text-left text-ellipsis placeholder" data-toggle="dropdown" title="" style="width: 100%;">-- Vui lòng chọn -- <b class="caret"></b></button><ul class="multiselect-container dropdown-menu"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span><input class="multiselect-search form-control input-sm" type="text" placeholder="Tìm kiếm..."></div><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85737"> Đường, hẻm đâm thẳng vào nhà</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85738"> Đối diện hoặc gần sát chùa, nhà thờ</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85739"> Đối diện hoặc gần sát nhà tang lễ, nhà xác</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85740"> Dưới chân cầu hoặc dưới đường dây điện cao thế</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85741"> Có cống trước nhà</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85742"> Có trụ điện trước nhà</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85743"> Có cây lớn trước nhà</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85744"> Không cho xây hoặc không thể xây mới</label></a></li><li><a href="javascript:void(0);"><label class="checkbox"><input type="checkbox" value="85745"> Bị quy hoạch treo</label></a></li></ul></div>
                    </td>
                    <td class="filter-label">Ngày sửa cuối</td>
                    <td colspan="3">
                        <input class="text date-box hasDatepicker" id="LastUpdatedFrom" name="LastUpdatedFrom" type="text" value=""> đến <input class="text date-box hasDatepicker" id="LastUpdatedTo" name="LastUpdatedTo" type="text" value="">
                        <div class="select2-container text text-box" id="s2id_LastUpdatedUserId"><a href="javascript:void(0)" class="select2-choice select2-default" tabindex="-1">   <span class="select2-chosen" id="select2-chosen-3">-- Sửa bởi --</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen3" class="select2-offscreen"></label><input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-3" id="s2id_autogen3"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen3_search" class="select2-offscreen"></label>       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-3" id="s2id_autogen3_search" placeholder="">   </div>   <ul class="select2-results" role="listbox" id="select2-results-3">   </ul></div></div><div class="select2-container text text-box" id="s2id_LastUpdatedUserId" title="" style="display: none;"><a href="javascript:void(0)" class="select2-choice select2-default" tabindex="-1">   <span class="select2-chosen" id="select2-chosen-3">-- Sửa bởi --</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen3" class="select2-offscreen"></label><input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-3" id="s2id_autogen3" tabindex="-1"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen3_search" class="select2-offscreen"></label>       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-3" id="s2id_autogen3_search" placeholder="">   </div>   <ul class="select2-results" role="listbox" id="select2-results-3">   </ul></div></div><input class="text text-box select2-user select2-group-user" group="1580848" id="LastUpdatedUserId" name="LastUpdatedUserId" placeholder="-- Sửa bởi --" type="text" value="" tabindex="-1" title="" style="display: none;">
                    </td>
                        <td class="filter-label">Nhóm</td>
                        <td><div class="select2-container text text-box select2-allowclear" id="s2id_GroupId"><a href="javascript:void(0)" class="select2-choice" tabindex="-1">   <span class="select2-chosen" id="select2-chosen-4">Quan10</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen4" class="select2-offscreen"></label><input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-4" id="s2id_autogen4"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen4_search" class="select2-offscreen"></label>       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-4" id="s2id_autogen4_search" placeholder="">   </div>   <ul class="select2-results" role="listbox" id="select2-results-4">   </ul></div></div><div class="select2-container text text-box" id="s2id_GroupId" title="" style="display: none;"><a href="javascript:void(0)" class="select2-choice" tabindex="-1">   <span class="select2-chosen" id="select2-chosen-4">&nbsp;</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen4" class="select2-offscreen"></label><input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-4" id="s2id_autogen4" tabindex="-1"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen4_search" class="select2-offscreen"></label>       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-4" id="s2id_autogen4_search" placeholder="">   </div>   <ul class="select2-results" role="listbox" id="select2-results-4">   </ul></div></div><input class="text text-box select2-group select2-group-seeder" group="1580848" id="GroupId" name="GroupId" placeholder="Nhóm" type="text" value="1580848" tabindex="-1" title="" style="display: none;"></td>
                </tr>
                <tr>
                    <td class="filter-label">Nội thất</td>
                    <td>
                        <select class="select-box" id="InteriorId" name="InteriorId"><option value="">-- Tất cả --</option>
                            <option value="36">Xây thô</option>
                            <option value="37">Xây dựng đơn giản</option>
                            <option value="38">Xây vừa đủ tiện nghi</option>
                            <option value="39">Xây sang trọng cao cấp</option>
                            <option value="40">Xây cực kỳ cao cấp</option>
                        </select>
                    </td>
                    <td class="filter-label">Ngày xuất tin</td>
                    <td colspan="3">
                        <input class="text date-box hasDatepicker" id="LastExportedFrom" name="LastExportedFrom" type="text" value=""> đến <input class="text date-box hasDatepicker" id="LastExportedTo" name="LastExportedTo" type="text" value="">
                        <div class="select2-container text text-box" id="s2id_LastExportedUserId"><a href="javascript:void(0)" class="select2-choice select2-default" tabindex="-1">   <span class="select2-chosen" id="select2-chosen-5">-- Xuất bởi --</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen5" class="select2-offscreen"></label><input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-5" id="s2id_autogen5"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen5_search" class="select2-offscreen"></label>       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-5" id="s2id_autogen5_search" placeholder="">   </div>   <ul class="select2-results" role="listbox" id="select2-results-5">   </ul></div></div><div class="select2-container text text-box" id="s2id_LastExportedUserId" title="" style="display: none;"><a href="javascript:void(0)" class="select2-choice select2-default" tabindex="-1">   <span class="select2-chosen" id="select2-chosen-5">-- Xuất bởi --</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen5" class="select2-offscreen"></label><input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-5" id="s2id_autogen5" tabindex="-1"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen5_search" class="select2-offscreen"></label>       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-5" id="s2id_autogen5_search" placeholder="">   </div>   <ul class="select2-results" role="listbox" id="select2-results-5">   </ul></div></div><input class="text text-box select2-user select2-group-user" group="1580848" id="LastExportedUserId" name="LastExportedUserId" placeholder="-- Xuất bởi --" type="text" value="" tabindex="-1" title="" style="display: none;">
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
    <fieldset class="bulk-actions">
        <label for="Order">Sắp xếp theo:</label>
        <select id="id_bdsnews_order_by" name="id_bdsnews_order_by">
            <option <?php if($querydata['id_bdsnews_order_by']== 'id') echo "selected=selected" ?> value="id">Id</option>
            <option <?php if($querydata['id_bdsnews_order_by']== 'LastUpdatedDate') echo "selected=selected" ?> value="LastUpdatedDate">Ngày sửa lần cuối</option>
            <option <?php if($querydata['id_bdsnews_order_by']== 'AddressNumber') echo "selected=selected" ?> value="AddressNumber">Số nhà</option>
            <option <?php if($querydata['id_bdsnews_order_by']== 'PriceProposedInVND') echo "selected=selected" ?> value="PriceProposedInVND">Giá rao</option>
        </select>
        <button type="submit" name="search" value="search" onClick="searchBDS();">Tìm kiếm</button>
        Tìm được <strong><?php echo count($data) ?></strong> kết quả
    </fieldset>
    <fieldset>
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
                    <th scope="col" class="w20">Hướng</th>
                    <th scope="col" class="w58">MT/H</th>
                    <th scope="col" class="w30">Liên Hệ</th>
                    <th scope="col" class="w30">Liên Hệ Độc Quyền</th>
                    <th scope="col" class="w52">Ngày</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($data==NULL){
                    ?>
                    <tr>
                        <td colspan=15 style="text-align: -webkit-center;">Không có kết quả</td>
                    </tr>
                <?php
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
                            <span class="hover-me">
                                <a class="p-id" href="<?php echo RwsConstant::FULL_BASE_URL_HOST;?>/bdsNews?id=<?php echo $item['BdsNews']['BDSNEWS_ID']; ?>"><?php echo $item['BdsNews']['BDSNEWS_ID']; ?></a>
                                <img src="<?php echo $item['BdsNews']['HINH_ANH_PATH']; ?>"</small>
                            </span>
                            <!-- UserGroup -->
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
                        <td style="min-width:130px">
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
                        <div data-toggle="tooltip" style="max-width:50px" title="<?php echo $item['BdsNews']['LIEN_HE_DOC_QUYEN']; ?>"><?php echo $item['BdsNews']['LIEN_HE_DOC_QUYEN']; ?></div>
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
    </fieldset>
    <fieldset>
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