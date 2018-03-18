<?php
class Message {
	public static $messageList = array (
			RwsConstant::LANGUAGE_VN => array (
					// Testing error message only, do not use to display
					'TEST_ERR_MSG' => 'This is testing error message with parameter {0} and {1}.',
					// Common error message
					'NO_DATA_FOUND' => 'Không có dữ liệu',
					'DB_ERROR' => 'Lỗi database',
					'SYSTEM_ERROR' => 'Lỗi hệ thống',
					'OPERATION_SUCCESS' => 'Thực hiện thành công.',
					'EMAIL_ERROR' => 'Email không hợp lệ, vui lòng nhập lại',
					'UPLOAD_FAILED' => 'Không tải lên được.',
					'DOWNLOAD_FAILED' => 'Không download được',
					'INVALID_FILE' => 'File không hợp lệ',
					'SEND_EMAIL_FAILED' => 'Không thể gửi email xác nhận.',
					'CONFIRM_DELETE' => 'Bạn chắc chắn muốn xóa không?',
					'CONFIRM_UPDATE' => 'Bạn chắc chắn muốn cập nhật không?',
					'ERROR_ALPHA_NUMERIC_ONLY' => 'Vui lòng nhập ký tự chữ và số',
					'INVALID_DATE' => 'Ngày không hợp lệ',
					'ERROR_FULL_SIZE_ONLY' => 'Nhập văn bản bằng fullsize',
					//Send mail comfirm
					'EMAIL_CFM_TITLE' => 'v/v Xác nhận email cho tài khoản tại www.nhapholocphat.com',
					'EMAIL_CFM_BODY' => ' Email xác nhận, xin đừng reply. Vui lòng click vào link bên dưới để xác nhận: ',
					'EMAIL_CFM_CHECK' => 'Nội dung xác nhận đã được gửi vào email.',
					'EMAIL_CFM_NOT_ACTIVE' => 'Tài khoản chưa được xác nhận.',
					// For other error message
					'LOGIN_ERR_000001' => 'Vui lòng nhập tên người dùng',
					'LOGIN_ERR_000002' => 'Vui lòng nhập mật khẩu',
					'LOGIN_ERR_000003' => 'Tên người dùng hoặc mật khẩu không đúng',
					'LOGIN_ERR_000004' => 'Bạn không có quyền truy cập, hãy liên hệ với admin.',
					'LOGIN_CFM_000001' => 'Bạn đã xác nhận email thành công.',
					'LOGIN_CFM_000002' => 'Mã xác nhận không hợp lệ, vui lòng liên hệ administrator.',
					
					'USERSETTING_ERR_000000' => 'Chưa nhập mật khẩu.',
					'USERSETTING_ERR_000001' => 'Mật khẩu không đúng.',
					'USERSETTING_ERR_000002' => 'Chưa nhập mật khẩu mới.',
					'USERSETTING_ERR_000006' => 'Chưa nhập mật khẩu xác nhận.',
					'USERSETTING_ERR_000003' => 'Mật khẩu không khớp.',
					'USERSETTING_ERR_000004' => 'Không nhập quá 32 ký tự.',
					'USERSETTING_ERR_000005' => 'Mật khẩu không khớp.',
					'USERSETTING_ERR_000007' => 'Chưa nhập email.',
					'USERSETTING_CNF_000001' => 'Đã thay đổi mật khẩu.',
					'USERSETTING_SEC_000001' => 'Cập nhật thành công.',
					//Edit user
					'EDITUSER_ERR_000001' => 'Chưa nhập username.',
					'EDITUSER_ERR_000003' => 'Username không được vượt quá 32 ký tự.',
					'EDITUSER_ERR_000004' => 'Username đã có người sử dụng.',
					'EDITUSER_ERR_000005' => 'Chưa nhập mật khẩu.',
					'EDITUSER_ERR_000006' => 'Nhập mật khẩu tối đa 32 ký tự.',
					'EDITUSER_ERR_000007' => 'Username không tồn tại.',
					'EDITUSER_ERR_000008' => 'Username không đúng ký tự(A-Za-z0-9()[]_).',
					'EDITUSER_ERR_000009' => 'Password được nhập ký tự(A-Za-z0-9()[]_).',
					'EDITUSER_ERR_000010' => 'Email không đúng format(A-Za-z0-9()[]_)',
					'EDITUSER_ERR_000011' => 'Chưa nhập tên.',
					'EDITUSER_ERR_000012' => 'Chưa nhập api key.',
					'EDITUSER_CNF_000001' => 'Bạn chắn chắn muốn xóa？',
					'EDITUSER_CNF_000002' => 'Xóa tài khoản và bạn sẽ bị logout?',
			
					'MAINTENANCEMODE_MSG_000004' => 'Email không đúng fomat。',
			),
			RwsConstant::LANGUAGE_JA => array (
					// Testing error message only, do not use to display
					'TEST_ERR_MSG' => 'This is testing error message with parameter {0} and {1}.',
					// Common error message
					'NO_DATA_FOUND' => 'データは存在しません。',
					'DB_ERROR' => 'データベースエラーが見つかりました。',
					'SYSTEM_ERROR' => 'システムエラーが見つかりました。',
					'OPERATION_SUCCESS' => '処理が正常に終了。',
					'EMAIL_ERROR' => '不正なEmailです。再入力して下さい。',
					'UPLOAD_FAILED' => 'アップロードに失敗しました。',
					'DOWNLOAD_FAILED' => 'ダウンロードに失敗しました。',
					'INVALID_FILE' => 'ファイルが無効です。',
					'SEND_EMAIL_FAILED' => '失敗したメールを送信します。',
					'CONFIRM_DELETE' => '削除してもよろしいでしょうか？',
					'CONFIRM_UPDATE' => '更新してもよろしいでしょうか？',
					'ERROR_ALPHA_NUMERIC_ONLY' => '半角英数字で入力してください。',
					'INVALID_DATE' => '有効な値を入力してください。',
					'ERROR_FULL_SIZE_ONLY' => '本文は全角で入力してください。',
					//Send mail comfirm
					'EMAIL_CFM_TITLE' => 'Email to confirm account at www.nhapholocphat.com',
					'EMAIL_CFM_BODY' => 'Please click to confirm :',
					'EMAIL_CFM_CHECK' => 'Please confirm in your email.',
					'EMAIL_CFM_NOT_ACTIVE' => 'Account not verify.',
					// For other error message
					'LOGIN_ERR_000001' => 'ユーザ名を入力して下さい。',
					'LOGIN_ERR_000002' => 'パスワードを入力して下さい。',
					'LOGIN_ERR_000003' => 'ユーザ名または、パスワードが違います。',
					'LOGIN_ERR_000004' => '閲覧可能なサイトが登録されていません。テスエンジニアリング：システム管理者に問い合わせてください。',
					'LOGIN_CFM_000001' => 'Email activated.',
					'LOGIN_CFM_000002' => 'Key verify has not been registered. Please contact administrator.',
					'USERSETTING_ERR_000000' => 'パスワードを入力して下さい。',
					'USERSETTING_ERR_000001' => 'パスワードが違います。',
					'USERSETTING_ERR_000002' => '新パスワードを入力して下さい。',
					'USERSETTING_ERR_000006' => '確認再入力を入力して下さい。',
					'USERSETTING_ERR_000003' => '新パスワードと確認再入力パスワードが一致しません。',
					'USERSETTING_ERR_000004' => '入力可能文字数を超えています。32以内で入力下さい。',
					'USERSETTING_ERR_000005' => 'パスワードが一致しません。',
					'USERSETTING_CNF_000001' => 'パスワードを変更しました。',
					'USERSETTING_ERR_000007' => 'Chưa nhập email.',
					'USERSETTING_SEC_000001' => 'パスワードが正常に変更されました。',
					'USERSETTING_SEC_000002' => '使用言語が正常に変更されました。',
					'EDITUSER_ERR_000001' => '新規ユーザIDを入力して下さい。',
					'EDITUSER_ERR_000003' => '新規ユーザIDの入力可能文字数を超えました。32以内で入力して下さい。',
					'EDITUSER_ERR_000004' => '入力されたユーザIDは既に使用されています。',
					'EDITUSER_ERR_000005' => 'パスワードを入力して下さい。',
					'EDITUSER_ERR_000006' => 'パスワードの入力可能文字数を超えました。32以内で入力して下さい。',
					'EDITUSER_ERR_000007' => 'ユーザーIDが存在していません。',
					'EDITUSER_ERR_000008' => 'ユーザーIDが一致しません。',
					'EDITUSER_ERR_000009' => 'パスワードが一致しません。',
					'EDITUSER_ERR_000010' => 'メールが一致しません。',
					'EDITUSER_ERR_000011' => 'Please input customer name.',
					'EDITUSER_ERR_000012' => 'Please imput api key.',
					'EDITUSER_CNF_000001' => '削除してもよろしいでしょうか？',
					'EDITUSER_CNF_000002' => '現在ログイン中の登録を削除します。ログアウトします。よろしいでしょうか？',
			
					'MAINTENANCEMODE_MSG_000004' => 'メールが一致しません。',
			),
			RwsConstant::LANGUAGE_EN => array (
					// Testing error message only, do not use to display
					'TEST_ERR_MSG' => 'This is testing error message with parameter {0} and {1}.',
					// Common error message
					'NO_DATA_FOUND' => 'No data found.',
					'DB_ERROR' => 'Database error.',
					'SYSTEM_ERROR' => 'System error.',
					'OPERATION_SUCCESS' => 'Operation finishes successfully.',
					'EMAIL_ERROR' => 'Email is not valid. Please input again!!!',
					'UPLOAD_FAILED' => 'Upload failed',
					'DOWNLOAD_FAILED' => 'Download failed.',
					'INVALID_FILE' => 'Input file is invalid.',
					'SEND_EMAIL_FAILED' => 'Send email fail.',
					'CONFIRM_DELETE' => 'Do you really want to delete?',
					'CONFIRM_UPDATE' => 'Do you really want to modify?',
					'ERROR_ALPHA_NUMERIC_ONLY' => 'Please enter alpha numeric character only.',
					'INVALID_DATE' => 'Invalid date.',
					'ERROR_FULL_SIZE_ONLY' => 'Please enter full-size character only.',
					//Send mail comfirm
					'EMAIL_CFM_TITLE' => 'Email to confirm account at www.nhapholocphat.com',
					'EMAIL_CFM_BODY' => 'Please click to confirm :',
					'EMAIL_CFM_CHECK' => 'Please confirm in your email.',
					'EMAIL_CFM_NOT_ACTIVE' => 'Account not verify.',
					// For other error message
					'LOGIN_ERR_000001' => 'Please input username.',
					'LOGIN_ERR_000002' => 'Please input password.',
					'LOGIN_ERR_000003' => 'Incorrect Username or Password.',
					'LOGIN_ERR_000004' => 'Viewable site has not been registered. Please contact your system administrator.',
					'LOGIN_CFM_000001' => 'Email activated.',
					'LOGIN_CFM_000002' => 'Key verify has not been registered. Please contact administrator.',
					'USERSETTING_ERR_000000' => 'Please enter a password.',
					'USERSETTING_ERR_000001' => 'Incorrect Password.',
					'USERSETTING_ERR_000002' => 'Please input new password.',
					'USERSETTING_ERR_000006' => 'Please input new password confirm.',
					'USERSETTING_ERR_000003' => 'New password and confirmation re-enter the password does not match.',
					'USERSETTING_ERR_000004' => 'Inputted value is over number of characters.Please input within 32 characters.',
					'USERSETTING_ERR_000005' => 'Password does not match.',
					'USERSETTING_ERR_000007' => 'Please input email.',
					'USERSETTING_CNF_000001' => 'Password was modifed.',
					'USERSETTING_SEC_000001' => 'I changed the password.',
					'TRENDGROUP_ERR_000001'=>'Please input New Group Name.',
					'TRENDGROUP_ERR_000002' => 'Please select Measurment Point.',
					'TRENDGROUP_MSG_000003'=>'Really want to delete Group?',
					'TRENDGROUP_MSG_DELETE' => 'Really want to delete it？',
					'EDITUSER_ERR_000001' => 'Please input new UserID.',
					'EDITUSER_ERR_000003' => 'UserID is over number of characters.Please input within 32 characters.',
					'EDITUSER_ERR_000004' => 'UserID is in use.',
					'EDITUSER_ERR_000005' => 'Please input Password.',
					'EDITUSER_ERR_000006' => 'Password is over number of characters.Please input within 32 characters.',
					'EDITUSER_ERR_000007' => 'UserID is not exist.',
					'EDITUSER_ERR_000008' => 'UserID does not match.',
					'EDITUSER_ERR_000009' => 'Password does not match.',
					'EDITUSER_ERR_000010' => 'Email does not match.',
					'EDITUSER_ERR_000011' => 'Please input customer name.',
					'EDITUSER_ERR_000012' => 'Please imput api key.',
					'EDITUSER_CNF_000001' => 'Do you really want to delete?',
					'EDITUSER_CNF_000002' => 'It will delete the user of the currently logged in. Do you really want to delete?',
			
			) 
	);
	
	/**
	 * Get message with input parameters as array
	 * @param string $language
	 * @param string $key
	 * @param array $params: Input array with format: <br>
	 * 		array{'replaced_string_1', 'replaced_string_1'}
	 * 			
	 * @return string
	 */
	public static function getMessage($language, $key, $params=array()) {
		$ret_msg = '';
		if (isset($params)) {
			$message = self::$messageList[$language][$key];
			$arr_msg = preg_split('/(\{.*?\})/', $message);
			for ($i = 0; $i < count($params); $i++) {
				$ret_msg .= $arr_msg[$i];
				$ret_msg .= $params[$i];
			}
			$ret_msg .= $arr_msg[$i];
		}
		return $ret_msg;
	}
}