<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css" type="text/css">
  	<link rel="stylesheet" href="../public/css/base.css" type="text/css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../public/css/wmd.css" />
    <link rel="stylesheet" type="text/css" href="../public/css/create-post.css" />
  	<script type="text/javascript" src="../public/js/showdown.js"></script>
    <title>글쓰기</title>
  </head>
  <body>
    <header role = "banner" class="banner-color">
  		<nav role="navigation" >
  			<div id="logo" class="pull-left"><a href="/view/main.php"><img class="logo" src="../public/img/selab_logo_S.png" /></a></div>
  			<ul id="menu" class="inline-list pull-left">
  				<li class="pull-left"><a href="/view/noticelist.php" class="menu-item active" >NOTICE</a></li>
  				<li class="pull-left"><a href="/view/questionlist.php" class="menu-item">QUESTION</a></li>
  				<li class="pull-left"><a href="/view/freelist.php" class="menu-item">FREE BOARD</a></li>
  			</ul>
  			<div role="login" class="pull-right">
  				<a id="login" href="/view/login.php" class='pull-right'>LOGIN</a>
  				<div class="pull-right vr"></div>
  				<a id="mypage" href="/view/myPage.php" class='pull-right'>천유정 (학생)</a>
  			</div>
  			<img src="/public/img/search.png" class="pull-right search-icon">
  			<input type="text" class="pull-right search" name="search">
  		</nav>
  		<div class = "jumbotron banner-color">
  			<h1 class="align-center">Create Notice</h1>
  			<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
  		</div>
  	</header>
    <?php
      $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
      $id = $_GET["id"];
      $u_id = $_SESSION["id"];
      $rows = $db->query("SELECT title, content FROM notice WHERE u_id = $u_id AND id = $id");
      $row = $rows->fetch();
    ?>
    <div class="container">
      <div class="write-answer">
        <form action="notice.php">
          <h2>Title</h2>
          <div class="title">
            <input name="title" type="text" value="<?= $row["title"] ?>">
          </div>
          <h2>Content</h2>
          <div class="content" id="wmd-editor">
            <div id="wmd-button-bar"></div>
            <textarea id="wmd-input" value="<?= $row["content"] ?>"></textarea>
          </div>
          <hr>
          <div id="wmd-preview" class="wmd-preview"></div>
          <hr>
        <input class="btn btn-primary" type="submit" value="submit" />
        </form>
      </div>
    </div>
    <script type="text/javascript" src="../public/js/wmd.js"></script>
  </body>
</html>
