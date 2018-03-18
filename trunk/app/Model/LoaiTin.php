<?php
App::uses('AppModel', 'Model');
/**
 * LoaiTin Model
 *
 */
class LoaiTin extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'loai_tin';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'TYPE_NEWS_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'TYPE_NEWS_NAME';

}
