<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
	<link rel="stylesheet" href="../public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="../public/css/main.css" type="text/css">
	<link rel="stylesheet" href="../public/css/base.css" type="text/css">
	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/push.js"></script>
</head>

<body>
	<header role = "banner" class="banner-color">
		<nav role="navigation">
			<div id="logo" class="pull-left"><a href="/view/main.php"><img class="logo" src="/public/img/selab_logo_S.png"/></a></div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/view/noticelist.php" class="menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/view/questionlist.php" class="menu-item">QUESTION</a></li>
				<li class="pull-left"><a href="/view/freelist.php" class="menu-item">FREE BOARD</a></li>
			</ul>
			<div role="login" class="pull-right">
				<a id="login" href="login.php" class='pull-right'>LOGIN</a>
				<div class="pull-right vr"></div>
				<a id="mypage" href="#" class='pull-right'>천유정 (학생)</a>
				<div id="setting">
					<ul class="hidden">
						<li>
							<a href="user-setting.php">Setting</a>
						</li>
					</ul>
				</div>
			</div>
			<img src="/public/img/search.png" class="pull-right search-icon">
			<input type="text" class="pull-right search" name="search">
		</nav>
		<div class = "jumbotron banner-color">
			<h1 class="align-center">Home</h1>
			<p class="lead align-center">Wed 3:30 ~ & Thu 10:30 ~ </p>
		</div>
	</header>
	<div class="main">
		<div class="container">
			<div class = "col-lg-6">
				<a class="h2" href="/view/noticelist.php"><h2>Notice</h2></a>
				<hr/>
				<ul>
					<li class= "list">
					<!-- $id is contents id of notice -->
					<!--title is the content title -->
						<a href="/notice.php/?id=<?= $id ?>"><span class="title">title</span></a>
						<!-- date is when the content writes -->
						<span class="date">date</span>
					</li>
				</ul>
			</div>
			<div class = "col-lg-6">
				<a class="h2" href="/view/questionlist.php"><h2>Question</h2></a>
				<hr/>
				<ul>
					<li class= "list">
						<!-- $id is contents id of notice -->
						<!--title is the content title -->
						<a href="/notice.php/?id=<?= $id ?>"><span class="title">제목</span></a>
						<!-- date is when the content writes -->
						<span class="date">날짜</span>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../public/js/user-setting.js"></script>
</body>
</html>
