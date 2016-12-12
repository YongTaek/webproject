<?php
  session_start();
  $id = $_GET["id"];
  $u_id = $_SESSION["id"];

  if (!($_SESSION["auth"] === "professor" || $_SESSION["auth"] === "assistant")) {
    header("Location: /error.php");
  }

  try{
	$db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->query("DELETE FROM notice WHERE id = $id AND u_id = $u_id");
	$db->query("DELETE FROM comment WHERE reference_id = $id AND type = 'notice'");
	header("Location: /board/notice/list.php");
  } catch (PDOException $e) {
    header("Location: /error.php");
  }
  ?>
