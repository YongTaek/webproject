<?php
  session_start();

  date_default_timezone_set('Asia/Seoul');

  $id = $_POST["id"];
  $content = $_POST["content"];
  $time = date("Y-m-d H:i:s");
  $redirectId = $_POST["questionId"];
  $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  try {
    $db->query("UPDATE comment set content=\"$content\" where id=$id");
    $db->query("UPDATE comment set time=\"$time\" where id=$id");
    header("Location: question.php?id=$redirectId");
  } catch (Exception $e) {
    echo $e -> getMessage();
  }


?>
