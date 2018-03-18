<?php
App::uses('AppController', 'Controller');
/**
 * ManageTempController
 */
class ManageTempController extends AppController {
/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array(
			'TUser',
			'TCustomer',
			'TVideoSub',
			'TManageSub',
	);
/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function index() {
		$this->title = $this->scrFieldLabels['SCR_MENU_SUBSCRIPTION'];
		$this->link = '/manageTemp';
		$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->link);
		$user_id = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		$videos = $this->TManageSub->find('all',array(
			'fields' => 'TVideoSub.*',
			'conditions' => array(
					'TManageSub.DELETE_YMD is null',
					'TManageSub.USER_ID' => $user_id
			),
			'joins' =>array(
					array (
							'table' => 'T_VIDEO_SUB',
							'alias' => 'TVideoSub',
							'type' => 'left',
							'conditions' => array (
									'TVideoSub.VIDEO_ID = TManageSub.VIDEO_ID'
							)
					)
			),
			'order' => 'TVideoSub.PUBLISHED_AT'
		));
		
		$this->set('videos', $videos);
		return $this->render('/Manage/videoTemp');
	}
	
	/**
	 * Xoa video 
	 */
	public function doDeleteVideo(){
		try {
			$this->title = $this->scrFieldLabels['SCR_MENU_SUBSCRIPTION'];
			if ($this->request->is(array('post', 'put'))) {
				$searchParam = $this->request->data;
			}
			$videoIdSelectArr = $searchParam['hdn_id_video_id_select'];
			$videoIdArr = $searchParam['hdn_id_video_id_list'];
			$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
			
			if($videoIdArr != ""){
				$videoIds = explode(",",$videoIdSelectArr);
//				foreach ($videoIds as $videoId){
//					if($videoId != ""){
				$this->deleteVideoFromTManageSub($user_id_login, $videoIds);
//					}
//				}
			}
			
			$videoIds = explode(",",$videoIdArr);
			$videoIdsRender = $this->getVideoList($user_id_login);
			$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			$this->messages = array(
					'0' => $this->messages['OPERATION_SUCCESS']
			);
			$this->set('videos', $videoIdsRender);
			return $this->render('/Manage/videoTemp');
		} catch (Exception $e) {
			$this->errors = array(
					'0' => "Error12:" . $e->getMessage()
			);
			return $this->render('/Manage/videoTemp');
		}
	}
	
	private function deleteVideoFromTManageSub($userId, $videoIds){
		$this->TManageSub->begin();
		if(sizeof($videoIds) > 1){
			$this->TManageSub->updateAll(
					array('TManageSub.DELETE_YMD' => "NOW()"),
					array('TManageSub.USER_ID' => $userId, 
						'TManageSub.VIDEO_ID IN ' => $videoIds 
					)
			);
		}
		else{
			$this->TManageSub->updateAll(
					array('TManageSub.DELETE_YMD' => "NOW()"),
					array('TManageSub.USER_ID' => $userId, 
						'TManageSub.VIDEO_ID' => $videoIds[0] 
					)
			);
		}
		$this->TManageSub->commit();
	}
	
	private function getVideoList($user_id){
		$videos = $this->TManageSub->find('all',array(
			'fields' => 'TVideoSub.*',
			'conditions' => array(
					'TManageSub.DELETE_YMD is null',
					'TManageSub.USER_ID' => $user_id
			),
			'joins' =>array(
					array (
							'table' => 'T_VIDEO_SUB',
							'alias' => 'TVideoSub',
							'type' => 'left',
							'conditions' => array (
									'TVideoSub.VIDEO_ID = TManageSub.VIDEO_ID'
							)
					)
			),
			'order' => 'TVideoSub.PUBLISHED_AT'
		));
		return $videos;
	}
	
	
}