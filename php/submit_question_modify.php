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
        foreach ($origin_tag as $tag){
            if($tag["name"] == $tags[$i]);
            else{
                $db->query("DELETE FROM tag_question WHERE q_id = $id");
                $find->query("SELECT id FROM tag WHERE ".$tags[$i]." = name");
                $found = $find->fetch();
                $num = $find->rowCount();
                if($num > 0){
                     $db->query("INSERT INTO tag_question(t_id, q_id) values(".$found["id"].",$id)");
                }
                else{
                    $db->query("INSERT INTO tag(name) values(tags[$i])");
                    $addt = $db->query("SELECT id FROM tag WHERE name = tags[$i]");
                    $tid = $addt->fetch();
                    $db->query("INSERT INTO tag_question(t_id, q_id) values($tid, $id)");
                }
            }
            $i++; 
        }
        $db->query("UPDATE question SET title = '$title' WHERE id = $id AND u_id = $u_id");
        $db->query("UPDATE question SET content = '$content' WHERE id = $id AND u_id = $u_id");
        header("Location: question.php?id=$id");
    } catch(PDOException $e){
        echo $e -> getMessage();
    }
?>