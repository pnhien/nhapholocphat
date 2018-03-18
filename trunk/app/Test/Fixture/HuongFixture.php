<?php
/**
 * HuongFixture
 *
 */
class HuongFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'huong';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'HUONG_ID' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => true, 'key' => 'primary'),
		'HUONG_CODE' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'HUONG_NAME' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'HUONG_ID', 'unique' => 1)
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
			'HUONG_ID' => 1,
			'HUONG_CODE' => 'Lorem ipsum dolor sit amet',
			'HUONG_NAME' => 'Lorem ipsum dolor sit amet'
		),
	);

}
