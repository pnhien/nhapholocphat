<?php
App::uses('MucXay', 'Model');

/**
 * MucXay Test Case
 *
 */
class MucXayTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.muc_xay'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MucXay = ClassRegistry::init('MucXay');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MucXay);

		parent::tearDown();
	}

}
