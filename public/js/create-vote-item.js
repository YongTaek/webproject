$(".plusBtn").click(function(){
	if(list.length != 0) {
		$('.item').last().after('<li class = \"item\"><input type=\"text\" name=\"item\" value=""></li>');
	} else {
		$('ul').append('<li class = \"item\"><input type=\"text\" name=\"item\" value=""></li>');
	}
});

$(".minusBtn").click(function(){
	$('li').last().remove();
});