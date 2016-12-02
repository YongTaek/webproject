<?php
	session_start();
	$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  	$id = $_POST["id"];
  	$u_id = $_SESSION["id"];
  	$title = $_POST["title"];
  	$content = $_POST["content"];
  	$t = $_POST["tags"];
  	$tags = explode(",", $t);
  	sort($tags);
  	$origin_tag = $db->query("SELECT name, id FROM tag JOIN tag_question on t_id = id WHERE q_id = $id ORDER BY name");
  	$i=0;
  	try{
  	foreach ($origin_tag as $tag) {
  		if($tag["name"] == $tags[$i]);
  		else{ // 태그가 수정됐을경우
        $tags_tid = $db->query("SELECT id FROM tag WHERE name = ".$tag["name"]); // 수정한 태그의 원래 태그 id
        $t_tid = $tags_tid->fetch();
        $find = $db->query("SELECT name, id from tag join tag_question on id = t_id WHERE name =".$tags[$id]);
        $num = $find->fetch();
        if($num > 0){
          $db->query("UPDATE tag_question set t_id = ".$find["id"]."WHERE t_id =".$tag["id"]." AND q_id = $id");
        }
        else{

        }
  		}
  		$i++;
  	}
  	$db->query("UPDATE question SET title = '$title' WHERE id = $id AND u_id = $u_id");
  	$db->query("UPDATE question SET content = '$content' WHERE id = $id AND u_id = $u_id");
  	header("Location: question.php?id=$id");
  	} catch(PDOException $e){
  		echo $tag;
  		echo $e->getMessage();
  	}
?>