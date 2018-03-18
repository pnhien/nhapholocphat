<?php
App::uses('LoaiTin', 'Model');

/**
 * LoaiTin Test Case
 *
 */
class LoaiTinTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.loai_tin'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LoaiTin = ClassRegistry::init('LoaiTin');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LoaiTin);

		parent::tearDown();
	}

}
