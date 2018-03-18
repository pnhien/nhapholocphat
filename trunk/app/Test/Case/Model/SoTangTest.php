<?php
App::uses('SoTang', 'Model');

/**
 * SoTang Test Case
 *
 */
class SoTangTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.so_tang'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SoTang = ClassRegistry::init('SoTang');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SoTang);

		parent::tearDown();
	}

}
