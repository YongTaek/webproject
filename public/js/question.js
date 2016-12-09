function questionReady(){
	$(".commentBtn").on("click", function (event){
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
				appendComment(da,$(form.parent()).sibilings().not(form.parent()));
			}
		});
	});
};

function appendComment(da,comment){
	console.log(comment);
	// var da = $.parseJSON(data);
	// var content = da.content;
	var content = "hello";
	// var time = da.time;
	var time = "2016.12.08 6:45pm";
	// var name = da.name;
	var name = "익명";

	var div = $("<div></div>");

	var spancontent = $("<span></span>").text(content);
	var spanname = $("<span></span>").text(name);
	var spantime = $("<span></span>").text(time);

	div.append(spancontent);
	div.append(name);
	div.append(time);

	$(comment).append(div);
	$(comment).append($("<hr>"));

};


$(document).ready(questionReady);