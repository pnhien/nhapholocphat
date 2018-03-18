<?php
App::uses('DanhDau', 'Model');

/**
 * DanhDau Test Case
 *
 */
class DanhDauTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.danh_dau'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DanhDau = ClassRegistry::init('DanhDau');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DanhDau);

		parent::tearDown();
	}

}
