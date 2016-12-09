function answerModify(){
	$("a.answer_modify").on('click', function () {
		console.log($(this).parent().siblings('.overflow').children('.content').attr("class"));
		console.log($(this).text());
		if($(this).text() == "수정"){
			var content = $(this).parent().siblings('.overflow').children('.content');
			var contentText = $(content).html();
			content.empty();
			// var form = document.createElement("form");
			// $(form).attr('action', 'question.php');
			// var divWndEditor = document.createElement("div");
			// $(divWndEditor).attr('id', 'wnd-editor');
			// var divButton = document.createElement("div");
			// $(divButton).attr('id', 'wmd-button-bar');
			// var textarea = document.createElement("textarea");
			// $(textarea).attr('id', 'wnd-input');
			// divWndEditor.append(textarea);
			// divWndEditor.append(divButton);
			// var divPreview = document.createElement("div");
			// $(divPreview).attr('id', 'wnd-preview');
			// form.append(divWndEditor);
			// form.append("<hr>");
			// form.append(divPreview);
			// form.append("<hr>");
			// content.append(form);
	    	// var modifyArea = document.createElement("textarea");  // Create with DOM
	    	// modifyArea.innerHTML = contentText;
	    	// $(modifyArea).css({"width":"1000px", "height":"250px"});
	    	// content.append(modifyArea);
	    	content.append("<form action=\"question.php\"><div id=\"wmd-editor\"><div id=\"wmd-button-bar\"></div><textarea id=\"wmd-input\"></textarea></div><hr><div id=\"wmd-preview\" class=\"wmd-preview\"></div><hr><input class=\"btn btn-primary\" type=\"submit\" value=\"submit\" /></form>");
	    	$(this).text("완료");
		}else{
			$(this).text("수정");
		}
		
	})
}
$(document).ready(answerModify);