<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
require APPLIBS . DS . "RwsHelper.php"; 
require APPLIBS . DS . "RwsConstant.php";
require APPLIBS . DS . "Message.php";
require APPLIBS . DS . "ScreenFieldLabels.php";
require APPLIBS . DS . "AlarmType.php";
require APPLIBS . DS . "SiteMap.php";

App::uses('CakeTime', 'Utility');
App::uses('Controller', 'Controller');


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	protected $title;
	protected $link;
	protected $language;
	protected $languageArr;
	// Define Error Message List
	protected $messages;
	// Define Screen Field Label List
	protected $scrFieldLabels;
	protected $errors;
	// URL HISTORY
	protected $urlHistories;
	
	public $components = array (
			'Cookie',
			'Session'
	);
	
	public $helpers = array(
			'Html',
			'Js' => array('Jquery'),
			'Session'
	);
	
	public function beforeRender () {
		if ($this->name == 'CakeError') {
			$this->layout = 'error';
		}
		// Check login
		if(isset($this->params['controller'])){
			if ($this->params['controller'] !== 'login' && !$this->Session->check(RwsConstant::SESSION_LOGIN_USER_KEY)) {
				$accept = array('results','watch','createUser','news','newsList','about','getRssNews','bdsNews');
				if(!in_array($this->params['controller'],$accept)){
					$adminPage = array('codeDebug','editNews','editUser','find','getVideoInfo','manage','manageReup','manageTemp','search','seoTag','seoTop','userPersonalSetting');
					if(in_array($this->params['controller'],$adminPage)){
						return $this->redirect('/login');
					} else {
						return $this->redirect('/');
					}
				}
			}
		}
		// Set data for VIEW
		if(!isset($this->title)){
			$this->title = "Mua bán nhà phố - Tư vấn mua bán nhà";
		}
		$this->set('title_for_layout', $this->title);
		if (!empty($this->errors)) {
			$this->set('errors', $this->errors);
		}

		$this->set('language', $this->language);
                
		$this->set('scrFieldLabels', $this->scrFieldLabels);
		$this->set('messageList', $this->messages);
		$this->set('urlHistories', $this->urlHistories);
		if($this->title == "Mua bán nhà phố - Tư vấn mua bán nhà"){
			$this->set('title',$this->title);
		}
		else{
			$this->set('title',$this->title);
		}
		
		// Set LAYOUT depend on APP_MODE: HTML, Developer or Release
		if ($this->params['controller'] === 'pages') {
			$this->set('APP_MODE', RwsConstant::APP_MODE_HTML);
		} else {
			$this->set('APP_MODE', RwsConstant::APP_MODE_DEV);
		}
		// Saving current URL for turn back
		if(isset($this->Session)){
			$controller_arr = $this->Session->read(RwsConstant::SESSION_ARR_CONTROLLER_KEY);
		}
		if (empty($controller_arr)) {
			$controller_arr = array();
			array_push($controller_arr, $this->params['controller']);
			$this->Session->write(RwsConstant::SESSION_ARR_CONTROLLER_KEY, $controller_arr);
			$this->Session->write(RwsConstant::SESSION_LAST_URL_KEY, $this->request->here);
			$this->Session->write(RwsConstant::SESSION_CURR_URL_KEY, $this->request->here);
		} else {
			if (count($controller_arr) === 1) {
				array_push($controller_arr, $this->params['controller']);
				$this->Session->write(RwsConstant::SESSION_ARR_CONTROLLER_KEY, $controller_arr);
				$this->Session->write(RwsConstant::SESSION_CURR_URL_KEY, $this->request->here);
			} else {
				$prev_controller = end($controller_arr);
				$cur_controller = $this->params['controller'];
				if ($prev_controller !== $cur_controller) {
					array_push($controller_arr, $this->params['controller']);
					$this->Session->write(RwsConstant::SESSION_ARR_CONTROLLER_KEY, $controller_arr);
					$tmp_curr_url = $this->Session->read(RwsConstant::SESSION_CURR_URL_KEY);
					$this->Session->write(RwsConstant::SESSION_LAST_URL_KEY, $tmp_curr_url);
					$this->Session->write(RwsConstant::SESSION_CURR_URL_KEY, $this->request->here);
				}
			}
		}
	}
	
	public function beforeFilter() {
		// Config COOKIE
		$this->Cookie->name = RwsConstant::COOKIE_NAME;
		$this->Cookie->time = '+1 day';
		$this->Cookie->path = '/';
		$this->Cookie->secure = false;
		// Define LANGUAGE
		$paraLanguage = $this->request->query;
		if(isset($paraLanguage['hl'])){
			if($this->getCheckLanguage($paraLanguage['hl'])){
				$this->language = $paraLanguage['hl'];
			}
			else{
				$this->language = RwsConstant::LANGUAGE_EN;
			}
		}
		else{	
			if ($this->Cookie->check(RwsConstant::COOKIE_KEY_LANGUAGE)) {
				$cookie_language = $this->Cookie->read(RwsConstant::COOKIE_KEY_LANGUAGE);
				// When app start, language still not be set, in this case, should auto set language JA
				if (!empty($cookie_language) && $cookie_language !== $this->language) {
					$this->language = $cookie_language;
				}
			} else {
				$user_ip = $_SERVER['REMOTE_ADDR'];
				if(!$this->getSetLanguageBegin($user_ip)){
					$this->language = RwsConstant::LANGUAGE_EN;// Default language
				}
			}
		}
		$this->Cookie->write(RwsConstant::COOKIE_KEY_LANGUAGE, $this->language);
		$this->applyLanguage();
		if (empty($this->urlHistories)) {
			$this->urlHistories = array();
		}
		// Maintenance Status
		$fileConfig = array();
		$cfg_path = RwsConstant::FILE_MAINTENANCE_WEB;
		if (file_exists($cfg_path)) {
			if (preg_match_all('/^(?!#)(.+)=(.*)$/m', file_get_contents($cfg_path), $cfg)) {
				$cfg = array_combine($cfg[1], $cfg[2]);
				foreach($cfg as $name => $val){
					$fileConfig[$name] = $val;
				}
			}
		}
		$maintenance_flag =  isset($fileConfig['maintenance_flag'])? $fileConfig['maintenance_flag']:'0';
		if ($this->params['controller'] !== 'appMaintenance' && $maintenance_flag == 1) {
			return $this->redirect('/app/maintenance');
		}
	}
	
	public function goBack() {
		$last_selected_screen_id = $this->Session->read(RwsConstant::SESSION_LAST_SELECTED_SCREEN_ID);
		$this->Session->write(RwsConstant::SESSION_SELECTED_SCREEN_ID, $last_selected_screen_id);
		//
		$controller_arr = $this->Session->read(RwsConstant::SESSION_ARR_CONTROLLER_KEY);
		array_pop($controller_arr);
		$this->Session->write(RwsConstant::SESSION_ARR_CONTROLLER_KEY, $controller_arr);
		//
		$lastURL = $this->Session->read(RwsConstant::SESSION_LAST_URL_KEY);
		$this->Session->write(RwsConstant::SESSION_CURR_URL_KEY, $lastURL);
		if (empty($lastURL)) {
			$this->redirect($this->referer());
		}
		$this->redirect($lastURL);
	}
	
	public function setSessionSelectedSite() {
		$this->layout = 'ajax';
		$this->autoRender = false;
		
		$screen_id = $this->request->data['screen_id'];
		
		$cur_screen_id = $this->Session->read(RwsConstant::SESSION_SELECTED_SCREEN_ID);
		$this->Session->write(RwsConstant::SESSION_SELECTED_SCREEN_ID, $screen_id);
		$this->Session->write(RwsConstant::SESSION_LAST_SELECTED_SCREEN_ID, $cur_screen_id);
		
		$res['success'] = true;
		echo json_encode($res);
	}
	
	protected function ajaxAction() {
		$this->layout = 'ajax';
		$this->autoRender = false;
	}
	
	protected function applyLanguage() {
		$this->messages = Message::$messageList[$this->language];
		$this->scrFieldLabels = ScreenFieldLabels::$messageList[$this->language];
	}
	
	protected function getLanguageFromContry($contryCode) {
		switch ($contryCode){
			case "VN" :
				return RwsConstant::LANGUAGE_VN; 
			case "US":
				return RwsConstant::LANGUAGE_EN;
			case "JA":
				return RwsConstant::LANGUAGE_JA;
			default:
				return RwsConstant::LANGUAGE_VN;
		}
	}

	protected function getContryFromLanguage($languageCode) {
		switch ($languageCode){
			case RwsConstant::LANGUAGE_VN :
				return 'VN';
			case RwsConstant::LANGUAGE_EN:
				return 'US';
			case RwsConstant::LANGUAGE_JA:
				return "JA";
			default:
				return "VN";
		}
	}

	protected function getCheckLanguage($languageCode) {
		switch ($languageCode){
			case RwsConstant::LANGUAGE_VN :
				return true;
			case RwsConstant::LANGUAGE_EN:
				return true;
			case RwsConstant::LANGUAGE_JA:
				return true;
			default:
				return false;
		}
	}
	
	public function getSetLanguageBegin($user_ip) {
		if(isset($user_ip)){
			$details = json_decode($this->getContentUrlTimeOut('http://freegeoip.net/json/'.$user_ip));
			if(isset($details->country_code)){
				$languageCountry = $details->country_code;
			} 
			else{
				$details = @unserialize($this->getContentUrlTimeOut('http://ip-api.com/php/'.$user_ip));
				if($details && $details['status'] == 'success') {
					$languageCountry = $details['countryCode'];
				}
			}
			
			if(isset($languageCountry)){
				$languageName = $this->getLanguageFromContry($languageCountry);
				if($languageName != $this->language){
					$this->language = $languageName;
					$this->Cookie->write(RwsConstant::COOKIE_KEY_LANGUAGE, $this->language);
					return true;
				}
			} 
		}
		return false;
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
