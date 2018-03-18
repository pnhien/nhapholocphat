<?php
App::uses('AppModel', 'Model');
/**
 * Huong Model
 *
 */
class Huong extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'huong';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'HUONG_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'HUONG_NAME';

}
