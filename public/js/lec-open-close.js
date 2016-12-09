
function func(){
	$(".lecture-open").click(function (event) {

		if ($(this).hasClass("lecture-close")){
			$(this).text("Open");
			$(this).removeClass("lecture-close");
			var status = "open";
		} else {
			$(this).text("Close");
			$(this).addClass("lecture-close");
			var status = "close";
		}
		$.ajax({
			url: "lec-open-close"
			context: this,
			data: {
				id: status
			}
		});
	});
};


$(document).ready(func);

