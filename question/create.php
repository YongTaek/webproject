<?php
  session_start();
  date_default_timezone_set('Asia/Seoul');

  if (!isset($_SESSION["id"])) {
    header("Location: /user/login.php");
  }

  $id = $_SESSION["id"];
  $title = htmlspecialchars($_POST["title"]);  
  $content = $_POST["content"];

  $content = str_replace("\n", "<br/>", $content);
  
  $tag = $_POST["tags"];
  $time = date("Y-m-d H:i:s");
  $tags = explode(",", $tag);
  $num = count($tag);
  try {
    $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query("INSERT INTO question(u_id, title, content, time) VALUES($id, '$title', '$content', '$time')");

    $questionId = $db->query("SELECT id from question where title='$title' and content='$content' and time='$time'");
    $q = $questionId->fetch();
    if($tags[0] != ""){
      foreach ($tags as $tag) {
        $tagId = $db->query("SELECT id from tag where name='$tag'");
        $t = $tagId->fetch();
        if(!isset($t["id"])) {
          $db->query("INSERT INTO tag(name) values('$tag')");
          $tagId = $db->query("SELECT id from tag where name='$tag'");
          $t = $tagId->fetch();
        }
        $db->query("INSERT INTO tag_question(t_id, q_id) values(".$t["id"].",".$q["id"].")");
      }
   }

    header("Location: /board/question/post.php?id=".$q["id"]);
  } catch (PDOException $e) {
    header("Location: /error.php");
  }
?>
