<?php
App::uses('AppModel', 'Model');
/**
 * PhapLy Model
 *
 */
class PhapLy extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'phap_ly';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'PHAP_LY_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'PHAP_LY_NAME';

}
