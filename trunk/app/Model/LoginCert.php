<?php
App::uses('AppModel', 'Model');
/**
 * LoginCert Model
 *
 */
class LoginCert extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'LOGIN_CERT';

	public function updateLoginTimeLimit($cert, $cert_id, $permission){
		if ($this->deleteAll(array('id' => $cert_id,'CERT' => $cert))) {
			$date = date('Y-m-d H:i:s', time()+1800);
			$data = $this->create(array(
					'CERT' => $cert,
					'ID' => $cert_id,
					'PERMISSION' => $permission,
					'TIMELIMIT' => $date));
			return $this->save($data);
		}
		return false;
	}
}
