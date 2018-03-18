<?php
App::uses('AppController', 'Controller');

/**
 * GetRssNewsController
 */
class GetRssNewsController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array(
		'TRssNews',
		'TNews'
	);

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function index() {
		date_default_timezone_set("Asia/Bangkok");
		$this->title = $this->scrFieldLabels['SCR_MENU_GET_RSS_NEWS'];
		$this->link = '/search';
		$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->link);
		$this->getRssNews();
		$this->set('page',"Updated");
		return $this->render('/Actions/getRssNews', 'admin');
	}
	
	
	//For user
	public function updateRssNews(){
		try{
			$rssNewsListEntertainment = $this->TRssNews->find('all', array(
				'limit' => 1,
				'conditions' => array(
						'DELETE_YMD IS NULL',
						'(UPDATE_YMD IS NULL OR TIMESTAMPDIFF(MINUTE,UPDATE_YMD,CURRENT_TIMESTAMP()) >= '. RwsConstant::ITEM_TIME_GET_RSS_NEWS .')'
				),
				'order' =>array('SORT'=>'ASC')
			));
			foreach ($rssNewsListEntertainment as $rssNews){
				$this->setUpdateYmdRssNews($rssNews);
				if($rssNews['TRssNews']['LANGUAGE'] == 'vn'){
					$this->getInfoRssNews($rssNews);
				}
				else if($rssNews['TRssNews']['LANGUAGE'] == 'en'){
					if($rssNews['TRssNews']['HOME'] == 'http://abcnews.go.com'){
						$this->getInfoRssNewsForAbcNews($rssNews);
					}
					else{
						$this->getInfoRssNews($rssNews);
					}
				}
				else if($rssNews['TRssNews']['LANGUAGE'] == 'ja'){
					if($rssNews['TRssNews']['HOME'] == 'http://www.asahi.com'){
						$this->getInfoRssNewsForJAAsahi($rssNews);
					}
					else{
						$this->getInfoRssNews($rssNews);
					}
				}
				$this->setLastUpdateRssNews($rssNews);
			}
		}catch (Exception $e) {
			$this->errors = array("Error14:" . $e->getMessage());
			return $this->render('/results', 'admin');
		}
	}
	
	//For admin get all rss one time
	function getRssNews(){
		try{
			$rssNewsUpdated = array();
			$rssNewsList = $this->TRssNews->find('all', array(
				'limit' => 10,
				'conditions' => array(
						'DELETE_YMD IS NULL',
						'(UPDATE_YMD IS NULL OR TIMESTAMPDIFF(MINUTE,UPDATE_YMD,CURRENT_TIMESTAMP()) >= '. RwsConstant::ITEM_TIME_GET_RSS_NEWS .')'
				),
				'order' =>array('UPDATE_YMD'=>'ASC')
			));
			foreach ($rssNewsList as $rssNews){
				$this->setUpdateYmdRssNews($rssNews);
				if($rssNews['TRssNews']['LANGUAGE'] == 'vn'){
					$this->getInfoRssNews($rssNews);
				}
				else if($rssNews['TRssNews']['LANGUAGE'] == 'en'){
					if($rssNews['TRssNews']['HOME'] == 'http://abcnews.go.com'){
						$this->getInfoRssNewsForAbcNews($rssNews);
					}
					else{
						$this->getInfoRssNews($rssNews);
					}
				}
				else if($rssNews['TRssNews']['LANGUAGE'] == 'ja'){
					if($rssNews['TRssNews']['HOME'] == 'http://www.asahi.com'){
						$this->getInfoRssNewsForJAAsahi($rssNews);
					}
					else{
						$this->getInfoRssNews($rssNews);
					}
				}
				
				$report = $this->setLastUpdateRssNews($rssNews);
				if($report != false){
					$report = $rssNews['TRssNews']['URL'] . $report;
				}
				else{
					$report = $rssNews['TRssNews']['URL'];
				}
				$rssNewsUpdated[] = $report;
			}
			$this->set('rssNewsUpdated',$rssNewsUpdated);
		}catch (Exception $e) {
			$this->errors = array("Error14:" . $e->getMessage());
			return $this->render('/Actions/getRssNews', 'admin');
		}
	}
	
