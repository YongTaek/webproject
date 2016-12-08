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
