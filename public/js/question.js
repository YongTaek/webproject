function questionReady(){
	$(".commentBtn").on("click", function (event){
		var forminput = $(this).parent().parent().serialize();
		$.ajax({
			url: "../php/create_comment.php",
			type : "POST",
			data : forminput,
			dataType : "json"
		}).done(function (da) {
			if(da.error == "true"){
				alert("등록 에러! X(");
			};
			else{
				appendComment(da);
			};
		});
	});
};

function appendComment(){

	 // var da = $.parseJSON(data);
  // var content = da.content;
  var content = "hello";
  // var time = da.time;
  var time = "2016.12.08 6:45pm";
  // var name = da.name;
  var name = "익명";

  var div = $("<div></div>");


};


$(document).ready(questionReady);