<?php
App::uses ( 'AppController', 'Controller' );

/**
 * WatchController
 */
class BdsNewsListController extends AppController {
	public $uses = array (
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
			'LoaiBds',
			'Street',
			'Ward',
			'District',
			'LoaiTien'
	);
	
	/**
	 * Displays a view Results
	 */
	public function index() {	
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

		$tinhTrang = $this->TinhTrang->find('all', array(
						'conditions' => array(
								'TinhTrang.DELETE_YMD IS NULL'
						))
		);
		$this->set('tinhTranglist', $tinhTrang);

		$loaiTin = $this->LoaiTin->find('all', array(
						'conditions' => array(
								'LoaiTin.DELETE_YMD IS NULL'
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
								"Province.PROVINCE_STATUS = 1"
						))
		);
		$this->set('provinceList', $provinceList);
		
		$loaiTienList = $this->LoaiTien->find('all', array(
						'conditions' => array(
								'LoaiTien.DELETE_YMD IS NULL'
						))
		);
		$this->set('loaiTienList', $loaiTienList);
		
   	$searchParam = $this->request->data;
   	$condition = array();   		
	$order_by = '';		

   	if(isset($searchParam)){	   		
   		if(isset($searchParam["id_bdsnews_loai_tin"]) && $searchParam["id_bdsnews_loai_tin"] != ''){   				
   			array_push($condition, "BdsNews.TYPE_NEWS_CODE= '". $searchParam["id_bdsnews_loai_tin"] . "'");   			
		} else{
			$searchParam["id_bdsnews_loai_tin"] = '';
		}
		if(isset($searchParam["id_bdsnews_nhom_bds"]) && $searchParam["id_bdsnews_nhom_bds"] != ''){
   			array_push($condition, "BdsNews.GROUP_CODE= '". $searchParam["id_bdsnews_nhom_bds"] . "'");
		}else{
			$searchParam["id_bdsnews_nhom_bds"] = '';
		}
		if(isset($searchParam["id_bdsnews_loai_bds"]) && $searchParam["id_bdsnews_loai_bds"] != ''){
   			array_push($condition, "BdsNews.LOAI_BDS_CODE= '". $searchParam["id_bdsnews_loai_bds"] . "'");
		}else{
			$searchParam["id_bdsnews_loai_bds"] = '';
		}
   		if(isset($searchParam["id_tinh_trang_code"]) && $searchParam["id_tinh_trang_code"] != ''){
   			array_push($condition, "BdsNews.TINH_TRANG_CODE= '". $searchParam["id_tinh_trang_code"] . "'");
		} else{
			$searchParam["id_tinh_trang_code"] = '';
		}
		if(isset($searchParam["id_bdsnews_danh_dau"]) && $searchParam["id_bdsnews_danh_dau"] != ''){
   			array_push($condition, "BdsNews.DANH_DAU_CODE= '". $searchParam["id_bdsnews_danh_dau"] . "'");
		} else{
			$searchParam["id_bdsnews_danh_dau"] = '';
		}
		if(isset($searchParam["id_bdsnews_province_code"]) && $searchParam["id_bdsnews_province_code"] != ''){
   			array_push($condition, "BdsNews.PROVINCE_CODE= '". $searchParam["id_bdsnews_province_code"] . "'");
		} else{
			$searchParam["id_bdsnews_province_code"] = '';
		}
		if(isset($searchParam["id_bdsnews_district_code"]) && $searchParam["id_bdsnews_district_code"] != ''){
   			array_push($condition, "BdsNews.DISTRICT_CODE= '". $searchParam["id_bdsnews_district_code"] . "'");
		} else{
			$searchParam["id_bdsnews_district_code"] = '';
		}
		if(isset($searchParam["id_bdsnews_street_code"]) && $searchParam["id_bdsnews_street_code"] != ''){
   			array_push($condition, "BdsNews.STREET_CODE= '". $searchParam["id_bdsnews_street_code"] . "'");
		} else{
			$searchParam["id_bdsnews_street_code"] = '';
		}
		if(isset($searchParam["id_bdsnews_ward_code"]) && $searchParam["id_bdsnews_ward_code"] != ''){
   			array_push($condition, "BdsNews.WARD_CODE= '". $searchParam["id_bdsnews_ward_code"] . "'");
		} else{
			$searchParam["id_bdsnews_ward_code"] = '';
		}
		if(isset($searchParam["id_bdsnews_address_number"]) && $searchParam["id_bdsnews_address_number"] != ''){
   			array_push($condition, "BdsNews.SO_NHA= '". $searchParam["id_bdsnews_address_number"] . "'");
		} else{
			$searchParam["id_bdsnews_address_number"] = '';
		}
		if(isset($searchParam["id_bdsnews_ngo_ngach"]) && $searchParam["id_bdsnews_ngo_ngach"] != ''){
   			array_push($condition, "BDSNews.SO_LUONG_HEM= '". $searchParam["id_bdsnews_ngo_ngach"] . "'");
		}else{
			$searchParam["id_bdsnews_ngo_ngach"] = '';
		}

		if(isset($searchParam["id_bdsnews_min_price"]) && $searchParam["id_bdsnews_min_price"] != ''){
   			array_push($condition, "BdsNews.GIA_RAO >= '". $searchParam["id_bdsnews_min_price"] . "'");
   			if(isset($searchParam["id_bdsnews_loai_tien_code"]) && $searchParam["id_bdsnews_loai_tien_code"] != ''){
	   			array_push($condition, "BdsNews.LOAI_TIEN_CODE = '". $searchParam["id_bdsnews_loai_tien_code"] . "'");
			} else{
				$searchParam["id_bdsnews_loai_tien_code"] = '';
			}
		}else{
			$searchParam["id_bdsnews_min_price"] = '';
			$searchParam["id_bdsnews_loai_tien_code"] = '';
		}
		if(isset($searchParam["id_bdsnews_max_price"]) && $searchParam["id_bdsnews_max_price"] != ''){
   			array_push($condition, "BdsNews.GIA_RAO <= '". $searchParam["id_bdsnews_max_price"] . "'");
   			if(isset($searchParam["id_bdsnews_loai_tien_code"]) && $searchParam["id_bdsnews_loai_tien_code"] != ''){
	   			array_push($condition, "BdsNews.LOAI_TIEN_CODE = '". $searchParam["id_bdsnews_loai_tien_code"] . "'");
			}
			else{
				$searchParam["id_bdsnews_loai_tien_code"] = '';				
			}
		}else{
			$searchParam["id_bdsnews_max_price"] = '';
			$searchParam["id_bdsnews_loai_tien_code"] = '';
		}

		if(isset($searchParam["id_bdsnews_order_by"]) && $searchParam["id_bdsnews_order_by"] != ''){
			if($searchParam["id_bdsnews_order_by"] == 'AddressNumber'){
   				$order_by = 'SO_NHA';
   			}
   			else if ($searchParam["id_bdsnews_order_by"]== 'PriceProposedInVND'){
   				$order_by = 'GIA_RAO';
			}
			else if ($searchParam["id_bdsnews_order_by"]== 'id'){
				$order_by = 'BDSNEWS_ID';
			}
			else{
   				$order_by = 'UPDATE_YMD';
   			}
		} else{
			$searchParam["id_bdsnews_order_by"] = '';
		}

   	}
	   $this->set('querydata',$searchParam);
		$data = $this->BdsNews->find("all", array(			
			'fields' => 'BdsNews.*, Huong.HUONG_NAME, Ward.WARD_NAME, District.DISTRICT_NAME, Street.STREET_NAME',
			'conditions' => $condition,
			'joins' => array(				
				array(
					'table' => 'loai_bds',
					'alias' => 'LoaiBds',
					'type' => 'left',
					'conditions' => array(						
						'BdsNews.LOAI_BDS_CODE = LoaiBds.LOAI_BDS_CODE'
					)
				),
				array(
					'table' => 'ward',
					'alias' => 'Ward',
					'type' => 'left',
					'conditions' => array(						
						'BdsNews.WARD_CODE = Ward.WARD_CODE'
					)
				),
				array(
					'table' => 'district',
					'alias' => 'District',
					'type' => 'left',
					'conditions' => array(						
						'BdsNews.DISTRICT_CODE = District.DISTRICT_CODE'
					)
				),
				array(
					'table' => 'street',
					'alias' => 'Street',
					'type' => 'left',
					'conditions' => array(						
						'BdsNews.STREET_CODE = Street.STREET_CODE'
					)
				),
				array(
					'table' => 'huong',
					'alias' => 'Huong',
					'type' => 'left',
					'conditions' => array(						
						'BdsNews.HUONG_CODE = Huong.HUONG_CODE'
					)
				)
			),
			'order' => $order_by
			));
		$this->set( 'data', $data);
        $bdsNews = $this->BdsNews->find('first', array(
					'fields' => 'BdsNews.*, DiemTot.*, DiemXau.*',
					'conditions' => array(
							'BdsNews.DELETE_YMD IS NULL'
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
				$this->set('BdsNews', $bdsNews);				
				$provinceCode = $searchParam['id_bdsnews_province_code']; 				
				$districtList = [];
				if($provinceCode != '')
				{
					$districtList = $this->District->find('all', array(
							'conditions' => array(
								'District.DISTRICT_STATUS = 1',
								'District.PROVINCE_CODE =' . $provinceCode
							))
					);					
				}
				$this->set('districtList', $districtList);
				
				$districtCode = $searchParam['id_bdsnews_district_code'];
				$wardList = [];
				$streetList = [];
				if($districtCode != '')
				{
					$wardList = $this->Ward->find('all', array(
						'conditions' => array(
								'Ward.WARD_STATUS = 1',
								'Ward.DISTRICT_CODE=' . $districtCode
						))
					);					
					$streetList = $this->Street->find('all', array(
						'conditions' => array(
								'Street.STREET_STATUS = 1',
								'Street.DISTRICT_CODE =' . $districtCode 
						))	
					);					
				}
				$this->set('wardList', $wardList);
				$this->set('streetList', $streetList);
			}
		return $this->render ( '/bdsNewsList' );
	}

	public function getDistrictByProvince($provinceID){
		$provinceList = $this->Provinces->find('all', array(
			'conditions' => array(
					"Province.PROVINCE_STATUS = 1"
			))
		);
	}

	public function loadSearchInfo(){
		
	}

}
