<?php
  session_start();
  $data = $_POST["data"];
  $id = $_SESSION["id"];
  if (isset($id)) {
    header("Location: main.php?id=$id");
  }
  $content = $data["content"];
  $time = $data["time"];
  $url = $data["url"];
  header("Content-type: application/json");
  try {
    $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->query("UPDATE notification SET isread=1 where u_id=$id and message=\"$content\" and url=\"$url\" and time=\"$time\" ");
    $array = array("error" => "false");
    print json_encode($array);
  } catch (PDOException $e) {
    print $e;
    $array = array("error" => "true");

  }
?>
