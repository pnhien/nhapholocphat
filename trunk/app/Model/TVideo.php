<?php
App::uses('AppModel', 'Model');
/**
 * TVideo Model
 *
 */
class TVideo extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'T_VIDEO';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'VIDEO_ID';
	
	public function checkVideoExist($videoId){
		$video = $this->find('first', array(
			'conditions' => array(
					'TVideo.VIDEO_ID' => $videoId,
					'TVideo.DELETE_YMD IS NULL'
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
