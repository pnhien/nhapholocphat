<?php
App::uses('TinhTrang', 'Model');

/**
 * TinhTrang Test Case
 *
 */
class TinhTrangTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tinh_trang'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TinhTrang = ClassRegistry::init('TinhTrang');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TinhTrang);

		parent::tearDown();
	}

}
