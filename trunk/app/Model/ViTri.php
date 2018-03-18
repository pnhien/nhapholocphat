<?php
App::uses('AppModel', 'Model');
/**
 * ViTri Model
 *
 */
class ViTri extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'vi_tri';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'VI_TRI_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'VI_TRI_NAME';

}
