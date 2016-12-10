<?php
	session_start();
	$logged_in = false;
	if (isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["auth"])) {
		$logged_in = true;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
	<link rel="stylesheet" href="../public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="../public/css/base.css" type="text/css">
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="../public/css/create-post.css" />
	<link rel="stylesheet" type="text/css" href="../public/css/lecture-upload.css" />
	<script type="text/javascript">
		<?php if (isset($_SESSION["id"]) && isset($_SESSION["favQuestion"]) && isset($_SESSION["openLecture"])) { ?>
			var questionArray = <?php echo json_encode($_SESSION["favQuestion"]); ?>;
			var lectureArray = <?php echo json_encode($_SESSION["openLecture"]); ?>;
		<?php } ?>
	</script>
	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../public/css/notice.css" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="/public/js/jquery.form.js"></script>
	<script src="/public/js/lecture-upload.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/push.js"></script>
	<script src="/public/js/pusher.js"></script>
	<script src="/public/js/base.js"></script>
</head>

<body>
	<header role = "banner" class="banner-color">
		<nav role="navigation">
			<div id="logo" class="pull-left"><a href="/php/main.php"><img class="logo" src="/public/img/selab_logo_S.png"/></a></div>
			<ul id="menu" class="inline-list pull-left">
				<li class="pull-left"><a href="/php/noticelist.php" class="menu-item" >NOTICE</a></li>
				<li class="pull-left"><a href="/php/questionlist.php" class="menu-item">QUESTION</a></li>
				<li class="pull-left"><a href="/php/freelist.php" class="menu-item">FREE BOARD</a></li>
				<li class="pull-left"><a href="/php/lecture-list.php" class="menu-item active">LECTURE</a></li>
			</ul>
			<div role="login" class="pull-right">
				<?php if ($logged_in) { ?>
          <a id="login" href="logout.php" class='pull-right'>LOGOUT</a>
          <div class="pull-right vr"></div>
          <a id="mypage" href="/php/changepw.php" class='pull-right'><?= $_SESSION["name"] ?> (<?= $_SESSION["auth"] ?>)</a>
        <?php } else { ?>
          <a id="login" href="dologin.php" class='pull-right'>LOGIN</a>
        <?php } ?>
			</div>
			<button class="pull-right">
				<img src="/public/img/search.png" class="search-icon">
			</button>
			<form id = "search-content" action="../php/search-page.php">
			<input type="text" class="pull-right search" name="search">
			</form>
		</nav>
		<div class = "jumbotron banner-color">
			<h1 class="align-center">Upload</h1>
			<p class="lead align-center">Upload your lecture note!</p>
		</div>
	</header>
	<div class="main">
		<div class="container">
			<form id = "form" action='/php/upload.php' enctype="multipart/form-data" method="post">
				<h2>Title</h2>
				<div class="title">
					<input name="title" id="title" type="text">
				</div>
				<div>
					<ul class="nav nav-tabs">
						<li class="question-tab active file"><a>File</a></li>
						<li class="question-tab url"><a>URL</a></li>
					</ul>
					<div class="tab file">
						<input type="file" id ="upload" name="upload">
					</div>
					<div class="tab url">
						<input type="input" name="url">
					</div>
					<?php
					if(isset($_GET["id"])){ ?>
						<input type="hidden" name="id" value="<?= $_GET["id"] ?>">
					<?php }?>
				</form>
				<div class='buttons'>
					<input id ='sub-mit' form = "form" class='btn btn-primary' type='submit' value="submit">
					<a class="btn btn-primary" href="/php/setting.php">cancel</a>
				</div>
			</div>
		</div>
	</body>
	</html>
