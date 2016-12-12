<?php
session_start();
date_default_timezone_set('Asia/Seoul');
if (!isset($_SESSION["id"])) {
  header("Location: /user/login.php");
}
$id = $_SESSION["id"];
$title = htmlspecialchars($_POST["title"], ENT_QUOTES);
$content = $_POST["content"];
if(!isset($_FILES['upload']['name'])){
  $dbUrl = NULL;
}
else{
  $uploaddir = "../files/";
  $fileUrl = $uploaddir . basename($_FILES['upload']['name']);
  if(move_uploaded_file($_FILES['upload']['tmp_name'],$fileUrl)){
    $dbUrl = $fileUrl;

    $time = date("Y-m-d H:i:s");

    if (!($_SESSION["auth"] === "professor" || $_SESSION["auth"] === "assistant")) {
      header("Location: /error.php");
    }
    try {
      $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $db->query("INSERT INTO notice(u_id, title, content, time, url) VALUES($id, '$title', '$content', '$time','$fileUrl')");
      $rows = $db->query("SELECT id FROM notice WHERE u_id=$id AND title='$title' AND content='$content' AND time='$time'");
      if ($rows->rowCount() > 0) {
        $row = $rows->fetch();
        header("Location: /board/notice/post.php?id=".$row["id"]);
      }
    } catch (PDOException $e) {
      header("Location: /error.php");
    }
  } else{
    header("Content-Type:application/json");
    $result = array("error" => "true", "message"=>"파일 업로드에 실패했습니다! :(");
    print json_encode($result);
  }
}
?>
