<?php
App::uses('ViTri', 'Model');

/**
 * ViTri Test Case
 *
 */
class ViTriTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.vi_tri'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ViTri = ClassRegistry::init('ViTri');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ViTri);

		parent::tearDown();
	}

}
