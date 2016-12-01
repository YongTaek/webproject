<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="/public/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="/public/css/noticelist.css">
	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<meta charset="utf-8">
	<title>공지 게시판</title>
</head>
<body>
	<header role ="banner">
		<nav role="navigation" class="banner-color">
			<div id="logo" class="pull-left">
				<a href="/php/main.php"><img class="logo" src="/public/img/selab_logo_S.png" /></a>
			</div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/php/noticelist.php" class="active menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/php/questionlist.php" class="menu-item">QUESTION</a></li>
				<li class="pull-left"><a href="/php/freelist.php" class="menu-item">FREE BOARD</a></li>
			</ul>
			<div role="login" class="pull-right">
				<?php if (isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["auth"])) { ?>
					<a id="login" href="logout.php" class='pull-right'>LOGOUT</a>
					<div class="pull-right vr"></div>
					<a id="mypage" href="#" class='pull-right'><?= $_SESSION["name"] ?> (<?= $_SESSION["auth"] ?>)</a>
				<?php } else { ?>
					<a id="login" href="dologin.php" class='pull-right'>LOGIN</a>
				<?php } ?>
			</div>
			<a href="/view/notice/search"><img src="/public/img/search.png" class="pull-right search-icon"></a>
			<input type="text" class="pull-right search" name="search">
		</nav>
	</header><!-- /header -->
	<div class = "jumbotron banner-color">
		<h1 class="align-center">NOTICE</h1>
		<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
	</div>
	<div class= "content">
		<div class="subheader">
			<a type="button" class="createBtn btn btn-primary" href="create-notice.php">Register Notice</a>
			<h2>ALL NOTICE</h2>
			<ul class="nav nav-tabs">
				<li class="question-tab active"><a href = "/php/noticelist.php">recent</a></li>
			</ul>
		</div>
		<div class= "qlist-wapper">

			<?php
				$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
				$rows = $db->query("SELECT n.id, title, time, name FROM notice n JOIN user u ON n.u_id = u.id ORDER BY time DESC");
				foreach ($rows as $row) {
			?>

			<div class= "question">
				<div class= "question-num-summary">
					<div class= "question-number">
						<div class= "mini-count">
							<span><?= $row["id"] ?></span> <!-- 문제 번호 -->
						</div>
						<div>indexs</div>
					</div>
				</div>
				<div class="question-list-left">
					<h3 class="title">
						<a href= <?= "/php/notice.php?id=".$row["id"] ?> ><?= $row["title"] ?></a> <!-- 제목 -->
					</h3>
					
				</div>
				<div class="question-list-right">
					<a class="star-off" href="#"></a>
					<div>
						<h5 class="date"><?= $row["time"] ?></h5> <!-- 날짜 -->
						<h5 class="name">by. <?= $row["name"] ?></h5> <!--작성자 -->
					</div>
				</div>
			</div>

			<?php } ?>

		</div>
	</div>
	<script src="/public/js/star_on_off.js" type="text/javascript"></script>
</body>
</html>