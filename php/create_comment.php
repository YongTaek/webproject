<?php
  session_start();

  date_default_timezone_set('Asia/Seoul');

  $r_id = $_POST["id"];
  $u_id = $_SESSION["id"];
  $content = $_POST["comment"];
  $time = date("Y-m-d H:i:s");
  $type = $_POST["type"];

  try {
    $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query("INSERT INTO comment(u_id, reference_id, content, time, type) VALUES($u_id, $r_id, '$content', '$time', '$type')");
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
?>