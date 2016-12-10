<?php include("/common/pusher.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
	<link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="/public/css/main.css" type="text/css">
	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
	<link rel="stylesheet" href="/public/css/sidebar.css" type="text/css">
	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="/public/js/jquery-ui-1.12.1.min.js"></script>
	<script src="/public/js/base.js"></script>

	<?php include("/common/script.php") ?>

	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/push.js"></script>
	<script src="/public/js/pusher.js"></script>
</head>
<body>
	<?php include("/common/header.php") ?>
	<div class="main">
		<div class="container">
			<div class = "col-lg-6">
				<a class="h2" href="/php/noticelist.php"><h2>Notice</h2></a>
				<hr/>
				<ul>
					<?php
						$rows = $db->query("SELECT id, title, DATE_FORMAT(time, '%Y-%m-%d') FROM notice ORDER BY DATE_FORMAT(time, '%Y-%m-%d') DESC");
						foreach ($rows as $row) {
					?>
					<li class= "list">
					<!-- $id is contents id of notice -->
					<!--title is the content title -->
						<a href= <?= "/php/notice.php/?id=".$row["id"] ?> ><span class="title"><?= $row["title"] ?></span></a>
						<!-- date is when the content writes -->
						<span class="date"><?= $row["DATE_FORMAT(time, '%Y-%m-%d')"] ?></span>
					</li>
					<?php } ?>
				</ul>
			</div>
			<div class = "col-lg-6">
				<a class="h2" href="/php/questionlist.php"><h2>Question</h2></a>
				<hr/>
				<ul>
					<?php
						$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
						$rows = $db->query("SELECT id, title, DATE_FORMAT(time, '%Y-%m-%d') FROM question ORDER BY DATE_FORMAT(time, '%Y-%m-%d') DESC");
						foreach ($rows as $row) {
					?>
					<li class= "list">
						<!-- $id is contents id of notice -->
						<!--title is the content title -->
						<a href= <?= "/php/question.php?id=".$row["id"] ?> ><span class="title"><?= $row["title"] ?></span></a>
						<!-- date is when the content writes -->
						<span class="date"><?= $row["DATE_FORMAT(time, '%Y-%m-%d')"] ?></span>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="/public/js/user-setting.js"></script>
</body>
</html>
