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
	<link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
	<link rel="stylesheet" href="/public/css/question.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="/public/css/wmd.css" />
	<script type="text/javascript">
		<?php if (isset($_SESSION["id"]) && isset($_SESSION["favQuestion"]) && isset($_SESSION["openLecture"])) { ?>
			var questionArray = <?php echo json_encode($_SESSION["favQuestion"]); ?>;
			var lectureArray = <?php echo json_encode($_SESSION["openLecture"]); ?>;
		<?php } ?>
	</script>
	<script type="text/javascript" src="/public/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/public/js/showdown.js"></script>
	<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
	<link rel="stylesheet" href="/public/css/pusher.css" type="text/css">
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/push.js"></script>
	<script src="../public/js/question.js"></script>
	<script src="/public/js/modify-answer.js"></script>
	<script src="/public/js/pusher.js"></script>

</head>
<body>
	<header role = "banner" class="banner-color">
		<nav role="navigation" >
			<div id="logo" class="pull-left"><a href="/php/main.php"><img class="logo" src="/public/img/selab_logo_S.png" /></a></div>
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
				<?php
					if ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant") {
						$href = "/php/setting.php";
					} else {
						$href = "/php/changepw.php";
					}
				?>
				<a id="mypage" href="<?= $href ?>" class='pull-right'><?= $_SESSION["name"] ?> (<?= $_SESSION["auth"] ?>)</a>
				<?php } else { ?>
				<a id="login" href="dologin.php" class='pull-right'>LOGIN</a>
				<?php } ?>
			</div>
			<a href="/view/question/search"><img src="/public/img/search.png" class="pull-right search-icon"></a>
			<input type="text" class="pull-right search" name="search">
		</nav>
		<div class = "jumbotron banner-color">
			<h1 class="align-center">Q & A</h1>
			<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
		</div>
	</header>

	<!-- parameter id=value 로 가져와서 question 내용 보여주기 -->
	<div class="container">

		<?php
		if (isset($_GET["id"])) {
			$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
			$rows = $db->query("SELECT title, score, content, u.id, name, time, pinned FROM question q JOIN user u ON q.u_id = u.id WHERE q.id = ".$_GET["id"]);
			foreach ($rows as $row) {
				?>

				<div class="question">
					<!-- qeustion title -->
					<h1 id="question_title"><?= $row["title"] ?></h1>
					<div class="question_info">
						<?php
						if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant"))
							$name = $row["name"];
						else
							$name = "anonymous";
						?>
						<span><?= $name ?></span>
						<span><?= $row["time"] ?></span>
					</div>
					<?php if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant" || $_SESSION["id"] == $row["id"])) { ?>
					<div class="question_btn">
						<a class="btn question_modify" name="question_modify" href="modify_question.php?id=<?= $_GET["id"] ?>">수정</a>
						<a class="btn question_delete" name="question_delete" href="delete_question.php?id=<?= $_GET["id"] ?>">삭제</a>
					</div>
					<?php } ?>
					<hr>
					<div>
						<div class="vote">
							<?php
								if ($row["pinned"]) {
									$pin = "pin-on";
								} else {
									$pin = "pin-off";
								}
							?>
							<a class="<?= $pin ?>"></a>
							<?php
								if ($logged_in) {
									$fav = $db->query("SELECT u_id, q_id FROM favorite WHERE u_id = ".$_SESSION["id"]." AND q_id = ".$_GET["id"]);
									$count = $fav->rowCount();
									if ($count > 0) {
										$star = "star-on";
									} else {
										$star = "star-off";
									}
								} else {
									$star = "star-off";
								}
							?>
							<a class="vote-up-off"></a>
							<!-- 추천 수 -->
							<span class="vote-count"><?= $row["score"] ?></span>
							<a class="vote-down-off"></a>
							<a class="<?= $star ?>"></a>
						</div>
						<!-- question 내용 -->
						<div class="content">
							<?= $row["content"] ?>
						</div>
					</div>
				</div>
				<!-- comment iterative -->
				<div class="about-comment">
					<div class="comment">
						<hr>
						<?php
						$comments = $db->query("SELECT content, name, time, u.id, score FROM comment c JOIN user u ON c.u_id = u.id WHERE type = 'question' AND reference_id = ".$_GET["id"]);
						foreach ($comments as $comment) {
							?>
							<div>
								<span><?= $comment["content"] ?></span>
								<?php
								if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant"))
									$name = $comment["name"];
								?>
								<span><?= $name ?></span>
								<span><?= $comment["time"] ?></span>
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
									<input class="comment-write" type="text" name="content" />
									<input class="btn commentBtn submit" id="submit" type="button" value="등록"/>
								</div>
								<input type="hidden" name="id" value="<?= $_GET["id"] ?>" />
								<input type="hidden" name="type" value="question">
							</form>
						</div>
					</div>
					<!-- question에 대한 answer -->
					<?php
					$answers = $db->query("SELECT a.id, name, score, content, u.id, time FROM answer a JOIN user u WHERE u.id = a.u_id AND q_id = ".$_GET["id"]);
					$count = $answers->rowCount();

					if ($count > 0) {
						foreach ($answers as $answer) {
							?>
							<div class="answer">
								<h2 id="answer_title"><?= $count ?> Answer</h2>
								<div class="answer_info">
									<?php
									if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant"))
										$name = $answer["name"];
									?>
									<span><?= $name ?></span>
									<span><?= $answer["time"] ?></span>
								</div>
								<?php if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant" || $_SESSION["id"] == $answer["id"])) { ?>
								<div class="answer_btn">
									<a class="btn answer_modify" name="answer_modify" href="/php/modify-answer-page.php">수정</a>
									<a class="btn answer_delete" name="answer_delete" href="delete_answer.php?id=<?= $_GET["id"] ?>">삭제</a>
								</div>
								<?php } ?>
								<hr>
								<div class="overflow">
									<div class="vote">
										<a class="vote-up-off"></a>
										<!-- answer 추천 수 -->
										<span class="vote-count"><?= $answer["score"] ?></span>
										<a class="vote-down-off"></a>
									</div>
									<div class="content">
										<?= $answer["content"] ?>
									</div>
								</div>
								<hr>
							</div>
							<!-- comment iterative -->
							<div class="about-comment">
								<div class="comment">
									<?php
									$comments = $db->query("SELECT content, name, time, u.id, score FROM comment c JOIN user u ON c.u_id = u.id WHERE type = 'answer' AND reference_id = ".$answer[0]);
									foreach ($comments as $comment) {
										?>
										<div>
											<span><?= $comment["content"] ?></span>
											<?php
											if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant"))
												$name = $row["name"];
											?>
											<span><?= $name ?></span>
											<span><?= $comment["time"] ?></span>
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
												<input class="comment-write" type="text" name="content" />
												<input class="commentBtn" id="submit" type="button" value="등록"/>
											</div>
											<input type="hidden" name="id" value="<?= $answer[0] ?>" />
											<input type="hidden" name="type" value="answer">
										</form>
									</div>
								</div>
								<?php
							}
						}
						?>
						<?php 
						$u_id = $_SESSION["id"];
						$isWriteAnswer = $db->query("SELECT id FROM answer WHERE u_id = $u_id AND q_id = ."$_GET["id"]);
						$num = $isWriteAnswer->rowCount();
						if ($logged_in && $num > 0) { ?>
						<div class="write-answer">
							<h2>Your Answer</h2>
							<form action="create_answer.php" method="post">
								<div id="wmd-editor">
									<div id="wmd-button-bar"></div>
									<textarea id="wmd-input" name="answer"></textarea>
								</div>
								<hr>
								<div id="wmd-preview" class="wmd-preview"></div>
								<hr>
								<input class="btn btn-primary" type="submit" value="submit" />
								<input type="hidden" name="id" value="<?= $_GET["id"] ?>">
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
