<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
	<link rel="stylesheet" href="../public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="../public/css/base.css" type="text/css">
	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="../public/css/create-question.css" />
	<link rel="stylesheet" href="../public/css/notice.css" type="text/css">
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
			<h1 class="align-center">Upload</h1>
			<p class="lead align-center">Upload your lecture note!</p>
		</div>
	</header>
	<div class="main">
		<div class="container">
		<form class='write' action='php' method="post">
			<div id='title-container'>
				<label>Title</label>
				<input id = 'title' name='title' type="text" maxlength="128">
			</div>
			<div class='question-container wmd-container'>
				<div id='wmd-editor'>
					<div id='wmd-button-bar'></div>
					<textarea id='wmd-input' name='question-content'></textarea>
				</div>
				<hr>
				<div id="wmd-preview" class="wmd-preview"></div>
				<hr>
			</div>
			<div style="margin:0 0 1.2em">
				<label>Tags</label>
				<textarea id="tag" name="tags"></textarea></div>
				<input class='btn btn-primary' type='submit'>
			</form>
		</div>

	</div>

</body>
</html>