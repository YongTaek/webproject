<?php
  session_start();

  date_default_timezone_set('Asia/Seoul');

  $id = $_SESSION["id"];
  $title = $_POST["title"];
  $content = $_POST["content"];
  $time = date("Y-m-d H:i:s");

  try {
    $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query("INSERT INTO notice(u_id, title, content, time) VALUES(2010000000, '$title', '$content', '$time')");
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
?>
