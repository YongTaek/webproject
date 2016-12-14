<?php include("../../common/pusher.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="/public/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="/public/css/freelist.css">
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
	<title>Free List</title>
</head>
<body>
	<?php include("../../common/header.php"); ?>
	<div class= "content">
		<div class="subheader">
			<?php if ($logged_in) { ?>
			<a type="button" class="createBtn btn btn-primary" href="/board/free/create.php">Post Free</a>
			<?php } ?>
			<h2>ALL FREE</h2>
			<ul class="nav nav-tabs">
				<?php
					if (isset($_GET["type"])) {
						if ($_GET["type"] == "my") { ?>
				<li class="question-tab"><a href = "/board/free/list.php">recent</a></li>
				<li class="question-tab active"><a href = "/board/free/list.php?type=my">My Free</a></li>
						<?php } else { ?>
				<li class="question-tab active"><a href = "/board/free/list.php">recent</a></li>
				<li class="question-tab"><a href = "/board/free/list.php?type=my">My Free</a></li>
						<?php } } else { ?>
				<li class="question-tab active"><a href = "/board/free/list.php">recent</a></li>
				<li class="question-tab"><a href = "/board/free/list.php?type=my">My Free</a></li>
					<?php } ?>
			</ul>
		</div>
		<div class= "qlist-wapper">
		<?php
			$db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
			if (isset($_GET["type"])) {
				if ($_GET["type"] == "my") {
					$b_rows = $db->query("SELECT b.id, b.title, time, u.name, pinned FROM board b JOIN user u on b.u_id = u.id WHERE b.u_id = ".$_SESSION["id"]." ORDER BY time DESC");
				} else {
					$b_rows = $db->query("SELECT b.id, b.title, time, u.name, pinned FROM board b JOIN user u on b.u_id = u.id ORDER BY pinned DESC, time DESC");
				}
			} else {
				$b_rows = $db->query("SELECT b.id, b.title, time, u.name, pinned FROM board b JOIN user u on b.u_id = u.id ORDER BY pinned DESC, time DESC");
			}
			foreach ($b_rows as $row) {
		?>
			<div class= "question">
				<div class= "question-num-summary">
					<div class= "question-number">
						<div class= "mini-count">
							<span><?= $row["id"] ?></span> <!-- 문제 번호 -->
						</div>
						<div>indexs</div>
					</div>
					<div class= "comment-number">
						<div class= "mini-count">
							<span><?= ($db->query("SELECT distinct id FROM comment WHERE type = 'board' AND reference_id = ".$row["id"]))->rowCount() ?></span> <!-- 댓글 -->
						</div>
						<div>comments</div>
					</div>

				</div>
				<div class="question-list-left">
					<h3 class="title">
						<a href="/board/free/post.php?id=<?= $row["id"] ?>"><?= $row["title"] ?></a> <!-- 제목 -->
					</h3>
				</div>
				<div class="question-list-right">
					<div>
						<h5 class="date"><?= $row["time"] ?></h5> <!-- 날짜 -->
						<h5 class="name">by. <?= $row["name"] ?></h5> <!--작성자 -->
					</div>
					<div class="on-off">
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
			<?php }
			?>
		</div>
	</div>
	<script src="/public/js/star_on_off.js" type="text/javascript"></script>
</body>
</html>
