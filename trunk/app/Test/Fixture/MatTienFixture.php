<?php
/**
 * MatTienFixture
 *
 */
class MatTienFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'mat_tien';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'MAT_TIEN_ID' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => true, 'key' => 'primary'),
		'MAT_TIEN_CODE' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'MAT_TIEN_NAME' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'MAT_TIEN_ID', 'unique' => 1)
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
			'MAT_TIEN_ID' => 1,
			'MAT_TIEN_CODE' => 'Lorem ipsum dolor sit amet',
			'MAT_TIEN_NAME' => 'Lorem ipsum dolor sit amet'
		),
	);

}
