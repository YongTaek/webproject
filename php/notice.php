<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Notice</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
	<link rel="stylesheet" href="../public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="../public/css/base.css" type="text/css">
	<link rel="stylesheet" href="../public/css/notice.css" type="text/css">
</head>
<body>
	<header role = "banner" class="banner-color">
		<nav role="navigation" >
			<div id="logo" class="pull-left"><a href="/php/main.php"><img class="logo" src="../public/img/selab_logo_S.png" /></a></div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/php/notice.php" class="menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/php/question.php" class="menu-item">QUESTION</a></li>
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

	<?php
		if (isset($_GET["id"])) {
			$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
			$rows = $db->query("SELECT n.id, name, title, content, time FROM notice n JOIN user u ON n.u_id = u.id WHERE n.id = ".$_GET["id"]);
			foreach ($rows as $row) {
  ?>

	<div class="container">
		<div class="notice">
			<div class="title">
				<a class="star-off" href="#" ></a>
				<h1 id="title_id">
					<span><?= $row["title"] ?></span>
				</h1>
				<div class="notice_info">
					<span><?= $row["name"] ?></span>
					<span><?= $row["time"] ?></span>
				</div>
			</div>
			<div class="content">
				<p><?= $row["content"] ?></p>
			</div>
		</div>
		<!-- comment iterative-->
		<div class="comment">
				<hr>
				<?php
					$comments = $db->query("SELECT content, name, time FROM comment c JOIN user u ON c.u_id = u.id WHERE type = 'notice' AND reference_id = ".$row["id"]);
					foreach ($comments as $comment) {
				?>
				<div>
					<span><?= $comment["content"] ?></span>
					<span><?= $comment["name"] ?></span>
					<span class=""><?= $comment["time"] ?></span>
				</div>
				<hr>
				<?php } ?>
		</div>
		<div class="comment">
			<form>
				<label>Comment:</label>
				<div>
					<input id="comment-write" type="text" name="comment" />
					<input class="btn" id="submit" type="submit" value="등록"/>
				</div>
			</form>
		</div>
	</div>
	<?php
			}
		}
	?>
</body>
</html>
