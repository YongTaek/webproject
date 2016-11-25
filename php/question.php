<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Question</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
  <script type="text/javascript" src="/public/js/jquery-3.1.1.min.js"></script>
	<link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
	<link rel="stylesheet" href="/public/css/question.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="/public/css/wmd.css" />
	<script type="text/javascript" src="/public/js/showdown.js"></script>
	<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
</head>
<body>
	<header role = "banner" class="banner-color">
		<nav role="navigation" >
			<div id="logo" class="pull-left"><a href="/php/main.php"><img class="logo" src="/public/img/selab_logo_S.png" /></a></div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/php/noticelist.php" class="menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/php/questionlist.php" class="menu-item active">QUESTION</a></li>
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
			<a href="/view/question/search"><img src="/public/img/search.png" class="pull-right search-icon"></a>
			<input type="text" class="pull-right search" name="search">
		</nav>
		<div class = "jumbotron banner-color">
			<h1 class="align-center">Notice</h1>
			<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
		</div>
	</header>

	<!-- parameter id=value 로 가져와서 question 내용 보여주기 -->
	<div class="container">

		<?php
			if (isset($_GET["id"])) {
				$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
				$rows = $db->query("SELECT title, score, content FROM question WHERE id = ".$_GET["id"]);
				foreach ($rows as $row) {
		?>

		<div class="question">
			<!-- qeustion title -->
			<h1 id="question_title"><?= $row["title"] ?></h1>
			<hr>
			<div>
				<div class="vote">
					<a class="vote-up-off"></a>
					<!-- 추천 수 -->
					<span class="vote-count"><?= $row["score"] ?></span>
					<a class="vote-down-off"></a>
					<a class="star-off"></a>
				</div>
				<!-- question 내용 -->
				<div class="content">
					<?= $row["content"] ?>
				</div>
			</div>
		</div>
		<!-- question에 대한 answer -->
		<?php
			$answers = $db->query("SELECT score, content FROM answer WHERE q_id = ".$_GET["id"]);
			$count = $answers->rowCount();

			if ($count > 0) {
				foreach ($answers as $answer) {
		?>
		<div class="answer">
			<h2 id="answer_title"><?= $count ?> Answer</h2>
			<div class="answer_btn">
				<a class="btn answer_modify" name="answer_modify" href="">수정</a>
				<a class="btn answer_delete" name="answer_delete" href="">삭제</a>
			</div>
			<hr>
			<div class="overflow">
				<div class="vote">
					<a class="vote-up-off"></a>
					<!-- answer 추천 수 -->
					<span class="vote-count"><?= $answer["score"] ?></span>
					<a class="vote-down-off"></a>
					<a class="star-off"></a>
				</div>
				<div class="content">
					<?= $row["content"] ?>
				</div>
			</div>
			<hr>
		</div>
		<?php
				}
			}
		?>
		<div class="write-answer">
			<h2>Your Answer</h2>
			<form action="question.php">
				<div id="wmd-editor">
        			<div id="wmd-button-bar"></div>
        			<textarea id="wmd-input"></textarea>
    		</div>
				<hr>
				<div id="wmd-preview" class="wmd-preview"></div>
				<hr>
			<input class="btn btn-primary" type="submit" value="submit" />
			</form>
		</div>
		<?php
				}
			}
		?>
	</div>
	<script type="text/javascript" src="/public/js/wmd.js"></script>
	<script src="/public/js/star_on_off.js" type="text/javascript"></script>
</body>
</html>
