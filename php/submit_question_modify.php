<?php
	session_start();
	$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  	$id = $_POST["id"];
  	$u_id = $_SESSION["id"];
  	$title = $_POST["title"];
  	$content = $_POST["content"];
  	// $tags = $_POST["tags"];
  	$db->query("UPDATE question SET title = '$title' WHERE id = $id AND u_id = $u_id");
  	$db->query("UPDATE question SET content = '$content' WHERE id = $id AND u_id = $u_id");
  	header("Location: question.php?id=$id");
?>