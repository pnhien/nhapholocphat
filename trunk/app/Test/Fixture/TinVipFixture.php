<?php
/**
 * TinVipFixture
 *
 */
class TinVipFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'tin_vip';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'TIN_VIP_ID' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => false, 'key' => 'primary'),
		'TIN_VIP_CODE' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'TIN_VIP_NAME' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'TIN_VIP_ID', 'unique' => 1)
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
			'TIN_VIP_ID' => 1,
			'TIN_VIP_CODE' => 'Lorem ipsum dolor sit amet',
			'TIN_VIP_NAME' => 'Lorem ipsum dolor sit amet'
		),
	);

}
