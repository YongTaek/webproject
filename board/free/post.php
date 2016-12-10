<?php include("../../common/pusher.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Free Board</title>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
  <link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="/public/css/base.css" type="text/css">
  <link rel="stylesheet" href="/public/css/free.css" type="text/css">
  <link rel="stylesheet" href="/public/css/pusher.css" type="text/css">
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
  
  <script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
  <script src="/public/js/jquery-ui-1.12.1.min.js"></script>
  <script src="/public/js/base.js"></script>
  <?php include("../../common/script.php"); ?>

  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="//js.pusher.com/3.2/pusher.min.js"></script>
  <script src="/public/js/push.js"></script>
  <script src="/public/js/pusher.js"></script>
  
</head>
<body>
  <?php include("../../common/header.php"); ?>

  <?php
    if (isset($_GET["id"])) {
      $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
      $rows = $db->query("SELECT b.id, name, title, content, time, u.id, pinned FROM board b JOIN user u ON b.u_id = u.id WHERE b.id = ".$_GET["id"]);
      foreach ($rows as $row) {
  ?>

  <div class="container">
    <div class="notice">
      <div class="title">

        <a class="star-off" href="#" ></a>
        <h1 id="title_id">
          <span><?= $row["title"] ?></span>
        </h1>
        <div class="notice_info">
          <span><?= $row["name"] ?></span>
          <span><?= $row["time"] ?></span>
        </div>
        <?php if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant" || $_SESSION["id"] == $row["id"])) { ?>
        <div class="free_btn">
          <a class="btn free_modify" href="/board/free/modify.php?id=<?= $row[0] ?>">수정</a>
          <a class="btn free_delete" href="/free/delete.php?id=<?= $row[0] ?>">삭제</a>
        </div>
        <?php } ?>
      </div>
      <div class="content">
        <?php
          if ($row["pinned"]) {
            $pin = "pin-on";
          } else {
            $pin = "pin-off";
          }
        ?>
        <a class="<?= $pin ?>"></a>
        <?= $row["content"] ?>
      </div>
    </div>
    <!-- comment iterative-->
    <div class="comment">
        <hr>
        <?php
          $comments = $db->query("SELECT content, name, time, u.id FROM comment c JOIN user u ON c.u_id = u.id WHERE type = 'board' AND reference_id = ".$row[0]);
          foreach ($comments as $comment) {
        ?>
        <div>
          <span><?= $comment["content"] ?></span>
          <span><?= $comment["name"] ?></span>
          <span class=""><?= $comment["time"] ?></span>
          <?php if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant" || $_SESSION["id"] == $comment["id"])) { ?>
          <div class="comment_btn">
            <a class="btn comment_modify" name="comment_modify" href="">수정</a>
            <a class="btn comment_delete" name="comment_delete" href="">삭제</a>
          </div>
          <?php } ?>
        </div>
        <hr>
        <?php } ?>
    </div>
    <div class="comment">
      <form action="/comment/create.php" method="POST">
        <label>Comment:</label>
        <div>
          <input id="comment-write" type="text" name="comment" />
          <input class="btn" id="submit" type="submit" value="등록"/>
        </div>
        <input type="hidden" name="id" value="<?= $row[0] ?>" />
        <input type="hidden" name="type" value="board">
      </form>
    </div>
  </div>
  <?php
      }
    }
  ?>
  <script src="/public/js/star_on_off.js" type="text/javascript"></script>
</body>
</html>
