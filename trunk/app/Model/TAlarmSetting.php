<?php
App::uses('AppModel', 'Model');
/**
 * TAlarmSetting Model
 *
 */
class TAlarmSetting extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'T_ALARM_SETTING';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = array('SITE_ID', 'POINT_ID');

}
