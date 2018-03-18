<?php
App::uses('AppModel', 'Model');
/**
 * SoTang Model
 *
 */
class SoTang extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'so_tang';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'SO_TANG_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'SO_TANG_NAME';

}
