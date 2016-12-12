<?php
  session_start();
  header("Content-type: application/json;");
  date_default_timezone_set('Asia/Seoul');
  require('../library/Pusher.php');
  require('../library/push-setting.php');

  $r_id = $_POST["id"];
  $u_id = $_SESSION["id"];

  if (strlen(trim($_POST["content"])) == 0) {
    header("Location: /error.php");
  }

  $content = htmlspecialchars($_POST["content"], ENT_QUOTES);

  $time = date("Y-m-d H:i:s");
  $type = $_POST["type"];
  $name = $_SESSION["name"];
  try {
    $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
    $db->exec("set names utf8");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query("INSERT INTO comment(u_id, reference_id, content, time, type) VALUES ($u_id, $r_id, \"$content\", \"$time\", \"$type\")");
    if ($type === "lecture") {
      $url = "http://webapp.yongtech.kr/lecture/class.php?id=$r_id";
    }else if ($type === "question") {
      $url = "http://webapp.yongtech.kr/board/question/post.php?id=$r_id";
    }
    $result = array("error" => "false", "r_id" => $r_id, "content" => $content, "time" => $time, "name" => $name , "type" => $type, "url" => $url);
    $db->query("INSERT INTO notification(u_id, message, url, time) values (\"$u_id\", \"$content\", \"$url\",\"$time\")");
    $pusher->trigger("$r_id", 'new_comment', $result);
  } catch (PDOException $e) {
    $result = array("error" => "true", "r_id" => $r_id, "content" => $content, "type" => $type);
  }
  print json_encode($result);
?>
