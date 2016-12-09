<?php
  session_start();

  $id = $_POST["id"];
  $passwd = $_POST["password"];

  $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  $rows = $db->query("SELECT * FROM user WHERE id = $id");
  if ($rows->rowCount() > 0) {
    $row = $rows->fetch();
    if (password_verify($passwd, $row["passwd"])) {
      $_SESSION["id"] = $row["id"];
      $_SESSION["name"] = $row["name"];
      $_SESSION["auth"] = $row["authority"];
      $userId = $row["id"];
      $favorites = $db->query("SELECT q_id from favorite where u_id=$userId");
      $questionArray = array();
      foreach ($favorites as $row) {
        $questionArray[] = $row["q_id"];
      }
      //TODO: 내가 쓴 질문에 대해 subscribe 필요!
      $lectureArray = array();
      $lectures = $db->query("SELECT id from lecture where open = 1");
      foreach ($lectures as $row ) {
        $lectureArray[] = $row["id"];
      }
      $_SESSION["favQuestion"] = $questionArray;
      $_SESSION["openLecture"] = $lectureArray;
      header("Location: main.php");
      exit;
    } else {
      echo "Login Failed";
    }
  } else {
    echo "Login Failed";
  }
?>
