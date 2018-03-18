var ajaxRunning = false;
var MESSAGE_ERROR_AJAX = "AJAX error.";

/**
 * Upload image with preview
 * @param id_form
 * @param id_input_file
 * @param id_image_thumbnail
 * @param id_last_upload_file
 * @param id_div_image_thumbnail
 * @param image_index
 * @returns {Boolean}
 */
function upload_image(id_form, id_input_file, id_image_thumbnail, id_last_upload_file, id_div_image_thumbnail, image_index) {
	if (ajaxRunning == true) {
		return;
	}
	var file_obj = $('#' + id_input_file);
	var img_thumb_obj = $('#' + id_image_thumbnail);
	var div_img_thumb_obj = $('#' + id_div_image_thumbnail);
	var last_upload_file_obj = $('#' + id_last_upload_file);
	var form_obj = $('#' + id_form);
	// Validate upload image
	var err_msg = validate_image(file_obj);
	if (err_msg !== '') {
		openAlertDialog(err_msg);
		return false;
	}
	// Upload process
	ajaxRunning = true;
	var options = {
		type : 'POST',
		url : '/upload/uploadImage',
		dataType : 'json',
		cache : false,
		data : {
			last_file: last_upload_file_obj.val(),
			index: image_index
		},
		success : function(data) {
			ajaxRunning = false;
			if (data.success) {
				div_img_thumb_obj.hide();
				img_thumb_obj.attr('src', IMAGE_TMP_PATH + data.src);
				last_upload_file_obj.val(data.src);
				div_img_thumb_obj.show('slow');
			} else {
				div_img_thumb_obj.hide();
				openAlertDialog(data.error);
			}
		},
		fail : function(jqXHR, textStatus) {
			ajaxRunning = false;
			openAlertDialog(MESSAGE_ERROR_AJAX);
		}
	};
	// bind form using 'ajaxForm'
	form_obj.ajaxSubmit(options);
	return false;
}

/**
 * Validate upload image
 * @param file_obj
 * @returns
 */
function validate_image(file_obj) {
	// check whether browser fully supports all File API
	if (window.File && window.FileReader && window.FileList && window.Blob) {
		if (!file_obj.val()) {// check empty input filed
			return false;
		}
		// get file size
		var fsize = file_obj[0].files[0].size;
		// get file type
		var ftype = file_obj[0].files[0].type;
		// allow only valid image file types
		switch (ftype) {
		case 'image/png':
		case 'image/gif':
		case 'image/jpeg':
		case 'image/pjpeg':
			break;
		default:
			return "Unsupported file type!";
		}
		// Allowed file size is less than 1 MB (1048576)
		if (fsize > 1048576) {
			return "File size <b>" + fsize + "</b> is too large. Please upload smaller image size!";
		}
		return "";
	} else {
		// Output error to older browsers that do not support HTML5 File API
		return "Browser is un-supported! Please upgrade!";
	}
}

/**
 * Upload file
 * 
 * @param id_form
 * @param id_input_file
 * @param id_last_upload_file
 * @param rename_flag
 * @param file_index
 * @returns {Boolean}
 */
function upload_file(id_form, id_input_file, id_last_upload_file, rename_flag, file_index) {
	if (ajaxRunning == true) {
		return;
	}
	
	var file_obj = $('#' + id_input_file);
	var last_upload_file_obj = $('#' + id_last_upload_file);
	var form_obj = $('#' + id_form);
	if (typeof file_index === 'undefined') {
		file_index = '';
	}
	// Validate file type, allowed file size is less than 1 MB (1048576)
//	var err_msg = validate_file_type(file_obj, ['txt', 'pdf', 'csv'], 1048576);
//	if (err_msg !== '') {
//		openAlertDialog(err_msg);
//		return false;
//	}
	// Upload process
	ajaxRunning = true;
	var options = {
		type : 'POST',
		url : '/upload/uploadFile',
		dataType : 'json',
		cache : false,
		data : {
			last_file: last_upload_file_obj.val(),
			rename_flag: rename_flag,
			index: file_index
		},
		success : function(data) {
			ajaxRunning = false;
			if (data.success) {
				last_upload_file_obj.val(data.src);
				return true;
			} else {
				openAlertDialog(data.error);
				return false;
			}
		},
		fail : function(jqXHR, textStatus) {
			ajaxRunning = false;
			openAlertDialog(MESSAGE_ERROR_AJAX);
			return false;
		}
	};
	// bind form using 'ajaxForm'
	form_obj.ajaxSubmit(options);
	return true;
}

/**
 * Validate upload file
 * @param file_obj
 * @param file_type_arr
 * @param max_size_limit
 * @returns
 */
