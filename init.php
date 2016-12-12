<?php

if ($argc < 4) {
  die("Use this to insert user manually.\nID is 10 length maximum Integer. Password is set automatically same as id.\nAuthority is one of the 'student', 'assistant', 'professor'.\nUsage : php $argv[0] 'id' 'name' 'authority'\n");
}

try {
  $db = new PDO("mysql:dbname=qna;host=localhost", "root", "root");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $id = $argv[1];
  $name = $argv[2];
  $auth = $argv[3];

  $options = [
    'cost' => 10,
  ];
  $pass = password_hash($id, PASSWORD_DEFAULT, $options);

  $db->query("INSERT INTO user VALUES ($id, '$name', '$pass', '$auth')");

  print "Successfully inserted\n";
} catch (PDOException $e) {
  echo $e->getMessage();
}

?>