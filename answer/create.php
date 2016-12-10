<?php
  session_start();
  date_default_timezone_set('Asia/Seoul');
  require('../library/Pusher.php');
  require('../library/push-setting.php');

  if (!isset($_SESSION["id"])) {
    header("Location: /user/login.php");
  }

  if (!isset($_POST["answer"]) || trim($_POST["answer"]) === "") {
    header("Location: /error.php");
  }

  if (!preg_match("/^[0-9]$/", $_POST["id"])) {
    header("Location: /error.php");
  }

  $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  $u_id = $_SESSION["id"];
  $id = $_POST["id"];
  $content = $_POST["answer"];

  $content = str_replace("\n", "<br/>", $content);

  $time = date("Y-m-d H:i:s");
  $num = $db->query("SELECT id FROM answer WHERE q_id = $id AND u_id = $u_id");
  $count = $num->rowCount();
  try{
    if($count == 0){
      $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->query("INSERT INTO answer(u_id, q_id, content, time) VALUES($u_id, $id, '$content', '$time')");
      $array = array('content' => "$id 에 답변이 달렸습니다!", "url" => "http://webapp.yongtech.kr/board/question/post.php?id=$id", 'time' => "$time");
      $pusher->trigger("$id", 'new_comment', $array);
      header("Location: /board/question/post.php?id=$id");
    }
    else{

    }

  } catch(PDOException $e){
    echo $e->getMessage();
    }

?>
