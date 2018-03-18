var numCol = 12;
/**
 * 
 * @param time
 * @returns {Number}
 */
function getNumRow (time) {
	if (time.includes(":30")) {
		return;
	} 
	if (time.includes(":00")){
		var time_from = Number(time.replace(":00",""));
		return 24-time_from+6;
	}
}
/**
 * 
 * @param num_row
 * @param time
 */
function addTimeIntoTbl (num_row, time) {
	var t = Number(time.replace(":00",""));
	for (var i = 0; i < num_row - 4; i++) {
		$("#td_"+i+"_0").html(t+":00");
		t = t + 1;
	}
	$("#td_"+(num_row - 5)+"_0").html("合計");
	$("#td_"+(num_row - 4)+"_0").html("平均");
	$("#td_"+(num_row - 3)+"_0").html("最大");
	$("#td_"+(num_row - 2)+"_0").html("最小");
}
/**
 * create first header name
 * @param date_str
 */
function getFirstHeaderName(date_str, report_type) {
	// get year
	date1 = moment(date_str).locale("ja").format('YYYY[年]');
	// get month & day of month
	date2 = moment(date_str).locale("ja").format('MMM Do[日]');
	// get day of week
	dayOfWeek = moment(date_str).locale("ja").format('dd');
	// return
	switch (report_type) {
	case "daily":
		return date1+'<br>'+date2+'<br>'+'('+dayOfWeek+')';

	default:
		break;
	}
} 
/**
 * create sample table
 * @param number of colunm
 */
function mkTbl(id_table_div, num_col) {
	var myTableDiv = document.getElementById(id_table_div);
	while (myTableDiv.hasChildNodes()) {
		myTableDiv.removeChild(myTableDiv.firstChild);
	}
	
	// table
	var table = document.createElement('table');
		table.className = 'list-table';
	
	// first thead 
	var tableHead = document.createElement('thead');
		table.appendChild(tableHead);
		
	var tr = document.createElement('tr');
		tableHead.appendChild(tr);
	for (var j = 0; j < num_col; j++) {
		var th = document.createElement('th');
			th.width='75';
			// if j == 0
			if (j == 0) {
				th.setAttribute('rowSpan','2');
			} else {
				
			}
			th.setAttribute('id','th_1_'+j);
			tr.appendChild(th);
	}
	// second thead 
	var tr = document.createElement('tr');
		tableHead.appendChild(tr);
	for (var j = 0; j < num_col - 1; j++) {
		var th = document.createElement('th');
			th.width='75';
			th.setAttribute('id','th_2_'+j);
			tr.appendChild(th);
	}
	
	// tbody
	var tableBody = document.createElement('tbody');
	tableBody.style.textAlign = 'center';
	table.appendChild(tableBody);
	for (var i = 0; i < num_col - 1; i++){
		var tr = document.createElement('tr');
			tableBody.appendChild(tr);
		for (var j=0; j < num_col; j++){
			var td = document.createElement('td');
				td.width='75';
				td.setAttribute('id','td_'+i+'_'+j);
				tr.appendChild(td);
		}
	}
	myTableDiv.appendChild(table);
}
/**
 * create daily report
 * @param id_table_div
 */
function dailyReport(id_table_div, data, report_type) {
	var name = getFirstHeaderName(data.date, report_type);
	var num_row = getNumRow(data.time);
	mkTbl(id_table_div, num_row);
	// first header name
	$("#th_1_0").html(name);
	// add time into first cells
	addTimeIntoTbl (num_row, data.time);
}