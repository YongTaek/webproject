<?php
  session_start();
  $result;
  $r_id = $_POST["id"];
  $time = $_POST["date"];
  // print $time;
  $time = new DateTime($time);
  // $time = strtotime($time);
  // $time = date("Y-m-d H:i:s",$time);
  // print $time;
  header("Content-type: application/json");
  try {
    $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $comments = $db->query("SELECT c.id, c.content, c.time, u.name from comment c join lecture l on c.type='lecture' and l.id=c.reference_id join user u on u.id=c.u_id where c.reference_id=$r_id and c.time < $time order by time desc limit 10 ");
      $arrays = array();
      foreach ($comments as $comment ) {
          $userName = $comment['name'];
          $time = $comment['time'];
          $content = $comment['content'];
          $arrays[] = array('userName' => $userName, 'time' => $time, 'content' => $content);
      }
      $result = $arrays;
  } catch (PDOException $e) {
    $result = array("error" => "true");
  }
  print json_encode($result);
?>
