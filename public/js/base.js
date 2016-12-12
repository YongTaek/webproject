$(window).on("load" ,function(){
	var pageError = window.location.pathname.split("php");
	if(pageError.length>2){
		window.location.replace("/error.php");
	}
	var location = window.location.pathname.split("/");
	var menuitems = $(".menu-item");
	if(location[1] === "lecture"){
		$(menuitems[3]).addClass("active");
		$("h1.align-center").text("Lecture");
		$("p.align-center").text("Let's study hard!");
	}
	else if(location[2] === "notice"){
		$(menuitems[0]).addClass("active");
		$("h1.align-center").text("Notice");
		$("p.align-center").text("It is notice page!");
	}
	else if(location[2] === "question"){
		$(menuitems[1]).addClass("active");	
		$("h1.align-center").text("Question");
		$("p.align-center").text("Let's ask a lot of questions!");	
	}
	else if(location[2] === "free"){
		$(menuitems[2]).addClass("active");	
		$("h1.align-center").text("Freeboard");
		$("p.align-center").text("Let's talk freely!");
	}
	else if(location[2] === "setting.php"){
		$("h1.align-center").text("Setting");
		$("p.align-center").text("It is setting page.");
	}
	else if(location[2] === "search.php"){
		$("h1.align-center").text("Search");
		$("p.align-center").text("Here is the result about your searching");
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
	$("input.search").keypress(function(e){
		if(e.which == 13){
			if($(this).val() !== ""){
				$("form#search-content").submit();
			}
			else{
				alert("키워드를 입력해주세요 3:(");
				e.preventDefault();
			}
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
					addTextNoNotification();
					$("#notification").text("0");
					//addTextNoNotification();
				}
			},
			error : function (result) {
				console.log(result);
			}
		});
	});

};

function addTextNoNotification(){
	if(document.getElementById("notifications").childNodes.length == 0){
		var span = document.createElement("span");
		span.setAttribute("class","no-notification");
		span.innerHTML = "받지 않은 알림이 없습니다!";
		$("#notifications").empty();
		$("#notifications").append(span);
	}
	
}


$(document).ready(onclick);
