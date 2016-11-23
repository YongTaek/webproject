<?php
  session_start();
  $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  $id = $_GET["id"];
  $u_id = $_SESSION["id"];
  $title = $_POST["title"];
  $content = $_POST["content"];
  $rows = $db->query("UPDATE notice SET title = '$title' WHERE id = $id AND u_id = $u_id");
  ?>
  
