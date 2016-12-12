<?php
	session_start();
  $id = $_GET["id"];
  $u_id = $_SESSION["id"];

  try{
      $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $check_auth = $db->query("SELECT u_id FROM question WHERE id = $id");
      $auth = $check_auth->fetch();
      if(!($_SESSION["auth"] === 'professor' || $_SESSION["auth"] === 'assistant' || $u_id === $auth["u_id"])){
        header("Location: /error.php");
      }

    	$isFavorite = $db->query("SELECT q_id FROM favorite WHERE q_id = $id");
    	$isAnswered = $db->query("SELECT id FROM answer WHERE q_id = $id");
    	$fav_num = $isFavorite->fetch();
    	$ans_num = $isAnswered->fetch();
    	if($ans_num != 0){
    		// 삭제 못하게 알림 띄움
        echo "<script language=javascript>
        alert(\"답변이 달려있는 질문은 지울 수 없어요!\");
        window.location.href=\"/board/question/post.php?id=$id\";
        </script>";
    	}
    	else{
  	  	if($fav_num != 0){
  	  		$db->query("DELETE FROM favorite WHERE q_id = $id");
  	  	}
  	  	$db->query("DELETE FROM tag_question WHERE q_id = $id");
        if ($_SESSION["auth"] === "professor" || $_SESSION["auth"] === "assistant") {
          $db->query("DELETE FROM question WHERE id = $id");
        } else {
          $db->query("DELETE FROM question WHERE id = $id");
        }
  	  	$db->query("DELETE FROM comment WHERE reference_id = $id AND type = 'question'");
   	    header("Location: /board/question/list.php");
  	}
  } catch(PDOException $e){
    header("Location: /error.php");
  }

?>
