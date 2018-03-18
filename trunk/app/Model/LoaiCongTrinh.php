<?php
App::uses('AppModel', 'Model');
/**
 * LoaiCongTrinh Model
 *
 */
class LoaiCongTrinh extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'loai_cong_trinh';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'LOAI_CONG_TRINH_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'LOAI_CONG_TRINH_NAME';

}
