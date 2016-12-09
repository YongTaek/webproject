<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
	<link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="/public/css/main.css" type="text/css">
	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
	<script type="text/javascript">
		<?php if (isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["auth"])) { ?>
			var a = 1;
			console.log(a);
		<?php } ?>
	</script>
	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/push.js"></script>
</head>
<body>
	<header role = "banner" class="banner-color">
		<nav role="navigation">
			<div id="logo" class="pull-left"><a href="/php/main.php"><img class="logo" src="/public/img/selab_logo_S.png"/></a></div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/php/noticelist.php" class="menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/php/questionlist.php" class="menu-item">QUESTION</a></li>
				<li class="pull-left"><a href="/php/freelist.php" class="menu-item">FREE BOARD</a></li>
				<li class="pull-left"><a href="/view/lecture-list.php" class="menu-item active">LECTURE</a></li>
			</ul>
			<div role="login" class="pull-right">
				<?php
						if (isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["auth"])) {

				?>
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
			<img src="/public/img/search.png" class="pull-right search-icon">
			<input type="text" class="pull-right search" name="search">
		</nav>
		<div class = "jumbotron banner-color">
			<h1 class="align-center">Home</h1>
			<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
		</div>
	</header>
	<div class="main">
		<div class="container">
			<div class = "col-lg-6">
				<a class="h2" href="/php/noticelist.php"><h2>Notice</h2></a>
				<hr/>
				<ul>
					<?php
						$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
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
						<a href= <?= "/php/question.php/?id=".$row["id"] ?> ><span class="title"><?= $row["title"] ?></span></a>
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
