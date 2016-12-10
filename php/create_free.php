<?php
  session_start();

  date_default_timezone_set('Asia/Seoul');
  header("Content-type: text/html; charset=UTF-8");

  $id = $_SESSION["id"];
  $title = iconv("ISO-8859-1", "UTF-8", $_POST["title"]);
  $content = iconv("ISO-8859-1", "UTF-8", $_POST["content"]);
  $time = date("Y-m-d H:i:s");

  echo $title."\n";
  echo $content."\n";

  try {
    $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query("INSERT INTO board(u_id, title, content, time) VALUES($id, '$title', '$content', '$time')");
    $rows = $db->query("SELECT id FROM board WHERE u_id=$id AND title='$title' AND content='$content' AND time='$time'");
    if ($rows->rowCount() > 0) {
      $row = $rows->fetch();
      header("Location: free.php?id=".$row["id"]);
    }
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
?>
