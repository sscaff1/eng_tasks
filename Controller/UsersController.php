<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	
	
	public $components = array('Paginator');
	
	public function beforeFilter() {
		parent::beforeFilter();
		// Allow users to register and logout.
		$this->Auth->allow('register', 'logout', 'login');
		$temp = $this->User->query('
				SELECT
					tasks_users.user_id,
					COUNT(DISTINCT tasks_users.task_id) as count
				FROM
					tasks LEFT JOIN	tasks_users ON
					tasks.id = tasks_users.task_id
				WHERE
					tasks.active = 2 and
					tasks.status_id !=  3
				GROUP BY
					tasks_users.user_id
				');
		$active_tasks = array();
		foreach ($temp as $i) {
			$active_tasks[$i['tasks_users']['user_id']] = $i['0']['count'];
		}
		$temp = $this->User->query('
				SELECT
					tasks_users.user_id,
					COUNT(DISTINCT tasks_users.task_id) as count
				FROM
					tasks LEFT JOIN	tasks_users ON
					tasks.id = tasks_users.task_id
				WHERE
					tasks.status_id =  3
				GROUP BY
					tasks_users.user_id
				');
		$complete_tasks = array();
		foreach ($temp as $i) {
			$complete_tasks[$i['tasks_users']['user_id']] = $i['0']['count'];
		}
		$this->set(compact('complete_tasks', 'active_tasks'));
	}
	
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			}
			$this->request->data['User']['password'] = '';
			$this->Session->setFlash(__('Invalid username or password. Try again.'));
		}
	}
	
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}
	
	public function searchUsers() {
		$search = $this->request->data['partialUser'];
		$this->Paginator->settings = array(
			'conditions' => array('User.name LIKE' => '%'.$search.'%')
		);
		$this->set('users', $this->Paginator->paginate());
		$this->layout = 'ajax';
		$this->render('/Elements/usersIndex');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->contain(array('Role', 'WorkTime' => 
				array('id', 'start_time', 'end_time', 'Task.id', 'Task.name'), 'Task' => 
				array('MachModel.name', 'MachConfig.name', 'TaskType.name', 'Status.name',
					'order' => array('Task.complete_date' => 'ASC', 'Task.due_date' => 'ASC', 'Task.active' => 'DESC')
		)));
		$report = $this->User->WorkTime->find('all', 
			array('contain' => array('Task' => array('TaskType.name')),
			'conditions' => array('WorkTime.end_time IS NOT NULL', 'WorkTime.user_id' => $id),
			'fields' => array('WorkTime.task_id', 'Task.estimate',
					'SUM(TIMESTAMPDIFF(SECOND, WorkTime.start_time,WorkTime.end_time))/3600 as logged_time', 
					'Task.name', 'Task.task_type_id'),
			'group' => array('WorkTime.task_id', 'Task.name', 'Task.id', 'Task.task_type_id', 'Task.estimate'),
			'order' => array('SUM(TIMESTAMPDIFF(SECOND, WorkTime.start_time,WorkTime.end_time))/3600 DESC')));
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
		$this->set(compact('report'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['active'] = 1;
			$this->request->data['User']['password'] = 'task123';
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('This user has been added. Please login to begin using the application.'));
				return $this->redirect(array('controller' => 'users', 'action' => 'add'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$this->set('roles', $this->User->Role->find('list'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	
	public function edit_profile() {
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('You\'ve successfully updated your profile.'));
				return $this->redirect(array('controller' => 'tasks', 'action' => 'my_tasks'));
			} else {
				$this->Session->setFlash(__('You\'re profile was not saved. Please try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $this->Auth->user('id')));
			$this->request->data = $this->User->find('first', $options);
		}
		if ($this->Auth->user('role_id') != 1) {
			$conditions = array('conditions' => array('Role.name !=' => 'Administrator'));
		} else {
			$conditions = array();
		}
		$this->set('roles',$this->User->Role->find('list', $conditions));
	}
	
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$tasks = $this->User->Task->find('list');
		$this->set(compact('tasks'));
	}
	
	public function change_password() {
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('You\'ve successfully changed your password.'));
				return $this->redirect(array('controller' => 'tasks', 'action' => 'my_tasks'));
			} else {
				$this->Session->setFlash(__('Please try to change you\'re password again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $this->Auth->user('id')));
			$this->request->data = $this->User->find('first', $options);
			$this->request->data['User']['password'] = '';
		}
	}
	
	public function register() {
		if ($this->request->is('post')) {
			$this->request->data['User']['active'] = 1;
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('You\'ve registered and have been logged in'));
				$id = $this->User->id;
				$this->request->data['User'] = array_merge(
						$this->request->data['User'],
						array('id' => $id)
				);
				$this->Auth->login($this->request->data['User']);
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$this->set('roles', $this->User->Role->find('list', array('conditions' => array('Role.name !=' => 'Administrator'))));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
