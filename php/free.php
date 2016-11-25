<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Free Board</title>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
  <link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="/public/css/base.css" type="text/css">
  <link rel="stylesheet" href="/public/css/free.css" type="text/css">
</head>
<body>
  <header role = "banner" class="banner-color">
    <nav role="navigation" >
      <div id="logo" class="pull-left"><a href="/php/main.php"><img class="logo" src="/public/img/selab_logo_S.png" /></a></div>
      <ul id="menu" class="inline-list pull-left">
        <li class="pull-left"><a href="/php/noticelist.php" class="menu-item" >NOTICE</a></li>
        <li class="pull-left"><a href="/php/questionlist.php" class="menu-item">QUESTION</a></li>
        <li class="pull-left"><a href="/php/freelist.php" class="menu-item active">FREE BOARD</a></li>
      </ul>
      <div role="login" class="pull-right">
        <?php if (isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["auth"])) { ?>
          <a id="login" href="/php/logout.php" class='pull-right'>LOGOUT</a>
          <div class="pull-right vr"></div>
          <a id="mypage" href="/php/myPage.php" class='pull-right'><?= $_SESSION["name"] ?> (<?= $_SESSION["auth"] ?>)</a>
        <?php } else { ?>
          <a id="login" href="dologin.php" class='pull-right'>LOGIN</a>
        <?php } ?>
      </div>
      <a href="/php/free/search"><img src="/public/img/search.png" class="pull-right search-icon"></a>
      <input type="text" class="pull-right search" name="search">
    </nav>
    <div class = "jumbotron banner-color">
      <h1 class="align-center">Free</h1>
      <p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
    </div>
  </header>

  <?php
    if (isset($_GET["id"])) {
      $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
      $rows = $db->query("SELECT b.id, name, title, content, time FROM board b JOIN user u ON b.u_id = u.id WHERE b.id = ".$_GET["id"]);
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
        <div class="free_btn">
          <a class="btn free_modify" name="free_modify" href="modify_free.php?id=<?= $row["id"] ?>">수정</a>
          <a class="btn free_delete" name="free_delete" href="delete_free.php?id=<?= $row["id"] ?>">삭제</a>
        </div>
      </div>
      <div class="content">
        <p><?= $row["content"] ?></p>
      </div>
    </div>
    <!-- comment iterative-->
    <div class="comment">
        <hr>
        <?php
          $comments = $db->query("SELECT content, name, time FROM comment c JOIN user u ON c.u_id = u.id WHERE type = 'board' AND reference_id = ".$row["id"]);
          foreach ($comments as $comment) {
        ?>
        <div>
          <span><?= $comment["content"] ?></span>
          <span><?= $comment["name"] ?></span>
          <span class=""><?= $comment["time"] ?></span>
          <div class="comment_btn">
            <a class="btn comment_modify" name="comment_modify" href="">수정</a>
            <a class="btn comment_delete" name="comment_delete" href="">삭제</a>
          </div>
        </div>
        <hr>
        <?php } ?>
    </div>
    <div class="comment">
      <form>
        <label>Comment:</label>
        <div>
          <input id="comment-write" type="text" name="comment" />
          <input class="btn" id="submit" type="submit" value="등록"/>
        </div>
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
