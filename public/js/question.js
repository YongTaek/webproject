function questionReady(){
	$(".commentBtn").on("click", function (event){
		var thiis = $(this);
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
				appendComment(da,$(form.parent()).siblings().not(form.parent()));
				thiis.val("");
			}
		});
	});
};

function appendComment(da,comment){
	console.log(comment);
	var content = da.content;
	// var content = "hello";
	var time = da.time;
	// var time = "2016.12.08 6:45pm";
	var name = da.name;
	// var name = "익명";

	var div = $("<div></div>");

	var spancontent = $("<span></span>").text(content);
	var spanname = $("<span></span>").text(name);
	var spantime = $("<span></span>").text(time);

	div.append(spancontent);
	div.append(spanname);
	div.append(spantime);

	$(comment).append(div);

	var btns = $("<div class = 'question_btn'></div>");

	var edit = $("<a class = 'btn question_modify' name='question_modify'></a>");
	edit.href = "modify_question.php?id=" + da.r_id;

	var remove = $("<a class = 'btn question_delete' name = 'question_delete'></a>");
	remove.href = "delete_question.php?id=" + da.r_id;

	btns.append(edit);
	btns.append(remove);

	$(comment).append(btns);
	$(comment).append($("<hr>"));

};


$(document).ready(questionReady);