<?php
App::uses('AppController', 'Controller');
/**
 * MachConfigs Controller
 *
 * @property MachConfig $MachConfig
 * @property PaginatorComponent $Paginator
 */
class MachConfigsController extends AppController {

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
		$this->MachConfig->recursive = 0;
		$this->set('machConfigs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MachConfig->exists($id)) {
			throw new NotFoundException(__('Invalid mach config'));
		}
		$options = array('conditions' => array('MachConfig.' . $this->MachConfig->primaryKey => $id));
		$this->set('machConfig', $this->MachConfig->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MachConfig->create();
			if ($this->MachConfig->save($this->request->data)) {
				$this->Session->setFlash(__('The mach config has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mach config could not be saved. Please, try again.'));
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
		if (!$this->MachConfig->exists($id)) {
			throw new NotFoundException(__('Invalid mach config'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MachConfig->save($this->request->data)) {
				$this->Session->setFlash(__('The mach config has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mach config could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MachConfig.' . $this->MachConfig->primaryKey => $id));
			$this->request->data = $this->MachConfig->find('first', $options);
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
		$this->MachConfig->id = $id;
		if (!$this->MachConfig->exists()) {
			throw new NotFoundException(__('Invalid mach config'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MachConfig->delete()) {
			$this->Session->setFlash(__('The mach config has been deleted.'));
		} else {
			$this->Session->setFlash(__('The mach config could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
