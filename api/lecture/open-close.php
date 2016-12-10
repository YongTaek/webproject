<?php
	session_start();

  if (!isset($_SESSION["id"])) {
    header("Location: /error.php");
  }

	$id = $_GET["id"];
  $u_id = $_SESSION["id"];
  $status = $_GET["status"];

  try{
    if (!($_SESSION["auth"] === "professor" || $_SESSION["auth"] === "assistant")) {
      throw new PDOException("No Auth", 1);
    }

  	$db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($status == "open"){
    	$db->query("UPDATE lecture SET open = 1 WHERE id = $id");
    } else {
   		$db->query("UPDATE lecture SET open = 0 WHERE id = $id");
   	}
   	$result = array("error" => "false");
  } catch(PDOException $e) {
  	$result = array("error" => "true");
  }
  header("Content-type: application/json");
  print json_encode($result);
?>
