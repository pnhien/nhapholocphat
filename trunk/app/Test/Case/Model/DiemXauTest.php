<?php
App::uses('DiemXau', 'Model');

/**
 * DiemXau Test Case
 *
 */
class DiemXauTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.diem_xau'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DiemXau = ClassRegistry::init('DiemXau');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DiemXau);

		parent::tearDown();
	}

}
