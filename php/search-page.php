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
	<link rel="stylesheet" type="text/css" href="/public/css/noticelist.css">
	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
	<link rel="stylesheet" href="/public/css/pusher.css" type="text/css">
	<link rel="stylesheet" href="/public/css/search-page.css" type="text/css">
	<script type="text/javascript">
		<?php if (isset($_SESSION["id"]) && isset($_SESSION["favQuestion"]) && isset($_SESSION["openLecture"])) { ?>
			var questionArray = <?php echo json_encode($_SESSION["favQuestion"]); ?>;
			var lectureArray = <?php echo json_encode($_SESSION["openLecture"]); ?>;
		<?php } ?>
	</script>
	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/push.js"></script>
	<script src="/public/js/pusher.js"></script>
	<script src="/public/js/base.js"></script>
	<meta charset="utf-8">
	<title>검색</title>
</head>
<body>
	<header role ="banner">
		<nav role="navigation" class="banner-color">
			<div id="logo" class="pull-left">
				<a href="/php/main.php"><img class="logo" src="/public/img/selab_logo_S.png" /></a>
			</div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/php/noticelist.php" class="active menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/php/questionlist.php" class="menu-item">QUESTION</a></li>
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
			<button class="pull-right">
				<img src="/public/img/search.png" class="search-icon">
			</button>
			<form id = "search-content" action="../php/search-page.php">
			<input type="text" class="pull-right search" name="search">
			</form>
		</nav>
	</header><!-- /header -->
	<div class = "jumbotron banner-color">
		<h1 class="align-center">SEARCH</h1>
		<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
	</div>
	<div class= "content">
		<div class="subheader">
			<h2>ALL SEARCH</h2>
		</div>
		<div class= "qlist-wapper">
			
			<p class="bg-info">Notice</p>
			<?php
				// $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
				// $rows = $db->query("SELECT n.id, title, time, name FROM notice n JOIN user u ON n.u_id = u.id WHERE title = $search ORDER BY pinned DESC, time DESC");
				
				foreach ($rows as $row) {
			?>
			
			<div class= "question">
				<div class= "question-num-summary">
					<div class= "question-number">
						<div class= "mini-count">
							<span><?= $row["id"] ?></span> <!-- 문제 번호 -->
						</div>
						<div>indexs</div>
					</div>
				</div>
				<div class="question-list-left">
					<h3 class="title">
						<a href= <?= "/php/notice.php?id=".$row["id"] ?> ><?= $row["title"] ?></a> <!-- 제목 -->
					</h3>
				</div>
				<div class="question-list-right">
					<div>
						<h5 class="date"><?= $row["time"] ?></h5> <!-- 날짜 -->
						<h5 class="name">by. <?= $row["name"] ?></h5> <!--작성자 -->
					</div>
				</div>
			</div>
			
			<?php } ?>
			<p class="bg-info">Question</p>
			<p class="bg-info">Free Board</p>
			<p class="bg-info">Lecture</p>
		</div>
	</div>
</body>
</html>