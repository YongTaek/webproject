<?php
  session_start();

  $id = $_GET["id"];
  $u_id = $_SESSION["id"];
  $type = $_GET["type"];

  try {
    $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($type == "favorite") {
      $rows = $db->query("SELECT * FROM favorite WHERE u_id = $u_id AND q_id = $id");
      if ($rows->rowCount() > 0)
        throw new PDOException("Already Favorite", 1);
      else
        $db->query("INSERT INTO favorite VALUES($u_id, $id)");
    } else {
      $rows = $db->query("SELECT * FROM favorite WHERE u_id = $u_id AND q_id = $id");
      if ($rows->rowCount() == 0)
        throw new PDOException("Not Favorite", 1);
      else
        $db->query("DELETE FROM favorite WHERE u_id = $u_id AND q_id = $id");
    }

    $result = array("error" => "false");
  } catch (PDOException $e) {
    $result = array("error" => "true");
  }
  header("Content-type: application/json");
  print json_encode($result);
?>