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
	<title></title>
</head>
<body>
	<header role = "banner" class="banner-color">
		<nav role="navigation">
			<div id="logo" class="pull-left"><a href="/"><img class="logo" src="selab_logo_S.png" /></a></div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/notice" class="menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/view/questionlist.php" class="active menu-item">QUESTION</a></li>
				<li class="pull-left"><a href="/free" class="menu-item">FREE BOARD</a></li>
			</ul>
			<div role="login" class="pull-right">
				<a id="login" href="/view/login.php" class='pull-right'>LOGIN</a>
			</div>
		</nav>
		<div class = "jumbotron banner-color">
			<h1 class="align-center">Question</h1>
			<p class="lead align-center"> Ask Question </p>
		</div>
	</header>
	<div class='container'>
		<div style="margin:0 0 1.2em"><textarea id="tag"></textarea></div>
	</div>
	<!-- <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> -->
	<script src="../public/js/jquery-3.1.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	<script src="../public/js/jquery.caret.min.js"></script>
	<script src="../public/js/jquery.tag-editor.min.js"></script>
	<script>
        $(function() {
        	$('#tag').tagEditor({
        		autocomplete: { delay: 0,position: { collision: 'flip' }, source: ['ActionScript', 'AppleScript', 'Asp', 'BASIC', 'C', 'C++', 'CSS', 'Clojure', 'COBOL', 'ColdFusion', 'Erlang', 'Fortran', 'Groovy', 'Haskell', 'HTML', 'Java', 'JavaScript', 'Lisp', 'Perl', 'PHP', 'Python', 'Ruby', 'Scala', 'Scheme'] },
        		placeholder: 'Programming languages ...'
        	});
        });
</script>
</body>
</html>