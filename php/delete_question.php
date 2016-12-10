<?php
	session_start();
	$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  	$id = $_GET["id"];
  	$u_id = $_SESSION["id"];
 
  	$isFavorite = $db->query("SELECT q_id FROM favorite WHERE q_id = $id");
  	if(!empty($isFavorite)){
  		$db->query("DELETE FROM favorite WHERE q_id = $id");
  	}
  	$db->query("DELETE FROM tag_question WHERE q_id = $id");
  	$db->query("DELETE FROM question WHERE id = $id AND u_id = $u_id");
  	header("Location: questionlist.php");
?>