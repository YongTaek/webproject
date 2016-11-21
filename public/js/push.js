
Pusher.logToConsole = true;

var pusher = new Pusher('dc9f3fc01f0f63f45083', {
	encrypted: true
});

var channel = pusher.subscribe('test_channel');
channel.bind('my_event', function(data) {
	// var push = document.getElementById("push");
	// push.innerHTML = "<p>"+data.message+"</p>";

	toastr.info('XXX에 질문이 등록 되었습니다','질문 등록');

	// alert(data.message);
});



