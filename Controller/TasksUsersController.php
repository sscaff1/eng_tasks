<?php
App::uses('AppController', 'Controller');
/**
 * TasksUsers Controller
 *
 * @property TasksUser $TasksUser
 * @property PaginatorComponent $Paginator
 */
class TasksUsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->TasksUser->recursive = 0;
		$this->set('tasksUsers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TasksUser->exists($id)) {
			throw new NotFoundException(__('Invalid tasks user'));
		}
		$options = array('conditions' => array('TasksUser.' . $this->TasksUser->primaryKey => $id));
		$this->set('tasksUser', $this->TasksUser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TasksUser->create();
			if ($this->TasksUser->save($this->request->data)) {
				$this->Session->setFlash(__('The tasks user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tasks user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TasksUser->exists($id)) {
			throw new NotFoundException(__('Invalid tasks user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TasksUser->save($this->request->data)) {
				$this->Session->setFlash(__('The tasks user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tasks user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TasksUser.' . $this->TasksUser->primaryKey => $id));
			$this->request->data = $this->TasksUser->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->TasksUser->id = $id;
		if (!$this->TasksUser->exists()) {
			throw new NotFoundException(__('Invalid tasks user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->TasksUser->delete()) {
			$this->Session->setFlash(__('The tasks user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The tasks user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
