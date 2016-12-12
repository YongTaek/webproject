<?php
  session_start();

  date_default_timezone_set('Asia/Seoul');

  if (!isset($_SESSION["id"])) {
    header("Location: /user/login.php");
  }

  $id = $_SESSION["id"];
  $title = htmlspecialchars($_POST["title"]);

  if (strlen(trim($_POST["content"])) == 0) {
    header("Location: /error.php");
  }
  
  $content = $_POST["content"];

  $content = str_replace("\n", "<br/>", $content);

  $time = date("Y-m-d H:i:s");

  if (!($_SESSION["auth"] === "professor" || $_SESSION["auth"] === "assistant")) {
    header("Location: /error.php");
  }

  try {
    $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->query("INSERT INTO notice(u_id, title, content, time) VALUES($id, '$title', '$content', '$time')");
    $rows = $db->query("SELECT id FROM notice WHERE u_id=$id AND title='$title' AND content='$content' AND time='$time'");
    if ($rows->rowCount() > 0) {
        $row = $rows->fetch();
        header("Location: /board/notice/post.php?id=".$row["id"]."&test=".strlen(trim($_POST["content"])));
    }
  } catch (PDOException $e) {
    header("Location: /error.php");
  }
?>
