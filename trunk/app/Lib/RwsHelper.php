<?php
class RwsHelper {
	
	/**
	 * check is null or empty string
	 *
	 * @param string $data        	
	 * @return boolean
	 */
	public static function isEmpty($data) {
		return $data === null || trim ( $data ) === "";
	}
	public static function isNotEmpty($data) {
		return ! self::isEmpty ( $data );
	}
	public static function nullToZero($number) {
		if ($number === null) {
			return 0;
		} else {
			return $number;
		}
	}
	public static function nullToBlank($str) {
		if ($str === null) {
			return "";
		} else {
			return $str;
		}
	}
	public static function nullToEmptyArray($arr) {
		if ($arr === null) {
			return array ();
		} else {
			return $arr;
		}
	}
	public static function nvl($data, $defaultValue) {
		if (self::isEmpty ( $data )) {
			return $defaultValue;
		} else {
			return $data;
		}
	}
	public static function getCurrentMysqlTime() {
		$curDate = date ( 'Y-m-d h:i:s' );
		return $curDate;
	}
	public static function convertToMysqlDateTime($time) {
		$date = date('Y-m-d h:i:s', $time);
		return $date;
	}
	public static function isInArray($arr, $obj) {
		foreach ( $arr as $key => $value ) {
			if ($value == $obj) {
				return true;
			}
		}
		
		return false;
	}
	public static function start_with($wholestr, $startwith) {
		return substr($wholestr, 0, strlen($startwith)) === $startwith;
	}
	/**
	 * Move File
	 * @param unknown $path_from
	 * @param unknown $path_to
	 * @return boolean
	 */
	public static function moveFile($path_from, $path_to) {
		if ($path_from != null && $path_from != "") {
			if (file_exists($path_from)) {
				// copy file from temp folder to image folder
				$copySuccess = copy($path_from, $path_to);
				if ($copySuccess) {
					if (file_exists($path_from)) {
						unlink($path_from);
					}
				}
				return $copySuccess;
			}
		}
		return false;
	}
	
	public static function removeComma($str) {
		if (self::isEmpty($str)) {
			return $str;
		};
		return str_replace(',', '', $str);
	}
	
	public static function randomString($length) {
		$keys = array_merge ( range ( 0, 9 ), range ( 'a', 'z' ), range ( 'A', 'Z' ), array (
				'~',
				'!',
				'@',
				'#',
				'$',
				'%',
				'^',
				'&',
				'*',
				'(',
				')' 
		) );
		$key = '';
		for($i=0; $i < $length; $i++) {
			$key .= $keys[array_rand($keys)];
		}
		return $key;
	}
	
	public static function generateToken() {
		$key = self::randomString(50);
		return md5($key);
	}
	
	public static function displayErrors($errors=NULL) {
		if (!empty($errors)) {
			$i = 0;
			foreach ($errors as $error) {
				echo $error;
				if ($i < count($errors) - 1) {
					echo '<br/>';
				}
			}
		}
	}
	
	/**
	 * 認証文字列を生成する
	 *
	 * @return $string;
	 */
	public static function getRandCert() {
		// ランダムIDのmd5化
		$cert = md5 ( uniqid () . mt_rand () );
		return $cert;
	}
	
	/**
	 * Verify input string has only alpha numeric and '-', '_' characters
	 * @param unknown $check
	 * @return number
	 */
	public static function alphaNumericDashUnderscore($str) {
		return preg_match('|^[0-9a-zA-Z_-]*$|', $str);
	}
	
	/**
	 * Verify input string has only alpha numeric characters
	 * @param string $str
	 * @return boolean
	 */
	public static function isAlphaNumeric($str) {
		return preg_match('|^[0-9a-zA-Z]*$|', $str);
	}
	
	/**
	 * Checks a phone number for Japan.
	 *
	 * @param string $check The value to check.
	 * @return bool Success.
	 */
	public static function checkJpPhone($check) {
		$pattern = '/^(0\d{1,4}[\s-]?\d{1,4}[\s-]?\d{1,4}|\+\d{1,3}[\s-]?\d{1,4}[\s-]?\d{1,4}[\s-]?\d{1,4})$/';
		return (bool)preg_match($pattern, $check);
	}
	
