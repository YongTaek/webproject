<?php
  $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
  $db->exec("set names utf8");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $rows = $db->query("SELECT message, url, time from notification where u_id=$userId and isread=0");
  $count = 0;
?>

<div id="mySidenav" class="sidenav">
  <span class="text">Notification</span>
  <a href="javascript:void(0)" class="closebtn">&times;</a>
  <hr>
  <!-- <span class="no-notification">받지 않은 알림이 없습니다!</span> -->
  <div id="notifications">
    <?php
     foreach ($rows as $row) {
        $message = $row["message"];
        $url = $row["url"];
        $time = $row["time"];
        $count++;
    ?>
    <a class="notification" href="<?=$url?>">
      <div class="notification-thread">
        <p><?=$message?></p>
        <p><?=$time?></p>
      </div>
    </a>
    <?php
      } ?>
  </div>
</div>
