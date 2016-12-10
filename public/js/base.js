function onclick(){
	$("button.pull-right").click(function(){
		if($("input.search").val() !== ""){
			$("form#search-content").submit();
		}
	});
};
$(document).ready(onclick);