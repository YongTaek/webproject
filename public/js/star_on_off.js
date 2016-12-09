
function favorite(event) {

	if (window.location.pathname == "/php/questionlist.php")
		$.ajax({
			url: "favorite.php",
			context: this,
			data: { id: event[0].parentElement.parentElement.parentElement.getElementsByClassName("mini-count")[0].childNodes[1].textContent,
							type: "favorite" }
						}).done(function (data) {
				if (!data.error) {
  				$(this).removeClass("star-off");
  				$(this).addClass("star-on");
  				$(this).off();
  				$(this).on('click', unfavorite);
  			}
  		}
		);
	if (window.location.pathname == "/php/question.php")
		$.ajax({
			url: "favorite.php",
			context: this,
			data: { id: window.location.search.split("=")[1],
							type: "favorite" }
						}).done(function(data) {
  			if (!data.error) {
  				$(this).removeClass("star-off");
  				$(this).addClass("star-on");
  				$(this).off();
  				$(this).on('click', unfavorite);
  			}
  		}
  	);
}

function unfavorite(event) {

	if (window.location.pathname == "/php/questionlist.php")
		$.ajax({
			url: "favorite.php",
			context: this,
			data: { id: event[0].parentElement.parentElement.parentElement.getElementsByClassName("mini-count")[0].childNodes[1].textContent,
							type: "unfavorite" }
						}).done(function (data) {
				if (!data.error) {
  				$(this).removeClass("star-on");
  				$(this).addClass("star-off");
  				$(this).off();
  				$(this).on('click', favorite);
  			}
  		}
		);
	if (window.location.pathname == "/php/question.php")
		$.ajax({
			url: "favorite.php",
			context: this,
			data: { id: window.location.search.split("=")[1],
							type: "unfavorite" }
						}).done(function(data) {
  			if (!data.error) {
  				$(this).removeClass("star-on");
  				$(this).addClass("star-off");
  				$(this).off();
  				$(this).on('click', favorite);
  			}
  		}
  	);
}

$(".star-off").on('click', function () { favorite($(this)) });

$(".star-on").on('click', function () { unfavorite($(this)) });

$(".pin-off").on('click', function(){

	if($(this).hasClass("pin-on")){
		$(this).removeClass("pin-on");
	} else{
		$(this).addClass("pin-on");
	}
});


