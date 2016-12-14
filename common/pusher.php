<?php
	session_start();
	$db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
	$logged_in = false;
  if (isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["auth"])) {
    $logged_in = true;
		$userId = $_SESSION["id"];
		$db->exec("set names utf8");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$rows = $db->query("SELECT message, url, time from notification where u_id=$userId and isread=0");
		$count = 0;
		$pushArray = array();
		foreach ($rows as $row) {
			$message = $row["message"];
			$url = $row["url"];
			$time = $row["time"];
			$count++;
			$tempArray = array("message" => $message, "url" => $url, "time" => $time);
			$pushArray[] = $tempArray;
		}
		$lectureArray = array();
		$lectures = $db->query("SELECT id from lecture");
		foreach ($lectures as $row ) {
			$lectureArray[] = $row["id"];
		}
		$_SESSION["openLecture"] = $lectureArray;
  }

?>
