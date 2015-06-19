<?php
App::uses('WorkTime', 'Model');

/**
 * WorkTime Test Case
 *
 */
class WorkTimeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.work_time',
		'app.task',
		'app.task_type',
		'app.user',
		'app.tasks_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->WorkTime = ClassRegistry::init('WorkTime');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->WorkTime);

		parent::tearDown();
	}

}
