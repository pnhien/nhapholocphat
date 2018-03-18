<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('', array('controller' => 'results', 'action' => 'index'));
	//Router::connect('/createUser', array('controller' => 'results', 'action' => 'index'));
	Router::connect('/results', array('controller' => 'results', 'action' => 'search'));
	Router::connect('/watch', array('controller' => 'watch', 'action' => 'index'));
	Router::connect('/login', array('controller' => 'login', 'action' => 'init'));
	Router::connect('/edit/user', array('controller' => 'EditUser', 'action' => 'index'));
	Router::connect('/changelang', array('controller' => 'login', 'action' => 'doChangeLanguage'));
	Router::connect('/about', array('controller' => 'about', 'action' => 'index'));
	
	Router::connect('/edit/user', array('controller' => 'editUser', 'action' => 'index'));
	Router::connect('/editnews', array('controller' => 'editNews', 'action' => 'index'));
	Router::connect('/edit/profile', array('controller' => 'userPersonalSetting', 'action' => 'index'));
	
	Router::connect('/action/search', array('controller' => 'search', 'action' => 'index'));
	Router::connect('/namage', array('controller' => 'manage', 'action' => 'index'));
	Router::connect('/manageTemp', array('controller' => 'manageTemp', 'action' => 'index'));
	Router::connect('/youman', array('controller' => 'manageReup', 'action' => 'index'));
	Router::connect('/action/getRssNews', array('controller' => 'getRssNews', 'action' => 'index'));
	Router::connect('/action/codeDebug', array('controller' => 'codeDebug', 'action' => 'index'));
	Router::connect('/action/updateAllNews', array('controller' => 'getRssNews', 'action' => 'updateAllNews'));
	Router::connect('/action/find', array('controller' => 'find', 'action' => 'index'));
	Router::connect('/news', array('controller' => 'news', 'action' => 'index'));
	Router::connect('/newsList', array('controller' => 'newsList', 'action' => 'index'));
	
	Router::connect('/seoTop', array('controller' => 'seoTop', 'action' => 'index'));
	Router::connect('/seoTagYoutube', array('controller' => 'seoTagYoutube', 'action' => 'index'));
	
	Router::connect('/maintenance', array('controller' => 'appMaintenance', 'action' => 'index'));
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
