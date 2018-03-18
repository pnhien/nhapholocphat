<?php
App::uses('AppModel', 'Model');
/**
 * DiemXau Model
 *
 */
class DiemXau extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'diem_xau';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'DIEM_XAU_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'DIEM_XAU_KHAC';

}
