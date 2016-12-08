<?php
	session_start();
	$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  	$id = $_POST["id"];
  	$u_id = $_SESSION["id"];
  	$title = $_POST["title"];
  	$content = $_POST["content"];
  	$t = $_POST["tags"];
  	$tags = explode(",", $t);
    $c_count = count($tags);
  	$i=0;
    try{
        if($tags[0] == NULL){
            $db->query("DELETE FROM tag_question WHERE q_id = $id");
        }
        else{
            $db->query("DELETE FROM tag_question WHERE q_id = $id");
            for($i=0;$i<$c_count;$i++){
                $find = $db->query("SELECT id FROM tag WHERE name = ".$tags[$i]);
                if(empty($find)){
                    $db->query("INSERT INTO tag(name) values('$tags[$i]')"); 
                    $newtag = $db->query("SELECT id FROM tag WHERE name = '$tags[$i]'");
                    $tid = $newtag->fetch();
                    $db->query("INSERT INTO tag_question(t_id, q_id) values(".$tid["id"].", $id)");
                }
                else{
                    $db->query("INSERT INTO tag_question(t_id, q_id) values(".$find["id"].", $id)");
                }
            }   
        }
        $db->query("UPDATE question SET title = '$title' WHERE id = $id AND u_id = $u_id");
        $db->query("UPDATE question SET content = '$content' WHERE id = $id AND u_id = $u_id");
        header("Location: question.php?id=$id");

    } catch(PDOException $e){
        echo $find;
        echo $e -> getMessage();
    }
?>