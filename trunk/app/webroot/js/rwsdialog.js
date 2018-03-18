function openPopup(url, _width, _height) {
	event.preventDefault();
	var w = 'auto';
	var h = 'auto';
	if (_width !== null && _width !== '') {
		w = _width;
	}
	if (_height !== null && _height !== '') {
		h = _height;
	}
	// Check if Modal already open
	if (!$('#id_div_modal').dialog('isOpen')) {
		$('#id_div_modal').empty();
		$('#id_div_modal' ).load(url).dialog('open');
	}
	//open the dialog
	else {
		$( '<div id="id_div_modal"></div>' ).load(url).dialog({
			autoOpen: true,
			dialogClass: "no-close",
			closeOnEscape: false,
			modal: true,
			resizable: false,
			width: w,
			height: h,
			closeText: 'close',
			show: 'fold',
			hide: null,
			position:['middle', 200],
			open: function() {
				$('body').css('height', window.innerHeight);
				$('.ui-widget-overlay').css('height', $(document).innerHeight());
				$('.ui-widget-overlay').css('width', $(document).innerWidth());
			}
		});
	}
}

function closePopup(obj) {
	obj.closest('.ui-dialog-content').dialog("option", "hide", "scale").dialog("close");
}

function openAlertDialog(message) {
	var is_opened = false;
	if ($('#id_div_alert_dialog').length > 0) {
		is_opened = true;
	}
	if (is_opened) {
		if (!$('#id_div_alert_dialog').dialog('isOpen')) {
			$('#id_div_alert_dialog').empty();
			$('#id_div_alert_dialog' ).html('<div style="padding: 10px 0;"><h6>' + message + '</h6></div>').dialog('open');
		}
	}
	//open the dialog
	else {
		$('<div id="id_div_alert_dialog"></div>').html('<div style="padding: 10px 0;"><h6>' + message + '</h6></div>').dialog({
				autoOpen: true,
				closeOnEscape: true,
				modal: true,
				resizable: false,
				title: TITLE_ALERT_DIAGLOG,
				closeText: 'close',
				show: 'drop',
				hide: 'scale',
				buttons : {
					OK : function() {
						$(this).dialog("close");
					}
				},
				open: function() {
					$('body').css('height', window.innerHeight);
					$('.ui-widget-overlay').css('height', $(document).innerHeight());
					$('.ui-widget-overlay').css('width', $(document).innerWidth());
				}
		});
	}
}

function openConfirmDialog(message, params) {
	var buttonsOpts = {};
	buttonsOpts[BTN_CONFIRM_CANCEL] = function() {
		$(this).dialog("close");
		dialogCallback(false, params);
	};
	buttonsOpts['OK'] = function() {
		$(this).dialog("close");
		dialogCallback(true, params);

	};
	var is_opened = false;
	if ($('#id_div_confirm_dialog').length > 0) {
		is_opened = true;
	}
	if (is_opened) {
		if (!$('#id_div_confirm_dialog').dialog('isOpen')) {
			$('#id_div_confirm_dialog').empty();
			$('#id_div_confirm_dialog').dialog('option', {buttons : buttonsOpts});
			$('#id_div_confirm_dialog' ).html('<div style="padding: 10px 0;"><h6>' + message + '</h6></div>').dialog('open');
		}
	}
	//open the dialog
	else {
		$('<div id="id_div_confirm_dialog"></div>').html('<div style="padding: 10px 0;"><h6>' + message + '</h6></div>')
			.dialog({
				autoOpen : true,
				closeOnEscape : true,
				modal : true,
				resizable : false,
				title : TITLE_CONFIRM_DIAGLOG,
				closeText: 'close',
				show: 'drop',
				hide: 'scale',
				buttons : buttonsOpts,
				open: function() {
					$('body').css('height', window.innerHeight);
					$('.ui-widget-overlay').css('height', $(document).innerHeight());
					$('.ui-widget-overlay').css('width', $(document).innerWidth());
				}
			});
	}
}

function openQuestionDialog(message, params) {
	var buttonsOpts = {};
	buttonsOpts[BTN_QUESTION_NO] = function() {
		$(this).dialog("close");
		dialogCallback(false, params);
	};
	buttonsOpts[BTN_QUESTION_YES] = function() {
		$(this).dialog("close");
		dialogCallback(true, params);

	};
	var is_opened = false;
	if ($('#id_div_question_dialog').length > 0) {
		is_opened = true;
	}
	if (is_opened) {
		if (!$('#id_div_question_dialog').dialog('isOpen')) {
			$('#id_div_question_dialog').empty();
			$('#id_div_question_dialog').dialog('option', {buttons : buttonsOpts});
			$('#id_div_question_dialog' ).html('<div style="padding: 10px 0;"><h6>' + message + '</h6></div>').dialog('open');
		}
	}
	//open the dialog
	else {
		$('<div id="id_div_question_dialog"></div>').html('<div style="padding: 10px 0;"><h6>' + message + '</h6></div>')
			.dialog({
				autoOpen : true,
				closeOnEscape : true,
				modal : true,
				resizable : false,
				title : TITLE_QUESTION_DIALOG,
				closeText: 'close',
				show: 'drop',
				hide: 'scale',
				buttons : buttonsOpts,
				open: function() {
					$('body').css('height', window.innerHeight);
					$('.ui-widget-overlay').css('height', $(document).innerHeight());
					$('.ui-widget-overlay').css('width', $(document).innerWidth());
				}
			});
	}
}

function dialogCallback(selected, params){}