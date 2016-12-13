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
      else{
        if(result["message"]!==""){
          alert(result["message"]);   
        }
        window.location.href = "/board/notice/list.php";
      }
    }
  });
}  
function modifySubmitData() {
  var location = window.location.search.split("=")[1];
  $("#notice-modify-form").ajaxForm({
    dataType: 'text', 
    success: function(responseText, statusText){
      var result = JSON.parse(responseText);
      if(result["error"] !== "false"){
        alert(result["message"]);
      }else{
        alert(result["message"]);
        window.location.href = "/board/notice/post.php?id="+location;
      }
    }
  });
}
