<?php
	session_start();
  	date_default_timezone_set('Asia/Seoul');

 	$u_id = $_SESSION["id"];
 	$id = $_POST["id"];
  	$content = $_POST["answer"];
  	$time = date("Y-m-d H:i:s");
  	try{
  		$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  		$db->query("INSERT INTO answer(u_id, q_id, content, score) VALUES($u_id, $id, '$content', 'time')");
  		header("Location: question.php?id=$id");
  	}catch(PDOException $e){
  		echo $e->getMessage();
  	}
?>