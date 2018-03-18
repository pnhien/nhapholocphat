<?php
App::uses('AppModel', 'Model');
/**
 * TinhTrang Model
 *
 */
class TinhTrang extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'tinh_trang';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'TINH_TRANG_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'TINH_TRANG_NAME';

}
