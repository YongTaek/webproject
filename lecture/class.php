<?php include("../common/pusher.php"); ?>
<?php
if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $rows = $db->query("SELECT l.id, l.name, l.url from lecture l where l.id = $id");
	$rows = $rows -> fetch();
	$s = $db->query("SELECT open from lecture where id = $id");
	$status = $s -> fetch();
	$lectureName = $rows['name'];
  $lectureFile = $rows['url'];
  $fileType = explode(".",$lectureFile);
	$fileType = $fileType[count($fileType)-1];
  if ($lectureName === "") {
    header("Location: /error.php");
  }
} else {
  header("Location: /error.php");
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
  	<script src="/public/js/base.js"></script>

  	<?php include("../common/script.php"); ?>
	
  	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="//js.pusher.com/3.2/pusher.min.js"></script>
	<script src="/public/js/lecture.js" type="text/javascript"></script>
</head>
<body>
<?php
	if($status != 0) { ?>
		<a class="closedrawer" id="side"></a>
<?php }
	if($fileType === "pdf"){
?>
	<embed src = "<?= $lectureFile ?>"></embed>
	<?php }else if( $fileType === "html" ){ ?>
	<iframe src = "<?= $lectureFile ?>"></iframe>
	<?php } ?>
	<div id="comment">
		<?php include("thread.php"); ?>
	</div>
  <script src="/public/js/pusher.js"></script>
</body>
</html>
