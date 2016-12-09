function questionReady(){	
	$(".commentBtn").on("click", function (event){
		var forminput = $(this).parent().parent().serialize();
		$.ajax({
			url: "../php/create_comment.php",
			type : "POST",
			data : forminput
		}).done(function (data) {
			var da = $.parseJSON(data);
			if(da.error == "true"){
				alert("등록 에러! X(");
			};
		});
	});
}
function appendComment(){

}


$(document).ready(questionReady);