<?php
App::uses('AppController', 'Controller');
/**
 * Tasks Controller
 *
 * @property Task $Task
 * @property PaginatorComponent $Paginator
 */
class TasksController extends AppController {

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
		$this->response->disableCache();
		$this->Task->contain(array('User.id','User.name','TaskType','Status', 'MachModel', 'MachConfig', 'Issue',
				'WorkTime' => array(
					'conditions' => array('WorkTime.end_time' => '')
		)));
		$logged = $this->Task->WorkTime->find('all', array(
			'fields' => array('WorkTime.task_id', 'SUM(TIMESTAMPDIFF(SECOND, WorkTime.start_time,WorkTime.end_time))/3600 as logged_time'),
				'conditions' => array('WorkTime.end_time IS NOT NULL'),
				'group' => 'WorkTime.task_id'
		));
		$tot_log = array();
		foreach ($logged as $i) {
			$tot_log[$i['WorkTime']['task_id']] = $i[0]['logged_time'];
		}
		$this->Task->recursive = 0;
		$this->set('tasks', $this->Paginator->paginate('Task', null, 
				array('complete_date', 'due_date', 'active')));
		$this->set(compact('tot_log'));
	}
	
	public function my_tasks() {
		$this->response->disableCache();
		$this->Task->contain(array('User.id','User.name','TaskType','Status', 'MachModel', 'MachConfig',
				'WorkTime' => array(
					'conditions' => array('WorkTime.end_time' => '', 'WorkTime.user_id' => $this->Auth->user('id'))
		)));
		$this->Task->recursive = 0;
		$this->Paginator->settings = array(
			'conditions' => array('TasksUser.user_id' => $this->Auth->user('id'), 'Task.complete_date IS NULL', 'Task.active' => 2),
			'joins' => array(
				array('table' => 'tasks_users',
					'alias' => 'TasksUser',
					'type' => 'inner',
					'conditions' => array(
						'Task.id = TasksUser.task_id'
				))
			)
		);
		$logged = $this->Task->WorkTime->find('all', array(
				'fields' => array('WorkTime.task_id', 'SUM(TIMESTAMPDIFF(SECOND, WorkTime.start_time,WorkTime.end_time))/3600 as logged_time'),
				'conditions' => array('WorkTime.end_time IS NOT NULL', 'WorkTime.user_id' => $this->Auth->user('id')),
				'group' => 'WorkTime.task_id'
		));
		$tot_log = array();
		foreach ($logged as $i) {
			$tot_log[$i['WorkTime']['task_id']] = $i[0]['logged_time'];
		}
		$this->set(compact('tot_log'));
		$this->set('tasks', $this->Paginator->paginate());
		$task_names = $this->Task->find('list', 
				array('conditions' => array('TasksUser.user_id' => $this->Auth->user('id'),
					 	'Task.complete_date IS NULL', 'Task.active' => 2),
				'joins' => array(
					array('table' => 'tasks_users',
						'alias' => 'TasksUser',
						'type' => 'inner',
						'conditions' => array(
							'Task.id = TasksUser.task_id'
				)))));
		$this->set(compact('task_names'));
		if ($this->request->is('post')) {
			$this->Task->WorkTime->create();
			$data = $this->request->data['WorkTime'];
			$this->request->data = array();
			$data['hours'] = $data['hours']*60;
			$data['end_time'] = strtotime($data['start_time'].' +'.$data['hours'].' minutes');
			$data['start_time'] = strtotime($data['start_time']);
			$this->request->data['WorkTime']['user_id'] = $this->Auth->user('id');
			$this->request->data['WorkTime']['task_id'] = $data['task_id'];
			$this->request->data['WorkTime']['start_time'] = date('Y-m-d H:i:s',$data['start_time']);
			$this->request->data['WorkTime']['end_time'] = date('Y-m-d H:i:s',$data['end_time']);
			if ($this->Task->WorkTime->save($this->request->data)) {
				$this->Session->setFlash(__('The time has been added to the task.'));
				return $this->redirect(array('action' => 'my_tasks'));
			} else {
				$this->Session->setFlash(__('The time could not be added. Please, try again.'));
			}
		}
	}
	
	public function searchTasks() {
		$this->Task->contain(array('User.id','User.name','TaskType','Status', 'MachModel', 'MachConfig',
				'WorkTime' => array(
						'conditions' => array('WorkTime.end_time' => '', 'WorkTime.user_id' => $this->Auth->user('id'))
				)));
		$this->Task->recursive = 0;
		$search = $this->request->data['partialTask'];
		$this->Paginator->settings = array(
				'conditions' => array('TasksUser.user_id' => $this->Auth->user('id'), 'Task.complete_date IS NULL', 
						'Task.active' => 2, 'Task.name LIKE' => '%'.$search.'%'),
				'joins' => array(
						array('table' => 'tasks_users',
								'alias' => 'TasksUser',
								'type' => 'inner',
								'conditions' => array(
										'Task.id = TasksUser.task_id'
								))
				)
		);
		$logged = $this->Task->WorkTime->find('all', array(
				'fields' => array('WorkTime.task_id', 'SUM(TIMESTAMPDIFF(SECOND, WorkTime.start_time,WorkTime.end_time))/3600 as logged_time'),
				'conditions' => array('WorkTime.end_time IS NOT NULL', 'WorkTime.user_id' => $this->Auth->user('id')),
				'group' => 'WorkTime.task_id'
		));
		$tot_log = array();
		foreach ($logged as $i) {
			$tot_log[$i['WorkTime']['task_id']] = $i[0]['logged_time'];
		}
		$this->set(compact('tot_log'));
		$this->set('tasks', $this->Paginator->paginate());
		$this->layout = 'ajax';
		$this->render('/Elements/taskTable');
	}
	
	public function searchAllTasks() {
		$this->Task->recursive = 0;
		$search = $this->request->data['partialTask'];
		$this->Paginator->settings = array(
				'conditions' => array('Task.complete_date IS NULL', 
						'Task.name LIKE' => '%'.$search.'%')
		);
		$logged = $this->Task->WorkTime->find('all', array(
				'fields' => array('WorkTime.task_id', 'SUM(TIMESTAMPDIFF(SECOND, WorkTime.start_time,WorkTime.end_time))/3600 as logged_time'),
				'conditions' => array('WorkTime.end_time IS NOT NULL'),
				'group' => 'WorkTime.task_id'
		));
		$tot_log = array();
		foreach ($logged as $i) {
			$tot_log[$i['WorkTime']['task_id']] = $i[0]['logged_time'];
		}
		$this->set(compact('tot_log'));
		$this->set('tasks', $this->Paginator->paginate());
		$this->layout = 'ajax';
		$this->render('/Elements/taskAllTable');
	}
	
	public function all_my_tasks() {
		$this->response->disableCache();
		$this->Task->contain(array('User.id','User.name','TaskType','Status', 'MachModel', 'MachConfig',
				'WorkTime' => array(
						'conditions' => array('WorkTime.end_time' => '', 'WorkTime.user_id' => $this->Auth->user('id'))
				)));
		$this->Task->recursive = 0;
		$this->Paginator->settings = array(
				'conditions' => array('TasksUser.user_id' => $this->Auth->user('id')),
				'joins' => array(
						array('table' => 'tasks_users',
								'alias' => 'TasksUser',
								'type' => 'inner',
								'conditions' => array(
										'Task.id = TasksUser.task_id'
								))
				)
		);
		$logged = $this->Task->WorkTime->find('all', array(
				'fields' => array('WorkTime.task_id', 'SUM(TIMESTAMPDIFF(SECOND, WorkTime.start_time,WorkTime.end_time))/3600 as logged_time'),
				'conditions' => array('WorkTime.end_time IS NOT NULL', 'WorkTime.user_id' => $this->Auth->user('id')),
				'group' => 'WorkTime.task_id'
		));
		$tot_log = array();
		foreach ($logged as $i) {
			$tot_log[$i['WorkTime']['task_id']] = $i[0]['logged_time'];
		}
		$this->set(compact('tot_log'));
		$this->set('tasks', $this->Paginator->paginate());
	}
	
	public function complete($task_id) {
		$worktime = $this->Task->WorkTime->find('first', array(
				'conditions' => array('WorkTime.task_id' => $task_id,
						'WorkTime.user_id' => $this->Auth->user('id'),
						'WorkTime.end_time' => '')
		));
		$this->request->data['Task']['id'] = $task_id;
		$this->request->data['Task']['complete_date'] = date('Y-m-d h:iA', time());
		$this->request->data['Task']['status_id'] = 3;
		$this->Task->WorkTime->save(array('id' => $worktime['WorkTime']['id'], 'end_time' => date('Y-m-d H:i:s', time())));
		if ($this->Task->save($this->request->data)) {			
			$this->Session->setFlash(__('You\'ve Jobbed Off & Completed this task.'));
			return $this->redirect(array('action' => 'my_tasks'));
		}
	}
	
	public function export_csv() {
		print_r($this->request->data);
		$this->render(false);
		$this->autoRender = false;
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Task->contain(array('WorkTime' => array('User' => array('fields' => array('User.id', 'User.name'))), 'User.id', 'User.name',
				'MachModel.name', 'MachConfig.name','TaskType.name','Status.name', 'Issue' => array('IssueType' => array('name'))));
		if (!$this->Task->exists($id)) {
			throw new NotFoundException(__('Invalid task'));
		}
		$options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
		$report = $this->Task->WorkTime->find('all', 
			array('contain' => array('User' => array('Role.name')),
			'conditions' => array('WorkTime.end_time IS NOT NULL', 'WorkTime.task_id' => $id),
			'fields' => array('WorkTime.task_id', 
					'SUM(TIMESTAMPDIFF(SECOND, WorkTime.start_time,WorkTime.end_time))/3600 as logged_time',
					'CONCAT(User.first_name," ",User.last_name) as name', 'User.role_id'),
			'group' => array('WorkTime.task_id', 'name', 'User.role_id', 'User.id'),
			'order' => array('SUM(TIMESTAMPDIFF(SECOND, WorkTime.start_time,WorkTime.end_time))/3600 DESC')));
		$this->set('my_workTimes', $this->Task->WorkTime->find('all',
			array('conditions' => 
				array('WorkTime.user_id' => $this->Auth->user('id'),'WorkTime.task_id' => $id),
				'fields' => array('WorkTime.id', 'WorkTime.start_time', 'WorkTime.end_time'),
				'order' => array('WorkTime.end_time DESC'))));
		$this->set('task', $this->Task->find('first', $options));
		$this->set(compact('report'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Task->create();
			$this->request->data['Task']['status_id'] = 1;
			$this->request->data['Task']['description'] = 
					$this->Auth->user('name').' ('.date('m/d/Y h:iA', time()).'): '.$this->request->data['Task']['description'];
			if ($this->Task->save($this->request->data)) {
				$this->Session->setFlash(__('The task has been saved.'));
				return $this->redirect(array('action' => 'my_tasks'));
			} else {
				$this->Session->setFlash(__('The task could not be saved. Please, try again.'));
			}
		}
		$taskTypes = $this->Task->TaskType->find('list');
		$statuses = $this->Task->Status->find('list');
		$users = $this->Task->User->find('list');
		$machModels = $this->Task->MachModel->find('list');
		$machConfigs = $this->Task->MachConfig->find('list');
		$this->set(compact('taskTypes', 'statuses', 'users','machModels','machConfigs'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Task->exists($id)) {
			throw new NotFoundException(__('Invalid task'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$description = $this->Task->read(null, $id);
			$description = $description['Task']['description'];
			$this->request->data['Task']['description'] =
				$this->Auth->user('name').' ('.date('m/d/Y h:iA', time()).'): '.
				$this->request->data['Task']['description']."<br />".$description;
			if ($this->request->data['Task']['status_id'] != 3) {
				$this->request->data['Task']['complete_date'] = null;
			}
			if ($this->Task->save($this->request->data)) {
				$this->Session->setFlash(__('The task has been saved.'));
				return $this->redirect(array('action' => 'my_tasks'));
			} else {
				$this->Session->setFlash(__('The task could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
			$this->request->data = $this->Task->find('first', $options);
			$this->request->data['Task']['due_date'] = date('Y-m-d', strtotime($this->request->data['Task']['due_date']));
		}
		$taskTypes = $this->Task->TaskType->find('list');
		$statuses = $this->Task->Status->find('list');
		$users = $this->Task->User->find('list');
		$machModels = $this->Task->MachModel->find('list');
		$machConfigs = $this->Task->MachConfig->find('list');
		$this->set(compact('taskTypes', 'statuses', 'users', 'machConfigs', 'machModels'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Task->id = $id;
		if (!$this->Task->exists()) {
			throw new NotFoundException(__('Invalid task'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Task->delete()) {
			$this->Session->setFlash(__('The task has been deleted.'));
		} else {
			$this->Session->setFlash(__('The task could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function reports() {
		if ($this->request->is(array('post', 'put'))) {
			if (empty($this->request->data['Task']['start_date'])) {
				$st = '1900-01-01';
			} else {
				$st = $this->request->data['Task']['start_date'];
			}
			if (empty($this->request->data['Task']['end_date'])) {
				$et = '3000-01-01';
			} else {
				$et = $this->request->data['Task']['end_date'];
			}
			$work_times = $this->Task->query('
					SELECT
						CONCAT(users.first_name," ",users.last_name) as name,
						tasks.name as task_name,
						tasks.oracle_proj_num as oracle,
						statuses.name as status_name,
						task_types.name as type_name,
						CAST(tasks.due_date AS DATE) as due_date,
						SUM(TIMESTAMPDIFF(SECOND, work_times.start_time,work_times.end_time))/3600 as logged_time
					FROM
						work_times LEFT JOIN users ON
							work_times.user_id = users.id
					
						LEFT JOIN tasks ON
							work_times.task_id = tasks.id
					
						LEFT JOIN statuses ON
							tasks.status_id = statuses.id 
						
						LEFT JOIN task_types ON
							tasks.task_type_id = task_types.id
					
					WHERE
						CAST(work_times.start_time as DATE) >= "'.$st.'" AND
						CAST(work_times.start_time as DATE) <= "'.$et.'"
					GROUP BY	
						CONCAT(users.first_name," ",users.last_name),
						tasks.name,
						tasks.oracle_proj_num,
						statuses.name,
						task_types.name,
						CAST(tasks.due_date AS DATE)
					ORDER BY
						CONCAT(users.first_name,users.last_name) ASC,
						tasks.complete_date ASC,
						tasks.due_date ASC,
						task_types.name,
						tasks.oracle_proj_num,
						tasks.name ASC,
						tasks.active DESC
					');
			foreach ($work_times as $n) {
				$names[] = $n['0']['name'];
			}
			$names = array_count_values($names);
			$this->set(compact('work_times','names'));
		}
	}
	
	public function my_reports() {
		if ($this->request->is(array('post', 'put'))) {
			if (empty($this->request->data['Task']['start_date'])) {
				$st = '1900-01-01';
			} else {
				$st = $this->request->data['Task']['start_date'];
			}
			if (empty($this->request->data['Task']['end_date'])) {
				$et = '3000-01-01';
			} else {
				$et = $this->request->data['Task']['end_date'];
			}
			$work_times = $this->Task->query('
					SELECT
						CAST(work_times.start_time as DATE) as start_date,
						tasks.name as task_name,
						tasks.oracle_proj_num as oracle,
						statuses.name as status_name,
						task_types.name as type_name,
						CAST(tasks.due_date AS DATE) as due_date,
						SUM(TIMESTAMPDIFF(SECOND, work_times.start_time,work_times.end_time))/3600 as logged_time
					FROM
						work_times INNER JOIN users ON
							work_times.user_id = '.$this->Auth->user('id').' and
							users.id = '.$this->Auth->user('id').' and
							users.id = work_times.user_id
			
						LEFT JOIN tasks ON
							work_times.task_id = tasks.id and
							work_times.user_id = '.$this->Auth->user('id').'
			
						LEFT JOIN statuses ON
							tasks.status_id = statuses.id
	
						LEFT JOIN task_types ON
							tasks.task_type_id = task_types.id
			
					WHERE
						CAST(work_times.start_time as DATE) >= "'.$st.'" AND
						CAST(work_times.start_time as DATE) <= "'.$et.'"
					GROUP BY
						CAST(work_times.start_time as DATE),
						tasks.name,
						tasks.oracle_proj_num,
						statuses.name,
						task_types.name,
						CAST(tasks.due_date AS DATE)
					ORDER BY
						CAST(work_times.start_time as DATE) ASC,
						tasks.complete_date ASC,
						tasks.due_date ASC,
						task_types.name,
						tasks.oracle_proj_num,
						tasks.name ASC,
						tasks.active DESC
					');
			$work_times_d = $this->Task->query('
					SELECT
						CAST(work_times.start_time as DATE) as start_date,
						SUM(TIMESTAMPDIFF(SECOND, work_times.start_time,work_times.end_time))/3600 as logged_time
					FROM
						work_times INNER JOIN users ON
							work_times.user_id = '.$this->Auth->user('id').' and
							users.id = '.$this->Auth->user('id').' and
							users.id = work_times.user_id 		
					WHERE
						CAST(work_times.start_time as DATE) >= "'.$st.'" AND
						CAST(work_times.start_time as DATE) <= "'.$et.'"
					GROUP BY
						CAST(work_times.start_time as DATE)
					ORDER BY
						CAST(work_times.start_time as DATE) ASC
					');
			$this->set(compact('work_times','work_times_d'));
		}
	}
}
