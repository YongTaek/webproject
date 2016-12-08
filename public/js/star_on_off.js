
$(".star-off").on('click', function () {

	if (window.location.pathname == "/php/questionlist.php")
  	$.get("favorite.php", 
  		{ id: $(this).parentNode.parentNode.parentNode.getElementsByClassName("mini-count")[0].childNodes[1].textContent,
  			type: "favorite" })
  	.done(function (data) {
  		if (!data.error) {
  			$(this).removeClass("star-off");
  			$(this).addClass("star-on");
  		}
		});
	if (window.location.pathname == "/php/question.php")
  	$.get("favorite.php",
  		{ id: window.location.search.split("=")[1],
  			type: "favorite" })
  	.done(function(data) {
  		if (!data.error) {
  			$(this).removeClass("star-off");
  			$(this).addClass("star-on");
  		}
  	});

})

$(".star-on").on('click', function () {

	if (window.location.pathname == "/php/questionlist.php")
  	$.get("favorite.php", 
  		{ id: $(this).parentNode.parentNode.parentNode.getElementsByClassName("mini-count")[0].childNodes[1].textContent,
  			type: "unfavorite" })
  	.done(function (data) {
  		if (!data.error) {
  			$(this).removeClass("star-on");
  			$(this).addClass("star-off");
  		}
		});
	if (window.location.pathname == "/php/question.php")
  	$.get("favorite.php",
  		{ id: window.location.search.split("=")[1],
  			type: "unfavorite" })
  	.done(function(data) {
  		if (!data.error) {
  			$(this).removeClass("star-on");
  			$(this).addClass("star-off");
  		}
  	});

})

$(".pin-off").on('click', function(){

	if($(this).hasClass("pin-on")){
		$(this).removeClass("pin-on");
	} else{
		$(this).addClass("pin-on");
	}
})


