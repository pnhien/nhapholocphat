<?php
App::uses('NhomBd', 'Model');

/**
 * NhomBd Test Case
 *
 */
class NhomBdTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.nhom_bd'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->NhomBd = ClassRegistry::init('NhomBd');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->NhomBd);

		parent::tearDown();
	}

}
