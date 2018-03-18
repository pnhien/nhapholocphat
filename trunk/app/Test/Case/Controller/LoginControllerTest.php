<?php
/**
 * @author nhanvc
 * LoginController Test Case
 */
class LoginControllerTest extends ControllerTestCase {
	// test function init in LoginController #1
	public function testInit() {
		$result = $this->testAction ( '/login/init' );
		debug ( $result );
	}
	// test function doLogin in LoginController #1
	public function testDoLogin() {
		$result = $this->testAction ( '/login/doLogin' );
		debug ( $result );
	}
	// test function doLogin in LoginController #2
	public function testDoLoginPostDataTrue() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'admin',
						'USER_PASSWORD' => 'e12d5ad5975e836e59f173ea985f44ce' 
				) 
		);
		$result = $this->testAction ( '/login/doLogin', array (
				'data' => $data,
				'method' => 'post' 
		) );
		debug ( $result );
	}
	// test function doLogin in LoginController #3
	public function testDoLoginPostDataFalseUserPass() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'test',
						'USER_PASSWORD' => '12345' 
				) 
		);
		$result = $this->testAction ( '/login/doLogin', array (
				'data' => $data,
				'method' => 'post' 
		) );
		debug ( $result );
	}
	// test function doLogin in LoginController #4
	public function testDoLoginPostDataEmptyPass() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'test',
						'USER_PASSWORD' => '' 
				) 
		);
		$result = $this->testAction ( '/login/doLogin', array (
				'data' => $data,
				'method' => 'post' 
		) );
		debug ( $result );
	}
	// test function doLogin in LoginController #5
	public function testDoLoginPostDataEmptyUser() {
		$data = array (
				'TUser' => array (
						'USER_ID' => '',
						'USER_PASSWORD' => '' 
				) 
		);
		$result = $this->testAction ( '/login/doLogin', array (
				'data' => $data,
				'method' => 'post' 
		) );
		debug ( $result );
	}
	// test function doLogin in LoginController #6
	public function testDoLoginPostDataAdminUser() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'admin',
						'USER_PASSWORD' => 'admin' 
				) 
		);
		$result = $this->testAction ( '/login/doLogin', array (
				'data' => $data,
				'method' => 'post' 
		) );
		debug ( $result );
	}
	// test function doLogin in LoginController #7
	public function testDoLoginPostDataUserPermission() {
		$data = array (
				'TUser' => array (
						'USER_ID' => 'admin',
						'USER_PASSWORD' => 'admin' 
				),
				RwsConstant::PUBLIC_PERMISSION 
		);
		$result = $this->testAction ( '/login/doLogin', array (
				'data' => $data,
				'method' => 'post' 
		) );
		debug ( $result );
	}
	// test function doLogout in LoginController
	public function testDoLogout() {
		$result = $this->testAction ( '/login/doLogout' );
		debug ( $result );
	}
}
