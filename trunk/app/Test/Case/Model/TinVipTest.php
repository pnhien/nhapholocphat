<?php
App::uses('TinVip', 'Model');

/**
 * TinVip Test Case
 *
 */
class TinVipTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tin_vip'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TinVip = ClassRegistry::init('TinVip');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TinVip);

		parent::tearDown();
	}

}
