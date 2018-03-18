<?php
App::uses('MatTien', 'Model');

/**
 * MatTien Test Case
 *
 */
class MatTienTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.mat_tien'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MatTien = ClassRegistry::init('MatTien');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MatTien);

		parent::tearDown();
	}

}
