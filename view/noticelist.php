<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="../public/css/noticelist.css">
	<link rel="stylesheet" href="../public/css/base.css" type="text/css">
	<link rel="stylesheet" href="../public/css/pusher.css" type="text/css">
	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="../public/js/push.js"></script>
	<meta charset="utf-8">
	<title>공지 게시판</title>
</head>
<body>
	<header role ="banner">
		<nav role="navigation" class="banner-color">
			<div id="logo" class="pull-left">
				<a href="/view/main.php"><img class="logo" src="/public/img/selab_logo_S.png" /></a>
			</div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/view/noticelist.php" class="active menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/view/questionlist.php" class="menu-item">QUESTION</a></li>
				<li class="pull-left"><a href="/view/freelist.php" class="menu-item">FREE BOARD</a></li>
				<li class="pull-left"><a href="/view/lecture-list.php" class="menu-item">LECTURE</a></li>
			</ul>
			<div role="login" class="pull-right">
				<a id="login" href="/view/login.php" class='pull-right'>LOGIN</a>
				<div class="pull-right vr"></div>
				<a id="mypage" href="/view/myPage.php" class='pull-right'>천유정 (학생)</a>
			</div>
			<a href="/view/notice/search"><img src="/public/img/search.png" class="pull-right search-icon"></a>
			<input type="text" class="pull-right search" name="search">
		</nav>
	</header><!-- /header -->
	<div class = "jumbotron banner-color">
		<h1 class="align-center">NOTICES</h1>
		<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
	</div>
	<div class= "content">
		<div class="subheader">
			<a type="button" class="createBtn btn btn-primary" href="create-notice.php">Register Notice</a>
			<h2>ALL NOTICE</h2>
			<ul class="nav nav-tabs"> <!-- query에 따라 active 맞춰주기! to background-->
				<li class="question-tab active"><a href = "#?recent">recent</a></li>
				<li class="question-tab"><a href = "#?recommend">recommend</a></li>
				<li class="question-tab"><a href = "#?myfavorite">Favorite</a></li>
			</ul>
		</div>
		<div class= "qlist-wapper">
			<div class= "question">
				<div class= "question-num-summary">
					<div class= "question-number">
						<div class= "mini-count">
							<span>0</span> <!-- 문제 번호 -->
						</div>
						<div>indexs</div>
					</div>
				</div>
				<div class="question-list-left">
					<h3 class="title">
						<a href="/view/notice.php">title</a> <!-- 제목 -->
					</h3>
				</div>
				<div class="question-list-right">
					<div class="on-off">
						<a class="star-off" href="#"></a>
						<a class="pin-off" href="#"></a>
					</div>
					<div>
						<h5 class="date">1일전</h5> <!-- 날짜 -->
						<h5 class="name">by. 익명</h5> <!--작성자 -->
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<script src="../public/js/star_on_off.js" type="text/javascript"></script>
</body>
</html>
