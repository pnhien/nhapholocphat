<?php
App::uses('AppModel', 'Model');
/**
 * TCustomer Model
 *
 */
class TCustomer extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'T_CUSTOMER';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'CUSTOMER_ID';

}
