<?php
App::uses('AppController', 'Controller');
/**
 * Issues Controller
 *
 * @property Issue $Issue
 * @property PaginatorComponent $Paginator
 */
class IssuesController extends AppController {

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
		$this->Issue->recursive = 0;
		$this->set('issues', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Issue->exists($id)) {
			throw new NotFoundException(__('Invalid issue'));
		}
		$options = array('conditions' => array('Issue.' . $this->Issue->primaryKey => $id));
		$this->set('issue', $this->Issue->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($task_id) {
		if ($this->request->is('post')) {
			$n = $this->Issue->find('count', 
					array('conditions' => array('Issue.task_id' => $task_id)));
			$n = $n+1;
			$this->Issue->create();
			$this->request->data['Issue']['name'] = $task_name.' Issue #'.$n;
			$this->request->data['Issue']['task_id'] = $task_id;
			if ($this->Issue->save($this->request->data)) {
				$this->Session->setFlash(__('The issue has been saved.'));
				return $this->redirect(array('controller' => 'tasks', 'action' => 'my_tasks'));
			} else {
				$this->Session->setFlash(__('The issue could not be saved. Please, try again.'));
			}
		}
		$task_name = $this->Issue->Task->find('first', array('conditions' => array('Task.id' => $task_id), 
				'fields' => array('Task.name'), 'contain' => array()));
		$issueTypes = $this->Issue->IssueType->find('list');
		$this->set(compact('issueTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Issue->exists($id)) {
			throw new NotFoundException(__('Invalid issue'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Issue->save($this->request->data)) {
				$this->Session->setFlash(__('The issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The issue could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Issue.' . $this->Issue->primaryKey => $id));
			$this->request->data = $this->Issue->find('first', $options);
		}
		$tasks = $this->Issue->Task->find('list');
		$issueTypes = $this->Issue->IssueType->find('list');
		$this->set(compact('tasks', 'issueTypes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Issue->id = $id;
		if (!$this->Issue->exists()) {
			throw new NotFoundException(__('Invalid issue'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Issue->delete()) {
			$this->Session->setFlash(__('The issue has been deleted.'));
		} else {
			$this->Session->setFlash(__('The issue could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
