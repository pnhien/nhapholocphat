<?php
App::uses('DiemTot', 'Model');

/**
 * DiemTot Test Case
 *
 */
class DiemTotTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.diem_tot'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DiemTot = ClassRegistry::init('DiemTot');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DiemTot);

		parent::tearDown();
	}

}
