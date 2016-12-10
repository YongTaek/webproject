<?php
  session_start();

  $id = $_POST["id"];

  try {
    $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $options = [
      'cost' => 10,
    ];
    $pass = password_hash($id, PASSWORD_DEFAULT, $options);

    $db->query("UPDATE user SET passwd = '$pass' WHERE id = $id");

    $result = array("error" => "false");
  } catch (PDOException $e) {
    $result = array("error" => "true");
  }
  header("Content-type: application/json");
  print json_encode($result);
?>