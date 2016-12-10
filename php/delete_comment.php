<?php
	session_start();

  date_default_timezone_set('Asia/Seoul');

  $id = $_POST["id"];
	$type = $_POST["type"];

	$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try {
		$db->query("DELETE from comment where id=$id");

		$array = array("error" => "false");
		print json_encode($array);
	} catch (Exception $e) {
		echo $e -> getMessage();
	}
?>
