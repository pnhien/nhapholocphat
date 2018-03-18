<?php
App::uses('AppController', 'Controller');

/**
 * Login Controller
 */
class LoginController extends AppController {
	
	public $uses = array(
			'LoginCert',
			'TUser',
			'TAuth'
	);
	
	/**
	 * Displays a view Login
	 */
	public function init() {
		$this->title = $this->scrFieldLabels['LOGIN_TITLE'];
		// Validate Login
		$cert = $this->Session->read(RwsConstant::SESSION_CERT_KEY);
		if (empty($cert)) {
			return $this->render('index', 'login');
		}
		$permission = RwsConstant::PUBLIC_PERMISSION;
		$login_cert = $this->LoginCert->find('first', array(
				'conditions' => array(
						'LoginCert.CERT' => $cert,
						'LoginCert.PERMISSION' => $permission
				)
		));
		if (empty($login_cert)) {
			return $this->render('index', 'login');
		}
		
		if ($cert === $login_cert['LoginCert']['CERT']) {
			$cert_id = $login_cert['LoginCert']['ID'];
			$user = $this->TUser->find('first', array(
					'conditions' => array(
							'TUser.USER_ID' => $cert_id,
							'TUser.DELETE_YMD IS NULL',
							'TUser.EMAIL_CFM' => true
					)
			));
			if (empty($user)) {
				return $this->render('index', 'login');
			}
			
			$this->language = $user['TUser']['LANGUAGE'];
			$this->Cookie->write(RwsConstant::COOKIE_KEY_LANGUAGE, $this->language);
			$this->applyLanguage();
			
			$this->LoginCert->updateLoginTimeLimit($cert, $cert_id, $permission);
			
			$this->title = $this->scrFieldLabels['LOGIN_TITLE'];
			return $this->redirect('/edit/user');
		}
		
		return $this->render('index', 'login');
	}
	
