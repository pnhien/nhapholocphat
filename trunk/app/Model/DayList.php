<?php
App::uses('AppModel', 'Model');
/**
 * DayList Model
 *
 */
class DayList extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'day_list';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'DAY_LIST_ID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'DAY_LIST_NAME';

}
