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
			<div id="logo" class="pull-left"><a href="/"><img class="logo" src="selab_logo_S.png" /></a></div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/view/notice.php" class="menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/view/question.php" class="menu-item">QUESTION</a></li>
				<li class="pull-left"><a href="/view/" class="menu-item">FREE BOARD</a></li>
			</ul>
			<div role="login" class="pull-right">
				<a id="login" href="/login">LOGIN</a>
			</div>
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
			</div>
			<div class="content">
				<p>Content</p>
			</div>
		</div>
		<!-- comment iterative-->
		<?php ?>
		<div class="comment">
				<hr>
				<div>
					<span>content</span>
					<span>author</span>
					<span>date</span>
				</div>
				<hr>
		</div>
		<?php ?>
		<div>
		</div>
	</div>

</body>
</html>
