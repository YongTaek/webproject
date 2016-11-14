<!DOCTYPE html>
<html>
<head>
	<title>Notice</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
	<link rel="stylesheet" href="../public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../public/css/base.css" type="text/css">
	<link rel="stylesheet" href="../public/css/notice.css" type="text/css">
</head>
<body>
	<header role = "banner" class="banner-color">
		<nav role="navigation" >
			<div id="logo" class="pull-left"><a href="/view/main.php"><img class="logo" src="../public/img/selab_logo_S.png" /></a></div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/view/noticelist.php" class="menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/view/questionlist.php" class="menu-item">QUESTION</a></li>
				<li class="pull-left"><a href="/view/freelist.php" class="menu-item">FREE BOARD</a></li>
			</ul>
			<div role="login" class="pull-right">
				<a id="login" href="/view/login.php" class='pull-right'>LOGIN</a>
				<div class="pull-right vr"></div>

				<a id="mypage" href="/view/myPage.php" class='pull-right'>천유정 (학생)</a>
			</div>
			<img src="/public/img/search.png" class="pull-right search-icon">
			<input type="text" class="pull-right search" name="search">
		</nav>
		<div class = "jumbotron banner-color">
			<h1 class="align-center">Notice</h1>
			<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
		</div>
	</header>

	<div class="container">
		<div class="notice">
			<div class="title">
				<a class="star-off" href="#" ></a>
				<h1 id="title_id">
					<span>제목</span>
				</h1>
				<div class="notice_info">
					<span>author</span>
					<span>date</span>
				</div>
				<div class="notice_btn">
					<input type="button" class="btn notice_modify" name="notice_modify" value="수정">
					<input type="button" class="btn notice_delete" name="notice_delete" value="삭제">
				</div>
			</div>
			<div class="content">
				<p>Content</p>
			</div>
		</div>
		<!-- comment iterative-->
		<div class="comment">
				<hr>
				<?php ?>
				<div>
					<span>content</span>
					<span>author</span>
					<span class="">date</span>
					<div class="comment_btn">
						<input type="button" class="btn comment_modify" name="comment_modify" value="수정">
						<input type="button" class="btn comment_delete" name="comment_delete" value="삭제">
					</div>
				</div>
				<hr>
				<?php ?>
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
	<script src="../public/js/star_on_off.js" type="text/javascript"></script>
</body>
</html>
