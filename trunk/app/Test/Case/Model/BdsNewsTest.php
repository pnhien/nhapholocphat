<?php
App::uses('BdsNews', 'Model');

/**
 * BdsNews Test Case
 *
 */
class BdsNewsTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bds_news'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BdsNews = ClassRegistry::init('BdsNews');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BdsNews);

		parent::tearDown();
	}

}
