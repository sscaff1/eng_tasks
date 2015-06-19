<?php
App::uses('MachConfig', 'Model');

/**
 * MachConfig Test Case
 *
 */
class MachConfigTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mach_config',
		'app.task',
		'app.mach_model',
		'app.task_type',
		'app.status',
		'app.work_time',
		'app.user',
		'app.role',
		'app.tasks_user',
		'app.issue',
		'app.issue_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MachConfig = ClassRegistry::init('MachConfig');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MachConfig);

		parent::tearDown();
	}

}
