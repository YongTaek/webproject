function ready () {
   $("button").click( function(){
    window.location.href = "/board/notice/list.php";
   });
  $("input.delete").click(function(){
    $("#is-click").val(1);
    $("p.origin-file").remove();
  });

  $("input.modify").click(modifySubmitData);
  $("input.create").click(submitData);
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
      }
    },error: function(e){
      console.log(e.responseText);
      alert(result["message"]);
    }
  });
}
  function modifySubmitData() {
    console.log("hello!");
  $("#notice-modify-form").ajaxForm({
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
