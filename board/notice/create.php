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
  <link rel="stylesheet" type="text/css" href="/public/css/create-vote.css" />

  <script type="text/javascript" src="/public/js/showdown.js"></script>
  <link rel="stylesheet" href="/public/css/pusher.css" type="text/css">
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="//js.pusher.com/3.2/pusher.min.js"></script>
  <script src="/public/js/create-vote-item.js" type="text/javascript" charset="utf-8" async defer></script>
  <script src="/public/js/push.js"></script>
  <script type="text/javascript" src="/public/js/jquery.form.js"></script>
  <script type="text/javascript" src="/public/js/notice.js"></script>
  <title>Create Notice</title>
</head>
<body>
  <?php include("../../common/header.php"); ?>

<div class="container">
  <div class="write-answer">
    <form id ="notice-form" action="/notice/create.php" method="POST" enctype="multipart/form-data">
      <h2>Title</h2>
      <div class="title">
        <input name="title" type="text" required>
      </div>
      <h2>Attatchment</h2>
      <input type="file" id ="upload" name="upload">
      <h2>Content</h2>
      <div class="content" id="wmd-editor">
        <div id="wmd-button-bar"></div>
        <textarea id="wmd-input" name="content"></textarea>
      </div>
      <hr>
      <div id="wmd-preview" class="wmd-preview"></div>
      <hr>
    </form>
    <div class='buttons'>
        <input class='create btn btn-primary' type='submit' value="submit" form="notice-form"/>
        <button class='btn btn-primary'>cancel</button>
  	</div>
  </div>
</div>
<script type="text/javascript" src="/public/js/wmd.js"></script>
</body>
</html>
