<?php
  session_start();
  $id = $_POST["id"];
  $u_id = $_SESSION["id"];
  $title = htmlspecialchars($_POST["title"]);
  $content = $_POST["content"];
  $content = str_replace("\n", "<br/>", $content);

  if (!($_SESSION["auth"] === "professor" || $_SESSION["auth"] === "assistant")) {
    header("Location: /error.php");
  }

  try{
    $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->query("UPDATE notice SET title = '$title' WHERE id = $id AND u_id = $u_id");
    $db->query("UPDATE notice SET content = '$content' WHERE id = $id AND u_id = $u_id");
    header("Location: /board/notice/post.php?id=$id");
  } catch (PDOException $e) {
    header("Location: /error.php");
  }
  ?>
