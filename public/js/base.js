function onclick(){
	$("button.pull-right").click(function(){
		if($("input.search").val() !== ""){
			$("form#search-content").submit();
		}
		else{
			alert("키워드를 입력해주세요 >:(");
		}
	});
};
$(document).ready(onclick);