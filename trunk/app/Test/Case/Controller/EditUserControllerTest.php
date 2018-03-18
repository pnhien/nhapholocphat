<?php
/**
 * @author cuongmh
 * EditUserController Test Case
 */
class EditUserControllerTest extends ControllerTestCase {
	
	// test function init in EditUserController #1
	public function testIndex() {
		$result = $this->testAction ( '/EditUser/index' );
		debug ( $result );
	}
	
	// test function init in EditUserController #12
	public function testDoAddUserOK3() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'allexceedVN3',
						'USER_PASSWORD' => 'passok[]()_',
						'MAIL_ADDRESS' => 'allexceedVN3@gmail.com',
						'LANGUAGE' => '1',
						'AUTH_ROLE' => '1',
						'AUTH_DEMAND_FORECAST_EDIT' => '1'
				)
		);
		$result = $this->testAction ( '/EditUser/doAddUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function init in EditUserController #2
	public function testDoAddUser() {
		$result = $this->testAction ( '/EditUser/doAddUser' );
		debug ( $result );
	}
	
	// test function init in EditUserController #3
	public function testDoAddUserUserIdEmpty() {
		$data = array (
				'TUser' => array (
						'USER_ID' => ''
				)
		);
		$result = $this->testAction ( '/EditUser/doAddUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}

	// test function init in EditUserController #4
	public function testDoAddUserUserIdMaxLength() {
		$data = array (
				'TUser' => array (
						'USER_ID' => '123456789_123456789_123456789_123456789'
				)
		);
		$result = $this->testAction ( '/EditUser/doAddUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
		
	// test function init in EditUserController #5
	public function testDoAddUserUserIdSpecial() {
		$data = array (
				'TUser' => array (
						'USER_ID' => ',.!@#$%^&*()'
				)
		);
		$result = $this->testAction ( '/EditUser/doAddUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function init in EditUserController #6
	public function testDoAddUserUserIdExist() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'admin'
				)
		);
		$result = $this->testAction ( '/EditUser/doAddUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function init in EditUserController #7
	public function testDoAddUserPassEmpty() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'allexceedVN',
						'USER_PASSWORD' => ''
				)
		);
		$result = $this->testAction ( '/EditUser/doAddUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function init in EditUserController #8
	public function testDoAddUserPassMaxLength() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'allexceedVN',
						'USER_PASSWORD' => '123456789_123456789_123456789_123456789'
				)
		);
		$result = $this->testAction ( '/EditUser/doAddUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function init in EditUserController #9
	public function testDoAddUserPassSpecial() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'allexceedVN',
						'USER_PASSWORD' => ',.!@#$%^&*()'
				)
		);
		$result = $this->testAction ( '/EditUser/doAddUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function init in EditUserController #10
	public function testDoAddUserEmailSpecial() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'allexceedVN',
						'USER_PASSWORD' => 'passok',
						'MAIL_ADDRESS' => ',.!@#$%^&*()'
				)
		);
		$result = $this->testAction ( '/EditUser/doAddUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function init in EditUserController #11
	public function testDoAddUserOK1() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'allexceedVN',
						'USER_PASSWORD' => 'passok',
						'MAIL_ADDRESS' => 'allexceedVN@gmail.com',
						'LANGUAGE' => '0',
						'AUTH_ROLE' => '0',
						'AUTH_DEMAND_FORECAST_EDIT' => '1'
				)
		);
		$result = $this->testAction ( '/EditUser/doAddUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function init in EditUserController #12
	public function testDoAddUserOK2() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'allexceedVN2',
						'USER_PASSWORD' => 'passok[]()_',
						'MAIL_ADDRESS' => 'allexceedVN@gmail.com',
						'LANGUAGE' => '0',
						'AUTH_ROLE' => '0',
						'AUTH_DEMAND_FORECAST_EDIT' => '1'
				)
		);
		$result = $this->testAction ( '/EditUser/doAddUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
		
	// test function init in EditUserController #13
	public function testDoChangeUserPassEmpty() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'allexceedVN2',
						'USER_PASSWORD' => '',
						'MAIL_ADDRESS' => 'allexceedVN2@gmail.com',
						'LANGUAGE' => '0',
						'AUTH_ROLE' => '0',
						'AUTH_DEMAND_FORECAST_EDIT' => '1'
				)
		);
		$result = $this->testAction ( '/EditUser/doChangeUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function init in EditUserController #14
	public function testDoChangeUserPassSpecial() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'allexceedVN2',
						'USER_PASSWORD' => '12#,.?',
						'MAIL_ADDRESS' => 'allexceedVN2@gmail.com',
						'LANGUAGE' => '0',
						'AUTH_ROLE' => '0',
						'AUTH_DEMAND_FORECAST_EDIT' => '1'
				)
		);
		$result = $this->testAction ( '/EditUser/doChangeUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function init in EditUserController #15
	public function testDoChangeUserEmailSpecial() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'allexceedVN2',
						'USER_PASSWORD' => 'passOk',
						'MAIL_ADDRESS' => '12#,.?',
						'LANGUAGE' => '0',
						'AUTH_ROLE' => '0',
						'AUTH_DEMAND_FORECAST_EDIT' => '1'
				)
		);
		$result = $this->testAction ( '/EditUser/doChangeUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function init in EditUserController #15
	public function testDoChangeUserPassError() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'allexceedVN2'
				)
		);
		$result = $this->testAction ( '/EditUser/doChangeUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function init in EditUserController #16
	public function testDoChangeUserOk() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'allexceedVN2',
						'USER_PASSWORD' => 'passOk',
						'MAIL_ADDRESS' => 'allexceedVN2@gmail.com',
						'LANGUAGE' => '1',
						'AUTH_ROLE' => '1',
						'AUTH_DEMAND_FORECAST_EDIT' => '1'
				)
		);
		$result = $this->testAction ( '/EditUser/doChangeUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function init in EditUserController #18
	public function testDoDeleteUserFaile() {
		$data = array (
				'user_id' => ''
		);
		$result = $this->testAction ( '/EditUser/doDeleteUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function init in EditUserController #finish
	public function testDoDeleteUserOK1() {
		$data = array (
				'user_id' => 'allexceedVN'
		);
		$result = $this->testAction ( '/EditUser/doDeleteUser', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
}
