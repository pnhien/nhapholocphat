<?php
App::uses('AppModel', 'Model');
/**
 * Common Model
 *
 */
class Common extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'common';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'COMMON_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'COMMON_VALUE';

}
