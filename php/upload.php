<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
session_start();
if(isset($_FILES['upload']['name']) && isset($_POST['url'])) {
	echo "{ \"error\" : \"success\" }";
} else if(isset($_FILES['upload']['name'])) {
	$fileUrl = $uploaddir . basename($_FILES['upload']['name']);
} else if(isset($_POST['url'])) {
	$url = $_POST['url'];
} else {
	echo 
}
// 업로드한 파일이 저장될 디렉토리 정의
$uploaddir = "../files/";  // 서버에 up 이라는 디렉토리가 있어야 한다.

$fileUrl = $uploaddir . basename($_FILES['upload']['name']);
if(move_uploaded_file($_FILES['upload']['tmp_name'],$fileUrl)){
  echo "파일이 유효하고, 성공적으로 업로드 되었습니다.\n";
  echo $fileUrl . "ha";
} else{
  echo $fileUrl;
}
$id = $_SESSION["id"];
$name = $_POST["name"];
$webUrl = $_POST["url"];

$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
$db->query("INSERT INTO lecture(name, url)")
?>
</body>
</html>
