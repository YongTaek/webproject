
function func(){
	$(".lecture-open, .lecture-close").on('click', function () {

		if ($(this).hasClass("lecture-close")) {
			var status = "open";
		} else {
			var status = "close";
		}

		$.ajax({
			url: "lec-open-close.php",
			context: this,
			data: {
				id: $(this)[0].parentElement.parentElement.childNodes[1].textContent,
				status: status
			},
			success: function (data){
				if(data.error === "false") {
					if (status == "open") {
						$(this).text("Open");
						$(this).removeClass("lecture-close");
						$(this).addClass("lecture-open");
					} else {
						$(this).text("Close");
						$(this).removeClass("lecture-open");
						$(this).addClass("lecture-close");
					}
				}
			}
		});
	});
};


$(document).ready(func);

