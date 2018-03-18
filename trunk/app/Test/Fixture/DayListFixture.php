<?php
/**
 * DayListFixture
 *
 */
class DayListFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'day_list';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'DAY_LIST_ID' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => true, 'key' => 'primary'),
		'DAY_LIST_CODE' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'DAY_LIST_NAME' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'DAY_LIST_ID', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'DAY_LIST_ID' => 1,
			'DAY_LIST_CODE' => 'Lorem ipsum dolor sit amet',
			'DAY_LIST_NAME' => 'Lorem ipsum dolor sit amet'
		),
	);

}
