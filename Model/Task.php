<?php
App::uses('AppModel', 'Model');
/**
 * Task Model
 *
 * @property MachConfig $MachConfig
 * @property MachModel $MachModel
 * @property TaskType $TaskType
 * @property Status $Status
 * @property WorkTime $WorkTime
 * @property User $User
 */
class Task extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	
	public $order = array('Task.complete_date' => 'ASC', 'Task.due_date' => 'ASC', 'Task.active' => 'DESC');
	
	public $validate = array(
		'task_type_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'You must select a task type.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'You must assign a name to your task.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'active' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'You must select whether or not this task is active.'
			)
		),
		'due_date' => array(
			'date' => array(
				'rule' => 'date',
				'message' => 'Please enter a valid date.'		
			)
		),
		'estimate' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Please enter a time estimate for the task.'			
			)
		),
		'com_id_num' => array(
			'naturalNumber' => array(
				'rule' => 'naturalNumber',
				'message' => 'Please supply a valid customer order ID number.',
				'allowEmpty' => true
			)
		),
		'par_id_num' => array(
			'naturalNumber' => array(
				'rule' => 'naturalNumber',
				'message' => 'Please supply a valid PAR ID number.',
				'allowEmpty' => true
			)
		),
		'msr_id_num' => array(
			'naturalNumber' => array(
				'rule' => 'naturalNumber',
				'message' => 'Please supply a valid MSR ID number.',
				'allowEmpty' => true
			)
		)
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'MachConfig' => array(
			'className' => 'MachConfig',
			'foreignKey' => 'mach_config_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MachModel' => array(
			'className' => 'MachModel',
			'foreignKey' => 'mach_model_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TaskType' => array(
			'className' => 'TaskType',
			'foreignKey' => 'task_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Status' => array(
			'className' => 'Status',
			'foreignKey' => 'status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'WorkTime' => array(
			'className' => 'WorkTime',
			'foreignKey' => 'task_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Issue' => array(
			'className' => 'Issue',
			'foreignKey' => 'task_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'tasks_users',
			'foreignKey' => 'task_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
