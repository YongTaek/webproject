<?php
	include("../common/pusher.php");
	if (!($_SESSION["auth"] === "professor" || $_SESSION["auth"] === "assistant")) {
		header("Location: /error.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lecture Upload</title>
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
	<link rel="stylesheet" href="../public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="../public/css/base.css" type="text/css">
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="../public/css/create-post.css" />
	<link rel="stylesheet" type="text/css" href="../public/css/lecture-upload.css" />
	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="/public/js/jquery-ui-1.12.1.min.js"></script>
	<script src="/public/js/base.js"></script>

	<?php include("../common/script.php"); ?>
	
	<link rel="stylesheet" href="../public/css/notice.css" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="/public/js/jquery.form.js"></script>
	<script src="/public/js/lecture-upload.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/push.js"></script>
	<script src="/public/js/pusher.js"></script>
</head>

<body>
	<?php include("../common/header.php"); ?>
	<div class="main">
		<div class="container">
			<form id = "form" action='/api/lecture/upload.php' enctype="multipart/form-data" method="post">
				<h2>Title</h2>
				<div class="title">
					<input name="title" id="title" type="text" required>
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
					<a class="btn btn-primary" href="/user/setting.php">cancel</a>
				</div>
			</div>
		</div>
	</body>
	</html>
