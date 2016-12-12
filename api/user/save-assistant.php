<?php
  session_start();

  $id = $_POST["id"];
  $name = $_POST["name"];

  try {
    if (strlen(trim($id)) == 0 || strlen(trim($name)) == 0) {
      throw new PDOException("Error Processing Request", 1);
    }

    $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $options = [
      'cost' => 10,
    ];
    $pass = password_hash($id, PASSWORD_DEFAULT, $options);

    $db->query("INSERT INTO user VALUES ($id, '$name', '$pass', 'assistant')");

    $result = array("error" => "false");
  } catch (PDOException $e) {
    $result = array("error" => "true");
  }
  header("Content-type: application/json");
  print json_encode($result);
?>
