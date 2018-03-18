<?php
/**
 * PhapLyFixture
 *
 */
class PhapLyFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'phap_ly';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'PHAP_LY_ID' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => true, 'key' => 'primary'),
		'PHAP_LY_CODE' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'PHAP_LY_NAME' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'PHAP_LY_ID', 'unique' => 1)
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
			'PHAP_LY_ID' => 1,
			'PHAP_LY_CODE' => 'Lorem ipsum dolor sit amet',
			'PHAP_LY_NAME' => 'Lorem ipsum dolor sit amet'
		),
	);

}
