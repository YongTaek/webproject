
function func(){
	$(".lecture-open").on('click', function () {

		if ($(this).hasClass("lecture-close")) {
			var status = "open";
		} else {
			var status = "close";
		}

		$.ajax({
			url: "lec-open-close.php",
			context: this,
			data: {
				id: status
			},
			success: function (data){
				if(data.error === "false") {
					if (status == "open") {
						$(this).text("Close");
						$(this).removeClass("lecture-open");
						$(this).addClass("lecture-close");
					} else {
						$(this).text("Open");
						$(this).removeClass("lecture-close");
						$(this).addClass("lecture-open");
					}
				}
			}
		});
	});
};


$(document).ready(func);

