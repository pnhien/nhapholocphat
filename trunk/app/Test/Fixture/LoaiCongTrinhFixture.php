<?php
/**
 * LoaiCongTrinhFixture
 *
 */
class LoaiCongTrinhFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'loai_cong_trinh';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'LOAI_CONG_TRINH_ID' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'LOAI_CONG_TRINH_CODE' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'LOAI_CONG_TRINH_NAME' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'LOAI_CONG_TRINH_ID', 'unique' => 1)
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
			'LOAI_CONG_TRINH_ID' => 1,
			'LOAI_CONG_TRINH_CODE' => 'Lorem ipsum dolor sit amet',
			'LOAI_CONG_TRINH_NAME' => 'Lorem ipsum dolor sit amet'
		),
	);

}
