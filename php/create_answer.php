<?php
  session_start();
  date_default_timezone_set('Asia/Seoul');
  require('./library/Pusher.php');
  require('./library/push_setting.php');

  $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  $u_id = $_SESSION["id"];
  $id = $_POST["id"];
  $content = $_POST["answer"];

  $content = str_replace("\n", "&#13;&#10;", $content);
  $content = str_replace("\t", "&#13;&#9;", $content);
  $content = str_replace("\'", "&#13;&#39;", $content);
  $content = str_replace("\"", "&#13;&#34;", $content);

  $time = date("Y-m-d H:i:s");
  $num = $db->query("SELECT id FROM answer WHERE q_id = $id AND u_id = $u_id");
  $count = $num->rowCount();
  try{
    if($count == 0){
      $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->query("INSERT INTO answer(u_id, q_id, content, time) VALUES($u_id, $id, '$content', '$time')");
      $array = array('content' => "$id 에 답변이 달렸습니다!", "url" => "http://webapp.yongtech.kr/php/question.php?id=$id", 'time' => "$time");
      $pusher->trigger("$id", 'new_comment', $array);
      header("Location: question.php?id=$id");
    }
    else{
      echo "<script language=javascript>
      alert(\"한 질문에 답변 여러개 달 수 없어요!\");
      location=\"question.php\";
      </script>";
      // 한 질문에 답변 여러개 못단다고 알려줘야댐
    }

  } catch(PDOException $e){
    echo $e->getMessage();
    }

?>
