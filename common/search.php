<?php include("pusher.php"); 
$keyword = trim($_POST["search"]);
if(strlen($keyword) == 0){
	header("Location: /error.php");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="/public/css/bootstrap.min.css" type="text/css">
<!-- 	<link rel="stylesheet" type="text/css" href="/public/css/noticelist.css"> -->
	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
	<link rel="stylesheet" href="/public/css/pusher.css" type="text/css">
	<link rel="stylesheet" href="/public/css/search-page.css" type="text/css">

	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="/public/js/jquery-ui-1.12.1.min.js"></script>
	<script src="/public/js/base.js"></script>
	<?php include("script.php"); ?>


	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/push.js"></script>
	<script src="/public/js/pusher.js"></script>
	<meta charset="utf-8">
	<title>검색</title>
</head>
<body>
	<?php include("header.php"); ?>
	<div class= "content">
		<div class="subheader">
			<h2>ALL SEARCH</h2>
		</div>
		<div class= "qlist-wapper">

			<p class="search-text">Notice</p>
			<?php
				$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
				$rows = $db->query("SELECT n.id, title, time, name FROM notice n JOIN user u ON n.u_id = u.id WHERE title like \"%$keyword%\" ORDER BY pinned DESC, time DESC");
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
					<h3 class="title not-question-title">
						<a href= <?= "/board/notice/post.php?id=".$row["id"] ?> ><?= $row["title"] ?></a> <!-- 제목 -->
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
			<p class="search-text">Question</p>
			<?php
				$rows = $db->query("SELECT DISTINCT q.id, q.title, time, u.name FROM question q JOIN user u on q.u_id = u.id WHERE title LIKE \"%$keyword%\" UNION SELECT DISTINCT q.id, q.title, time, u.name FROM question q JOIN user u ON q.u_id = u.id JOIN tag t JOIN tag_question tq ON t.id = tq.t_id and q.id = tq.q_id WHERE t.name LIKE \"%$keyword%\" order by time DESC");
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
						<a href= <?= "/board/question/post.php?id=".$row["id"] ?> ><?= $row["title"] ?></a> <!-- 제목 -->
					</h3>
					<div class="tags">
					<?php
							$tags = $db->query("SELECT distinct name, t.id FROM tag_question tq JOIN tag t WHERE t_id = id AND q_id = ".$row["id"]);
							foreach ($tags as $tag) {
						?>
						<a href="board/question/list-tag.php?id=<?= $tag["id"] ?>" class= "tag"><?= $tag["name"] ?></a>
						<?php
							}
						?>
					</div>
				</div>
				<div class="question-list-right">
					<div>
						<h5 class="date"><?= $row["time"] ?></h5> <!-- 날짜 -->
						<h5 class="name">by. <?= $row["name"] ?></h5> <!--작성자 -->
					</div>
				</div>
			</div>
			<?php } ?>
			<p class="search-text">Board</p>
			<?php
				$rows = $db->query("SELECT b.id, title, time, name FROM board b JOIN user u ON b.u_id = u.id WHERE title like \"%$keyword%\" ORDER BY pinned DESC, time DESC");

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
					<h3 class="title not-question-title">
						<a href= <?= "/board/free/post.php?id=".$row["id"] ?> ><?= $row["title"] ?></a> <!-- 제목 -->
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
			<p class="search-text">Lecture</p>
			<?php
				$rows = $db->query("SELECT id, name FROM lecture WHERE name like \"%$keyword%\"");
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
					<h3 class="title not-question-title">
						<a href= <?= "/lecture/class.php?id=".$row["id"] ?> ><?= $row["name"] ?></a> <!-- 제목 -->
					</h3>
				</div>
				<div class="question-list-right">
					<div>
						<h5 class="name">by. <?= "professor" ?></h5> <!--작성자 -->
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</body>
</html>