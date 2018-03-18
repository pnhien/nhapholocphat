<?php
App::uses('AppModel', 'Model');
/**
 * DiemTot Model
 *
 */
class DiemTot extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'diem_tot';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'DIEM_TOT_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'DAC_DIEM_KHAC';

}
