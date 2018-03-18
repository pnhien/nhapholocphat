<?php
App::uses('AppController', 'Controller');

/**
 * AppMaintenanceController.php
 */
class AppMaintenanceController extends AppController {
	
	/**
	 * This controller does not use a model
	 *
	 * @var array
	 */
	public $uses = array(
			'TUser'
	);
	
	const RENDER_PAGE = '/Maintenance/maintenance';

	/**
	 * Displays a view
	 */
	public function index() {
		try{
			$users = $this->TUser->find('first');
			if($users != null){
				$cfg_path = RwsConstant::FILE_MAINTENANCE_WEB;
				if (file_exists($cfg_path)) {
					file_put_contents($cfg_path, 'maintenance_flag=0');
				}
				return $this->redirect('/user/sitelist');
			}
		} catch (Exception $e) {
			
		}
		return $this->render(self::RENDER_PAGE, '');
	}
	
	
}
