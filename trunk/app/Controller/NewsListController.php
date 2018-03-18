<?php
App::uses('AppController', 'Controller');

/**
 * NewsListController
 */
class NewsListController extends AppController {
	var $helpers = array('Paginator','Html');

	public $uses = array(
		'TRssNews',
		'TNews'
	);
	
	/**
	 * Displays a view NewsList
	 */
	public function index() {
		$paraNews = $this->request->query;
                $user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);

		if(!isset($paraNews['type'])){
			$paraNews['type'] = RwsConstant::NEWS_ITEM_TYPE_HOT;
		}
		
//		if(isset($paraNews['hl'])){
//			if($this->getCheckLanguage($paraNews['hl'])){
//				$this->language = $paraNews['hl'];
//				$this->Cookie->write(RwsConstant::COOKIE_KEY_LANGUAGE, $this->language);
//				$this->applyLanguage();
//				$language = $this->language;
//			}
//		}
		
		if(!isset($this->language)){
			$this->language = RwsConstant::LANGUAGE_EN;// Default language
			$this->Cookie->write(RwsConstant::COOKIE_KEY_LANGUAGE, $this->language);
			$this->applyLanguage();
			$language = $this->language;
		}
		else {
			$language = $this->language;
		}
		if(isset($user_id_login) && $user_id_login == 'admin'){
		        $contentCondition = ' 1 = 1 ';
		} else {
		        $contentCondition = ' (TNews.CONTENT <> "" OR TNews.CONTENT IS NULL) ';
		}

		$paginate = array();
		$this->paginate = array(
			'fields' => array('TNews.ID, TNews.TITLE, TNews.LINK, TNews.SUMMARY_IMG, TRssNews.TYPE,TRssNews.HOME, TRssNews.URL'),
			'conditions' => array(
					'TNews.DELETE_YMD IS NULL',
					'TRssNews.LANGUAGE' => $language,
					$contentCondition
				),
			'joins' =>array(
				array (
						'table' => 'T_RSS_NEWS',
						'alias' => 'TRssNews',
						'type' => 'inner',
						'conditions' => array (
								'TRssNews.ID = TNews.RSS_NEWS_ID',
								'TRssNews.TYPE' => $paraNews['type']
								
						)
				)
			),
			'limit' => 50,
			'order' => array('TNews.PUB_DATE' => 'desc')
		);

		$newsList = $this->paginate("TNews");
		
		// $newsList = $this->TNews->find('all', array(
		// 	'fields' => array('TNews.ID, TNews.TITLE, TNews.LINK, TNews.SUMMARY_IMG, TRssNews.TYPE,TRssNews.HOME, TRssNews.URL'),
		// 	'conditions' => array(
		// 			'TNews.DELETE_YMD IS NULL',
		// 			'TRssNews.LANGUAGE' => $language,
		// 			$contentCondition
		// 		),
		// 	'joins' =>array(
		// 		array (
		// 				'table' => 'T_RSS_NEWS',
		// 				'alias' => 'TRssNews',
		// 				'type' => 'inner',
		// 				'conditions' => array (
		// 						'TRssNews.ID = TNews.RSS_NEWS_ID',
		// 						'TRssNews.TYPE' => $paraNews['type']
								
		// 				)
		// 		)
		// 	),
		// 	'limit' => 100,
		// 	'order' => array('TNews.PUB_DATE' => 'desc')
		// ));
			
		if($newsList != null){
			$this->set('newsList', $newsList);
			$title = "";
			if($paraNews['type'] == RwsConstant::NEWS_ITEM_TYPE_HOT){
				$title = $this->scrFieldLabels['HOME_CATALOG_004'];
			}
			else{
				$title = $this->scrFieldLabels['HOME_CATALOG_005'];
			}
			$this->title = $title;
			$this->urlHistories = array('News', $this->title);
		}

		//require_once 'GetRssNewsController.php';
		//$getRssNews = new GetRssNewsController ();
		//$getRssNews->getRssNewsUser();
		
		if(isset($user_id_login) && $user_id_login == 'admin'){
			return $this->render('/newsList', 'admin'); //return $this->render ( '/results', 'admin' );
		} 
		else {
			return $this->render('/newsList'); //return $this->render ( '/results' );
		}
		
	}
}
