<div id="sidebar">
  <div class="threads">
    <?php
      $comments = $db->query("SELECT c.id, c.content, c.time, u.name from comment c join lecture l on c.type='lecture' and l.id=c.reference_id join user u on u.id=c.u_id where c.reference_id=".$_GET["id"] " order by time limit 10;");
      foreach ($comments as $comment ) {
          $userName = $comment['name'];
          $time = $comment['time'];
          $content = $comment['content'];
    ?>
    <div class="thread">
          <p>
            <?= $userName ?>
            <?= $time ?>
            <?= $content ?>
          </p>
    </div>
    <?php } ?>

  </div>
  <form class="lecture" action="create_comment.php" method="POST">
    <textarea id="input" name="content" cols="23" rows="8"></textarea>
    <input type="hidden" name="id" value="<?= $rows["id"] ?>"/>
    <input type="hidden" name="type" value="lecture" />
    <input type="button" class="btn btn-primary" id="submit" value="등록"/>
  </form>
</div>
