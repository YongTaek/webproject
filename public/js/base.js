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
				$("#notification").innerHTML=0;
				$("#notifications").empty();
			},
			error : function (result) {
				console.log(result);
			}
		});
	});

};




$(document).ready(onclick);
