<?php
App::uses('AppModel', 'Model');
/**
 * SoTang Model
 *
 */
class Province extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'province';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'PROVINCE_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'PROVINCE_NAME';

}
