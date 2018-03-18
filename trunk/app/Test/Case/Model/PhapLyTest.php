<?php
App::uses('PhapLy', 'Model');

/**
 * PhapLy Test Case
 *
 */
class PhapLyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.phap_ly'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PhapLy = ClassRegistry::init('PhapLy');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PhapLy);

		parent::tearDown();
	}

}
