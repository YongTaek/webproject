<div id="mySidenav" class="sidenav">
  <span class="text">Notification</span>
  <a href="javascript:void(0)" class="closebtn">&times;</a>
  <a class="all-notification-delete">모든 알림 삭제</a>
  <hr>
  <!-- <span class="no-notification">받지 않은 알림이 없습니다!</span> -->
  <div id="notifications">
    <?php
    foreach ($pushArray as $array ) {
    ?>
    <a class="notification" zhref="<?=$array["url"]?>">
      <div class="notification-thread">
        <p class="notification-text"><?=$array["message"]?></p>
        <p class="notification-text"><?=$array["time"]?></p>
      </div>
    </a>
    <?php
      }
    ?>
  </div>
</div>
