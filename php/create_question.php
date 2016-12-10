<?php
  session_start();
  date_default_timezone_set('Asia/Seoul');

  $id = $_SESSION["id"];
  $title = $_POST["title"];
  $content = $_POST["content"];
  $tag = $_POST["tags"];
  $time = date("Y-m-d H:i:s");
  $tags = explode(",", $tag);
  $num = count($tag);
  try {
    $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query("INSERT INTO question(u_id, title, content, time) VALUES($id, '$title', '$content', '$time')");
    if($tags[0] != ""){
      $questionId = $db->query("SELECT id from question where title='$title' and content='$content' and time='$time'");
      $q = $questionId->fetch();
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
    header("Location: question.php?id=".$q["id"]);
  } catch (PDOException $e) {
    echo $tag;
    echo $e->getMessage();
  }
?>
