<?php
App::uses('AppController', 'Controller');

/**
 * CreateUserController
 */
class CreateUserController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array(
			'TUser',
			'TCustomer',
			'LoginCert',
	);

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function index() {
		$this->title = $this->scrFieldLabels['SCR_LOGIN_CREATE'];
		$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->title);
		
		$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		$users = $this->TUser->find('all', array(
						'conditions' => array(
								'TUser.DELETE_YMD IS NULL'
						))
		);
		$this->set('userlist', $users);
		$this->set('user_id_login', $user_id_login);
		return $this->render('/Login/create','login');
	}
	
	/**
	 * Displays a email change pass
	 */
	public function emailChangePassIndex() {
		return $this->render('\Login\email_input', 'login');
	}
	
	public function active() {
		$this->title = $this->scrFieldLabels['SCR_LOGIN_CREATE'];
		$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->title);
	
		$userCreate = $this->request->query('username');
		$key = $this->request->query('active');
		
		if (!defined('MD5_SALT')) {
			define('MD5_SALT', 'vnkey!');
		}
		$encrypt_key = md5(MD5_SALT.$userCreate);
		
		if($encrypt_key == $key){
			$userActive = $this->TUser->find('first', array(
					'conditions' => array(
							'TUser.DELETE_YMD IS NULL','TUser.USER_ID' => $userCreate
					)
			));
			
			if(sizeof($userActive) == 0){
				$this->set('errors',array($this->messages['LOGIN_CFM_000002']));
				return $this->render('/Login/index','login');
			}
			else{
				$this->TUser->begin();
				$this->TUser->updateAll(
						array('EMAIL_CFM' => true),
						array('USER_ID' => $userActive['TUser']['USER_ID'])
				);
				$this->TUser->commit();
			}
		}
		else{
			$this->set('errors',array($this->messages['LOGIN_CFM_000002']));
			return $this->render('/Login/index','login');
		}
		
		
		$this->set('TUser',$userActive);
		$this->set('messages',array($this->messages['OPERATION_SUCCESS']));
		return $this->render('/Login/index','login');
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
				$user['AUTH_ROLE'] = "4";

				if (empty ($user['USER_ID'])){
					$this->Session->setFlash($this->messages['LOGIN_ERR_000001'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$this->errors = array($this->messages['LOGIN_ERR_000001']);
					$errorsflg = "true";
				}
				else if (strlen($user['USER_ID']) > 32){
					$this->Session->setFlash($this->messages['USERSETTING_ERR_000004'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$this->errors = array($this->messages['USERSETTING_ERR_000004']);
					$errorsflg = "true";
				}
				else if (preg_match('/[^A-Za-z0-9\[\]()_]/', $user['USER_ID'])){
					$this->Session->setFlash($this->messages['EDITUSER_ERR_000008'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$this->errors = array($this->messages['EDITUSER_ERR_000008']);
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
						$this->errors = array($this->messages['EDITUSER_ERR_000004']);
						$errorsflg = "true";
					}
				}
				if(empty($errorsflg)){
					if (empty ($user['USER_PASSWORD'])){
						$this->Session->setFlash($this->messages['LOGIN_ERR_000002'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
						$this->errors = array($this->messages['LOGIN_ERR_000002']);
						$errorsflg = "true";
					} else{
						if (strlen($user['USER_PASSWORD']) > 32){
							$this->Session->setFlash($this->messages['EDITUSER_ERR_000006'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
							$this->errors = array($this->messages['EDITUSER_ERR_000006']);
							$errorsflg = "true";
						}
						else if (empty ($user['USER_PASSWORD_CFM'])){
							$this->Session->setFlash($this->messages['USERSETTING_ERR_000006'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
							$this->errors = array($this->messages['USERSETTING_ERR_000006']);
							$errorsflg = "true";
					    }
					    else if ($user['USER_PASSWORD_CFM'] != $user['USER_PASSWORD']){
					    	$this->Session->setFlash($this->messages['USERSETTING_ERR_000003'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					    	$this->errors = array($this->messages['USERSETTING_ERR_000003']);
					    	$errorsflg = "true";
					    }
						else if (empty ($user['MAIL_ADDRESS'])){
							$this->Session->setFlash($this->messages['USERSETTING_ERR_000007'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
							$this->errors = array($this->messages['USERSETTING_ERR_000007']);
							$errorsflg = "true";
						}
						else if (preg_match('/[^A-Za-z0-9\@\.\[\]()_]/',  $user['MAIL_ADDRESS'])){
							$this->Session->setFlash($this->messages['EDITUSER_ERR_000010'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
							$this->errors = array($this->messages['EDITUSER_ERR_000010']);
							$errorsflg = "true";
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
					return $this->render('/Login/create','login');
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
					
					$customer = $this->TCustomer->create(); 
					$customer['TCustomer']['USER_ID'] = $user['USER_ID'];
					$customer['TCustomer']['CUSTOMER_NAME'] = $user['USER_ID'];
					
					$this->TUser->begin();
					$this->TCustomer->begin();
					$this->TUser->save($user);
					$this->TCustomer->save($customer);
					$this->TUser->commit();
					$this->TCustomer->commit();

					//$this->doSendMailCfm($user['USER_ID'], $user['MAIL_ADDRESS']);
				}
			}
			if(isset($user_id_login)){
				$users = $this->TUser->find('all', array(
						'conditions' => array(
								'TUser.DELETE_YMD IS NULL','TUser.USER_ID <>' => $user_id_login
						))
				);
				$this->set('userlist', $users);
				$this->set('user_id_login', $user_id_login);
			}
			$message = $this->messages['EMAIL_CFM_CHECK'];
			$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			$this->set('messages',array($message));
			return $this->render('/Login/index','login');
			
		} catch (Exception $e) {
			// Rollback
			$this->TUser->rollback();
			$this->TCustomer->rollback();
			if(isset($user_id_login)){
				$users = $this->TUser->find('all', array(
						'conditions' => array(
								'TUser.DELETE_YMD IS NULL','TUser.USER_ID <>' => $user_id_login
						))
				);
				$this->set('userlist', $users);
				$this->set('user_id_login', $user_id_login);
			}
			$this->Session->setFlash($e->getMessage(), 'message', array('message_type' => RwsConstant::MSG_ERROR));
			return $this->render('/Login/create','login');
		}
	}
	
	public function doSendMailCfm($user_id, $email) {
		// Get Parameters
		$params['advice_mail_to'] = $email;
		$params['advice_mail_title'] = $this->messages['EMAIL_CFM_TITLE'];
		$params['advice_mail_body'] = $this->messages['EMAIL_CFM_BODY'];
		$params['advice_sender'] = "Admin Youman";
		
		if (!defined('MD5_SALT')) {
			define('MD5_SALT', 'vnkey!');
		}
		$encrypt_key = md5(MD5_SALT.$user_id);
		
		$params['advice_mail_body'] = $params['advice_mail_body'] . "\n" . "Username : " . $user_id;
		$params['advice_mail_body'] = $params['advice_mail_body'] . "\n" . RwsConstant::FULL_BASE_URL_HOST . "/createUser/active?username=" . $user_id . "&active=" . $encrypt_key;
							
		// Do send email
		$email_params = array(
				'sender' => $params['advice_sender'],
				'subject' => $params['advice_mail_title'],
				'body' => $params['advice_mail_body'],
				'to' => $params['advice_mail_to']
		);
		
		try {
			RwsHelper::sendEmail($email_params);
		} catch (Exception $e) {
			$this->errors = array($this->messages['SEND_EMAIL_FAILED']);
			throw new SocketException(__d('cake_dev', $e->getMessage()));
			return false;
		}
		return true;
	}
	
	public function doSendEmailChangePass() {
		// If change pass button is clicked
		try {
			$this->title = $this->scrFieldLabels['TITLE_EDIT_USER'];
			$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->title);
			$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
			$errorsflg = "";
				
			if ($this->request->is(array('post', 'put'))) {
				$email = $this->request->data['email'];
								
				$userFind = $this->TUser->find('first', array(
						'conditions' => array(
								'TUser.DELETE_YMD IS NULL',
								'TUser.MAIL_ADDRESS' => "' . $email . '"
						)
				));
				
				$user_id = $userFind['USER_ID'];
				
				if(isset($user_id)){
				
					// Get Parameters
					$params['advice_mail_to'] = $email;
					$params['advice_mail_title'] = "Change pass";
					$params['advice_mail_body'] = "Bạn hoặc ai đó đã yêu cầu đổi mật khẩu trên trang " . RwsConstant::FULL_BASE_URL_HOST . " . Nhấp vào link sau để thay đổi pass : ";
					$params['advice_sender'] = "Admin Youman";
				
					if (!defined('MD5_SALT')) {
						define('MD5_SALT', 'vnkey!');
					}
					$encrypt_key = md5(MD5_SALT.$user_id);
				
					$params['advice_mail_body'] = $params['advice_mail_body'] . "\n" . "Username : " . $user_id;
					$params['advice_mail_body'] = $params['advice_mail_body'] . "\n" . RwsConstant::FULL_BASE_URL_HOST . "/createUser/changePass?username=" . $user_id . "&key=" . $encrypt_key;
						
					// Do send email
					$email_params = array(
							'sender' => $params['advice_sender'],
							'subject' => $params['advice_mail_title'],
							'body' => $params['advice_mail_body'],
							'to' => $params['advice_mail_to']
					);
				
					try {
						RwsHelper::sendEmail($email_params);
					} catch (Exception $e) {
						$this->errors = array($this->messages['SEND_EMAIL_FAILED']);
						throw new SocketException(__d('cake_dev', $e->getMessage()));
						return false;
					}
					
				}
			}
		} catch (Exception $e) {
			$this->errors = array($this->messages['SEND_EMAIL_FAILED']);
			throw new SocketException(__d('cake_dev', $e->getMessage()));
			return false;
		}
		return true;
	}
	
}
