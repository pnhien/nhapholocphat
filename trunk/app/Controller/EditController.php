<?php
App::uses ( 'AppController', 'Controller' );
/**
 * EditController
 */
class EditController extends AppController {
	
	/**
	 * This controller does not use a model
	 *
	 * @var array
	 */
	public $uses = array (
			'TSite',
			'TPoint',
			'TCustomer',
			'TLineageType',
			'TMachineCategory',
			'TMachineType',
			'TDataCollectionTerminal',
			'TSiteLocation',
			'TGraphic',
			'TUser',
			'TAuth'
	);
	
	private function initDataMeasurePoint($site_id) {

		$this->title = $this->scrFieldLabels['MEASUREPOINTEDIT_TITLE'];
		$this->urlHistories = array($this->scrFieldLabels['MENU_USER'], $this->scrFieldLabels['SCR_USER_SITELIST'], $this->title);
		// get user login
		$user_id = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		$auth_role = $this->Session->read('login.user.auth_role');
		$this->set('auth_role', $auth_role);
		
		if (! empty ( $site_id )) {
			// get auth_edit
			$auth_edit_tmp = $this->TAuth->find('first', array(
					'fields' => array('TAuth.auth_edit'),
					'conditions' => array(
							'user_id' => $user_id,
							'site_id' => $site_id)
			));
			
			if(!empty($auth_edit_tmp ['TAuth'] ['auth_edit'])) {
				$auth_edit = $auth_edit_tmp ['TAuth'] ['auth_edit'];
			}
			// get table t_site from site_id
			$t_site_tbl = $this->TSite->findBySiteId ( $site_id );
			
			// get delete_flag
			$delete_flag = $t_site_tbl ['TSite'] ['delete_flag'];
			
			if(!$delete_flag) {
				// get table t_graphic from site_id
				$t_graphic_tbl = $this->TGraphic->findAllBySiteId ( $site_id );
				$this->set ( 't_graphic_tbl', $t_graphic_tbl );
				
				if(!empty($t_site_tbl)) {
				
					$site_name = $t_site_tbl ['TSite'] ['site_name'];
					$site_number = $t_site_tbl ['TSite'] ['site_number'];
					$complation_date = $t_site_tbl ['TSite'] ['complation_date'];
					$value_complation_date = CakeTime::format($complation_date, '%Y/%m/%d');
						
					// get table t_site_location from site_location_id
					$site_location_id = $t_site_tbl ['TSite'] ['site_location_id'];
					$t_site_location_tbl = $this->TSiteLocation->findBySiteLocationId ( $site_location_id );
					if(!empty($t_site_location_tbl)) {
						$site_location = $t_site_location_tbl ['TSiteLocation'] ['site_location'];
					}
				
					// get table t_customer from customer_id
					$customer_id = $t_site_tbl ['TSite'] ['customer_id'];
					$t_customer_tbl = $this->TCustomer->findByCustomerId ( $customer_id );
					
					$customer_name = !empty($t_customer_tbl ['TCustomer'] ['customer_name'])?
						$t_customer_tbl ['TCustomer'] ['customer_name']:'';
					
				
					$this->set ( 'site_id', $site_id );
					$this->set ( 'site_name', $site_name );
					$this->set ( 'site_number', $site_number );
					$this->set ( 'value_complation_date', $value_complation_date );
				
					$this->set ( 'site_location', $site_location );
				
					$this->set ( 'customer_name', $customer_name );
				}
					
				//get table t_data_collection_terminal from site_id
				$t_data_collection_terminal_tbl = $this->TDataCollectionTerminal->findAllBySiteId( $site_id );
				$terminal_names = array();
				if(!empty($t_data_collection_terminal_tbl)) {
					foreach ($t_data_collection_terminal_tbl as $t_data_collection_terminal_tbl_item) {
						$terminal_names[] = $t_data_collection_terminal_tbl_item ['TDataCollectionTerminal'] ['terminal_name'];
					}
					$this->set ( 'terminal_names', $terminal_names );
				}
				//get table t_point from site_id
				$t_point_tbl = $this->TPoint->findAllBySiteId( $site_id );
				$point_names = array();
				$machine_type_names_select = array();
				$machine_type_1_names_select = array();
				$machine_category_1_names_select = array();
				$machine_category_2_names_select = array();
				$value_sampling_cycles = array();
				$value_sampling_cycles = array();
				$graphic_names_select = array();
				$point_ids = array();
				$corresponding_notes = array();
				if(!empty($t_point_tbl)) {
					foreach ($t_point_tbl as $t_point_tbl_item) {
						$point_names[] = $t_point_tbl_item ['TPoint'] ['point_name'];
							
// 						$point_id_tmp = $this->TPoint->find('first', array(
// 								'fields' => array('TPoint.point_id'),
// 								'conditions' => array('TPoint.point_name' => $t_point_tbl_item ['TPoint'] ['point_name']),
// 						));
						$point_ids[] = $t_point_tbl_item ['TPoint'] ['point_id'];
						$this->set('point_ids',$point_ids);
						
						$corresponding_notes[] = $t_point_tbl_item ['TPoint'] ['corresponding_note'];
						$this->set('corresponding_notes',$corresponding_notes);
							
						$mchine_lineage_id = $t_point_tbl_item ['TPoint'] ['mchine_lineage_id'];
						$graphic_id = $t_point_tbl_item ['TPoint'] ['graphic_id'];
							
						// get machine_type_name to show selected dropdown list 機器種別
						$machine_type_id = substr($mchine_lineage_id, 0, 1);
						$t_machine_type_tbl_tmp = $this->TMachineType->findByMachineTypeId($machine_type_id);
						if(!empty($t_machine_type_tbl_tmp)) {
							$machine_type_names_select[] = $t_machine_type_tbl_tmp ['TMachineType'] ['machine_type_name'];
							$this->set ( 'machine_type_names_select', $machine_type_names_select );
						}
							
						// get machine_type_1_name to show selected dropdown list 系統種別１
						$machine_type_id1 = substr($mchine_lineage_id, 1, 1);
						$t_lineage_type_1_tbl_tmp = $this->TLineageType->findByLineageTypeId($machine_type_id1);
						if(!empty($t_lineage_type_1_tbl_tmp)) {
							$machine_type_1_names_select[] = $t_lineage_type_1_tbl_tmp ['TLineageType'] ['lineage_type_name'];
							$this->set ( 'machine_type_1_names_select', $machine_type_1_names_select );
						}
							
						// get machine_type_2_name to show selected dropdown list 系統種別2
						$machine_type_id2 = substr($mchine_lineage_id, 2, 1);
						$t_lineage_type_2_tbl_tmp = $this->TLineageType->findByLineageTypeId($machine_type_id2);
						if(!empty($t_lineage_type_2_tbl_tmp)) {
							$machine_type_2_names_select[] = $t_lineage_type_2_tbl_tmp ['TLineageType'] ['lineage_type_name'];
							$this->set ( 'machine_type_2_names_select', $machine_type_2_names_select );
						}
							
						// get machine_category_name to show selected dropdown list 機器カテゴリ1
						$machine_category_id1 = substr($mchine_lineage_id, 3, 1);
						$t_machine_category_tbl_tmp = $this->TMachineCategory->findByMachineCategoryId($machine_category_id1);
						if(!empty($t_machine_category_tbl_tmp)) {
							$machine_category_1_names_select[] = $t_machine_category_tbl_tmp ['TMachineCategory'] ['machine_category_name'];
							$this->set ( 'machine_category_1_names_select', $machine_category_1_names_select );
						}
							
						// get machine_category_name to show selected dropdown list 機器カテゴリ2
						$machine_category_id2 = substr($mchine_lineage_id, 4, 1);
						$t_machine_category_tbl_tmp = $this->TMachineCategory->findByMachineCategoryId($machine_category_id2);
						if(!empty($t_machine_category_tbl_tmp)) {
							$machine_category_2_names_select[] = $t_machine_category_tbl_tmp ['TMachineCategory'] ['machine_category_name'];
							$this->set ( 'machine_category_2_names_select', $machine_category_2_names_select );
						}
							
						// get value_sampling_cycle field selected dropdown list サンプリング周期
						$value_sampling_cycles_select[] = $t_point_tbl_item ['TPoint'] ['value_sampling_cycle'];
						$this->set ( 'value_sampling_cycles_select', $value_sampling_cycles_select );
							
						// get graphic_name field selected dropdown list 関連グラフィック
						$t_graphic_tmp = $this->TGraphic->findByGraphicId ($graphic_id);
						if(!empty($t_graphic_tmp)) {
							$graphic_names_select[] = $t_graphic_tmp ['TGraphic'] ['graphic_name'];
							$this->set ( 'graphic_names_select', $graphic_names_select );
						}
					}
					$this->set ( 'point_names', $point_names );
				
					// get all value_sampling_cycle field
					$this->set ( 't_point_tbl', $t_point_tbl );
				}
				//get all table t_machine_type
				$machine_type_names = array();
				$t_machine_type_tbl = $this->TMachineType->find('all');
				if(!empty($t_machine_type_tbl)) {
					foreach ($t_machine_type_tbl as $t_machine_type_tbl_item) {
						$machine_type_names[] = $t_machine_type_tbl_item ['TMachineType'] ['machine_type_name'];
					}
				}
				$this->set ( 'machine_type_names', $machine_type_names );
					
				//get all table t_lineage_type
				$lineage_type_names = array();
				$t_lineage_type_tbl = $this->TLineageType->find('all');
				if(!empty($t_lineage_type_tbl)) {
					foreach ($t_lineage_type_tbl as $t_lineage_type_tbl_item) {
						$lineage_type_names[] = $t_lineage_type_tbl_item ['TLineageType'] ['lineage_type_name'];
					}
				}
				$this->set ( 'lineage_type_names', $lineage_type_names );
					
				//get all table t_machine_category
				$machine_category_names = array();
				$t_machine_category_tbl = $this->TMachineCategory->find('all');
				if(!empty($t_machine_category_tbl)) {
					foreach ($t_machine_category_tbl as $t_machine_category_tbl_item) {
						$machine_category_names[] = $t_machine_category_tbl_item ['TMachineCategory'] ['machine_category_name'];
					}
				}
				$this->set ( 'machine_category_names', $machine_category_names );
				
				if ($auth_role == 0) {
					$check_auth = 1; // administrator permission
				} elseif ($auth_role == 2) {
					if ($auth_edit == 1) {
						$check_auth = 2; // site editing permission
					} else {
						$check_auth = 3; // 計測点申し送り  permission
					}
				} else {
					$check_auth = 4; // haven't permission
				}
				$this->set('check_auth', $check_auth);
			} 
		}
	}
	/**
	 * Displays a view
	 *
	 * @return void
	 * @throws NotFoundException When the view file could not be found
	 *         or MissingViewException in debug mode.
	 */
	public function openEditMeasurementPointLink() {
		if (! empty ( $this->request->query ['siteId'] )) {
			$site_id = $this->request->query ['siteId'];
			$this->initDataMeasurePoint($site_id);
		} else {
			$this->initDataMeasurePoint('');
		}
		return $this->render ( '/Edits/edit_measurement_point_link' );
	}
	
