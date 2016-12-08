function LectureReady(){
  $("#submit").click(function (event){
    $.ajax({
      
    })
  })
}
function slidebar() {
  var comment = $("#comment");

  $('#side').click(function (event) {
    var effect = 'slide';
    var options = { direction: "right"};
    var duration = 500;
    $('#sidebar').toggle("slide", { direction : "right" }, 500, function () {
      changeDrawerClass(event);

    });
  })
}

function changeDrawerClass(event) {
  if($(event.target).hasClass('opendrawer')) {
    $(event.target).removeClass('opendrawer');
    $(event.target).addClass('closedrawer');
  } else {
    $(event.target).addClass('opendrawer');
    $(event.target).removeClass('closedrawer');
  }
}
$(document).ready(slidebar);
