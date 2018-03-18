<?php
class RwsConstant {

	const FULL_BASE_URL_HOST = FULL_BASE_URL;
	/**
	 * APP_MODE
	 *   0: For HTML Running only
	 *   1: For Developer Environment<br>
	 *   2: For Release<br>
	 */
	const APP_MODE_HTML = '0';
	const APP_MODE_DEV = '1';
	const APP_MODE_RELEASE = '2';
	
	/**
	 * Config EMAIL
	 */
	const EMAIL_CONFIG = 'admin_gmail';
	const FROM_ADDRESS = 'support@nhapholocphat.com';
	
	// Config COOKIE
	const COOKIE_NAME = 'rwsCookie';
	
	// Config SESSION
	const SESSION_LAST_URL_KEY = 'SESSION_LAST_URL';
	const SESSION_CURR_URL_KEY = 'SESSION_CURR_URL';
	const SESSION_ARR_CONTROLLER_KEY = 'SESSION_ARR_CONTROLLER_KEY';
	const SESSION_CERT_KEY = 'SESSION_LOGIN_CERT';
	const SESSION_LOGIN_USER_KEY = 'SESSION_LOGIN_USER';
	const SESSION_USER_API_KEY = 'SESSION_USER_API_KEY';
	const SESSION_SITE_AUTH_EDIT = 'SESSION_SITE_AUTH_EDIT';
	const SESSION_SELECTED_SCREEN_ID = 'SESSION_SELECTED_SCREEN_ID';
	const SESSION_LAST_SELECTED_SCREEN_ID = 'SESSION_LAST_SELECTED_SCREEN_ID';
	const SESSION_LOGIN_CONTROL = 'SESSION_LOGIN_CONTROL';
	
	const COOKIE_KEY_LANGUAGE = 'COOKIE_SELECTED_LANGUAGE';
	const LANGUAGE_VN = 'vn';
	const LANGUAGE_JA = 'ja';
	const LANGUAGE_EN = 'en';
	
	const PUBLIC_PERMISSION = 0;
	const MANAGER_PERMISSION = 1;
	
	const DEFAULT_SEARCH_LIMIT = 20;
	const MD5_SALT = 'vnkey!';
	
	const FLAG_ACTIVE = '1';
	const FLAG_INACTIVE = '0';
	
	const DELETE_FLG_0 = '0';
	const DELETE_FLG_1 = '1';
	
	const CONTACTED_FLG_0 = '0';
	const CONTACTED_FLG_1 = '1';
	
	const MAINTENANCE_MAIL_0 = '0';
	const MAINTENANCE_MAIL_1 = '1';
	
	const COMMENTED_FLG_0 = '0';
	const COMMENTED_FLG_1 = '1';
	
	const MSG_ERROR = '0';
	const MSG_SUCCESS = '1';
	
	const SITE_VIEW_RECORD_LIMIT = 20;
	
	const NOTICE_DUTY_0 = '0';
	const NOTICE_DUTY_1 = '1';
	
	const NOTICE_CUST_0 = '0';
	const NOTICE_CUST_1 = '1';
	
	/**
	 * USER_AUTH_ROLE
	 * 0：システム管理者
	 * 1：物件担当
	 * 2：当直者
	 * 3：顧客管理者
	 * 4：顧客一般利用者
	 */
	const USER_AUTH_ROLE_ADMIN = 0;
	const USER_AUTH_ROLE_SUB = 1;
	const USER_AUTH_ROLE_M2 = 2;
	const USER_AUTH_ROLE_M3 = 3;
	const USER_AUTH_ROLE_M4 = 4;
	
	/**
	 * POINT_TYPE
	 * 0：設定値
	 * 1：デジタル計測点
	 * 2：デジタル演算式
	 * 3：アナログ計測点
	 * 4：アナログ演算式
	 */
	const POINT_TYPE_DIGITAL = '1';
	const POINT_TYPE_ANALOG = '3';
	
	const SITE_AUTH_EDIT = '1';
	
	const THUMBNAIL_SIZE_DEFAULT = 130;
	const MAX_IMAGE_SIZE_DEFAULT = 200;
	const MAX_FILE_SIZE_DEFAULT = 10; //10 mb
	const THUMBNAIL_HEIGHT_DEFAULT = 130;
	const THUMB_PREFIX_DEFAULT = "thumb_";
	const IMAGE_PATH = 'img/';
	const IMAGE_TEMP_PATH = 'img/tmp/';
	const FILE_PATH = 'files/';
	const FILE_TEMP_PATH = 'files/tmp/';
	const FILE_PATH_UPLOAD = 'htdocs/fileupload/';
	const VIDEO_PATH = 'video/';
	const VIDEO_TEMP_PATH = 'video/tmp/';
	const REPORT_PATH = 'reports/';
	const REPORT_TEMP_PATH = 'reports/tmp/';
	const AUDIO_PATH = 'audio/';
	const AUDIO_TEMP_PATH = 'audio/tmp/';
	const IMAGE_GRAPHIC_PATH = 'graphic/';
	const IMAGE_CAMERA_PATH = 'camera/';
	
	const CAMERA_INTERVAL = 15000;
	
	const MODE_NEW = 0;
	const MODE_UPDATE = 1;
	const SUCCESS = 1;
	const ERROR = 0;
	const  SITE_TRAVERSE_GROUP_TYPE_0 = 0;
	const  SITE_TRAVERSE_GROUP_TYPE_1 = 1;
	const FILE_MAINTENANCE_WEB = 'maintenance.cfg';
	
	//Search by
	const SEARCH_ITEM_ANY = 0;
	const SEARCH_ITEM_VIDEO = 1;
	const SEARCH_ITEM_CHANNEL = 2;
	const SEARCH_ITEM_URl = 3;
	
	//News
	const NEWS_ITEM_TYPE_FUN = 0;
	const NEWS_ITEM_TYPE_HOT = 1;
	
	//Dau ngan cach
	const ITEM_SLIPT_BEGIN_END = "{|||}";
	
	//Time get rss
	const ITEM_TIME_GET_RSS_NEWS = 15;
}