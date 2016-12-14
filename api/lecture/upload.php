<?php
session_start();
header("Content-Type:application/json");
$authority = $_SESSION['auth'];
if (!($authority === 'professor' || $authority === 'assistant')) {
	$result = array("error" => "true", "message" => "파일 업로드에 실패했습니다! :(");
}
	// print $result;
if(!isset($result)) {
	if(isset($_FILES['upload']['name']) && $_POST['url'] !== "") {
		$result = array("error" => "true","message" => "파일 업로드에 실패했습니다! :(" );
	} else if(isset($_FILES['upload']['name'])) {
		$fileType = explode(".",basename($_FILES["upload"]["name"]));
		if($fileType[1] === "pdf"){
			$uploaddir = "../../files/";
			$fileUrl = $uploaddir . basename($_FILES['upload']['name']);
			if(move_uploaded_file($_FILES['upload']['tmp_name'],$fileUrl)){
				$dbUrl = $fileUrl;
			} else{
				$result = array("error" => "true", "message"=>"파일 업로드에 실패했습니다! :(");
			}
		}
		else{
			$result = array("error" => "true", "message" => "pdf 파일을 올려주세요 :(");
		}
	} else if($_POST['url'] !== "") {
		$dbUrl = $_POST['url'];
	} else {
		$result = array("error" => "true", "message" => "파일 업로드에 실패했습니다! :(");
	}
	if(isset($result)) {
		print json_encode($result);
	} else {
		if (trim($_POST["title"]) === "") {
			$result = array("error" => "true", "message" =>"제목을 입력해주세요 :(");
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
			$result = array("error" => "false","message"=>"파일을 업로드했습니다");
		}
		print json_encode($result);
	}
} else {
	$result = array("error" => "true", "message"=>"파일 업로드에 실패했습니다! :(");
	print json_encode($result);
}
?>
