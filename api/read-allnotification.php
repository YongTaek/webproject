<?php
  session_start();
  header("Content-type: application/json;");
  $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
  if ($_SESSION["id"]) {
    $userId = $_SESSION["id"];
    try {
      $db->query("UPDATE notification SET isread=1 where u_id=$userId");
      $array = array("error" => "false");
      print json_encode($array);
    }catch (PDOException $e){
      print $e->getMessage();
    }
  } else {
    $array = array("error" => "true");
    print json_encode($array);
  }
?>
