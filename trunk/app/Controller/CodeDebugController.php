<?php
App::uses('AppController', 'Controller');

/**
 * GetRssNewsController
 */
class CodeDebugController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array(
		'TRssNews',
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
		date_default_timezone_set("Asia/Bangkok");
		$this->title = $this->scrFieldLabels['SCR_MENU_GET_RSS_NEWS'];
		$this->link = '/search';
		$this->urlHistories = array($this->scrFieldLabels['SCR_MENU_HOME'], $this->link);
		//$this->deleteDuplicateNews();
		require_once 'GetRssNewsController.php';
		$getRssNews = new GetRssNewsController ();
		$getRssNews->updateAllNews();
		$this->set('page',"Updated");
		return $this->render('/Actions/getRssNews', 'admin');
	}
	
	//For admin get all rss one time
	function deleteDuplicateNews(){
    	try{
    		$rssNewsUpdated = array();
    		$this->TNews->begin();
                $newsOldList = $this->TNews->find('all', array(
    		'fields' => array('LINK','ID'),
                'conditions' => array('DELETE_YMD IS NULL','ID > 39000'),
		'limit' => 1000,
                'order' =>array('PUB_DATE'=>'desc')
    		));
        	for ($i = 0 ; $i < sizeof($newsOldList); $i++) {
        		$newLink = $newsOldList[$i]['TNews']['LINK'];
        		for($j = $i+1 ; $j < sizeof($newsOldList); $j++){
					if($newLink == $newsOldList[$j]['TNews']['LINK']){
						//Delete link new
						$this->setUpdateDeleteYmdNews($newsOldList[$i]['TNews']['ID']);
						$rssNewsUpdated[] = $newLink;
					}
        		}
        	}
        	
        	$this->set('rssNewsUpdated',$rssNewsUpdated);
        	$this->TNews->commit();
      }
    	catch (Exception $e) {
    		$this->TNews->rollback();
			$this->errors = array("Error13:" . $e->getMessage());
			return $this->render('/');
		}
        return false;
    }
    
/**
     * updateTimeRssNews
     */
    public function setUpdateDeleteYmdNews($id){
        // The Regular Expression filter
    	try{
	        $this->TNews->updateAll(
				array(
					'DELETE_YMD' => "NOW()"
				),
				array('ID' => $id)
			);
	    } 
    	catch (Exception $e) {
    		$this->TNews->rollback();
			$this->errors = array("Error setUpdateDeleteYmdNews:" . $e->getMessage());
			return $this->render('/Actions/getRssNews', 'admin');
		}
        return false;
    }
}