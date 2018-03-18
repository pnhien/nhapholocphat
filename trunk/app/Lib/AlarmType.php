<?php
class AlarmType {
	
	const ANALOG = '3';
	const DIGITAL = '1';
	
	const CLASS_ALARM = '0';
	const CLASS_EVENT = '1';
	
	private static $alarmClassMap = array(
			self::CLASS_ALARM => '警報',
			self::CLASS_EVENT => 'イベント'
	);
	
	private static $allAlarmMap = array (
			self::CLASS_ALARM => array (
					0 => array(
							'code' => '1',
							'value' => 'お知らせ',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => 'ON/OFF'
									)
							)
					),
					1 => array(
							'code' => '2',
							'value' => 'H/L',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => '上限超え'
									),
									1 => array(
											'code' => '2',
											'value' => '下限超え'
									),
									2 => array(
											'code' => '3',
											'value' => 'デマンド予測上限超え'
									),
									3 => array(
											'code' => '4',
											'value' => 'デマンド予測下限超え'
									)
							)
					),
					2 => array(
							'code' => '3',
							'value' => 'HH/LL',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => '上限超え'
									),
									1 => array(
											'code' => '2',
											'value' => '下限超え'
									),
									2 => array(
											'code' => '3',
											'value' => 'デマンド予測上限超え'
									),
									3 => array(
											'code' => '4',
											'value' => 'デマンド予測下限超え'
									)
							)
					),
					3 => array(
							'code' => '4',
							'value' => '軽故障',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => 'ON/OFF'
									)
							)
					),
					4 => array(
							'code' => '5',
							'value' => '中故障',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => 'ON/OFF'
									)
							)
					),
					5 => array(
							'code' => '6',
							'value' => '重故障',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => 'ON/OFF'
									)
							)
					),
					6 => array(
							'code' => '70',
							'value' => 'システム警報',
							'types' => array(
									0 => array(
											'code' => '2',
											'value' => 'データ取得タイムアウト'
									),
									1 => array(
											'code' => '4',
											'value' => '下位PLC間通信タイムアウト'
									),
									2 => array(
											'code' => '5',
											'value' => 'サイト端末システムログ異常'
									),
									3 => array(
											'code' => '6',
											'value' => 'サイト端末ディスク残量不足'
									),
									4 => array(
											'code' => '7',
											'value' => 'サイト端末推奨保守時期超過'
									),
									5 => array(
											'code' => '8',
											'value' => 'サイト端末時刻ずれ大'
									),
									6 => array(
											'code' => '9',
											'value' => 'サイト端末過負荷'
									),
									7 => array(
											'code' => '11',
											'value' => 'サイト端末プログラム起動'
									),
									8 => array(
											'code' => '12',
											'value' => 'サイトUPS入力電圧異常'
									),
									9 => array(
											'code' => '13',
											'value' => '収集データ欠損検知'
									),
									10 => array(
											'code' => '14',
											'value' => '異常値データ検知'
									),
									11 => array(
											'code' => '15',
											'value' => '警報マスク開始'
									),
									12 => array(
											'code' => '16',
											'value' => '警報マスク長時間警告'
									),
									13 => array(
											'code' => '17',
											'value' => 'サーバシステムログ異常'
									),
									14 => array(
											'code' => '18',
											'value' => 'サーバディスク残量不足'
									),
									15 => array(
											'code' => '20',
											'value' => 'サーバメール送信失敗'
									)
							)
					),
					7 => array(
							'code' => '80',
							'value' => '帳票アラーム',
							'types' => array(
									0 => array(
											'code' => '101',
											'value' => '帳票警報、データ欠損による算出不可'
									),
									1 => array(
											'code' => '102',
											'value' => '帳票警報、異常値検出'
									)
							)
					)
			),
			self::CLASS_EVENT => array (
					0 => array(
							'code' => '1',
							'value' => '指令',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => 'ON/OFF'
									)
							)
					),
					1 => array(
							'code' => '2',
							'value' => '状態',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => 'ON/OFF'
									)
							)
					),
					2 => array(
							'code' => '3',
							'value' => 'システム',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => 'ON/OFF'
									)
							)
					)
			)
	);
	
	private static $analogMap = array (
			self::CLASS_ALARM => array (
					0 => array(
							'code' => '2',
							'value' => 'H/L',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => '上限超え'
									),
									1 => array(
											'code' => '2',
											'value' => '下限超え'
									),
									2 => array(
											'code' => '3',
											'value' => 'デマンド予測上限超え'
									),
									3 => array(
											'code' => '4',
											'value' => 'デマンド予測下限超え'
									)
							)
					),
					1 => array(
							'code' => '3',
							'value' => 'HH/LL',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => '上限超え'
									),
									1 => array(
											'code' => '2',
											'value' => '下限超え'
									),
									2 => array(
											'code' => '3',
											'value' => 'デマンド予測上限超え'
									),
									3 => array(
											'code' => '4',
											'value' => 'デマンド予測下限超え'
									)
							)
					)
			)
	);
	
	private static $digitalMap = array (
			self::CLASS_ALARM => array (
					0 => array(
							'code' => '1',
							'value' => 'お知らせ',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => 'ON/OFF'
									)
							)
					),
					1 => array(
							'code' => '4',
							'value' => '軽故障',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => 'ON/OFF'
									)
							)
					),
					2 => array(
							'code' => '5',
							'value' => '中故障',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => 'ON/OFF'
									)
							)
					),
					3 => array(
							'code' => '6',
							'value' => '重故障',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => 'ON/OFF'
									)
							)
					)
			),
			self::CLASS_EVENT => array (
					0 => array(
							'code' => '1',
							'value' => '指令',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => 'ON/OFF'
									)
							)
					),
					1 => array(
							'code' => '2',
							'value' => '状態',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => 'ON/OFF'
									)
							)
					),
					2 => array(
							'code' => '3',
							'value' => 'システム',
							'types' => array(
									0 => array(
											'code' => '1',
											'value' => 'ON/OFF'
									)
							)
					)
			)
	);
	
	private static $systemAlarmMap = array (
			self::CLASS_ALARM => array (
					0 => array(
							'code' => '70',
							'value' => 'システム警報',
							'types' => array(
									0 => array(
											'code' => '2',
											'value' => 'データ取得タイムアウト'
									),
									1 => array(
											'code' => '4',
											'value' => '下位PLC間通信タイムアウト'
									),
									2 => array(
											'code' => '5',
											'value' => 'サイト端末システムログ異常'
									),
									3 => array(
											'code' => '6',
											'value' => 'サイト端末ディスク残量不足'
									),
									4 => array(
											'code' => '7',
											'value' => 'サイト端末推奨保守時期超過'
									),
									5 => array(
											'code' => '8',
											'value' => 'サイト端末時刻ずれ大'
									),
									6 => array(
											'code' => '9',
											'value' => 'サイト端末過負荷'
									),
									7 => array(
											'code' => '11',
											'value' => 'サイト端末プログラム起動'
									),
									8 => array(
											'code' => '12',
											'value' => 'サイトUPS入力電圧異常'
									),
									9 => array(
											'code' => '13',
											'value' => '収集データ欠損検知'
									),
									10 => array(
											'code' => '14',
											'value' => '異常値データ検知'
									),
									11 => array(
											'code' => '15',
											'value' => '警報マスク開始'
									),
									12 => array(
											'code' => '16',
											'value' => '警報マスク長時間警告'
									),
									13 => array(
											'code' => '17',
											'value' => 'サーバシステムログ異常'
									),
									14 => array(
											'code' => '18',
											'value' => 'サーバディスク残量不足'
									),
									15 => array(
											'code' => '20',
											'value' => 'サーバメール送信失敗'
									)
							)
					),
					1 => array(
							'code' => '80',
							'value' => '帳票アラーム',
							'types' => array(
									0 => array(
											'code' => '101',
											'value' => '帳票警報、データ欠損による算出不可'
									),
									1 => array(
											'code' => '102',
											'value' => '帳票警報、異常値検出'
									)
							)
					)
			),
	);

	/**
	 * Get Analog Alarm Map
	 * @return array
	 */
	public static function getAnalogAlarmMap() {
		return self::$analogMap;
	}
	
	/**
	 * Get Digital Alarm Map
	 * @return array
	 */
	public static function getDigitalAlarmMap() {
		return self::$digitalMap;
	}
	
	/**
	 * Get System Alarm Map
	 * @return array
	 */
	public static function getSystemAlarmMap() {
		return self::$systemAlarmMap;
	}
	
	/**
	 * Get all Alarm Level for combobox display
	 * @return multitype:string
	 */
	public static function getAllAlarmLevelForCombobox() {
		return array(
				'01' => 'お知らせ',
				'02' => 'H/L',
				'03' => 'HH/LL',
				'04' => '軽故障',
				'05' => '中故障',
				'06' => '重故障',
				'11' => '指令',
				'12' => '状態',
				'13' => 'システム',
				'070' => 'システム警報',
				'080' => '帳票アラーム'
		);
	}
	
	/**
	 * Get all Alarm Type List based on input alarm class & alarm level
	 * @return multitype:string
	 */
	public static function getAllAlarmTypeList($alarm_class, $alarm_level) {
		if (RwsHelper::isEmpty($alarm_class) || RwsHelper::isEmpty($alarm_level)) {
			return array();
		}
		$alarm_level_list = self::$allAlarmMap[$alarm_class];
		if ($alarm_level == '7' || $alarm_level == '8') {
			$alarm_level .= '0';
		}
		foreach ($alarm_level_list as $level) {
			if ($level['code'] == $alarm_level) {
				return $level['types'];
			}
		}
	}
	
	/**
	 * Get all Alarm Type for Combobox based on input alarm class & alarm level
	 * @return multitype:string
	 */
	public static function getAllAlarmTypeForCombobox($alarm_class, $alarm_level) {
		$alarm_type_list = array();
		if (RwsHelper::isEmpty($alarm_class) || RwsHelper::isEmpty($alarm_level)) {
			return $alarm_type_list;
		}
		$alarm_level_list = self::$allAlarmMap[$alarm_class];
		foreach ($alarm_level_list as $level) {
			if ($level['code'] == $alarm_level) {
				$alarm_type_list = $level['types'];
				break;
			}
		}
		return self::createComboboxData($alarm_type_list);
	}
	
	//======================================== For the 1st digit ============================================= START //
	/**
	 * Get Alarm Class Name, based on the input Alarm Class
	 * @param string $alarm_class
	 * @return string
	 */
	public static function getAlarmClassName($alarm_class) {
		if (RwsHelper::isEmpty($alarm_class)) {
			return '';
		}
		return self::$alarmClassMap[$alarm_class];
	}
	
	/**
	 * Get Alarm Class Name, based on the first digit of input alarm type ID
	 * @param string $alarm_type_id
	 * @return string
	 */
	public static function getAlarmClassNameByAlarmTypeID($alarm_type_id) {
		if (RwsHelper::isEmpty($alarm_type_id)) {
			return '';
		}
		$alarm_class = self::get1stDigit($alarm_type_id);
		return self::$alarmClassMap[$alarm_class];
	}
	
	/**
	 * Get Alarm class data for Combobox
	 * @param string $point_type
	 * @return array
	 */
	public static function getAlarmClassForCombobox($point_type) {
		if ($point_type === self::ANALOG) {
			return array(
					self::CLASS_ALARM => '警報'
			);
		}
		return self::$alarmClassMap;
	}
	//======================================== For the 1st digit ============================================= END //
	
	//======================================== For the 2nd digit ============================================= START //
	/**
	 * Get Alarm Level Name,  based on the second digit of input alarm type ID
	 * @param string $point_type, including ANALOG or DIGITAL
	 * @param string $alarm_type_id
	 * @return string
	 */
	public static function getAlarmLevelNameByAlarmTypeID($point_type, $alarm_type_id) {
		if (RwsHelper::isEmpty($alarm_type_id)) {
			return '';
		}
		$alarm_class = self::get1stDigit($alarm_type_id);
		$alarm_level = self::get2ndDigit($alarm_type_id);
		if ($point_type === self::ANALOG) {
			if ($alarm_class === self::CLASS_EVENT) {
				return '';
			}
			$arr = self::$analogMap[$alarm_class];
		} else {
			$arr = self::$digitalMap[$alarm_class];
		}
		return self::searchData($arr, $alarm_level);
	}
	
	/**
	 * Get Analog Alarm Level Name,  based on the input alarm class and alarm level
	 * @param string $alarm_class
	 * @param string $alarm_level
	 * @return tring
	 */
	public static function getAnalogAlarmLevelName($alarm_class, $alarm_level) {
		return self::getAlarmLevelName(self::ANALOG, $alarm_class, $alarm_level);
	}
	
	/**
	 * Get Digital Alarm Level Name,  based on the input alarm class and alarm level
	 * @param string $alarm_class
	 * @param string $alarm_level
	 * @return tring
	 */
	public static function getDigitalAlarmLevelName($alarm_class, $alarm_level) {
		return self::getAlarmLevelName(self::DIGITAL, $alarm_class, $alarm_level);
	}
	
	/**
	 * Get Alarm Level Name,  based on the input alarm class and alarm level
	 * @param string $point_type
	 * @param string $alarm_class
	 * @param string $alarm_level
	 * @return tring
	 */
	public static function getAlarmLevelName($point_type, $alarm_class, $alarm_level) {
		if (RwsHelper::isEmpty($alarm_class) || RwsHelper::isEmpty($alarm_level)) {
			return '';
		}
		if ($point_type === self::ANALOG) {
			$arr = self::$analogMap[$alarm_class];
		} else {
			$arr = self::$digitalMap[$alarm_class];
		}
		return self::searchData($arr, $alarm_level);
	}
	
	/**
	 * Get Alarm Level data for Combobox based on input Alarm type ID
	 * @param string $point_type
	 * @param string $alarm_type_id
	 * @return array
	 */
	public static function getAlarmLevelListForCombobox($point_type, $alarm_class) {
		if (RwsHelper::isEmpty($alarm_class)) {
			$alarm_class = self::CLASS_ALARM;
		}
		$alarm_level_list = self::$digitalMap[$alarm_class];
		if ($point_type === self::ANALOG) {
			$alarm_level_list = self::$analogMap[$alarm_class];
		}
		return self::createComboboxData($alarm_level_list);
	}
	
	/**
	 * Get Alarm Level data for Combobox based on input Alarm type ID
	 * @param string $point_type
	 * @param string $alarm_type_id
	 * @return array
	 */
	public static function getAlarmLevelListForComboboxByAlarmTypeID($point_type, $alarm_type_id) {
		$alarm_class = self::CLASS_ALARM;
		if (RwsHelper::isNotEmpty($alarm_type_id)) {
			$alarm_class = self::get1stDigit($alarm_type_id);
		}
		$alarm_level_list = self::$digitalMap[$alarm_class];
		if ($point_type === self::ANALOG) {
			$alarm_level_list = self::$analogMap[$alarm_class];
		}
		return self::createComboboxData($alarm_level_list);
	}
	
	/**
	 * Get Alarm Level list of input Alarm Class (1st digit)
	 * @param string $point_type
	 * @param string $alarm_class
	 * @return array
	 */
	public static function getAlarmLevelList($point_type, $alarm_class) {
		if (RwsHelper::isEmpty($alarm_class)) {
			$alarm_class = self::CLASS_ALARM;
		}
		$alarm_level_list = self::$digitalMap[$alarm_class];
		if ($point_type === self::ANALOG) {
			$alarm_level_list = self::$analogMap[$alarm_class];
		}
		return $alarm_level_list;
	}
	
	/**
	 * Get Alarm Level list of input Alarm Type ID
	 * @param string $point_type
	 * @param string $alarm_type_id
	 * @return array
	 */
	public static function getAlarmLevelListByAlarmTypeID($point_type, $alarm_type_id) {
		$alarm_class = self::CLASS_ALARM;
		if (RwsHelper::isNotEmpty($alarm_type_id)) {
			$alarm_class = self::get1stDigit($alarm_type_id);
		}
		$alarm_level_list = self::$digitalMap[$alarm_class];
		if ($point_type === self::ANALOG) {
			$alarm_level_list = self::$analogMap[$alarm_class];
		}
		return $alarm_level_list;
	}
	
	/**
	 * Get System Alarm Level list
	 * @return array
	 */
	public static function getSystemAlarmLevelList() {
		$alarm_level_list = self::$systemAlarmMap[self::CLASS_ALARM];
		return $alarm_level_list;
	}
	
	/**
	 * Get System Alarm Level list for Combo
	 * @return array
	 */
	public static function getSystemAlarmLevelListForCombobox() {
		$alarm_level_list = self::$systemAlarmMap[self::CLASS_ALARM];
		return self::createComboboxData($alarm_level_list);
	}
	//======================================== For the 2nd digit ============================================= END //
	
	//======================================== For the 3rd digit ============================================= START //
	/**
	 * Get Alarm Type data for Combobox based on input Alarm Type ID
	 * @param string $point_type
	 * @param string $alarm_type_id
	 * @return array
	 */
	public static function getAlarmTypeForComboboxByAlarmTypeID($point_type, $alarm_type_id) {
		if (RwsHelper::isEmpty($alarm_type_id)) {
			return array();
		}
		$alarm_class = self::get1stDigit($alarm_type_id);
		$alarm_level = self::get2ndDigit($alarm_type_id);
		$alarm_level_list = self::$digitalMap[$alarm_class];
		if ($point_type === self::ANALOG) {
			$alarm_level_list = self::$analogMap[$alarm_class];
		}
		$arr = array();
		foreach ($alarm_level_list as $item) {
			if ($item['code'] === $alarm_level) {
				return self::createComboboxData($item['types']);
			}
		}
		return $arr;
	}
	
	/**
	 * Get Alarm Type list of input Alarm Type ID
	 * @param string $point_type
	 * @param string $alarm_type_id
	 * @return array
	 */
	public static function getAlarmTypeListByAlarmTypeID($point_type, $alarm_type_id) {
		if (RwsHelper::isEmpty($alarm_type_id)) {
			return array();
		}
		$alarm_class = self::get1stDigit($alarm_type_id);
		$alarm_level = self::get2ndDigit($alarm_type_id);
		$alarm_level_list = self::$digitalMap[$alarm_class];
		if ($point_type === self::ANALOG) {
			$alarm_level_list = self::$analogMap[$alarm_class];
		}
		$alarm_type = self::get3rdDigit($alarm_type_id);
		$alarm_type_list = array();
		foreach ($alarm_level_list as $item) {
			if ($item['code'] === $alarm_level) {
				return $item['types'];
			}
		}
		return $alarm_type_list;
	}
	
	/**
	 * Get Alarm Type list
	 * @param string $alarm_class
	 * @param string $alarm_level
	 * @return array
	 */
	public static function getAlarmTypeListByAlarmLevel($alarm_class, $alarm_level) {
		$alarm_level_list = self::$allAlarmMap[$alarm_class];
		foreach ($alarm_level_list as $item) {
			if ($item['code'] === $alarm_level) {
				return $item['types'];
			}
		}
		return array();
	}
	
	/**
	 * Get Alarm Type Name, based on input Point Type and Alarm Type ID
	 * @param string $point_type
	 * @param string $alarm_type_id
	 * @return string
	 */
	public static function getAlarmTypeNameByAlarmTypeID($point_type, $alarm_type_id) {
		if (RwsHelper::isEmpty($alarm_type_id)) {
			return '';
		}
		$alarm_class = self::get1stDigit($alarm_type_id);
		$alarm_level_list = self::$digitalMap[$alarm_class];
		if ($point_type === self::ANALOG) {
			if ($alarm_class === self::CLASS_EVENT) {
				return '';
			}
			$alarm_level_list = self::$analogMap[$alarm_class];
		}
		$alarm_level = self::get2ndDigit($alarm_type_id);
		$alarm_type_list = array();
		foreach ($alarm_level_list as $item) {
			if ($item['code'] === $alarm_level) {
				$alarm_type_list = $item['types'];
				break;
			}
		}
		$alarm_type = self::get3rdDigit($alarm_type_id);
		foreach ($alarm_type_list as $item) {
			if ($item['code'] === $alarm_type) {
				return  $item['value'];
			}
		}
		return '';
	}
	//======================================== For the 3rd digit ============================================= END //
	
	public static function get1stDigit($alarm_type_id) {
		return substr($alarm_type_id, 0, 1);
	}
	
	public static function get2ndDigit($alarm_type_id) {
		return substr($alarm_type_id, 1, 1);
	}
	
	public static function get3rdDigit($alarm_type_id) {
		return substr($alarm_type_id, 2, 1);
	}
	
	/**
	 * Create combobox data
	 * @param array $data
	 * @return array
	 */
	private static function createComboboxData($data) {
		$arr = array();
		foreach ($data as $item) {
			$code = $item['code'];
			$value = $item['value'];
			$arr[$code] = $value;
		}
		return $arr;
	}
	
	/**
	 * Search value from array
	 * @param array $arr
	 * @param string $code
	 * @return string
	 */
	private static function searchData($arr, $code) {
		foreach ($arr as $item) {
			if ($item['code'] === $code) {
				return $item['value'];
			};
		}
		return '';
	}
}