function validate_file_type(file_obj, file_type_arr, max_size_limit) {
	// check whether browser fully supports all File API
	if (window.File && window.FileReader && window.FileList && window.Blob) {
		if (!file_obj.val()) {// check empty input filed
			return false;
		}
		// get file size
		var fsize = file_obj[0].files[0].size;
		// get file type
		var fname = file_obj[0].files[0].name;
		var ftype = fname.substr( (fname.lastIndexOf('.') +1) );
//		var ftype = file_obj[0].files[0].type;
		
		// allow only valid image file types
		var found_flag = false;
		for (var i = 0; i < file_type_arr.length; i++) {
			var file_type = file_type_arr[i];
			if (file_type === ftype) {
				found_flag = true;
				break;
			}
		}
		if (!found_flag) {
			return "Unsupported file type!";
		}
		
		if (fsize > max_size_limit) {
			return "File size <b>" + fsize + "</b> is too large. Please upload smaller image size!";
		}
		return "";
	} else {
		// Output error to older browsers that do not support HTML5 File API
		return "Browser is un-supported! Please upgrade!";
	}
}

function download_file(file_name) {
	if (file_name != null && file_name != '') {
		// Create a dynamic iframe for form target
		$("iframe").remove();
		$("body").append('<iframe id="id_hdn_iframe" name="id_hdn_iframe" style="display: none;"></iframe>');
		// Get form & set target
		var form = $('<form action="/download/downloadFile" method="post" accept-charset="utf-8"></form>').get(0);
		form.action = '/download/downloadFile?file=' + file_name;
		form.target = 'id_hdn_iframe';
		form.submit();
		
		$('#id_hdn_iframe').bind("load", function() {
//			var result = $(this).contents().find("body").html();
			alert($(this).contents());
//			if (result !== '') {
//				return false;
//			}
		});
	}
}

/**
 * Upload audio
 * 
 * @param id_form
 * @param id_input_file
 * @param id_last_upload_audio
 * @param rename_flag
 * @param audio_index
 * @returns {Boolean}
 */
function upload_audio(id_form, id_input_audio, id_last_upload_audio, rename_flag, audio_index) {
	if (ajaxRunning == true) {
		return;
	}
	
	var file_obj = $('#' + id_input_audio);
	var last_upload_file_obj = $('#' + id_last_upload_audio);
	var clone_file_obj = file_obj.clone(true);
	var form_obj = $('#' + id_form);
	if (typeof audio_index === 'undefined') {
		audio_index = '';
	}
	// Validate file type, allowed file size is less than 1 MB (1048576)
	var err_msg = validate_file_type(file_obj, ['mp3', 'wav', 'wma'], 1048576);
	if (err_msg !== '') {
		openAlertDialog(err_msg);
		return false;
	}
	// Upload process
	ajaxRunning = true;
	var options = {
		type : 'POST',
		url : '/upload/uploadAudio',
		dataType : 'json',
		cache : false,
		data : {
			last_file: last_upload_file_obj.val(),
			rename_flag: rename_flag,
			index: audio_index
		},
		success : function(data) {
			ajaxRunning = false;
			if (data.success) {
				last_upload_file_obj.val(data.src);
			} else {
				openAlertDialog(data.error);
			}
		},
		fail : function(jqXHR, textStatus) {
			ajaxRunning = false;
			openAlertDialog(MESSAGE_ERROR_AJAX);
		}
	};
	// bind form using 'ajaxForm'
	form_obj.ajaxSubmit(options);
	return false;
}

/**
 * Validate upload file
 * @param file_obj
 * @param file_type_arr
 * @param max_size_limit
 * @returns
 */
function validate_file_type(file_obj, file_type_arr, max_size_limit) {
	// check whether browser fully supports all File API
	if (window.File && window.FileReader && window.FileList && window.Blob) {
		if (!file_obj.val()) {// check empty input filed
			return false;
		}
		// get file size
		var fsize = file_obj[0].files[0].size;
		// get file type
		var fname = file_obj[0].files[0].name;
		var ftype = fname.substr( (fname.lastIndexOf('.') +1) );
//		var ftype = file_obj[0].files[0].type;
		
		// allow only valid image file types
		var found_flag = false;
		for (var i = 0; i < file_type_arr.length; i++) {
			var file_type = file_type_arr[i];
			if (file_type === ftype) {
				found_flag = true;
				break;
			}
		}
		if (!found_flag) {
			return "Unsupported file type!";
		}
		
		if (fsize > max_size_limit) {
			return "File size <b>" + fsize + "</b> is too large. Please upload smaller image size!";
		}
		return "";
	} else {
		// Output error to older browsers that do not support HTML5 File API
		return "Browser is un-supported! Please upgrade!";
	}
}