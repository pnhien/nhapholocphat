<?php
App::uses('AppModel', 'Model');
/**
 * HinhAnh Model
 *
 */
class HinhAnh extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'hinh_anh';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'HINH_ANH_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'HINH_ANH_PATH';

}