//For admin get all rss one time
	function getRssNewsUser(){
		try{
			$rssNewsUpdated = array();
			$rssNewsList = $this->TRssNews->find('all', array(
				'limit' => 1,
				'conditions' => array(
						'DELETE_YMD IS NULL',
						'(UPDATE_YMD IS NULL OR TIMESTAMPDIFF(MINUTE,UPDATE_YMD,CURRENT_TIMESTAMP()) >= '. RwsConstant::ITEM_TIME_GET_RSS_NEWS .')'
				),
				'order' =>array('UPDATE_YMD'=>'ASC')
			));
			foreach ($rssNewsList as $rssNews){
				$this->setUpdateYmdRssNews($rssNews);
				if($rssNews['TRssNews']['LANGUAGE'] == 'vn'){
					$this->getInfoRssNews($rssNews);
				}
				else if($rssNews['TRssNews']['LANGUAGE'] == 'en'){
					if($rssNews['TRssNews']['HOME'] == 'http://abcnews.go.com'){
						$this->getInfoRssNewsForAbcNews($rssNews);
					}
					else{
						$this->getInfoRssNews($rssNews);
					}
				}
				else if($rssNews['TRssNews']['LANGUAGE'] == 'ja'){
					if($rssNews['TRssNews']['HOME'] == 'http://www.asahi.com'){
						$this->getInfoRssNewsForJAAsahi($rssNews);
					}
					else{
						$this->getInfoRssNews($rssNews);
					}
				}
				
			}
		}catch (Exception $e) {
			$this->errors = array("Error14:" . $e->getMessage());
			return $this->render('/Actions/getRssNews', 'admin');
		}
	}
	
	/**
     * updateTimeRssNews
     */
    public function setUpdateYmdRssNews($rssNews){
        // The Regular Expression filter
    	try{
    		$this->TRssNews->begin();
	        $this->TRssNews->updateAll(
				array(
					'UPDATE_YMD' => "NOW()"
				),
				array('ID' => $rssNews['TRssNews']['ID'])
			);
    		$this->TRssNews->commit();
	    } 
    	catch (Exception $e) {
    		$this->TNews->rollback();
    		$this->TRssNews->rollback();
			$this->errors = array("Error15:" . $e->getMessage());
			return $this->render('/Actions/getRssNews', 'admin');
		}
        return false;
    }
    
	/**
     * updateTimeRssNews
     */
    public function setLastUpdateRssNews($rssNews){
        // The Regular Expression filter
    	try{
    		$this->TRssNews->begin();
    		$news = $this->TNews->find('first', array(
    			'fields' => array('MAX(PUB_DATE) AS MAX_PUB_DATE'),
    			'conditions' => array('RSS_NEWS_ID' => $rssNews['TRssNews']['ID'])
    		));
			$dateUpdate = $news[0]['MAX_PUB_DATE'];
    		if(sizeof($news) > 0){
		        $this->TRssNews->updateAll(
					array(
						'LAST_UPDATE' => "'$dateUpdate'"
					),
					array('ID' => $rssNews['TRssNews']['ID'])
				);
    		}
    		$this->TRssNews->commit();
    		return $dateUpdate;
	    } 
    	catch (Exception $e) {
    		$this->TNews->rollback();
    		$this->TRssNews->rollback();
			$this->errors = array("Error15:" . $e->getMessage());
			return $this->render('/Actions/getRssNews', 'admin');
		}
        return false;
    }
	
	/**
     * Get insert news
     */
    public function getInfoRssNews($rssNews){
        // The Regular Expression filter
    	try{
	        $rsslink = $rssNews['TRssNews']['URL'];
	        if(empty($rsslink)){
	            return;    
	        }
	        
    		try{
				$channelPage = $this->getContentUrlTimeOut($rsslink);
			}catch (Exception $e) {
				return;
			}
			
	        $reg_regular_item = "/<item.*>(.+)<\/item>/Uism";
	        $reg_detail_link = '/<link>(.+)<\/link>/Uism';
	        if(preg_match_all($reg_regular_item, $channelPage, $newsDetailInfo)) {
	        	$this->TNews->begin();
	        	$newsList = array();
	        	$oldId = -1;
  	        	$newsOldList = $this->TNews->find('all', array(
	    			'fields' => array('LINK'),
	    			'conditions' => array('RSS_NEWS_ID' => $rssNews['TRssNews']['ID']),
					'limit' => 50,
  	        		'order' =>array('PUB_DATE'=>'desc')
	    		));
	        	for ($i = 0 ; $i < count($newsDetailInfo[1]); $i++) {
	        		$newLink = $this->getNewsDetailLink($newsDetailInfo[1][$i], $rssNews);
	        		for($j = sizeof($newsOldList)-1 ; $j >= 0; $j--){
						if($newLink == $newsOldList[$j]['TNews']['LINK']){
							$oldId = $i;
						}
	        		}

	        		if($oldId != -1){
	        			break;
	        		}
	        	}
	        	
	         if($oldId == -1){
	        		$oldId = count($newsDetailInfo[0]);
	        	}
	        	
	        	if($oldId > 0){
	        		for ($i = $oldId - 1; $i >= 0; $i--) {
		        		$news = $this->getUpdateInfoRssNewsDetail($newsDetailInfo[1][$i], $rssNews);
		        		if(!$news){
		        			break;
		        		}
		        		
		        		$newsList[] = $news;
		        	}
		        	if(sizeof($newsList) > 0 ){
		        		$this->saveNews($newsList, $rssNews);
		        		unset($newsList);
		        		$this->TNews->commit();
		        	}
	        	}
	        }
	    } 
    	catch (Exception $e) {
    		$this->TNews->rollback();
			$this->errors = array("Error13:" . $e->getMessage());
			return $this->render('/');
		}
        return false;
    }
    
	 /**
     * get link
     */
    public function getNewsDetailLink($newsDetail, $rssNews){
    		$reg_detail_link = '/<link>(.+)<\/link>/Uism';
    		if(preg_match($reg_detail_link, $newsDetail, $preg_detail_link)){
            $detail_link = $this->replaceCData($preg_detail_link[1]);
    		
				if($rssNews['TRssNews']['HOME'] == 'http://www.dailymail.co.uk'){
					$reg_link = "/http:\/\/(.+?)\?/";
					if(preg_match($reg_link, $detail_link, $preg_link)){
						$detail_link = "http://" . $preg_link[1];
					}
				}
    		}
			return $detail_link;
    }
    
    /**
     * get index old
     */
    public function checkNewsOld($newsDetail, $rssNews, $linkOld){
    		$reg_detail_link = '/<link>(.+)<\/link>/Uism';
    		if(preg_match($reg_detail_link, $newsDetail, $preg_detail_link)){
            $detail_link = $this->replaceCData($preg_detail_link[1]);
    		
				if($rssNews['TRssNews']['HOME'] == 'http://www.dailymail.co.uk'){
					$reg_link = "/http:\/\/(.+?)\?/";
					if(preg_match($reg_link, $detail_link, $preg_link)){
						$detail_link = "http://" . $preg_link[1];
					}
				}
    		}
			if($detail_link == $linkOld){
				return true;
			}
    }
    
	/**
     * Get insert/update news_details
     */
    public function getUpdateInfoRssNewsDetail($newsDetail, $rssNews){
    	date_default_timezone_set("Asia/Bangkok");
        $reg_detail_title = '/<title>(.+)<\/title>/Uism';
        $reg_detail_description = '/<description.*>(.+)<\/description>/Uism';
        $reg_detail_link = '/<link>(.+)<\/link>/Uism';
        $reg_detail_date = '/<pubDate>(.+)<\/pubDate>/Uism';

        $regContent = $rssNews['TRssNews']['REG_CONTENT'];
        $regContent2 = $rssNews['TRssNews']['REG_CONTENT2'];
        
        $reg_detail_summary_img = '';
        $detail_summary_img = '';
        if($rssNews['TRssNews']['REG_IMAGE'] != ''){
	        $regImage = explode( RwsConstant::ITEM_SLIPT_BEGIN_END , $rssNews['TRssNews']['REG_IMAGE']);
	        if(sizeof($regImage) == 2){
		        $regImageBegin = $regImage[0];
		        $regImageEnd = $regImage[1];
		        $reg_detail_summary_img = '/'.$regImageBegin.'(.+)'.$regImageEnd.'/Uism';
	        }
	        else{
	        	$reg_detail_summary_img = '/src=\"(.+?)\"/';
	        }
        }
        
        $detail_title = '';
        $detail_description = '';
        $detail_link = '';
//        $detail_content = '';
        $detail_date = '';
        
        if(preg_match($reg_detail_date, $newsDetail, $preg_detail_date)){
            $get_date = $this->replaceCData($preg_detail_date[1]);
         $flg = strpos($get_date, "(GMT+7)");
            if($flg){
            	$detail_date = new DateTime();   
            }
            else{
            	$detail_date = new DateTime($get_date);
            }
        }
        //$updateTime = new DateTime($rssNews['TRssNews']['LAST_UPDATE']);
//        if($rssNews['TRssNews']['LAST_UPDATE'] != "" && ($detail_date <= $updateTime)){
//        	return false;
//        }
        
    	if(preg_match($reg_detail_description, $newsDetail, $preg_detail_description)){
            $detail_description = $this->replaceCData($preg_detail_description[1]);
            if($detail_summary_img == ''){
	            if(preg_match($reg_detail_summary_img, $detail_description, $preg_detail_summary_img)){
	            	if(sizeof($preg_detail_summary_img) == 2){
	            		$detail_summary_img = $this->replaceCData($preg_detail_summary_img[1]);
	            	}
	            }
            }
        }
        
        if(preg_match($reg_detail_link, $newsDetail, $preg_detail_link)){
            $detail_link = $this->replaceCData($preg_detail_link[1]);
            //====GET SPECIAL NEWS BEGIN====//
			if($rssNews['TRssNews']['HOME'] == 'http://www.dailymail.co.uk'){
				$reg_link = "/http:\/\/(.+?)\?/";
				if(preg_match($reg_link, $detail_link, $preg_link)){
					$detail_link = "http://" . $preg_link[1];
				}
			}
//			if($detail_link == $linkOld){
//				return null;
//			}
			
            //$detail_content = $this->getContentUrlExt($detail_link, $regContent, $regContent2);
            
//        	if($detail_summary_img == ''){
//	            if(preg_match($reg_detail_summary_img, $detail_content, $preg_detail_summary_img)){
//	            	if(sizeof($preg_detail_summary_img) == 2){
//	            		$detail_summary_img = $this->replaceCData($preg_detail_summary_img[1]);
//	            	}
//	            }
//            }
        } 
        
        if(preg_match($reg_detail_title, $newsDetail, $preg_detail_title)){
            $detail_title = $this->replaceCData($preg_detail_title[1]);
        }
               
        if($detail_date == ''){
        	$detail_date = new DateTime();
        }
       	$pubDate = $detail_date->format('Y-m-d H:i:s');
       	
       	//====CHECK SPECIAL NEWS BEGIN====//
       	if($rssNews['TRssNews']['HOME'] == 'http://www3.nhk.or.jp'){
	       	$linkSlipArr = explode('/',$detail_link);
	    	if(sizeof($linkSlipArr) > 1){
	    		$pathUrlImage = str_replace($linkSlipArr[sizeof($linkSlipArr)-1], '', $detail_link);
	    	}    		
		
	       	//$detail_content = str_replace('src="', 'src="'.$pathUrlImage, $detail_content);
	       	//$detail_content_image =  $this->getContentDivClass($detail_content, '<div id="news_image_div">');
       		//if(preg_match('/src=\"(.+?)\"/', $detail_content_image, $preg_detail_summary_img)){
            //	if(sizeof($preg_detail_summary_img) == 2){
            //		$detail_summary_img = $this->replaceCData($preg_detail_summary_img[1]);
            //	}
            //}
            //else{
            $detail_summary_img = $rssNews['TRssNews']['REG_IMAGE'];
            //}
       	}
       	else if($rssNews['TRssNews']['HOME'] == 'http://www.dailymail.co.uk'){
       		$reg_detail_summary_img = '/<enclosure url=\"(.+?)\"/';
       		if(preg_match($reg_detail_summary_img, $newsDetail, $preg_detail_summary_img)){
       			if(sizeof($preg_detail_summary_img) == 2){
           			$detail_summary_img = $this->replaceCData($preg_detail_summary_img[1]);
            	}
       		}
       		else{
            	$detail_summary_img = $rssNews['TRssNews']['REG_IMAGE'];
            }
            
        //    $detail_content = $this->removeContentDivClass($detail_content, '<div id="wideCommentAdvert"');
        //    $detail_content = $this->removeContentDivClass($detail_content, '<div id="taboola-below-main-column"');
        //    $detail_content = $this->removeContentDivClass($detail_content, '<div class="item" id="most-watched-videos-wrapper"');
        //    $detail_content = $this->removeContentDivClass($detail_content, '<div id="most-read-news"');
        //    $detail_content = $this->removeContentDivClass($detail_content, '<div class="xwv-related-videos-container-4 rotator news">');
        //    $detail_content = $this->removeContentDivClass($detail_content, '<div id="most-read-news-wrapper"');
		//	$detail_content = $this->removeContentDivClass($detail_content, '<div id="js-comments"');
        //    $detail_content = $this->removeContentDivClass($detail_content, '<div id="reader-comments"');
        //    $detail_content = $this->removeContentDivClass($detail_content, '<div id="infinite-list"');
        //    $detail_content = $this->removeContentDivClass($detail_content, '<div id="reader-comments"');
        //    $detail_content = $this->removeContentDivClass($detail_content, '<div class="topcommenter">');
        //    $detail_content = $this->removeContentDivClass($detail_content, '<div class="rc-header link-ccow">');
        //    $detail_content = $this->removeContentDivClass($detail_content, '<div id="readerCommentsCommand"');

       	}
       	//====CHECK SPECIAL NEWS END====//
        
        $news = $this->TNews->create();
        $news['TNews']['RSS_NEWS_ID'] = $rssNews['TRssNews']['ID'];
        $news['TNews']['TITLE'] = trim($detail_title);
        $news['TNews']['DESCRIPTION'] = trim($detail_description);
        $news['TNews']['PUB_DATE'] = $pubDate;
        $news['TNews']['LINK'] = $detail_link;
        $news['TNews']['SUMMARY_IMG'] = $detail_summary_img;
        //$news['TNews']['CONTENT'] = trim($detail_content);
        //$this->saveNews($news, $rssNews);
        return $news;
    }
    
	/**
     * Get insert/update news_details
     */
    public function updateContentDetail($rssNews){	
        $detail_content = $this->getContentUrlExt($rssNews['TNews']['LINK'], $rssNews['TRssNews']['REG_CONTENT'], $rssNews['TRssNews']['REG_CONTENT2']);
		$detail_summary_img = $rssNews['TNews']['SUMMARY_IMG'];
       	if($detail_summary_img == ''){
	        if(preg_match($reg_detail_summary_img, $detail_content, $preg_detail_summary_img)){
		         if(sizeof($preg_detail_summary_img) == 2){
		          $detail_summary_img = $this->replaceCData($preg_detail_summary_img[1]);
		         }
	        }
        }
        $detail_title = $rssNews['TNews']['TITLE'];
        //if(preg_match($reg_detail_title, $newsDetail, $preg_detail_title)){
        //    $detail_title = $this->replaceCData($preg_detail_title[1]);
        //}
               
        //if($detail_date == ''){
        //	$detail_date = new DateTime();
        //}
       	//$pubDate = $detail_date->format('Y-m-d H:i:s');
       	
       	//====CHECK SPECIAL NEWS BEGIN====//
       	$detail_link = $rssNews['TNews']['LINK'];
       	if($rssNews['TRssNews']['HOME'] == 'http://www3.nhk.or.jp'){
	       	$linkSlipArr = explode('/',$detail_link);
	    	if(sizeof($linkSlipArr) > 1){
	    		$pathUrlImage = str_replace($linkSlipArr[sizeof($linkSlipArr)-1], '', $detail_link);
	    	}    		
		
	       	$detail_content = str_replace('src="', 'src="'.$pathUrlImage, $detail_content);
	       	$detail_content_image =  $this->getContentDivClass($detail_content, '<div id="news_image_div">');
       		if(preg_match('/src=\"(.+?)\"/', $detail_content_image, $preg_detail_summary_img)){
            	if(sizeof($preg_detail_summary_img) == 2){
            		$detail_summary_img = $this->replaceCData($preg_detail_summary_img[1]);
            	}
            }
            else{
            	$detail_summary_img = $rssNews['TRssNews']['REG_IMAGE'];
            }
       	}
       	else if($rssNews['TRssNews']['HOME'] == 'http://www.dailymail.co.uk'){
       		$reg_detail_summary_img = '/<enclosure url=\"(.+?)\"/';
       		//if(preg_match($reg_detail_summary_img, $newsDetail, $preg_detail_summary_img)){
       		//	if(sizeof($preg_detail_summary_img) == 2){
            //		$detail_summary_img = $this->replaceCData($preg_detail_summary_img[1]);
            //	}
       		//}
       		//else{
            //	$detail_summary_img = $rssNews['TRssNews']['REG_IMAGE'];
            //}
            
            $detail_content = $this->removeContentDivClass($detail_content, '<div id="wideCommentAdvert"');
            $detail_content = $this->removeContentDivClass($detail_content, '<div id="taboola-below-main-column"');
            $detail_content = $this->removeContentDivClass($detail_content, '<div class="item" id="most-watched-videos-wrapper"');
            $detail_content = $this->removeContentDivClass($detail_content, '<div id="most-read-news"');
            $detail_content = $this->removeContentDivClass($detail_content, '<div class="xwv-related-videos-container-4 rotator news">');
            $detail_content = $this->removeContentDivClass($detail_content, '<div id="most-read-news-wrapper"');
			$detail_content = $this->removeContentDivClass($detail_content, '<div id="js-comments"');
            $detail_content = $this->removeContentDivClass($detail_content, '<div id="reader-comments"');
            $detail_content = $this->removeContentDivClass($detail_content, '<div id="infinite-list"');
            $detail_content = $this->removeContentDivClass($detail_content, '<div id="reader-comments"');
            $detail_content = $this->removeContentDivClass($detail_content, '<div class="topcommenter">');
            $detail_content = $this->removeContentDivClass($detail_content, '<div class="rc-header link-ccow">');
            $detail_content = $this->removeContentDivClass($detail_content, '<div id="readerCommentsCommand"');

       	}
       	//====CHECK SPECIAL NEWS END====//
       	$rssNews['TNews']['SUMMARY_IMG'] = $detail_summary_img;
       	$detail_content = str_replace('href="/', 'target="_blank" href="'. $rssNews['TRssNews']['HOME'] .'/', $detail_content);
        $rssNews['TNews']['CONTENT'] = trim($detail_content);
        $this->updateNews($rssNews);			
        return true;
    }
	
    function getContentUrl($url, $divClassContent){
    	if(empty($url) || !$this->check_url($url)){
    		return "";
    	}
    
    	if($divClassContent == ""){
    		return "";
    	}
    	
    	try{
			$page = $this->getContentUrlTimeOut($url);
		}catch (Exception $e) {
			return "";
		}
    	$content = $this->getContentDivClass($page, $divClassContent);
    	return $content;
    }
    
	function getContentUrlExt($url, $divClassContent, $divClassContent2){
    	if(empty($url) || !$this->check_url($url)){
    		return "";
    	}
    
    	if($divClassContent == ""){
    		return "";
    	}
    	
    	try{
			$page = $this->getContentUrlTimeOut($url);
		}catch (Exception $e) {
			return "";
		}
		
		if(strpos($page,$divClassContent) !== false){
    		$content = $this->getContentDivClass($page, $divClassContent);	
    	}
    	else{
    		if($divClassContent2 != ""){
    			$content = $this->getContentDivClass($page, $divClassContent2);
    		}
    	}
    	if(isset($content)){
			return $content;
		}
		else{
			return "";
		}
    }
    
	function check_url($url) {
	   $headers = @get_headers( $url);
	   $headers = (is_array($headers)) ? implode( "\n ", $headers) : $headers;
	
	   return (bool)preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers);
	}
    
    function replaceCData($data){
    	$data = str_replace("<![CDATA[", "", $data);
    	return str_replace("]]>", "", $data);
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
    
    function removeContentDivClass($html, $divClassName){
    	if($html == null){
    		return "";
    	}
    	$pointBegin = strpos($html,$divClassName);
    	if($pointBegin === false){
    		return $html;
    	}
    	$pointEnd = 0;
    	$htmlDiv = substr($html, $pointBegin);
    	 
    	$posDiv = array();
    	$posEndDiv = array();
    	$pos = -1;
    	while (($pos = strpos($htmlDiv, "<div ", $pos+1)) !== false) {
    		$posDiv[] = $pos;
    	}
    	$pos = -1;
    	while (($pos = strpos($htmlDiv, "</div>", $pos+1)) !== false) {
    		$posEndDiv[] = $pos;
    	}
    	 
    	$flgDiv = 0;
    	$flgStop = false;
    	$iDiv = 0;
    	$iEndDiv = 0;
    	while(!$flgStop){
    		if(sizeof($posDiv) == 0 || sizeof($posEndDiv) == 0 || $iDiv >= sizeof($posDiv) || $iEndDiv >= sizeof($posEndDiv)){
    			$pointEnd = 0;
    			$flgStop = true;
    			continue;
    		}
    		
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
    		else if($iDiv > sizeof($posDiv) || $iEndDiv > sizeof($posEndDiv)){
    			$pointEnd = 0;
    			$flgStop = true;
    		}
    	}
    	 
    	$content = substr($htmlDiv, 0, $pointEnd) . "</div>";
    	$html = str_replace($content, "", $html);
    	return $html;
    }
    
    public function getContentTag($html, $tag){
    	$reg_tag = '/<'. $tag .'(.+)\/'. $tag .'>/Uism';
		if(preg_match($reg_tag, $html, $preg_tag)){
           return $preg_tag[1];
        }
        return "";
    }
        
    /**
     * Get insert news for http://abcnews.go.com/
     */
    public function getInfoRssNewsForAbcNews($rssNews){
    	// The Regular Expression filter
    	try{
    		$rsslink = $rssNews['TRssNews']['URL'];
    		if(empty($rsslink)){
    			return;
    		}
    		
	    	try{
				$channelPage = $this->getContentUrlTimeOut($rsslink);
			}catch (Exception $e) {
				return;
			}
			
    		$reg_regular_item = "/<item.*>(.+)<\/item>/Uism";
    		if(preg_match_all($reg_regular_item, $channelPage, $newsDetailInfo)) {
    			$this->TNews->begin();
    			$newsList = array();
	    		$oldId = -1;
    			$newsOldList = $this->TNews->find('all', array(
	    			'fields' => array('LINK'),
	    			'conditions' => array('RSS_NEWS_ID' => $rssNews['TRssNews']['ID']),
					'limit' => 50,
    				'order' =>array('PUB_DATE'=>'desc')
	    		));
	        	for ($i = 0 ; $i < count($newsDetailInfo[1]); $i++) {
	        		$newLink = $this->getNewsDetailLink($newsDetailInfo[1][$i], $rssNews);
	        		for($j = sizeof($newsOldList)-1 ; $j >= 0; $j--){
						if($newLink == $newsOldList[$j]['TNews']['LINK']){
							$oldId = $i;
						}
	        		}

	        		if($oldId != -1){
	        			break;
	        		}
	        	}
	        	
	        	if($oldId == -1){
	        		$oldId = count($newsDetailInfo[0]);
	        	}
	        	if($oldId > 0){
	        		for ($i = $oldId - 1; $i >= 0; $i--) {
	    				$news = $this->getUpdateInfoRssNewsDetailForAbcNews($newsDetailInfo[1][$i], $rssNews);
	    				if(!$news){
	    					break;
	    				}
	    				$newsList[] = $news;
	    			}
    				$this->saveNews($newsList, $rssNews);
    				$this->TNews->commit();
    				unset($newsList);
	        	}
    		}
    	}
    	catch (Exception $e) {
    		$this->TNews->rollback();
    		$this->errors = array("Error13:" . $e->getMessage());
    		return $this->render('/');
    	}
    	return false;
    }
    
    /**
     * Get insert/update news_details for http://abcnews.go.com/
     */
    public function getUpdateInfoRssNewsDetailForAbcNews($newsDetail, $rssNews){
    	date_default_timezone_set("Asia/Bangkok");
    	$reg_detail_title = '/<title>(.+)<\/title>/Uism';
    	$reg_detail_description = '/<description.*>(.+)<\/description>/Uism';
    	$reg_detail_link = '/<link>(.+)<\/link>/Uism';
    	$reg_detail_date = '/<pubDate>(.+)<\/pubDate>/Uism';
    
    	$regContent = $rssNews['TRssNews']['REG_CONTENT'];
    	$regContent2 = $rssNews['TRssNews']['REG_CONTENT2'];
    
    	$reg_detail_summary_img = '/<media:thumbnail url=\"(.+)\"/Uism';
    	$detail_summary_img = '';

    	if(preg_match($reg_detail_summary_img, $newsDetail, $preg_detail_summary_img)){
    		$detail_summary_img = $preg_detail_summary_img[1];
    	}
    	else{
    		$detail_summary_img = $rssNews['TRssNews']['REG_IMAGE'];
    	}
    
    	$detail_title = '';
    	$detail_description = '';
    	$detail_link = '';
//    	$detail_content = '';
    	$detail_date = '';
    
    	if(preg_match($reg_detail_date, $newsDetail, $preg_detail_date)){
    		$get_date = $this->replaceCData($preg_detail_date[1]);
    		$flg = strpos($get_date, "(GMT+7)");
    		if($flg){
    			$detail_date = new DateTime();
    		}
    		else{
    			$detail_date = new DateTime($get_date);
    		}
    	}
    
    	if(preg_match($reg_detail_title, $newsDetail, $preg_detail_title)){
    		$detail_title = $this->replaceCData($preg_detail_title[1]);
    	}
    	
    	if(preg_match($reg_detail_link, $newsDetail, $preg_detail_link)){
    		$detail_link = $this->replaceCData($preg_detail_link[1]);
    		//Insert news.
//    		if($linkOld == $detail_link){
//    			return null;
//    		}
    		
    		if(strpos($detail_title, 'Watch:')){
    			return null;
    		}
    		else{
	    		//$detail_content = $this->getContentUrlExt($detail_link, $regContent, $regContent2);
	    		//$detail_content = $this->removeContentDivClass($detail_content, '<div class="story_rail g_3">');
	    		//$detail_content = $this->removeContentDivClass($detail_content, '<div id="disqus_thread">');
    		}
    	}
    
    	if(preg_match($reg_detail_description, $newsDetail, $preg_detail_description)){
    		$detail_description = $this->replaceCData($preg_detail_description[1]);
    	}
    	 
    	if($detail_date == ''){
    		$detail_date = new DateTime();
    	}
    	$pubDate = $detail_date->format('Y-m-d H:i:s');
    
    	$news = $this->TNews->create();
    	$news['TNews']['RSS_NEWS_ID'] = $rssNews['TRssNews']['ID'];
    	$news['TNews']['TITLE'] = trim($detail_title);
    	$news['TNews']['DESCRIPTION'] = trim($detail_description);
    	$news['TNews']['PUB_DATE'] = $pubDate;
    	$news['TNews']['LINK'] = $detail_link;
    	$news['TNews']['SUMMARY_IMG'] = $detail_summary_img;
    	//$news['TNews']['CONTENT'] = trim($detail_content);
    	//$this->saveNews($news, $rssNews);
    	return $news;
    }
    
/**
     * Get insert/update news_details for http://abcnews.go.com/
     */
    public function updateContentDetailForAbcNews($rssNews){
    	date_default_timezone_set("Asia/Bangkok");
    	$reg_detail_title = '/<title>(.+)<\/title>/Uism';
    	$reg_detail_description = '/<description.*>(.+)<\/description>/Uism';
    	$reg_detail_link = '/<link>(.+)<\/link>/Uism';
    	$reg_detail_date = '/<pubDate>(.+)<\/pubDate>/Uism';
    
    	$regContent = $rssNews['TRssNews']['REG_CONTENT'];
    	$regContent2 = $rssNews['TRssNews']['REG_CONTENT2'];
    
    	$reg_detail_summary_img = '/<media:thumbnail url=\"(.+)\"/Uism';
    	$detail_summary_img = $rssNews['TNews']['SUMMARY_IMG'];

    	//if(preg_match($reg_detail_summary_img, $newsDetail, $preg_detail_summary_img)){
    	//	$detail_summary_img = $preg_detail_summary_img[1];
    	//}
    	//else{
    	//	$detail_summary_img = $rssNews['TRssNews']['REG_IMAGE'];
    	//}
    
    	$detail_title = '';
    	$detail_description = '';
    	$detail_link = '';
    	$detail_content = '';
    	$detail_date = '';
    
    	//if(preg_match($reg_detail_date, $newsDetail, $preg_detail_date)){
    	//	$get_date = $this->replaceCData($preg_detail_date[1]);
    	//	$flg = strpos($get_date, "(GMT+7)");
    	//	if($flg){
    	//		$detail_date = new DateTime();
    	//	}
    	//	else{
    	//		$detail_date = new DateTime($get_date);
    	//	}
    	//}
    
    	//if(preg_match($reg_detail_title, $newsDetail, $preg_detail_title)){
    	//	$detail_title = $this->replaceCData($preg_detail_title[1]);
    	//}
    	
    	//if(preg_match($reg_detail_link, $newsDetail, $preg_detail_link)){
    		//$detail_link = $this->replaceCData($preg_detail_link[1]);
    		//Insert news.
    		//$news = $this->TNews->find('first', array(
    		//		'conditions' => array(
    		//				'TNews.DELETE_YMD IS NULL',
    		//				'TNews.LINK' => $detail_link
    		//		)
    		//));
    		//if(sizeof($news) > 0){
    		//	return true;
    		//}
    		
    		$detail_title = $rssNews['TNews']['TITLE'];
    		$detail_link = $rssNews['TNews']['LINK'];
    		if(strpos($detail_title, 'Watch:')){
    			return null;
    		}
    		else{
	    		$detail_content = $this->getContentUrlExt($detail_link, $regContent, $regContent2);
	    		$detail_content = $this->removeContentDivClass($detail_content, '<div class="story_rail g_3">');
	    		$detail_content = $this->removeContentDivClass($detail_content, '<div id="disqus_thread">');
    		}
    	//}
    
    	//if(preg_match($reg_detail_description, $newsDetail, $preg_detail_description)){
    	//	$detail_description = $this->replaceCData($preg_detail_description[1]);
    	//}
    	 
    	//if($detail_date == ''){
    	//	$detail_date = new DateTime();
    	//}
    	//$pubDate = $detail_date->format('Y-m-d H:i:s');
    
    	$rssNews['TNews']['SUMMARY_IMG'] = $detail_summary_img;
    	$detail_content = str_replace('href="/', 'target="_blank" href="'. $rssNews['TRssNews']['HOME'] .'/', $detail_content);
      $rssNews['TNews']['CONTENT'] = trim($detail_content);
      $this->updateNews($rssNews);	
    	return true;
    }
    
    
    //=====================//
	/**
     * Get insert news for http://abcnews.go.com/
     */
    public function getInfoRssNewsForJAAsahi($rssNews){
    	// The Regular Expression filter
    	try{
    		$rsslink = $rssNews['TRssNews']['URL'];
    		if(empty($rsslink)){
    			return;
    		}
    		
    		try{
				$channelPage = $this->getContentUrlTimeOut($rsslink);
			}catch (Exception $e) {
				return;
			}
    		
    		$reg_regular_item = "/<item.*>(.+)<\/item>/Uism";
    		if(preg_match_all($reg_regular_item, $channelPage, $newsDetailInfo)) {
    			$this->TNews->begin();
    			$newsList = array();
    			$oldId = -1;
    			$newsOldList = $this->TNews->find('all', array(
	    			'fields' => array('LINK'),
	    			'conditions' => array('RSS_NEWS_ID' => $rssNews['TRssNews']['ID']),
					'limit' => 50,
    				'order' =>array('PUB_DATE'=>'desc')
	    		));
	        	for ($i = 0 ; $i < count($newsDetailInfo[1]); $i++) {
	        		$newLink = $this->getNewsDetailLink($newsDetailInfo[1][$i], $rssNews);
	        		for($j = sizeof($newsOldList)-1 ; $j >= 0; $j--){
						if($newLink == $newsOldList[$j]['TNews']['LINK']){
							$oldId = $i;
						}
	        		}

	        		if($oldId != -1){
	        			break;
	        		}
	        	}
	        	
	        	if($oldId == -1){
	        		$oldId = count($newsDetailInfo[0]);
	        	}
	        	if($oldId > 0){
	        		for ($i = $oldId - 1; $i >= 0; $i--) {
	    				$news = $this->getUpdateInfoRssNewsDetailForJAAsahi($newsDetailInfo[1][$i], $rssNews);
	    				if(!$news){
	    					break;
	    				}
	    				$newsList[] = $news;
	    			}
	    			$this->saveNews($newsList, $rssNews);
	    			unset($newsList);
	        	}
    			$this->TNews->commit();
    		}
    	}
    	catch (Exception $e) {
    		$this->TNews->rollback();
    		$this->errors = array("Error13:" . $e->getMessage());
    		return $this->render('/');
    	}
    	return false;
    }
    
	/**
     * Get insert/update news_details for http://abcnews.go.com/
     */
    public function getUpdateInfoRssNewsDetailForJAAsahi($newsDetail, $rssNews){
    	date_default_timezone_set("Asia/Bangkok");
    	$reg_detail_title = '/<title>(.+)<\/title>/Uism';
    	$reg_detail_description = '/<description.*>(.+)<\/description>/Uism';
    	$reg_detail_link = '/<link>(.+)<\/link>/Uism';
    	$reg_detail_date = '/<dc:date>(.+)<\/dc:date>/Uism';
    
    	$regContent = $rssNews['TRssNews']['REG_CONTENT'];
    
    	$reg_detail_summary_img = '/src=\"(.+)\" \/>/';
    	$detail_summary_img = '';
    
    	$detail_title = '';
    	$detail_description = '';
    	$detail_link = '';
    	//$detail_content = '';
    	$detail_date = '';
    
    	if(preg_match($reg_detail_date, $newsDetail, $preg_detail_date)){
    		$get_date = $this->replaceCData($preg_detail_date[1]);
    		$flg = strpos($get_date, "(GMT+7)");
    		if($flg){
    			$detail_date = new DateTime();
    		}
    		else{
    			$detail_date = new DateTime($get_date);
    		}
    	}
    
    	if(preg_match($reg_detail_title, $newsDetail, $preg_detail_title)){
    		$detail_title = $this->replaceCData($preg_detail_title[1]);
    	}
    	
    	if(preg_match($reg_detail_link, $newsDetail, $preg_detail_link)){
    		$detail_link = $this->replaceCData($preg_detail_link[1]);
    		//Insert news.
//    		$news = $this->TNews->find('first', array(
//    				'conditions' => array(
//    						'TNews.DELETE_YMD IS NULL',
//    						'TNews.LINK' => $detail_link
//    				)
//    		));
//    		if($linkOld == $detail_link){
//    			return null;
//    		}
    		
    		if(strpos($detail_title, 'PR: ') !== false){
    			return null;
    		}
    		else{
	    		$detail_image = $this->getContentUrl($detail_link, '<div class="Image">');
	    		//$detail_ArticleText = $this->getContentUrl($detail_link, '<div class="ArticleText">');
	    		//$detail_content = '<div class="ArticleBody">';
	    		//if($detail_image != ""){
		    	//	$detail_content = $detail_content . '<div class="ImagesMod">';
		    	//	$detail_content = $detail_content . $detail_image;
		    	//	$detail_content = $detail_content . '</div>';
		    	if(preg_match($reg_detail_summary_img, $detail_image, $preg_detail_summary_img)){
			    		$detail_summary_img = $preg_detail_summary_img[1];
			    }
	    		//}
	    		//$detail_content = $detail_content . $detail_ArticleText;
	    		//$detail_content = $detail_content . '</div>';
	    		
		    	if($detail_summary_img == ""){
		    		$detail_summary_img = $rssNews['TRssNews']['REG_IMAGE'];
		    	}
    		}
    	}

    	if(preg_match($reg_detail_description, $newsDetail, $preg_detail_description)){
    		$detail_description = $this->replaceCData($preg_detail_description[1]);
    	}
    	 
    	if($detail_date == ''){
    		$detail_date = new DateTime();
    	}
    	$pubDate = $detail_date->format('Y-m-d H:i:s');
    
    	$news = $this->TNews->create();
    	$news['TNews']['RSS_NEWS_ID'] = $rssNews['TRssNews']['ID'];
    	$news['TNews']['TITLE'] = trim($detail_title);
    	$news['TNews']['DESCRIPTION'] = trim($detail_description);
    	$news['TNews']['PUB_DATE'] = $pubDate;
    	$news['TNews']['LINK'] = $detail_link;
    	$news['TNews']['SUMMARY_IMG'] = $detail_summary_img;
    	//$news['TNews']['CONTENT'] = trim($detail_content);
    	//$this->saveNews($news, $rssNews);
    	return $news;
    }
    //=====================//
    
    /**
     * Get insert/update news_details for http://abcnews.go.com/
     */
    public function updateContentDetailForJAAsahi( $rssNews){
    	date_default_timezone_set("Asia/Bangkok");
    	$reg_detail_title = '/<title>(.+)<\/title>/Uism';
    	$reg_detail_description = '/<description.*>(.+)<\/description>/Uism';
    	$reg_detail_link = '/<link>(.+)<\/link>/Uism';
    	$reg_detail_date = '/<dc:date>(.+)<\/dc:date>/Uism';
    
    	$regContent = $rssNews['TRssNews']['REG_CONTENT'];
    
    	$reg_detail_summary_img = '/src=\"(.+)\" \/>/';
    	$detail_summary_img = $rssNews['TNews']['SUMMARY_IMG'];
    
    	$detail_title = '';
    	$detail_description = '';
    	$detail_link = '';
    	$detail_content = '';
    	$detail_date = '';
    
    	$detail_link = $rssNews['TNews']['LINK'];
    	
    	//if(preg_match($reg_detail_date, $newsDetail, $preg_detail_date)){
    	//	$get_date = $this->replaceCData($preg_detail_date[1]);
    	//	$flg = strpos($get_date, "(GMT+7)");
    	//	if($flg){
    	//		$detail_date = new DateTime();
    	//	}
    	//	else{
    	//		$detail_date = new DateTime($get_date);
    	//	}
    	//}
    
    	//if(preg_match($reg_detail_title, $newsDetail, $preg_detail_title)){
    	//	$detail_title = $this->replaceCData($preg_detail_title[1]);
    	//}
    	
    	//if(preg_match($reg_detail_link, $newsDetail, $preg_detail_link)){
    	//	$detail_link = $this->replaceCData($preg_detail_link[1]);
    		//Insert news.
    	//	$news = $this->TNews->find('first', array(
    	//			'conditions' => array(
    	//					'TNews.DELETE_YMD IS NULL',
    	//					'TNews.LINK' => $detail_link
    	//			)
    	//	));
    	//	if(sizeof($news) > 0){
    	//		return true;
    	//	}
    		
    	//	if(strpos($detail_title, 'PR: ') !== false){
    	//		return true;
    	//	}
    	//	else{
	    		$detail_image = $this->getContentUrl($detail_link, '<div class="Image">');
	    		$detail_ArticleText = $this->getContentUrl($detail_link, '<div class="ArticleText">');
	    		$detail_content = '<div class="ArticleBody">';
	    		if($detail_image != ""){
		    		$detail_content = $detail_content . '<div class="ImagesMod">';
		    		$detail_content = $detail_content . $detail_image;
		    		$detail_content = $detail_content . '</div>';
		    		if(preg_match($reg_detail_summary_img, $detail_image, $preg_detail_summary_img)){
			    		$detail_summary_img = $preg_detail_summary_img[1];
			    	}
	    		}
	    		$detail_content = $detail_content . $detail_ArticleText;
	    		$detail_content = $detail_content . '</div>';
	    		
		    	if($detail_summary_img == ""){
		    		$detail_summary_img = $rssNews['TRssNews']['REG_IMAGE'];
		    	}
    	//	}
    	//}

    	//if(preg_match($reg_detail_description, $newsDetail, $preg_detail_description)){
    	//	$detail_description = $this->replaceCData($preg_detail_description[1]);
    	//}
    	 
    	if($detail_date == ''){
    		$detail_date = new DateTime();
    	}
    	$pubDate = $detail_date->format('Y-m-d H:i:s');
    
    	$rssNews['TNews']['SUMMARY_IMG'] = $detail_summary_img;
    	$detail_content = str_replace('href="/', 'target="_blank" href="'. $rssNews['TRssNews']['HOME'] .'/', $detail_content);
      $rssNews['TNews']['CONTENT'] = trim($detail_content);
        //$this->updateNews($rssNews);
        
    	return true;
    }
    //=====================//
    
	function getContentUrlTimeOut($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$data = curl_exec($ch);
		curl_close($ch);
	
		return $data;
	}
	
	function saveNews($pNewsList, $rssNews){
//		for($i = 0 ; $i < sizeof($pNewsList) ; $i++ ){
//			$detail_description = $pNewsList[$i]['TNews']['DESCRIPTION'];
//			$detail_description = str_replace('<a href="', '<a target="_blank" href="', $detail_description);
//			if(isset($detail_description)){
//				$pNewsList[$i]['TNews']['DESCRIPTION'] = $detail_description;
//			}
//		}
		//$content = $pNews['TNews']['CONTENT'];
    	//$content = str_replace('href="/', 'href="' . $rssNews['TRssNews']['HOME'] . '/', $content);
    	//$content = str_replace('href="www', 'href="http://www', $content);
    	//$content = str_replace('<a href="', '<a target="_blank" href="', $content);
    	//$pNews['TNews']['CONTENT'] = $content;
    	$this->TNews->saveAll($pNewsList);
	}
	
	function updateNews($rssNews){
    	
		//$detail_description = $pNews['TNews']['DESCRIPTION'];
		//$detail_description = str_replace('<a href="', '<a target="_blank" href="', $detail_description);
		//$pNews['TNews']['DESCRIPTION'] = $detail_description;
		
		$content = $rssNews['TNews']['CONTENT'];
    	$content = str_replace('href="/', 'href="' . $rssNews['TRssNews']['HOME'] . '/', $content);
    	$content = str_replace('href="www', 'href="http://www', $content);
    	$content = str_replace('<a href="', '<a target="_blank" href="', $content);
    	//$pNews['TNews']['CONTENT'] = $content;
    	//$this->TNews->updateAll(
		//		array(
		//			'CONTENT' => "'" . $content . "'",
		//			'SUMMARY_IMG' => $rssNews['TNews']['SUMMARY_IMG']
		//		),
		//		array('ID' => $rssNews['TNews']['ID'])
		//	);
		$this->TNews->save($rssNews['TNews']);
	}
	
	function updateAllNews(){
		try{
//			$newsList = $this->TNews->find('all', array(
//				'fields' => array('TNews.*, TRssNews.TYPE, TRssNews.HOME, TRssNews.URL, TRssNews.LANGUAGE'),
//				'conditions' => array(
//						'TNews.DELETE_YMD IS NULL',
//						'TNews.ID >= 20000',
//						'TNews.ID < 22000'
//					),
//				'joins' =>array(
//					array (
//							'table' => 'T_RSS_NEWS',
//							'alias' => 'TRssNews',
//							'type' => 'left',
//							'conditions' => array (
//									'TRssNews.ID = TNews.RSS_NEWS_ID'
//							)
//					)
//				)
//			));
//			foreach ($newsList as $news){
//				$detail_content = $news['TNews']['CONTENT'];
//				//if($news['TRssNews']['HOME'] == 'http://www.dailymail.co.uk'){
//					$detail_content = str_replace('href="/', 'target="_blank" href="'. $news['TRssNews']['HOME'] .'/', $detail_content);
//				//}
//				$news['TNews']['CONTENT'] = $detail_content;
//				$this->saveNews($news, $news);
//			}
//			
//			$newsList = $this->TNews->find('all', array(
//				'fields' => array('TNews.*, TRssNews.TYPE, TRssNews.HOME, TRssNews.URL, TRssNews.LANGUAGE'),
//				'conditions' => array(
//						'TNews.DELETE_YMD IS NULL',
//						'TNews.ID >= 22000',
//						'TNews.ID < 24000'
//					),
//				'joins' =>array(
//					array (
//							'table' => 'T_RSS_NEWS',
//							'alias' => 'TRssNews',
//							'type' => 'left',
//							'conditions' => array (
//									'TRssNews.ID = TNews.RSS_NEWS_ID'
//							)
//					)
//				)
//			));
//			foreach ($newsList as $news){
//				$detail_content = $news['TNews']['CONTENT'];
////				if($news['TRssNews']['HOME'] == 'http://www.dailymail.co.uk'){
////					$detail_content = $this->removeContentDivClass($detail_content, '<div id="wideCommentAdvert"');
////				}
//				$detail_content = str_replace('href="/', 'target="_blank" href="'. $news['TRssNews']['HOME'] .'/', $detail_content);
//				$news['TNews']['CONTENT'] = $detail_content;
//				$this->saveNews($news, $news);
//			}
//			
//			$newsList = $this->TNews->find('all', array(
//				'fields' => array('TNews.*, TRssNews.TYPE, TRssNews.HOME, TRssNews.URL, TRssNews.LANGUAGE'),
//				'conditions' => array(
//						'TNews.DELETE_YMD IS NULL',
//						'TNews.ID >= 24000',
//						'TNews.ID < 26000'
//					),
//				'joins' =>array(
//					array (
//							'table' => 'T_RSS_NEWS',
//							'alias' => 'TRssNews',
//							'type' => 'left',
//							'conditions' => array (
//									'TRssNews.ID = TNews.RSS_NEWS_ID'
//							)
//					)
//				)
//			));
//			foreach ($newsList as $news){
//				$detail_content = $news['TNews']['CONTENT'];
////				if($news['TRssNews']['HOME'] == 'http://www.dailymail.co.uk'){
////					$detail_content = $this->removeContentDivClass($detail_content, '<div id="wideCommentAdvert"');
////				}
//				$detail_content = str_replace('href="/', 'target="_blank" href="'. $news['TRssNews']['HOME'] .'/', $detail_content);
//				$news['TNews']['CONTENT'] = $detail_content;
//				$this->saveNews($news, $news);
//			}
			
			$newsList = $this->TNews->find('all', array(
				'fields' => array('TNews.*, TRssNews.TYPE, TRssNews.HOME, TRssNews.URL, TRssNews.LANGUAGE'),
				'conditions' => array(
						'TNews.DELETE_YMD IS NULL',
						'TNews.ID > 26000'
					),
				'joins' =>array(
					array (
							'table' => 'T_RSS_NEWS',
							'alias' => 'TRssNews',
							'type' => 'left',
							'conditions' => array (
									'TRssNews.ID = TNews.RSS_NEWS_ID'
							)
					)
				)
			));
			foreach ($newsList as $news){
				$detail_content = $news['TNews']['CONTENT'];
//				if($news['TRssNews']['HOME'] == 'http://www.dailymail.co.uk'){
//					$detail_content = $this->removeContentDivClass($detail_content, '<div id="wideCommentAdvert"');
//				}
				$detail_content = str_replace('href="/', 'target="_blank" href="'. $news['TRssNews']['HOME'] .'/', $detail_content);
				$news['TNews']['CONTENT'] = $detail_content;
				$this->saveNews($news, $news);
			}
			return $this->render('/Actions/getRssNews', 'admin');
		}catch (Exception $e) {
			$this->errors = array("Error14:" . $e->getMessage());
			return $this->render('/Actions/getRssNews', 'admin');
		}
	}
	
/**
     * Get insert/update news_details
     */
    public function getUpdateInfoRssNewsDetailAll($newsDetail, $rssNews){
    	$action = '';
    	if($rssNews['TRssNews']['LANGUAGE'] == 'vn'){
			$action = "getInfoRssNews";
		}
		else if($rssNews['TRssNews']['LANGUAGE'] == 'en'){
			if($rssNews['TRssNews']['HOME'] == 'http://abcnews.go.com'){
				$action = "getInfoRssNewsForAbcNews";
			}
			else{
				$action = "getInfoRssNews";
			}
		}
		else if($rssNews['TRssNews']['LANGUAGE'] == 'ja'){
			if($rssNews['TRssNews']['HOME'] == 'http://www.asahi.com'){
				$action = "getInfoRssNewsForJAAsahi";
			}
			else{
				$action = "getInfoRssNews";
			}
		}
	
		if($action == "getInfoRssNews"){
	    	date_default_timezone_set("Asia/Bangkok");
	        $reg_detail_title = '/<title>(.+)<\/title>/Uism';
	        $reg_detail_description = '/<description.*>(.+)<\/description>/Uism';
	        $reg_detail_link = '/<link>(.+)<\/link>/Uism';
	        $reg_detail_date = '/<pubDate>(.+)<\/pubDate>/Uism';
	
	        $regContent = $rssNews['TRssNews']['REG_CONTENT'];
	        $regContent2 = $rssNews['TRssNews']['REG_CONTENT2'];
	        
	        
	        $detail_link = '';
	        
	        if(preg_match($reg_detail_link, $newsDetail, $preg_detail_link)){
	            $detail_link = $this->replaceCData($preg_detail_link[1]);
	            //====GET SPECIAL NEWS BEGIN====//
				if($rssNews['TRssNews']['HOME'] == 'http://www.dailymail.co.uk'){
					$reg_link = "/http:\/\/(.+?)\?/";
					if(preg_match($reg_link, $detail_link, $preg_link)){
						$detail_link = "http://" . $preg_link[1];
					}
				}
				//====GET SPECIAL NEWS BEGIN====//
		        //Insert news.
		        $news = $this->TNews->find('first', array(
					'conditions' => array(
							'TNews.DELETE_YMD IS NULL',
		        			'TNews.CONTENT IS NOT NULL',
		        			'TNews.LINK' => $detail_link
						)
				));
				if(sizeof($news) > 0){
					return true;
				}
				
	         $detail_content = $this->getContentUrlExt($detail_link, $regContent, $regContent2);
	            
	        	if($detail_summary_img == ''){
		            if(preg_match($reg_detail_summary_img, $detail_content, $preg_detail_summary_img)){
		            	if(sizeof($preg_detail_summary_img) == 2){
		            		$detail_summary_img = $this->replaceCData($preg_detail_summary_img[1]);
		            	}
		            }
	            }
	        } 
	        
	        if(preg_match($reg_detail_title, $newsDetail, $preg_detail_title)){
	            $detail_title = $this->replaceCData($preg_detail_title[1]);
	        }
	               
	        if($detail_date == ''){
	        	$detail_date = new DateTime();
	        }
	       	$pubDate = $detail_date->format('Y-m-d H:i:s');
	       	
	       	//====CHECK SPECIAL NEWS BEGIN====//
	       	if($rssNews['TRssNews']['HOME'] == 'http://www3.nhk.or.jp'){
		       	$linkSlipArr = explode('/',$detail_link);
		    	if(sizeof($linkSlipArr) > 1){
		    		$pathUrlImage = str_replace($linkSlipArr[sizeof($linkSlipArr)-1], '', $detail_link);
		    	}    		
			
		       	$detail_content = str_replace('src="', 'src="'.$pathUrlImage, $detail_content);
		       	$detail_content_image =  $this->getContentDivClass($detail_content, '<div id="news_image_div">');
	       		if(preg_match('/src=\"(.+?)\"/', $detail_content_image, $preg_detail_summary_img)){
	            	if(sizeof($preg_detail_summary_img) == 2){
	            		$detail_summary_img = $this->replaceCData($preg_detail_summary_img[1]);
	            	}
	            }
	            else{
	            	$detail_summary_img = $rssNews['TRssNews']['REG_IMAGE'];
	            }
	       	}
	       	else if($rssNews['TRssNews']['HOME'] == 'http://www.dailymail.co.uk'){
	       		$reg_detail_summary_img = '/<enclosure url=\"(.+?)\"/';
	       		if(preg_match($reg_detail_summary_img, $newsDetail, $preg_detail_summary_img)){
	       			if(sizeof($preg_detail_summary_img) == 2){
	            		$detail_summary_img = $this->replaceCData($preg_detail_summary_img[1]);
	            	}
	       		}
	       		else{
	            	$detail_summary_img = $rssNews['TRssNews']['REG_IMAGE'];
	            }
	            
	            $detail_content = $this->removeContentDivClass($detail_content, '<div id="wideCommentAdvert"');
	            $detail_content = $this->removeContentDivClass($detail_content, '<div id="taboola-below-main-column"');
	            $detail_content = $this->removeContentDivClass($detail_content, '<div class="item" id="most-watched-videos-wrapper"');
	            $detail_content = $this->removeContentDivClass($detail_content, '<div id="most-read-news"');
	            $detail_content = $this->removeContentDivClass($detail_content, '<div class="xwv-related-videos-container-4 rotator news">');
	            $detail_content = $this->removeContentDivClass($detail_content, '<div id="most-read-news-wrapper"');
	            $detail_content = str_replace('href="/', 'target="_blank" href="'. $rssNews['TRssNews']['HOME'] .'/', $detail_content);
				$detail_content = $this->removeContentDivClass($detail_content, '<div id="js-comments"');
	            $detail_content = $this->removeContentDivClass($detail_content, '<div id="reader-comments"');
	            $detail_content = $this->removeContentDivClass($detail_content, '<div id="infinite-list"');
	            $detail_content = $this->removeContentDivClass($detail_content, '<div id="reader-comments"');
	            $detail_content = $this->removeContentDivClass($detail_content, '<div class="topcommenter">');
	            $detail_content = $this->removeContentDivClass($detail_content, '<div class="rc-header link-ccow">');
	            $detail_content = $this->removeContentDivClass($detail_content, '<div id="readerCommentsCommand"');
	
	       	}
	       		       	
	       	//====CHECK SPECIAL NEWS END====//
	        //$getNewsDetails = $this->TNews->find('first', array(
			//	'conditions' => array(
			//			'TNews.DELETE_YMD IS NULL',
	        //			'TNews.LINK' => $detail_link
			//		)
			//));
			if(sizeof($rssNews) == 1){	        
		        $rssNews['TNews']['CONTENT'] = trim($detail_content);
		        $this->updateNews($rssNews);
			}
	        return true;
		}
    }
}