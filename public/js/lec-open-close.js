
function func(){
	$(".lecture-open").click(function (event) {

		if ($(this).hasClass("lecture-close")) {
			var status = "open";
		} else {
			var status = "close";
		}

		$.ajax({
			url: "lec-open-close"
			context: this,
			data: {
				id: status
			}
			success: function (data){
				if(data.error === "false"){
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

