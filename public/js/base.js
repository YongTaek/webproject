function onclick(){
	$("button.pull-right").click(function(){
		if($("input.search").val() !== ""){
			$("form#search-content").submit();
		}
		else{
			alert("키워드를 입력해주세요 >:(");
		}
	});

	$(".side-bar").click(function(){

    	document.getElementById("mySidenav").style.width = "250px";

	});

	$(".closebtn").click(function(){

		 document.getElementById("mySidenav").style.width = "0";
	});

};




$(document).ready(onclick);
