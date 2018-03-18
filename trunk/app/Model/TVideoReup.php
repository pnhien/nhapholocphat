<?php
App::uses('AppModel', 'Model');
/**
 * TVideoReup Model
 *
 */
class TVideoReup extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'T_VIDEO_REUP';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'VIDEO_ID';
	
	public function checkVideoExist($videoId){
		$video = $this->find('first', array(
			'conditions' => array(
					'TVideoReup.VIDEO_ID' => $videoId,
					'TVideoReup.DELETE_YMD IS NULL'
			)
		));
		if($video != null){
			return true;
		}
		else{
			return false;
		}
	}
}
