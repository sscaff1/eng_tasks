<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

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
	public $components = array(
			'Session',
			'Auth' => array(
					'loginRedirect' => array(
							'controller' => 'tasks',
							'action' => 'my_tasks'
					),
					'logoutRedirect' => array(
							'controller' => 'pages',
							'action' => 'display',
							'home'
					),
					'authorize' => array('Controller') // Added this line
			)
	);
	
	public function isAuthorized($user) {
		// Admin can access every action
		if (isset($user['role_id']) && $user['role_id'] === 1) {
			return true;
		}
	
		// Default deny
		return true;
	}
	public function beforeFilter() {
		$this->Auth->deny();
		$this->set('logged_in', $this->Auth->loggedIn());
		$this->set('current_user', $this->Auth->user());
	}
	
	public function beforeRender() {
		$this->response->disableCache();
	}
}
