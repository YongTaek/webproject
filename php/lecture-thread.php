<div id="sidebar">
<?php
      $db = new PDO("mysql:dbname=qna;host=localhost;charset=utf8", "root", "root");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $rows = $db->query("SELECT id, open FROM lecture WHERE id = $id");
      $row = $rows->fetch();
      if($row["open"] == 0){ ?>
        <div class="threads full-height" >
      <?php }
      else{ ?>
        <div class="threads" >
      <?php } ?>

    <?php
      $comments = $db->query("SELECT c.id, c.content, c.time, u.name from comment c join lecture l on c.type='lecture' and l.id=c.reference_id join user u on u.id=c.u_id where c.reference_id=$id order by time desc limit 20 ");
      $arrays = array();
      foreach ($comments as $comment ) {
          $userName = $comment['name'];
          $time = $comment['time'];
          $content = $comment['content'];
          $arrays[] = array('userName' => $userName, 'time' => $time, 'content' => $content);
      }
    ?>
    <?php
      $arrays = array_reverse($arrays);
      foreach ($arrays as $array) {
          $userName = $array['userName'];
          $time = $array['time'];
          $content = $array['content'];
    ?>
    <div class="thread">
          <span class="content"><?= $content ?></span>
          <br>
          <span class="writer"><?= $userName ?></span>
          <br>
          <span class="date"><?= $time ?></span>
    </div>
    <?php } ?>
  </div>

  <?php
      if($row["open"] == 1){ ?>
        <form class="lecture" action="create_comment.php" method="POST">
          <textarea id="input" name="content" cols="23" rows="8"></textarea>
          <input type="hidden" name="id" value="<?= $row["id"] ?>"/>
          <input type="hidden" name="type" value="lecture" />
          <input type="button" class="btn btn-primary" id="submit" value="등록"/>
        </form>
  <?php } ?>
</div>
