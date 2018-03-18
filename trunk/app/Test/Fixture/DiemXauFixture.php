<?php
/**
 * DiemXauFixture
 *
 */
class DiemXauFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'diem_xau';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'DIEM_XAU_ID' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'DUONG_DAM_VAO_NHA' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'GAN_CHUA_NHA_THO' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'GAN_NHA_TANG_LE' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'CHAN_CAU_CAO_THE' => array('type' => 'boolean', 'null' => true, 'default' => null, 'comment' => 'D??i chân c?u ho?c d??i ???ng dây ?i?n cao th? (-30%)'),
		'CONG_TRUOC_NHA' => array('type' => 'boolean', 'null' => true, 'default' => null, 'comment' => 'C?ng tr??c nhà'),
		'TRU_DIEN_TRUOC_NHA' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'CAY_LON_TRUOC_NHA' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'KHONG_THE_XAY_MOI' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'QUY_HOACH_TREO' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'DIEM_XAU_KHAC' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'PHAN_TRAM_GIAM' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'DIEM_XAU_ID', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'DIEM_XAU_ID' => 1,
			'DUONG_DAM_VAO_NHA' => 1,
			'GAN_CHUA_NHA_THO' => 1,
			'GAN_NHA_TANG_LE' => 1,
			'CHAN_CAU_CAO_THE' => 1,
			'CONG_TRUOC_NHA' => 1,
			'TRU_DIEN_TRUOC_NHA' => 1,
			'CAY_LON_TRUOC_NHA' => 1,
			'KHONG_THE_XAY_MOI' => 1,
			'QUY_HOACH_TREO' => 1,
			'DIEM_XAU_KHAC' => 'Lorem ipsum dolor sit amet',
			'PHAN_TRAM_GIAM' => 1
		),
	);

}
