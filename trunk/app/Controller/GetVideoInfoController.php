<?php
App::uses('AppController', 'Controller');

/**
 * GetVideoInfoController
 */
class GetVideoInfoController extends AppController {

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
		$this->title = $this->scrFieldLabels['SCR_MENU_SEARCH'];
		$this->link = '/search';
		$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->link);
		
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
		
		return $this->render('/Actions/getVideoInfo');
	}
}