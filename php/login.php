<?php
  session_start();

  $id = $_POST["id"];
  $passwd = $_POST["password"];

  $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  $rows = $db->query("SELECT * FROM user WHERE id = $id and passwd = $passwd");
  if ($rows->rowCount() > 0) {
    $row = $rows->fetch();

    $_SESSION["id"] = $row["id"];
    $_SESSION["name"] = $row["name"];
    $_SESSION["auth"] = $row["authority"];

    header("Location: main.php");
    exit;
  } else {
    echo "Login Failed";
  }
?>