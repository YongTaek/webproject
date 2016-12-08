<div id="sidebar">
  <div class="threads">
    <div class="thread">
      feejejek
    </div>
    <div class="thread">
      feejejek
    </div>
  </div>
  <form class="lecture" action="create_comment.php" method="POST">
    <textarea id="input" name="content" cols="23" rows="8"></textarea>
    <input type="hidden" name="id" value="<?= $rows["id"] ?>"/>
    <input type="hidden" name-="type" value="lecture" />
    <input type="submit" class="btn btn-primary" id="submit" value="등록"/>
  </form>
</div>
