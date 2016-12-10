function questionReady(){
	$(".commentBtn").on("click", function (event){
		var input = $(this).siblings().not($(this));
		var form = $(this).parent().parent();
		var forminput = form.serialize();
		console.log(forminput);
		$.ajax({
			url: "/comment/create.php",
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
		var content = div.find("span")[0].innerHTML;

		var form = document.createElement("form");
		form.setAttribute("class", "width100");
		form.setAttribute("action", "/comment/modify.php");
		form.setAttribute("method", "post");
		var contentInput = document.createElement("input");
		contentInput.interHTML= content;
		contentInput.setAttribute("name", "content");
		contentInput.setAttribute("class", "comment-write");
		var idInput = document.createElement("input");
		var IdInput = document.createElement("input");
		var typeInput = document.createElement("input");


		var idSpan = div.find("span.hidden");

		var commentId = idSpan[0].innerHTML;
		idInput.setAttribute("name", "id");
		idInput.setAttribute("value", commentId);
		idInput.setAttribute("type","hidden");

		var reference = idSpan[1].innerHTML;
		IdInput.setAttribute("name", "reference");
		IdInput.setAttribute("value",reference);
		IdInput.setAttribute("type", "hidden");

		var type = idSpan[2].innerHTML;
		typeInput.setAttribute("type", "hidden");
		typeInput.setAttribute("name", "type");
		typeInput.setAttribute("value", type);

		var submitInput = document.createElement("input");
		submitInput.setAttribute("class", "btn commentModify submit");
		submitInput.setAttribute("value", "수정");
		submitInput.setAttribute("type", "submit");
		form.append(contentInput);
		form.append(idInput);
		form.append(IdInput);
		form.append(typeInput);
		form.append(submitInput);

		div.empty();
		div.append(form);
	});

	$(".comment_delete").on("click", function (event) {
		var url = window.location;
		var parameter = url.search.split("?")[1];
		var questionId = parameter.split("=")[1];
		var commentId = $(this).parent().parent().find("span.hidden")[0].innerHTML;
		var query = "id=" + commentId + "&questionId=" + questionId;
		console.log(query);
		$.ajax({
			url: "/comment/delete.php",
			type: "POST",
			data: query,
			dataType: 'json'
		}).done(function (data) {
			console.log(data);
			if(data.error === "true") {
				alert("삭제 오류");
			} else {
				window.location.href = document.location.href;
			}
		});
	});

};

$(document).ready(questionReady);
