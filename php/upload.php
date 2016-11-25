<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
// 업로드한 파일이 저장될 디렉토리 정의
$uploaddir = "../files/";  // 서버에 up 이라는 디렉토리가 있어야 한다.

$uploadfile = $uploaddir . basename($_FILES['upload']['name']);

if(move_uploaded_file($_FILES['upload']['tmp_name'],$uploadfile)){
  echo "파일이 유효하고, 성공적으로 업로드 되었습니다.\n";
  echo $uploadfile . "ha";
}

else{
  echo "바보";
  echo "<br/>";
  echo $uploadfile;
}
?>
</body>
</html>