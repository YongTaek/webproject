<?php
  session_start();
  date_default_timezone_set('Asia/Seoul');
  require('./library/Pusher.php');
  require('./library/push_setting.php');

  $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  $u_id = $_SESSION["id"];
  $id = $_POST["id"];
  $content = $_POST["answer"];
  $time = date("Y-m-d H:i:s");
  $num = $db->query("SELECT id FROM answer WHERE q_id = $id AND u_id = $u_id");
  $count = $num->rowCount();
  try{
    if($count == 0){
      $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->query("INSERT INTO answer(u_id, q_id, content, time) VALUES($u_id, $id, '$content', '$time')");
      $array = array('content' => "$id 에 답변이 달렸습니다!" );
      $pusher->trigger("$id", 'new_comment', $array);
    }
    else{
      // 한 질문에 답변 여러개 못단다고 알려줘야댐
    }
    header("Location: question.php?id=$id");
  } catch(PDOException $e){
    echo $e->getMessage();
    }

?>
