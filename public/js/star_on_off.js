
$(".star-off").on('click', function () {
	
	if ($(this).hasClass("star-on")){
		$(this).removeClass("star-on");
	} else {
		$(this).addClass("star-on");
	}

})

$(".pin-off").on('click', function(){

	if($(this).hasClass("pin-on")){
		$(this).removeClass("pin-on");
	} else{
		$(this).addClass("pin-on");
	}
})



// $(".star-off").click(function () {
// 	if($('a').hasClass('.star-off')){
// 		$('a').addClass('star-on')
// 	}
// });