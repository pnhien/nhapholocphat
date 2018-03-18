<?php
App::uses('AppController', 'Controller');

/**
 * NewsController
 */
class NewsController extends AppController {
	
	public $uses = array(		
		'TRssNews',
		'TNews',
		'TManage',
		'TVideo'
	);
	
	/**
	 * Displays a view Results
	 */
	public function index() {
		require_once 'GetRssNewsController.php';
		$getRssNews = new GetRssNewsController ();
		$paraNews = $this->request->query;
		if(!isset($paraNews['id'])){
			return $this->redirect('/');
		}
		
		$type = 0;
		$news = $this->TNews->find('first', array(
			'fields' => array('TNews.*, TRssNews.*'),
			'conditions' => array(
					'TNews.DELETE_YMD IS NULL',
					'TNews.ID' => $paraNews['id']
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
		if($news != null){
			if($news['TNews']['CONTENT'] == ''){
				$this->TNews->begin();
				// get rss news list
				if($news['TRssNews']['LANGUAGE'] == 'vn'){
					$getRssNews->updateContentDetail($news);
				}
				else if($news['TRssNews']['LANGUAGE'] == 'en'){
					if($news['TRssNews']['HOME'] == 'http://abcnews.go.com'){
						$getRssNews->updateContentDetailForAbcNews($news);
					}
					else{
						$getRssNews->updateContentDetail($news);
					}
				}
				else if($news['TRssNews']['LANGUAGE'] == 'ja'){
					if($news['TRssNews']['HOME'] == 'http://www.asahi.com'){
						$getRssNews->updateContentDetailForJAAsahi($news);
					}
					else{
						$getRssNews->updateContentDetail($news);
					}
				}
				$this->TNews->commit();
				$news = $this->TNews->find('first', array(
					'fields' => array('TNews.*, TRssNews.TYPE, TRssNews.HOME, TRssNews.URL, TRssNews.LANGUAGE'),
					'conditions' => array(
							'TNews.DELETE_YMD IS NULL',
							'TNews.ID' => $paraNews['id']
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
			} //else {
			//	require_once 'GetRssNewsController.php';
			//	$getRssNews = new GetRssNewsController ();
			//	$getRssNews->getRssNewsUser();				
			//}
			
			$this->set('news', $news);
			$this->title = $news['TNews']['TITLE'];
			$this->urlHistories = array('News', $this->title);
			$type = $news['TRssNews']['TYPE'];

			if($this->language != $news['TRssNews']['LANGUAGE']){
				$this->language = $news['TRssNews']['LANGUAGE'];
				$this->Cookie->write(RwsConstant::COOKIE_KEY_LANGUAGE, $this->language);
				$this->applyLanguage();
			}
		}
		
		if(!isset($this->language)){
			$this->language = RwsConstant::LANGUAGE;// Default language
			$this->Cookie->write(RwsConstant::COOKIE_KEY_LANGUAGE, $this->language);
			$this->applyLanguage();
		}
		
		$newsList = $this->TNews->find('all', array(
				'fields' => array('TNews.*, TRssNews.TYPE, TRssNews.HOME, TRssNews.URL'),
				'conditions' => array(
						'TNews.DELETE_YMD IS NULL',
						'TNews.ID < ' . $paraNews["id"],
						'TRssNews.LANGUAGE' => $this->language
				),
				'joins' =>array(
						array (
								'table' => 'T_RSS_NEWS',
								'alias' => 'TRssNews',
								'type' => 'inner',
								'conditions' => array (
										'TRssNews.ID = TNews.RSS_NEWS_ID',
										'TRssNews.TYPE' => $type
										
								)
						)
				),
				'limit' => 15,
				'order' => array('TNews.ID DESC')
		));
		if($newsList != null){
			$this->set('newsList', $newsList);
		}
		//$getRssNews->getRssNewsUser();
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
					'limit' => 8,
					'order' =>array('PUBLISHED_AT'=>'DESC')
			));
			
			if(sizeof($videos) > 0){
				$this->set('videos', $videos);
			}
			
		return $this->render('/news');
	}	
}
