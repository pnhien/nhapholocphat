<?php
class ScreenFieldLabels {
	/**
	 * Rule:
	 *    Key => Value
	 *    * Key: always be UPPERCASE
	 *    * Value: Depend
	 *    * TITLE must be set for each screen
	 * Format:
	 *    '<Screen Name>_<Field Name>' => '<Value>'
	 * Ex:
	 *    'LOGIN_TITLE' => 'Login'
	 **/
	public static $messageList = array (
		RwsConstant::LANGUAGE_VN => array (
			// Specified word
			'ROW' => 'Dòng',
			'ALL_ROWS' => 'Tất cả dòng',
			'ALL' => 'Tất cả',
			'DATE' => 'Ngày',
			// BUTTON
			'BTN_DISPLAY' => 'Hiển thị',
			'BTN_VIEW' => 'Xem',
			'BTN_ADD' => 'Thêm',
			'BTN_EDIT' => 'Sữa',
			'BTN_SAVE' => 'Lưu',
			'BTN_DELETE' =>'Xóa',
			'BTN_EXECUTE'=> 'Thực thi',
			'BTN_SETTING' =>'Thiết lập',
			'BTN_NEW_CREATE' => 'Tạo mới',
			'BTN_CHOOSE' => 'Chọn',
			'BTN_CHECK' => 'Kiểm tra',
			'BTN_SEND' => 'Gửi',
			'BTN_CANCEL' => 'Hủy',
			'BTN_CANCEL_1' => 'Hủy',
			'BTN_RUN' => 'Chạy',
			'BTN_CLEAR' => 'Xóa',
			'BTN_INSERT' => 'Insert',
			'BTN_STOP' => 'Ngừng',
			'BTN_REGISTER' => 'Đăng ký',
			// DIALOG
			'TITLE_ALERT_DIALOG' => 'Cảnh báo',
			'TITLE_CONFIRM_DIALOG' => 'Xác nhận',
			'TITLE_QUESTION_DIALOG' => 'Câu hỏi',
			'BTN_QUESTION_YES' => 'Có',
			'BTN_QUESTION_NO' => 'Không',
			'BTN_CONFIRM_CANCEL' => 'Cancel',
			
			// Login Screen
			'LOGIN_TITLE' => 'Đăng nhập',
			'LOGIN_SCREEN_NAME' => 'Đăng nhập',
			'LOGIN_USERNAME' => 'Người dùng',
			'LOGIN_PASSWORD' => 'Mật khẩu',
			'LOGIN_SUBMIT' => 'Đăng nhập',
			'SCR_LOGIN_CREATE' => 'Tạo tài khoản',
				
			// Print Screen
			'BTN_PRINTPREVIEW' => '印刷プレビュー',
				
			//Edit user
			'BTN_EDITUSER_CHANGE' => 'Cập nhật',
			'BTN_EDITUSER_RUN' => 'Chạy',
			'SCR_EDITUSER_CREATE' => 'Tạo mới người dùng:',
			'SCR_EDITUSER_USERLIST' => 'Người dùng hiện tại:',
			'SCR_EDITUSER_USERINFO' => 'Thông tin:',
			'TITLE_EDIT_USER' => 'Chỉnh sửa người dùng',
	
				
			//ユーザ個人設定変更
			'USERSETTING_PASSCHANGE' => 'Đổi mật khẩu',
			'USERSETTING_OLDPASS' => 'Mật khẩu cũ',
			'USERSETTING_NEWPASS' => 'Mật khẩu mới',
			'USERSETTING_NEWPASSCNF' => 'Nhập lại mật khẩu',
			'USERSETTING_USERLANGUAGE' => 'Ngôn ngữ',
			'BTN_USERSETTING_PASS_CHANGE' => 'Đổi mật khẩu',
			'BTN_USERSETTING_USERLANGUAGE_CHANGE' => 'Thay đổi ngôn ngữ',
				
			//Home
			'HOME_CATALOG_001' => 'Được đề xuất',
			'HOME_CATALOG_002' => 'Phim',
			'HOME_CATALOG_003' => 'Video clips',
			'HOME_CATALOG_004' => 'Tin tức nhà bán',
			'HOME_CATALOG_005' => 'Tin tức nhà thuê',
			
			'HOME_CATALOG_NOTE_001' => 'tin mới nhất',
			
			//Menu
			'SCR_MENU_ADMIN' => 'Chỉnh sửa người dùng',
			'SCR_MENU_BDS_NEWS_LIST' => 'Danh sách BDS nội bộ',
			'SCR_MENU_BDS_NEWS' => 'Thêm mới BDS',
			'SCR_MENU_QUY_HOACH' => 'Xem quy hoạch',
			'SCR_MENU_SUBSCRIPTION' => 'Video theo dõi Youtube',
			'SCR_MENU_REUP' => 'Video nhà cộng tác viên',
			'SCR_MENU_SEARCH' => 'Tìm videos bằng api',
			'SCR_MENU_SEARCH_YT' => 'Tìm videos youtube',
			'SCR_MENU_SEO_TOP' => 'SEO (Web/Youtube)',
			'SCR_MENU_GET_RSS_NEWS' => 'Lấy tin tự động',
			'SCR_MENU_HOME' => 'Trang chủ',
			
			
			//Screen Home
			'SCR_LABLE_LANGUAGE' => 'Ngôn ngữ',
			'SCR_LABLE_ABOUT' => 'Liên hệ',
				
			//Screen Search
			'SCR_SEARCH_USERS' => 'Người dùng hiện tại',
			'SCR_SEARCH_KEYWORD' => 'Từ tìm kiếm',
			'SCR_SEARCH_TYPE' => 'Tìm theo',
			'SCR_SEARCH_DATE_FROM' => 'Từ ngày',
			'SCR_SEARCH_DATE_TO' => 'Đến ngày',
			'SCR_SEARCH_MAXROW' => 'Số kết quả ( Max 50 )',
			'SCR_SEARCH_HD' => 'Video nổi bật',
			'SCR_SEARCH_LENGHT' => 'Thời lượng',
			'SCR_SEARCH_SORT' => 'Sắp xếp theo',
			'SCR_SEARCH_HD_ANY' => 'Bất kỳ',
			'SCR_SEARCH_HD_NORMAL' => 'Bình thường',
			'SCR_SEARCH_LENGHT_SHORT20' => 'Ngắn (< 20 phút)',
			'SCR_SEARCH_LENGHT_LONG' => 'Dài (> 20 phút)',
			'SCR_SEARCH_LENGHT_SHORT4' => 'Rất ngắn (< 4 phút)',
			'SCR_SEARCH_ORDER_DATE' => 'Ngày',
			'SCR_SEARCH_ORDER_RATING' => 'Đánh giá',
			'SCR_SEARCH_ORDER_SEARCH' => 'Lượng tìm kiếm',
			'SCR_SEARCH_ORDER_TITLE' => 'Theo tiêu đề',
			'SCR_SEARCH_ORDER_CHANNELVIDEO' => 'Lượng video kênh',
			'SCR_SEARCH_ORDER_VIEW' => 'Lượt xem',
			'SCR_SEARCH_GET_LINK' => 'Lấy link',
			'SCR_SEARCH_ADD_MANAGE' => 'Thêm vào theo dõi',
			'SCR_SEARCH_ADD_YOUMAN' => 'Theo dõi reup',
		
			//Screen Search results
			'SCR_SEARCH_UPLOAD_DATE' => 'Ngày tải lên',
			'SCR_SEARCH_LAST_HOUR' => 'Giờ qua',
			'SCR_SEARCH_TODAY' => 'Hôm nay',
			'SCR_SEARCH_THIS_WEEK' => 'Tuần này',
			'SCR_SEARCH_THIS_MONTH' => 'Tháng này',
			'SCR_SEARCH_THIS_YEAR' => 'Năm này',
			'SCR_SEARCH_TYPE' => 'Loại',
			'SCR_SEARCH_VIDEO' => 'Video',
			'SCR_SEARCH_CHANNEL' => 'Kênh',
			'SCR_SEARCH_PLAYLIST' => 'Danh sách phát',
			'SCR_SEARCH_MOVIE' => 'Phim',
			'SCR_SEARCH_SHOW' => 'Hiển thị',
			'SCR_SEARCH_DURATION' => 'Thời lượng',
			'SCR_SEARCH_SHORT4' => 'Ngắn (< 4 phút)',
			'SCR_SEARCH_LONG20' => 'Dài (> 20 phút)',
			'SCR_SEARCH_FEATURES' => 'Video nổi bật',
			'SCR_SEARCH_4K' => '4K',
			'SCR_SEARCH_HD' => 'HD',
			'SCR_SEARCH_SUB_CC' => 'Phụ đề',
			'SCR_SEARCH_CREATIVE_COMMONS' => 'Giấy phếp Creative Commons',
			'SCR_SEARCH_3D' => '3D',
			'SCR_SEARCH_LIVE' => 'Trực tiếp',
			'SCR_SEARCH_PURCHASED' => 'Đã mua',
			'SCR_SEARCH_360' => '360°',
			'SCR_SEARCH_SORT_BY' => 'Sắp xếp theo',
			'SCR_SEARCH_RELEVANCE' => 'Mức độ liên quan',
			'SCR_SEARCH_UPLOAD_DATE' => 'Ngày tải lên',
			'SCR_SEARCH_VIEW_COUNT' => 'Số lượt xem',
			'SCR_SEARCH_RATING' => 'Xếp hạng',
			'SCR_SEARCH_PAGE' => 'Trang',

			//Manage
			'SCR_MANAGE_RELOAD' => 'Reload trạng thái video hiện tại.',
		
			//News
			'SCR_NEWS_GENERAL_NEWS' => 'Tin tức tổng hợp',
		
			//Screen SeoTop
			'SCR_SEOTOP_YOUR_KEY' => 'Url của bạn',
			'SCR_SEOTOP_TOP_SEARCH' => 'Gới hạn trong top',
		
		),
		RwsConstant::LANGUAGE_JA => array (
			// Specified word
			'ROW' => '件',
			'ALL_ROWS' => '全件',
			'ALL' => '全て',
			'DATE' => '日付',
			// BUTTON
			'BTN_DISPLAY' => '表示',
			'BTN_VIEW' => '閲覧',
			'BTN_ADD' => '追加',
			'BTN_EDIT' => '編集',
			'BTN_SAVE' => '保存',
			'BTN_DELETE' =>'削除',
			'BTN_EXECUTE'=> '操作',
			'BTN_SETTING' =>'設定',
			'BTN_NEW_CREATE' => '新規作成',
			'BTN_CHOOSE' => '選択',
			'BTN_CHECK' => 'チェック',
			'BTN_SEND' => '送信',
			'BTN_CANCEL' => 'キャンセル',
			'BTN_CANCEL_1' => '取消',
			'BTN_RUN' => '実行',
			'BTN_CLEAR' => 'クリア',
			'BTN_INSERT' => '挿入',
			'BTN_STOP' => '中止',
			'BTN_REGISTER' => '登録',
			// DIALOG
			'TITLE_ALERT_DIALOG' => '警告',
			'TITLE_CONFIRM_DIALOG' => '確認',
			'TITLE_QUESTION_DIALOG' => '質問',
			'BTN_QUESTION_YES' => 'はい',
			'BTN_QUESTION_NO' => 'いいえ',
			'BTN_CONFIRM_CANCEL' => 'いいえ',
			
			// Login Screen
			'LOGIN_TITLE' => 'ログイン',
			'LOGIN_SCREEN_NAME' => 'ログイン',
			'LOGIN_USERNAME' => 'ユーザー名',
			'LOGIN_PASSWORD' => 'パスワード',
			'LOGIN_SUBMIT' => 'ログイン',
			'SCR_LOGIN_CREATE' => 'アカウントを作成',
			
			// Print Screen
			'BTN_PRINTPREVIEW' => '印刷プレビュー',
			
			//Edit user
			'BTN_EDITUSER_CHANGE' => 'アップデート',
			'BTN_EDITUSER_RUN' => '実行',
			'SCR_EDITUSER_CREATE' => 'Create new user:',
			'SCR_EDITUSER_USERLIST' => 'User list:',
			'SCR_EDITUSER_USERINFO' => 'User info:',
			'TITLE_EDIT_USER' => '編集ユーザー ',
								
			//Print Screen
			'PRINT_TITLE' => '印刷',
			
			//ユーザ個人設定変更
			'USERSETTING_PASSCHANGE' => 'パスワード変更',
			'USERSETTING_OLDPASS' => '旧パスワード ',
			'USERSETTING_NEWPASS' => '新パスワード',
			'USERSETTING_NEWPASSCNF' => '確認再入力',
			'USERSETTING_USERLANGUAGE' => '使用言語',
			'BTN_USERSETTING_PASS_CHANGE' => 'パスワード変更',
			'BTN_USERSETTING_USERLANGUAGE_CHANGE' => '使用言語変更',
			
			//Home
			'HOME_CATALOG_001' => '推奨されます',
			'HOME_CATALOG_002' => 'ムービー ',
			'HOME_CATALOG_003' => 'ビデオクリップ',
			'HOME_CATALOG_004' => 'ニュース',
			'HOME_CATALOG_005' => 'エンターテインメント',
			'HOME_CATALOG_NOTE_001' => 'hot news',
			
			//Menu
			'SCR_MENU_ADMIN' => '編集ユーザー ',
			'SCR_MENU_BDS_NEWS_LIST' => 'Danh sách BDS nội bộ',
			'SCR_MENU_BDS_NEWS' => 'Thêm mới BDS',
			'SCR_MENU_QUY_HOACH' => 'Xem quy hoạch',
			'SCR_MENU_SUBSCRIPTION' => 'サブスクリプション ',
			'SCR_MENU_REUP' => 'Video My home',
			'SCR_MENU_SEARCH' => '検索動画API',
			'SCR_MENU_SEARCH_YT' => '検索動画Youtube',
			'SCR_MENU_SEO_TOP' => 'Seo top web/youtube',
			'SCR_MENU_GET_RSS_NEWS' => 'Get rss news',
			'SCR_MENU_HOME' => 'ホーム',
			
			//Screen Home
			'SCR_LABLE_LANGUAGE' => '言語',
			'SCR_LABLE_ABOUT' => '連絡',
		
			//Screen Search
			'SCR_SEARCH_USERS' => 'ユーザーのリスト',
			'SCR_SEARCH_KEYWORD' => 'キーワード',
			'SCR_SEARCH_TYPE' => 'Search by',
			'SCR_SEARCH_DATE_FROM' => 'からの日',
			'SCR_SEARCH_DATE_TO' => 'までの日',
			'SCR_SEARCH_MAXROW' => '結果 ( Max 50 )',
			'SCR_SEARCH_HD' => 'HD',
			'SCR_SEARCH_LENGHT' => '長さ',
			'SCR_SEARCH_SORT' => 'オーダー',
			'SCR_SEARCH_HD_ANY' => '何か',
			'SCR_SEARCH_HD_NORMAL' => 'ノーマル',
			'SCR_SEARCH_LENGHT_SHORT20' => '短い（20 分以内）',
			'SCR_SEARCH_LENGHT_LONG' => '長い（20 分以上）',
			'SCR_SEARCH_LENGHT_SHORT4' => '短い（4 分以内）',
			'SCR_SEARCH_ORDER_DATE' => '日',
			'SCR_SEARCH_ORDER_RATING' => '評価',
			'SCR_SEARCH_ORDER_SEARCH' => 'Search count',
			'SCR_SEARCH_ORDER_TITLE' => 'タイトル',
			'SCR_SEARCH_ORDER_CHANNELVIDEO' => 'チャンネル回数',
			'SCR_SEARCH_ORDER_VIEW' => '視聴回数',
			'SCR_SEARCH_GET_LINK' => 'Get link',
			'SCR_SEARCH_ADD_MANAGE' => 'Add to subscriptions',
			'SCR_SEARCH_ADD_YOUMAN' => 'Save for reup',
		
			//Screen Search results
			'SCR_SEARCH_UPLOAD_DATE' => 'アップロード日',
			'SCR_SEARCH_LAST_HOUR' => '1 時間以内',
			'SCR_SEARCH_TODAY' => '今日',
			'SCR_SEARCH_THIS_WEEK' => '今週',
			'SCR_SEARCH_THIS_MONTH' => '今月',
			'SCR_SEARCH_THIS_YEAR' => '今年',
			'SCR_SEARCH_TYPE' => 'タイプ',
			'SCR_SEARCH_VIDEO' => '動画',
			'SCR_SEARCH_CHANNEL' => 'チャンネル',
			'SCR_SEARCH_PLAYLIST' => '再生リスト',
			'SCR_SEARCH_MOVIE' => '映画',
			'SCR_SEARCH_SHOW' => '番組',
			'SCR_SEARCH_DURATION' => '時間',
			'SCR_SEARCH_SHORT4' => '短い（4 分以内）',
			'SCR_SEARCH_LONG20' => '長い（20 分以上）',
			'SCR_SEARCH_FEATURES' => '特徴',
			'SCR_SEARCH_4K' => '4K',
			'SCR_SEARCH_HD' => 'HD',
			'SCR_SEARCH_SUB_CC' => '字幕',
			'SCR_SEARCH_CREATIVE_COMMONS' => 'クリエイティブ・コモンズ',
			'SCR_SEARCH_3D' => '3D',
			'SCR_SEARCH_LIVE' => 'ライブ',
			'SCR_SEARCH_PURCHASED' => '購入済み',
			'SCR_SEARCH_360' => '360°',
			'SCR_SEARCH_SORT_BY' => '並べ替え',
			'SCR_SEARCH_RELEVANCE' => '関連性の高い順',
			'SCR_SEARCH_UPLOAD_DATE' => 'アップロード日',
			'SCR_SEARCH_VIEW_COUNT' => '視聴回数',
			'SCR_SEARCH_RATING' => '評価',
			'SCR_SEARCH_PAGE' => 'Page',
				
			//Manage
			'SCR_MANAGE_RELOAD' => 'Reload video status.',
			
			//News
			'SCR_NEWS_GENERAL_NEWS' => '一般ニュース',
			
			//Screen SeoTop
			'SCR_SEOTOP_YOUR_KEY' => 'Seo top',
			'SCR_SEOTOP_TOP_SEARCH' => 'Top search',
		),
		RwsConstant::LANGUAGE_EN => array (
			// Specified word
			'ROW' => 'rows',
			'ALL_ROWS' => 'All',
			'ALL' => 'All',
			'DATE' => 'Date',
			// BUTTON
			'BTN_DISPLAY' => 'Display',
			'BTN_VIEW' => 'View',
			'BTN_ADD' => 'Add',
			'BTN_EDIT' => 'Edit',
			'BTN_SAVE' => 'Save',
			'BTN_DELETE' =>'Delete',
			'BTN_EXECUTE'=> 'Execute',
			'BTN_SETTING' =>'Setting',
			'BTN_NEW_CREATE' => 'Create New',
			'BTN_CHOOSE' => 'Choose',
			'BTN_CHECK' => 'Check',
			'BTN_SEND' => 'Send',
			'BTN_CANCEL' => 'Cancel',
			'BTN_CANCEL_1' => 'Cancel',
			'BTN_RUN' => 'Run',
			'BTN_CLEAR' => 'Clear',
			'BTN_INSERT' => 'Insert',
			'BTN_STOP' => 'Stop',
			'BTN_REGISTER' => 'Register',
			// DIALOG
			'TITLE_ALERT_DIALOG' => 'Alert',
			'TITLE_CONFIRM_DIALOG' => 'Confirm',
			'TITLE_QUESTION_DIALOG' => 'Question',
			'BTN_QUESTION_YES' => 'Yes',
			'BTN_QUESTION_NO' => 'No',
			'BTN_CONFIRM_CANCEL' => 'CANCEL',
			
			// Screen of MENU
			'SCR_USER_PROFILE' => 'User Personal Setting',
			'SCR_EDIT_SITE' => 'Site Editing',
			'SCR_EDIT_USER' => 'User Editing',
								
			// Login Screen
			'LOGIN_TITLE' => 'Login',
			'LOGIN_USERNAME' => 'Username',
			'LOGIN_PASSWORD' => 'Password',
			'LOGIN_SUBMIT' => 'login',
			'SCR_LOGIN_CREATE' => 'Create account',
			
			// Print Screen
			'BTN_PRINTPREVIEW' => 'Print Preview',
			
			//EDIT_USER
			'BTN_EDITUSER_CHANGE' => 'Change',
			'BTN_EDITUSER_RUN' => 'Run',
			'SCR_EDITUSER_CREATE' => 'Create new user:',
			'SCR_EDITUSER_USERLIST' => 'User list:',
			'SCR_EDITUSER_USERINFO' => 'User info:',
			'TITLE_EDIT_USER' => 'Edit user ',
		
			//Print Screen
			'PRINT_TITLE' => 'Print',
			
			//ユーザ個人設定変更
			'USERSETTING_PASSCHANGE' => 'Password change',
			'USERSETTING_OLDPASS' => 'Old password',
			'USERSETTING_NEWPASS' => 'New password',
			'USERSETTING_NEWPASSCNF' => 'New password confirm',
			'USERSETTING_USERLANGUAGE' => 'Use language',
			'BTN_USERSETTING_PASS_CHANGE' => 'Password change',
			'BTN_USERSETTING_USERLANGUAGE_CHANGE' => 'Use language change',
			
			//Home
			'HOME_CATALOG_001' => 'Recommended',
			'HOME_CATALOG_002' => 'Movies',
			'HOME_CATALOG_003' => 'Video clips',
			'HOME_CATALOG_004' => 'World news',
			'HOME_CATALOG_005' => 'Entertainment news',
			'HOME_CATALOG_NOTE_001' => 'hot news',
	
			//Menu
			'SCR_MENU_ADMIN' => 'Edit user',
			'SCR_MENU_BDS_NEWS_LIST' => 'Danh sách BDS nội bộ',
			'SCR_MENU_BDS_NEWS' => 'Thêm mới BDS',
			'SCR_MENU_QUY_HOACH' => 'Xem quy hoạch',
			'SCR_MENU_SUBSCRIPTION' => 'Subscriptions',
			'SCR_MENU_REUP' => 'Video My home',
			'SCR_MENU_SEARCH' => 'Search videos with api',
			'SCR_MENU_SEARCH_YT' => 'Search videos youtube',
			'SCR_MENU_SEO_TOP' => 'Seo top web/youtube',
			'SCR_MENU_GET_RSS_NEWS' => 'Get rss news',
			'SCR_MENU_HOME' => 'Home',
			
			//Screen Home
			'SCR_LABLE_LANGUAGE' => 'Language',
			'SCR_LABLE_ABOUT' => 'About',
		
			//Screen Search
			'SCR_SEARCH_USERS' => 'User list',
			'SCR_SEARCH_KEYWORD' => 'Keyword',
			'SCR_SEARCH_TYPE' => 'Search by',
			'SCR_SEARCH_DATE_FROM' => 'Date from',
			'SCR_SEARCH_DATE_TO' => 'Date to',
			'SCR_SEARCH_MAXROW' => 'Results ( Max 50 )',
			'SCR_SEARCH_HD' => 'HD',
			'SCR_SEARCH_LENGHT' => 'Lenght',
			'SCR_SEARCH_SORT' => 'Order by',
			'SCR_SEARCH_HD_ANY' => 'Anything',
			'SCR_SEARCH_HD_NORMAL' => 'Normal',
			'SCR_SEARCH_LENGHT_SHORT20' => 'Short (< 20 minutes)',
			'SCR_SEARCH_LENGHT_LONG' => 'Long (> 20 minutes)',
			'SCR_SEARCH_LENGHT_SHORT4' => 'Short (< 4 minutes)',
			'SCR_SEARCH_ORDER_DATE' => 'Date',
			'SCR_SEARCH_ORDER_RATING' => 'Rating',
			'SCR_SEARCH_ORDER_SEARCH' => 'Search count',
			'SCR_SEARCH_ORDER_TITLE' => 'Title',
			'SCR_SEARCH_ORDER_CHANNELVIDEO' => 'Video channel count',
			'SCR_SEARCH_ORDER_VIEW' => 'View count',
			'SCR_SEARCH_GET_LINK' => 'Get link',
			'SCR_SEARCH_ADD_MANAGE' => 'Add to subscriptions',
			'SCR_SEARCH_ADD_YOUMAN' => 'Save for reup',
		
			//Screen Search results
			'SCR_SEARCH_UPLOAD_DATE' => 'Upload date',
			'SCR_SEARCH_LAST_HOUR' => 'Last hour',
			'SCR_SEARCH_TODAY' => 'Today',
			'SCR_SEARCH_THIS_WEEK' => 'This week',
			'SCR_SEARCH_THIS_MONTH' => 'This month',
			'SCR_SEARCH_THIS_YEAR' => 'This year',
			'SCR_SEARCH_TYPE' => 'Type',
			'SCR_SEARCH_VIDEO' => 'Video',
			'SCR_SEARCH_CHANNEL' => 'Channel',
			'SCR_SEARCH_PLAYLIST' => 'Playlist',
			'SCR_SEARCH_MOVIE' => 'Movie',
			'SCR_SEARCH_SHOW' => 'Show',
			'SCR_SEARCH_DURATION' => 'Duration',
			'SCR_SEARCH_SHORT4' => 'Short (< 4 minutes)',
			'SCR_SEARCH_LONG20' => 'Long (> 20 minutes)',
			'SCR_SEARCH_FEATURES' => 'Features',
			'SCR_SEARCH_4K' => '4K',
			'SCR_SEARCH_HD' => 'HD',
			'SCR_SEARCH_SUB_CC' => 'Subtitles/CC',
			'SCR_SEARCH_CREATIVE_COMMONS' => 'Creative Commons',
			'SCR_SEARCH_3D' => '3D',
			'SCR_SEARCH_LIVE' => 'Live',
			'SCR_SEARCH_PURCHASED' => 'Purchased',
			'SCR_SEARCH_360' => '360°',
			'SCR_SEARCH_SORT_BY' => 'Sort by',
			'SCR_SEARCH_RELEVANCE' => 'Relevance',
			'SCR_SEARCH_UPLOAD_DATE' => 'Upload date',
			'SCR_SEARCH_VIEW_COUNT' => 'View count',
			'SCR_SEARCH_RATING' => 'Rating',
			'SCR_SEARCH_PAGE' => 'Page',
			
			//Manage
			'SCR_MANAGE_RELOAD' => 'Reload video status.',
		
			//News
			'SCR_NEWS_GENERAL_NEWS' => 'General news',
		
			//Screen SeoTop
			'SCR_SEOTOP_YOUR_KEY' => 'Seo top',
			'SCR_SEOTOP_TOP_SEARCH' => 'Top search',
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