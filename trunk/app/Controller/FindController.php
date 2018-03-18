<?php
App::uses('AppController', 'Controller');
/**
 * FindController
 */
class FindController extends AppController {
/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array(
			'TUser',
			'TCustomer',
			'TFind',
			'TFindDetails'
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
		$this->link = '/find';
		$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->link);
		$user_id = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
		$login_user_role = 0 + $this->Session->read('login.user.AUTH_ROLE');
		if($login_user_role <= RwsConstant::USER_AUTH_ROLE_SUB){
			$findList = $this->TFind->find('all', array(
					'conditions' => array(
							'DELETE_YMD IS NULL'
					)
			));
			if(sizeof($findList) > 0){
				$this->set('findList',$findList);
			}
		}
		return $this->render('/Actions/find', 'admin');
	}

	/**
	 * doBeginFind
	 * @return CakeResponse
	 */
	public function doBeginFind() {
		try {
			$this->title = $this->scrFieldLabels['SCR_MENU_SEARCH'];
			if ($this->request->is(array('post', 'put'))) {
				$searchParam = $this->request->data;
			}
			if(!isset($searchParam)){
				return $this->render('/Action/find', 'admin');
			}
			$findIdSelectArr = $searchParam['hdn_id_id_select_find'];
			$user_id_login = $this->Session->read(RwsConstant::SESSION_LOGIN_USER_KEY);
	
			if($findIdSelectArr != ""){
				$findIds = explode(",",$findIdSelectArr);
				foreach ($findIds as $findId){
					if($findId != ""){
						$find = $this->TFind->find('first', array(
								'conditions' => array(
										'ID' => $findId,
										'DELETE_YMD IS NULL'
								)
						));
						if(sizeof($find) > 0){
							$this->findIpContent($find);
						}
						
					}
				}
			}
			
			$this->Session->setFlash($this->messages['OPERATION_SUCCESS'], 'message', array('message_type' => RwsConstant::MSG_SUCCESS));
			$this->messages = array(
					'0' => $this->messages['OPERATION_SUCCESS']
			);
			
			$findDetailsList = $this->TFindDetails->find('all', array(
					'conditions' => array(
							'FIND_ID' => $findIdSelectArr,
							'DELETE_YMD IS NULL'
					)
			));
			
			$this->set('findDetails', $findDetailsList);
			return $this->render('/Actions/find', 'admin');
		} catch (Exception $e) {
			$this->errors = array(
					'0' => "Error12:" . $e->getMessage()
			);
			return $this->render('/Actions/find', 'admin');
		}
	}
	
	private function findIpContent($find){
		$ip_start = $find['TFind']['IP_START'];
		$ip_current = $find['TFind']['IP_CURRENT'];
		$ip_finish = $find['TFind']['IP_FINISH'];
		$key = $find['TFind']['KEY'];
		try{
			if($ip_current == ''){
				$ip_current = $ip_start;
			}
			$ipArr = explode(".",$ip_current);
			$ip1 = $ipArr[0];
			$ip2 = $ipArr[1];
			$ip3 = $ipArr[2];
			$ip4 = $ipArr[3];
			if($ip4 >= 254){
				$ip3 = $ip3 + 1;
				$ip4 = 1;
			}
			if($ip3 >= 254){
				$ip2 = $ip2 + 1;
				$ip3 = 1;
			}
			if($ip2 >= 254){
				$ip1 = $ip1 + 1;
				$ip2 = 1;
			}
			if($ip1 >= 254){
				$ip1 = $ip2 = $ip3 = $ip3 = 254;
			}
			for($i = $ip4; $i < 255 ; $i++){
				$ipCheck = $ip1 . "." . $ip2 . "." . $ip3 . "." . $i;
				$this->TFind->begin();
				$find['TFind']['IP_CURRENT'] = $ipCheck;
				$this->TFind->save($find);
				$this->TFind->commit();
				
				//Check ip
				$urlCheck1  = "http://" . $ipCheck . "/rapidleech/";
				$urlCheck2  = "http://" . $ipCheck . "/";
				try{
					$channelPage = $this->curl($urlCheck1);
				}catch (Exception $e) {
					$this->errors = array(
							'0' => "Error01:" . $e->getMessage()
					);
				}
				if( !empty($channelPage) && strpos($channelPage, $key) !== false) {
					$this->TFindDetails->begin();
					$findDetails = $this->TFindDetails->create();
					$findDetails['TFindDetails']['FIND_ID'] = $find['TFind']['ID'];
					$findDetails['TFindDetails']['KEY'] = $find['TFind']['KEY'];
					$findDetails['TFindDetails']['IP'] = $ipCheck;
					$findDetails['TFindDetails']['LINK'] = $urlCheck1;
					$this->TFindDetails->save($findDetails);
					$this->TFindDetails->commit();
				}
				else{
					try{
						$channelPage = $this->curl($urlCheck2);
					}catch (Exception $e) {
						$this->errors = array(
								'0' => "Error01:" . $e->getMessage()
						);
					}
					if(!empty($channelPage) && strpos($channelPage, $key) > 0) {
						$this->TFindDetails->begin();
						$findDetails = $this->TFindDetails->create();
						$findDetails['TFindDetails']['FIND_ID'] = $find['TFind']['ID'];
						$findDetails['TFindDetails']['KEY'] = $find['TFind']['KEY'];
						$findDetails['TFindDetails']['IP'] = $ipCheck;
						$findDetails['TFindDetails']['LINK'] = $urlCheck2;
						$this->TFindDetails->save($findDetails);
						$this->TFindDetails->commit();
					}
				}
			}
		}
		catch (Exception $e) {
			$this->errors = array(
					'0' => "Error01:" . $e->getMessage()
			);
		}
	}
	
	function curl($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$data = curl_exec($ch);
		curl_close($ch);
	
		return $data;
	}
}