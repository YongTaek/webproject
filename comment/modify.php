<?php
  session_start();

  date_default_timezone_set('Asia/Seoul');

  $id = $_POST["id"];

  if (strlen(trim($_POST["content"])) == 0) {
    header("Location: /error.php");
  }

  $content = $_POST["content"];
  $content = str_replace("\n", "<br/>", $content);
  $time = date("Y-m-d H:i:s");
  $type = $_POST["type"];
  $redirectId = $_POST["reference"];
  $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  try {
    $db->query("UPDATE comment set content=\"$content\" where id=$id and type=\"$type\"");
    $db->query("UPDATE comment set time=\"$time\" where id=$id and type=\"$type\"");
    if ($type === "question") {
      header("Location: /board/question/post.php?id=$redirectId");
    } else if ($type === "notice") {
      header("Location: /board/notice/post.php?id=$redirectId");
    } else if ($type === "board") {
      header("Location: /board/free/post.php?id=$redirectId");
    }
  } catch (Exception $e) {
    echo $e -> getMessage();
  }


?>
