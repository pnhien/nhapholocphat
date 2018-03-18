<?php
App::uses ( 'AppController', 'Controller' );

/**
 * WatchController
 */
class WatchController extends AppController {
	public $uses = array (
			'TVideoSub'
	);
	
	/**
	 * Displays a view Results
	 */
	public function index() {
		require_once 'GetRssNewsController.php';
		$this->title = "Mua bán nhà phố - Tư vấn mua bán nhà";
		$this->urlHistories = array (
				'Home',
				$this->title 
		);
		$data = $this->request->query;
		$videoId = $data['v'];
		$html = file_get_contents( "https://www.youtube.com/watch?v=" . $videoId);
		$reg_title = '/<title>(.+)<\/title>/Uism';
		if(preg_match($reg_title, $html, $preg_title)){
           $this->title = str_replace(" - YouTube", "", $preg_title[1]);
        } 
		$this->set ( 'videoId', $videoId );
		return $this->render ( '/watch' );
	}
}