<?php
/**
 * @author cuongmh
 * SendMailDataSettingController Test Case
 */
class SendMailDataSettingControllerTest extends ControllerTestCase {
	
	// test function init in SendMailDataSettingController #1
	public function testIndex() {
		$result = $this->testAction ('/sendMailDataSetting/index?siteId=1' );
		debug ( $result );
	}
	
	// test function init in SendMailDataSettingController #2
	public function testIndex1() {
		$result = $this->testAction ('/sendMailDataSetting/index?siteId=1234' );
		debug ( $result );
	}
	
	// test function doUpdateDataMail in SendMailDataSettingController #3
	public function testDoUpdateDataMailAttach() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'input_data_mail' => '',
						'input_data_mail_attach' => 'H.20150403.001.txt',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMailAttach', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doUpdateDataMail in SendMailDataSettingController #4
	public function testDoUpdateDataMailAttach1() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'input_data_mail' => '',
						'input_data_mail_attach' => 'H.20150404.001.txt',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMailAttach', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doUpdateDataMailAttach in SendMailDataSettingController #5
	public function testDoUpdateDataMailAttachFaile() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'input_data_mail' => '',
						'input_data_mail_attach' => 'H.20150403.001.txt',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMailAttach', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doUpdateDataMailAttach in SendMailDataSettingController #5
	public function testDoUpdateDataMailAttachFaile2() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'input_data_mail' => '',
						'input_data_mail_attach' => 'R.20150402.001.txt',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMailAttach', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doDeleteMailattach in SendMailDataSettingController #6
	public function testDoDeleteMailattach() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'input_data_mail' => '',
						'input_data_mail_attach' => 'H.20150403.001.txt',
						'siteId' => '1'
				),
				'0' => array ('TSite' => array ('data_mail_attach' => 'report1'))
		);
		$result = $this->testAction ( '/sendMailDataSetting/doDeleteMailattach?rowId=0', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doUpdateDataMail in SendMailDataSettingController #7
	public function testDoUpdateDataMail1() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'select_data_email' => '0',
						'input_data_mail' => '',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMail', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
		
	// test function doUpdateDataMail in SendMailDataSettingController #8
	public function testDoUpdateDataMail2() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'select_data_email' => '0',
						'input_data_mail' => 'test_to@gmail.com',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMail', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doUpdateDataMail in SendMailDataSettingController #9
	public function testDoUpdateDataMail3() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'select_data_email' => '1',
						'input_data_mail' => 'test_cc@gmail.com',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMail', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doUpdateDataMail in SendMailDataSettingController #10
	public function testDoUpdateDataMail4() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'select_data_email' => '2',
						'input_data_mail' => 'test_bcc@gmail.com',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMail', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doUpdateDataMail in SendMailDataSettingController #11
	public function testDoUpdateDataMail5() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'select_data_email' => '0',
						'input_data_mail' => 'test_to@gmail.com',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMail', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doUpdateDataMail in SendMailDataSettingController #12
	public function testDoUpdateDataMail6() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'select_data_email' => '1',
						'input_data_mail' => 'test_cc@gmail.com',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMail', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doUpdateDataMail in SendMailDataSettingController #13
	public function testDoUpdateDataMail7() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'select_data_email' => '2',
						'input_data_mail' => 'test_bcc@gmail.com',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMail', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doUpdateDataMail in SendMailDataSettingController #14
	public function testDoUpdateDataMail8() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'select_data_email' => '0',
						'input_data_mail' => '!@#test_to@gmail.com',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMail', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doUpdateDataMail in SendMailDataSettingController #15
	public function testDoUpdateDataMail9() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'select_data_email' => '0',
						'input_data_mail' => 'test_to@gmail.com',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMail', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doUpdateDataMail in SendMailDataSettingController #16
	public function testDoUpdateDataMail10() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'select_data_email' => '1',
						'input_data_mail' => 'test_cc1@gmail.com',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMail', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doDeleteMailTo in SendMailDataSettingController #17
	public function testdoDeleteMailTo() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'input_data_mail' => '',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				),
				'0' => array ('TSite' => array ('data_mail_to' => 'test_to@gmail.com'))
		);
		$result = $this->testAction ( '/sendMailDataSetting/doDeleteMailTo?rowId=0', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doDeleteMailBc in SendMailDataSettingController #18
	public function testdoDeleteMailCc() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'input_data_mail' => '',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				),
				'0' => array ('TSite' => array ('data_mail_cc' => 'test_Cc@gmail.com'))
		);
		$result = $this->testAction ( '/sendMailDataSetting/doDeleteMailCc?rowId=0', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doDeleteMailBcc in SendMailDataSettingController #19
	public function testdoDeleteMailBcc() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'input_data_mail' => '',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				),
				'0' => array ('TSite' => array ('data_mail_bcc' => 'test_bcc@gmail.com'))
		);
		$result = $this->testAction ( '/sendMailDataSetting/doDeleteMailBcc?rowId=0', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
		
	// test function doUpdateDataMailSetting in SendMailDataSettingController #20
	public function testdoUpdateDataMail_NoMailTo() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '12:12:00',
						'data_mail_title' => 'Title send',
						'data_mail_body' => 'Body how to send',
						'data_mail_cycle_type' => '1',
						'data_mail_cycle_day' => '0',
						'data_mail_time_send' => '2015/04/01',
						'data_mail_exce_flag' => '1',
						'input_data_mail' => '',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMailSetting', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doUpdateDataMail in SendMailDataSettingController #21
	public function testDoUpdateDataMail11() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '',
						'data_mail_title' => '',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '',
						'data_mail_cycle_day' => '',
						'data_mail_time_send' => '',
						'data_mail_exce_flag' => '',
						'select_data_email' => '0',
						'input_data_mail' => 'test_to@gmail.com',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMail', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	
	// test function doUpdateDataMailSetting in SendMailDataSettingController #22
	public function testdoUpdateDataMail_NoTitle() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '12:12:00',
						'data_mail_title' => '',
						'data_mail_body' => 'Body how to send mail',
						'data_mail_cycle_type' => '1',
						'data_mail_cycle_day' => '0',
						'data_mail_time_send' => '2015/04/01',
						'data_mail_exce_flag' => '1',
						'input_data_mail' => '',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMailSetting', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doUpdateDataMailSetting in SendMailDataSettingController #23
	public function testdoUpdateDataMail_NoBody() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '12:12:00',
						'data_mail_title' => 'Title how to send mail',
						'data_mail_body' => '',
						'data_mail_cycle_type' => '1',
						'data_mail_cycle_day' => '0',
						'data_mail_time_send' => '2015/04/01',
						'data_mail_exce_flag' => '1',
						'input_data_mail' => '',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMailSetting', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	// test function doUpdateDataMailSetting in SendMailDataSettingController #24
	public function testdoUpdateDataMail_OK() {
		$data = array (
				'TSite' => array (
						'data_mail_time' => '12:12:00',
						'data_mail_title' => 'Title how to send mail',
						'data_mail_body' => 'Body how to send mail',
						'data_mail_cycle_type' => '1',
						'data_mail_cycle_week' => '0',
						'data_mail_time_send' => '2015/04/01',
						'data_mail_exce_flag' => '1',
						'input_data_mail' => '',
						'input_data_mail_attach' => '',
						'siteId' => '1'
				)
		);
		$result = $this->testAction ( '/sendMailDataSetting/doUpdateDataMailSetting', array (
				'data' => $data,
				'method' => 'post'
		) );
		debug ( $result );
	}
	
	
}
