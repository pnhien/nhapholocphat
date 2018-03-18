<?php
App::uses('AppModel', 'Model');
/**
 * MatTien Model
 *
 */
class MatTien extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'mat_tien';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'MAT_TIEN_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'MAT_TIEN_NAME';

}
