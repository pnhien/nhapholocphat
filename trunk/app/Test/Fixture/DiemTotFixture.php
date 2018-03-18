<?php
/**
 * DiemTotFixture
 *
 */
class DiemTotFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'diem_tot';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'DIEM_TOT_ID' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'HAI_MAT_DUONG' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'HEM_BEN_HONG' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'HEM_SAU_NHA' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'GAN_CHO_SIEU_THI' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'GAN_CONG_VIEN_MALL' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'VI_TRI_DEP' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'TIEN_MO_QUAN' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'HEM_THONG' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'DAC_DIEM_KHAC' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 500, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'PHAN_TRAM_THEM' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'DIEM_TOT_ID', 'unique' => 1)
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
			'DIEM_TOT_ID' => 1,
			'HAI_MAT_DUONG' => 1,
			'HEM_BEN_HONG' => 1,
			'HEM_SAU_NHA' => 1,
			'GAN_CHO_SIEU_THI' => 1,
			'GAN_CONG_VIEN_MALL' => 1,
			'VI_TRI_DEP' => 1,
			'TIEN_MO_QUAN' => 1,
			'HEM_THONG' => 1,
			'DAC_DIEM_KHAC' => 'Lorem ipsum dolor sit amet',
			'PHAN_TRAM_THEM' => 1
		),
	);

}
