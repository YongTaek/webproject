
function ready () {
  $("#submit").click(function (event){

    var params = $("#form").serialize();
    $.ajax({
      url: "../php/create_comment.php",
      type : "POST",
      data : params
    }).done(function (data) {
      if(!data['error']){
        alert("등록 에러! X(");
      } else {
        addComent(data);
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

  $("#comment").append(div);
}
$(document).ready(ready);
<div>
  <span><?= $comment["content"] ?></span>
  <span><?= $comment["name"] ?></span>
  <span class=""><?= $comment["time"] ?></span>
  <?php if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant" || $_SESSION["id"] == $comment["id"])) { ?>
  <div class="comment_btn">
    <a class="btn comment_modify" href="/php/modify_comment.php">수정</a>
    <a class="btn comment_delete" href="/php/delete_comment.php">삭제</a>
  </div>
  <?php } ?>
</div>
