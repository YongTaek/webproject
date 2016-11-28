$(".plusBtn").click(function(){
	var list = $('.voteitem');
	if(list.length != 0) {
		$('.voteitem').last().after('<li class = \"voteitem\"><input type=\"text\" name=\"item\" value=""></li>');
	} else {
		$('ul').append('<li class = \"voteitem\"><input type=\"text\" name=\"item\" value=""></li>');
	}
});

$(".minusBtn").click(function(){
	$('li').last().remove();
});

$(document).ready(function(){
    // menu 클래스 바로 하위에 있는 a 태그를 클릭했을때
    $("#voteBtn").click(function(){

    	var submenu = $(this).next("#vote");
            // submenu 가 화면상에 보일때는 위로 보드랍게 접고 아니면 아래로 보드랍게 펼치기
        if( submenu.is(":visible") ){
          	submenu.slideUp();
            $("#vote-result").val("결과 숨기기");
        }else{
           	submenu.slideDown();
            $("#vote-result").val("결과 보기");
        }
    });
});

$("#voteBtn").mouseover(function(){
	this.src = '/public/img/vote-box-color.png';

});

$("#voteBtn").mouseout(function(){
	this.src = '/public/img/vote-box.png';
});