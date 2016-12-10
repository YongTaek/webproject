$(document).ready(function () {
	$("#saveDialogStudent").on('click', saveStudent);
	$("#saveDialogAssistant").on('click', saveAssistant);
	$(".reset-student, .reset-assistant").on('click', passwd_reset);
});

function passwd_reset() {
	var sid = $(this).parent().parent().children().contents()[1].textContent;
	console.log(sid);

	$.ajax({
		url: "/api/user/reset-password.php",
		type: "POST",
		data: {
			id: sid
		},
		success: function (data) {
			if (data.error === "false") {
				alert("비밀번호를 초기화했습니다.");
			}
		},
		error: function (e) {
			console.log(e);
		}
	});
}

function saveStudent() {
	var sid = $("#dialogStuID").val();
	var sname = $("#dialogStuName").val();
	console.log('*');
	console.log(sid);

	$("#saveStu").ajaxForm({
		url: "/api/user/save-student.php",
		enctype: "multipart/form-data",
    success: function (data) {
      if (data.error === "false") {
      	window.location.href = "/user/setting.php";
      }
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
		url: "/api/user/save-assistant.php",
		type: "POST",
		data: {
			id: aid,
			name: aname
		},
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
    success: function (data) {
    	if (data.error === "false") {
    		window.location.href = "/user/setting.php";
    	}
    },
    error: function (e) {
      console.log(e.responseText);
    }
  });
}