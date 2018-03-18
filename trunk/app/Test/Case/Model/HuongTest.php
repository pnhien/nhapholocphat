<?php
App::uses('Huong', 'Model');

/**
 * Huong Test Case
 *
 */
class HuongTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.huong'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Huong = ClassRegistry::init('Huong');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Huong);

		parent::tearDown();
	}

}
