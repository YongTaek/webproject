<?php
  session_start();

  unset($_SESSION["id"]);
  unset($_SESSION["name"]);
  unset($_SESSION["auth"]);

  header("Location: main.php");
  exit;
?>