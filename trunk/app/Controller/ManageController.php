<?php
App::uses('AppController', 'Controller');
/**
 * ManageController
 */
class ManageController extends AppController {
/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array(
			'TUser',
			'TCustomer',
			'TVideo',
			'TVideoSub',
			'TManage',
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
		$this->link = '/manage';
		$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->link);
		$user_id = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		$videos = $this->TManage->find('all',array(
			'fields' => 'TVideo.*, TManage.TYPE',
			'conditions' => array(
					'TManage.DELETE_YMD is null',
					'TManage.USER_ID' => $user_id
			),
			'joins' =>array(
					array (
							'table' => 'T_VIDEO',
							'alias' => 'TVideo',
							'type' => 'left',
							'conditions' => array (
									'TVideo.VIDEO_ID = TManage.VIDEO_ID'
							)
					)
			),
			'order' => 'TVideo.PUBLISHED_AT'
		));
		
		$this->set('videos', $videos);
		return $this->render('/Manage/video', 'admin');
	}
	
	/**
	 * addVideoToSubscriptions
	 * @return CakeResponse
	 */
	public function addVideoToSubscriptions() {
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
						$this->addVideoToTManage($user_id_login, $videoId);
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
	
	private function addVideoToTManage($userId, $videoId){
		try {
			$this->TVideo->begin();
			$this->TManage->begin();
			$videoSub = $this->getVideoSubInfoByVideoID($videoId);
			$video['TVideo'] = $videoSub['TVideoSub'];
			$this->TVideo->save($video);
			$isExist = $this->TManage->checkVideoExist($userId, $videoId);
			if(!$isExist){
				$tmanage = $this->TManage->create();
				$tmanage['TManage']['USER_ID'] = $userId;
				$tmanage['TManage']['VIDEO_ID'] = $videoId;
				$tmanage['TManage']['TYPE'] = '1';
				$this->TManage->save($tmanage);
			}
			$this->TVideo->commit();
			$this->TManage->commit();
			return true;
	
		}catch (Exception $e) {
			// Rollback
			$this->TVideo->rollback();
			$this->TManage->rollback();
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
	
	/*
	 * lay video de bo vao search
	 */
	private function getVideoSubList($videoIds){
		$videos = $this->TVideoSub->find('all', array(
				'conditions' => array(
						'TVideoSub.VIDEO_ID IN ' => $videoIds,
						'TVideoSub.DELETE_YMD IS NULL'
				),
				'order' => 'TVideo.PUBLISHED_AT'
		));
		return $videos;
	}
	
	private function getVideoListForRender($videoIds){
		
		$videos = $this->TManage->find('all',array(
			'fields' => 'TVideo.*, TManage.TYPE',
			'conditions' => array(
					'TManage.DELETE_YMD is null',
					"TVideo.VIDEO_ID IN ('" . implode("','",$videoIds) . "')"
			),
			'joins' =>array(
					array (
							'table' => 'T_VIDEO',
							'alias' => 'TVideo',
							'type' => 'left',
							'conditions' => array (
									'TVideo.DELETE_YMD IS NULL',
									'TVideo.VIDEO_ID = TManage.VIDEO_ID'
							)
					)
			),
			'order' => 'TVideo.PUBLISHED_AT'
		));
		return $videos;
	}
	
	/*
	 * setParameterRender
	 */
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
				$this->deleteVideoFromTManage($user_id_login, $videoIds);
			}
			
			$videoIds = explode(",",$videoIdArr);
			$videoIdsRender = $this->getVideoList($user_id_login);
			$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			$this->messages = array(
					'0' => $this->messages['OPERATION_SUCCESS']
			);
			$this->set('videos', $videoIdsRender);
			return $this->render('/Manage/video', 'admin');
		} catch (Exception $e) {
			$this->errors = array(
					'0' => "Error12:" . $e->getMessage()
			);
			return $this->render('/Manage/video', 'admin');
		}
	}
	
	private function deleteVideoFromTManage($userId, $videoIds){
		$this->TManage->begin();
		if(sizeof($videoIds) > 1){
			$this->TManage->updateAll(
					array('TManage.DELETE_YMD' => "NOW()"),
					array('TManage.USER_ID' => $userId, 
						'TManage.VIDEO_ID IN ' => $videoIds 
					)
			);
		}
		else{
			$this->TManage->updateAll(
					array('TManage.DELETE_YMD' => "NOW()"),
					array('TManage.USER_ID' => $userId, 
						'TManage.VIDEO_ID' => $videoIds[0] 
					)
			);
		}
		$this->TManage->commit();
	}
	
	private function getVideoList($user_id){
		$videos = $this->TManage->find('all',array(
			'fields' => 'TVideo.*, TManage.TYPE',
			'conditions' => array(
					'TManage.DELETE_YMD is null',
					'TManage.USER_ID' => $user_id
			),
			'joins' =>array(
					array (
							'table' => 'T_VIDEO',
							'alias' => 'TVideo',
							'type' => 'left',
							'conditions' => array (
									'TVideo.VIDEO_ID = TManage.VIDEO_ID'
							)
					)
			),
			'order' => 'TVideo.PUBLISHED_AT'
		));
		return $videos;
	}
	
	public function reloadVideoStatus(){
		try {
			$this->title = $this->scrFieldLabels['SCR_MENU_SEARCH'];
			if ($this->request->is(array('post', 'put'))) {
				$searchParam = $this->request->data;
			}
			if(!isset($searchParam)){
				return $this->render('/Manage/video', 'admin');
			}
			
			// Call set_include_path() as needed to point to your client library.
			//set_include_path('../Lib/src');
			require_once '../Lib/Google/autoload.php';
			require_once '../Lib/Google/Client.php';
			require_once '../Lib/Google/Service/YouTube.php';
			/*
			 * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
			 * Google Developers Console <https://console.developers.google.com/>
			 * Please ensure that you have enabled the YouTube Data API for your project.
			 */
			$DEVELOPER_KEY = $this->Session->read(RwsConstant::SESSION_USER_API_KEY);
			$client = new Google_Client();
			$client->setDeveloperKey($DEVELOPER_KEY);
			// Define an object that will be used to make all API requests.
			$youtube = new Google_Service_YouTube($client);
			
			$videoIdSelectArr = $searchParam['hdn_id_video_id_select'];
			$videoIdArr = $searchParam['hdn_id_video_id_list'];
			$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		
			if($videoIdArr != ""){
				$videoIds = explode(",",$videoIdSelectArr);
				foreach ($videoIds as $videoId){
					if($videoId != ""){
						$videoResult = $this->getVideoInfo($youtube, 'statistics', $videoId);
						if($videoResult != null){
							$videoResults[] = $videoResult;
						}
					}
				}
				$videos = $this->insertUpdateVideo($videoResults, $user_id_login);
			}
			$videoIds = explode(",",$videoIdArr);
			$videoIdsRender = $this->getVideoListForRender($videoIds);
			$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			$this->messages = array(
					'0' => $this->messages['OPERATION_SUCCESS']
			);
			
			$this->set('videoIdSelectArr', $videoIdSelectArr);
			$this->set('videos', $videoIdsRender);
			return $this->render('/Manage/video', 'admin');
		} catch (Exception $e) {
			$this->errors = array(
					'0' => "Error12:" . $e->getMessage()
			);
			return $this->render('/Manage/video', 'admin');
		}
	}
	
	public function getVideoInfo($youtube, $content, $videoId){
		$videosResponse = $youtube->videos->listVideos($content, array('id' => $videoId));
		if($videosResponse != null){
			if(sizeof($videosResponse['items']) == 0){
				return null;
			}
			$videoResult = $videosResponse['items'][0];
			if($videoResult != null){
				$videoResult['statistics']['viewCount'] = $videoResult['statistics']['viewCount'];
				$videoResult['statistics']['likeCount'] = $videoResult['statistics']['likeCount'];
				$videoResult['statistics']['dislikeCount'] = $videoResult['statistics']['dislikeCount'];
				$videoResult['statistics']['favoriteCount'] = $videoResult['statistics']['favoriteCount'];
				$videoResult['statistics']['commentCount'] = $videoResult['statistics']['commentCount'];
			}
			return $videoResult;
		}
		return null;
	}
	
	public function insertUpdateVideo($videoResults, $user_id_login){
		try {
			$videos = array();
			$manages = array();
			$this->TVideo->begin();
			$this->TManage->begin();
			foreach ($videoResults as $videoResult){
				$video = $this->TVideo->find('first', array(
						'conditions' => array(
								'VIDEO_ID' => $videoResult['id'],
								'DELETE_YMD IS NULL')
				));
				if(sizeof($video) > 0){
					$video['TVideo']['REJECTION_REASON'] = $videoResult['status']['rejectionReason'];
					$video['TVideo']['LICENSED_CONTENT'] = $videoResult['contentDetails']['licensedContent'];
					$video['TVideo']['REGION_RESTRICTION_BLOCKED'] = $videoResult['contentDetails']['regionRestriction']['blocked'][0];
					$video['TVideo']['VIEW_COUNT'] = $videoResult['statistics']['viewCount'];
					$video['TVideo']['LIKE_COUNT'] = $videoResult['statistics']['likeCount'];
					$video['TVideo']['DISLIKE_COUNT'] = $videoResult['statistics']['dislikeCount'];
					$video['TVideo']['FAVORITE_COUNT'] = $videoResult['statistics']['favoriteCount'];
					$video['TVideo']['COMMENT_COUNT'] = $videoResult['statistics']['commentCount'];
					$video['TVideo']['DEFINITION'] = $videoResult['contentDetails']['definition'];
					$video['TVideo']['PRIVACY_STATUS'] = $videoResult['status']['privacyStatus'];
		
					$this->TVideo->save($video);
					$videos[] = $video;
		
					$this->TManage->updateAll(
							array('UPDATE_YMD' => "NOW()"),
							array('USER_ID' => $user_id_login, 
									'VIDEO_ID' => $video['TVideo']['VIDEO_ID']
							)
					);
				}
			}
				
			$this->TVideo->commit();
			$this->TManage->commit();
				
			return $videos;
		} catch (Exception $e) {
			// Rollback
			$this->TVideo->rollback();
			$this->TManage->rollback();
			// Set error
			$this->errors = array(
					'0' => "Error02:" . $e->getMessage()
			);
		}
		return null;
	}
	
	/**
	 * Show video to homepage 
	 */
	public function doSetVideoToHomepage(){
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
				$this->setVideoToHomepageFromTManage($user_id_login, $videoIds);
			}
			
			$videoIds = explode(",",$videoIdArr);
			$videoIdsRender = $this->getVideoList($user_id_login);
			$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			$this->messages = array(
					'0' => $this->messages['OPERATION_SUCCESS']
			);
			$this->set('videos', $videoIdsRender);
			return $this->render('/Manage/video', 'admin');
		} catch (Exception $e) {
			$this->errors = array(
					'0' => "Error12:" . $e->getMessage()
			);
			return $this->render('/Manage/video', 'admin');
		}
	}
	
	private function setVideoToHomepageFromTManage($userId, $videoIds){
		$this->TManage->begin();
		if(sizeof($videoIds) > 1){
			$this->TManage->updateAll(
					array('TManage.UPDATE_YMD' => "NOW()", 
						  'TManage.TYPE' => 2),
					array('TManage.VIDEO_ID IN ' => $videoIds,  
					)
			);
		}
		else{
			$this->TManage->updateAll(
					array('TManage.UPDATE_YMD' => "NOW()", 
						  'TManage.TYPE' => 2),
					array('TManage.VIDEO_ID' => $videoIds[0] 
					)
			);
		}
		$this->TManage->commit();
	}
	
