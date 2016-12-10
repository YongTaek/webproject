<?php

  $data = json_decode($_POST["data"]);
  $id = $_SESSION["id"];
  if (isset($id)) {
    header("Location: main.php?id=$id");
  }
  $content = $data["content"];
  $time = $data["time"];
  $url = $data["url"];

  try {
    $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->query("UPDATE notification SET isread = 1 WHERE u_id = $id AND message = \"$content\" AND url = \"$url\" AND time = \"$time\"");
    $array = array("error" => "false");
    print json_encode($array);
  } catch (PDOException $e) {
    print $e;
    $array = array("error" => "true");

  }
?>
