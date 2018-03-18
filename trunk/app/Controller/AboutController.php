<?php
App::uses('AppController', 'Controller');

/**
 * AboutController
 */
class AboutController extends AppController {
	
	public $uses = array(

	);
	
	/**
	 * Displays a view Results
	 */
	public function index() {
		
		$this->title = "Contact for us";
		$this->urlHistories = array('About', $this->title);
		
		return $this->render('/about');
	}
}
