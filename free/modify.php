<?php
  session_start();

  $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");

  $check_auth = $db->query("SELECT u_id FROM board WHERE id = ".$_POST["id"]);
  $auth = $check_auth->fetch();

  if (!($_SESSION["auth"] === "professor" || $_SESSION["auth"] === "assistant" || $_SESSION["id"] === $auth["u_id"])) {
    header("Location: /error.php");
  }

  $id = $_POST["id"];
  $u_id = $_SESSION["id"];
  $title = htmlspecialchars($_POST["title"]);

  if (strlen(trim($_POST["content"])) == 0) {
    header("Location: /error.php");
  }
  
  $content = $_POST["content"];
  $content = str_replace("\n", "<br/>", $content);
  $db->query("UPDATE board SET title = '$title' WHERE id = $id");
  $db->query("UPDATE board SET content = '$content' WHERE id = $id");
  header("Location: /board/free/post.php?id=$id");
  ?>
