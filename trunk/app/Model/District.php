<?php
App::uses('AppModel', 'Model');
/**
 * District Model
 *
 */
class District extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'district';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'DISTRICT_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'DISTRICT_NAME';

}
