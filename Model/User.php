<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 * @property WorkTime $WorkTime
 * @property Task $Task
 */
class User extends AppModel {
	
	public $virtualFields = array(
			'name' => "CONCAT(User.first_name,' ',User.last_name)"
	);
	public $displayField = 'name';
		
	public $order = array('User.name' => 'asc');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'role_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'You must select a job function.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'You must supply your first name.'
			)	
		),
		'last_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'You must supply your last name.'
			)
		),			
		'username' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'You must supply your email.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'email' => array(
				'rule' => array('email', true),
				'message' => 'You must provide a valid email.'
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'That email is already registered.'
			)
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please provide a password.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'confirm_password' => array(
			'confirm' => array(
				'rule' => array('validate_password'),
				'message' => 'Please confirm your password.'			
			)
		),
		'current_password' => array(
			'current_password' => array(
				'rule' => array('match_current'),
				'message' => 'You must match your current password.'
			)
		)
	);
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new SimplePasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
					$this->data[$this->alias]['password']
			);
		}
		return true;
	}
	
	public function match_current() {
		$this->id = AuthComponent::user('id');
		$password = $this->field('password');
		$passwordHasher = new SimplePasswordHasher();
		if ($passwordHasher->hash($this->data['User']['current_password']) == $password) {
			return true;
		}
		return false;
	}
	
	public function validate_password() {
		if ($this->data['User']['password'] !== $this->data['User']['confirm_password']) {
			return false;
		}
		return true;
	}


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'WorkTime' => array(
			'className' => 'WorkTime',
			'foreignKey' => 'user_id',
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
		'Task' => array(
			'className' => 'Task',
			'joinTable' => 'tasks_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'task_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);
	
	public $belongsTo = array(
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
