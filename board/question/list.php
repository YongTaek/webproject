<?php include("../common/pusher.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="/public/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="/public/css/questionlist.css">
	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
	<link rel="stylesheet" href="/public/css/pusher.css" type="text/css">
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">

	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="/public/js/jquery-ui-1.12.1.min.js"></script>
	<script src="/public/js/base.js"></script>

	<?php include("../../common/script.php"); ?>

	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/push.js"></script>
	<script src="/public/js/pusher.js"></script>
	<meta charset="utf-8">
	<title>질문 게시판</title>
</head>
<body>
	<?php include("../../common/header.php"); ?>

	<div class= "content">
		<div class="subheader">
			<?php if ($logged_in) { ?>
			<a type="button" class="createBtn btn btn-primary" href="/board/question/create.php">Ask Question</a>
			<?php } ?>
			<h2>ALL QUESTION</h2>
			<ul class="nav nav-tabs">
				<?php
					if (isset($_GET["type"])) {
						if ($_GET["type"] == "recommend") { ?>
				<li class="question-tab"><a href = "/board/question/list.php">recent</a></li>
				<li class="question-tab active"><a href = "/board/question/list.php?type=recommend">recommend</a></li>
				<li class="question-tab"><a href = "/board/question/list.php?type=my">My QnA</a></li>
				<li class="question-tab"><a href = "/board/question/list.php?type=favorite">Favorite</a></li>
						<?php } elseif ($_GET["type"] == "my") { ?>
				<li class="question-tab"><a href = "/board/question/list.php">recent</a></li>
				<li class="question-tab"><a href = "/board/question/list.php?type=recommend">recommend</a></li>
				<li class="question-tab active"><a href = "/board/question/list.php?type=my">My QnA</a></li>
				<li class="question-tab"><a href = "/board/question/list.php?type=favorite">Favorite</a></li>
						<?php } elseif ($_GET["type"] == "favorite") { ?>
				<li class="question-tab"><a href = "/board/question/list.php">recent</a></li>
				<li class="question-tab"><a href = "/board/question/list.php?type=recommend">recommend</a></li>
				<li class="question-tab"><a href = "/board/question/list.php?type=my">My QnA</a></li>
				<li class="question-tab active"><a href = "/board/question/list.php?type=favorite">Favorite</a></li>
						<?php } else { ?>
				<li class="question-tab active"><a href = "/board/question/list.php">recent</a></li>
				<li class="question-tab"><a href = "/board/question/list.php?type=recommend">recommend</a></li>
				<li class="question-tab"><a href = "/board/question/list.php?type=my">My QnA</a></li>
				<li class="question-tab"><a href = "/board/question/list.php?type=favorite">Favorite</a></li>
						<?php } } else { ?>
				<li class="question-tab active"><a href = "/board/question/list.php">recent</a></li>
				<li class="question-tab"><a href = "/board/question/list.php?type=recommend">recommend</a></li>
				<li class="question-tab"><a href = "/board/question/list.php?type=my">My QnA</a></li>
				<li class="question-tab"><a href = "/board/question/list.php?type=favorite">Favorite</a></li>
					<?php } ?>
			</ul>
		</div>
		<div class= "qlist-wapper">
			<?php
				$db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
				if (isset($_GET["type"])) {
					if ($_GET["type"] == "recommend") {
						$rows = $db->query("SELECT q.id, title, time, score, name, pinned FROM question q JOIN user u ON q.u_id = u.id ORDER BY pinned DESC, score DESC");
					} elseif ($_GET["type"] == "my") {
						$rows = $db->query("SELECT q.id, title, time, score, name, pinned FROM question q JOIN user u ON q.u_id = u.id WHERE q.u_id = ".$_SESSION["id"]." ORDER BY time DESC");
					} elseif ($_GET["type"] == "favorite") {
						$rows = $db->query("SELECT q.id, title, time, score, name, pinned FROM question q JOIN user u ON q.u_id = u.id JOIN favorite f ON q.id = f.q_id WHERE f.u_id = ".$_SESSION["id"]." ORDER BY pinned DESC, time DESC");
					} else {
						$rows = $db->query("SELECT q.id, title, time, score, name, pinned FROM question q JOIN user u ON q.u_id = u.id ORDER BY pinned DESC, time DESC");
					}
				} else {
					$rows = $db->query("SELECT q.id, title, time, score, name, pinned FROM question q JOIN user u ON q.u_id = u.id ORDER BY pinned DESC, time DESC");
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
						<a href= <?= "/board/question/post.php?id=".$row["id"] ?> ><?= $row["title"] ?></a>
					</h3>
					<div class= "tags">
						<?php
							$tags = $db->query("SELECT distinct name, t.id FROM tag_question tq JOIN tag t WHERE t_id = id AND q_id = ".$row["id"]);
							foreach ($tags as $tag) {
						?>
						<a href="/board/question/list-tag.php?id=<?= $tag["id"] ?>" class= "tag"><?= $tag["name"] ?></a>
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
						<?php
							if ($logged_in) {
								$fav = $db->query("SELECT u_id, q_id FROM favorite WHERE u_id = ".$_SESSION["id"]." AND q_id = ".$row["id"]);
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
						<a class="<?= $star ?>"></a>
						<?php
							if ($row["pinned"]) {
								$pin = "pin-on";
							} else {
								$pin = "pin-off";
							}
						?>
						<a class="<?= $pin ?>"></a>
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
