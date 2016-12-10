<?php
	session_start();

	$db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");

  $check_auth = $db->query("SELECT u_id FROM answer WHERE id = $id");
  $auth = $check_auth->fetch();
  if(!($_SESSION["auth"] === 'professor' || $_SESSION["auth"] === 'assistant' || $_SESSION["id"] === $auth["u_id"])){
    header("Location: /error.php");
  }

  if (!isset($_POST["title"]) || !isset($_POST["content"]) || empty($_POST["content"]) === "" || !preg_match("/^[0-9]$/", $_POST["id"])) {
    header("Location: /error.php");
  }

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
