<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="../public/css/freelist.css">
	<link rel="stylesheet" href="../public/css/base.css" type="text/css">

	<meta charset="utf-8">
	<title>자유 게시판</title>
</head>
<body>
	<header role ="banner">
		<nav role="navigation" class="banner-color">
			<div id="logo" class="pull-left">
				<a href="/view/main.php"><img class="logo" src="/public/img/selab_logo_S.png" /></a>
			</div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/view/noticelist.php" class="menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/view/questionlist.php" class="menu-item">QUESTION</a></li>
				<li class="pull-left"><a href="/view/freelist.php" class="active menu-item">FREE BOARD</a></li>
			</ul>
			<div role="login" class="pull-right">
				<?php if (isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["auth"])) { ?>
					<a id="login" href="logout.php" class='pull-right'>LOGOUT</a>
					<div class="pull-right vr"></div>
					<a id="mypage" href="#" class='pull-right'><?= $_SESSION["name"] ?> (<?= $_SESSION["auth"] ?>)</a>
					<ul class="hidden" id="setting">
						<li><a href="user-setting.php">Setting</a></li>
					</ul>
				<?php } else { ?>
					<div class="pull-right vr"></div>
					<a id="login" href="dologin.php" class='pull-right'>LOGIN</a>
				<?php } ?>
			</div>
		</nav>
	</header><!-- /header -->
	<div class = "jumbotron banner-color">
		<h1 class="align-center">FREE BOARD</h1>
		<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
	</div>
	<div class= "content">
		<div class="subheader">
			<a type="button" class="createBtn btn btn-primary" href="/free/create">Ask Question</a>
			<h2>ALL FREE</h2>
			<ul class="nav nav-tabs">
				<li class="question-tab active"><a herf = "/recent">recent</a></li>
				<li class="question-tab"><a href = "/recommend">recommend</a></li>
			</ul>
		</div>
		<div class= "qlist-wapper">
		<?php
			$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
			$b_rows = $db->query("SELECT b.id, b.title, time, u.name FROM board b JOIN user u on b.u_id = u.id");
			$c_rows = $db->query("SELECT c.u_id, c.content, c.time FROM board b JOIN comment c on b.u_id = c.u_id WHERE c.type = 'board'");
			$count = $c_rows->rowCount();
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
							<span><?= $count ?></span> <!-- 댓글 -->
						</div>
						<div>comments</div>
					</div>

				</div>
				<div class="question-list-left">
					<h3 class="title">
						<a href="/view/notice.php"><?= $row["title"] ?></a> <!-- 제목 -->
					</h3>
				</div>
				<div class="question-list-right">
					<a class="star-off" href="#"></a>
					<div>
						<h5 class="date"><?= $row["time"] ?></h5> <!-- 날짜 -->
						<h5 class="name">by. <?= $row["name"] ?></h5> <!--작성자 -->
					</div>
				</div>
			</div>
			<?php }
			?>
		</div>

	</div>
</body>
</html>