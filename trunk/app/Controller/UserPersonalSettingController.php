<?php
App::uses('AppController', 'Controller');

/**
 * SiteController
 */
class UserPersonalSettingController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array(
			'TUser',
			'TCustomer'
	);

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function index() {
		$this->title = $this->scrFieldLabels['SCR_USER_PROFILE'];
		$this->urlHistories = array($this->scrFieldLabels['MENU_USER'], $this->title);
		
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
		
		return $this->render('/Edits/user_personal_setting');
	}
	
	/**
	 * doCheckChangePass
	 * @return CakeResponse
	 */
	public function doCheckChangePass() {
		$this->ajaxAction();
		$data = $_POST ['dataInput'];
	
		try {
			$user_id = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
			$user_password_old = $data[0];
			$user_password_new = $data[1];
			$user_password_new_confirm = $data[2];
			
			if (empty ($user_password_old)){
				$res['data'] = $this->messages['USERSETTING_ERR_000000'];
				$res['id_error'] = "id_setting_old_pass";
				$errorsflg = "true";
			}
			else if (!$this->checkPassword($user_id, $user_password_old)) {
				$res['data'] = $this->messages['USERSETTING_ERR_000001'];
				$res['id_error'] = "id_setting_old_pass";
				$errorsflg = "true";
			}
			else if (empty ($user_password_new)){
				$res['data'] = $this->messages['USERSETTING_ERR_000002'];
				$res['id_error'] = "id_setting_new_pass";
				$errorsflg = "true";
			}
			else if (strlen($user_password_new) > 32 || strlen($user_password_new_confirm) > 32){
				$res['data'] = $this->messages['USERSETTING_ERR_000004'];
				$res['id_error'] = "id_setting_old_pass";
				$errorsflg = "true";
			}
			else if (empty ($user_password_new_confirm)){
				$res['data'] = $this->messages['USERSETTING_ERR_000006'];
				$res['id_error'] = "id_setting_new_pass_confirm";
				$errorsflg = "true";
			}
			else if ($user_password_new != $user_password_new_confirm){
				$res['data'] = $this->messages['USERSETTING_ERR_000003'];
				$res['id_error'] = "id_setting_new_pass_confirm";
				$errorsflg = "true";
			}
	
			if(!empty($errorsflg)){
				$res['success'] = false;
				return json_encode($res);
			}
			
		} catch (Exception $e) {
			$res['data'] = $e->getMessage();
			$res['success'] = false;
			return json_encode($res);
		}
	
		$res['success'] = true;
		return json_encode($res);
	}
	
	/**
	 * doCheckExist
	 * @return CakeResponse
	 */
	public function doCheckExist($data_mail_list, $input_data_mail) {
		$strMail = explode ( ",", $data_mail_list);
		for($i = 0 ; $i < sizeof ( $strMail ); $i ++) {
			if($input_data_mail == $strMail[$i]){
				return true;
			}
		}
		return false;
	}
	
	public function doChangePass() {
		// If change pass button is clicked
		try {
			
			$errorsflg = "";
			
			if ($this->request->is(array('post', 'put'))) {
				$this->title = $this->scrFieldLabels['SCR_USER_PROFILE'];
				$this->urlHistories = array($this->scrFieldLabels['MENU_USER'], $this->title);
				$user_id = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
				$user = $this->TUser->find('first', array(
						'conditions' => array(
								'TUser.USER_ID' => $user_id
						)
				));
				$this->set('userlanguage', $user['TUser']['LANGUAGE']);
				
				$user_password_old = isset($this->request->data['TUser']['USER_PASSWORD_OLD']) ? $this->request->data['TUser']['USER_PASSWORD_OLD'] : '';
				$user_password_new = isset($this->request->data['TUser']['USER_PASSWORD_NEW']) ? $this->request->data['TUser']['USER_PASSWORD_NEW'] : '';
				$user_password_new_confirm = isset ($this->request->data['TUser']['USER_PASSWORD_NEW_CONFIRM']) ? $this->request->data['TUser']['USER_PASSWORD_NEW_CONFIRM'] : '';
				
				if (empty ($user_password_old)){
					$this->Session->setFlash($this->messages['USERSETTING_ERR_000000'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$errorsflg = "true";
				}
				else if (!$this->checkPassword($user_id, $user_password_old)) {
					$this->Session->setFlash($this->messages['USERSETTING_ERR_000001'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$errorsflg = "true";
				}
				else if (empty ($user_password_new)){
					$this->Session->setFlash($this->messages['USERSETTING_ERR_000002'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$errorsflg = "true";
				}
				else if (strlen($user_password_new) > 32 || strlen($user_password_new_confirm) > 32){
					$this->Session->setFlash($this->messages['USERSETTING_ERR_000004'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$errorsflg = "true";
				}
				else if (empty ($user_password_new_confirm)){
					$this->Session->setFlash($this->messages['USERSETTING_ERR_000006'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$errorsflg = "true";
				}
				else if ($user_password_new != $user_password_new_confirm){
					$this->Session->setFlash($this->messages['USERSETTING_ERR_000003'], 'message', array('message_type' => RwsConstant::MSG_ERROR));
					$errorsflg = "true";
				}
				
				if($errorsflg == "true"){
					$this->set('user_password_old', $user_password_old);
					$this->set('user_password_new', $user_password_new);
					$this->set('user_password_new_confirm', $user_password_new_confirm);
					return $this->render('/Edits/user_personal_setting');
				}
				
				
				// Begin transaction
// 				$encrypt_pass = md5(MD5_SALT.$user_password_new);

				$this->TUser->begin();
				$this->TUser->updateAll(
						array('TUser.USER_PASSWORD' => "'$user_password_new'"),
						array('TUser.USER_ID' => $user_id)
				);
				$this->TUser->commit();

			}
			
			$this->Session->setFlash($this->messages['USERSETTING_SEC_000001'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));

		} catch (Exception $e) {
			// Rollback
			$this->TUser->rollback();
			// Set error
			$this->errors = array(
					'0' => $e->getMessage()
			);
		}
		
		return $this->render('/Edits/user_personal_setting');
	}
	
	private function checkPassword($user_id, $password) {
		$user = $this->TUser->find('first', array(
				'conditions' => array(
						'TUser.USER_ID' => $user_id
				)
		));
		//
// 		if (!defined('MD5_SALT')) {
// 			define('MD5_SALT', 'jppro');
// 		}
// 		$db_pass = $user['TUser']['user_password'];
// 		$encrypt_pass = md5(MD5_SALT.$password);
// 		if ($db_pass !== $encrypt_pass) {
// 			return false;
// 		}

		$db_pass = $user['TUser']['USER_PASSWORD'];
		if($db_pass !== $password){
			return false;
		}
		return $user;
	}
	
	public function doChangeLanguage() {
		// If change pass button is clicked
		try {
			$this->title = $this->scrFieldLabels['SCR_USER_PROFILE'];
			$this->urlHistories = array($this->scrFieldLabels['MENU_USER'], $this->title);
			
			if ($this->request->is(array('post', 'put'))) {
				$user_id = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
				//$this->TUser->set('language',  $this->request->data['TUser']['language']);
				
				$this->TUser->begin();
				$this->TUser->updateAll(
					array('TUser.LANGUAGE' => $this->request->data['TUser']['LANGUAGE']),
				    array('TUser.USER_ID' => $user_id)
				);
				$this->TUser->commit();
				
				if(!is_null($this->request->data['TUser']['LANGUAGE'])){
					$this->set('userlanguage', $this->request->data['TUser']['LANGUAGE']);
					
//					if ($this->request->data['TUser']['LANGUAGE'] === '0') {
//						$this->language = RwsConstant::LANGUAGE_JA;
//					} else {
//						$this->language = RwsConstant::LANGUAGE_EN;
//					}
					$this->language = $this->request->data['TUser']['LANGUAGE'];
					$this->Cookie->write(RwsConstant::COOKIE_KEY_LANGUAGE, $this->language);
					$this->applyLanguage();
				}
				
			}
		} catch (Exception $e) {
			// Rollback
			$this->TUser->rollback();
			// Set error
			$this->errors = array(
					'0' => $e->getMessage()
			);
			return $this->render('/Edits/user_personal_setting');
		}
		$this->Session->setFlash($this->messages['USERSETTING_SEC_000001'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
		return $this->redirect('/edit/profile');
	}
	
	public function doChangeCustomer() {
		// If change pass button is clicked
		try {
			$this->title = $this->scrFieldLabels['SCR_USER_PROFILE'];
			$this->urlHistories = array($this->scrFieldLabels['MENU_USER'], $this->title);
			
			if ($this->request ->is(array('post', 'put'))) {
				$user_id = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
				$customer = $this->request->data['TCustomer'];
				$customer_name = $customer['CUSTOMER_NAME'];
				$api_key = $customer['API_KEY'];
				$show_avata = $customer['SHOW_AVATA'];
				$notice_email = $customer['NOTICE_EMAIL'];
				$show_title_video = $customer['SHOW_TITLE_VIDEO'];
				
				$this->TCustomer->begin();
				$this->TCustomer->updateAll(
					array('TCustomer.CUSTOMER_NAME' => "'$customer_name'",
					'TCustomer.API_KEY' => "'$api_key'",
					'TCustomer.SHOW_AVATA' => $show_avata,
					'TCustomer.NOTICE_EMAIL' => $notice_email,
					'TCustomer.SHOW_TITLE_VIDEO' => $show_title_video),
				    array('TCustomer.USER_ID' => $user_id)
				);
				$this->TCustomer->commit();
			}
		} catch (Exception $e) {
			// Rollback
			$this->TUser->rollback();
			// Set error
			$this->errors = array(
					'0' => $e->getMessage()
			);
			return $this->render('/Edits/user_personal_setting');
		}
		$this->Session->setFlash($this->messages['USERSETTING_SEC_000001'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
		return $this->redirect('/edit/profile');
	}
}
