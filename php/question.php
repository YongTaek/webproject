<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Question</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
  <script type="text/javascript" src="../public/js/jquery-3.1.1.min.js"></script>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="../public/css/base.css" type="text/css">
	<link rel="stylesheet" href="../public/css/question.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="../public/css/wmd.css" />
	<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
</head>
<body>
	<header role = "banner" class="banner-color">
		<nav role="navigation" >
			<div id="logo" class="pull-left"><a href="/php/main.php"><img class="logo" src="../public/img/selab_logo_S.png" /></a></div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/php/noticelist.php" class="menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/php/questionlist.php" class="menu-item active">QUESTION</a></li>
				<li class="pull-left"><a href="/php/freelist.php" class="menu-item">FREE BOARD</a></li>
			</ul>
			<div role="login" class="pull-right">
				<a id="login" href="/php/dologin.php">LOGIN</a>
			</div>
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
			<h2><?= $count ?> Answer</h2>
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
		<?php
				}
			}
		?>
		<hr>
	</div>
		<div>
			<h2>Your Answer</h2>
			<div id="post-editor" class="post-editor js-post-editor">
				<div class="wmd-container">
            <div id="wmd-button-bar" class="wmd-button-bar"></div>
            <textarea id="wmd-input" class="wmd-input processed" name="post-text" cols="92" rows="15" tabindex="101" data-min-length="">
            </textarea>
        </div>
				<div id="wmd-preview" class="wmd-panel"></div>
				<div id="wmd-output" class="wmd-panel"></div>
			</div>
		</div>
		<?php
				}
			}
		?>
	</div>
	<script type="text/javascript" src="../public/js/wmd.js"></script>
</body>
</html>
