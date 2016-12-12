<?php include("../../common/pusher.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Answer</title>
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
	<link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="/public/css/main.css" type="text/css">
	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
	<link rel="stylesheet" href="/public/css/jquery.tag-editor.css">
	<link rel="stylesheet" type="text/css" href="/public/css/create-post.css" />
	<link rel="stylesheet" type="text/css" href="/public/css/wmd.css" />
	<link rel="stylesheet" type="text/css" href="/public/css/create-post.css" />

	<script src="/public/js/jquery-3.1.1.min.js"></script>
	<script src="/public/js/jquery-ui-1.12.1.min.js"></script>
	<script src="/public/js/base.js"></script>
	<?php include("../../common/script.php"); ?>


	<script type="text/javascript" src="/public/js/showdown.js"></script>
	<link rel="stylesheet" href="/public/css/pusher.css" type="text/css">
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/push.js"></script>
	
	<title>답변 수</title>
</head>
<body>
	<?php include("../../common/header.php"); ?>

	<?php
		$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
      	$id = $_GET["id"];
      	$u_id = $_SESSION["id"];
      	$rows = $db->query("SELECT content FROM answer WHERE q_id = $id");
      	if($rows->rowCount() > 0){
      		$row = $rows->fetch();
      	}
	?>
	<div class='container'>
	<form action='/answer/modify.php' method="post">
		<h2>Your Answer</h2>
		<div class="content" id="wmd-editor">
			<div id="wmd-button-bar"></div>
			<textarea id="wmd-input" name="content"><?= $row["content"] ?></textarea>
		</div>
		<hr>
		<div id="wmd-preview" class="wmd-preview"></div>
		<hr>
		<input type="hidden" name="id" value="<?= $id ?>">
		<div class='buttons'>
			<input class='btn btn-primary' type='submit' value="submit">
			<button class='btn btn-primary'>cancel</button>
		</div>
		
	</form>

</div>

<script src="/public/js/jquery.caret.min.js"></script>

<script type="text/javascript" src="/public/js/wmd.js"></script>
</body>
</html>