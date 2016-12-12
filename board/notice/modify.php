<?php
  include("../../common/pusher.php");
  if (!($_SESSION["auth"] === "professor" || $_SESSION["auth"] === "assistant")) {
    header("Location: /error.php");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/public/css/bootstrap.min.css" type="text/css">
  	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
  	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="/public/js/jquery-ui-1.12.1.min.js"></script>
    <script src="/public/js/base.js"></script>
    <?php include("../../common/script.php"); ?>

    <link rel="stylesheet" type="text/css" href="/public/css/wmd.css" />
    <link rel="stylesheet" type="text/css" href="/public/css/create-post.css" />
  	<script type="text/javascript" src="/public/js/showdown.js"></script>
  	<script src="/public/js/notice.js"></script>
    <title>Modify Notice</title>
  </head>
  <body>
    <?php include("../../common/header.php"); ?>
    <?php
      $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
      $id = $_GET["id"];
      $u_id = $_SESSION["id"];
      $rows = $db->query("SELECT title, content,url FROM notice WHERE id = $id");
      if ($rows->rowCount() > 0) {
        $row = $rows->fetch();
    ?>
    <div class="container">
      <div class="write-answer">
        <form id ="notice-modify-form" action="/notice/modify.php" method="POST" enctype="multipart/form-data">
          <h2>Title</h2>
          <div class="title">
            <input name="title" type="text" value="<?= $row["title"] ?>" required>
          </div>
          <h2>Attatchment</h2>
          	<input type="file" id ="upload" name="upload">
          	<?php if ($row["url"] !== NULL){ ?>
          		<p class="origin-file"><?= basename($row["url"]) ?> <input class="delete btn btn-primary" type = "button" value = "삭제">
          	<?php } ?>
          <h2>Content</h2>
          <div class="content" id="wmd-editor">
            <div id="wmd-button-bar"></div>
            <textarea id="wmd-input" name="content"><?= $row["content"] ?></textarea>
          </div>
          <hr>
          <div id="wmd-preview" class="wmd-preview"></div>
          <hr>
        <input type="hidden" name="id" value="<?= $id ?>">
        <input id = "is-click" type="hidden" name="isclick" value=0>
        </form>
        <div class='buttons'>
        <input class='modify btn btn-primary' type='submit' value="submit" form="notice-modify-form"/>
        <button class='btn btn-primary'>cancel</button>
  		</div>
      </div>
    </div>
    <?php } ?>
    <script type="text/javascript" src="/public/js/wmd.js"></script>
  </body>
</html>
