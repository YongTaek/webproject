<?php
if (isset($_GET["id"])) {
  $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  $rows = $db->query("SELECT l.name, l.url from lecture l where l.id = ".$_GET["id"]);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>lecture</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
	<link rel="stylesheet" href="/public/css/lecture.css" type="text/css">
	<link rel="stylesheet" href="../public/css/lecture-page.css" type="text/css">
	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="../public/js/jquery-ui-1.12.1.min.js"></script>
	<script src="/public/js/thread.js" type="text/javascript"></script>
	<script src="/public/js/lecture.js" type="text/javascript"></script>
</head>
<body>
	<a href="#" class="closedrawer" id="side"></a>
	<embed src = "../files/Notes03(file_io)_3.pdf"/* file path */></embed>
	<div id="comment">
		<?php include("./lecture-thread.php"); ?>
	</div>
</body>
</html>
