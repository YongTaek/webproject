<?php
	session_start();
	$status = $_GET["id"];
  	$u_id = $_SESSION["id"];

  	try{
  		$db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
    	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    	if($status == "open"){
    		$db->query("UPDATE lecture SET open = 1");
    	}
    	else{
    		$db->query("UPDATE lecture SET open = 1");	
    	}
  	}
?>