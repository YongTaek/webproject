function lectureReady(){
  $("#submit").click(function (event){
    $.ajax({
      url: "../php/create_comment.php",
      type : "POST",
      context: $("#input").value
    }).done(function (data) {
      if(!data['error']){
        alert("등록 에러! X(");
      };
    });
  });
  
  function appendComment(data){

  };

  var comment = $("#comment");

  $('#side').click(function (event) {
    var effect = 'slide';
    var options = { direction: "right"};
    var duration = 500;
    $('#sidebar').toggle("slide", { direction : "right" }, 500, function () {
      changeDrawerClass(event);
    });
  })

};

function changeDrawerClass(event) {
  if($(event.target).hasClass('opendrawer')) {
    $(event.target).removeClass('opendrawer');
    $(event.target).addClass('closedrawer');
  } else {
    $(event.target).addClass('opendrawer');
    $(event.target).removeClass('closedrawer');
  }
}

$(document).ready(lectureReady);

Pusher.logToConsole = true;

var pusher = new Pusher('dc9f3fc01f0f63f45083', {
	encrypted: true
});

var channel = pusher.subscribe('test_channel');
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
	toastr.error(data.message, '질문 실패');
	// 골라서 쓰기
});
