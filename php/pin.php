<?php
  session_start();

  $id = $_GET["id"];
  $u_id = $_SESSION["id"];
  $type = $_GET["type"];
  $which = $_GET["where"];

  if ($which == "free")
    $which = "board";

  try {
    $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($type == "pin") {
      $rows = $db->query("SELECT pinned FROM $which WHERE id = $id");
      if ($rows->rowCount() > 0) {
        $row = $rows->fetch();
        if ($row["pinned"])
          throw new PDOException("Already Pinned", 1);
      }
      else
        $db->query("UPDATE $which SET pinned = 1 WHERE id = $id");
    } else {
      $rows = $db->query("SELECT pinned FROM $which WHERE id = $id");
      if ($rows->rowCount() == 0) {
        $row = $rows->fetch();
        if (!$row["pinned"])
          throw new PDOException("Not Pinned", 1);
      }
      else
        $db->query("UPDATE $which SET pinned = 0 WHERE id = $id");
    }

    $result = array("error" => "false");
  } catch (PDOException $e) {
    $result = array("error" => "true");
  }
  header("Content-type: application/json");
  print json_encode($result);
?>