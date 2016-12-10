<?php include("../../common/pusher.php"); ?>
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
  <title>글쓰기</title>
</head>
<body>
  <?php include("../../common/header.php"); ?>

<div class="container">
  <div class="write-answer">
    <form action="/notice/create.php" method="POST">
      <h2>Title</h2>
      <div class="title">
        <input name="title" type="text">
      </div>
      <h2>Content</h2>
      <div class="content" id="wmd-editor">
        <div id="wmd-button-bar"></div>
        <textarea id="wmd-input" name="content"></textarea>
      </div>
      <hr>
      <div id="wmd-preview" class="wmd-preview"></div>
      <hr>
      <div class='buttons'>
        <input class='btn btn-primary' type='submit' value="submit" />
        <button class='btn btn-primary'>cancel</button>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript" src="/public/js/wmd.js"></script>
</body>
</html>
