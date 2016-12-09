function saveFromDialog(){

	$("#saveDialogStudent").on('click', function () { //여기서는 파일로 가져오는거랑 폼으로 입력받는거 2개 다!
		var sid = $("#dialogStuID").val();
		var sname = $("#dialogStuName").val();
		console.log('*');
		console.log(sid);
		
	});

	$("#saveDialogAssistant").on('click', function () {
		var aid = $("#dialogAssID").val();
		var aname = $("#dialogAssName").val();
		console.log('!');
		console.log(aid);
	});
}

$(document).ready(saveFromDialog);