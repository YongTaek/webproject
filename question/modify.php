<?php
	session_start();
	$db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_POST["title"]) || !isset($_POST["content"]) || empty($_POST["title"]) === "" || empty($_POST["content"]) === "" || !preg_match("/^[0-9]+$/", $_POST["id"])) {
        header("Location: /error.php");
    }

  	$id = $_POST["id"];
  	$u_id = $_SESSION["id"];
  	$title = htmlspecialchars($_POST["title"]);
  	$content = $_POST["content"];
    $content = str_replace("\n", "<br/>", $content);
  	$t = $_POST["tags"];
  	$tags = explode(",", $t);
    $c_count = count($tags);
  	$i=0;

    try{
        $check_auth = $db->query("SELECT u_id FROM question WHERE id = $id");
        $auth = $check_auth->fetch();
        if(!($_SESSION["auth"] === 'professor' || $_SESSION["auth"] === 'assistant' || $u_id == $auth["u_id"])){
            header("Location: /error.php");
        }
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
        header("Location: /board/question/post.php?id=$id");

    } catch(PDOException $e){
        header("Location: /error.php");
    }
?>
