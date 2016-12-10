<?php include("./common/pusher.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/public/css/bootstrap.min.css" type="text/css">
  	<link rel="stylesheet" href="/public/css/base.css" type="text/css">

    <script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="/public/js/jquery-ui-1.12.1.min.js"></script>
    <script src="/public/js/base.js"></script>
    <?php include("./common/script.php"); ?>
    
    <link rel="stylesheet" type="text/css" href="/public/css/wmd.css" />
    <link rel="stylesheet" type="text/css" href="/public/css/create-post.css" />
    <link rel="stylesheet" href="../public/css/pusher.css" type="text/css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//js.pusher.com/3.2/pusher.min.js"></script>
    <script src="/public/js/push.js"></script>
  	<script type="text/javascript" src="/public/js/showdown.js"></script>
    
    <title>글쓰기</title>
  </head>
  <body>
    <header role = "banner" class="banner-color">
  		<nav role="navigation" >
  			<div id="logo" class="pull-left"><a href="/view/main.php"><img class="logo" src="../public/img/selab_logo_S.png" /></a></div>
  			<ul id="menu" class="inline-list pull-left">
  				<li class="pull-left"><a href="/view/noticelist.php" class="menu-item" >NOTICE</a></li>
  				<li class="pull-left"><a href="/view/questionlist.php" class="menu-item active">QUESTION</a></li>
  				<li class="pull-left"><a href="/view/freelist.php" class="menu-item">BOARD</a></li>
          <li class="pull-left"><a href="/view/lecture-list.php" class="menu-item">LECTURE</a></li>
  			</ul>
  			<div role="login" class="pull-right">
  				<?php if (isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["auth"])) { ?>
            <a id="login" href="logout.php" class='pull-right'>LOGOUT</a>
            <div class="pull-right vr"></div>
            <a id="mypage" href="/php/changepw.php" class='pull-right'><?= $_SESSION["name"] ?> (<?= $_SESSION["auth"] ?>)</a>
            <ul class="hidden" id="setting">
              <li><a href="user-setting.php">Setting</a></li>
            </ul>
          <?php } else { ?>
            <a id="login" href="dologin.php" class='pull-right'>LOGIN</a>
          <?php } ?>
  			</div>
  			<button class="pull-right">
        <img src="/public/img/search.png" class="search-icon">
      </button>
      <form method="post" id = "search-content" action="/php/search-page.php">
      <input type="text" class="pull-right search" name="search">
      </form>
  		</nav>
  		<div class = "jumbotron banner-color">
  			<h1 class="align-center">Create Post</h1>
  			<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
  		</div>
  	</header>
    <?php
      $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
      $id = $_GET["id"];
      $u_id = $_SESSION["id"];
      $rows = $db->query("SELECT title, content FROM board WHERE u_id = $u_id AND id = $id");
      if ($rows->rowCount() > 0) {
        $row = $rows->fetch();
    ?>
    <div class="container">
      <div class="write-answer">
        <form action="/free/modify.php" method="POST">
          <h2>Title</h2>
          <div class="title">
            <input name="title" type="text" value="<?= $row["title"] ?>">
          </div>
          <h2>Content</h2>
          <div class="content" id="wmd-editor">
            <div id="wmd-button-bar"></div>
            <textarea id="wmd-input" name="content"><?= $row["content"] ?></textarea>
          </div>
          <hr>
          <div id="wmd-preview" class="wmd-preview"></div>
          <hr>
          <div class='buttons'>
            <input class='btn btn-primary' type='submit' value="submit">
            <button class='btn btn-primary'>cancel</button>
          </div>
          <input type="hidden" name="id" value="<?= $id ?>">
        </form>
      </div>
    </div>
    <?php }?>
    <script type="text/javascript" src="../public/js/wmd.js"></script>
  </body>
</html>
