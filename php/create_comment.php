<?php
  session_start();

  date_default_timezone_set('Asia/Seoul');

  $r_id = $_POST["id"];
  $u_id = $_SESSION["id"];
  $content = $_POST["content"];
  $time = date("Y-m-d H:i:s");
  $type = $_POST["type"];

  header('Content-type: text/plain');
  try {
    $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query("INSERT INTO comment(u_id, reference_id, content, time, type) VALUES($u_id, $r_id, '$content', '$time', '$type')");
    $result = array("error" => "false");
  } catch (PDOException $e) {
    echo $e->getMessage();
    $result = array("error" => "true");
  }
  print json_encode($result);
?>
