<div id="sidebar">
  <div class="threads">
    <?php
      $comments = $db->query("SELECT c.id, c.content, c.time, u.name from comment c join lecture l on c.type='lecture' and l.id=c.reference_id join user u on u.id=c.u_id where c.reference_id=$id order by time limit 10 ");
      $comments->fetch();
      for ($i=0; $i < $comments; $i++) {
        $userName = $comments[$i]['name'];
        $time = $comment[$i]['time'];
        $content = $comment[$i]['content'];
    ?>
    <div class="thread">
          <span class="content">
            <?= $content ?>
          </span>
          <br>
          <span class="writer">
            <?= $userName ?>
          </span>
          <br>
          <span class="date">
            <?= $time ?>
          </span>
    </div>
    <?php
        $comments->fetch();
        }
    ?>

  </div>
  <form class="lecture" action="create_comment.php" method="POST">
    <textarea id="input" name="content" cols="23" rows="8"></textarea>
    <input type="hidden" name="id" value="<?= $rows["id"] ?>"/>
    <input type="hidden" name="type" value="lecture" />
    <input type="button" class="btn btn-primary" id="submit" value="등록"/>
  </form>
</div>
