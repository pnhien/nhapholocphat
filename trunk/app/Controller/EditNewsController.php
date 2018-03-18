<?php
App::uses('AppController', 'Controller');

/**
 * EditUserController
 */
class EditNewsController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array(
			'TUser',
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
		$this->title = 'Edit news';
		$this->link = '/Edits/edit_news';
		$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->link);
		
		$paraNews = $this->request->query;
		if(!isset($paraNews['id'])){
			return $this->redirect('/results');
		}
		$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		
		$news = $this->TNews->find('first', array(
			'fields' => array('TNews.*, TRssNews.TYPE, TRssNews.HOME, TRssNews.URL'),
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
		if(sizeof($news) == 0){
			return $this->redirect('/results');
		}
		$this->set('news', $news);
		$this->set('user_id_login', $user_id_login);
		return $this->render('/Edits/edit_news');
	}
	
	public function doUpdateNews() {
		// If change pass button is clicked
		try {
			$this->title = "Edit news";
			$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->title);
			$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
			$errorsflg = "";
			
			if ($this->request->is(array('post', 'put'))) {
				$newsPost = $this->request->data['TNews'];
				
				$login_user_role = 0 + $this->Session->read('login.user.AUTH_ROLE');
				if($login_user_role <= RwsConstant::USER_AUTH_ROLE_SUB){
					$this->TNews->save($newsPost);
				}
				$news = $this->TNews->find('first', array(
					'fields' => array('TNews.*, TRssNews.TYPE, TRssNews.HOME, TRssNews.URL'),
					'conditions' => array(
							'TNews.DELETE_YMD IS NULL',
							'TNews.ID' => $newsPost['ID']
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
				if(sizeof($news) == 0){
					return $this->redirect('/results');
				}
			}
			$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			$this->set('news', $news);
			$this->set('user_id_login', $user_id_login);
			return $this->render('/Edits/edit_news');
			
		} catch (Exception $e) {
			// Rollback			
			$this->set('news', null);
			$this->set('user_id_login', $user_id_login);
			$this->Session->setFlash($e->getMessage(), 'message', array('message_type' => RwsConstant::MSG_ERROR));
			return $this->render('/Edits/edit_news');
		}
	}

	public function doDeleteNews() {
		// If change pass button is clicked
		try {
			$this->title = "Edit news";
			$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->title);
			$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
			$errorsflg = "";
			
			if ($this->request->is(array('post', 'put'))) {
				$newsPost = $this->request->data['TNews'];
				
				$login_user_role = 0 + $this->Session->read('login.user.AUTH_ROLE');
				if($login_user_role <= RwsConstant::USER_AUTH_ROLE_SUB){
					$flg = $this->TNews->delete($newsPost);
					if($flg == false){
						$this->Session->setFlash($this->messages['SYSTEM_ERROR'] . ' News id = '.$newsPost['ID'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
						return $this->render('/results', 'admin');
					}
				}				
			}
			$this->Session->setFlash($this->messages['OPERATION_SUCCESS'] . ' Deleted news id = '.$newsPost['ID'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			return $this->render('/results');
			
		} catch (Exception $e) {
			// Rollback			
			$this->set('news', null);
			$this->set('user_id_login', $user_id_login);
			$this->Session->setFlash($e->getMessage(), 'message', array('message_type' => RwsConstant::MSG_ERROR));
			return $this->render('/Edits/edit_news');
		}
	}
}
