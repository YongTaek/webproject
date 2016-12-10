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
				// appendComment(da,$(form.parent()).siblings().not(form.parent()));
				window.location.href = document.location.href;
			}
		});
	});

	$(".comment_modify").on("click", function (event) {
		var div = $(this).parent().parent();
		div.val("");
		var form = document.createElement("form");
		form.setAttribute("action", "modify_comment.php");
		var contentInput = document.createElement("input");
		contentInput.setAttribute("name", "content");
		contentInput.setAttribute("class", "comment-write");
		var idInput = document.createElement("input");
		idInput.setAttribute("name", "id");
		idInput.setAttribute("type","hidden");
		var submitInput = document.createElement("input");
		submitInput.setAttribute("class", "btn commentModify submit");
		submitInput.setAttribute("value", "수정");
		form.append(contentInput);
		form.append(idInput);
		form.append(submitInput);
		div.append(form);
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

	var btns = $("<div class = 'comment_btn'></div>");

	var edit = $("<a class = 'btn question_modify' name='question_modify'>수정</a>");
	edit.href = "modify_question.php?id=" + da.r_id;

	var remove = $("<a class = 'btn question_delete' name = 'question_delete'>삭제</a>");
	remove.href = "delete_question.php?id=" + da.r_id;

	btns.append(edit);
	btns.append(remove);

	div.append(spancontent," ");
	div.append(spanname," ");
	div.append(spantime," ");
	div.append(btns);

	$(comment).append(div);
	$(comment).append($("<hr>"));
	// window.location.href = document.location.href;

};


$(document).ready(questionReady);
