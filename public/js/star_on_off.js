
$(".star-off, .star-on").on('click', function () {
	if (window.location.pathname == "/php/questionlist.php")
		var element = $(this)[0].parentElement.parentElement.parentElement.getElementsByClassName("mini-count")[0].childNodes[1].textContent;
	else
		var element = window.location.search.split("=")[1];

	if ($(this).hasClass("star-on")) {
		$.ajax({
			url: "favorite.php",
			context: this,
			data: {
				id: element,
				type: "unfavorite"
			}
		}).done(function (data) {
			if (!data.error) {
  			$(this).removeClass("star-on");
  			$(this).addClass("star-off");
  			$(this).off();
  			$(this).on('click', favorite);
  		}
		});
	} else {
		$.ajax({
			url: "favorite.php",
			context: this,
			data: {
				id: element,
				type: "unfavorite"
			}
		}).done(function (data) {
			if (!data.error) {
  			$(this).removeClass("star-off");
  			$(this).addClass("star-on");
  			$(this).off();
  			$(this).on('click', unfavorite);
  		}
		});
	}
});

$(".pin-off").on('click', function(){

	if($(this).hasClass("pin-on")){
		$(this).removeClass("pin-on");
	} else{
		$(this).addClass("pin-on");
	}
});


