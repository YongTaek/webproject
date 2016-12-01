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
  	$origin_tag = $db->query("SELECT name FROM tag JOIN tag_question on q_id = $id AND t_id=id ORDER BY name");
  	$i=0;
  	try{
  	foreach ($origin_tag as $tag) {
  		if($tag["name"] == $tags[$i]);
  		else{
  			$find = $db->query("SELECT name, id FROM tag WHERE name = $tag["name"]");
  			$num = $find->rowCount();
  			$find = $found->fetch();
  			if($num > 0){
  				$db->query("UPDATE tag_question SET t_id = $found["id"] WHERE q_id = $id AND t_id = $found["id"]");
  			}
  			else{
  				$db->query("INSERT INTO tag(name) values('$tag["name"]')");
  				$t_find = $db->query("SELECT id FROM tag WHERE name = '$tag["name"]'");
  				$t_find = $t_found->fetch();
  				$db->query("INSERT INTO tag_question(t_id, q_id) values($t_found["id"],$id)");
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