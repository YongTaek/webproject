function activeMenu(){
	var location = window.location.pathname.split("/");
	var menuitems = $(".menu-item");
	if(location[1] === "lecture"){
		$(menuitems[3]).addClass("active");
	}
	else if(location[2] === "notice"){
		$(menuitems[0]).addClass("active");	
	}
	else if(location[2] === "question"){
		$(menuitems[1]).addClass("active");		
	}
	else{
		$(menuitems[2]).addClass("active");	
	}
}
$(document).load(activeMenu);
function onclick(){

	$("button.pull-right").click(function(){
		if($("input.search").val() !== ""){
			$("form#search-content").submit();
		}
		else{
			alert("키워드를 입력해주세요 >:(");
		}
	});

	$('.side-bar').click(function (event) {
		var effect = 'slide';
		var options = { direction: "right"};
		var duration = 500;
		$('#mySidenav').toggle("slide", { direction : "right" }, 500, function () {
		});
	});

	$(".closebtn").click(function(){

		var effect = 'slide';
		var options = { direction: "right"};
		var duration = 500;
		$('#mySidenav').toggle("slide", { direction : "right" }, 500, function () {
		});
	});

	$("#all-delete").click(function() {
		$.ajax({
			url: '/api/read-allnotification.php',
			type : "POST",
			contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
			dataType: 'json',
			success : function (result) {
				if (result.error === "false") {
					$("#notifications").empty();
					$("#notification").text("0");
				}
			},
			error : function (result) {
				console.log(result);
			}
		});
	});

};




$(document).ready(onclick);
