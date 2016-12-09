<?php
if (isset($_GET["id"])) {
  $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  $id = $_GET["id"];
  $rows = $db->query("SELECT l.id, l.name, l.url from lecture l where l.id = $id");
	$rows = $rows -> fetch();
	$s = $db->query("SELECT open from lecture where id = $id");
	$status = $s -> fetch();
	$lectureName = $rows['name'];
  $lectureFile = $rows['url'];
  if ($lectureName === "") {
    header("Location: /view/error.php");
  }
} else {
  header("Location: /view/error.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $lectureName ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/public/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="/public/css/base.css" type="text/css">
	<link rel="stylesheet" href="/public/css/lecture.css" type="text/css">
	<link rel="stylesheet" href="/public/css/lecture-page.css" type="text/css">
	<script src="/public/js/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="/public/js/jquery-ui-1.12.1.min.js"></script>
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/lecture.js" type="text/javascript"></script>
</head>
<body>
<?php
	if($status != 0) { ?>
		<a href="#" class="closedrawer" id="side"></a>
<?php }
?>
	<embed src = "<?= $lectureFile ?>"></embed>
	<div id="comment">
		<?php include("./lecture-thread.php"); ?>
	</div>
</body>
</html>
