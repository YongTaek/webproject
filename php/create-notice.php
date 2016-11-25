<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/public/css/bootstrap.min.css" type="text/css">
  	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="/public/css/wmd.css" />
    <link rel="stylesheet" type="text/css" href="/public/css/create-post.css" />
  	<script type="text/javascript" src="/public/js/showdown.js"></script>
    <title>글쓰기</title>
  </head>
  <body>
    <header role = "banner" class="banner-color">
  		<nav role="navigation" >
  			<div id="logo" class="pull-left"><a href="/php/main.php"><img class="logo" src="/public/img/selab_logo_S.png" /></a></div>
  			<ul id="menu" class="inline-list pull-left">
  				<li class="pull-left"><a href="/php/noticelist.php" class="menu-item active" >NOTICE</a></li>
  				<li class="pull-left"><a href="/php/questionlist.php" class="menu-item">QUESTION</a></li>
  				<li class="pull-left"><a href="/php/freelist.php" class="menu-item">FREE BOARD</a></li>
  			</ul>
  			<div role="login" class="pull-right">
  				<?php if (isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["auth"])) { ?>
            <a id="login" href="logout.php" class='pull-right'>LOGOUT</a>
            <div class="pull-right vr"></div>
            <a id="mypage" href="#" class='pull-right'><?= $_SESSION["name"] ?> (<?= $_SESSION["auth"] ?>)</a>
            <ul class="hidden" id="setting">
              <li><a href="user-setting.php">Setting</a></li>
            </ul>
          <?php } else { ?>
            <a id="login" href="dologin.php" class='pull-right'>LOGIN</a>
          <?php } ?>
  			</div>
  			<img src="/public/img/search.png" class="pull-right search-icon">
  			<input type="text" class="pull-right search" name="search">
  		</nav>
  		<div class = "jumbotron banner-color">
  			<h1 class="align-center">Create Notice</h1>
  			<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
  		</div>
  	</header>

    <div class="container">
      <div class="write-answer">
        <form action="create_notice.php" method="POST">
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
        <input class="btn btn-primary" type="submit" value="submit" />
        </form>
      </div>
    </div>
    <script type="text/javascript" src="/public/js/wmd.js"></script>
  </body>
</html>
