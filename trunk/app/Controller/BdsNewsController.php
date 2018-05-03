<?php
App::uses ( 'AppController', 'Controller' );

/**
 * WatchController
 */
class BdsNewsController extends AppController {
/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array(
			'TUser',
			'TCustomer',
			'BdsNews',
			'DanhDau',
			'TinhTrang',
			'LoaiTin',
			'DayList',
			'NhomBds',
			'PhapLy',
			'Huong',
			'ViTri',
			'SoTang',
			'LoaiCongTrinh',
			'MucXay',
			'LoaiBds',
			'TinVip',
			'DiemTot',
			'DiemXau',
			'Province',
			'District',
			'Ward',
			'Street',
			'Common',
			'LoaiTien',
			'DonViDo',
			'HinhAnh'
	);
	
	/**
	 * Displays a view Results
	 */
	public function index() {
		$this->setInit();
		$paraNews = $this->request->query;
		if(isset($paraNews['id'])){
			$bdsNewsId = $paraNews['id'];
			$this->getBdsNews($bdsNewsId);
			return $this->render ( '/bdsNews' );
		} else {
			$bdsNews = $this->BdsNews->create();
			$this->set('bdsNews', $bdsNews);
//			var_dump($bdsNews);
//			die;
			return $this->render ( '/createBdsNews' );
		}
	}
	
