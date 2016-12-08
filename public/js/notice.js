function ready () {
  $("#submit").click(function (event){

    var form = $("#form");
    var params = form.serialize();
    console.log(JSON.stringify(params));
    console.log(form.attr("action"));
    $.ajax({
      url: '/php/create_comment.php',
      type : "POST",
      data : params,
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      dataType: 'json',
      success : function (result) {
        if (result.error === "false") {
          addComment(result);
        }
      },
      error : function (result) {
        alert("실패");
        console.log(result);
      }
    });
  });
}
function addComment(data) {
  var div = document.createElement('div');
  var contentSpan = document.createElement("span");
  contentSpan.innerHTML = data.content;
  var nameSpan = document.createElement("span");
  nameSpan.innerHTML = data.name;
  var timeSpan = document.createElement("time");
  timeSpan.innerHTML = data.time;
  var ownerDiv = document.createElement('div');
  var modifyA = document.createElement('a');
  var removeA = document.createElement('a');
  modifyA.innerHTML = '수정';
  removeA.innerHTML = '삭제';
  ownerDiv.append(modifyA);
  ownerDiv.append(removeA);
  div.append(contentSpan);
  div.append(nameSpan);
  div.append(timeSpan);
  div.append(ownerDiv);

  $("hr").last().append(div);
  div.after("<hr>")
}
$(document).ready(ready);
