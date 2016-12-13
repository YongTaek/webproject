<?php
  session_start();

  if (!($_SESSION["auth"] === "professor" || $_SESSION["auth"] === "assistant")) {
    header("Location: /error.php");
  }
  header("Content-Type:application/json");
  $id = $_POST["id"];
  $u_id = $_SESSION["id"];
  $title = htmlspecialchars($_POST["title"], ENT_QUOTES);
  
  $content = $_POST["content"];
  $isclick = $_POST["isclick"];

  try{
    $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $url = $db->query("SELECT url FROM notice WHERE id = $id");
    $url = $url->fetch();

    if($isclick == 1 && !isset($_FILES['upload']['name'])){

      unlink($url["url"]);
      $db->query("UPDATE notice SET url = NULL WHERE id = $id");
      $db->query("UPDATE notice SET title = '$title' WHERE id = $id");
      $db->query("UPDATE notice SET content = '$content' WHERE id = $id");
      $result = array("error" => "false", "message"=>"업로드 됐던 기존 파일이 삭제됩니다.");

    }else if(isset($_FILES['upload']['name'])){

      unlink($url["url"]);
      $uploaddir = "../files/";
      $fileUrl = $uploaddir . basename($_FILES['upload']['name']);
      if(move_uploaded_file($_FILES['upload']['tmp_name'],$fileUrl)){
        $dbUrl = $fileUrl;
        $db->query("UPDATE notice SET url = '$dbUrl' WHERE id = $id");         
        $db->query("UPDATE notice SET title = '$title' WHERE id = $id");
        $db->query("UPDATE notice SET content = '$content' WHERE id = $id");
        if($url["url"]!=NULL){
          $result = array("error" => "false", "message"=>"업로드 됐던 기존 파일이 대체됩니다.");  
        }
        else{
          $result = array("error" => "false", "message"=>"수정이 완료되었습니다.");  
        }
        
      }
      else{
        $result = array("error" => "true", "message"=>"파일 업로드에 실패했습니다! :(");
      }
    }else{
      $db->query("UPDATE notice SET title = '$title' WHERE id = $id");
      $db->query("UPDATE notice SET content = '$content' WHERE id = $id");
      $result = array("error" => "false", "message"=>"수정이 완료되었습니다.");
    }
  } catch (PDOException $e) {
    header("Location: /error.php");
  }
  if(isset($result)){
    print json_encode($result);
  }
  ?>
