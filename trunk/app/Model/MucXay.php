<?php
App::uses('AppModel', 'Model');
/**
 * MucXay Model
 *
 */
class MucXay extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'muc_xay';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'MUC_XAY_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'MUC_XAY_NAME';

}
