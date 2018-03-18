<?php

class SiteMap {
	
	private static function getMap() {
		$site_id = '';
		if (isset($_SESSION['auth'])) {
			$site_id = $_SESSION['auth']['SITE_ID'];
		}
		return array (
				0 => array(
						'screen_id' => 'SCR_USER_SITELIST',
						'url' => '',
						'sub_menu_flag' => false
				),
				1 => array(
						'screen_id' => 'SCR_VIEW_GRAPHIC',
						'url' => '',
						'sub_menu_flag' => true,
						'sub_menu_list' => array(
								0 => array(
										'name' => 'MENU_GRAPHIC',
										'auth_edit' => '0',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_GRAPH_REGISTERED_GRAPHIC',
														'url' => '#',
														'params' => ''
												)
										)
								),
								1 => array(
										'name' => 'MENU_MEASUREMENT',
										'auth_edit' => '0',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_VIEW_ACCUMULATIVE_TREND',
														'url' => '/view/trend/accumulative/display',
														'params' => 'site_id='.$site_id
												),
												1 => array(
														'sub_screen_id' => 'SCR_VIEW_PREDICT_DEMAND_TRANSITION',
														'url' => '/view/predictdemandtransition',
														'params' => ''
												),
												2 => array(
														'sub_screen_id' => 'SCR_VIEW_ANALOG_LIST',
														'url' => '/view/analoglist',
														'params' => ''
												),
												3 => array(
														'sub_screen_id' => 'SCR_VIEW_DIGITAL_LIST',
														'url' => '/view/digitallist',
														'params' => ''
												)
										)
								),
								2 => array(
										'name' => 'MENU_TREND',
										'auth_edit' => '0',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_VIEW_TREND',
														'url' => '/view/trend',
														'params' => ''
												)
										)
								),
								3 => array(
										'name' => 'MENU_ALARM_EVENT',
										'auth_edit' => '0',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_VIEW_ALARM_EVENT',
														'url' => '/view/alarmeventdisplay',
														'params' => ''
												),
												1 => array(
														'sub_screen_id' => 'SCR_VIEW_EVENT_TRACE',
														'url' => '/duty/eventtrace',
														'params' => ''
												)
										)
								),
								4 => array(
										'name' => 'MENU_DOC',
										'auth_edit' => '0',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_VIEW_CHOOSE_REPORT',
														'url' => '/doc/choosereport',
														'params' => ''
												),
												1 => array(
														'sub_screen_id' => 'SCR_VIEW_REPORT',
														'url' => '/view/report',
														'params' => ''
												)
										)
								),
								5 => array(
										'name' => 'MENU_CAMERA',
										'auth_edit' => '0',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => '',
														'sub_screen_name' => '',
														'url' => '#',
														'params' => ''
												)
										)
								),
								6 => array(
										'name' => 'MENU_SETTING',
										'auth_edit' => '0',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_DOC_SETUP',
														'url' => '/doc/setup',
														'params' => 'site_id=' . $site_id
												),
												1 => array(
														'sub_screen_id' => 'SCR_DOC_ADD_EDIT_TREND_GROUP',
														'url' => '/ShowGroup/onLoad',
														'params' => "site_id=$site_id"
												),
												2 => array(
														'sub_screen_id' => 'SCR_DOC_SETTING_DEMAND_TREND',
														'url' => '#',
														'params' => ''
												)
										)
								)
						)
				),
				2 => array(
						'screen_id' => 'SCR_USER_PROFILE',
						'url' => '',
						'sub_menu_flag' => false
				),
				3 => array(
						'screen_id' => 'SCR_EDIT_MEASURE_POINT',
						'url' => '',
						'sub_menu_flag' => true,
						'sub_menu_list' => array(
								0 => array(
										'name' => 'MENU_MAINTENANCE_MODE',
										'auth_edit' => '0',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_MAINTENANCE_MODE',
														'url' => '/edit/maintenancemode',
														'params' => "siteId=$site_id"
												)
										)
								),
								1 => array(
										'name' => 'MENU_ALARM_EVENT_MAIL_SETTING',
										'auth_edit' => '0',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_MAIL_EVENT_ALARM_SETTING',
														'url' => '/edit/mailalarmsetting',
														'params' => "siteId=$site_id"
												)
										)
								),
								2 => array(
										'name' => 'MENU_VIEW_SITE_SYSTEM_LOG',
										'auth_edit' => '0',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_VIEW_SYSTEM_SITE_LOG',
														'url' => '/site/systemlogviewing',
														'params' => ''
												)
										)
								),
								3 => array(
										'name' => 'MENU_FILE_LINK',
										'auth_edit' => '1',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_FILE_LINK',
														'url' => '/FileLink/index',
														'params' => "site_id=$site_id"
												)
										)
								),
								4 => array(
										'name' => 'MENU_GRP_SETTING_FOR_CUMULATIVE_TREND',
										'auth_edit' => '1',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_GRP_SETUP_FOR_CUMULATIVE_TREND',
														'url' => '#',
														'params' => ''
												)
										)
								),
								5 => array(
										'name' => 'MENU_INITIAL_SETTING',
										'auth_edit' => '1',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_SETUP_TRANSFER_CYCLE_BUFFER_LIMIT_PERIOD',
														'url' => '/user/transferbufferperiod',
														'params' => 'siteId='.$site_id
												),
												1 => array(
														'sub_screen_id' => 'SCR_SITE_PHONE_AND_SERVICE_LIFE_NOTICE_MANAGEMENT',
														'url' => '/site/terminal_site',
														'params' => "site_id=$site_id"
												)
										)
								),
								6 => array(
										'name' => 'MENU_MAIL_SETTING',
										'auth_edit' => '1',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_AUTO_DATA_SEND',
														'url' => '/edit/sendmaildatasetting',
														'params' => "siteId=$site_id"
												),
												1 => array(
														'sub_screen_id' => 'SCR_ORDINARY_SENDING_MAIL',
														'url' => '/edit/sendmailcyclesetting',
														'params' => "siteId=$site_id"
												)
										)
								)
						)
				),
				4 => array(
						'screen_id' => 'SCR_DUTY_RECEIVE_ALARM',
						'url' => '/duty/receivealarm',
						'sub_menu_flag' => false
				),
				5 => array(
						'screen_id' => 'SCR_DUTY_UNNECCESSARY_CONTACT_ALARM_LIST',
						'url' => '/List/index',
						'sub_menu_flag' => false
				),
				6 => array(
						'screen_id' => 'SCR_DUTY_ALARM_EVENT_TRACE',
						'url' => '',
						'sub_menu_flag' => false
				),
				7 => array(
						'screen_id' => 'SCR_DUTY_SYSTEM_HEALTH_CHECK',
						'url' => '',
						'sub_menu_flag' => false
				),
				8 => array(
						'screen_id' => 'SCR_DUTY_DATA_ANALYSIS',
						'url' => '',
						'sub_menu_flag' => true,
						'sub_menu_list' => array(
								0 => array(
										'name' => 'MENU_DATA_ANALYSIS',
										'auth_edit' => '0',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_VIEW_TYPE_OF_ALL_SITES',
														'url' => '#',
														'params' => ''
												),
												1 => array(
														'sub_screen_id' => 'SCR_VIEW_ALL_SITES',
														'url' => '/duty/allsitesdisplay',
														'params' => ''
												),
												2 => array(
														'sub_screen_id' => 'SCR_DUTY_DATA_ANALYSIS',
														'url' => '#',
														'params' => ''
												),
												3 => array(
														'sub_screen_id' => 'SCR_VIEW_SITE_GROUPING',
														'url' => '#',
														'params' => ''
												)
										)
								)
						)
				),
				9 => array(
						'screen_id' => 'SCR_EDIT_SITE',
						'url' => '',
						'sub_menu_flag' => false
				),
				10 => array(
						'screen_id' => 'SCR_EDIT_USER',
						'url' => '',
						'sub_menu_flag' => false
				),
				11 => array(
						'screen_id' => 'SCR_EDIT_COMMON',
						'url' => '',
						'sub_menu_flag' => true,
						'sub_menu_list' => array(
								0 => array(
										'name' => 'MENU_ARITHMETIC_EXPRESSION_CONFIRM_REGIST',
										'auth_edit' => '0',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_ARITHMETIC_EXPRESSION_SETUP',
														'url' => '#',
														'params' => ''
												)
										)
								),
								1 => array(
										'name' => 'MENU_EDIT_SITE_LOCATION_CUSTOMER_NAME',
										'auth_edit' => '0',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_EDIT_SITE_LOCATION_AND_CUSTOMER',
														'url' => '#',
														'params' => ''
												)
										)
								),
								2 => array(
										'name' => 'MENU_GRAPHIC_FILE_UPLOAD',
										'auth_edit' => '0',
										'sub_screen_list' => array(
												0 => array(
														'sub_screen_id' => 'SCR_GRAPHIC_FILE_UPLOAD',
														'url' => '/list/file_upload',
														'params' => ''
												)
										)
								)
						)
				),
				12 => array(
						'screen_id' => 'SCR_MANAGE_MEASURE_POINTID',
						'url' => '/manage/measurepointid',
						'sub_menu_flag' => false
				),
				13 => array(
						'screen_id' => 'SCR_MANAGE_SETTING',
						'url' => '',
						'sub_menu_flag' => false
				),
				14 => array(
						'screen_id' => 'SCR_MANAGE_VIEW_OPERATION_LOG',
						'url' => '',
						'sub_menu_flag' => false
				),
				15 => array(
						'screen_id' => 'SCR_MANAGE_VIEW_SERVER_SYSTEM_LOG',
						'url' => '',
						'sub_menu_flag' => false
				),
				16 => array(
						'screen_id' => 'SCR_MANAGE_SENT_ADVICE_EMAIL',
						'url' => '/SentMailHistory/index',
						'sub_menu_flag' => false
				),
				17 => array(
						'screen_id' => 'SCR_MANAGE_CONFIG_SERVER',
						'url' => '',
						'sub_menu_flag' => false
				)
		);
	}
	
	/**
	 * Get sub menu list of selected screen on left menu
	 * @param string $screen_id
	 * @param array $cameras
	 * @param array $graphics
	 * @return array
	 */
	public static function getSubMenuListBySelectedScreen($screen_id, $cameras=array(), $graphics=array()) {
		$site_map = self::getMap();
		foreach ($site_map as $screen) {
			if ($screen['screen_id'] === $screen_id) {
				if ($screen['sub_menu_flag']) {
					$sub_menu_list = $screen['sub_menu_list'];
					for ($i = 0; $i < count($sub_menu_list); $i++) {
						$sub_menu = $sub_menu_list[$i];
						if ('MENU_CAMERA' === $sub_menu['name']) {
							$sub_screen_list = self::createSubscreenListForSubmenu($sub_menu['name'], $cameras);
							$sub_menu['sub_screen_list'] = $sub_screen_list;
							$sub_menu_list[$i] = $sub_menu;
						}
						if ('MENU_GRAPHIC' === $sub_menu['name']) {
							$sub_screen_list = self::createSubscreenListForSubmenu($sub_menu['name'], $graphics);
							$sub_menu['sub_screen_list'] = $sub_screen_list;
							$sub_menu_list[$i] = $sub_menu;
						}
					}
					return $sub_menu_list;
				}
				break;
			}
		}
		return array();
	}
	
	private static function createSubscreenListForSubmenu($sub_menu_name, $data=array()) {
		$sub_screen_list = array();
		if (!empty($data)) {
			foreach ($data as $item) {
				$screen = array();
				if ($sub_menu_name === 'MENU_CAMERA') {
					$screen = array(
							'sub_screen_id' => '',
							'sub_screen_name' => $item['TCamera']['CAMERA_NAME'],
							'url' => '/view/camera',
							'params' => 'siteId=' . $item['TCamera']['SITE_ID'] . '&cameraId=' . $item['TCamera']['CAMERA_ID']
					);
				} elseif ($sub_menu_name === 'MENU_GRAPHIC') {
					$screen = array(
							'sub_screen_id' => '',
							'sub_screen_name' => $item['TGraphic']['GRAPHIC_NAME'],
							'url' => '/view/graphic',
							'params' => 'siteId=' . $item['TGraphic']['SITE_ID'] . '&graphicId=' . $item['TGraphic']['GRAPHIC_ID']
					);
				}
				array_push($sub_screen_list, $screen);
			}
		}
		return $sub_screen_list;
	}
	
	/**
	 * Get sub-screen list of input sub-menu
	 * @param string $sub_menu_id
	 * @return array
	 */
	public static function getSubscreenListBySubMenu($sub_menu_id) {
		$site_map = self::getMap();
		foreach ($site_map as $screen) {
			if ($screen['sub_menu_flag']) {
				$sub_menu_list = $screen['sub_menu_list'];
				foreach ($sub_menu_list as $sub_menu) {
					if ($sub_menu_id === $sub_menu['name']) {
						return $sub_menu['sub_screen_list'];
					}
				}
			}
		}
		return array();
	}
}