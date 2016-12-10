$(document).ready(function () {
	$("#saveDialogStudent").on('click', saveStudent);
	$("#saveDialogAssistant").on('click', saveAssistant);
});

function saveStudent() {
	var sid = $("#dialogStuID").val();
	var sname = $("#dialogStuName").val();
	console.log('*');
	console.log(sid);

	$("#saveStu").ajaxForm({
		url: "save_student.php",
		enctype: "multipart/form-data",
    dataType: 'text',
    success: function (responseText) {
      console.log(responseText);
    },
    error: function (e) {
      console.log(e.responseText);
    }
  });

  $("#saveStu").submit();
}

function saveAssistant() {
	var aid = $("#dialogAssID").val();
	var aname = $("#dialogAssName").val();
	console.log('!');
	console.log(aid);

	$.ajax({
		url: "save_assistant.php",
		type: "POST",
		data: {
			id: aid,
			name: aname
		},
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
    dataType: 'text',
    success: function (responseText) {
    	window.location.href = "/php/setting.php";
    },
    error: function (e) {
      console.log(e.responseText);
    }
  });
}