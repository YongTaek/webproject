console.log(questionArray);
console.log(lectureArray);
Pusher.logToConsole = true;

var pusher = new Pusher('dc9f3fc01f0f63f45083', {
	encrypted: true
});
for (var i = 0; i < questionArray.length; i++) {
  var channel = pusher.subscribe(questionArray[i]);
  channel.bind('new_comment', function(data) {
  	// https://github.com/CodeSeven/toastr#escape-html-characters
  	// http://codeseven.github.io/toastr/demo.html
  	toastr.options = {
  		"closeButton": true,
  		"debug": false,
  		"newestOnTop": false,
  		"progressBar": false,
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
  	toastr.error(data, '질문 실패');
  	// 골라서 쓰기
  });
}
for (var i = 0; i < lectureArray.length; i++) {
  var channel = pusher.subscribe(lectureArray[i]);
  channel.bind('new_comment', function(data) {
  	// https://github.com/CodeSeven/toastr#escape-html-characters
  	// http://codeseven.github.io/toastr/demo.html
  	toastr.options = {
  		"closeButton": true,
  		"debug": false,
  		"newestOnTop": false,
  		"progressBar": false,
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
  	toastr.error(data, '질문 실패');
  	// 골라서 쓰기
  });
}
