<?php
  session_start();
  $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");

  $check_auth = $db->query("SELECT u_id FROM question WHERE id = ".$_GET["id"]);
  $auth = $check_auth->fetch();
  if(!($_SESSION["auth"] === 'professor' || $_SESSION["auth"] === 'assistant' || $_SESSION["id"] === $auth["u_id"])){
    header("Location: /error.php");
  }

  $id = $_GET["id"];
  $u_id = $_SESSION["id"];
  $db->query("DELETE FROM board WHERE id = $id");
  $db->query("DELETE FROM comment WHERE reference_id = $id AND type = 'board'");
  header("Location: /board/free/list.php");
  ?>
