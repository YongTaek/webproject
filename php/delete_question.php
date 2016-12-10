<?php
	session_start();
	$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  	$id = $_GET["id"];
  	$u_id = $_SESSION["id"];
 
  	$isFavorite = $db->query("SELECT q_id FROM favorite WHERE q_id = $id");
  	$isAnswered = $db->query("SELECT id FROM answer WHERE q_id = $id");
  	$fav_num = $isFavorite->fetch();
  	$ans_num = $isAnswered->fetch();
  	if($ans_num != 0){
  		// 삭제 못하게 알림 띄움
      echo "<script language=javascript>
      alert(\"답변이 달려있는 질문은 지울 수 없어요!\");
      $command
      </script>";
  	}
  	else{
	  	if($fav_num != 0){
	  		$db->query("DELETE FROM favorite WHERE q_id = $id");
	  	}
	  	$db->query("DELETE FROM tag_question WHERE q_id = $id");
	  	$db->query("DELETE FROM question WHERE id = $id AND u_id = $u_id");
	 }
  	header("Location: questionlist.php");
?>