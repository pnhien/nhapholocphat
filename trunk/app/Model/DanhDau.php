<?php
App::uses('AppModel', 'Model');
/**
 * DanhDau Model
 *
 */
class DanhDau extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'danh_dau';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'EVALUATE_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'EVALUATE_NAME';

}
