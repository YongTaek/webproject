<?php
  session_start();

  $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  $id = $_POST["id"];
  $u_id = $_SESSION["id"];
  $title = $_POST["title"];
  $content = $_POST["content"];
  $db->query("UPDATE board SET title = '$title' WHERE id = $id AND u_id = $u_id");
  $db->query("UPDATE board SET content = '$content' WHERE id = $id AND u_id = $u_id");
  header("Location: free.php?id=$id");
  ?>
  
