<?php
App::uses('MachModel', 'Model');

/**
 * MachModel Test Case
 *
 */
class MachModelTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mach_model'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MachModel = ClassRegistry::init('MachModel');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MachModel);

		parent::tearDown();
	}

}
