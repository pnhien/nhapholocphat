<?php
App::uses('AppModel', 'Model');
/**
 * BdsKhachHang Model
 *
 */
class BdsKhachHang extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'bds_khach_hang';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'y';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'NAME';

}
