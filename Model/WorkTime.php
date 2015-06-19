<?php
App::uses('AppModel', 'Model');
/**
 * WorkTime Model
 *
 * @property Task $Task
 * @property User $User
 */
class WorkTime extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $actsAs = array('Containable');
		
	public $validate = array(
		'task_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please select a task.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'start_time' => array(
			'date' => array(
				'rule' => array('checkFutureDate', 'start_time'),
				'message' => 'You cannot select a date in the future.'
			)
		),
		'hours' => array(
			'numeric' => array(
				'rule' => array('notEmpty'),
				'message' => 'You must select the number of hours to add.'
			)
		)
	);
	
    function checkFutureDate($data, $field){ 
     	if (strtotime($data[$field]) > time()) { 
        	return FALSE; 
        } 
    	return TRUE; 
    }

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Task' => array(
			'className' => 'Task',
			'foreignKey' => 'task_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
