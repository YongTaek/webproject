function ready () {
}
function addComment(data) {
  var div = document.createElement('div');
  var contentSpan = document.createElement("span");
  contentSpan.innerHTML = data.content + " ";
  var nameSpan = document.createElement("span");
  nameSpan.innerHTML = data.name + " ";
  var timeSpan = document.createElement("time");
  timeSpan.innerHTML = data.time + " ";
  var ownerDiv = document.createElement('div');
  ownerDiv.className = "comment_btn";
  var modifyA = document.createElement('a');
  modifyA.className= "btn comment_modify";
  var removeA = document.createElement('a');
  removeA.className= "btn comment_delete";
  modifyA.innerHTML = '수정';
  removeA.innerHTML = '삭제';
  ownerDiv.append(modifyA);
  ownerDiv.append(removeA);
  div.append(contentSpan);
  div.append(nameSpan);
  div.append(timeSpan);
  div.append(ownerDiv);

  $("#comment-list").append(div);
  $("#comment-list").append(document.createElement("hr"));
}
$(document).ready(ready);
