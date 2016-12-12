<?php
  session_start();

  date_default_timezone_set('Asia/Seoul');

  if (!isset($_SESSION["id"])) {
    header("Location: /user/login.php");
  }

  $id = $_SESSION["id"];
  $title = htmlspecialchars($_POST["title"], ENT_QUOTES);
  
  $content = $_POST["content"];

  $content = str_replace("\n", "<br/>", $content);

  $time = date("Y-m-d H:i:s");

  try {
    $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query("INSERT INTO board(u_id, title, content, time) VALUES($id, '$title', '$content', '$time')");
    $rows = $db->query("SELECT id FROM board WHERE u_id=$id AND title='$title' AND content='$content' AND time='$time'");
    if ($rows->rowCount() > 0) {
      $row = $rows->fetch();
      header("Location: /board/free/post.php?id=".$row["id"]);
    }
  } catch (PDOException $e) {
    header("Location: /error.php");
  }
?>
