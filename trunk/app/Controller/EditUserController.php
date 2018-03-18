<?php
App::uses('AppController', 'Controller');

/**
 * EditUserController
 */
class EditUserController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array(
			'TUser',
			'TCustomer',
			'LoginCert',
			'TBacklink'
	);

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function index() {
		$this->title = $this->scrFieldLabels['TITLE_EDIT_USER'];
		$this->link = '/Edits/edit_user';
		$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->link);
		try {
			$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
			$login_user_role = 0 + $this->Session->read('login.user.AUTH_ROLE');
			$condition = "1=2";
			if($login_user_role == RwsConstant::USER_AUTH_ROLE_ADMIN){
				$condition = "1=1";	
			}
			else if($login_user_role == RwsConstant::USER_AUTH_ROLE_SUB){
				$condition = "TUser.AUTH_ROLE >= " . RwsConstant::USER_AUTH_ROLE_SUB;
			}
			else {
				$condition = "TUser.USER_ID = '" . $user_id_login . "'";
			}
			
			$users = $this->TUser->find('all', array(
							'fields' => array('TUser.*, TCustomer.*'),
							'conditions' => array(
									'TUser.DELETE_YMD IS NULL',
									$condition
							),
							'joins' =>array(
								array (
										'table' => 'T_CUSTOMER',
										'alias' => 'TCustomer',
										'type' => 'left',
										'conditions' => array (
												'TCustomer.USER_ID = TUser.USER_ID',
												'TCustomer.DELETE_YMD IS NULL',
										)
								)
							),
			));
			$this->set('userlist', $users);
			$this->set('user_id_login', $user_id_login);
			
			//Backlink
//			$backlinkList = $this->TBacklink->find('all', array(
//					'conditions' => array(
//							'TBacklink.DELETE_YMD IS NULL',
//							'TBacklink.USER_ID' => $user_id_login
//					))
//			);
			if(isset($backlinkList) && sizeof($backlinkList) > 0){
				$this->set('backlinkList', $backlinkList);
			}
		} catch (Exception $e) {
			// Rollback
			return $this->redirect('/edit/user');
		}
		return $this->render('/Edits/edit_user', 'admin');
	}
	
	public function doAddUser() {
		// If change pass button is clicked
		try {
			$this->title = $this->scrFieldLabels['TITLE_EDIT_USER'];
			$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->title);
			$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
			$errorsflg = "";
			
			if ($this->request->is(array('post', 'put'))) {
				$user = $this->request->data['TUser'];
				
				if (empty ($user['USER_ID'])){
					$this->Session->setFlash($this->messages['EDITUSER_ERR_000001'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$errorsflg = "true";
				}
				else if (strlen($user['USER_ID']) > 32){
					$this->Session->setFlash($this->messages['EDITUSER_ERR_000003'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$errorsflg = "true";
				}
				else if (preg_match('/[^A-Za-z0-9\[\]()_]/', $user['USER_ID'])){
					$this->Session->setFlash($this->messages['EDITUSER_ERR_000008'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$errorsflg = "true";
				} 
				else{
					
					$userFind = $this->TUser->find('first', array(
							'conditions' => array(
									'TUser.DELETE_YMD IS NULL','TUser.USER_ID' => $user['USER_ID']
							)
					));
					if($userFind != null){
						$this->Session->setFlash($this->messages['EDITUSER_ERR_000004'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$errorsflg = "true";
					}
				}
				if(empty($errorsflg)){
					if (empty ($user['USER_PASSWORD'])){
						$this->Session->setFlash($this->messages['EDITUSER_ERR_000005'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$errorsflg = "true";
					} else{
						if (strlen($user['USER_PASSWORD']) > 32){
							$this->Session->setFlash($this->messages['EDITUSER_ERR_000006'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
							$errorsflg = "true";
						}
						else if (!empty ($user['MAIL_ADDRESS'])){
							if (preg_match('/[^A-Za-z0-9\@\.\[\]()_]/',  $user['MAIL_ADDRESS'])){
								$this->Session->setFlash($this->messages['EDITUSER_ERR_000009'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
								$errorsflg = "true";
							}
						}
						else{
							if (!defined('MD5_SALT')) {
								define('MD5_SALT', 'vnkey!');
							}
							$password = $user['USER_PASSWORD'];
							$encrypt_pass = md5(MD5_SALT.$password);
							$user['USER_PASSWORD'] = $encrypt_pass;
					    }
					}
				}
					
				if(!empty($errorsflg)){
					$users = $this->TUser->find('all', array(
							'conditions' => array(
									'TUser.DELETE_YMD IS NULL','TUser.USER_ID <>' => $user_id_login
							))
					);
					$this->set('userlist', $users);
					$this->set('user', $user);
					$this->set('user_id_login', $user_id_login);
					return $this->render('/Edits/edit_user');
				}
	
				$userFindDeleted = $this->TUser->find('first', array(
						'conditions' => array('TUser.USER_ID' => $user['USER_ID']
						)
				));
				if($userFindDeleted != null){
					$this->TUser->begin();
					$this->TUser->updateAll(
							array('TUser.USER_PASSWORD' => "'$user[USER_PASSWORD]'", 'TUser.AUTH_ROLE' => "'$user[AUTH_ROLE]'", 'TUser.MAIL_ADDRESS' => "'$user[MAIL_ADDRESS]'", 'TUser.AUTH_DEMAND_FORECAST_EDIT' => "'$user[AUTH_DEMAND_FORECAST_EDIT]'", 'TUser.DELETE_YMD' => NULL),
							array('TUser.USER_ID' => $user['USER_ID'])
					);
					$this->TUser->commit();
				}
				else{
					$this->TUser->begin();
					$this->TUser->save($user);
					$customer = $this->TCustomer->create(); 
					$customer['TCustomer']['USER_ID'] = $user['USER_ID'];
					$customer['TCustomer']['CUSTOMER_NAME'] = $user['USER_ID'];
					$this->TCustomer->begin();
					$this->TCustomer->save($customer);
					$this->TCustomer->commit();
					$this->TUser->commit();
				}
			}
			
			$users = $this->TUser->find('all', array(
					'conditions' => array(
							'TUser.DELETE_YMD IS NULL','TUser.USER_ID <>' => $user_id_login
					))
			);
			$this->set('userlist', $users);
			$this->set('user_id_login', $user_id_login);
			$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			return $this->render('/Edits/edit_user');
			
		} catch (Exception $e) {
			// Rollback
			$this->TUser->rollback();
			$users = $this->TUser->find('all', array(
					'conditions' => array(
							'TUser.DELETE_YMD IS NULL','TUser.USER_ID <>' => $user_id_login
					))
			);
			$this->set('userlist', $users);
			$this->set('user_id_login', $user_id_login);
			$this->Session->setFlash($e->getMessage(), 'message', array('message_type' => RwsConstant::MSG_ERROR));
			return $this->render('/Edits/edit_user');
		}
	}
	
	public function doChangeUser() {
		try {
			$this->title = $this->scrFieldLabels['TITLE_EDIT_USER'];
			$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->title);
			$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
			$errorsflg = "";
			
			if ($this->request->is(array('post', 'put'))) {
				$user = $this->request->data['TUser'];
				$user_password = $user['USER_PASSWORD'];
				
				$auth_role = $user['AUTH_ROLE'];
				$mail_address = $user['MAIL_ADDRESS'];
				$auth_demand_forecast_edit = $user['AUTH_DEMAND_FORECAST_EDIT'];
				$user_id = $user['USER_ID'];
				
				if (empty ($user_password)){
						$this->Session->setFlash($this->messages['EDITUSER_ERR_000005'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$errorsflg = "true";
				}
				
			 	if(empty($errorsflg)){
			 		if (!empty ($mail_address)){
			 			if (preg_match('/[^A-Za-z0-9\@\.\[\]()_]/',  $mail_address)){
			 				$this->Session->setFlash($this->messages['EDITUSER_ERR_000009'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
			 				$errorsflg = "true";
			 			}
			 		}
			 	}
			 	
				if(!empty($errorsflg)){
					return $this->redirect('/edit/user');
				}
				
				$condition = "TUser.USER_ID = '" . $user_id . "'";
				$userdb = $this->TUser->find('first', array(
						'conditions' => array(
								'TUser.DELETE_YMD IS NULL',
								$condition
						))
				);
				
				if (!defined('MD5_SALT')) {
					define('MD5_SALT', 'vnkey!');
				}
				if($user_password != $userdb['TUser']['USER_PASSWORD']){
					$encrypt_pass = md5(MD5_SALT.$user_password);
				}
				else{
					$encrypt_pass = $user_password;
				}
				
				$this->TUser->begin();
				$this->TUser->updateAll(
							array('TUser.USER_PASSWORD' => "'$encrypt_pass'", 'TUser.AUTH_ROLE' => "'$auth_role'", 'TUser.MAIL_ADDRESS' => "'$mail_address'", 'TUser.AUTH_DEMAND_FORECAST_EDIT' => "$auth_demand_forecast_edit"),
							array('TUser.USER_ID' => $user_id)
					);
				$this->TUser->commit();
				
			}
			
			$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			return $this->redirect('/edit/user');

		} catch (Exception $e) {
			// Rollback
			$this->TUser->rollback();
			$this->Session->setFlash($e->getMessage(), 'message', array('message_type' => RwsConstant::MSG_ERROR));
			return $this->redirect('/edit/user');
		}
	}
	
	public function doChangeCustomer() {
		try {
			$this->title = $this->scrFieldLabels['TITLE_EDIT_USER'];
			$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->title);
			$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
			$errorsflg = "";
			
			if ($this->request->is(array('post', 'put'))) {
				$user = $this->request->data['TCustomer'];
				
				$customerName = $user['CUSTOMER_NAME'];
				$apiKey = $user['API_KEY'];
				$showAvata = $user['SHOW_AVATA'];
				$noticeEmail = $user['NOTICE_EMAIL'];
				$showTitleVideo = $user['SHOW_TITLE_VIDEO'];
				$user_id = $user['USER_ID'];
				
				if (empty ($customerName)){
						$this->Session->setFlash($this->messages['EDITUSER_ERR_000011'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$this->errors = array($this->messages['EDITUSER_ERR_000011']);
						$errorsflg = "true";
				}
				else if (empty ($apiKey)){
						$this->Session->setFlash($this->messages['EDITUSER_ERR_000012'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$this->errors = array($this->messages['EDITUSER_ERR_000012']);
						$errorsflg = "true";
				}
				
				if(!empty($errorsflg)){
					return $this->redirect('/edit/user');
				}
				
				$this->TCustomer->begin();
				$this->TCustomer->updateAll(
							array('TCustomer.CUSTOMER_NAME' => "'$customerName'", 'TCustomer.API_KEY' => "'$apiKey'", 'TCustomer.SHOW_AVATA' => "$showAvata", 'TCustomer.NOTICE_EMAIL' => "$noticeEmail", 'TCustomer.SHOW_TITLE_VIDEO' => "$showTitleVideo"),
							array('TCustomer.USER_ID' => $user_id)
					);
				$this->TCustomer->commit();
				$user_id_cur = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
				if($user_id == $user_id_cur){
					$this->Session->write(RwsConstant::SESSION_USER_API_KEY, $apiKey);
				}
			}
			
			$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			return $this->redirect('/edit/user');

		} catch (Exception $e) {
			// Rollback
			$this->TCustomer->rollback();
			$this->Session->setFlash($e->getMessage(), 'message', array('message_type' => RwsConstant::MSG_ERROR));
			return $this->redirect('/edit/user');
		}
	}
	
	public function doDeleteUser() {
		try {
			if ($this->request->is(array('post', 'put'))) {
				$this->title = $this->scrFieldLabels['TITLE_EDIT_USER'];
				$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->title);
				$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
				
				$user_id =  $this->request->data['user_id'];
				
				$user = $this->TUser->find('first', array(
						'conditions' => array(
								'TUser.DELETE_YMD IS NULL','TUser.USER_ID' => $user_id
						))
				);
				
				$this->TUser->begin();
				$this->TCustomer->begin();
				$this->TUser->updateAll(
						array('TUser.DELETE_YMD' => "now()"),
						array('TUser.USER_ID' => $user['TUser']['USER_ID'])
				);
				$this->TCustomer->updateAll(
						array('TCustomer.DELETE_YMD' => "now()"),
						array('TCustomer.USER_ID' => $user['TCustomer']['USER_ID'])
				);
				$this->TUser->commit();
				$this->TCustomer->commit();
				$this->LoginCert->begin();
				$this->LoginCert->deleteAll(array('id' => $user_id));
				$this->LoginCert->commit();
				
				if($user_id_login == $user_id){
						$this->title = $this->scrFieldLabels['LOGIN_TITLE'];
					
						$this->Cookie->time = '+1 day';
						$this->Session->destroy();
						
						return $this->redirect('/');
				}
			}
			$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			return $this->redirect('/edit/user');
		} catch (Exception $e) {
			// Rollback
			$this->TUser->rollback();
			$this->TCustomer->rollback();
			$this->Session->setFlash($e->getMessage(), 'message', array('message_type' => RwsConstant::MSG_ERROR));
			return $this->redirect('/edit/user');
		}
	}
	
	public function doCreateNewBacklink() {
		// If change pass button is clicked
		try {
			$this->title = $this->scrFieldLabels['TITLE_EDIT_USER'];
			$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->title);
			$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
			$errorsflg = "";
			
			if ($this->request->is(array('post', 'put'))) {
				$backlink = $this->request->data['TBacklink'];
				
				if (empty ($backlink['USER_ID'])){
					$this->Session->setFlash($this->messages['EDITUSER_ERR_000001'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$errorsflg = "true";
				}
				
				if($errorsflg == ""){
					if(strpos($backlink['LINK'], RwsConstant::FULL_BASE_URL_HOST) !== false){
						$this->Session->setFlash("Not is backlink of " . RwsConstant::FULL_BASE_URL_HOST, 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$errorsflg = "true";
					}
				}
				
				if($errorsflg == ""){
					$page = $this->getContentUrl($backlink['LINK']);
					if(strpos($page, RwsConstant::FULL_BASE_URL_HOST) === false){
						$this->Session->setFlash("Not is backlink of " . RwsConstant::FULL_BASE_URL_HOST, 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$errorsflg = "true";
					}
				}
				
				if($errorsflg == ""){
					$this->TBacklink->begin();
					$blink = $this->TBacklink->create();
					$blink['TBacklink']['USER_ID'] = $backlink['USER_ID'];
					$blink['TBacklink']['LINK'] = $backlink['LINK'];
					$blink['TBacklink']['DATE'] = $backlink['DATE'];
					$this->TBacklink->save($blink);
					$this->TBacklink->commit();
				}
			}
			
			$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
			$login_user_role = 0 + $this->Session->read('login.user.AUTH_ROLE');
			$condition = "1=2";
			if($login_user_role == RwsConstant::USER_AUTH_ROLE_ADMIN){
				$condition = "1=1";	
			}
			else if($login_user_role == RwsConstant::USER_AUTH_ROLE_SUB){
				$condition = "TUser.AUTH_ROLE >= " . RwsConstant::USER_AUTH_ROLE_SUB;
			}
			else {
				$condition = "TUser.USER_ID = '" . $user_id_login . "'";
			}
			
			$users = $this->TUser->find('all', array(
							'fields' => array('TUser.*, TCustomer.*'),
							'conditions' => array(
									'TUser.DELETE_YMD IS NULL',
									$condition
							),
							'joins' =>array(
								array (
										'table' => 'T_CUSTOMER',
										'alias' => 'TCustomer',
										'type' => 'left',
										'conditions' => array (
												'TCustomer.USER_ID = TUser.USER_ID',
												'TCustomer.DELETE_YMD IS NULL',
										)
								)
							),
			));
			$this->set('userlist', $users);
			$this->set('user_id_login', $user_id_login);
			
			$backlinkList = $this->TBacklink->find('all', array(
					'conditions' => array(
							'TBacklink.DELETE_YMD IS NULL',
							'TBacklink.USER_ID' => $user_id_login
					))
			);
			if(sizeof($backlinkList) > 0){
				$this->set('backlinkList', $backlinkList);
			}
			
			if($errorsflg == ""){
				$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			}
			return $this->render('/Edits/edit_user');
			
		} catch (Exception $e) {
			// Rollback
			$this->TBacklink->rollback();
			$users = $this->TUser->find('all', array(
					'conditions' => array(
							'TUser.DELETE_YMD IS NULL',
							'TUser.USER_ID <>' => $user_id_login
					))
			);
			$this->set('userlist', $users);
			$this->set('user_id_login', $user_id_login);
			$this->Session->setFlash($e->getMessage(), 'message', array('message_type' => RwsConstant::MSG_ERROR));
			return $this->render('/Edits/edit_user');
		}
	}
	
	public function doChangeApprove() {
		// If change pass button is clicked
		try {
			$this->title = $this->scrFieldLabels['TITLE_EDIT_USER'];
			$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->title);
			$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
			$errorsflg = "";
			
			if ($this->request->is(array('post', 'put'))) {
				$backlink = $this->request->data['TBacklink'];
				
				if (empty ($backlink['USER_ID'])){
					$this->Session->setFlash($this->messages['EDITUSER_ERR_000001'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$errorsflg = "true";
				}
				
				if($errorsflg == ""){
					if(strpos($backlink['LINK'],RwsConstant::FULL_BASE_URL_HOST) !== false){
						$this->Session->setFlash("Not is backlink of " . RwsConstant::FULL_BASE_URL_HOST, 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$errorsflg = "true";
					}
				}
				
				if($errorsflg == ""){
					$page = $this->getContentUrl($backlink['LINK']);
					if(strpos($page,RwsConstant::FULL_BASE_URL_HOST) === false){
						$this->Session->setFlash("Not is backlink of " . RwsConstant::FULL_BASE_URL_HOST, 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$errorsflg = "true";
					}
				}

				if($errorsflg == ""){
					$approve = $backlink['APPROVE'];
					$date = $backlink['DATE'];
					$link = $backlink['LINK'];
					$note = $backlink['NOTE'];
					$this->TBacklink->begin();
					$this->TBacklink->UpdateAll(
						array('LINK' => "'$link'", 
							'DATE' => "'$date'", 
							'APPROVE' => "$approve",
							'NOTE' => "'$note'"),
						array('ID' => $backlink['ID'])
					);
					$this->TBacklink->commit();
				}
			}
			
			$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
			$login_user_role = 0 + $this->Session->read('login.user.AUTH_ROLE');
			$condition = "1=2";
			if($login_user_role == RwsConstant::USER_AUTH_ROLE_ADMIN){
				$condition = "1=1";	
			}
			else if($login_user_role == RwsConstant::USER_AUTH_ROLE_SUB){
				$condition = "TUser.AUTH_ROLE >= " . RwsConstant::USER_AUTH_ROLE_SUB;
			}
			else {
				$condition = "TUser.USER_ID = '" . $user_id_login . "'";
			}
			
			$users = $this->TUser->find('all', array(
							'fields' => array('TUser.*, TCustomer.*'),
							'conditions' => array(
									'TUser.DELETE_YMD IS NULL',
									$condition
							),
							'joins' =>array(
								array (
										'table' => 'T_CUSTOMER',
										'alias' => 'TCustomer',
										'type' => 'left',
										'conditions' => array (
												'TCustomer.USER_ID = TUser.USER_ID',
												'TCustomer.DELETE_YMD IS NULL',
										)
								)
							),
			));
			$this->set('userlist', $users);
			$this->set('user_id_login', $user_id_login);
			
			$backlinkList = $this->TBacklink->find('all', array(
					'conditions' => array(
							'TBacklink.DELETE_YMD IS NULL',
							'TBacklink.USER_ID' => $user_id_login
					))
			);
			if(sizeof($backlinkList) > 0){
				$this->set('backlinkList', $backlinkList);
			}
			
			if($errorsflg == ""){
				$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			}
			return $this->render('/Edits/edit_user');
			
		} catch (Exception $e) {
			// Rollback
			$this->TBacklink->rollback();
			$users = $this->TUser->find('all', array(
					'conditions' => array(
							'TUser.DELETE_YMD IS NULL',
							'TUser.USER_ID <>' => $user_id_login
					))
			);
			$this->set('userlist', $users);
			$this->set('user_id_login', $user_id_login);
			$this->Session->setFlash($e->getMessage(), 'message', array('message_type' => RwsConstant::MSG_ERROR));
			return $this->render('/Edits/edit_user');
		}
	}
	
	function getContentUrl($url){
    	if(empty($url) || !$this->check_url($url)){
    		return "";
    	}
    	$page = "";
    	try{
			$page = $this->getContentUrlTimeOut($url);
		}catch (Exception $e) {
			return "";
		}
    	return $page;
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
	
	function check_url($url) {
	   $headers = @get_headers( $url);
	   $headers = (is_array($headers)) ? implode( "\n ", $headers) : $headers;
	
	   return (bool)preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers);
	}
}
