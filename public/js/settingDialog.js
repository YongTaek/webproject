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
    dataType: 'text',
    success: function (responseText) {
      console.log(responseText);
    },
    error: function (e) {
      console.log(e.responseText);
    }
  });
}

function saveAssistant() {
	var aid = $("#dialogAssID").val();
	var aname = $("#dialogAssName").val();
	console.log('!');
	console.log(aid);

	$("#saveAss").ajaxForm({
    dataType: 'text',
    success: function (responseText) {
      console.log(responseText);
    },
    error: function (e) {
      console.log(e.responseText);
    }
  });
}