	public function doSaveBdsNews() {
		$this->setInit();
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			$bdsNewsId =  $data['BdsNews']['BDSNEWS_ID'];
			if($bdsNewsId == ""){
				$bdsNewsId = $this->doAddBdsNews($data);
			} else {
				$this->doUpdateBdsNews($data['BdsNews']);
			}
			$this->getBdsNews($bdsNewsId);
		}
		$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
		return $this->render ( '/bdsNews' );
	}
	
	public function doAddBdsNews($data) {
		$diemTot = $this->DiemTot->create();
		$diemTot = $data['DiemTot'];
		$this->DiemTot->begin();
		$this->DiemTot->save($diemTot);
		$this->DiemTot->commit();

		$diemXau = $this->DiemXau->create();
		$diemXau = $data['DiemXau'];
		$this->DiemXau->begin();
		$this->DiemXau->save($diemXau);
		$this->DiemXau->commit();
		
		$bdsNews = $this->BdsNews->create();
		$bdsNews = $data['BdsNews'];
		$bdsNews['DIEM_TOT_ID'] = $this->DiemTot->getLastInsertID();
		$bdsNews = $this->setCommonData($bdsNews, true);
		$this->BdsNews->begin();
		$this->BdsNews->save($bdsNews);
		$this->BdsNews->commit();
	
		$bdsNewsId = $this->BdsNews->getLastInsertID();
		$this->uploadHinhAnh($bdsNewsId);	
		
		return $bdsNewsId;
	}
	
	public function doUpdateBdsNews($bdsNews) {
		$bdsNewsFromDB = $this->BdsNews->find('first', array(
				'conditions' => array(
						'BdsNews.DELETE_YMD IS NULL',
						'BdsNews.BDSNEWS_ID =' . $bdsNews['BDSNEWS_ID']
				)
		));
		if($bdsNewsFromDB != null){
			foreach( $bdsNews as $bdsFieldkey => $bdsFieldValue)
			{
				 $type = $this->BdsNews->getColumnType($bdsFieldkey);
				 if($type == 'date' || $type == 'string' ){
					$bdsNewsFromDB['BdsNews'][$bdsFieldkey] = ($bdsFieldValue == null? null: $bdsFieldValue); 		
				 } else {
				 	$bdsNewsFromDB['BdsNews'][$bdsFieldkey] = ($bdsFieldValue == null? '': $bdsFieldValue);
				 }
			}
			$bdsNews = $this->setCommonData($bdsNews, false);
			$this->BdsNews->begin();
			$this->BdsNews->save($bdsNewsFromDB['BdsNews']);
			$this->BdsNews->commit();
		}
		$this->uploadHinhAnh($bdsNewsFromDB['BdsNews']['BDSNEWS_ID']);
	}
	
	private function setCommonData($bdsNews, $isNew){
		$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		if($isNew){
			$bdsNews['USER_CREATE'] = $user_id_login;
			$bdsNews['CREATE_YMD'] = date('yyyy-mm-dd');
		}
		$bdsNews['USER_UPDATE'] = $user_id_login;
		$bdsNews['UPDATE_YMD'] =  date('Y-m-d');
//		var_dump($bdsNews);die;
		return $bdsNews;
	}
	
	private function setInit(){
		$customer = $this->TCustomer->find('all', array(
						'conditions' => array(
								'TCustomer.DELETE_YMD IS NULL'
						))
		);
		$this->set('customerlist', $customer);

		$danhDau = $this->DanhDau->find('all', array(
						'conditions' => array(
								'DanhDau.DELETE_YMD IS NULL'
						))
		);
		$this->set('danhDaulist', $danhDau);
		//var_dump($danhDau);

		$tinhTrang = $this->TinhTrang->find('all', array(
						'conditions' => array(
								'TinhTrang.DELETE_YMD IS NULL'
						))
		);
		$this->set('tinhTranglist', $tinhTrang);

		$loaiTin = $this->LoaiTin->find('all', array(
						'conditions' => array(
								'LoaiTin.DELETE_YMD IS NULL',
								'LoaiTin.LA_KHACH_HANG <> 1'
						))
		);
		$this->set('loaiTinlist', $loaiTin);

		$dayList = $this->DayList->find('all', array(
						'conditions' => array(
								'DayList.DELETE_YMD IS NULL'
						))
		);
		$this->set('dayList', $dayList);

		$nhomBdsList = $this->NhomBds->find('all', array(
						'conditions' => array(
								'NhomBds.DELETE_YMD IS NULL'
						))
		);
		$this->set('nhomBdsList', $nhomBdsList);

		$phapLyList = $this->PhapLy->find('all', array(
						'conditions' => array(
								'PhapLy.DELETE_YMD IS NULL'
						))
		);
		$this->set('phapLyList', $phapLyList);

		$phapLyList = $this->PhapLy->find('all', array(
						'conditions' => array(
								'PhapLy.DELETE_YMD IS NULL'
						))
		);
		$this->set('phapLyList', $phapLyList);

		$huongList = $this->Huong->find('all', array(
						'conditions' => array(
								'Huong.DELETE_YMD IS NULL'
						))
		);
		$this->set('huongList', $huongList);

		$viTriList = $this->ViTri->find('all', array(
						'conditions' => array(
								'ViTri.DELETE_YMD IS NULL'
						))
		);
		$this->set('viTriList', $viTriList);

		$soTangList = $this->SoTang->find('all', array(
						'conditions' => array(
								'SoTang.DELETE_YMD IS NULL'
						))
		);
		$this->set('soTangList', $soTangList);

		$soTangList = $this->SoTang->find('all', array(
						'conditions' => array(
								'SoTang.DELETE_YMD IS NULL'
						))
		);
		$this->set('soTangList', $soTangList);


		$loaiCongTrinhList = $this->LoaiCongTrinh->find('all', array(
						'conditions' => array(
								'LoaiCongTrinh.DELETE_YMD IS NULL'
						))
		);
		$this->set('loaiCongTrinhList', $loaiCongTrinhList);

		$mucXayList = $this->MucXay->find('all', array(
						'conditions' => array(
								'MucXay.DELETE_YMD IS NULL'
						))
		);
		$this->set('mucXayList', $mucXayList);

		$loaiBdsList = $this->LoaiBds->find('all', array(
						'conditions' => array(
								'LoaiBds.DELETE_YMD IS NULL'
						))
		);
		$this->set('loaiBdsList', $loaiBdsList);

		$tinVipList = $this->TinVip->find('all', array(
						'conditions' => array(
								'TinVip.DELETE_YMD IS NULL'
						))
		);
		$this->set('tinVipList', $tinVipList);

		$diemTotList = $this->DiemTot->find('all', array(
						'conditions' => array(
								'DiemTot.DELETE_YMD IS NULL'
						))
		);
		$this->set('diemTotList', $diemTotList);

		$diemXauList = $this->DiemXau->find('all', array(
						'conditions' => array(
								'DiemXau.DELETE_YMD IS NULL'
						))
		);
		$this->set('diemXauList', $diemXauList);
		
		$provinceList = $this->Province->find('all', array(
						'conditions' => array(
								'Province.PROVINCE_STATUS = 1'
						))
		);
		$this->set('provinceList', $provinceList);
		$this->set('districtList', null);
		$this->set('wardList', null);
		$this->set('streetList', null);
		
		$loaiTienList = $this->LoaiTien->find('all', array(
						'conditions' => array(
								'LoaiTien.DELETE_YMD IS NULL'
						))
		);
		$this->set('loaiTienList', $loaiTienList);
		
		$donViDoList = $this->DonViDo->find('all', array(
						'conditions' => array(
								'DonViDo.DELETE_YMD IS NULL'
						))
		);
		$this->set('donViDoList', $donViDoList);
	}
	
	private function getBdsNews($bdsNewsId){
		$bdsNews = $this->BdsNews->find('first', array(
					'fields' => 'BdsNews.*, DiemTot.*, DiemXau.*',
					'conditions' => array(
							'BdsNews.DELETE_YMD IS NULL',
							'BdsNews.BDSNEWS_ID =' . $bdsNewsId
					),
					'joins' =>array(
							array (
									'table' => 'diem_tot',
									'alias' => 'DiemTot',
									'type' => 'left',
									'conditions' => array (
											'DiemTot.DIEM_TOT_ID = BdsNews.DIEM_TOT_ID'
									)
							),
							array (
									'table' => 'diem_xau',
									'alias' => 'DiemXau',
									'type' => 'left',
									'conditions' => array (
											'DiemXau.DIEM_XAU_ID = BdsNews.DIEM_XAU_ID'
									)
							)
					)
				)
		);
		if($bdsNews != null){
			$this->set('bdsNews', $bdsNews);
			
			$districtList = null;
			if(isset($bdsNews['BdsNews']['PROVINCE_CODE']) && $bdsNews['BdsNews']['PROVINCE_CODE'] != ""){
				$provinceCode = $bdsNews['BdsNews']['PROVINCE_CODE']; 
				$districtList = $this->District->find('all', array(
						'conditions' => array(
								'District.DISTRICT_STATUS = 1',
								'District.PROVINCE_CODE =' . $provinceCode
						))
				);
			}
			$this->set('districtList', $districtList);
			
			$wardList = null;
			if(isset($bdsNews['BdsNews']['DISTRICT_CODE']) && $bdsNews['BdsNews']['DISTRICT_CODE'] != ""){
				$districtCode = $bdsNews['BdsNews']['DISTRICT_CODE'];
				$wardList = $this->Ward->find('all', array(
						'conditions' => array(
								'Ward.WARD_STATUS = 1',
								'Ward.DISTRICT_CODE =' . $districtCode
						))
				);
			}
			$this->set('wardList', $wardList);
			
			$streetList = null;
			if(isset($bdsNews['BdsNews']['WARD_CODE']) && $bdsNews['BdsNews']['WARD_CODE'] != ""){
				$wardCode = $bdsNews['BdsNews']['WARD_CODE'];
				$streetList = $this->Street->find('all', array(
						'conditions' => array(
								'Street.STREET_STATUS = 1',
								'Street.DISTRICT_CODE =' . $districtCode 
						))
				);
			}
			$this->set('streetList', $streetList);
			
			$docSoTien = $this->convert_number_to_words($bdsNews['BdsNews']['GIA_RAO']);
			$this->set('docSoTien', $docSoTien);
			
			$hinhAnhList = $this->HinhAnh->find('all', array(
					'conditions' => array(
							'HinhAnh.DELETE_YMD IS NULL',
							'HinhAnh.BDS_NEWS_ID =' . $bdsNewsId 
					))
			);
			$this->set('hinhAnhList', $hinhAnhList);
//			var_dump($hinhAnhList);
//			die;
		}
	}
	
	public function doGetDistricts(){
		$this->ajaxAction();
		$data = $_POST ['dataInput'];
		$provinceCode = $data[0];
		$districtList = $this->District->find('all', array(
						'conditions' => array(
								'District.DISTRICT_STATUS = 1',
								'District.PROVINCE_CODE =' . $provinceCode 
						))
		);
		if(!empty($districtList)){
			$res['success'] = false;
			$res['districtList'] = $districtList;
			return json_encode($res);
		}
		$res['success'] = true;
		$res['districtList'] = $districtList;
		return json_encode($res);
	}
	
	public function doGetWards(){
		$this->ajaxAction();
		$data = $_POST ['dataInput'];
		$districtCode = $data[0];
		$wardList = $this->Ward->find('all', array(
						'conditions' => array(
								'Ward.WARD_STATUS = 1',
								'Ward.DISTRICT_CODE =' . $districtCode 
						))
		);
		if(!empty($wardList)){
			$res['success'] = false;
			$res['wardList'] = $wardList;
			return json_encode($res);
		}
		$res['success'] = true;
		$res['wardList'] = $wardList;
		return json_encode($res);
	}
	
	public function doGetStreets(){
		$this->ajaxAction();
		$data = $_POST ['dataInput'];
		$districtCode = $data[0];
		$streetList = $this->Street->find('all', array(
						'conditions' => array(
								'Street.STREET_STATUS = 1',
								'Street.DISTRICT_CODE =' . $districtCode 
						))
		);
		if(!empty($streetList)){
			$res['success'] = false;
			$res['streetList'] = $streetList;
			return json_encode($res);
		}
		$res['success'] = true;
		$res['streetList'] = $streetList;
		return json_encode($res);
	}
	
	//====Function====//
	function convert_number_to_words( $number )
	{
		$hyphen = ' ';
		$conjunction = '  ';
		$separator = ' ';
		$negative = 'âm ';
		$decimal = ' phẩy ';
		$dictionary = array(
			0 => 'Không',
			1 => 'Một',
			2 => 'Hai',
			3 => 'Ba',
			4 => 'Bốn',
			5 => 'Năm',
			6 => 'Sáu',
			7 => 'Bảy',
			8 => 'Tám',
			9 => 'Chín',
			10 => 'Mười',
			11 => 'Mười một',
			12 => 'Mười hai',
			13 => 'Mười ba',
			14 => 'Mười bốn',
			15 => 'Mười năm',
			16 => 'Mười sáu',
			17 => 'Mười bảy',
			18 => 'Mười tám',
			19 => 'Mười chín',
			20 => 'Hai mươi',
			30 => 'Ba mươi',
			40 => 'Bốn mươi',
			50 => 'Năm mươi',
			60 => 'Sáu mươi',
			70 => 'Bảy mươi',
			80 => 'Tám mươi',
			90 => 'Chín mươi',
			100 => 'trăm',
			1000 => 'ngàn',
			1000000 => 'triệu',
			1000000000 => 'tỷ',
			1000000000000 => 'nghìn tỷ',
			1000000000000000 => 'ngàn triệu triệu',
			1000000000000000000 => 'tỷ tỷ'
		);
	
		if( !is_numeric( $number ) )
		{
			return false;
		}
	
		if( ($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX )
		{
			// overflow
			trigger_error( 'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING );
			return false;
		}
	
		if( $number < 0 )
		{
			return $negative . convert_number_to_words( abs( $number ) );
		}
	
		$string = $fraction = null;
	
		if( strpos( $number, '.' ) !== false )
		{
			list( $number, $fraction ) = explode( '.', $number );
		}
	
		switch (true)
		{
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens = ((int)($number / 10)) * 10;
				$units = $number % 10;
				$string = $dictionary[$tens];
				if( $units )
				{
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if( $remainder )
				{
					$string .= $conjunction . convert_number_to_words( $remainder );
				}
				break;
			default:
				$baseUnit = pow( 1000, floor( log( $number, 1000 ) ) );
				$numBaseUnits = (int)($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = convert_number_to_words( $numBaseUnits ) . ' ' . $dictionary[$baseUnit];
				if( $remainder )
				{
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= convert_number_to_words( $remainder );
				}
				break;
		}
	
		if( null !== $fraction && is_numeric( $fraction ) )
		{
			$string .= $decimal;
			$words = array( );
			foreach( str_split((string) $fraction) as $number )
			{
				$words[] = $dictionary[$number];
			}
			$string .= implode( ' ', $words );
		}
	
		return $string;
	}
	function uploadHinhAnh($BdsNewsId){		
			$errors = array();
			$extension = array("jpeg","jpg","png","gif");
			
			$bytes = 1024;
			$allowedKB = 10000;
			$totalBytes = $allowedKB * $bytes;
			if(isset($_FILES["files"])==false)
			{
				echo "<b>Please, Select the files to upload!!!</b>";
				return;
			}
			$this->HinhAnh->begin();
			foreach($_FILES["files"]["tmp_name"]["HinhAnh"] as $key=>$tmp_name)
			{
				$uploadThisFile = true;
				
				$file_name = $_FILES["files"]["name"]["HinhAnh"][$key];
				$file_tmp = $tmp_name;
				$ext = pathinfo($file_name,PATHINFO_EXTENSION);
				
				if(!in_array(strtolower($ext),$extension))
				{
					array_push($errors, "File type is invalid. Name:- ".$file_name);
					$uploadThisFile = false;
				}				
				
				if($_FILES["files"]["size"]["HinhAnh"][$key] > $totalBytes){
					array_push($errors, "File size must be less than 10M. Name:- ".$file_name);
					$uploadThisFile = false;
				}
				
				if(file_exists("Upload/".$_FILES["files"]["name"]["HinhAnh"][$key]))
				{
					array_push($errors, "File is already exist. Name:- ". $file_name);
					$uploadThisFile = false;
				}
				
				if($uploadThisFile){
					$filename=basename($file_name,$ext);
					$newFileName=$BdsNewsId . "_" . $filename . $ext;				
					move_uploaded_file($_FILES["files"]["tmp_name"]["HinhAnh"][$key], "Upload/".$newFileName);
					
					//InsertDB
					$HinhAnh = $this->HinhAnh->create();
					$HinhAnh['BDS_NEWS_ID'] = $BdsNewsId;
					$HinhAnh['HINH_ANH_PATH'] = "Upload/".$newFileName;
					
					$this->HinhAnh->save($HinhAnh);
				}
			}
			$this->HinhAnh->commit();
			$count = count($errors);
			
			if($count != 0){
				foreach($errors as $error){
					echo $error."<br/>";
				}
			}
	}
	
	function deleteHinhAnh($BdsNewsId, $HinhAnhId){
		$errors = array();
		$extension = array("jpeg","jpg","png","gif");
			
		$bytes = 1024;
		$allowedKB = 10000;
		$totalBytes = $allowedKB * $bytes;
		if(isset($_FILES["files"])==false)
		{
			echo "<b>Please, Select the files to upload!!!</b>";
			return;
		}
		$this->HinhAnh->begin();
		foreach($_FILES["files"]["tmp_name"]["HinhAnh"] as $key=>$tmp_name)
		{
			$uploadThisFile = true;
	
			$file_name = $_FILES["files"]["name"]["HinhAnh"][$key];
			$file_tmp = $tmp_name;
			$ext = pathinfo($file_name,PATHINFO_EXTENSION);
	
			if(!in_array(strtolower($ext),$extension))
			{
				array_push($errors, "File type is invalid. Name:- ".$file_name);
				$uploadThisFile = false;
			}
	
			if($_FILES["files"]["size"]["HinhAnh"][$key] > $totalBytes){
				array_push($errors, "File size must be less than 10M. Name:- ".$file_name);
				$uploadThisFile = false;
			}
	
			if(file_exists("Upload/".$_FILES["files"]["name"]["HinhAnh"][$key]))
			{
				array_push($errors, "File is already exist. Name:- ". $file_name);
				$uploadThisFile = false;
			}
	
			if($uploadThisFile){
				$filename=basename($file_name,$ext);
				$newFileName=$BdsNewsId . "_" . $filename . $ext;
				move_uploaded_file($_FILES["files"]["tmp_name"]["HinhAnh"][$key], RwsConstant::FULL_BASE_URL_HOST . "/Upload/".$newFileName);
					
				//InsertDB
				$HinhAnh = $this->HinhAnh->create();
				$HinhAnh['BDS_NEWS_ID'] = $BdsNewsId;
				$HinhAnh['HINH_ANH_PATH'] = RwsConstant::FULL_BASE_URL_HOST . "/app/webroot/Upload/".$newFileName;
					
				$this->HinhAnh->save($HinhAnh);
			}
		}
		$this->HinhAnh->commit();
		$count = count($errors);
			
		if($count != 0){
			foreach($errors as $error){
				echo $error."<br/>";
			}
		}
	}
}