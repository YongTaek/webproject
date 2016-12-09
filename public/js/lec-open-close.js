
function func(){
	$(".lecture-open").click(function (event) {

		if ($(this).hasClass("lecture-close")){
			$(this).text("Open");
			$(this).removeClass("lecture-close");
		} else {
			$(this).text("Close");
			$(this).addClass("lecture-close");
		}
	});
};

$(document).ready(func);

