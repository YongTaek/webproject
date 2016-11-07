<!DOCTYPE html>
<html>
<head>
	<title>Question</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
	<link rel="stylesheet" href="../public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="../public/css/base.css" type="text/css">
	<link rel="stylesheet" href="../public/css/question.css" type="text/css">

</head>
<body>
	<header role = "banner" class="banner-color">
		<nav role="navigation" >
			<div id="logo" class="pull-left"><a href="/"><img class="logo" src="selab_logo_S.png" /></a></div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/view/noticelist.php" class="menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/view/questionlist.php" class="menu-item active">QUESTION</a></li>
				<li class="pull-left"><a href="/view/" class="menu-item">FREE BOARD</a></li>
			</ul>
			<div role="login" class="pull-right">
				<a id="login" href="/view/login.php">LOGIN</a>
			</div>
		</nav>
		<div class = "jumbotron banner-color">
			<h1 class="align-center">Notice</h1>
			<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
		</div>
	</header>

	<!-- parameter id=value 로 가져와서 question 내용 보여주기 -->
	<div class="container">
		<div class="question">
			<!-- qeustion title -->
			<h1 id="question_title">Title</h1>
			<hr>
			<div>
				<div class="vote">
					<a class="vote-up-off"></a>
					<!-- 추천 수 -->
					<span class="vote-count"></span>
					<a class="vote-down-off"></a>
					<a class="star-off"></a>
				</div>
				<!-- question 내용 -->
				<div class="content">
				</div>
			</div>
		</div>
		<!-- question에 대한 answer -->
		<div class="answer">
			<h2><?=$num ?> Answer</h2>
			<hr>
		<div class="overflow">
			<div class="vote">
				<a class="vote-up-off"></a>
				<!-- answer 추천 수 -->
				<span class="vote-count"><?=$test ?></span>
				<a class="vote-down-off"></a>
				<a class="star-off"></a>
			</div>
			<div class="content">
				asf
			</div>
		</div>
		<hr>
	</div>
		<div>
			<h2>Your Answer</h2>
			<div>
			</div>
		</div>
	</div>
</body>
</html>
