<?php include("../../common/pusher.php"); ?>

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

	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="/public/js/jquery-ui-1.12.1.min.js"></script>
	<script src="/public/js/base.js"></script>

	<?php include("../../common/script.php"); ?>

	<script type="text/javascript" src="/public/js/showdown.js"></script>
	<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
	<link rel="stylesheet" href="/public/css/pusher.css" type="text/css">
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/comment.js"></script>
	<script src="/public/js/modify-answer.js"></script>
	<script src="/public/js/pusher.js"></script>
</head>
<body>
	<?php include("../../common/header.php"); ?>


	<!-- parameter id=value 로 가져와서 question 내용 보여주기 -->
	<div class="container">

		<?php
		if (isset($_GET["id"])) {
			$db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
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
						<a class="btn question_modify" name="question_modify" href="/board/question/modify.php?id=<?= $_GET["id"] ?>">수정</a>
						<a class="btn question_delete" name="question_delete" href="/question/delete.php?id=<?= $_GET["id"] ?>">삭제</a>
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
						$comments = $db->query("SELECT c.id as c_id, content, name, time, u.id, score FROM comment c JOIN user u ON c.u_id = u.id WHERE type = 'question' AND reference_id = ".$_GET["id"]);
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
								<span class="hidden"><?= $comment["c_id"] ?></span>
								<span class="hidden"><?= $_GET["id"] ?></span>
								<?php if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant" || $_SESSION["id"] == $comment["id"])) { ?>
								<div class="comment_btn">
									<a class="btn comment_modify" name="comment_modify">수정</a>
									<a class="btn comment_delete" name="comment_delete">삭제</a>
								</div>
								<?php } ?>
							</div>
							<hr>
							<?php } ?>
						</div>
						<div class="comment">
							<form action="/comment/create.php" method="POST">
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
									<a class="btn answer_modify" name="answer_modify" href="/board/answer/modify.php?id=<?= $_GET["id"] ?>">수정</a>
									<a class="btn answer_delete" name="answer_delete" href="/answer/delete.php?id=<?= $_GET["id"] ?>">삭제</a>
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
											<span class="hidden"><?= $comment["c_id"] ?></span>
											<span class="hidden"><?= $_GET["id"] ?></span>
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
										<form action="/comment/create.php" method="POST">
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
						$isWriteAnswer = $db->query("SELECT id FROM answer WHERE u_id = $u_id AND q_id = ".$_GET["id"]);
						$num = $isWriteAnswer->rowCount();
						if ($logged_in && $num == 0) { ?>
						<div class="write-answer">
							<h2>Your Answer</h2>
							<form action="/answer/create.php" method="post">
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
