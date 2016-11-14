
$(".star-off").on('click', function () {
	
	if ($(this).hasClass("star-on")){
		$(this).removeClass("star-on");
	} else {
		$(this).addClass("star-on");
	}

})




// $(".star-off").click(function () {
// 	if($('a').hasClass('.star-off')){
// 		$('a').addClass('star-on')
// 	}
// });