<?php
App::uses('AppController', 'Controller');
/**
 * ManageReupController
 */
class ManageReupController extends AppController {
/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array(
			'TUser',
			'TCustomer',
			'TVideoReup',
			'TVideoSub',
			'TManageReup',
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
		$this->link = '/manageReup';
		$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->link);
		$user_id = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		$videos = $this->TManageReup->find('all',array(
			'fields' => 'TVideoReup.*',
			'conditions' => array(
					'TManageReup.DELETE_YMD is null',
					'TManageReup.USER_ID' => $user_id
			),
			'joins' =>array(
					array (
							'table' => 'T_VIDEO_REUP',
							'alias' => 'TVideoReup',
							'type' => 'left',
							'conditions' => array (
									'TVideoReup.VIDEO_ID = TManageReup.VIDEO_ID'
							)
					)
			),
			'order' => 'TVideoReup.PUBLISHED_AT'
		));
		
		$this->set('videos', $videos);
		return $this->render('/Manage/videoReup');
	}
	
	
	/**
	 * addVideoToSubscriptions
	 * @return CakeResponse
	 */
	public function addVideoToReup() {
		try {
			$this->title = $this->scrFieldLabels['SCR_MENU_SEARCH'];
			if ($this->request->is(array('post', 'put'))) {
				$searchParam = $this->request->data;
			}
			if(!isset($searchParam)){
				return $this->render('/Actions/search');
			}
			$videoIdSelectArr = $searchParam['hdn_id_video_id_select'];
			$videoIdArr = $searchParam['hdn_id_video_id_list'];
						
			if(isset($searchParam['id_hdn_next_page_token'])){
				$nextPageToken = $searchParam['id_hdn_next_page_token'];
				$this->set('nextPageToken', $nextPageToken);
			}
			if(isset($searchParam['id_hdn_prev_page_token'])){
				$prevPageToken = $searchParam['id_hdn_prev_page_token'];
				$this->set('prevPageToken', $prevPageToken);
			}
			if(isset($searchParam['id_hdn_total_results'])){
				$totalResults = $searchParam['id_hdn_total_results'];
				$this->set('totalResults', $totalResults);
			}
			if(isset($searchParam['id_hdn_page_of_results'])){
				$pageOfResults = $searchParam['id_hdn_page_of_results'];
				$this->set('pageOfResults', $pageOfResults);
			}
			if(isset($searchParam['id_hdn_results_per_page'])){
				$resultsPerPage = $searchParam['id_hdn_results_per_page'];
				$this->set('resultsPerPage', $resultsPerPage);
			}
			
			$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
				
			if($videoIdArr != ""){
				$videoIds = explode(",",$videoIdSelectArr);
				foreach ($videoIds as $videoId){
					if($videoId != ""){
						$this->addVideoToTManageReup($user_id_login, $videoId);
					}
				}
			}
				
			$videoIds = explode(",",$videoIdArr);
			$videoIdsRender = $this->getVideoSubList($videoIds);
			$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			$this->messages = array(
					'0' => $this->messages['OPERATION_SUCCESS']
			);
			$this->set('videos', $videoIdsRender);
			$this->set('videoIdSelectArr', $videoIdSelectArr);
			$this->set('typeSearch',1);
			$this->setParameterRender($searchParam);
			return $this->render('/Actions/search');
		} catch (Exception $e) {
			$this->errors = array(
					'0' => "Error12:" . $e->getMessage()
			);
			$this->setParameterRender($searchParam);
			return $this->render('/Actions/search');
		}
	}
	
	private function addVideoToTManageReup($userId, $videoId){
		try {
			$this->TVideoReup->begin();
			$this->TManageReup->begin();
			$videoSub = $this->getVideoSubInfoByVideoID($videoId);
			$video['TVideoReup'] = $videoSub['TVideoSub'];
			$this->TVideoReup->save($video);
			$isExist = $this->TManageReup->checkVideoExist($userId, $videoId);
			if(!$isExist){
				$tmanage = $this->TManageReup->create();
				$tmanage['TManageReup']['USER_ID'] = $userId;
				$tmanage['TManageReup']['VIDEO_ID'] = $videoId;
				$tmanage['TManageReup']['TYPE'] = '2';
				$this->TManageReup->save($tmanage);
			}
			$this->TVideoReup->commit();
			$this->TManageReup->commit();
			return true;
				
		}catch (Exception $e) {
			// Rollback
			$this->TVideoReup->rollback();
			$this->TManageReup->rollback();
			// Set error
			$this->errors = array(
					'0' => "Error01:" . $e->getMessage()
			);
		}
	
		return false;
	}
	
	private function getVideoSubInfoByVideoID($videoId){
		$video = $this->TVideoSub->find('first', array(
				'conditions' => array(
						'TVideoSub.VIDEO_ID' => $videoId,
						'TVideoSub.DELETE_YMD IS NULL'
				)
		));
		return $video;
	}
	
	private function getVideoSubList($videoIds){
		$videos = $this->TVideoSub->find('all', array(
				'conditions' => array(
						'TVideoSub.VIDEO_ID IN ' => $videoIds,
						'TVideoSub.DELETE_YMD IS NULL'
				),
				'order' => 'TVideoSub.VIDEO_ID'
		));
		return $videos;
	}
	
	public function setParameterRender($searchParam){
		if(isset($searchParam['q'])){
			$this->set('q',$searchParam['q']);
		}
		if(isset($searchParam['searchType'])){
			$this->set('searchType',$searchParam['searchType']);
		}
		if(isset($searchParam['maxResults'])){
			$this->set('maxResults',$searchParam['maxResults']);
		}
		if(isset($searchParam['date1'])){
			$this->set('date1',$searchParam['date1']);
		}
		if(isset($searchParam['date2'])){
			$this->set('date2',$searchParam['date2']);
		}
		if(isset($searchParam['videoDefinition'])){
			$this->set('videoDefinition',$searchParam['videoDefinition']);
		}
		if(isset($searchParam['videoDuration'])){
			$this->set('videoDuration',$searchParam['videoDuration']);
		}
		if(isset($searchParam['order'])){
			$this->set('order',$searchParam['order']);
		}
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
				$this->deleteVideoFromTManageReup($user_id_login, $videoIds);
			}
			
			$videoIds = explode(",",$videoIdArr);
			$videoIdsRender = $this->getVideoList($user_id_login);
			$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			$this->messages = array(
					'0' => $this->messages['OPERATION_SUCCESS']
			);
			$this->set('videos', $videoIdsRender);
			return $this->render('/Manage/videoReup');
		} catch (Exception $e) {
			$this->errors = array(
					'0' => "Error12:" . $e->getMessage()
			);
			return $this->render('/Manage/videoReup');
		}
	}
	
	private function deleteVideoFromTManageReup($userId, $videoIds){
		$this->TManageReup->begin();
		if(sizeof($videoIds) > 1){
			$this->TManageReup->updateAll(
					array('TManageReup.DELETE_YMD' => "NOW()"),
					array('TManageReup.USER_ID' => $userId, 
						'TManageReup.VIDEO_ID IN ' => $videoIds 
					)
			);
		}
		else{
			$this->TManageReup->updateAll(
					array('TManageReup.DELETE_YMD' => "NOW()"),
					array('TManageReup.USER_ID' => $userId, 
						'TManageReup.VIDEO_ID' => $videoIds[0] 
					)
			);
		}
		$this->TManageReup->commit();
	}
	
	private function getVideoList($user_id){
		$videos = $this->TManageReup->find('all',array(
			'fields' => 'TVideoReup.*',
			'conditions' => array(
					'TManageReup.DELETE_YMD is null',
					'TManageReup.USER_ID' => $user_id
			),
			'joins' =>array(
					array (
							'table' => 'T_VIDEO_REUP',
							'alias' => 'TVideoReup',
							'type' => 'left',
							'conditions' => array (
									'TVideoReup.VIDEO_ID = TManageReup.VIDEO_ID'
							)
					)
			),
			'order' => 'TVideoReup.PUBLISHED_AT'
		));
		return $videos;
	}
}