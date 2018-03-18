<?php
App::uses('AppModel', 'Model');
/**
 * TManage Model
 *
 */
class TManage extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'T_MANAGE';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'USER_ID,VIDEO_ID';

//	public function getMaxId(){
//		$tmanage = $this->find('first', array(
//			'fields' => 'COALESCE(MAX(ID),0) AS MAX_ID',
//		));
//		$maxId = $tmanage[0]['MAX_ID'];
//		return $maxId;
//	}

	public function checkVideoExist($userId, $videoId){
		$tManage = $this->find('first', array(
			'conditions' => array(
					'TManage.USER_ID' => $userId,
					'TManage.VIDEO_ID' => $videoId,
					'TManage.DELETE_YMD IS NULL'
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