	public function doChangeLanguage() {
		$lang = $this->request->query('language');
		$link = $this->request->query('link');
		if(empty($link)){
			$link = "/";
		}
		if (!empty($lang)) {
			$this->language = $lang;
		}
		$this->Cookie->write(RwsConstant::COOKIE_KEY_LANGUAGE, $this->language);
		$this->applyLanguage();
		$user_id = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		if(isset($user_id)){
			if (!$this->TUser->updateLanguage($user_id, $this->language)) {
				$this->Session->setFlash($this->messages['DB_ERROR'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
				return $this->render('index', 'login'); 
			}
		}
		
		return $this->redirect($link);
	}
	
	public function doLogin() {
		$this->title = $this->scrFieldLabels['LOGIN_TITLE'];
		// If Login button is clicked
		try {
			if ($this->request->is(array('post', 'put'))) {
				$this->TUser->set($this->request->data);
				if (!$this->TUser->validates()) {
					$errors = $this->TUser->validationErrors;
					if (!empty($errors['USER_ID'])) {
						$this->errors = array(
								'USER_ID' => $this->messages['LOGIN_ERR_000001']
						);
					} else if (!empty($errors['USER_PASSWORD'])) {
						$this->errors = array(
								'USER_PASSWORD' => $this->messages['LOGIN_ERR_000002']
						);
					}
					return $this->render('index', 'login');
				}
				// Begin transaction
				$this->TUser->begin();
				$this->LoginCert->begin();
				//
				$user_id = $this->request->data['TUser']['USER_ID'];
				$user_password = $this->request->data['TUser']['USER_PASSWORD'];
				// パスワードをデータベースから取得する。
				//(各ログインでパスワードの取得先が違う場合は、
				// 継承先でオーバーライドする必要あり)
				/** Skip this step, please goto method detail */
				$user = $this->TUser->find('first', array(
						'conditions' => array(
								'TUser.USER_ID' => $user_id,
								'TUser.DELETE_YMD IS NULL'
						)
				));
				if (sizeof($user) == 0) {
					$this->errors = array(
							'0' => $this->messages['LOGIN_ERR_000003']
					);
					return $this->render('index', 'login');
				}
				
				$userActive = $this->TUser->find('first', array(
						'conditions' => array(
								'TUser.USER_ID' => $user_id,
								'TUser.DELETE_YMD IS NULL',
								'TUser.EMAIL_CFM' => true
						)
				));
				if (sizeof($userActive) == 0) {
					$this->errors = array(
							'0' => $this->messages['EMAIL_CFM_NOT_ACTIVE']);
					return $this->render('index', 'login');
				}
				$user = $this->checkPassword($user_id, $user_password, $userActive);
				if (!$user) {
					$this->errors = array(
							'0' => $this->messages['LOGIN_ERR_000003']
					);
					return $this->render('index', 'login');
				}
				// 認証文字列を発行して割り当てる。
				if ($this->regenerate($user_id, RwsConstant::PUBLIC_PERMISSION)) {
					// ログインが成功したときは最終ログイン日時を更新する
					$ip_login = $_SERVER['REMOTE_ADDR'];
					$details = json_decode($this->getContentUrlTimeOut("http://ipinfo.io/".$ip_login."/json"));
					if(isset($details->country)){
						$this->TUser->updateLastLoginTime($user_id, $details->country);
					}
					else{
						$this->TUser->updateLastLoginTime($user_id, '');
					}
					$this->TUser->updateIpLogin($user_id, $ip_login);
					$this->Session->write(RwsConstant::SESSION_LOGIN_USER_KEY, $user_id);
					$this->Session->write('login.user', $user['TUser']);

					$userLanguage = $this->TUser->find('first', array(
						'fields' => array('TUser.LANGUAGE, TCustomer.API_KEY'),
						'conditions' => array(
								'TUser.DELETE_YMD IS NULL',
								'TUser.USER_ID' => $user_id
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

					if($userLanguage['TUser']['LANGUAGE'] != null){
						$this->language = $userLanguage['TUser']['LANGUAGE'];
					}
					else{
						$this->language = "en";
						$this->TUser->updateLanguage($user_id, $this->language);
					}
					$this->Cookie->write(RwsConstant::COOKIE_KEY_LANGUAGE, $this->language);
					$this->Session->write(RwsConstant::SESSION_USER_API_KEY, $userLanguage['TCustomer']['API_KEY']);
					$this->Session->write(RwsConstant::SESSION_LOGIN_CONTROL, 'guide-pinned no-focus-outline show-guide');
					$this->applyLanguage();
		
					// Commit
					$this->TUser->commit();
					$this->LoginCert->commit();
					
					if ($this->Session->check('Message')) {
						$this->Session->delete('Message');
					}

					// Fixed 2015/04/16 for MENU display
// 					$auth = $this->TAuth->find('first', array(
// 							'conditions' => array(
// 									'USER_ID' => $user_id,
// 									'AUTH_EDIT' => '1',
// 									'DELETE_YMD is null'
// 							)
// 					));
// 					if (!empty($auth)) {
// 						$this->Session->write(RwsConstant::SESSION_SITE_AUTH_EDIT, true);
// 					}
// 					$this->Session->write(RwsConstant::SESSION_SELECTED_SCREEN_ID, 'SCR_USER_SITELIST');

					$this->redirect('/');
				}
			}
		} catch (Exception $e) {
			// Rollback
			$this->TUser->rollback();
			$this->LoginCert->rollback();
			// Set error
			$this->errors = array(
					'0' => $e->getMessage()
			);
		}
		return $this->render('index', 'login');
	}
	
	private function checkPassword($user_id, $password, $user) {
		if (!defined('MD5_SALT')) {
			define('MD5_SALT', 'vnkey!');
		}
		$encrypt_pass = md5(MD5_SALT.$password);
		$password = $encrypt_pass;
		$db_pass = $user['TUser']['USER_PASSWORD'];
		if ($db_pass !== $password) {
			return false;
		}
		return $user;
	}
	
	/**
	 * 認証文字列の発行とセッションへの格納
	 */
	private function regenerate($user_id, $permission) {
		$cert = RwsHelper::getRandCert();
		$login_cert = $this->LoginCert->updateLoginTimeLimit($cert, $user_id, $permission);
		if (!empty($login_cert)) {
			$this->Session->write(RwsConstant::SESSION_CERT_KEY, $cert);
			return true;
		}
		return false;
	}
	
	public function doLogout() {
		$this->title = $this->scrFieldLabels['LOGIN_TITLE'];
		
		$this->Cookie->time = '+1 day';
		$this->Session->destroy();
		
		return $this->redirect('/');
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
}
