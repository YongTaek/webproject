<?php
session_start();
$authority = $_SESSION['auth'];
if ($authority !== 'professor') {
	$result = array("error" => "true");
}
if(!isset($result)) {
	if(isset($_FILES['upload']['name']) && isset($_POST['url'])) {
		$result = array("error" => "true");
	} else if(isset($_FILES['upload']['name'])) {
		$uploaddir = "../files/";
		$fileUrl = $uploaddir . basename($_FILES['upload']['name']);
		if(move_uploaded_file($_FILES['upload']['tmp_name'],$fileUrl)){
			$dbUrl = $fileUrl;
		} else{
			$result = array("error" => "true");
		}
	} else if(isset($_POST['url'])) {
		$dbUrl = $_POST['url'];
	} else {
		$result = array("error" => "true");
	}
	if(isset($result)) {
		echo json_encode($result);
	} else {
		$name = $_POST["name"];
		$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
		$db->query("INSERT INTO lecture(name, url) values ('$name', '$dbUrl')");
		$result = array("error" => "false");
		echo json_encode($result);
	}
} else {
		echo json_encode($result);
}
?>
