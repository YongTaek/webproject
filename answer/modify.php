<?php
	session_start();

	$db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
	$id = $_POST["id"];
  	$u_id = $_SESSION["id"];
  	$content = $_POST["content"];
    $content = str_replace("\n", "<br/>", $content);
  	try{
  		$db->query("UPDATE answer SET content = '$content' WHERE q_id = $id AND u_id = $u_id");
  		header("Location: /board/question/post.php?id=$id");
    } catch(PDOException $e){
        echo $e -> getMessage();
    }
?>
