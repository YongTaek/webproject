<?php
	include("../../common/pusher.php");
	$db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
	$id = $_GET["id"];
	$check_auth = $db->query("SELECT u_id FROM question WHERE id = $id");
  $auth = $check_auth->fetch();
  if(!($_SESSION["auth"] === 'professor' || $_SESSION["auth"] === 'assistant' || $u_id == $auth["u_id"])){
    header("Location: /error.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Question</title>
	<link rel="shortcut icon" href="icon/SelabFavicon.png" type="image/png">
	<link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="/public/css/main.css" type="text/css">
	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
	<link rel="stylesheet" href="/public/css/jquery.tag-editor.css">
  <link rel="stylesheet" type="text/css" href="/public/css/create-post.css" />
	<link rel="stylesheet" type="text/css" href="/public/css/wmd.css" />
	<link rel="stylesheet" type="text/css" href="/public/css/create-post.css" />

	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="/public/js/jquery-ui-1.12.1.min.js"></script>
	<script src="/public/js/base.js"></script>

	<?php include("../../common/script.php"); ?>

	<script type="text/javascript" src="../public/js/showdown.js"></script>
	<link rel="stylesheet" href="/public/css/pusher.css" type="text/css">
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/push.js"></script>
	<title></title>
</head>
<body>
	<?php include("../../common/header.php"); ?>
	<div class='container'>
		<!-- action php  -->
		<?php
      $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
      $id = $_GET["id"];
      $u_id = $_SESSION["id"];
      $rows = $db->query("SELECT title, content FROM question WHERE u_id = $u_id AND id = $id");
      $tags = $db->query("SELECT DISTINCT name FROM tag JOIN tag_question on q_id = $id AND t_id=id");
      $row = $rows->fetch();
      $name = "";
      foreach ($tags as $tag) {
      	$name = $name."\"".$tag["name"]."\",";
      }
    ?>
		<form action='/question/modify.php' method="post">
			<h2>Title</h2>
			<div class="title">
				<input name="title" type="text" value="<?= $row["title"] ?>">
			</div>
			<h2>Content</h2>
			<div class="content" id="wmd-editor">
				<div id="wmd-button-bar"></div>
				<textarea id="wmd-input" name="content"><?= $row["content"] ?></textarea>
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
				<input type="hidden" name="id" value="<?= $id ?>">
			</form>

		</div>
		<!-- <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> -->

		<script src="/public/js/jquery.caret.min.js"></script>
		<script src="/public/js/jquery.tag-editor.min.js"></script>
		<script>
			$(function() {
				$('#tag').tagEditor({
					autocomplete: { delay: 0,position: { collision: 'flip' }, source: ['ActionScript', 'AppleScript', 'Asp', 'BASIC', 'C', 'C++', 'CSS', 'Clojure', 'COBOL', 'ColdFusion', 'Erlang', 'Fortran', 'Groovy', 'Haskell', 'HTML', 'Java', 'JavaScript', 'Lisp', 'Perl', 'PHP', 'Python', 'Ruby', 'Scala', 'Scheme'] },
					initialTags: [<?= $name ?>],
					placeholder: 'Programming languages ...'
				});
			});
		</script>
		<script type="text/javascript" src="/public/js/wmd.js"></script>
	</body>
	</html>