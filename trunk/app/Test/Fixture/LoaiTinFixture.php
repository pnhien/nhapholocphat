<?php
/**
 * LoaiTinFixture
 *
 */
class LoaiTinFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'loai_tin';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'TYPE_NEWS_ID' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => true, 'key' => 'primary'),
		'TYPE_NEWS_CODE' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'TYPE_NEWS_NAME' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'TYPE_NEWS_ID', 'unique' => 1)
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
			'TYPE_NEWS_ID' => 1,
			'TYPE_NEWS_CODE' => 'Lorem ipsum dolor sit amet',
			'TYPE_NEWS_NAME' => 'Lorem ipsum dolor sit amet'
		),
	);

}
