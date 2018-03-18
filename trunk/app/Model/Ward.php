<?php
App::uses('AppModel', 'Model');
/**
 * Ward Model
 *
 */
class Ward extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'ward';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'WARD_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'WARD_NAME';

}
