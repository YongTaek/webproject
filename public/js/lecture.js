
function slidebar() {
  var sidebar = $("#sidebar");
  // submenu 가 화면상에 보일때는 위로 보드랍게 접고 아니면 아래로 보드랍게 펼치기
  $('#side').click(function () {
    var effect = 'slide';
    var options = {direction: 'right'};
    var duration = 500;

    sidebar.toggle(duration);
  })

  // var slide = $("#side");
  // if (slide.is(":visible")) {
  //   slide.slideUp();
  // } else {
  //   slide.slideDown();
  // }
}
$(document).ready(slidebar);
