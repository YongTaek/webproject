<?php
  session_start();

  $id = $_GET["id"];
  $u_id = $_SESSION["id"];
  $type = $_GET["type"]; // answer or question
  $score = $_GET["score"]; // up on down

  try {
    $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($score == "up") {
      $rows = $db->query("SELECT * FROM user_question WHERE u_id = $u_id AND r_id = $id AND type = $type");
      if ($rows->rowCount() > 0)
        throw new PDOException("Already Scored", 1);
      else {
        $db->query("INSERT INTO user_question VALUES($u_id, $id, '$type')");
        $db->query("UPDATE question SET score = score + 1 WHERE id = $id");
      }
    } else {
      $rows = $db->query("SELECT * FROM user_question WHERE u_id = $u_id AND r_id = $id AND type = $type");
      if ($rows->rowCount() > 0)
        throw new PDOException("Already Scored", 1);
      else {
        $db->query("INSERT INTO user_question VALUES($u_id, $id, '$type')");
        $db->query("UPDATE question SET score = score - 1 WHERE id = $id");
      }
    }

    $result = array("error" => "false");
  } catch (PDOException $e) {
    echo $e->getMessage();
    $result = array("error" => "true");
  }
  header("Content-type: application/json");
  print json_encode($result);
?>