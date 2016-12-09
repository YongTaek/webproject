
$(".star-off, .star-on").on('click', function () {
	if (window.location.pathname == "/php/questionlist.php")
		var element = $(this)[0].parentElement.parentElement.parentElement.getElementsByClassName("mini-count")[0].childNodes[1].textContent;
	else
		var element = window.location.search.split("=")[1];

	if ($(this).hasClass("star-on"))
		var t = "unfavorite";
	else
		var t = "favorite";

	$.ajax({
		url: "favorite.php",
		context: this,
		data: {
			id: element,
			type: t
		},
		success: function (data) {
			if (data.error === "false") {
				if (t === "unfavorite") {
					$(this).removeClass("star-on");
					$(this).addClass("star-off");
				} else {
					$(this).removeClass("star-off");
					$(this).addClass("star-on");
				}
  		}
		}
	});
});

$(".pin-off, .pin-on").on('click', function () {
	if (window.location.pathname.includes("list")) {
		var element = $(this)[0].parentElement.parentElement.parentElement.getElementsByClassName("mini-count")[0].childNodes[1].textContent;
		var which = window.location.pathname.slice(5, window.location.pathname.search("list"));
	}
	else {
		var element = window.location.search.split("=")[1];
		var which = window.location.pathname.slice(5, window.location.pathname.indexOf('.'));
	}

	if ($(this).hasClass("pin-on")) {
		var t = "unpin";
	} else {
		var t = "pin";
	}

	$.ajax({
		url: "pin.php",
		context: this,
		data: {
			id: element,
			type: "unpin",
			where: which
		},
		success: function (data) {
			if (data.error === "false") {
				if (t === "unpin") {
					$(this).removeClass("pin-on");
					$(this).addClass("pin-off");
				} else {
					$(this).removeClass("pin-off");
					$(this).addClass("pin-on");
				}
			}
		}
	});
});

$(".pin-off").on('click', function(){

	if($(this).hasClass("pin-on")){
		$(this).removeClass("pin-on");
	} else{
		$(this).addClass("pin-on");
	}
});
