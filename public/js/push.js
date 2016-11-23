
Pusher.logToConsole = true;

var pusher = new Pusher('dc9f3fc01f0f63f45083', {
	encrypted: true
});

var channel = pusher.subscribe('test_channel');
channel.bind('my_event', function(data) {
	// var push = document.getElementById("push");
	// push.innerHTML = "<p>"+data.message+"</p>";
	toastr.info('Are you the 6 fingered man?');

	// alert(data.message);
});



