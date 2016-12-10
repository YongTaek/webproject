<?php
  session_start();
  $id = $_GET["id"];
  $u_id = $_SESSION["id"];

  try{
	$db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$auth_check = $db->query("SELECT u_id FROM notice WHERE id = $id");
    $auth = $auth_check->fetch();
    if($id != $auth["u_id"]){
       	header("Location: /error");
    }

	$db->query("DELETE FROM notice WHERE id = $id AND u_id = $u_id");
	$db->query("DELETE FROM comment WHERE reference_id = $id");
	header("Location: /board/notice/list.php");
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  ?>
