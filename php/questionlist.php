<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="../public/css/questionlist.css">
	<link rel="stylesheet" href="../public/css/base.css" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
	<meta charset="utf-8">
	<title>질문 게시판</title>
</head>
<body>
	<header role ="banner">
		<nav role="navigation" class="banner-color">
			<div id="logo" class="pull-left">
				<a href="/php/main.php"><img class="logo" src="/public/img/selab_logo_S.png" /></a>
			</div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/php/noticelist.php" class="menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/php/questionlist.php" class="menu-item active">QUESTION</a></li>
				<li class="pull-left"><a href="/php/freelist.php" class="menu-item">FREE BOARD</a></li>
			</ul>
			<div role="login" class="pull-right"></div>
			<a id="login" href="/php/dologin.php" class='pull-right'>LOGIN</a>
		</nav>
	</header><!-- /header -->
	<div class = "jumbotron banner-color">
		<h1 class="align-center">QUESTIONS</h1>
		<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
	</div>
	<div class= "content">
		<div class="subheader">
			<a type="button" class="createBtn btn btn-primary" href="/questions/create">Ask Question</a>
			<h2>ALL QUESTION</h2>
			<ul class="nav nav-tabs">
				<li class="question-tab active"><a herf = "/recent">recent</a></li>
				<li class="question-tab"><a href = "/recommend">recommend</a></li>
			</ul>
		</div>
		<div class= "qlist-wapper">
			<?php
				$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
				$rows = $db->query("SELECT q.id, title, time, score, name FROM question q JOIN user u ON q.u_id = u.id");
				foreach ($rows as $row) {
			?>
			<div class= "question">
				<div class= "question-num-summary">
					<div class= "question-number">
						<div class= "mini-count">
							<span><?= $row["id"] ?></span>
						</div>
						<div>indexs</div>
					</div>
					<div class= "vote-number-active">
						<div class= "mini-count">
							<span><?= $row["score"] ?></span>
						</div>
						<div>votes</div>
					</div>
					<div class= "answer-number">
						<div class= "mini-count">
							<span><?= ($db->query("SELECT id FROM answer WHERE q_id = ".$row["id"]))->rowCount() ?></span>
						</div>
						<div>answers</div>
					</div>

				</div>
				<div class="question-list-left">
					<h3 class="title">
						<a href= <?= "/php/question.php?id=".$row["id"] ?> ><?= $row["title"] ?></a>
					</h3>
					<div class= "tags">
						<?php
							$tags = $db->query("SELECT id, name FROM tag WHERE q_id = ".$row["id"]);
							foreach ($tags as $tag) {
						?>
						<a href="" class= "tag"><?= $tag["name"] ?></a>
						<?php
							}
						?>
					</div>
				</div>
				<div class="question-list-right">
					<a class="star-off" href="#"></a>
					<div>
						<h5 class="date"><?= $row["time"] ?></h5>
						<h5 class="name">by. <?= $row["name"] ?></h5>
					</div>
				</div>
			</div>
			<?php
				}
			?>
		</div>
		<script src="../public/js/star_on_off.js" type="text/javascript"></script>
	</body>
	</html>
