<?php
/**
 * MucXayFixture
 *
 */
class MucXayFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'muc_xay';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'MUC_XAY_ID' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'MUC_XAY_CODE' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'MUC_XAY_NAME' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'MUC_XAY_ID', 'unique' => 1)
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
			'MUC_XAY_ID' => 1,
			'MUC_XAY_CODE' => 'Lorem ipsum dolor sit amet',
			'MUC_XAY_NAME' => 'Lorem ipsum dolor sit amet'
		),
	);

}
