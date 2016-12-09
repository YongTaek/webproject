function questionReady(){
	$(".commentBtn").on("click", function (event){
		var input = $(this).siblings().not($(this));
		var form = $(this).parent().parent();
		var forminput = form.serialize();
		console.log(forminput);
		$.ajax({
			url: "../php/create_comment.php",
			type : "POST",
			data : forminput,
			dataType : "json"
		}).done(function (da) {
			if(da.error == "true"){
				alert("등록 에러! X(");
			}
			else{
				redirectComment(da,$(form.parent()).siblings().not(form.parent()));
			}
		});
	});
};

function redirectComment(da,comment){
	window.location.href = document.location.href;

};


$(document).ready(questionReady);