<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class TUser extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'T_USER';

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array (
			'USER_ID' => array (
					'rule' => array ('notEmpty'),
					'message' => 'Input user_id'
			),
			'USER_PASSWORD' => array (
					'rule' => array ('notEmpty'),
					'message' => 'Input user_password'
			)
	);
	
	public function updateLastLoginTime($user_id, $country){
		return $this->updateAll(
				array('LAST_LAST_LOGIN' => 'LAST_LOGIN', 'LAST_IP_LOGIN' => 'IP_LOGIN', 'LAST_LOGIN' => 'now()', 'COUNTRY' => "'$country'"),
				array('USER_ID' => $user_id)
		);
	}
	
	public function updateIpLogin($user_id, $ip_login){
		return $this->updateAll(
				array('IP_LOGIN' => "'$ip_login'"),
				array('USER_ID' => $user_id)
		);
	}
	
	
	
	public function updateLanguage($user_id, $lang){
		return $this->updateAll(
				array('LANGUAGE' => "'$lang'"),
				array('USER_ID' => $user_id)
		);
	}
}
