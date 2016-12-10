$(window).on("load" ,function(){
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
	else if(location[2] === "board"){
		$(menuitems[2]).addClass("active");	
	}
});

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
					addTextNoNotification();
				}
			},
			error : function (result) {
				console.log(result);
			}
		});
	});

};

function addTextNoNotification(){
	var span = document.createElement("span");
	span.setAttribute("class","no-notification");
	span.innerHTML = "받지 않은 알림이 없습니다!";

	$("#notifications").append("<span class=\"no-notification\">받지 않은 알림이 없습니다!</span>");
}


$(document).ready(onclick);
