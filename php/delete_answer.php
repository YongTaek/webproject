<?php
	session_start();
	$db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
  	$id = $_GET["id"];
  	$u_id = $_SESSION["id"];
  	$db->query("DELETE FROM answer WHERE u_id = $u_id AND q_id = $id");
  	header("Location: question.php?id=$id");
?>
