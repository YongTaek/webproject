<?php
	session_start();
  	$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  	$u_id = $_SESSION["id"];
  	$id = $_GET["id"];  	
  	try{
  		$db->query("DELETE FROM comment where u_id=$id");
  		$db->query("DELETE FROM answer WHERE u_id = $id");
  		$db->query("DELETE FROM favorite WHERE u_id = $id");
  		$favorite = $db->query("SELECT f.u_id FROM favorite f JOIN question q ON id = q_id WHERE q.u_id = $id");
  		$fav_num = $favorite->rowCount();
  		if($fav_num != 0){
	  		foreach ($favorite as $fav) {

	  			$db->query("DELETE FROM favorite WHERE u_id =".$fav["u_id"]);
	  		}
	  	}
  		$tags = $db->query("SELECT q_id FROM question JOIN tag_question on id = q_id WHERE u_id = $id");
  		foreach ($tags as $tag) {
  			$db->query("DELETE FROM tag_question WHERE q_id = ".$tags[$id]);	
  		}
		$db->query("DELETE FROM question WHERE id = $id AND u_id = $id");
		$db->query("DELETE FROM board WHERE u_id = $id");
  		$db->query("DELETE FROM user WHERE id = $id");
  		header("Location: setting.php");
  	} catch(PDOException $e){
  		echo $e -> getMessage();
  	}
  	
?>