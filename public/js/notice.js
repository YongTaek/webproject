function ready () {
  $("button").onclick("/board/notice/list.php");
}
$(document).ready(ready);

function submitData() {
  $("#notice-form").ajaxForm({
    dataType: 'text',
    success: function(responseText, statusText){
      console.log(responseText);
      var result = JSON.parse(responseText);
      if(result["error"] !== "false"){
      alert(result["message"]);
    }},error: function(e){
      console.log(e.responseText);
      alert(result["message"]);
    }
  });
}