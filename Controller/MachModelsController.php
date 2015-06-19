<?php
App::uses('AppController', 'Controller');
/**
 * MachModels Controller
 *
 * @property MachModel $MachModel
 * @property PaginatorComponent $Paginator
 */
class MachModelsController extends AppController {

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
		$this->MachModel->recursive = 0;
		$this->set('machModels', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MachModel->exists($id)) {
			throw new NotFoundException(__('Invalid mach model'));
		}
		$options = array('conditions' => array('MachModel.' . $this->MachModel->primaryKey => $id));
		$this->set('machModel', $this->MachModel->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MachModel->create();
			if ($this->MachModel->save($this->request->data)) {
				$this->Session->setFlash(__('The mach model has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mach model could not be saved. Please, try again.'));
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
		if (!$this->MachModel->exists($id)) {
			throw new NotFoundException(__('Invalid mach model'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MachModel->save($this->request->data)) {
				$this->Session->setFlash(__('The mach model has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mach model could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MachModel.' . $this->MachModel->primaryKey => $id));
			$this->request->data = $this->MachModel->find('first', $options);
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
		$this->MachModel->id = $id;
		if (!$this->MachModel->exists()) {
			throw new NotFoundException(__('Invalid mach model'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MachModel->delete()) {
			$this->Session->setFlash(__('The mach model has been deleted.'));
		} else {
			$this->Session->setFlash(__('The mach model could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