	public function updateSite() {
		// get user login
		$user_id = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		if(empty($this->request->query ['siteId'])) {
			$this->initDataMeasurePoint('');
		} else {
			$site_id = $this->request->query ['siteId'];
			if ($this->request->is ( array ( 'post','put' ) )) {
				$site_number = $_POST['site_number'];
				$complation_date = $_POST['complation_date'];
				
				$hd_complation_date = $_POST['hd_complation_date'];
				//$hd_site_number = $_POST['hd_site_number'];
				
				$check_site_number = $this->TSite->findBySiteNumber ($site_number);
				
				if(empty($site_number) && $hd_complation_date !== "true") {
					$this->Session->setFlash($this->messages['EDITMEASUREDATAPOINT_ERR_000001'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$this->initDataMeasurePoint($site_id);
					$this->set('isEmptySiteNumber', 'true');
					$this->set('isSiteNumber', 'true');
					return $this->render ( '/Edits/edit_measurement_point_link' );
				}
				if(empty($complation_date) && $hd_complation_date == "true") {
					$this->Session->setFlash($this->messages['EDITMEASUREDATAPOINT_ERR_000002'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$this->initDataMeasurePoint($site_id);
					$this->set('isDate', 'true');
					return $this->render ( '/Edits/edit_measurement_point_link' );
				}
				if(!RwsHelper::validateDate($complation_date, 'Y/m/d') && $hd_complation_date == "true") {
					$this->Session->setFlash($this->messages['INVALID_DATE'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$this->initDataMeasurePoint($site_id);
					$this->set('invalid_date', $complation_date);
					$this->set('isDate', 'true');
					return $this->render ( '/Edits/edit_measurement_point_link' );
				}
				if(!empty($check_site_number) && $hd_complation_date !== "true") {
					$this->Session->setFlash($this->messages['EDITMEASUREDATAPOINT_ERR_000005'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$this->set('isSiteNumber', 'true');
					$this->initDataMeasurePoint($site_id);
					return $this->render ( '/Edits/edit_measurement_point_link' );
				}
				$this->TSite->begin();
				$data = array('site_id' => $site_id, 'edit_user' => $user_id);
				if ($hd_complation_date == "true") {
					$data = $data + array('complation_date' => $complation_date);
				} else {
					$data = $data + array('site_number' => $site_number);
				}
				try {
					$this->TSite->save($data);
					$this->TSite->commit();
					$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
				} catch (Exception $e) {
					$this->TSite->rollback();
				}
			}
			$this->initDataMeasurePoint($site_id);
		}
		return $this->render ( '/Edits/edit_measurement_point_link' );
	}
	
	public function delSite() {
		// get user login
		$user_id = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		if(empty($this->request->query ['siteId'])) {
			$this->initDataMeasurePoint('');
		} else {
			$site_id = $this->request->query ['siteId'];
			$this->title = $this->scrFieldLabels['MEASUREPOINTEDIT_TITLE'];
			$this->urlHistories = array($this->scrFieldLabels['MENU_USER'], $this->scrFieldLabels['SCR_USER_SITELIST'], $this->title);
			if ($this->request->is ( array ( 'post','put' ) )) {
				//$site_id = $_POST['site_id'];
				$monitor_flag = $_POST['monitor_flag'];
				if($monitor_flag == '1') {
					$this->Session->setFlash($this->messages['EDITMEASUREDATAPOINT_ERR_000004'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$this->initDataMeasurePoint($site_id);
					return $this->render ( '/Edits/edit_measurement_point_link' );
				}
					
				$this->TSite->begin();
				try {
					$data = array('site_id' => $site_id, 'delete_flag' => '1', 'edit_user' => $user_id);
					$this->TSite->save($data);
					$this->TSite->commit();
					$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
				} catch (Exception $e) {
					$this->TSite->rollback();
				}
			}
			$this->initDataMeasurePoint($site_id);
		}
		return $this->render ( '/Edits/edit_measurement_point_link' );
	}
	
	public function updatePoint() {
		if(!empty($this->request->query ['siteId'])) {
			$site_id = $this->request->query ['siteId'];
			if ($this->request->is ( array ( 'post','put' ) )) {
				$updated_all_row_flag = $_POST['updated_all_row_flag'];
				// update all table 計測点一覧
				if($updated_all_row_flag == '1') {
					$updated_last_row_id = $_POST['updated_last_row_id'];
					for ($i = 0; $i < $updated_last_row_id; $i++) {
						$point_name = $_POST['point_name_' . $i];
						if(empty($point_name)) {
							$this->Session->setFlash($this->messages['EDITMEASUREDATAPOINT_ERR_000003'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
							$this->initDataMeasurePoint($site_id);
							$this->set('id_point_name', $i);
							return $this->render ( '/Edits/edit_measurement_point_link' );
						} else {
							$this->doUpdatePoint($i, $point_name, $site_id);
						}
					}
				}
				// update one row at table 計測点一覧
				elseif($updated_all_row_flag == '0') {
					$updated_row_id = $_POST['updated_row_id'];
					$point_name = $_POST['point_name_' . $updated_row_id];
					if(empty($point_name)) {
						$this->Session->setFlash($this->messages['EDITMEASUREDATAPOINT_ERR_000003'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$this->initDataMeasurePoint($site_id);
						$this->set('id_point_name', $updated_row_id);
						return $this->render ( '/Edits/edit_measurement_point_link' );
					} else {
						$this->doUpdatePoint($updated_row_id, $point_name, $site_id);
					}
				}
			}
			$this->initDataMeasurePoint($site_id);
		} else {
			$this->initDataMeasurePoint('');
		}
		return $this->render ( '/Edits/edit_measurement_point_link' );
	}
	
	private function doUpdatePoint($i, $point_name, $site_id) {
		$point_id = $_POST['point_id_' . $i];
		
		$corresponding_note = $_POST['id_note_return_' . $i];
		
		$graphic_name = $_POST['graphic_name_' . $i];
		$graphic_id_tmp = $this->TGraphic->find('first', array(
				'fields' => array('TGraphic.graphic_id'),
				'conditions' => array('TGraphic.graphic_name' => $graphic_name),
		));
		$graphic_id = '';
		if(!empty($graphic_id_tmp ['TGraphic'] ['graphic_id'])) {
			$graphic_id = $graphic_id_tmp ['TGraphic'] ['graphic_id'];
		}
		$machine_type_id = '';
		$machine_type_name = $_POST['machine_type_name_' . $i];
		$machine_type_id_tmp = $this->TMachineType->find('first', array(
				'fields' => array('TMachineType.machine_type_id'),
				'conditions' => array('TMachineType.machine_type_name' => $machine_type_name),
		));
		if(!empty($machine_type_id_tmp ['TMachineType'] ['machine_type_id'])) {
			$machine_type_id = $machine_type_id_tmp ['TMachineType'] ['machine_type_id'];
		}
		$mchine_lineage_id = $machine_type_id;
		
		$lineage_type_1_id = '';
		$lineage_type_1_name = $_POST['lineage_type_1_name_' . $i];
		$lineage_type_1_id_tmp = $this->TLineageType->find('first', array(
				'fields' => array('TLineageType.lineage_type_id'),
				'conditions' => array('TLineageType.lineage_type_name' => $lineage_type_1_name),
		));
		if(!empty($lineage_type_1_id_tmp ['TLineageType'] ['lineage_type_id'])) {
			$lineage_type_1_id = $lineage_type_1_id_tmp ['TLineageType'] ['lineage_type_id'];
		}
		$mchine_lineage_id = $mchine_lineage_id . $lineage_type_1_id;
		
		$lineage_type_2_id = '';
		$lineage_type_2_name = $_POST['lineage_type_2_name_' . $i];
		$lineage_type_2_id_tmp = $this->TLineageType->find('first', array(
				'fields' => array('TLineageType.lineage_type_id'),
				'conditions' => array('TLineageType.lineage_type_name' => $lineage_type_2_name),
		));
		if(!empty($lineage_type_2_id_tmp ['TLineageType'] ['lineage_type_id'])) {
			$lineage_type_2_id = $lineage_type_2_id_tmp ['TLineageType'] ['lineage_type_id'];
		}
		$mchine_lineage_id = $mchine_lineage_id . $lineage_type_2_id;
		
		$machine_category_1_id = '';
		$machine_category_1_name = $_POST['machine_category_1_name_' . $i];
		$machine_category_1_id_tmp = $this->TMachineCategory->find('first', array(
				'fields' => array('TMachineCategory.machine_category_id'),
				'conditions' => array('TMachineCategory.machine_category_name' => $machine_category_1_name),
		));
		if(!empty($machine_category_1_id_tmp ['TMachineCategory'] ['machine_category_id'])) {
			$machine_category_1_id = $machine_category_1_id_tmp ['TMachineCategory'] ['machine_category_id'];
		}
		$mchine_lineage_id = $mchine_lineage_id . $machine_category_1_id;
		
		$machine_category_2_id = '';
		$machine_category_2_name = $_POST['machine_category_2_name_' . $i];
		$machine_category_2_id_tmp = $this->TMachineCategory->find('first', array(
				'fields' => array('TMachineCategory.machine_category_id'),
				'conditions' => array('TMachineCategory.machine_category_name' => $machine_category_2_name),
		));
		if(!empty($machine_category_2_id_tmp ['TMachineCategory'] ['machine_category_id'])) {
			$machine_category_2_id = $machine_category_2_id_tmp ['TMachineCategory'] ['machine_category_id'];
		}
		$mchine_lineage_id = $mchine_lineage_id . $machine_category_2_id;
		
		$value_sampling_cycle = $_POST['value_sampling_cycle_' . $i];
		$value_sampling_cycle = str_replace('秒', '', $value_sampling_cycle);
		
		$this->TPoint->begin();
		try {
			if(empty($point_id)) {
				$point_id_tmp = $this->TPoint->find('first', array(
						'fields' => array('MAX(TPoint.point_id) AS point_id'),
				));
				$point_id = $point_id_tmp ['0'] ['point_id'] + 1;
				$data = array(
						'site_id' => $site_id,
						'point_name' => $point_name,
						'graphic_id' => $graphic_id,
						'mchine_lineage_id' => $mchine_lineage_id,
						'value_sampling_cycle' => !empty($value_sampling_cycle)?$value_sampling_cycle:0,
						'corresponding_note' => $corresponding_note
				);
			} else {
				$data = array(
						'point_id' => $point_id,
						'point_name' => $point_name,
						'graphic_id' => $graphic_id,
						'mchine_lineage_id' => $mchine_lineage_id,
						'value_sampling_cycle' => $value_sampling_cycle,
						'corresponding_note' => $corresponding_note
				);
			}
			
			$this->TPoint->save($data);
			$this->TPoint->commit();
			$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
		} catch (Exception $e) {
			$this->TPoint->rollback();
		}
	}
	
}