<?php
App::uses('AppController', 'Controller');

/**
 * SeoTopController
 */
class SeoTopController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array(
			'TUser',
			'TCustomer',
			'TSeoTop'
	);

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function index() {
		$this->title = $this->scrFieldLabels['SCR_MENU_SEO_TOP'];
		$this->link = '/seoTop';
		$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->link);
		
		$user_id = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		
		return $this->render('/Actions/seoTop', 'admin');
	}
	
	public function doSearchSeoTopYoutube() {
	$searchParam = $this->request->data;
		
		if(isset($searchParam['searchType'])){
			if($searchParam['searchType'] == 0){
				$q = $searchParam['q'];
				$q = str_replace(" ", "+", $q);
				$q = str_replace("&", "%26", $q);
				$q = str_replace("=", "%3D", $q);
				
				$paramUrl = "search_query=" . $q;
				if(isset($searchParam['videoUploadDate']) && $searchParam['videoUploadDate'] != ''){
					$paramUrl = $paramUrl . "&videoUploadDate=" . $searchParam['videoUploadDate'];
				}
				$accept = array('videoUploadDate','videoType','videoDuration','videoFeature','videoSortBy');
				foreach ($searchParam as $key => $param ){
					if(in_array($key,$accept) && $param != '' && $param != '0'){
						$paramUrl =  $paramUrl . "&" . $key . "=" . $param;
					}
				}
				$urlQuery = "https://www.youtube.com/results?" . $paramUrl;
				
				$yourVideoId = $searchParam['yourUrl'];
				$yourVideoId = str_replace('https://www.youtube.com/watch?v=', '', $yourVideoId);
				$yourVideoId = str_replace('https://youtu.be/', '', $yourVideoId);
				$yourVideoId = str_replace('www.youtube.com/watch?v=', '', $yourVideoId);
				$yourVideoId = str_replace('youtu.be/', '', $yourVideoId);
				
				//$reg_content_search = '/watch?v=(.+)\"/';
				$reg_content_search = '/i.ytimg.com\/vi\/(.+)\/mqdefault.jpg/';
				$searchTop = $searchParam['topSearch'];
				$seoTopSearchArr = array();
				$pagesearch = array();
				$urlSearch = $urlQuery;
				$dateNow = new DateTime();
				$pageMax = $searchTop/20;
				for($k = 1 ; $k <= $pageMax ; $k++){
					$searchContent = file_get_contents($urlSearch);
//					$this->set('pagesearch',$urlSearch);
					if(preg_match_all($reg_content_search, $searchContent, $preg_content_search)) {
		    			for ($i=0 ; $i < count($preg_content_search[1]) ; $i++) {
		    				$videoIdSearch = $preg_content_search[1][$i];
		    				if($videoIdSearch == $yourVideoId){
		    					$seoTop = $this->TSeoTop->create();
		    					$seoTop['TSeoTop']['TYPE'] = $searchParam['searchType'];
		    					$seoTop['TSeoTop']['KEYWORD'] = $searchParam['q'];
		    					$seoTop['TSeoTop']['YOUR_URL'] = $searchParam['yourUrl'];
		    					$seoTop['TSeoTop']['TOP_SEARCH'] = $searchParam['topSearch'];
		    					$seoTop['TSeoTop']['LINK'] = 'https://www.youtube.com/watch?v=' . $videoIdSearch;
		    					$seoTop['TSeoTop']['LINK_GOOGLE'] = $urlSearch;
		    					$seoTop['TSeoTop']['CREATE_YMD'] = $dateNow->format('Y-m-d H:i:s');;
		    					$seoTop['TSeoTop']['TOP'] = ($k-1)*20 + $i + 1;
		    					$this->TSeoTop->save($seoTop);
		    					$seoTopSearchArr[] = $seoTop;
		    					$this->set('seoTopSearchArr', $seoTopSearchArr);
		    					foreach ($searchParam as $key => $value){
		    						$this->set($key, $value);
		    					}
		    					return $this->render('/Actions/seoTop', 'admin');
		    				}
		    			}
		    		}
		    		$urlSearch = $urlQuery . '&page='. ($k+1);
		    		if($k + 1 <= $pageMax){
		    			sleep(0.5);
		    		}
				}
				foreach ($searchParam as $key => $value){
					$this->set($key, $value);
				}
			}
		}
		return $this->render('/Actions/seoTop', 'admin');
	}
	
	public function doSearchSeoTopWeb() {
		$searchParam = $this->request->data;
		
		if(isset($searchParam['searchType'])){
			if($searchParam['searchType'] == 1){
				$q = $searchParam['q'];
				$q = str_replace(" ", "+", $q);
				$q = str_replace("&", "%26", $q);
				$q = str_replace("=", "%3D", $q);
				$urlQuery = 'https://www.google.com/search?q=' . $q;
				$reg_content_search = '/<cite(.+)<\/cite>/Uism';
				$searchTop = $searchParam['topSearch'];
				$seoTopSearchArr = array();
				$urlSearch = $urlQuery;
				$dateNow = new DateTime();
				for($k = 0 ; $k < $searchTop ; $k+=10){
					$searchContent = file_get_contents($urlSearch);
					$content = $this->getContentDivClass($searchContent, '<div id="search">');
// 					$this->set('searchContent', $content);
					
					if(preg_match_all($reg_content_search, $content, $preg_content_search)) {
		    			for ($i=0 ; $i < count($preg_content_search[1]) ; $i++) {
		    				$urlTmp = $preg_content_search[1][$i];
	    					$urlTmp = str_replace("<b>", "", $urlTmp);
	    					$urlTmp = str_replace("</b>", "", $urlTmp);
		    				if(strpos($urlTmp, $searchParam['yourUrl'])){
		    					$iPoint = strpos($urlTmp, ">");
		    					$url = "http://" . substr($urlTmp, $iPoint+1);
		    					$seoTop = $this->TSeoTop->create();
		    					$seoTop['TSeoTop']['TYPE'] = $searchParam['searchType'];
		    					$seoTop['TSeoTop']['KEYWORD'] = $searchParam['q'];
		    					$seoTop['TSeoTop']['YOUR_URL'] = $searchParam['yourUrl'];
		    					$seoTop['TSeoTop']['TOP_SEARCH'] = $searchParam['topSearch'];
		    					$seoTop['TSeoTop']['LINK'] = $url;
		    					$seoTop['TSeoTop']['LINK_GOOGLE'] = $urlSearch;
		    					$seoTop['TSeoTop']['CREATE_YMD'] = $dateNow->format('Y-m-d H:i:s');;
		    					$seoTop['TSeoTop']['TOP'] = $k + $i + 1;
		    					$this->TSeoTop->save($seoTop);
		    					$seoTopSearchArr[] = $seoTop;
		    				}
		    			}
		    		}
		    		$urlSearch = $urlQuery . '&start='. ($k+10);
		    		if($k+10 < $searchTop){
		    			sleep(0.5);
		    		}
				}
				
				$this->set('seoTopSearchArr', $seoTopSearchArr);
				foreach ($searchParam as $key => $value){
					$this->set($key, $value);
				}
			}
		}
		return $this->render('/Actions/seoTop', 'admin');
	}
	
	function getContentUrlTimeOut($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$data = curl_exec($ch);
		curl_close($ch);
	
		return $data;
	}
	
	function getContentDivClass($html, $divClassName){
    	if($html == null){
    		return "";
    	}
    	if(strpos($html,$divClassName) !== false){
    		$pointBegin = strpos($html,$divClassName);	
    	}
    	else{
    		return "";
    	}
    	$pointEnd = 0;
    	$html = substr($html, $pointBegin);
    	
    	$posDiv = array();
    	$posEndDiv = array();
    	$pos = -1;
    	while (($pos = strpos($html, "<div", $pos+1)) !== false) {
    		$posDiv[] = $pos;
    	}
    	$pos = -1;
    	while (($pos = strpos($html, "</div>", $pos+1)) !== false) {
    		$posEndDiv[] = $pos;
    	}
    	
    	$flgDiv = 0;
    	$flgStop = false;
    	$iDiv = 0;
    	$iEndDiv = 0;
    	while(!$flgStop){
    		if($posDiv[$iDiv] < $posEndDiv[$iEndDiv]){
    			$flgDiv++;
    			$iDiv++;
    		}
    		else{
    			$flgDiv--;
    			$iEndDiv++;
    		}
    		
    		if($flgDiv == 0){
    			$pointEnd = $posEndDiv[$iEndDiv-1];
    			$flgStop = true;
    		}
    		else if($iDiv >= sizeof($posDiv) || $iEndDiv >= sizeof($posEndDiv)){
    			$pointEnd = 0;
    			$flgStop = true;
    		}
    	}
    	
    	$content = substr($html, 0, $pointEnd) . "</div>"; 
    	return $content;
    }
}