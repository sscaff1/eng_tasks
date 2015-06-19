<?php
App::uses('TasksUser', 'Model');

/**
 * TasksUser Test Case
 *
 */
class TasksUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tasks_user',
		'app.task',
		'app.task_type',
		'app.work_time',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TasksUser = ClassRegistry::init('TasksUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TasksUser);

		parent::tearDown();
	}

}
