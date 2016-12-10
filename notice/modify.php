<?php
  session_start();

  $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
  $id = $_POST["id"];
  $u_id = $_SESSION["id"];
  $title = htmlspecialchars($_POST["title"]);
  $content = $_POST["content"];
  $content = str_replace("\n", "<br/>", $content);
  $db->query("UPDATE notice SET title = '$title' WHERE id = $id AND u_id = $u_id");
  $db->query("UPDATE notice SET content = '$content' WHERE id = $id AND u_id = $u_id");
  header("Location: /board/notice/post.php?id=$id");
  ?>
