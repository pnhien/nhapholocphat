<?php
App::uses ( 'AppController', 'Controller' );

/**
 * ResultsController
 */
class ResultsController extends AppController {
	public $uses = array (
			'TRssNews',
			'TNews',
			'TVideo',
			'TManage'
	);
	
	/**
	 * Displays a view Results
	 */
	public function index() {
		$this->title = "Mua bán nhà phố - Tư vấn mua bán nhà";
		$this->urlHistories = array (
				'Home',
				$this->title 
		);
		//require_once 'GetRssNewsController.php';
		//$getRssNews = new GetRssNewsController ();
		//$getRssNews->getRssNewsUser();
		
		$paraLanguage = $this->request->query;
		if(isset($paraLanguage['hl'])){
			if($this->getCheckLanguage($paraLanguage['hl'])){
				$this->language = $paraLanguage['hl'];
				$this->Cookie->write(RwsConstant::COOKIE_KEY_LANGUAGE, $this->language);
				$this->applyLanguage();
			}
		}
		
		$limit = 40;
		//if($this->language != 'vn'){
		//	$limit = 35;
		//} else {
			// read news info
			$newsList = array ();
			// Validate Results
			$videos = $this->TManage->find('all',array(
					'fields' => 'TVideo.*',
					'conditions' => array(
							'TManage.DELETE_YMD is null',
							'TManage.TYPE' => 2
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
					'limit' => $limit,
					'order' =>array('PUBLISHED_AT'=>'DESC')
			));
			
			if(sizeof($videos) > 0){
				$this->set('videos', $videos);
			}
		//}
		$newsArr = $this->TNews->find ( 'all', array (
				'fields' => array (
						'TNews.ID, TNews.TITLE, TNews.LINK, TNews.SUMMARY_IMG, TRssNews.TYPE, TRssNews.HOME' 
				),
				'conditions' => array (
						'TNews.DELETE_YMD IS NULL',
						//'TNews.CONTENT <> ""',
						'TRssNews.LANGUAGE' => $this->language
				),
				'joins' => array (
						array (
								'table' => 'T_RSS_NEWS',
								'alias' => 'TRssNews',
								'type' => 'left',
								'conditions' => array (
										'TRssNews.ID = TNews.RSS_NEWS_ID'
								) 
						) 
				),
				'limit' => 200,
				'order' =>array('TNews.PUB_DATE'=>'DESC')
				));
		
		$type0Count = 0;
		$type1Count = 0;
		foreach ( $newsArr as $news ) {
			if($news['TRssNews']['TYPE'] == 0 && $type0Count < $limit){
				$newsList [] = $news;
				$type0Count++;
			}
			else if($news['TRssNews']['TYPE'] == 1 && $type1Count < $limit){
				$newsList [] = $news;
				$type1Count++;
			}
		}
		// News
//		$newsArr = $this->TNews->find ( 'all', array (
//				'fields' => array (
//						'TNews.ID, TNews.TITLE, TNews.LINK, TNews.SUMMARY_IMG, TRssNews.TYPE, TRssNews.HOME' 
//				),
//				'conditions' => array (
//						'TNews.DELETE_YMD IS NULL',
//						'TNews.CONTENT <> ""',
//						'TRssNews.TYPE' => 1 
//				),
//				'joins' => array (
//						array (
//								'table' => 'T_RSS_NEWS',
//								'alias' => 'TRssNews',
//								'type' => 'left',
//								'conditions' => array (
//										'TRssNews.ID = TNews.RSS_NEWS_ID' ,
//										'TRssNews.LANGUAGE' => $this->language
//								) 
//						) 
//				),
//				'limit' => $limit,
//				'order' =>array('TNews.PUB_DATE'=>'DESC') 
//				) 
//		) );
//		
//		foreach ( $newsArr as $news ) {
//			$newsList [] = $news;
//		}

		if(sizeof($newsList) > 0){
			$this->set ( 'newsList', $newsList );
		}
		
		$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		if(isset($user_id_login)){
			return $this->render ( '/results', 'admin' );
		} 
		else {
			return $this->render ( '/results' );
		}
	}
	
	/**
	 * Search results on youtube
	 */
	public function search() {
		$this->title = "Mua bán nhà phố - Tư vấn mua bán nhà";
		$this->urlHistories = array (
				'Home',
				$this->title 
		);
		$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		
		$searchParam = $this->request->query;
		if (isset ( $searchParam )) {
			$searchParam = str_replace(" ", "+", $searchParam);
			$searchParam = str_replace("&", "%26", $searchParam);
			$searchParam = str_replace("=", "%3D", $searchParam);
			
			$paramUrl = "";
			$isGa = false;
			foreach ($searchParam as $key => $param ){
				if($key == 'isga'){
					$isGa = true;
					continue;
				}
				if($paramUrl == ""){
					$paramUrl = $key . "=" . $param;
				}else{
					$paramUrl =  $paramUrl . "&" . $key . "=" . $param;
				}
			}
			
			if(!isset($searchParam['search_query'])){
				if(isset($searchParam['type']) && $searchParam['type'] == 1 ){
					$this->set('typeSearch',1);
					return $this->render('/Actions/search');
				}
				else{
					$this->set('typeSearch',0);
					return $this->render ( '/results' );
				}
			}
			
			if (!$this->Session->check(RwsConstant::SESSION_LOGIN_USER_KEY)) {
				require_once 'GetRssNewsController.php';
				$getRss = new GetRssNewsController();
	
				$url = "https://www.youtube.com/results?" . $paramUrl;			
				$page = file_get_contents ( $url );
				$divClassName = '<div class="branded-page-v2-primary-col">';
				$html = $getRss->getContentDivClass($page, $divClassName);
				$divClassNameRemove = '<div class="filter-button-container">';
				$html = $getRss->removeContentDivClass($html, $divClassNameRemove);
				$html = str_replace("contains-addto","",$html);
				
				$pointDataThumb = strpos($html, "data-thumb");
				
				$html = str_replace("src","src!@#",$html);
				$html = str_replace("data-thumb","src",$html);
				$html = str_replace("src!@#","data-thumb",$html);
				$htmlFirst = substr($html, 0, $pointDataThumb);
				$htmlLast = substr($html, $pointDataThumb, strlen($html));
				$htmlFirst = str_replace("data-thumb", "src", $htmlFirst);
				
				$this->set("resultsHtml", $htmlFirst . $htmlLast);
				$this->set("resultsParam",$paramUrl);
				return $this->render ( '/results' );
			}
			else{
				try {
					$htmlBody = '';
					// Call set_include_path() as needed to point to your client library.
					require_once 'SearchController.php';
					require_once '../Lib/Google/autoload.php';
					require_once '../Lib/Google/Client.php';
					require_once '../Lib/Google/Service/YouTube.php';
					/*
					 * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
					 * Google Developers Console <https://console.developers.google.com/>
					 * Please ensure that you have enabled the YouTube Data API for your project.
					 */
					$DEVELOPER_KEY = $this->Session->read ( RwsConstant::SESSION_USER_API_KEY );
					if($DEVELOPER_KEY == null){
						$DEVELOPER_KEY = 'AIzaSyDzN1ZOKxn-hChbqlKDWog29VzDYrgMtqI';
					}
					$client = new Google_Client ();
					$client->setDeveloperKey ( $DEVELOPER_KEY );
					// Define an object that will be used to make all API requests.
					$youtube = new Google_Service_YouTube ( $client );
					$searchControl = new SearchController();
					
					try {
						$videoResults = array ();
						$videos = $this->getVideoFromSearchYoutube($paramUrl );
						if ($videos != null) {
							foreach ( $videos as $videoId ) {
								$videoId = str_replace ( 'https://youtu.be/', '', $videoId );
								$videoResult = $searchControl->getVideoInfo ( $youtube, 'snippet,statistics, status, contentDetails', $videoId, $isGa);
								if ($videoResult != null) {
									$videoResults [] = $videoResult;
								}
							}
						}
						$videos = $searchControl->insertUpdateVideo( $videoResults, $searchParam['search_query'], $user_id_login);
						$this->set ( 'videos', $videos );
						$this->setParameterRender($searchParam);
					} catch ( Google_ServiceException $e ) {
						$htmlBody .= sprintf ( '<p>A service error occurred: <code>%s</code></p>', htmlspecialchars ( "Error09:" . $e->getMessage () ) );
						$this->Session->setFlash ( $htmlBody, 'message', array (
								'message_type' => RwsConstant::MSG_ERROR
						) );
						$this->setParameterRender($searchParam);
						return $this->render('/Actions/search');
					} catch ( Google_Exception $e ) {
						$htmlBody .= sprintf ( '<p>An client error occurred: <code>%s</code></p>', htmlspecialchars ( "Error08:" . $e->getMessage () ) );
						$this->Session->setFlash ( $htmlBody, 'message', array (
								'message_type' => RwsConstant::MSG_ERROR
						) );
						$this->setParameterRender($searchParam);
						return $this->render('/Actions/search');
					}
				} catch ( Exception $e ) {
					$htmlBody .= sprintf ( '<p>An client error occurred: <code>%s</code></p>', htmlspecialchars ( "Error03:" . $e->getMessage () ) );
					$this->Session->setFlash ( $htmlBody, 'message', array (
							'message_type' => RwsConstant::MSG_ERROR
					) );
					$this->setParameterRender($searchParam);
					return $this->render('/Actions/search');
				}
				
				$this->set('typeSearch',0);
				return $this->render('/Actions/search');
			}
		}
		
		if(isset($user_id_login)){
			return $this->render ( '/results', 'admin' );
		} 
		else {
			return $this->render ( '/results' );
		}
	}
	
	public function setParameterRender($searchParam){
		$this->set( 'typeSearch',0 );
		foreach ($searchParam as $key => $param ){
			if($key == 'filters'){
				$strParamArr = explode(",+", $param);
				foreach ($strParamArr as $filters ){
					if(in_array($filters, array('hour','today','week','month','year'))){
						$this->set('videoUploadDate', $filters);
					}
					else if(in_array($filters, array('video','channel','playlist','movie','show'))){
						$this->set('videoType', $filters);
					}
					else if(in_array($filters, array('sort','long'))){
						$this->set('videoDuration', $filters);
					}
					else if(in_array($filters, array('4k','hd','cc','creativecommons','3d','live','purchased','spherical'))){
						$this->set('videoFeature', $filters);
					}
				}
			}
			if($param == ""){
				$this->set( $key, '');
			}else{
				$this->set( $key, $param);
			}
		}
	}
	
	function getVideoFromSearchYoutube($param) {
		if (empty ( $param )) {
			return null;
		}
		$videos = array ();
		$url = "https://www.youtube.com/results?" . $param;
		$page = file_get_contents ( $url );
		$reg_exUrl = '/<a href=\"\/watch\?v\=(.+?)\"/';
		if (preg_match_all ( $reg_exUrl, $page, $videoList )) {
			for($i = 0; $i < sizeof ( $videoList [1] ); $i ++) {
				$videos [] = $videoList [1] [$i];
			}
		}
		return $videos;
	}
	
}