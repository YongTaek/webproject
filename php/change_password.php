<?php
  session_start();

  if (isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["auth"])) {
    $cur_pass = $_POST["id"];
    $new_pass = $_POST["password"];

    $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
    $rows = $db->query("SELECT * FROM user WHERE id = ".$_SESSION["id"]);
    if ($rows->rowCount() > 0) {
      $row = $rows->fetch();
      if (password_verify($cur_pass, $row["passwd"])) {
        $new_pass = password_hash($new_pass, PASSWORD_DEFAULT, 10);
        $db->query("UPDATE user SET passwd = $new_pass WHERE id = ".$_SESSION["id"]);

        header("Location: main.php");
        exit;
      } else {
        echo "Change Failed";
      }
    } else {
      echo "Change Failed";
    }
  } else {
    echo "Login First";
  }
?>