<?php
  session_start();

  if (isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["auth"])) {
    $cur_pass = $_POST["id"];
    $new_pass = $_POST["password"];

    $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rows = $db->query("SELECT * FROM user WHERE id = ".$_SESSION["id"]);
    if ($rows->rowCount() > 0) {
      $row = $rows->fetch();
      if (password_verify($cur_pass, $row["passwd"])) {
        $options = [
          'cost' => 10,
        ];
        $new_pass = password_hash($new_pass, PASSWORD_DEFAULT, $options);
        try {
          $db->query("UPDATE user SET passwd = '$new_pass' WHERE id = ".$_SESSION["id"]);
        } catch (PDOException $ex) {
          echo "Change Failed";
          exit;
        }

        header("Location: /index.php");
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
