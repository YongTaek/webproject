function questionReady(){
	
	$(".commentBtn").click(function (event){
		console.log("Event:");
		$.ajax({
			url: "../php/create_comment.php",
			type : "POST",
			context: $("#input").value
		}).done(function (data) {
			if(!data['error']){
				alert("등록 에러! X(");
			};
		});
	});
}
function appendComment(){

}


$(document).ready(questionReady);