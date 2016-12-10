<?php
  session_start();
  $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
  $id = $_GET["id"];
  $u_id = $_SESSION["id"];
  $db->query("DELETE FROM notice WHERE id = $id AND u_id = $u_id");
  $db->query("DELETE FROM comment WHERE reference_id = $id");
  header("Location: noticelist.php");
  ?>
