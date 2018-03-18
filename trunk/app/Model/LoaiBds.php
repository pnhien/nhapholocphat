<?php
App::uses('AppModel', 'Model');
/**
 * LoaiBd Model
 *
 */
class LoaiBds extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'loai_bds';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'TYPE_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'TYPE_NAME';

}
