<?php
	session_start();
	header("Content-Type:application/json");
	$authority = $_SESSION['auth'];
	if (!($authority === 'professor' || $authority === 'assistant')) {
		$result = array("error" => "true");
	}
	// print $result;
	if(!isset($result)) {
		if(isset($_FILES['upload']['name']) && $_POST['url'] !== "") {
			$result = array("error" => "true");
		} else if(isset($_FILES['upload']['name'])) {
			$uploaddir = "../../files/";
			$fileUrl = $uploaddir . basename($_FILES['upload']['name']);
			if(move_uploaded_file($_FILES['upload']['tmp_name'],$fileUrl)){
				$dbUrl = $fileUrl;
			} else{
				$result = array("error" => "true");
			}
		} else if($_POST['url'] !== "") {
			$dbUrl = $_POST['url'];
		} else {
			$result = array("error" => "true");
		}
		if(isset($result)) {
			print json_encode($result);
		} else {
			if (trim($_POST["title"]) === "") {
				$result = array("error" => "true");
			}
			else {
				$name = $_POST["title"];
				$db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
				if(isset($_POST["id"])){
					$id = $_POST["id"];
					$db->query("UPDATE lecture SET name = '$name', url = '$dbUrl' WHERE id = $id");
				}
				else{
					$db->query("INSERT INTO lecture(name, url) VALUES ('$name', '$dbUrl')");

				}
				$result = array("error" => "false");
			}
			print json_encode($result);
		}
	} else {
			$result = array("error" => "true");
			print json_encode($result);
	}
?>
