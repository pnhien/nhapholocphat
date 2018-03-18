<?php
/**
 * DanhDauFixture
 *
 */
class DanhDauFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'danh_dau';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'EVALUATE_ID' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => true, 'key' => 'primary'),
		'EVALUATE_CODE' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'EVALUATE_NAME' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'EVALUATE_ID', 'unique' => 1)
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
			'EVALUATE_ID' => 1,
			'EVALUATE_CODE' => 'Lorem ipsum dolor sit amet',
			'EVALUATE_NAME' => 'Lorem ipsum dolor sit amet'
		),
	);

}
