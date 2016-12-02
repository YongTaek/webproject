<?php
	session_start();
	$logged_in = false;
	if (isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["auth"])) {
		$logged_in = true;
	}
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
				<?php if ($logged_in) { ?>
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
				$rows = $db->query("SELECT title, score, content, u.id FROM question q JOIN user u WHERE q.id = ".$_GET["id"]);
				foreach ($rows as $row) {
		?>

		<div class="question">
			<!-- qeustion title -->
			<h1 id="question_title"><?= $row["title"] ?></h1>
			<?php if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant" || $_SESSION["id"] == $row["id"])) { ?>
			<div class="question_btn">
				<a class="btn question_modify" name="question_modify" href="modify_question.php?id=<?= $_GET["id"] ?>">수정</a>
				<a class="btn question_delete" name="question_delete" href="delete_question.php?id=<?= $_GET["id"] ?>">삭제</a>
			</div>
			<?php } ?>
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
		<!-- comment iterative -->
		<div class="comment">
			<hr>
			<?php
				$comments = $db->query("SELECT content, name, time, u.id FROM comment c JOIN user u ON c.u_id = u.id WHERE type = 'question' AND reference_id = ".$_GET["id"]);
				foreach ($comments as $comment) {
			?>
			<div>
					<span><?= $comment["content"] ?></span>
					<span><?= $comment["name"] ?></span>
					<span class=""><?= $comment["time"] ?></span>
					<?php if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant" || $_SESSION["id"] == $comment["id"] )) { ?>
					<div class="comment_btn">
						<a class="btn comment_modify" name="comment_modify" href="">수정</a>
						<a class="btn comment_delete" name="comment_delete" href="">삭제</a>
					</div>
					<?php } ?>
			</div>
			<hr>
			<?php } ?>
		</div>
		<div class="comment">
			<form action="create_comment.php" method="POST">
				<label>Comment:</label>
				<div>
					<input id="comment-write" type="text" name="comment" />
					<input class="btn" id="submit" type="submit" value="등록"/>
				</div>
				<input type="hidden" name="id" value="<?= $_GET["id"] ?>" />
				<input type="hidden" name="type" value="question">
			</form>
		</div>
		<!-- question에 대한 answer -->
		<?php
			$answers = $db->query("SELECT a.id, name, score, content, u.id FROM answer a JOIN user u WHERE u.id = a.u_id AND q_id = ".$_GET["id"]);
			$count = $answers->rowCount();

			if ($count > 0) {
				foreach ($answers as $answer) {
		?>
		<div class="answer">
			<h2 id="answer_title"><?= $count ?> Answer</h2>
			<?php if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant" || $_SESSION["id"] == $answer["u.id"])) { ?>
			<div class="answer_btn">
				<a class="btn answer_modify" name="answer_modify" href="">수정</a>
				<a class="btn answer_delete" name="answer_delete" href="">삭제</a>
			</div>
			<?php } ?>
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
					<?= $answer["content"] ?>
				</div>
			</div>
		</div>
		<!-- comment iterative -->
		<div class="comment">
			<hr>
			<?php
				$comments = $db->query("SELECT content, name, time, u.id FROM comment c JOIN user u ON c.u_id = u.id WHERE type = 'answer' AND reference_id = ".$answer["a.id"]);
				foreach ($comments as $comment) {
			?>
			<div>
					<span><?= $comment["content"] ?></span>
					<span><?= $comment["name"] ?></span>
					<span class=""><?= $comment["time"] ?></span>
					<?php if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant" || $_SESSION["id"] == $comment["id"])) { ?>
					<div class="comment_btn">
						<a class="btn comment_modify" name="comment_modify" href="">수정</a>
						<a class="btn comment_delete" name="comment_delete" href="">삭제</a>
					</div>
					<?php } ?>
			</div>
			<hr>
			<?php } ?>
		</div>
		<div class="comment">
			<form action="create_comment.php" method="POST">
				<label>Comment:</label>
				<div>
					<input id="comment-write" type="text" name="comment" />
					<input class="btn" id="submit" type="submit" value="등록"/>
				</div>
				<input type="hidden" name="id" value="<?= $answer["id"] ?>" />
				<input type="hidden" name="type" value="answer">
			</form>
		</div>
		<?php
				}
			}
			if ($logged_in) {
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
			}
		?>
	</div>
	<script type="text/javascript" src="/public/js/wmd.js"></script>
	<script src="/public/js/star_on_off.js" type="text/javascript"></script>
</body>
</html>