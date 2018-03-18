<?php
/**
 * ViTriFixture
 *
 */
class ViTriFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'vi_tri';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'VI_TRI_ID' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => true, 'key' => 'primary'),
		'VI_TRI_CODE' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'VI_TRI_NAME' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'VI_TRI_ID', 'unique' => 1)
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
			'VI_TRI_ID' => 1,
			'VI_TRI_CODE' => 'Lorem ipsum dolor sit amet',
			'VI_TRI_NAME' => 'Lorem ipsum dolor sit amet'
		),
	);

}
