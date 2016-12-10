<?php
  session_start();

  try {
    $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_FILES["file"])) {
      $file = file($_FILES["file"]["tmp_name"]);

      $data = [];

      foreach ($file as $line) {
        $data[] = str_getcsv($line);
      }

      foreach ($data as $row) {
        $id = $row[0];
        $name = $row[1];

        $options = [
          'cost' => 10,
        ];
        $pass = password_hash($id, PASSWORD_DEFAULT, $options);

        $db->query("INSERT INTO user VALUES ($id, '$name', '$pass', 'student')");
      }
    } else if (isset($_POST["id"]) && isset($_POST["name"]) && $_POST["id"] !== "" && $_POST["name"] !== "") {
      $id = $_POST["id"];
      $name = $_POST["name"];

      $options = [
        'cost' => 10,
      ];
      $pass = password_hash($id, PASSWORD_DEFAULT, $options);

      $db->query("INSERT INTO user VALUES ($id, '$name', '$pass', 'student')");
    } else {
      throw new PDOException("Input Error", 1);
    }

    $result = array("error" => "false");
  } catch (PDOException $e) {
    $result = array("error" => "true");
  }

  header("Content-type: application/json");
  print json_encode($result);
?>