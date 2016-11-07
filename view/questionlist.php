<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../public/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="../public/css/questionlist.css">
	<link rel="stylesheet" href="../public/css/header.css" type="text/css">

	<meta charset="utf-8">
	<title>질문 게시판</title>
</head>
<body>
	<header role ="banner">
		<nav role="navigation" class="banner-color">
			<div id="logo" class="pull-left">
				<a href="/"><img class="logo" src="selab_logo_S.png" /></a>
			</div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/notice" class="menu-item" >NOTICE</a></li>
				<li class="pull-left active"><a href="/members" class="menu-item">QUESTION</a></li>
				<li class="pull-left"><a href="/free" class="menu-item">FREE BOARD</a></li>
			</ul>
			<div role="login" class="pull-right"></div>
			<a id="login" href="/login" class='pull-right'>LOGIN</a>
		</nav>
	</header><!-- /header -->
	<div class = "jumbotron banner-color">
		<h1 class="align-center">Home</h1>
		<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
	</div>
	<div class= "content">
		<div class="subheader">
			<h2>ALL QUESTION</h2>
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
							<span>0</span>
						</div>
						<div>indexs</div>
					</div>
					<div class= "votes-number">
						<div class= "mini-count">
							<span>0</span>
						</div>
						<div>votes</div>
					</div>
					<div class= "answer-number">
						<div class= "mini-count">
							<span>0</span>
						</div>
						<div>answers</div>
					</div>

				</div>
				<div class="question-list-left">
					<h3 class="title">
						<a href="/">title</a>
					</h3>
					<div class= "tags">
						<a href="" class= "tag">tag1</a>
						<a href="" class= "tag">tag2</a>
					</div>
				</div>
				<div class="question-list-right">
					<a class="star-off" href="#"></a>						
					<div>
						<h5 class="date">1일전</h5>
						<h5 class="name">by. 익명</h5>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>
