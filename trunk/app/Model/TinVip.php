<?php
App::uses('AppModel', 'Model');
/**
 * TinVip Model
 *
 */
class TinVip extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'tin_vip';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'TIN_VIP_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'TIN_VIP_NAME';

}
