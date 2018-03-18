<?php
App::uses('AppController', 'Controller');
/**
 * SearchController
 */
class SearchController extends AppController {
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
			'TVideoReup',
			'TManage',
			'TManageSub',
			'TManageReup'
	);
/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function index() {
		$this->title = $this->scrFieldLabels['SCR_MENU_SEARCH'];
		$this->link = '/search';
		$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->link);
		$user_id = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		$user = $this->TUser->find('first', array(
				'conditions' => array(
						'TUser.USER_ID' => $user_id
				)
		));
		$customer = $this->TCustomer->find('first', array(
				'conditions' => array(
						'TCustomer.USER_ID' => $user_id
				)
		));
		if(!empty($user)){
			$vlanguage = $user['TUser']['LANGUAGE'];
			$this->set('userlanguage', $vlanguage);
		}
		if(!empty($customer)){
			$this->set('TCustomer', $customer['TCustomer']);
		}
		
		$searchParam = $this->request->query;
		if(isset($searchParam['type'])){
			$this->set('typeSearch',$searchParam['type']);
		}
		else{
			$this->set('typeSearch',1);
		}
		return $this->render('/Actions/search', 'admin');
	}	
	/**
	 * loadInfo
	 * @return CakeResponse
	 */
	public function loadSearchInfo() {
		$this->title = $this->scrFieldLabels['SCR_MENU_SEARCH'];
		// This code will execute if the user entered a search query in the form
		// and submitted the form. Otherwise, the page displays the form above.
		if ($this->request->is(array('post', 'put'))) {
			$searchParam = $this->request->data;
		}
		if (isset($searchParam['q']) && $searchParam['maxResults']) {
			try {
				$htmlBody = '';
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
                $user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
                $user = $this->TUser->find('first', array(
					'conditions' => array(
							'TUser.USER_ID' => $user_id_login
					)
				));
				if(!empty($user)){
					$vlanguage = $user['TUser']['LANGUAGE'];
					$this->set('userlanguage', $vlanguage);
				}
                if(isset($searchParam['isga'])){
                	$isGa = true;
                }
                else{
                	$isGa = false;
                }
				if($searchParam['searchType'] == RwsConstant::SEARCH_ITEM_VIDEO){
					try {
	                    $videoResults = array();
						$videoId = str_replace('https://www.youtube.com/watch?v=','',$searchParam['q']);
						$videoId = str_replace('https://youtu.be/','',$videoId);
						$videoResult = $this->getVideoInfo($youtube, 'snippet, statistics, status, contentDetails', $videoId);
						if($videoResult != null){
							$videoResults[] = $videoResult;
						}
						$videos = $this->insertUpdateVideo($videoResults, $searchParam['q'], $user_id_login);
						$this->set('videos', $videos);
						$this->setParameterRender($searchParam);
					} catch (Google_ServiceException $e) {
						$htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
						htmlspecialchars("Error11:" . $e->getMessage()));
						$this->Session->setFlash($htmlBody, 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$this->setParameterRender($searchParam);
						return $this->render('/Actions/search', 'admin');
					} catch (Google_Exception $e) {
						$htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
						htmlspecialchars("Error10:" . $e->getMessage()));
						$this->Session->setFlash($htmlBody, 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$this->setParameterRender($searchParam);
						return $this->render('/Actions/search', 'admin');
					}
				
				}
				else if($searchParam['searchType'] == RwsConstant::SEARCH_ITEM_CHANNEL){
					
					try {
	                    $videoResults = array();
	                    $channelId = str_replace('https://www.youtube.com/user/','',$searchParam['q']);
	                    $channelId = str_replace('https://www.youtube.com/channel/','',$channelId);
						$channelId = str_replace('/videos','',$channelId);
		                $videos = $this->getVideoFromChannel($channelId);
		                if($videos != null){
			                foreach ($videos as $videoId){
								$videoId = str_replace('https://youtu.be/','',$videoId);
				                $videoResult = $this->getVideoInfo($youtube, 'snippet, statistics, status, contentDetails', $videoId);
								if($videoResult != null){
									$videoResults[] = $videoResult;
								}
							}
		                }
		                $videos = $this->insertUpdateVideo($videoResults, $searchParam['q'], $user_id_login);
						$this->set('videos', $videos);
						$this->setParameterRender($searchParam);
					} catch (Google_ServiceException $e) {
						$htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
						htmlspecialchars("Error09:" . $e->getMessage()));
						$this->Session->setFlash($htmlBody, 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$this->setParameterRender($searchParam);
						return $this->render('/Actions/search', 'admin');
					} catch (Google_Exception $e) {
						$htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
						htmlspecialchars("Error08:" . $e->getMessage()));
						$this->Session->setFlash($htmlBody, 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$this->setParameterRender($searchParam);
						return $this->render('/Actions/search', 'admin');
					}
				}
				else if($searchParam['searchType'] == RwsConstant::SEARCH_ITEM_URl){
					try {
	                    $videoResults = array();
	                    $url = $searchParam['q'];
		                $videos = $this->getVideoFromUrl($url);
			            if($videos != null){
			                foreach ($videos as $videoId){
								$videoId = str_replace('https://www.youtube.com/watch?v=','',$videoId);
								$videoId = str_replace('https://youtu.be/','',$videoId);
				                $videoResult = $this->getVideoInfo($youtube, 'snippet, statistics, status, contentDetails', $videoId, $isGa);
								if($videoResult != null){
									$videoResults[] = $videoResult;
								}
							}
		                }
						$videos = $this->insertUpdateVideo($videoResults, $searchParam['q'], $user_id_login);
						$this->set('videos', $videos);
						$this->setParameterRender($searchParam);
					} catch (Google_ServiceException $e) {
						$htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
						htmlspecialchars("Error07:" . $e->getMessage()));
						$this->Session->setFlash($htmlBody, 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$this->setParameterRender($searchParam);
						return $this->render('/Actions/search', 'admin');
					} catch (Google_Exception $e) {
						$htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
						htmlspecialchars("Error06:" . $e->getMessage()));
						$this->Session->setFlash($htmlBody, 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$this->setParameterRender($searchParam);
						return $this->render('/Actions/search', 'admin');
					}
				}
				else{					
					try {						
						$arraySearch = array();
						$query = "";						
						if($searchParam['q'] != ''){							
							$arraySearch['q'] = $searchParam['q'];
							$query = $query + "search_query=" + str_replace(" ", "+", $searchParam['q']);						}						if($searchParam['maxResults'] != ''){							$arraySearch['maxResults'] = $searchParam['maxResults'];						}						if($searchParam['date1'] != ''){							$arraySearch['publishedAfter'] = $searchParam['date1'].'T00:00:00Z';						}						if($searchParam['date2'] != ''){							$arraySearch['publishedBefore'] = $searchParam['date2'].'T00:00:00Z';						}						if($searchParam['videoDefinition'] != ''){							$arraySearch['videoDefinition'] = $searchParam['videoDefinition'];						}						if($searchParam['videoDuration'] != ''){
							$arraySearch['videoDuration'] = $searchParam['videoDuration'];
						}
						if($searchParam['order'] != ''){
							$arraySearch['order'] = $searchParam['order'];
						}
						if(isset($searchParam['id_hdn_next_page_token']) && $searchParam['id_hdn_next_page_token'] != ''){
							$arraySearch['pageToken'] = $searchParam['id_hdn_next_page_token'];
							$pageOfResults = $searchParam['id_hdn_page_of_results'] + 1;
						}
						else if(isset($searchParam['id_hdn_prev_page_token']) && $searchParam['id_hdn_prev_page_token'] != ''){
							$arraySearch['pageToken'] = $searchParam['id_hdn_prev_page_token'];
							$pageOfResults = $searchParam['id_hdn_page_of_results'] - 1;
						}
						else{
							$pageOfResults = 1;
						}
						
						$arraySearch['type'] = 'video';
						$searchResponse = $youtube->search->listSearch('id, snippet', $arraySearch);
						$nextPageToken = $searchResponse['nextPageToken'];
						$prevPageToken = $searchResponse['prevPageToken'];
						$totalResults = $searchResponse['pageInfo']['totalResults'];
						$resultsPerPage = $searchResponse['pageInfo']['resultsPerPage'];
						$videos = '';
						$channels = '';
						$playlists = '';
						// Add each result to the appropriate list, and then display the lists of
						// matching videos, channels, and playlists.
						$cnt = 1;
	                   $videoResults = array();
						foreach ($searchResponse['items'] as $searchResult) {
							switch ($searchResult['id']['kind']) {
								case 'youtube#video':
									$videoResult = $this->getVideoInfo($youtube, 'snippet, statistics, status, contentDetails', $searchResult['id']['videoId'], $isGa);
									if($videoResult != null){
										$videoResults[] = $videoResult;
									}
									break;
								case 'youtube#channel':
									$channels .= sprintf('<li>%0.1$d : %s (%s)</li>',
									$cnt, $searchResult['snippet']['title'], $searchResult['id']['channelId']);
									break;
								case 'youtube#playlist':
									$playlists .= sprintf('<li>%1$d : %s (%s)</li>',
									$cnt, $searchResult['snippet']['title'], $searchResult['id']['playlistId']);
									break;
							}
							$cnt++;
						}
						$videos = $this->insertUpdateVideo($videoResults, $searchParam['q'], $user_id_login);
						$this->set('videos', $videos);
						
						$this->set('nextPageToken', $nextPageToken);
						$this->set('prevPageToken', $prevPageToken);
						$this->set('totalResults', $totalResults);
						$this->set('pageOfResults', $pageOfResults);
						$this->set('resultsPerPage', $resultsPerPage);
						
						$this->set('typeSearch',1);
						$this->setParameterRender($searchParam);
					} catch (Google_ServiceException $e) {
						$htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
						htmlspecialchars("Error05:" . $e->getMessage()));
						$this->Session->setFlash($htmlBody, 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$this->setParameterRender($searchParam);
						return $this->render('/Actions/search', 'admin');
					} catch (Google_Exception $e) {
						$htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
						htmlspecialchars("Error04:" . $e->getMessage()));
						$this->Session->setFlash($htmlBody, 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$this->setParameterRender($searchParam);
						return $this->render('/Actions/search', 'admin');
					}
				}
			} catch (Exception $e) {
				$htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
				htmlspecialchars("Error03:" . $e->getMessage()));
				$this->Session->setFlash($htmlBody, 'message', array('message_type' => RwsConstant::MSG_ERROR));
				$this->setParameterRender($searchParam);
				return $this->render('/Actions/search', 'admin');
			}
			
		}
		return $this->render('/Actions/search', 'admin');
	}
	
	public function setParameterRender($searchParam){
		foreach ($searchParam as $key => $value){
			$this->set($key,$value);
		}
		$this->set('typeSearch',1);
	}
	
	public function getVideoInfo($youtube, $content, $videoId, $isGa = false){
		$videosResponse = $youtube->videos->listVideos($content, array('id' => $videoId));
		if($videosResponse != null){
			if(sizeof($videosResponse['items']) == 0){
				return null;
			}
			$videoResult = $videosResponse['items'][0];
			if($videoResult != null){
// 			 	$videoResult['statistics']['viewCount'] = $videoResult['statistics']['viewCount'];
// 			 	$videoResult['statistics']['likeCount'] = $videoResult['statistics']['likeCount'];
// 			 	$videoResult['statistics']['dislikeCount'] = $videoResult['statistics']['dislikeCount'];
// 			 	$videoResult['statistics']['favoriteCount'] = $videoResult['statistics']['favoriteCount'];
// 			 	$videoResult['statistics']['commentCount'] = $videoResult['statistics']['commentCount'];			 	
				$videoResult['attribution'] = $this->getMetaAttribution($videoResult['id']);
				if($isGa){
					if (strlen($videoResult['attribution']) != 22){
						return null;
					}
				}
				$datePub = date_create($videoResult['snippet']['publishedAt']);
				$videoResult['snippet']['publishedAt'] = $datePub->format('Y-m-d H:i:s');
			}
			return $videoResult;
		}
		return null;
	}
	
    public function getCountShot($numberLong){
    	if($numberLong < 1000){
    		return $numberLong;
    	}
    	else if($numberLong > 1000000){
    		$numberLong = substr($numberLong, 0, strlen($numberLong)-5);
    		$numberLong = $numberLong / 10.0;
    		return $numberLong . "m";
    	}
    	else{
    		$numberLong = substr($numberLong, 0, strlen($numberLong)-2);
    		$numberLong = $numberLong / 10.0;
    		return $numberLong . "k";
    	}
    }
    
	function getMetaAttribution($videoId){
		$url = "https://www.youtube.com/watch?v=" . $videoId;
	   // store page
	   $meta = array();
	   $page=file_get_contents($url);
	   $reg_exUrl = '/<meta name=attribution content=(.+?)\/>/';//<meta name=attribution content=\/(.+?)<\/>/';
	   if(preg_match_all($reg_exUrl, $page, $content)) {
	   		$meta['attribution'] = $content[1][0];
	   		return $meta['attribution'];
	   }
   		return "";
	}
	
	function getVideoFromChannel($channelId){
	   if(empty($channelId)){
	   		return null;
	   }
	   try{
	   $videos = array();
	   $url = "https://www.youtube.com/channel/" . $channelId . "/videos";
	   $page=file_get_contents($url);
	   $reg_exUrl = '/v\=(.+?)\">/';
	   if(preg_match_all($reg_exUrl, $page, $videoList)) {
	   		for($i = 0 ; $i < sizeof($videoList[1]); $i++ ){
	   			$videos[] = $videoList[1][$i];
	   		}
	   }
	   
	   if(sizeof($videos) == 0){
		   $url = "https://www.youtube.com/user/" . $channelId . "/videos";
		   $page=file_get_contents($url);
		   $reg_exUrl = '/v\=(.+?)\">/';
		   if(preg_match_all($reg_exUrl, $page, $videoList)) {
		   		for($i = 0 ; $i < sizeof($videoList[1]); $i++ ){
		   			$videos[] = $videoList[1][$i];
		   		}
		   }
	   }
	   } catch (Exception $e) {
	   	    $url = "https://www.youtube.com/user/" . $channelId . "/videos";
		   $page=file_get_contents($url);
		   $reg_exUrl = '/v\=(.+?)\">/';
		   if(preg_match_all($reg_exUrl, $page, $videoList)) {
		   		for($i = 0 ; $i < sizeof($videoList[1]); $i++ ){
		   			$videos[] = $videoList[1][$i];
		   		}
		   }
	   }
   		return $videos;
	}
	
	function getVideoFromUrl($url){
		if(empty($url)){
	   		return null;
	   }
	   $videos = array();
	   $page=file_get_contents($url);
	   $reg_exUrl = '/v\=(.+?)\"/';
	   if(preg_match_all($reg_exUrl, $page, $videoList)) {
	   		for($i = 0 ; $i < sizeof($videoList[1]); $i++ ){
	   			$isExist = false;
	   			for($j = sizeof($videos) - 1; $j >= 0 ; $j-- ){
	   				if($videos[$j] == $videoList[1][$i]){
	   					$isExist = true;
	   					break;
	   				}
	   			}
	   			if(!$isExist){
	   				$videos[] = $videoList[1][$i];
	   			}
	   		}
	   }
   		return $videos;
	}
	
	public function insertUpdateVideo($videoResults, $keyword, $user_id_login, $isGa = NULL){
		try {
			$videoSubs = array();
			$manageSubs = array();  
			$this->TVideoSub->begin();
			$this->TManageSub->begin();
			foreach ($videoResults as $videoResult){
				if($isGa){
					if(strlen($videoResult['attribution']) != 22){
						continue;
					}
				}
				$videoSub = $this->TVideoSub->create();
				$videoSub['TVideoSub']['VIDEO_ID'] = $videoResult['id'];
				$videoSub['TVideoSub']['THUMBNAILS'] = $videoResult['snippet']['thumbnails']['medium']['url'];
				$videoSub['TVideoSub']['TITLE'] = $videoResult['snippet']['title'];
				$videoSub['TVideoSub']['CHANNEL_TITLE'] = $videoResult['snippet']['channelTitle'];
				$videoSub['TVideoSub']['CHANNEL_ID'] = $videoResult['snippet']['channelId'];
				$videoSub['TVideoSub']['ATTRIBUTION'] = $videoResult['attribution'];
				if(strlen($videoSub['TVideoSub']['ATTRIBUTION']) == 22){
					$videoSub['TVideoSub']['GA'] = 1;
				}
				else{
					$videoSub['TVideoSub']['GA'] = 0;
				}
				$videoSub['TVideoSub']['REJECTION_REASON'] = $videoResult['status']['rejectionReason'];
				$videoSub['TVideoSub']['LICENSED_CONTENT'] = $videoResult['contentDetails']['licensedContent'];
				$videoSub['TVideoSub']['REGION_RESTRICTION_BLOCKED'] = $videoResult['contentDetails']['regionRestriction']['blocked'][0];
				$videoSub['TVideoSub']['VIEW_COUNT'] = $videoResult['statistics']['viewCount'];
				$videoSub['TVideoSub']['LIKE_COUNT'] = $videoResult['statistics']['likeCount'];
				$videoSub['TVideoSub']['DISLIKE_COUNT'] = $videoResult['statistics']['dislikeCount'];
				$videoSub['TVideoSub']['FAVORITE_COUNT'] = $videoResult['statistics']['favoriteCount'];
				$videoSub['TVideoSub']['COMMENT_COUNT'] = $videoResult['statistics']['commentCount'];
				$videoSub['TVideoSub']['PUBLISHED_AT'] = $videoResult['snippet']['publishedAt'];
				$videoSub['TVideoSub']['DIMENSION'] = $videoResult['contentDetails']['dimension'];
				$videoSub['TVideoSub']['DEFINITION'] = $videoResult['contentDetails']['definition'];
				$interval = new DateInterval($videoResult['contentDetails']['duration']);
				$videoSub['TVideoSub']['DURATION'] = $interval->h.":".$interval->i .":". $interval->s;
				$videoSub['TVideoSub']['PRIVACY_STATUS'] = $videoResult['status']['privacyStatus'];
				$videoSub['TVideoSub']['DELETE_YMD'] = null;
				
				$this->TVideoSub->save($videoSub);
				$videoSubs[] = $videoSub;
				
				$manageSub = $this->TManageSub->create();
				$manageSub['TManageSub']['USER_ID'] = $user_id_login;
				$manageSub['TManageSub']['VIDEO_ID'] = $videoSub['TVideoSub']['VIDEO_ID'];
				$manageSub['TManageSub']['KEYWORD'] = $keyword;
				$manageSub['TManageSub']['TYPE'] = 0;
				$this->TManageSub->save($manageSub);
				$manageSubs[] = $manageSub;
			}
			
			$this->TVideoSub->commit();
			$this->TManageSub->commit();
			
			return $videoSubs;
		} catch (Exception $e) {
			// Rollback
			$this->TVideoSub->rollback();
			$this->TManageSub->rollback();
			// Set error
			$this->errors = array(
					'0' => "Error02:" . $e->getMessage()
			);
		}
		return null;
	}
	
	function curl($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$data = curl_exec($ch);
		curl_close($ch);
	
		return $data;
	}
}