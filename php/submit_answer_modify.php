<?php
	session_start();
	$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
	$id = $_POST["id"];
  	$u_id = $_SESSION["id"];
  	$content = $_POST["content"];
  	$db->query("UPDATE answer SET content = '$content' WHERE q_id = $id AND u_id = $u_id");
  	header("Location: question.php?id=$id");
?>