<?php include("../../common/pusher.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Notice</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
	<link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
  <script src="/public/js/jquery-ui-1.12.1.min.js"></script>
  <script src="/public/js/base.js"></script>
  <?php include("../../common/script.php"); ?>

	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
	<link rel="stylesheet" href="/public/css/notice.css" type="text/css">
	<link rel="stylesheet" href="/public/css/pusher.css" type="text/css">
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="/public/css/Nwagon.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/comment.js"></script>
	<script src="/public/js/Nwagon.js"></script>
	<script src="/public/js/notice-chart.js"></script>
	<script src="/public/js/pusher.js"></script>
</head>
<body>
	<?php include("../../common/header.php"); ?>

	<?php
		if (isset($_GET["id"])) {
			$db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
			$rows = $db->query("SELECT n.id, name, title, content, time, pinned FROM notice n JOIN user u ON n.u_id = u.id WHERE n.id = ".$_GET["id"]);
			foreach ($rows as $row) {
  ?>

	<div class="container">
		<div class="notice">
			<div class="title">
				<?php
					if ($row["pinned"]) {
						$pin = "pin-on";
					} else {
						$pin = "pin-off";
					}
				?>
				<a class="<?= $pin ?>"></a>
				<h1 id="title_id">
					<span><?= $row["title"] ?></span>
				</h1>
				<div class="notice_info">
					<span><?= $row["name"] ?></span>
					<span><?= $row["time"] ?></span>
				</div>
				<?php if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant")) { ?>
				<div class="notice_btn">
					<a class="btn notice_modify" href="/board/notice/modify.php?id=<?= $row["id"] ?>">수정</a>
					<a class="btn notice_delete" href="/notice/delete.php?id=<?= $row["id"] ?>">삭제</a>
				</div>
				<?php } ?>
			</div>
			<div class="content">
				<?= $row["content"] ?>
			</div>
		</div>
		<!-- comment iterative-->
		<div id="comment-list" class="comment">
				<hr>
				<?php
					$comments = $db->query("SELECT content, name, time, u.id FROM comment c JOIN user u ON c.u_id = u.id WHERE type = 'notice' AND reference_id = ".$row["id"]);
					foreach ($comments as $comment) {
				?>
				<div class="comment-list">
					<span><?= $comment["content"] ?></span>
					<span><?= $comment["name"] ?></span>
					<span class=""><?= $comment["time"] ?></span>
					<?php if ($logged_in && ($_SESSION["auth"] == "professor" || $_SESSION["auth"] == "assistant" || $_SESSION["id"] == $comment["id"])) { ?>
					<div class="comment_btn">
						<a class="btn comment_modify" >수정</a>
						<a class="btn comment_delete" >삭제</a>
					</div>
					<?php } ?>
				</div>
				<hr>
				<?php } ?>
		</div>
		<div id="comment" class="comment">
			<form id="form" action="/comment/create.php" method="POST">
				<label>Comment:</label>
				<div>
					<input id="comment-write" type="text" name="content" />
					<input class="btn commentBtn" id="submit" type="button" value="등록"/>
				</div>
				<input type="hidden" name="id" value="<?= $row["id"] ?>" />
				<input type="hidden" name="type" value="notice">
			</form>
		</div>
	</div>
	<?php
			}
		}
	?>
	<script src="/public/js/star_on_off.js" type="text/javascript"></script>
</body>
</html>
