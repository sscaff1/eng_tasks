<?php
App::uses('AppController', 'Controller');
/**
 * WorkTimes Controller
 *
 * @property WorkTime $WorkTime
 * @property PaginatorComponent $Paginator
 */
class WorkTimesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
	public function job_on($task_id) {
		$this->response->disableCache();
		$this->WorkTime->create();
		$this->WorkTime->Task->save(array('id' => $task_id, 'status_id' => '2'));
		$this->request->data['WorkTime']['task_id'] = $task_id;
		$this->request->data['WorkTime']['user_id'] = $this->Auth->user('id');
		$this->request->data['WorkTime']['start_time'] = date('Y-m-d H:i:s', time());
		if ($this->WorkTime->save($this->request->data)) {
			$this->Session->setFlash(__('You\'ve Jobbed On'));
			return $this->redirect($this->referer());
		} else {
			$this->Session->setFlash(__('The work time could not be saved. Please, try again.'));
		}
	}
	
	public function job_off($task_id) {
		$this->response->disableCache();
		$worktime = $this->WorkTime->find('first',
			array(
				'conditions' => array('WorkTime.end_time IS NULL',
					'WorkTime.task_id' => $task_id,
					'WorkTime.user_id' => $this->Auth->user('id')),
				'fields' => 'id'
		));
		$this->request->data['WorkTime']['id'] = $worktime['WorkTime']['id'];
		$this->request->data['WorkTime']['end_time'] = date('Y-m-d H:i:s', time());
		if ($this->WorkTime->save($this->request->data)) {
			$this->Session->setFlash(__('You\'ve Jobbed Off'));
			return $this->redirect(array('controller' => 'tasks', 'action' => 'my_tasks'));
		}		
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->WorkTime->recursive = 0;
		$this->set('workTimes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->WorkTime->exists($id)) {
			throw new NotFoundException(__('Invalid work time'));
		}
		$options = array('conditions' => array('WorkTime.' . $this->WorkTime->primaryKey => $id));
		$this->set('workTime', $this->WorkTime->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->WorkTime->create();
			if ($this->WorkTime->save($this->request->data)) {
				$this->Session->setFlash(__('The work time has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The work time could not be saved. Please, try again.'));
			}
		}
		$tasks = $this->WorkTime->Task->find('list');
		$users = $this->WorkTime->User->find('list');
		$this->set(compact('tasks', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->WorkTime->exists($id)) {
			throw new NotFoundException(__('Invalid work time'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['WorkTime']['start_time'] = date('Y-m-d H:i:s', strtotime($this->request->data['WorkTime']['start_time']));
			$this->request->data['WorkTime']['end_time'] = date('Y-m-d H:i:s', strtotime($this->request->data['WorkTime']['end_time']));
			if ($this->WorkTime->save($this->request->data)) {
				$this->Session->setFlash(__('The work time has been saved.'));
				$task_id = $this->WorkTime->read(null,$id);
				return $this->redirect(array('controller' => 'tasks', 'action' => 'view', 
						$task_id['WorkTime']['task_id']));
			} else {
				$this->Session->setFlash(__('The work time could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('WorkTime.' . $this->WorkTime->primaryKey => $id));
			$this->request->data = $this->WorkTime->find('first', $options);
		}
		$tasks = $this->WorkTime->Task->find('list');
		$users = $this->WorkTime->User->find('list');
		$this->set(compact('tasks', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->WorkTime->id = $id;
		if (!$this->WorkTime->exists()) {
			throw new NotFoundException(__('Invalid work time'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->WorkTime->delete()) {
			$this->Session->setFlash(__('The work time has been deleted.'));
		} else {
			$this->Session->setFlash(__('The work time could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
