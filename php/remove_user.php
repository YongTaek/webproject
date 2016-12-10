<?php
	session_start();
  	$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  	$u_id = $_SESSION["id"];
  	$id = $_GET["id"];  	
  	try{
  		$db->query("DELETE FROM comment where u_id=$id");
  		$db->query("DELETE FROM answer WHERE u_id = $id");
  		$db->query("DELETE FROM favorite WHERE u_id = $id");
  		$favorite = $db->query("SELECT f.u_id FROM favorite f JOIN question q on id = q_id WHERE q.u_id = $id");
  		if(!empty($favorite) && ($favorite->rowCount() > 0)){
	  		foreach ($favorite as $fav) {
	  			$db->query("DELETE FROM favorite WHERE u_id =".$fav["u_id"]);
	  		}
	  	}
  		$tags = $db->query("SELECT DISTINCT q_id FROM question JOIN tag_question on id = q_id WHERE u_id = $id");
  		if(!empty($tags) && ($tags->rowCount() > 0)){
	  		foreach ($tags as $tag) {
	  			$db->query("DELETE FROM tag_question WHERE q_id = ".$tag[$id]);	
	  		}
  		}
  		$isAnswered = $db->query("SELECT a.q_id FROM answer a JOIN question q on a.q_id = q.id where q.u_id = $id");
  		if(!empty($isAnswered) && ($isAnswered->rowCount() > 0)){
  			foreach ($isAnswered as $answer) {
  				$db->query("DELETE FROM answer WHERE q_id = ".$answer[$q_id]);	
  			}
  		}
		$db->query("DELETE FROM question WHERE u_id = $id");
		$db->query("DELETE FROM board WHERE u_id = $id");
  		$db->query("DELETE FROM user WHERE id = $id");
  		header("Location: setting.php");
  	} catch(PDOException $e){
  		echo $e -> getMessage();
  	}
  	
?>