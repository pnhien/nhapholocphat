<?php
App::uses('AppModel', 'Model');
/**
 * TManageReup Model
 *
 */
class TManageReup extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'T_MANAGE_REUP';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'ID';
	
	public function checkVideoExist($userId, $videoId){
		$tManage = $this->find('first', array(
			'conditions' => array(
					'USER_ID' => $userId,
					'VIDEO_ID' => $videoId,
					'DELETE_YMD IS NULL'
			)
		));
		if($tManage != null){
			return true;
		}
		else{
			return false;
		}
	}
}
