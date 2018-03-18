<?php
App::uses('DayList', 'Model');

/**
 * DayList Test Case
 *
 */
class DayListTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.day_list'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DayList = ClassRegistry::init('DayList');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DayList);

		parent::tearDown();
	}

}
