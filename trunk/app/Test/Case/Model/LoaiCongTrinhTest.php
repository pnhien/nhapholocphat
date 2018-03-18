<?php
App::uses('LoaiCongTrinh', 'Model');

/**
 * LoaiCongTrinh Test Case
 *
 */
class LoaiCongTrinhTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.loai_cong_trinh'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LoaiCongTrinh = ClassRegistry::init('LoaiCongTrinh');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LoaiCongTrinh);

		parent::tearDown();
	}

}
