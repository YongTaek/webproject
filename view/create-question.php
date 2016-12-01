<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Question</title>
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
	<link rel="stylesheet" href="../public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="../public/css/main.css" type="text/css">
	<link rel="stylesheet" href="../public/css/base.css" type="text/css">
	<link rel="stylesheet" href="../public/css/jquery.tag-editor.css">
    <link rel="stylesheet" type="text/css" href="../public/css/create-post.css" />
	<link rel="stylesheet" type="text/css" href="../public/css/wmd.css" />
	<link rel="stylesheet" type="text/css" href="../public/css/create-post.css" />
	<script type="text/javascript" src="../public/js/showdown.js"></script>
	<link rel="stylesheet" href="../public/css/pusher.css" type="text/css">
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="../public/js/push.js"></script>
	<script src="../public/js/jquery-ui-1.12.1.min.js"></script>
	<script src="../public/js/jquery.caret.min.js"></script>
	<script src="../public/js/jquery.tag-editor.min.js"></script>
	<title></title>
</head>
<body>
	<header role = "banner" class="banner-color">
		<nav role="navigation">
			<div id="logo" class="pull-left"><a href="/"><img class="logo" src="/public/img/selab_logo_S.png"/></a></div>
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
			<h1 class="align-center">Question</h1>
			<p class="lead align-center">Ask Question!</p>
		</div>
	</header>
	<div class='container'>
		<!-- action php  -->
		<form action='php' method="post">
			<h2>Title</h2>
			<div class="title">
				<input name="title" type="text">
			</div>
			<h2>Content</h2>
			<div class="content" id="wmd-editor">
				<div id="wmd-button-bar"></div>
				<textarea id="wmd-input"></textarea>
			</div>
			<hr>
			<div id="wmd-preview" class="wmd-preview"></div>
			<hr>
			<div>
				<label>Tags</label>
				<textarea id="tag" name="tags"></textarea></div>
				<div class='buttons'>
					<input class='btn btn-primary' type='submit' value="submit">
					<button class='btn btn-primary'>cancel</button>
				</div>
			</form>

		</div>
		<!-- <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> -->

		<script>
			$(function() {
				$('#tag').tagEditor({
					autocomplete: { delay: 0,position: { collision: 'flip' }, source: ['ActionScript', 'AppleScript', 'Asp', 'BASIC', 'C', 'C++', 'CSS', 'Clojure', 'COBOL', 'ColdFusion', 'Erlang', 'Fortran', 'Groovy', 'Haskell', 'HTML', 'Java', 'JavaScript', 'Lisp', 'Perl', 'PHP', 'Python', 'Ruby', 'Scala', 'Scheme'] },
					placeholder: 'Programming languages ...'
				});
			});
		</script>
		<script type="text/javascript" src="../public/js/wmd.js"></script>
	</body>
	</html>
