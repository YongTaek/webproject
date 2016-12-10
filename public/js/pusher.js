console.log(questionArray);
console.log(lectureArray);
Pusher.logToConsole = false;

var pusher = new Pusher('dc9f3fc01f0f63f45083', {
	encrypted: true
});

for (var i = 0; i < questionArray.length; i++) {
	var channel = pusher.subscribe(questionArray[i]);
	channel.bind('new_comment', function(data) {
		// https://github.com/CodeSeven/toastr#escape-html-characters
		// http://codeseven.github.io/toastr/demo.html
		$("#notification").text(parseInt($("#notification").text()) + 1);
		var a = $(makeNotification(notification));
		("#notifications").append(a);
		var link = document.location.href;
		toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": false,
			"progressBar": false,
			"onclick" : function () {
				a.remove();
				$("#notification").text(parseInt($("#notification").text()) - 1);
				sendReadMessage(data);
				// window.location.href = data.url;
			},
			"positionClass": "toast-top-right",
			"preventDuplicates": true,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "10000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		};

		//toastr.info(data.message,'질문 등록');
		// toastr.warning(data.message, '질문 경고');
		//toastr.success(data.message, '질문 등록 성공');
		// toastr.error(data, '질문 실패');
		Command: toastr["info"](data.content);
		// 골라서 쓰기
	});
}
function makeNotification(notification) {
	var a = document.createElement("a");
	a.setAttribute("class", "notification");
	var div = document.createElement("div");
	var contentP = document.createElement("p");
	var timeP = document.createElement("p");

	contentP.innerHTML = notification.content;
	timeP.innerHTML = notification.content;
	div.append(contentP);
	div.append(timeP);
	a.append(div);
	return a;
}
function sendReadMessage(notification) {
	$.ajax({
		url: '/php/read_notification.php',
		type : "POST",
		data : { data : notification },
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		dataType: 'json',
		success : function (result) {
			console.log(result);
		},
		error : function (result) {
			console.log(result);
		}
	});
}

for (var i = 0; i < lectureArray.length; i++) {
	var channel = pusher.subscribe(lectureArray[i]);
	channel.bind('new_comment', function(data) {
		// https://github.com/CodeSeven/toastr#escape-html-characters
		// http://codeseven.github.io/toastr/demo.html
		var link = document.location.href;
		if (link === data.url) {
			appendComment(data);
		} else {
			toastr.options = {
				"closeButton": true,
				"debug": false,
				"newestOnTop": false,
				"progressBar": false,
				"onclick" : function () {
					window.location.href = data.url;
				},
				"positionClass": "toast-top-right",
				"preventDuplicates": true,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "10000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			};

			//toastr.info(data.message,'질문 등록');
			// toastr.warning(data.message, '질문 경고');
			//toastr.success(data.message, '질문 등록 성공');
			// toastr.error(data, '질문 실패');
			// 골라서 쓰기
			Command: toastr["info"](data.content);
		}
	});
}
