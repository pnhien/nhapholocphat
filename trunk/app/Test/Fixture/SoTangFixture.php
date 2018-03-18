<?php
/**
 * SoTangFixture
 *
 */
class SoTangFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'so_tang';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'SO_TANG_ID' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => true, 'key' => 'primary'),
		'SO_TANG_CODE' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'SO_TANG_NAME' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'SO_TANG_ID', 'unique' => 1)
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
			'SO_TANG_ID' => 1,
			'SO_TANG_CODE' => 'Lorem ipsum dolor sit amet',
			'SO_TANG_NAME' => 'Lorem ipsum dolor sit amet'
		),
	);

}
