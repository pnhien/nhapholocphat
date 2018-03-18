<?php
App::uses('AppModel', 'Model');
/**
 * Street Model
 *
 */
class Street extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'street';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'STREET_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'STREET_NAME';

}
