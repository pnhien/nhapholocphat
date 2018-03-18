<?php
/**
 * TinhTrangFixture
 *
 */
class TinhTrangFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'tinh_trang';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'TINH_TRANG_ID' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => true, 'key' => 'primary'),
		'TINH_TRANG_CODE' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'TINH_TRANG_NAME' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'TINH_TRANG_ID', 'unique' => 1)
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
			'TINH_TRANG_ID' => 1,
			'TINH_TRANG_CODE' => 'Lorem ipsum dolor sit amet',
			'TINH_TRANG_NAME' => 'Lorem ipsum dolor sit amet'
		),
	);

}
