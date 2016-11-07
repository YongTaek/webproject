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
			<a id="login" href="/view/login.php" class='pull-right'>LOGIN</a>
			</div>
		</nav>
	</header><!-- /header -->
	<div class = "jumbotron banner-color">
		<h1 class="align-center">FREE BOARD</h1>
		<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
	</div>
	<div class= "content">
		<div class="subheader">
			<h2>ALL FREE</h2>
			<ul class="nav nav-tabs">
				<li class="question-tab active"><a herf = "/recent">recent</a></li>
				<li class="question-tab"><a href = "/recommend">recommend</a></li>
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
					<div class= "votes-number">
						<div class= "mini-count">
							<span>0</span> <!-- 추천 수  -->
						</div>
						<div>votes</div>
					</div>
					<div class= "comment-number">
						<div class= "mini-count">
							<span>0</span> <!-- 댓글 -->
						</div>
						<div>comments</div>
					</div>

				</div>
				<div class="question-list-left">
					<h3 class="title">
						<a href="/view/notice.php">title</a> <!-- 제목 -->
					</h3>
				</div>
				<div class="question-list-right">
					<a class="star-off" href="#"></a>
					<div>
						<h5 class="date">1일전</h5> <!-- 날짜 -->
						<h5 class="name">by. 익명</h5> <!--작성자 -->
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>