	/**
	 * Checks a postal code for Japan.
	 *
	 * @param string $check The value to check.
	 * @return bool Success.
	 */
	public static function checkJpPostal($check) {
		$pattern = '/^[0-9]{3}-[0-9]{4}$/';
		return (bool)preg_match($pattern, $check);
	}
	
	/**
	 * Checks hiragana
	 * ぁ-ゖー
	 *
	 * @param string $check The value to check.
	 * @param bool $allowSpace Allow double-byte space.
	 * @return bool Success.
	 */
	public static function isHiragana($check, $allowSpace = true) {
		if ($allowSpace) {
			$pattern = '/^(\xe3(\x80\x80|\x81[\x81-\xbf]|\x82[\x80-\x96]|\x83\xbc))*$/';
		} else {
			$pattern = '/^(\xe3(\x81[\x81-\xbf]|\x82[\x80-\x96]|\x83\xbc))*$/';
		}
		return (bool)preg_match($pattern, $check);
	}
	
	/**
	 * Checks katakana
	 * ァ-ヶー
	 *
	 * @param string $check The value to check.
	 * @param bool $allowSpace Allow double-byte space.
	 * @return bool Success.
	 */
	public static function isKatakana($check, $allowSpace = true) {
		if ($allowSpace) {
			$pattern = '/^(\xe3(\x80\x80|\x82[\xa1-\xbf]|\x83[\x80-\xb6]|\x83\xbc))*$/';
		} else {
			$pattern = '/^(\xe3(\x82[\xa1-\xbf]|\x83[\x80-\xb6]|\x83\xbc))*$/';
		}
		return (bool)preg_match($pattern, $check);
	}
	
	/**
	 * Checks zenkaku(double-byte characters)
	 *
	 * @param string $check The value to check.
	 * @return bool Success.
	 */
	public static function checkZenkaku($check) {
		$length = mb_strlen($check);
		for ($i = 0; $i < $length; $i++) {
			$char = mb_substr($check, $i, 1);
			if (mb_strlen($char) === mb_strwidth($char)) {
				return false;
			}
		}
		return true;
	}
	
	public static function isKanji($str) {
		return preg_match('/[\x{4E00}-\x{9FBF}]/u', $str);
	}
	
	public static function isJapanese($str) {
		return self::isKanji($str) || self::isHiragana($str) || self::isKatakana($str);
	}
	
	public static function getStringOnOff($boolParam) {
		$value = 0 + $boolParam;
		if ($value === 1) {
			return 'ON';
		}
		return 'OFF';
	}
	
	/**
	 * Send E-mail
	 *
	 * @param string $params
	 * @return array
	 */
	public static function sendEmail($params) {
		App::uses('CakeEmail', 'Network/Email');
		$email = new CakeEmail();
		$email->config(RwsConstant::EMAIL_CONFIG);// Change later
		$email->from(RwsConstant::FROM_ADDRESS, $params['sender']);
		$email->sender(RwsConstant::FROM_ADDRESS, $params['sender']);
		$email->to($params['to']);
		if (!empty($params['cc'])) {
			$email->cc($params['cc']);
		}
		if (!empty($params['bcc'])) {
			$email->cc($params['bcc']);
		}
		$email->subject($params['subject']);
		$email->template('default','default');//view, layout
		$email->emailFormat('html');
		$email->viewVars (array (
				'content' => $params['body']
		));
		if (!empty($params['attachments'])) {
			$email->attachments($params['attachments']);
		}
		return $email->send();
	}
	/**
	 * Validation datetimepicker
	 * @param string $date
	 * @param string $format
	 * @return boolean
	 */
	public static function validateDate($date, $format = 'Y-m-d H:i:s') {
		$d = DateTime::createFromFormat ( $format, $date );
		return $d && $d->format ( $format ) == $date;
	}
	
	/**
	 * Delete folder, also include files
	 * @param string $dirPath
	 */
	public static function deleteDirectory($dirPath) {
		if (is_dir($dirPath)) {
			$objects = scandir($dirPath);
			foreach ($objects as $object) {
				if ($object != "." && $object !="..") {
					if (filetype($dirPath . DIRECTORY_SEPARATOR . $object) == "dir") {
						deleteDirectory($dirPath . DIRECTORY_SEPARATOR . $object);
					} else {
						unlink($dirPath . DIRECTORY_SEPARATOR . $object);
					}
				}
			}
			reset($objects);
			rmdir($dirPath);
		}
	}
}