/**
	 * Show video to homepage 
	 */
	public function doRemoveVideoFromHomepage(){
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
				$this->removeVideoToHomepageFromTManage($user_id_login, $videoIds);
			}
			
			$videoIds = explode(",",$videoIdArr);
			$videoIdsRender = $this->getVideoList($user_id_login);
			$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			$this->messages = array(
					'0' => $this->messages['OPERATION_SUCCESS']
			);
			$this->set('videos', $videoIdsRender);
			return $this->render('/Manage/video', 'admin');
		} catch (Exception $e) {
			$this->errors = array(
					'0' => "Error12:" . $e->getMessage()
			);
			return $this->render('/Manage/video', 'admin');
		}
	}
	
	private function removeVideoToHomepageFromTManage($userId, $videoIds){
		$this->TManage->begin();
		if(sizeof($videoIds) > 1){
			$this->TManage->updateAll(
					array('TManage.UPDATE_YMD' => "NOW()", 
						  'TManage.TYPE' => 3),
					array('TManage.VIDEO_ID IN ' => $videoIds,  
					)
			);
		}
		else{
			$this->TManage->updateAll(
					array('TManage.UPDATE_YMD' => "NOW()", 
						  'TManage.TYPE' => 3),
					array('TManage.VIDEO_ID' => $videoIds[0] 
					)
			);
		}
		$this->TManage->commit();
	}
}