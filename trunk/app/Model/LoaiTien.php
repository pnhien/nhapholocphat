<?php
App::uses('AppModel', 'Model');
/**
 * LoaiTien Model
 *
 */
class LoaiTien extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'loai_tien';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'LOAI_TIEN_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'LOAI_TIEN_NAME';

}
