function lectureReady(){
  $("#submit").click(function (event){
    var params = $(this).parent().serialize();
    console.log(params);
    $.ajax({
      url: "../php/create_comment.php",
      type : "POST",
      data: params,
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      dataType: "json"
    }).done(function (da) {
      // var da = $.parseJSON(data);
      if(da.error == "true"){
        alert("등록 에러! X(");
      }
      else{
        // appendComment(da);
      }
    });
  });

  var comment = $("#comment");

  $('#side').click(function (event) {
    var effect = 'slide';
    var options = { direction: "right"};
    var duration = 500;
    $('#sidebar').toggle("slide", { direction : "right" }, 500, function () {
      changeDrawerClass(event);
    });
  });
};

function changeDrawerClass(event) {
  if($(event.target).hasClass('opendrawer')) {
    $(event.target).removeClass('opendrawer');
    $(event.target).addClass('closedrawer');
  } else {
    $(event.target).addClass('opendrawer');
    $(event.target).removeClass('closedrawer');
  };
};

function appendComment(da){
  // var da = $.parseJSON(data);
  var content = da.content;
  // var content = "hello";
  var time = da.time;
  // var time = "2016.12.08 6:45pm";
  var name = da.name;
  // var name = "익명";

  var div = $("<div></div>");

  var spancontent = $("<span></span>").text(content);
  spancontent.addClass("content");
  var spandate = $("<span></span>").text(time);
  spandate.addClass("date");
  var spanwriter = $("<span></span>").text(name);
  spanwriter.addClass("writer");

  div.append(spancontent);
  div.append($("<br>"));
  div.append(spanwriter);
  div.append($("<br>"));
  div.append(spandate);
  div.addClass("thread");
  $(".threads").append(div);
  $("#input").val("");

  $(".threads").animate({scrollTop: $(".threads").prop("scrollHeight")});
};

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

$(window).load(function(){
  $(".threads").scrollTop($(".threads").prop("scrollHeight"));
})