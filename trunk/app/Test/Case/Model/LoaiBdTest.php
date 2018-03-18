<?php
App::uses('LoaiBd', 'Model');

/**
 * LoaiBd Test Case
 *
 */
class LoaiBdTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.loai_bd'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LoaiBd = ClassRegistry::init('LoaiBd');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LoaiBd);

		parent::tearDown();
	}

}
