<?php
  session_start();
  $id = $_POST["id"];
  $u_id = $_SESSION["id"];
  $title = htmlspecialchars($_POST["title"]);
  $content = $_POST["content"];
  $content = str_replace("\n", "<br/>", $content);

  try{
    $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $auth_check = $db->query("SELECT u_id FROM notice WHERE id = $id");
    $auth = $auth_check->fetch();
    if($u_id != $auth["u_id"]){
        header("Location: /error");
    }

    $db->query("UPDATE notice SET title = '$title' WHERE id = $id AND u_id = $u_id");
    $db->query("UPDATE notice SET content = '$content' WHERE id = $id AND u_id = $u_id");
    header("Location: /board/notice/post.php?id=$id");
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  ?>
