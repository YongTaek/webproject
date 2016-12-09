<?php
	session_start();
	$logged_in = false;
	if (isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["auth"])) {
		$logged_in = true;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="/public/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="/public/css/freelist.css">
	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/public/css/pusher.css" type="text/css">
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/push.js"></script>
	<meta charset="utf-8">
	<title>자유 게시판</title>
</head>
<body>
	<header role ="banner">
		<nav role="navigation" class="banner-color">
			<div id="logo" class="pull-left">
				<a href="/php/main.php"><img class="logo" src="/public/img/selab_logo_S.png" /></a>
			</div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/php/noticelist.php" class="menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/php/questionlist.php" class="menu-item">QUESTION</a></li>
				<li class="pull-left"><a href="/php/freelist.php" class="active menu-item">FREE BOARD</a></li>
				<li class="pull-left"><a href="/php/lecture-list.php" class="menu-item">LECTURE</a></li>
			</ul>
			<div role="login" class="pull-right">
				<?php if ($logged_in) { ?>
					<a id="login" href="logout.php" class='pull-right'>LOGOUT</a>
					<div class="pull-right vr"></div>
					<a id="mypage" href="/php/changepw.php" class='pull-right'><?= $_SESSION["name"] ?> (<?= $_SESSION["auth"] ?>)</a>
				<?php } else { ?>
					<a id="login" href="dologin.php" class='pull-right'>LOGIN</a>
				<?php } ?>
			</div>
			<a href="/view/free/search"><img src="/public/img/search.png" class="pull-right search-icon"></a>
			<input type="text" class="pull-right search" name="search">
		</nav>
	</header><!-- /header -->
	<div class = "jumbotron banner-color">
		<h1 class="align-center">FREE BOARD</h1>
		<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
	</div>
	<div class= "content">
		<div class="subheader">
			<?php if ($logged_in) { ?>
			<a type="button" class="createBtn btn btn-primary" href="create-freepost.php">Post Free</a>
			<?php } ?>
			<h2>ALL FREE</h2>
			<ul class="nav nav-tabs">
				<?php
					if (isset($_GET["type"])) {
						if ($_GET["type"] == "my") { ?>
				<li class="question-tab"><a href = "/php/freelist.php">recent</a></li>
				<li class="question-tab active"><a href = "/php/freelist.php?type=my">My Free</a></li>
						<?php } else { ?>
				<li class="question-tab active"><a href = "/php/freelist.php">recent</a></li>
				<li class="question-tab"><a href = "/php/freelist.php?type=my">My Free</a></li>
						<?php } } else { ?>
				<li class="question-tab active"><a href = "/php/freelist.php">recent</a></li>
				<li class="question-tab"><a href = "/php/freelist.php?type=my">My Free</a></li>
					<?php } ?>
			</ul>
		</div>
		<div class= "qlist-wapper">
		<?php
			$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
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
				$c_rows = $db->query("SELECT distinct c.u_id, c.content, c.time FROM board b JOIN comment c on b.u_id = c.u_id WHERE c.type = 'board' AND c.reference_id = ".$row["id"]);
				$count = $c_rows->rowCount();
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
						<a href="/php/free.php?id=<?= $row["id"] ?>"><?= $row["title"] ?></a> <!-- 제목 -->
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