<?php
	session_start();
	$logged_in = false;
	if (isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["auth"])) {
		$logged_in = true;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="/public/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="/public/css/questionlist.css">
	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/public/css/pusher.css" type="text/css">
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/push.js"></script>
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
				<li class="pull-left"><a href="/php/lecture-list.php" class="menu-item">LECTURE</a></li>
			</ul>
			<div role="login" class="pull-right">
				<?php if ($logged_in) { ?>
					<a id="login" href="logout.php" class='pull-right'>LOGOUT</a>
					<div class="pull-right vr"></div>
					<a id="mypage" href="#" class='pull-right'><?= $_SESSION["name"] ?> (<?= $_SESSION["auth"] ?>)</a>
				<?php } else { ?>
					<a id="login" href="dologin.php" class='pull-right'>LOGIN</a>
				<?php } ?>
			</div>
			<a href="/view/question/search"><img src="/public/img/search.png" class="pull-right search-icon"></a>
			<input type="text" class="pull-right search" name="search">
		</nav>
	</header><!-- /header -->
	<div class = "jumbotron banner-color">
		<h1 class="align-center">QUESTIONS</h1>
		<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
	</div>
	<div class= "content">
		<div class="subheader">
			<?php if ($logged_in) { ?>
			<a type="button" class="createBtn btn btn-primary" href="/php/create-question.php">Ask Question</a>
			<?php } ?>
			<h2>ALL QUESTION</h2>
			<ul class="nav nav-tabs">
				<?php
					if (isset($_GET["type"])) {
						if ($_GET["type"] == "recommend") { ?>
				<li class="question-tab"><a href = "/php/questionlist.php">recent</a></li>
				<li class="question-tab active"><a href = "/php/questionlist.php?type=recommend">recommend</a></li>
				<li class="question-tab"><a href = "/php/questionlist.php?type=my">My QnA</a></li>
				<li class="question-tab"><a href = "/php/questionlist.php?type=favorite">Favorite</a></li>
						<?php } elseif ($_GET["type"] == "my") { ?>
				<li class="question-tab"><a href = "/php/questionlist.php">recent</a></li>
				<li class="question-tab"><a href = "/php/questionlist.php?type=recommend">recommend</a></li>
				<li class="question-tab active"><a href = "/php/questionlist.php?type=my">My QnA</a></li>
				<li class="question-tab"><a href = "/php/questionlist.php?type=favorite">Favorite</a></li>
						<?php } elseif ($_GET["type"] == "favorite") { ?>
				<li class="question-tab"><a href = "/php/questionlist.php">recent</a></li>
				<li class="question-tab"><a href = "/php/questionlist.php?type=recommend">recommend</a></li>
				<li class="question-tab"><a href = "/php/questionlist.php?type=my">My QnA</a></li>
				<li class="question-tab active"><a href = "/php/questionlist.php?type=favorite">Favorite</a></li>
						<?php } else { ?>
				<li class="question-tab active"><a href = "/php/questionlist.php">recent</a></li>
				<li class="question-tab"><a href = "/php/questionlist.php?type=recommend">recommend</a></li>
				<li class="question-tab"><a href = "/php/questionlist.php?type=my">My QnA</a></li>
				<li class="question-tab"><a href = "/php/questionlist.php?type=favorite">Favorite</a></li>
						<?php } } else { ?>
				<li class="question-tab active"><a href = "/php/questionlist.php">recent</a></li>
				<li class="question-tab"><a href = "/php/questionlist.php?type=recommend">recommend</a></li>
				<li class="question-tab"><a href = "/php/questionlist.php?type=my">My QnA</a></li>
				<li class="question-tab"><a href = "/php/questionlist.php?type=favorite">Favorite</a></li>
					<?php } ?>
			</ul>
		</div>
		<div class= "qlist-wapper">
			<?php
				$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
				if (isset($_GET["type"])) {
					if ($_GET["type"] == "recommend") {
						$rows = $db->query("SELECT q.id, title, time, score, name FROM question q JOIN user u ON q.u_id = u.id ORDER BY score DESC");
					} elseif ($_GET["type"] == "my") {
						$rows = $db->query("SELECT q.id, title, time, score, name FROM question q JOIN user u ON q.u_id = u.id WHERE q.u_id = ".$_SESSION["id"]." ORDER BY time DESC");
					} elseif ($_GET["type"] == "favorite") {
						$rows = $db->query("SELECT q.id, title, time, score, name FROM question q JOIN user u ON q.u_id = u.id JOIN favorite f ON q.id = f.q_id WHERE f.u_id = ".$_SESSION["id"]." ORDER BY time DESC");
					} else {
						$rows = $db->query("SELECT q.id, title, time, score, name FROM question q JOIN user u ON q.u_id = u.id ORDER BY time DESC");
					}
				} else {
					$rows = $db->query("SELECT q.id, title, time, score, name FROM question q JOIN user u ON q.u_id = u.id ORDER BY time DESC");
				}
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
					<div class= "vote-number">
						<div class= "mini-count">
							<span><?= $row["score"] ?></span>
						</div>
						<div>votes</div>
					</div>
					<div class= "answer-number-active">
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
							$tags = $db->query("SELECT distinct name FROM tag_question tq JOIN tag t WHERE t_id = id AND q_id = ".$row["id"]);
							foreach ($tags as $tag) {
						?>
						<a href="tag_questionlist.php?id=<?= $tag["name"] ?>" class= "tag"><?= $tag["name"] ?></a>
						<?php
							}
						?>
					</div>
				</div>
				<div class="question-list-right">
					<div>
						<h5 class="date"><?= $row["time"] ?></h5>
						<?php
							if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant"))
								$name = $row["name"];
							else
								$name = "anonymous";
						?>
						<h5 class="name">by. <?= $name ?></h5>
					</div>
					<div class="on-off">
						<a class="star-off" href="#"></a>
						<a class="pin-off" href="#"></a>
					</div>
				</div>
			</div>
			<?php
				}
			?>
		</div>
		<script src="/public/js/star_on_off.js" type="text/javascript"></script>
	</body>
</html>