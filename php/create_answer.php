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
      header("Location: question.php?id=$id");
      $pusher->trigger("$id", 'new_comment', $array);
    }
    else{
      echo "<script language=javascript>
      alert(\"한 질문에 답변 여러개 달 수 없어요!\");
      location=\"question.php\";
      </script>";
    }
    
  } catch(PDOException $e){
    echo $e->getMessage();
    }

?>
