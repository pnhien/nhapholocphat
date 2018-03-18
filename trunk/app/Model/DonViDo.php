<?php
App::uses('AppModel', 'Model');
/**
 * DonViDo Model
 *
 */
class DonViDo extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'don_vi_do';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'DON_VI_DO_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'DON_VI_DO_NAME';

}
